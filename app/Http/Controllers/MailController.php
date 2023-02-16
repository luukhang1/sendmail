<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send()
    {
        $title = \request()->get('title', 'Xin Chao be iu');
        $message = \request()->get('message', "This is a mail from boyfriend to girlfriend.");
        $data = array('title' => $title, 'message' => $message);
        Mail::to('hoangthianh1704@gmail.com')->send(new SendMail($data));
        return redirect('/admin');
    }

    public function showView(Request $request)
    {

        return view('show-send-mail');
    }
}
