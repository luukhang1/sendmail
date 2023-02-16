<?php

namespace App\Http\Controllers;

use App\Mail\Subscribe;
use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    public function __construct()
    {
    }
    //
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers'
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $email = $request->all()['email'];
        try {

            Mail::to($email)->send(new Subscribe($email));
            return new JsonResponse(
                [
                    'success' => true,
                    'message' => "Thank you for subscribing to our email, please check your inbox"
                ],
                200
            );
        } catch (\Exception $e) {
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ],
                400
            );
        }

    }
}
