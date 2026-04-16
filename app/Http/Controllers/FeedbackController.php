<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([

            'aspirasi_id'=>'required',
            'feedback'=>'required'

        ]);

        Feedback::create([

            'aspirasi_id'=>$request->aspirasi_id,
            'admin_id'=>Auth::id(),
            'feedback'=>$request->feedback

        ]);

        return back()->with('success','Feedback berhasil ditambahkan');
    }

}
