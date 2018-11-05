<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Market_value;
use Excel;
use DB;
use Log;

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
}
