<?php

namespace App\Http\Controllers\Props;

use App\Http\Controllers\Controller;
use App\Models\Prop\Property;
use App\Models\Prop\PropImage;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;
use App\Models\Prop\Allrequest;


class PropertiesController extends Controller
{
  

    public function index(){
        $props = Property::select()->take(9)->orderBy('created_at','desc')->get();
        return view('home', compact('props'));
    }

    public function single($id){
        $singleProp = Property::find($id);
        $propImages= PropImage::where('prop_id',$id)->get();

        // related Prop
        $relatedProps = Property::where('home_type',$singleProp->home_type )->where('id','!=',$id)->take(3)->orderBy('created_at','desc')->get();
        return view('props.single', compact('singleProp','propImages' , 'relatedProps' ));
    }

    public function insertRequests(Request $request){
       $insertRequest = Property::create([
        'prop_id'=>$request->prop_id,
        'agent_name'=>$request->agent_id,
        'user_id'=>Auth::user()->name,
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
       ]) ;
       echo " request is completed";
    }
    
}
