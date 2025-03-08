<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //jobsheet 4
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('1234'),
        // ];
        // UserModel::create($data);

        // $user = UserModel::find(1); 
        // $user = UserModel::where('level_id', 1)->first();
        $user = UserModel::firstwhere('level_id', 1);
        return view('user', ['data' => $user]);
    }
}
