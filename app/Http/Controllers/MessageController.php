<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageMail;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        // cant add mailtrap addon on heroku because it is not free
        // but on local machine it is working 

        // Mail::to(env('MAIL_FROM_ADDRESS'))->send(new MessageMail($request));

        return response()->json(['message' => 'You successfully sent message to Pizza House!']);
    }
}
