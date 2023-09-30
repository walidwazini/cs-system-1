<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    // ? GET reuqest without a query/params
    // public function index()
    // {
    //     $allTickets = Ticket::with(['typeRef', 'statusRef', 'priorityRef'])->get();
    //     return response()->json([
    //         'message' => 'Succesfully retrieve all tickets !',
    //         'data' => $allTickets
    //     ]);
    // }

    public function index(Request $req)
    {
        $conditions = $req->all();
        $allTickets = Ticket::with(['typeRef', 'statusRef', 'priorityRef']);

        if (!empty($conditions)) {
            $allTickets = $allTickets->where($conditions)->get();
        } else {
            $allTickets = $allTickets->get();
            // $allTickets = Ticket::all();
        }

        return response()->json([
            'message' => 'Success!',
            'totalData' => count($allTickets),
            'data' => $allTickets
        ]);
    }

    public function show($id)
    {
        $ticket = Ticket::with(['typeRef', 'statusRef', 'priorityRef'])->where('id', $id)->first();

        if (empty($ticket)) {
            return response()->json([
                'message' => 'Data for id:' . $id . ' not found'
            ]);
        } else {
            return response()->json([
                'message' => 'Success.',
                'data' => $ticket
            ]);
        }
    }

    public function add(Request $req)
    {
        $newTicket = Ticket::create($req->all());
        return response()->json([
            'message' => 'Succefully add new ticket.',
            'data' => $newTicket
        ]);
    }

    public function update($id, Request $req)
    {
        $ticket = Ticket::where('id', $id)->update($req->all());

        if (empty($ticket)) {
            return response()->json([
                'message' => 'Data for id:' . $id . ' not found'
            ]);
        } else {
            return response()->json([
                'message' => 'Successfullly updated from Postman.',
                'data' => $ticket,
                'changes' => $req
            ]);
        }

    }

    public function delete($id, Request $request)
    {
        $ticket = Ticket::where('id', $id)->delete();

        if (empty($ticket)) {
            return response()->json(['message' => 'Data for id:' . $id . ' not found, delete fail.']);
        } else {

            return response()->json(['message' => 'Successfullly delete row with id:' . $id,]);
        }
    }
}