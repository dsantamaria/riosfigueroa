<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Market_value;
use App\Base_market;
use App\Agricola_siap;
use App\Farm;
use App\MexicoState;
use App\Market_first_frame_usage;
use App\Market_fourth_frame_usage;
use App\Market_six_frame_usage;
use App\User_region;
use App\Region_state;
use Excel;
use DB;
use Log;
use Auth;

class MarketValueController extends Controller
{
    public function market_value()
    {
    	return view('market.import');
	}

	public function market_import()
    {
        try {
            $file_contents = Excel::load(Input::file('input-1'), 'iso-8859-1')->noHeading()->get();
            DB::table('market_values')->delete();
        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());
            return redirect(route('products.index'));
        }
        set_time_limit(600);
        if ($file_contents) { 

            $data = array();
            $errors = [];
            $total = 0;

            foreach($file_contents as $key => $row)
            {	
            	if($key < 3) continue;
            	if($row[0] == null) break;
                $total = $total + 1;

                $data['year']             = $row[0]   == "" ? 0 : $row[0];
                $data['pro_insecticida']  = $row[1]   == "" ? 0 : $row[1];
                $data['pro_herbicida']    = $row[2]   == "" ? 0 : $row[2];
                $data['pro_fungicida']    = $row[3]   == "" ? 0 : $row[3];
                $data['pro_otros']        = $row[4]   == "" ? 0 : $row[4];
                $data['pro_total']        = $row[5]   == "" ? 0 : $row[5];
                $data['umf_insecticida']  = $row[6]   == "" ? 0 : $row[6];
                $data['umf_herbicida']    = $row[7]   == "" ? 0 : $row[7];
                $data['umf_fungicida']    = $row[8]   == "" ? 0 : $row[8];
                $data['umf_otros']        = $row[9]   == "" ? 0 : $row[9];
                $data['umf_total']        = $row[10]  == "" ? 0 : $row[10];
                $data['tipo_de_cambio']   = $row[16]  == "" ? 0 : $row[16];

                try {
                    $newProduct = Market_value::firstOrCreate($data);
                }
                catch (\Exception $e) {
                    $errors = ['year' => $row[0], 'error_msg' => $e->getMessage()];
                }
            }
        }
        \Session::Flash('success', 'Archivo importado correctamente.');

        return view('market.postImport',
            [   'total_count'=> $total,
                'error_count' => count($errors),
                'errors' => $errors
            ]);
        return;

        return view('products.postimport', ['errors'=> $errors]);
	}

    public function index(){
        $years = Market_value::getYears();
        return view('market.index')->with(['years' => $years]);
    }

    public function market_update(Request $request){
        $sector = $request['sector'];
        $chartData = [];
        $chartData = Market_value::data_from_all_years($sector);

        return response()->json(array('chartData' => $chartData, 'title' => ucfirst($sector)));
    }

    public function market_year_update(Request $request){
        $year = $request['year'];
        $sector = $request['sector'];
        $all_data = [];
        $chartData = [];
        
        $all_data = Market_value::data_from_specific_year($year, $sector);
        $chartData = $all_data['all_data'];

        return response()->json(array('chartData' => $chartData, 'exchange' => $all_data['exchange']));
    }

    public function market_farming()
    {
        $user_id = Auth::user()->id;
        $userDataRegion = User_region::getByUser($user_id);
        $userData = [];
        
        foreach ($userDataRegion as $region) {
            $states = [];

            foreach ($region->regionStates as $regionState) {
                array_push($states, $regionState->mexicoStates->alias);
            }

            array_push($userData, [
                'id' => $region->id,
                'name' => $region->name,
                'states' => implode(',', $states)
            ]);
        }

    	return view('market.farming')->with(['data' => $userData]);
    }
    
    public function market_farming_values($states, $farmProducts)
    {
        try {
            $farms = json_decode($farmProducts);
            $farmStates = json_decode($states);
            $farm_data = Agricola_siap::get_all_per_state_farm($farmStates, $farms);
            $farms_state_total = Agricola_siap::get_all_data_for_states($farms);

            

            $farm_adapt = [];
            $farm_adapt_total = [];
            $total_superficie = 0;

            $state_adapt = [];

            foreach ($farms as $data) {
                $farm_adapt[$data] = 0;
                $farm_adapt_total[$data] = 0;
            }

            foreach ($farmStates as $state) {
                foreach ($farms as $farm) {
                    $state_adapt[$state][$farm] = 0;
                }
            }

            foreach ($farm_data as $data) {
                $farm = $data['producto'];
                $superficie_sembrada = $data['superficie_sembrada'];
                if($superficie_sembrada < 0) continue;
                $farm_adapt[$farm] = $farm_adapt[$farm] + $superficie_sembrada;
            }

            foreach ($farms_state_total as $data) {
                $farm = $data['producto'];
                $superficie_sembrada = $data['superficie_sembrada'];
                if($superficie_sembrada < 0) continue;
                $farm_adapt_total[$farm] = $farm_adapt_total[$farm] + $superficie_sembrada;
            }

            foreach ($farm_data as $data) {
                $farm = $data['producto'];
                $state = $data['estado'];
                $state_trimmed = trim($state);
                $superficie_sembrada = $data['superficie_sembrada'];
                if($superficie_sembrada < 0) continue;
                $total_superficie = $total_superficie + $superficie_sembrada;
                $state_adapt[$state_trimmed][$farm] = $superficie_sembrada;
            }

            return response()->json(array('farm_data' => $farm_adapt, 'total_state' => $farm_adapt_total, 'total_superficie' => $total_superficie, 'states_data' => $state_adapt))->setStatusCode(200);
            
        } catch (\Throwable $th) {
            Log::error($th->getMessage() . " in -> market_farming_values");
            return response()->json(array('error' => $th->getMessage()))->setStatusCode(500);
        }
    }

    
    public function farms()
    {
        try {
            $farms = Farm::getFarms();
            return response()->json(array('farms' => $farms))->setStatusCode(200);
            
        } catch (\Throwable $th) {
            Log::error($th->getMessage() . " in -> farms");
            return response()->json(array('error' => $th->getMessage()))->setStatusCode(500);
        }
    }
    
    public function mxStates()
    {
        try {
            $states = MexicoState::getStates();
            return response()->json(array('states' => $states))->setStatusCode(200);
            
        } catch (\Throwable $th) {
            Log::error($th->getMessage() . " in -> mxStates");
            return response()->json(array('error' => $th->getMessage()))->setStatusCode(500);
        }
    }
    
    public function final_base_import()
    {
        try {
            $file_contents = Excel::load('Base.xlsx', 'iso-8859-1')->noHeading()->get();
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " in -> final_base_import");
            return;
        }
        set_time_limit(600);
        if ($file_contents) { 
            $states = [
                "Aguascalientes",
                "Baja California",
                "Baja California Sur",
                "Campeche",
                "Chiapas",
                "Chihuahua",
                "Ciudad de México",
                "Coahuila",
                "Colima",

                "Durango",
                "Guanajuato",
                "Guerrero",
                "Hidalgo",
                "Jalisco",
                "México",
                "Michoacán",
                "Morelos",
                "Nayarit",
                "Nuevo León",

                "Oaxaca",
                "Puebla",
                "Querétaro",
                "Quintana Roo",
                "San Luis Potosí",
                "Sinaloa",
                "Sonora",
                "Tabasco",
                "Tamaulipas",
                "Tlaxcala",

                "Veracruz",
                "Yucatán",
                "Zacatecas",
            ];

            $stateCount = 0;

            foreach($file_contents as $key => $sheet)
            {	
                if($key < 2 || $key > 33) continue;

                foreach ($sheet as $key => $row) {

                    $cultivo = $row[1];
                    if($cultivo === "" || $cultivo === "Cultivo" || $cultivo === " " || $cultivo === null) continue;
                    
                    $herb = $row[18];
                    $inse = $row[19];
                    $fung = $row[20];
                    $otro = $row[21];
                    $total = $row[17];
                    $state = $states[$stateCount];

                    $data['año'] = '2019';
                    $data['cultivo'] = trim($cultivo);
                    $data['estado'] = trim($state);
                    $data['herbicida'] =  $herb == "" ? 0 : $herb;
                    $data['insecticida'] =  $inse == "" ? 0 : $inse;
                    $data['fungicida'] =  $fung == "" ? 0 : $fung;
                    $data['otro'] =  $otro == "" ? 0 : $otro;
                    $data['total'] =  $total == "" ? 0 : $total;

                    Base_market::firstOrCreate($data);
                }

                $stateCount = $stateCount + 1;
            }
        }
    }


    
    public function getBaseValue($farm, $states, $producType){
        $states = json_decode($states);
        $baseData = Base_market::getByFarmStateType($farm, $states);
        $typevalue = 0;
        $total = 0;

        foreach ($baseData as $data) {
            $typevalue = $data[strtolower($producType)] + $typevalue;
            $total = $data['total'] + $total;
        }

        return response()->json(array('typevalue' => $typevalue, 'total' => $total))->setStatusCode(200);
    }

    public function getBaseByStatesFarms($states, $farms){
        $states = json_decode($states);
        $farms = json_decode($farms);

        $baseData = Base_market::getByFarmStateTypeArray($farms, $states);
        $fungicida = 0;
        $herbicida = 0;
        $insecticida = 0;
        $otro = 0;
        $total = 0;

        $statesValues = [];
        $stateFarmsValues = [];

        foreach ($states as $state) {
            $statesValues[$state]['value'] = 0;
            $statesValues[$state]['max'] = 0;
            foreach ($farms as $farm) {
                $stateFarmsValues[$state][$farm]['insecticida'] = 0;
                $stateFarmsValues[$state][$farm]['herbicida'] = 0;
                $stateFarmsValues[$state][$farm]['fungicida'] = 0;
                $stateFarmsValues[$state][$farm]['otro'] = 0;
                $stateFarmsValues[$state][$farm]['total'] = 0;
                $stateFarmsValues[$state][$farm]['max'] = 0;
            }
        }

        foreach ($baseData as $value) {
            $fungicida = $fungicida + $value['fungicida'];
            $herbicida = $herbicida + $value['herbicida'];
            $insecticida = $insecticida + $value['insecticida'];
            $otro = $otro + $value['otro'];
            $total = $total + $value['fungicida'] +  $value['herbicida'] +  $value['insecticida'] +  $value['otro'];

            $statesValues[$value['estado']]['value'] = $statesValues[$value['estado']]['value'] + $value['fungicida'] +  $value['herbicida'] +  $value['insecticida'] +  $value['otro'];
            $statesValues[$value['estado']]['max'] = $statesValues[$value['estado']]['max'] > ($value['fungicida'] +  $value['herbicida'] +  $value['insecticida'] +  $value['otro']) ? $statesValues[$value['estado']]['max'] : ($value['fungicida'] +  $value['herbicida'] +  $value['insecticida'] +  $value['otro']);

            $stateFarmsValues[$value['estado']][$value['cultivo']]['insecticida'] = $value['insecticida'];
            $stateFarmsValues[$value['estado']][$value['cultivo']]['herbicida'] = $value['herbicida'];
            $stateFarmsValues[$value['estado']][$value['cultivo']]['fungicida'] = $value['fungicida'];
            $stateFarmsValues[$value['estado']][$value['cultivo']]['otro'] = $value['otro'];
            $stateFarmsValues[$value['estado']][$value['cultivo']]['total'] = $value['total']; 
            $stateFarmsValues[$value['estado']][$value['cultivo']]['max'] = $value['fungicida'] +  $value['herbicida'] +  $value['insecticida'] +  $value['otro']; 
        }

        return response()->json(array(
            'fungicida' => $fungicida, 
            'herbicida' => $herbicida, 
            'insecticida' => $insecticida, 
            'otro' => $otro, 
            'total' => $total, 
            "stateFarmsValues" => $stateFarmsValues, 
            'statesValues' => $statesValues)
        )->setStatusCode(200);
    }

    public function firstFrameData(Request $request){
        $farms= $request['newFarms'];
        $states = $request['newStates'];

        foreach ($states as $state) {
            foreach ($farms as $farm) {
                Market_first_frame_usage::saveValues($farm, $state, Auth::user()->id);
            }
        }
    }

    public function forthFrameData(Request $request){
        $farm = $request['farm'];
        $states = $request['states'];
        $problem = $request['problem'];
        $sembradasHa = $request['haSembradas'];
        $tratadasHa = $request['haTratadas'];
        $product_id = $request['productId'];
        $priceDis = $request['pDistribuidor'];
        $dosisHa = $request['dosis'];
        $priceHa = $request['priceHa'];
        $cicloApp = $request['numberApplications'];
        $priceApp = $request['pricePerCicle'];
        $priceMarketPot = $request['potencialPriceValue'];
        $marketPotencialApp = $request['potencialPriceHaValue'];
        $probablyApp = $request['applicationsWish'];
        $marketProbably = $request['wishMarketAppValue'];
        $objective = $request['msPercent'];
        $msHa = $request['msWishHa'];
        $msWish = $request['msWish'];
        $lt = $request['ltEquivalent'];

        Market_fourth_frame_usage::saveValues($farm, $states, $problem, $sembradasHa, $tratadasHa, $product_id, $priceDis, $dosisHa, $priceHa, $cicloApp, $priceApp, $priceMarketPot, $marketPotencialApp, $probablyApp, $marketProbably, $objective, $msHa, $msWish, $lt, Auth::user()->id);

    }

    public function sixFrameData(Request $request){
        $states = $request['activestates'];
        $farms = $request['activeFarms'];
        $sembradasHa = $request['sembradaHa'];
        $tratadasHa = $request['superHa'];
        $spend = $request['gasto'];
        $percentIncecticida = $request['inc'];
        $percentHerbicida = $request['her'];
        $percentFungicida = $request['fun'];
        $percentOtros = $request['otr'];

        Market_six_frame_usage::saveValues($states, $farms, $sembradasHa, $tratadasHa, $spend, $percentIncecticida, $percentHerbicida, $percentFungicida, $percentOtros, Auth::user()->id);
    }

    public function saveRegions(Request $request){
        $states = $request['states'];
        $name = $request['name'];

        try {
            $userRegion = User_region::saveRegion($name, Auth::user()->id);
            $userRegionId = $userRegion->id;

            foreach ($states as $state) {
                $stateId = MexicoState::getStateByAlias($state)->id;
                Region_state::saveUserRegion($userRegionId, $stateId);
            }
            return response()->json(array('id' => $userRegionId))->setStatusCode(200);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " in -> saveRegions");
            return response()->json(array('error' => $e->getMessage()))->setStatusCode(500);
        }        
    }

    public function getUserRegions(){
        $user_id = Auth::user()->id;
        $userDataRegion = User_region::getByUser($user_id);
        $userData = [];
        
        foreach ($userDataRegion as $region) {
            $states = [];

            foreach ($region->regionStates as $regionState) {
                array_push($states, $regionState->mexicoStates->alias);
            }

            array_push($userData, [
                'name' => $region->name,
                'states' => $states
            ]);
        }

        return response()->json(array('userData' => $userData))->setStatusCode(200);
    }

    public function deletRegion(Request $request){
        $id = $request['id'];

        try {
            User_region::deleteRegion($id);
            return response()->json(array('ok' => 'ok'))->setStatusCode(200);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " in -> deletRegion");
            return response()->json(array('error' => $e->getMessage()))->setStatusCode(500);
        }
    }
}