<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reference;

class ReferenceController extends Controller
{
    public function index(Request $request)
    {
        $conditions = $request->all();
        $references = app(Reference::class);

        if (!empty($conditions)) {
            $references = $references->where($conditions);
        }

        $references = $references->get();

        return response()->json([
            'message'=> 'success',
            'data' => $references
        ]);
    }
}