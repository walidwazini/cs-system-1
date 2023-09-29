<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private $allTickets ;
    //
    public function index()
    {
        $allTickets = Ticket::with(['typeRef','statusRef','priorityRef'])->get();
        return response()->json([
            'message' => 'Succesfully retrieve all tickets !',
            // 'data' => Ticket::all()
            'data' => $allTickets
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