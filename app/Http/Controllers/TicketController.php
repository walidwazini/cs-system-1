<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function index()
    {
        return response()->json([
            'message' => 'Succesfully retrieve all tickets !',
            'data' => Ticket::all()
        ]);
    }

    public function add(Request $req)
    {
        $newTicket = Ticket::create($req->all());
        return response()->json([
            'message' => 'Succefully add new ticket.',
            'data' => $newTicket
        ]);
    }
}