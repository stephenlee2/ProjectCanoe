<?php

namespace App\Http\Controllers;
use App\Canoe;
use App\Fund;
use DB;

use Illuminate\Http\Request;

class FormController extends Controller
{
    
    public function index()
    {
        // $investments = DB::select('SELECT * FROM investments');
        // return view('canoe.form')->with(['investments'=> $investments]);

        $client_list = DB::table('investments')
          ->groupBy('client_id')
         ->get();
        return view('canoe.form')->with('client_list', $client_list);
    }


    function fetch(Request $request)
    {
     $select = $request->get('select');
     $value = $request->get('value');
     $dependent = $request->get('dependent');
     $data = DB::table('investments')
       ->where($select, $value)
       ->groupBy($dependent)
       ->get();
     $output = '<option value="">Select '.ucfirst($dependent).'</option>';
     foreach($data as $row)
     {
     $investment_id = $row->id;
      $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
     }
     echo $output;
    }

    //to get investment_id
    function fetch2(Request $request)
    {
    $clientid = $request->get('clientid');
    $fundid = $request->get('fundid');
    $amount = $request->get('amount');
    
    $data2 = DB::table('investments')
       ->where([
        ['client_id', '=', $clientid],
        ['fund_id', '<>', $fundid],
        ['amount', '<>', $amount],
        ])
       ->get();
    foreach($data2 as $row2)
    $output2=$row2->id;
    echo $output2;
    }

    //submit form to cash flow table
    function submit(Request $request)
    {
    $investment_id = $request->get('investment_id');
    $date = $request->get('date');
    $Percentage = $request->get('Percentage');

    $add_cashflow = DB::table("cash_flows")->insert([
        'investment_id' => $investment_id,
        'date' => $date,
        'returnp' => $Percentage
    ]);
    if($add_cashflow){
        echo "done";
    }else{
        echo "Error";
    }
    }
    


}
