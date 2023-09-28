<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function index(){
        return response() -> json([
            'message' => 'Succesfully retrieve all tickets !'
        ]);
    }
}
