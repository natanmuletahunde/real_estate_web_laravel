<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use  App\Models\Admin\Admin;
use  App\Models\Prop\AllRequest;
use  App\Models\Prop\HomeType;
use  App\Models\Prop\Property;
use  App\Models\Prop\PropImage;
use Illuminate\Http\Request;
use App\Models\File;
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
        return view('admins.hometypes', compact('allHomeTypes'));
    }

    public function createHomeTypes()
    {

        return view('admins.createHometypes');
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
        return view('admins.editHometypes', compact('hometype'));
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
        return view('admins.requests', compact('requests'));
    }
    public function allProps()
    {
        $props = Property::all();
        return view('admins.props', compact('props'));
    }

    public function createProps()
    {
        return view('admins.createprops');
    }

    protected function storeProps(Request $request)
    {
        // Request()->validate([
        //    'hometypes' => ' required|max:40'
        // ]);

        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);
        $storeProps = Property::create([
            'title' => $request->title,
            'price' => $request->price,
            'image' => $myimage,
            'beds' => $request->beds,
            'baths' => $request->baths,
            'sq_ft' => $request->sq_ft,
            'year_built' => $request->year_built,
            'price_sqFt' => $request->price_sqFt,
            'location' => $request->location,
            'home_type' => $request->home_type,
            'type' => $request->type,
            'city' => $request->city,
            'more_info' => $request->more_info,
            'agent_name' => $request->agent_name,

        ]);

        if ($storeProps) {
            return redirect('admin/all-props/')->with('success', ' Property  Added successfully');
        }
    }


    public function createGallery()
    {
        return view('admins.creategallery');
    }



    public function storeGallery(Request $request)
    {
        // $this->validate($request, [
        //     'file_names' => 'required',
        //     'file_names.*' => 'image'
        // ]);
    
        
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {
                $path = "assets/images_gallery/";
                $name = time() . rand(1, 50) . '.' . $file->extension();
                $file->move(public_path($path), $name);
                $files[] = $name;
    
                PropImage::create([
                    "image" => $name,
                    "Prop_id" => $request->Prop_id, // Fixed the reference to $prop_id
                ]);
            }
        }
    
        // $file = new File(); // Correctly reference the File model
        // $file->filenames = $files;
        // $file->save();
    
        if ($name) {
            return redirect('admin/all-props/')->with('success_gallery', ' Gallery  Added successfully');
        }    
    }

    public function deleteProps($id)
    {
        $deleteProp = Property::find($id);

        if(File::exists(public_path('assets/images/' . $deleteProp->image))){
            File::unlink(public_path('assets/images/' . $deleteProp->image));
        }else{
            //dd('File does not exists.');
        }

        $deleteProp->delete();
        return view('admins.creategallery');
    }

      
    
}
