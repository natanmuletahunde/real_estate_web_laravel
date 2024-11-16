<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prop\AllRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Prop\SavedProp;

class UsersController extends Controller
{
    public function allRequests()
    {
         $allRequests = AllRequest::where('user_id',Auth::user()->id)->get();  
         return view('users.displayrequests', compact('allRequests')); 
    }

    public function allSavedProps()
    {
         $allSavedProps = SavedProp::where('user_id',Auth::user()->id)->get();  
         return view('users.displaysavedprops', compact('allSavedProps')); 
    }
}
