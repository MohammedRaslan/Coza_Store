<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeesController extends Controller
{
    //

    public function employeeList(){
        $employees = DB::table('users')->where("user_type",2)->get();
        $notification = new Contact();
        $count = DB::table('contacts')->count();
        $notification = DB::table('contacts')->orderBy('id','desc')->get();
        return view('Admin_Portal.users.employeelist')->with('employees',$employees)->with('count',$count)->with('notification', $notification);
    }

    public function addemployee(Request $request)
    {
        $response["state"] = "false";
        
        $employee = json_decode($request->arr);
        $employeemodel = new User();
        $employeemodel->name = $employee[0];
        
        
        $employeemodel->email = $employee[1];
        $employeemodel->password = bcrypt($employee[2]);
        $employeemodel->user_type = 2;
        $email = $employee[1];
        if (User::where('email', '=', $employee[1])->exists()) {
            $response["state"] = "false";
            echo json_encode($response);
                exit;
         }else {
            if ($employeemodel->save()) {
                $response["state"] = "true";
                $response["userid"] = $employeemodel->id;
                $response["created_at"] = $employeemodel->created_at;
                echo json_encode($response);
                exit;
            }
            echo json_encode($response);
            exit;
        }
    }

    public function delete($id)
    {
        $findemployee = User::find($id);
        $response = "false";
        if($findemployee->delete()){
            $response = "true";
            echo json_encode($response);
            exit;
        }
            echo json_encode($response);
            exit;
    }

    public function searchemployee($id)
    {
        $response["state"] = "false";
        $employee = new User();
        $employee = User::find($id);
        if($employee){
            $response["state"] = "true";
            $employee =DB::table('users')->select('id','name','email','user_type','created_at')->where('id',$id)->where('user_type',2)->first();
            if($employee){
                $response["result"] = $employee;
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

    public function edit(User $employee)
    {
        //
        $employee = User::find($employee->id);
        $notification = new Contact();
        $count = DB::table('contacts')->count();
        $notification = DB::table('contacts')->orderBy('id','desc')->get();
        return view('Admin_Portal.users.editemp')->with('employee',$employee)->with('count',$count)->with('notification', $notification);
        //return view('Admin_Portal.users.editemp',['employee' => $employee]);
    }

    public function Update(Request $request,User $employee)
    {
        $employeeUpdate = User::where('id',$employee->id)
        ->update([
            'name'      =>$request->input('name'),
            'email'     =>$request->input('email'),
            'user_type' =>$request->input('user_type')
        ]);
        if($employeeUpdate){
            return $this->employeeList();
        }
        return back()->withInput();
    }
}
