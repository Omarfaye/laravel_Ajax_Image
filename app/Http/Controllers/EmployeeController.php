<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        return view('index');
    }

    //gérer l'insertion de la requête ajax de l'employeur
    public function store(Request $request){
       // print_r($_POST);
       // print_r($_FILES);

        $file =$request->file('avatar');
        $fileName = time() . '.' .$file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $empData = [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'post' => $request->post,
            'avatar' => $fileName
        ];

       Employee::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }
}
