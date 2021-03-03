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
use App\Market_farm;
use App\Market_data;
use App\Market_entity;
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
    
    public function market_farming_values($states, $farmProducts, $year)
    {
        try {
            $farms = json_decode($farmProducts);
            $farmStates = json_decode($states);

            $is_advanced = $year == 2020;
            $farm_adapt = [];
            $farm_adapt_total = [];
            $total_superficie = 0;
            $state_adapt = [];

            if(!$is_advanced){
                $farmsMarket = array_map(function($farm){
                    return Market_farm::getByName($this->marketSummaryFarmAdapter($farm, false));
                }, $farms);
    
                $stateMarket = array_map(function($state){
                    return Market_entity::getByName($state);
                }, $farmStates);
    
                $farmsIds = array_map(function($f){ return $f->id; }, $farmsMarket);
                $stateIds = array_map(function($s){ return $s->id; }, $stateMarket);
    
                $summary_values = Market_data::get_all_per_state_farm($farmsIds, $stateIds);
                $summary_values_total = Market_data::get_all_data_for_states($farmsIds);
    
                foreach ($farmsIds as $id) {
                    $farm_name = $this->getFarmNameById($farmsMarket, $id);
                    $farm_adapt[$farm_name] = 0;
                    $farm_adapt_total[$farm_name] = 0;
                }
    
                foreach ($stateIds as $id) {
                    $state_name = $this->getStatesNameById($stateMarket, $id);
                    foreach ($farmsIds as $farmId) {
                        $farm_name = $this->getFarmNameById($farmsMarket, $farmId);
                        $state_adapt[$state_name][$farm_name] = 0;
                    }
                }
    
                foreach ($summary_values as $data) {
                    $farm = $this->marketSummaryFarmAdapter($data->marketFarm->nombre, true);
                    $superficie_sembrada = $data['supsembrada'];
                    if($superficie_sembrada < 0) continue;
    
                    $farm_adapt[$farm] = $farm_adapt[$farm] + $superficie_sembrada;
                }
    
                foreach ($summary_values_total as $data) {
                    $farm = $this->marketSummaryFarmAdapter($data->marketFarm->nombre ,true);;
                    $superficie_sembrada = $data['supsembrada'];
                    if($superficie_sembrada < 0) continue;
                    $farm_adapt_total[$farm] = $farm_adapt_total[$farm] + $superficie_sembrada;
                }
    
                foreach ($summary_values as $data) {
                    $farm = $this->marketSummaryFarmAdapter($data->marketFarm->nombre ,true);
                    $state = $data->marketEntity->nombre;
    
                    $superficie_sembrada = $data['supsembrada'];
                    if($superficie_sembrada < 0) continue;
                    $total_superficie = $total_superficie + $superficie_sembrada;
                    $state_adapt[$state][$farm] = $superficie_sembrada;
                }
            }else{
                $farm_data = Agricola_siap::get_all_per_state_farm($farmStates, $farms);
                $farms_state_total = Agricola_siap::get_all_data_for_states($farms);

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

    public function final_base_factor_import()
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
                    
                    $factor = floatval($row[10]);
                    $herb = floatval($row[2]);
                    $inse = floatval($row[3]);
                    $fung = floatval($row[4]);
                    $otro = floatval($row[5]);
                    $state = $states[$stateCount];

                    $data['state'] = trim($cultivo);
                    $data['farm'] = trim($state);
                    $data['her_price'] =  $herb == "" ? 0 : $herb;
                    $data['inc_price'] =  $inse == "" ? 0 : $inse;
                    $data['fun_price'] =  $fung == "" ? 0 : $fung;
                    $data['otr_price'] =  $otro == "" ? 0 : $otro;
                    $data['factor'] =  $otro == "" ? 0 : $otro;

                    DB::table('base_market_factors')->insert([
                        [
                            'state' => trim($state),
                            'farm' => trim($cultivo),
                            'her_price' => $herb == "" ? 0 : $herb,
                            'inc_price' => $inse == "" ? 0 : $inse,
                            'fun_price' => $fung == "" ? 0 : $fung,
                            'otr_price' => $otro == "" ? 0 : $otro,
                            'factor' =>  $factor == "" ? 0 : $factor,
                        ],
                    ]);
                }

                $stateCount = $stateCount + 1;
            }
        }
    }

    public function update_base_marquet(){
        ini_set('max_execution_time', 3000);

        $base = DB::table('base_market_factors')->get();
        $siap = Agricola_siap::all();

        foreach ($base as $value) {
            $product = $this->baseFarmAdapter($value->farm, true);
            $state = $value->state;
            $data = [];

            if($product === "") continue;
            try {
                $find_data = $siap->where('anio', 2020)->where('producto', $product)->where('estado', $state )->sortBy('mes')->last();
                $ha = $find_data ? $find_data->superficie_sembrada : 0;
                $her = $value->her_price * $value->factor * $ha;
                $inc = $value->inc_price  * $value->factor * $ha;
                $fun = $value->fun_price * $value->factor * $ha;
                $otr = $value->otr_price * $value->factor * $ha;

                $data['año'] = '2020';
                $data['cultivo'] = $value->farm;
                $data['estado'] = $value->state;
                $data['herbicida'] =  $her;
                $data['insecticida'] =  $inc;
                $data['fungicida'] =  $fun;
                $data['otro'] =  $otr;
                $data['total'] =  $her + $inc +  $fun + $otr;

                Base_market::firstOrCreate($data);

            } catch (\Throwable $th) {
                Log::Debug($th);
            }
            
        }
    }



    
    public function getBaseValue($farm, $states, $producType, $year){
        $states = json_decode($states);
        $baseData = Base_market::getByFarmStateType($farm, $states, $year);
        $typevalue = 0;
        $total = 0;

        foreach ($baseData as $data) {
            $typevalue = $data[strtolower($producType)] + $typevalue;
            $total = $data['total'] + $total;
        }

        return response()->json(array('typevalue' => $typevalue, 'total' => $total))->setStatusCode(200);
    }

    public function getBaseByStatesFarms($states, $farms, $year){
        $states = json_decode($states);
        $farms = json_decode($farms);

        $baseData = Base_market::getByFarmStateTypeArray($farms, $states, $year);
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

    private function marketSummaryFarmAdapter($farm_name, $inverse){
        $farms = [
            "AGAVE" => "Agave",
            "AGUACATE" => "Aguacate",
            "AJO" => "Ajo",
            "ALFALFA VERDE" => "Alfalfa",
            "ALGODN HUESO" => "Algodón hueso",
            "ARANDANO" => "Arándano",
            "ARROZ PALAY" => "Arroz palay",
            "AVENA GRANO" => "Avena grano",
            "BERENJENA" => "Berenjena",
            "BROCOLI" => "Brócoli",
            "CACAHUETE" => "Cacahuate",
            "CACAO" => "Cacao",
            "CAF CEREZA" => "Café cereza",
            "CALABACITA" => "Calabacita",
            "CAA DE AZUCAR" => "Caña de azúcar",
            "CEBOLLA" => "Cebolla",
            "CHILE VERDE" => "Chile verde",
            "CHICHARO" => "Chícharo",
            "CLAVEL" => "Clavel",
            "COLIFLOR" => "Coliflor",
            "CRISANTEMO (Gruesa)" => "Crisantemo",
            "DURAZNO" => "Durazno",
            "ESPARRAGO" => "Espárrago",
            "FRAMBUESA" => "Frambuesa",
            "FRESA" => "Fresa",
            "FRIJOL" => "Frijol",
            "GLADIOLA (Gruesa)" => "Gladiola",
            "LECHUGA" => "Lechuga",
            "LIMON" => "Limón",
            "MAIZ GRANO" => "Maíz grano",
            "MANGO" => "Mango",
            "MANZANA" => "Manzana",
            "MELON" => "Melón",
            "NARANJA" => "Naranja",
            "NUEZ" => "Nuez",
            "PAPA" => "Papa",
            "PALMA DE ACEITE" => "Palma africana o de aceite",
            "PAPAYA" => "Papaya",
            "PASTOS Y PRADERAS" => "Pastos y praderas",
            "PEPINO" => "Pepino",
            "PIA" => "Piña",
            "PLATANO" => "Plátano",
            "ROSA (Gruesa)" => "Rosa",
            "SANDIA" => "Sandía",
            "SORGO GRANO" => "Sorgo grano",
            "SOYA" => "Soya",
            "TABACO" => "Tabaco",
            "TOMATE ROJO (JITOMATE)" => "Tomate rojo (jitomate)",
            "TOMATE VERDE" => "Tomate verde",
            "TORONJA (POMELO)" => "Toronja (pomelo)",
            "TRIGO GRANO" => "Trigo grano",
            "UVA" => "Uva",
            "ZANAHORIA" => "Zanahoria",
            "ZARZAMORA" => "Zarzamora"
        ];

        if($inverse){
            $farms_inverse = array_flip($farms);
            return $farms_inverse[$farm_name];
        }

        return $farms[$farm_name];
    }


    private function baseFarmAdapter($farm_name, $inverse){
        $farms = [
            "AGAVE" => "Agave",
            "AGUACATE" => "Aguacate",
            "AJO" => "Ajo",
            "ALFALFA VERDE" => "Alfalfa (T)",
            "ALGODN HUESO" => "Algodón",
            "ARANDANO" => "Arándanos",
            "ARROZ PALAY" => "Arroz",
            "AVENA GRANO" => "Avena Grano",
            "BERENJENA" => "Berenjena",
            "BROCOLI" => "Brócoli",
            "CACAHUETE" => "Cacahuate",
            "CACAO" => "Cacao",
            "CAF CEREZA" => "Café",
            "CALABACITA" => "Calabacita",
            "CAA DE AZUCAR" => "Cana de Azúcar",
            "CEBOLLA" => "Cebolla",
            "CHILE VERDE" => "Chile verde",
            "CHICHARO" => "Chícharo",
            "CLAVEL" => "Clavel",
            "COLIFLOR" => "Col (repollo)",
            "CRISANTEMO (Gruesa)" => "Crisantemo",
            "DURAZNO" => "Durazno",
            "ESPARRAGO" => "Espárrago",
            "FRAMBUESA" => "Frambuesa",
            "FRESA" => "Fresa",
            "FRIJOL" => "Frijol",
            "GLADIOLA (Gruesa)" => "Gladiola",
            "LECHUGA" => "Lechuga",
            "LIMON" => "Limón",
            "MAIZ GRANO" => "Maíz grano",
            "MANGO" => "Mango",
            "MANZANA" => "Manzana",
            "MELON" => "Melón",
            "NARANJA" => "Naranja",
            "NUEZ" => "Nogal (Nuez)",
            "PAPA" => "Papa",
            "PALMA DE ACEITE" => "Palma de aceite",
            "PAPAYA" => "Papaya",
            "PASTOS Y PRADERAS" => "Pastos y Praderas",
            "PEPINO" => "Pepino",
            "PIA" => "Piña",
            "PLATANO" => "Plátano",
            "ROSA (Gruesa)" => "Rosas (Gruesa)",
            "SANDIA" => "Sandía",
            "SORGO GRANO" => "Sorgo Grano",
            "SOYA" => "Soya",
            "TABACO" => "Tabaco",
            "TOMATE ROJO (JITOMATE)" => "Tomate (Jitomate)",
            "TOMATE VERDE" => "Tomate Verde",
            "TORONJA (POMELO)" => "Toronja (pomelo)",
            "TRIGO GRANO" => "Trigo Grano",
            "UVA" => "Uva",
            "ZANAHORIA" => "Zanahoria",
            "ZARZAMORA" => "Zarzamora"
        ];

        if($inverse){
            $farms_inverse = array_flip($farms);
            return array_key_exists($farm_name, $farms_inverse) ? $farms_inverse[$farm_name] : "";
        }

        return array_key_exists($farm_name, $farms) ? $farms[$farm_name] : "";
    }

    private function getFarmNameById($farmsMarket, $id){
        foreach ($farmsMarket as $value) {
            if($value->id == $id){
                return $this->marketSummaryFarmAdapter($value->nombre, true);
            }
        }
    }

    private function getStatesNameById($statesMarket, $id){
        foreach ($statesMarket as $value) {
            if($value->id == $id){
                return $value->nombre;
            }
        }
    }
}