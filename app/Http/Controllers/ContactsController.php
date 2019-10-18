<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Contact;
use Illuminate\Http\Request;
use function GuzzleHttp\json_decode;

class ContactsController extends Controller
{
    //

    public function contactmsg(Request $request)
    {
        $response = "false";
        $msg = json_decode($request->arr);
        $contact = new Contact();
        $contact->email = $msg[0];
        $contact->message = $msg[1];
        if($contact->save()){
            $response = "true";
            echo json_encode($response);
            exit;
        }
        echo json_encode($response);
            exit;
    }

}
