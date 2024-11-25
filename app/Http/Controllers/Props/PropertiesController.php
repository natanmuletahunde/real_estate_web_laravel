<?php

namespace App\Http\Controllers\Props;

use App\Http\Controllers\Controller;
use App\Models\Prop\AllRequest;
use App\Models\Prop\Property;
use App\Models\Prop\PropImage;
use App\Models\Prop\SavedProp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PropertiesController extends Controller
{


    public function index()
    {
        $props = Property::take(9)->orderBy('id', 'DESC')->get();
        return view('home', compact('props'));
    }

    public function single($id)
    {
        $singleProp = Property::find($id);
        $propImages = PropImage::where('prop_id', $id)->get();

        // related Prop
        $relatedProps = Property::where('home_type', $singleProp->home_type)->where('id', '!=', $id)->take(3)->orderBy('created_at', 'desc')->get();
        // validating form request
        $validatingFormCount = AllRequest::where('prop_id', $id)->where('user_id', Auth::user()->id)->count(); // this code snippet count the number of the request that are much for both prop_id and user_id;;
        

        // validailing saving Props

        $validatingSavingPropsCount = SavedProp::where('prop_id', $id)->where('user_id', Auth::user()->id)->count(); // this code snippet count the number of the request that are much for both prop_id and user_id;;



        return view('props.single', compact('singleProp', 'propImages', 'relatedProps','validatingFormCount','validatingSavingPropsCount'));
    }

    public function insertRequests(Request $request)
    {

        Request()->validate([
            "name" => 'required|max:40',
            "email" => 'required|max:70',
            "phone" => 'required|max:50',
        ]);
        $insertRequest = AllRequest::create([
            'Prop_id' => $request->prop_id, // Using correct field name
            'agent_name' => $request->agent_name, // Corrected field name
            'user_id' => Auth::id(), // Get the authenticated user's ID
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);


        if ($insertRequest) {
            return redirect('props/prop-details/' . $request->prop_id . '')->with('success', 'Request added  successfuly');
        }
        echo "Request is completed";
    }

    public function saveProps(Request $request)
    {

        // Request()->validate([
        //     "name" => 'required|max:40',
        //     "email" => 'required|max:70',
        //     "phone" => 'required|max:50',
        // ]);
        $saveProp = SavedProp::create([
            'prop_id' => $request->prop_id, 
            'user_id' => Auth::id(),// Using correct field name
            'title' => $request->title, // Corrected field nam
            'image' => $request->image,
            'location' => $request->location,
            'price' => $request->price,
        ]);


        if ($saveProp) {
            return redirect('props/prop-details/' . $request->prop_id . '')->with('save', 'Property saved  successfuly');
        }
        echo "Request is completed";
    }

    
    public function propsBuy()
    {    
        
        $type = "buy";
        $propsBuy = Property::select()->where('type',$type)->get();
        return view('props.propsbuy', compact('propsBuy'));
    }
    public function propsRent()
    {    
        
        $type = "rent";
        $propsRent = Property::select()->where('type',$type)->get();
        return view('props.propsrent', compact('propsRent'));
    }

    public function displayByHomeType($hometype)
    {    
        
        
        $propsByHomeType = Property::select()->where('home_type',$hometype)->get();
        return view('props.propshometype', compact('propsByHomeType', 'hometype'));
    }

    
    public function priceAsc()
    {    
        $propsByPriceAsc = Property::select()->take(9)->orderBy('price','asc')->get();
        return view('props.propspriceasc', compact('propsByPriceAsc'));
    }

    public function priceDesc()
    {    
        $propsByPriceAsc = Property::select()->take(9)->orderBy('price','desc')->get();
        return view('props.propspricedesc', compact('propsByPriceDesc'));
    }
    // searching for props 
    public function searchProps(Request $request)
    {    
        $list_types = $request->get('list_list');
        $offer_types = $request->get('offer_types');
        $select_city = $request->get('select_city');
        $searches=Property::select()->where('home_type','like',"%$list_types%")->where('type','likes',"%$offer_types%")->where('city','like',"%$select_city")->get();
        return view('props.searches', compact('searches'));
    }
}














