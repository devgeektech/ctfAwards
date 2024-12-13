<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        try{
            return view('admin.dashboard');
        }catch(Exception $e){
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function createdAccount(){
        try{
            return view('admin.createdAccount');
        }catch(Exception $e){
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
