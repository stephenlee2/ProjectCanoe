<?php

namespace App\Http\Controllers;
use App\Canoe;
use App\Fund;
use DB;

use Illuminate\Http\Request;

class CanoeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = DB::select('SELECT * FROM clients');
        return view('canoe.index')->with(['clients'=> $clients]);
    }

    public function show($id)
    {
        $funds = DB::select('SELECT * FROM funds');
        $client = DB::table('clients')->where('id', '=', $id)->first();
        return view('canoe.fundlists')->with(['client' => $client, 'funds' => $funds]);
    }

}
