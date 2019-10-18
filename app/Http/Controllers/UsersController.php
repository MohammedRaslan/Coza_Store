<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\User;
use App\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    //

    public function userlist()
    {
        $notification = new Contact();
        $count = DB::table('contacts')->count();
        $notification = DB::table('contacts')->orderBy('id','desc')->get();
        $users = DB::table('users')->where("user_type",1)->get();
        return view('Admin_Portal.users.userlist')->with('users',$users)
        ->with('count',$count)->with('notification', $notification);
    }

    public function edit(User $user)
    {
        //
        $user = User::find($user->id);
        $notification = new Contact();
        $count = DB::table('contacts')->count();
        $notification = DB::table('contacts')->orderBy('id','desc')->get();
        $users = DB::table('users')->where("user_type",1)->get();
        return view('Admin_Portal.users.edit')->with('user',$user)
        ->with('count',$count)->with('notification', $notification);
    }

    public function Update(Request $request,User $user)
    {
        $userUpdate = User::where('id',$user->id)
        ->update([
            'name'      =>$request->input('name'),
            'email'     =>$request->input('email'),
            'user_type' =>$request->input('user_type')
        ]);
        if($userUpdate){
            return $this->userlist();
        }
        return back()->withInput();
    }

    public function destroyuser($id)
    {
        $finduser = User::find($id);
        $response = "false";
        if($finduser->delete()){
            $response = "true";
            echo json_encode($response);
            exit;
        }
            echo json_encode($response);
            exit;
    }

    public function adduser(Request $request)
    {
        $response["state"] = "false";
        
        $user = json_decode($request->arr);
        $userr = new User();
        $userr->name = $user[0];
        
        
        $userr->email = $user[1];
        $userr->password = bcrypt($user[2]);
        $userr->user_type = 1;
        $email = $user[1];
        if (User::where('email', '=', $user[1])->exists()) {
            $response["state"] = "false";
            echo json_encode($response);
                exit;
         }else {
            if ($userr->save()) {
                $response["state"] = "true";
                $response["userid"] = $userr->id;
                $response["created_at"] = $userr->created_at;
                echo json_encode($response);
                exit;
            }
            echo json_encode($response);
            exit;
        }
    }

    public function searchuser($id)
    {
        $response["state"] = "false";
        $user = new User();
        $user = User::find($id);
        if($user){
            $response["state"] = "true";
            $user =DB::table('users')->select('id','name','email','user_type','created_at')->where('id',$id)->where('user_type',1)->first();
            if($user){
                $response["result"] = $user;
                echo json_encode($response);
                exit;
            }else {
                $response["state"] = "false";
                echo json_encode($response);
                exit;
            }
            
        }
        echo json_encode($response);
        exit;
    }
}
