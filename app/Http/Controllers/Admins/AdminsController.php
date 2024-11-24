<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use  App\Models\Admin\Admin;
use  App\Models\Prop\HomeType;
use  App\Models\Prop\Property;
use Illuminate\Http\Request;
use  App\Models\Prop\AllRequest;
use Illuminate\Support\Facades\Hash;



class AdminsController extends Controller
{



    public function viewLogin()
    {

        return view('admins.login');
    }

    public function checkLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect()->route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function index()
    {

        $adminsCount = Admin::select()->count();
        $propCount = Property::select()->count();
        $hometypesCount = HomeType::select()->count();
        return view('admins.index', compact('adminsCount', 'propCount', 'hometypesCount'));
    }


    public function allAdmins()
    {

        $allAdmins = Admin::select()->get();
        return view('admins.admins', compact('allAdmins'));
    }

    public function createAdmins()
    {
        return view('admins.createadmins');
    }

    protected function storeAdmins(Request $request)
    {
        Request()->validate(rules: [
            'name' => ' required|max:40',
            'email' => ' required|max:40',
            'password' => ' required|max:40',

         ]);
        $storesAdmins = Admin::create([
            'name' => $request->name,
            'email' => $request->email, // Fixed from $request->name to $request->email
            'password' => Hash::make($request->password), // Fixed $$request->password to $request->password
        ]);

        if ($storesAdmins) {
            return redirect('admin/all-admins/')->with('success', 'Admin Added successfully');
        }
    }


    public function allHomeTypes()
    {
        $allHomeTypes = HomeType::select()->get();
        return view('admins.hometypes' , compact('allHomeTypes'));
    }

    public function createHomeTypes()
    {

        return view('admins.createHometypes' );
    }

    //   it is hometype store

    protected function storeHomeTypes(Request $request)
    {
        Request()->validate([
           'hometypes' => ' required|max:40'
        ]);
        $storesHometypes = HomeType::create([
            'hometypes' => $request->hometypes,
        ]);

        if ($storesHometypes) {
            return redirect('admin/all-hometypes/')->with('success', 'Home type Added successfully');
        }
    }


    public function editHomeTypes($id)
    {
         $hometype = HomeType::find($id);
        return view('admins.editHometypes' ,compact('hometype' ));
    }


    // updated the hometype 

    protected function updateHomeTypes(Request $request, $id)
    {
        Request()->validate([
           'hometypes' => ' required|max:40'
        ]);
        $singleHometype = HomeType::find($id);
        $singleHometype->update($request->all());
        if ($singleHometype) {
            return redirect('admin/all-hometypes/')->with('update', 'Home type update  successfully');
        }
    }

    public function deleteHomeTypes($id)
    {
         $homeType = HomeType::find($id);
         $homeType->delete();

         if ($homeType) {
            return redirect('admin/all-hometypes/')->with('delete', 'Home type deleted successfully');
        }        
}
public function Requests()
{
     $requests = AllRequest::all();
    return view('admins.requests' ,compact('requests' ));
}
public function allProps()
{
     $props = Property::all();
    return view('admins.props' ,compact('props' ));
}

public function createProps()
{
    return view('admins.createprops');
}

}
