<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    public function update()
    {
        $user = Auth::user();
        return view('profile-update', compact('user'));
    }
    public function save(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'min:15'],
            'phone' => ['required', 'numeric', 'digits_between:11,15']
        ]);
        if (!Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        if ($user->save()) {
            return redirect()->route('profile')->with('success', "Update Profile Success!");
        }
    }
}
