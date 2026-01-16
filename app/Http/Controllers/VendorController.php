<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function vendorRegister()
    {
        return view('vendor.vendor-register');
    }

    public function vendorLogin()
    {
        //
        return view('vendor.vendor-login');
    }

    public function vendorDashboard()
    {
        //
        return view('vendor.dashboard');
    }

    public function vendorLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login')->with('message', "You've succesfully logout");
    }

    public function vendorNewRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // add for username field
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);

        User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'vendor',  // assign directly without admin actions
            'status' => 'inactive',

        ]);

        // alert
        session()->flash('alert-success', 'You have successfully registered!');

        return redirect('/vendor/login')->with('message', 'You have successfully registered!');

    }

    public function vendorProfile()
    {

        // get user id who is currently login(authenticated)
        $id = Auth::user()->id;
        // find who is login
        $vendor = User::find($id);

        return view('vendor.vendor-profile', compact('vendor'));

    }

    public function editVendorProfile()
    {
        // edit admin profile

        $id = Auth::user()->id;
        // find who is login
        $vendor = User::find($id);

        return view('vendor.vendor-edit-profile', compact('vendor'));

    }

    public function storeVendorProfile(Request $request)
    {
        // need id
        $id = Auth::user()->id;
        // find who is login
        $vendor = User::find($id);

        $vendor->name = $request->name;
        $vendor->username = $request->username;
        $vendor->email = $request->email;
        $vendor->vendor_register_date = $request->vendor_register_date;
        $vendor->vendor_info = $request->vendor_info;

        // for file type image
        if ($request->file('photo')) {
            $image = $request->file('photo');

            // change image name
            $imageName = date('YMdHi').$image->getClientOriginalName(); // generate date
            // move file
            $image->move(public_path('upload/vendor-photo'), $imageName);  // create new folder to store uploaded images
            $vendor['photo'] = $imageName; // add new photo to db
        }

        $vendor->save();

        return redirect()->route('vendor.profile')->with('message', 'Vendor profile updated succesfully');
    }

    public function changePasswordProfile()
    {
        return view('admin.change-password');
    }

    public function updatePasswordProfile(Request $request)
    {
        // validation
        $validateData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required | same:new_password',
        ]);

        $hashedPassword = Auth::user()->password;

        // check whether old password matched in DB
        if (Hash::check($request->old_password, $hashedPassword)) {
            // old password
            $users = User::find(Auth::id());

            // hash new password
            $users->password = bcrypt($request->new_password);
            $users->save();

            // session flash noti
            session()->flash('message', 'Password updated succesfully');

            // return to same page
            return redirect()->back();
        } else {
            session()->flash('error', 'Old password does not match!!');

            // return to same page
            return redirect()->back();
        }
    }
}
