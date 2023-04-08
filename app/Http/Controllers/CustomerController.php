<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //

    public function customerPage()
    {
        return view('homepage.customer-main')->with('message', "You're logged in. Let's shopping!!");
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('warning', "You are logged out!");
    }

    public function customerRegister()
    {
        return view('homepage.customer-register');
    }

    public function customerProfile()
    {

        $id = Auth::user()->id;
        $customers = User::find($id);
       return view("homepage.customer-profile", compact('customers'));
    }

    public function customerEditProfile(Request $request)
    {
        $id = Auth::user()->id;
        $customers = User::find($id);

        // $request->validate([
        //     'first_name' =>'required|max:255',
        //     'last_name' =>'required|max:255',
        //     'email' =>'required|email|unique:customers,email',
        //     'password' =>'required|min:6|confirmed',
        // ]);

        $customers->username = $request->username;
        $customers->name = $request->name;
        $customers->address = $request->address;
        $customers->email = $request->email;
        $customers->phone = $request->phone;
        // $customers->password = bcrypt($request->password);

        $customers->save();

        session()->flash('info', 'Profile updated succesfully!');

        return back();
        // return back()->with('success', "Profile updated successfully!");
    }
}
