<?php

namespace App\Http\Controllers;

use App\User;
use App\Parents;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = Parents::with(['user','children'])->latest()->paginate(10);
        
        return view('backend.parents.index', compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.parents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'nullable|string|email|max:255|unique:users',
            'password'          => 'required|string|min:8',
            'phone'             => 'required|string|max:255',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
        
        if ($request->hasFile('profile_picture')) {
            $profile = Str::slug($user->name).'-'.$user->id.'.'.$request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('images/profile'), $profile);
        } else {
            $profile = 'avatar.png';
        }
        $user->update([
            'profile_picture' => $profile
        ]);

        $user->parent()->create([
            'phone'             => $request->phone,
        ]);

        $user->assignRole('ene_ata');

        session()->flash('message', 'Üstünlikli ýerine ýetirildi');
        return redirect()->route('parents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function show(Parents $parents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parent = Parents::with('user')->findOrFail($id); 

        return view('backend.parents.edit', compact('parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $parents = Parents::findOrFail($id);

        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'nullable|string|email|max:255|unique:users,email,'.$parents->user_id,
            'phone'             => 'required|string|max:255',
        ]);

        if ($request->hasFile('profile_picture')) {
            $profile = Str::slug($parents->user->name).'-'.$parents->user->id.'.'.$request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('images/profile'), $profile);
        } else {
            $profile = $parents->user->profile_picture;
        }

        $parents->user()->update([
            'name'              => $request->name,
            'email'             => $request->email,
            'profile_picture'   => $profile
        ]);

        $parents->update([
            'phone'             => $request->phone,
        ]);

        session()->flash('message', 'Üstünlikli ýerine ýetirildi');
        return redirect()->route('parents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parent = Parents::findOrFail($id);

        $user = User::findOrFail($parent->user_id);
        $user->removeRole('ene_ata');

        if ($user->delete()) {
            if($user->profile_picture != 'avatar.png') {
                $image_path = public_path() . '/images/profile/' . $user->profile_picture;
                if (is_file($image_path) && file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }

        $parent->delete();
        
        session()->flash('message', 'Üstünlikli ýerine ýetirildi');
        return back();
    }
}
