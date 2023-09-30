<?php

namespace App\Http\Controllers;

use App\Models\TicketComment;
use Illuminate\Http\Request;

class TicketCommentController extends Controller
{
    public function index($ticketId)
    {
        // TicketComment::class;
        $allComments = TicketComment::where('ticket_id', $ticketId)->get();
        
        
        return response()->json(['message' => 'Success!', 'data' => $allComments]);
    }

    public function show($ticketId,$id)
    {
        $comment = TicketComment::where('id',$id)->first();

        if (empty($comment)) {
            return response()->json([
                'message' => 'Comment for id:' . $id . ' not found'
            ]);
        } else {
            return response()->json([
                'message' => 'Success.',
                'data' => $comment
            ]);
        }
    }

    public function store($ticketId, Request $request)
    {
        $input = $request->all();
        $input['ticket_id'] = $ticketId;
        $newComment = TicketComment::create($input);

        return response()->json(['data' => $newComment]);
    }

    public function delete($ticketId, $id)
    {
        // TicketComment::where('id',$id)->delete();
        $comment = TicketComment::where('id',$id)->delete();

        if (empty($comment)) {
            return response()->json('No comment found!');
        } else {
            // $comment->delete();
            return response()->json(['message' => 'Succesfully delete comment']);
        }

    }
}