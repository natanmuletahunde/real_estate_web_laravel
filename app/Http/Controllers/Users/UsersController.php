<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Prop\AllRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

 public  function allRequests(){
         $allrequests =  AllRequest::where('user_id',Auth::user()->id)->get();
         return view('users.displayrequests', compact('allrequests'));
    }
}
