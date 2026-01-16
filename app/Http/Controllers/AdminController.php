<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('message', "You've succesfully logout");
    }

    public function adminDashboard()
    {

        $numberOfUsers = User::where('role', 'user')->count();
        $numberOfVendors = User::where('role', 'vendor')->count();
        $products = Products::count();
        $sales = Order::where('status', 'Delivered')->sum('amount');
        // $latest_sales = Order::where('status', 'Delivered')->whereDate('created_at', Carbon::today())->sum('amount');
        $users = User::where('role', 'user')->latest()->get();

        // dd($latest_sales);
        return view('admin.index', compact('numberOfUsers', 'products', 'sales', 'numberOfVendors', 'users'));
    }

    // for user profile setting
    public function profile()
    {

        // get user id who is currently login(authenticated)
        $id = Auth::user()->id;
        // find who is login
        $admin = User::find($id);

        return view('admin.admin-profile', compact('admin'));

    }

    public function editProfile()
    {
        // edit admin profile

        $id = Auth::user()->id;
        // find who is login
        $admin = User::find($id);

        return view('admin.admin-edit-profile', compact('admin'));

    }

    public function storeProfile(Request $request)
    {
        // need id
        $id = Auth::user()->id;
        // find who is login
        $admin = User::find($id);

        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;

        // for file type image
        if ($request->file('photo')) {
            $image = $request->file('photo');

            // change image name
            $imageName = date('YMdHi').$image->getClientOriginalName(); // generate date
            // move file
            $image->move(public_path('upload/admin-photo'), $imageName);  // create new folder to store uploaded images
            $admin['photo'] = $imageName; // add new photo to db
        }

        $admin->save();

        // toastr notifications
        // $noti = array(
        //     'message' => "Admin profile updated succesfully",
        //     'session' => 'success'

        // );

        return redirect()->route('admin.profile')->with('message', 'Admin profile updated succesfully');
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

    public function manageVendor()
    {
        /**
         * write condition query to get vendor
         * using status,role column
         */
        $active_vendor = User::where('role', 'vendor')->latest()->get();  // to display both status
        // $active_vendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();

        // only use one datatable
        // $inactive_vendor = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();

        return view('admin.manage-vendor', compact('active_vendor'));
    }

    public function detailsVendor($id)
    {
        // $inactive_vendor = User::find($id);  // return null value if id not found

        // preferred method to catch exception and handling error
        $inactive_vendor = User::findOrFail($id);

        return view('admin.vendor-details', compact('inactive_vendor'));
    }

    public function activateVendor(Request $request)
    {
        // $id = Auth::user()->id;
        $id = $request->id;

        // update only status columns form inactive to active
        $inactive_vendor = User::findOrFail($id)->update([
            'status' => 'active',
        ]);

        // session
        session()->flash('message', 'Vendor activated succesfully');

        // return to same page
        return redirect('/admin/manage/vendor');
    }

    public function detailsActiveVendor($id)
    {
        // $inactive_vendor = User::find($id);  // return null value if id not found

        // preferred method to catch exception and handling error
        $active_vendor = User::findOrFail($id);

        return view('admin.vendor-active-details', compact('active_vendor'));
    }

    public function deactivateVendor(Request $request)
    {
        // $id = Auth::user()->id;
        $id = $request->id;

        // update only status columns form inactive to active
        $active_vendor = User::findOrFail($id)->update([
            'status' => 'inactive',
        ]);

        // session
        session()->flash('message', 'Vendor has been deactivated');

        // return to same page
        return redirect()->route('admin.manage_vendor');
    }
}
