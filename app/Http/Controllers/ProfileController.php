<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function index()
    {
        $profiles = Profile::paginate(8);
        return view('admin.users.index', compact('profiles'));
    }
 
    public function trash()
    {
        $profiles = Profile::onlyTrashed()->paginate(3);
        return view('admin.users.index', compact('profiles'));
    } 

    public function create()
    {
        // $profiles;
        return view('admin.users.create', compact('profiles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'phone' => 'required|min:10|numeric',
        ]);
        $profiles = Profile::create($request->only('name', 'phone'));
        return back()->with('message', 'Customer Added Successfully!');
    }
    
    public function show(Profile $profile)
    {
        return view('admin.users.edit', compact('profile'));
    }

    public function profileUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:4',
            'phone' => 'required|numeric'
        ]);
    
        $profile = Profile::findOrFail($id);
        $profile->name = $request->get('name');
        $profile->phone = $request->get('phone');
        $profile->save();

        return back()->with('message', 'Profile Updated Successfully!');
    }

    public function edit($id)
    {
        $profile = Profile::find($id);
        return view('admin.users.edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:4',
            'phone' => 'required|numeric'
        ]);
    
        $profile = Profile::find($id);
        $profile->name = $request->get('name');
        $profile->phone = $request->get('phone');
        $profile->save();

        return back()->with('message', 'Profile Updated Successfully!');
    }

    public function recoverProfile($id)
    {
        $profile = Profile::onlyTrashed()->findOrFail($id);
        if($profile->restore())
            return back()->with('message','Profile Successfully Restored!');
        else
            return back()->with('message','Error Restoring Profile');
    }  

    public function destroy($id)
    {
        $profile = Profile::find($id);
        if($profile->delete()){
            return redirect('/admin/profile')->with('message','Profile Successfully Trashed!');
        }else{
            return redirect('/admin/profile')->with('message','Error Deleting Record');
        }
    }

    public function profileEdit($id)
    {
        $profile = Profile::find($id);
        $users = User::all();
        return view('layouts.partials.account', compact('profile', 'users'));
    }
}
