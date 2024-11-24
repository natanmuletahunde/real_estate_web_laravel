<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use  App\Models\Admin\Admin;
use  App\Models\Prop\HomeType;
use  App\Models\Prop\Property;
use Illuminate\Http\Request;
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


    
    
}
