<?php

namespace App\Http\Controllers\Props;

use App\Http\Controllers\Controller;
use App\Models\Prop\Property;
use App\Models\Prop\PropImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prop\AllRequest;


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

        Request ()->validate([
       "name"=>'required|max:40',
       "email"=>'required|max:70',
       "phone"=>'required|max:50',
        ]);
        $insertRequest = AllRequest::create([
            'Prop_id' => $request->prop_id, // Using correct field name
            'agent_name' => $request->agent_name, // Corrected field name
            'user_id' => Auth::id(), // Get the authenticated user's ID
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);


        if($insertRequest){
          
            
        }
        echo "Request is completed";
    }
    
    
    
}
