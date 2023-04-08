@extends('homepage.main')

@section('content')

    {{-- @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
    </div>
    @endif


    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
    </div>
    @endif --}}

    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <ul class="nav nav-tabs" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Security</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Billing</button>
            </li>
        </ul>
        <hr class="mt-0 mb-4">

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Profile Picture</div>
                            <div class="card-body text-center">
                                <!-- Profile picture image-->
                                <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                <!-- Profile picture help block-->
                                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                <!-- Profile picture upload button-->
                                <button class="btn btn-primary" type="button">Upload new image</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Account Details</div>
                            <div class="card-body">
                                <form action="{{ route('customer.edit') }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <!-- Form Group (username)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                        <input class="form-control" id="inputUsername" type="text" name="username" placeholder="Enter your username" value="{{ $customers->username }}">
                                    </div>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (first name)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputFirstName">First name</label>
                                            <input class="form-control" id="inputFirstName" type="text" name="name" placeholder="Enter your first name" value="{{ $customers->name }}">
                                        </div>
                                        <!-- Form Group (last name)-->
                                        {{-- <div class="col-md-6">
                                            <label class="small mb-1" for="inputLastName">Last name</label>
                                            <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="Luna">
                                        </div> --}}
                                    </div>
                                    <!-- Form Row        -->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (organization name)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputOrgName">Organization name</label>
                                            <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="Start Bootstrap">
                                        </div>
                                        <!-- Form Group (location)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputLocation">Location</label>
                                            <input class="form-control" id="inputLocation" type="text" name="address" placeholder="Enter your location" value="{{ $customers->address }}">
                                        </div>
                                    </div>
                                    <!-- Form Group (email address)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                        <input class="form-control" id="inputEmailAddress" type="email" name="email" placeholder="Enter your email address" value="{{ $customers->email }}">
                                    </div>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (phone number)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputPhone">Phone number</label>
                                            <input class="form-control" id="inputPhone" name="phone" type="tel" placeholder="Enter your phone number" value="{{ $customers->phone }}">
                                        </div>
                                        <!-- Form Group (birthday)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputBirthday">Birthday</label>
                                            <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday" value="06/10/1988">
                                        </div>
                                    </div>
                                    <!-- Save changes button-->
                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="container-xl px-4 mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Change password card-->
                            <div class="card mb-4">
                                <div class="card-header">Change Password</div>
                                <div class="card-body">
                                    <form>
                                        <!-- Form Group (current password)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="currentPassword">Current Password</label>
                                            <input class="form-control" id="currentPassword" type="password" placeholder="Enter current password">
                                        </div>
                                        <!-- Form Group (new password)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="newPassword">New Password</label>
                                            <input class="form-control" id="newPassword" type="password" placeholder="Enter new password">
                                        </div>
                                        <!-- Form Group (confirm password)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                                            <input class="form-control" id="confirmPassword" type="password" placeholder="Confirm new password">
                                        </div>
                                        <button class="btn btn-primary" type="button">Save</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Security preferences card-->
                            {{-- <div class="card mb-4">
                                <div class="card-header">Security Preferences</div>
                                <div class="card-body">
                                    <!-- Account privacy optinos-->
                                    <h5 class="mb-1">Account Privacy</h5>
                                    <p class="small text-muted">By setting your account to private, your profile information and posts will not be visible to users outside of your user groups.</p>
                                    <form>
                                        <div class="form-check">
                                            <input class="form-check-input" id="radioPrivacy1" type="radio" name="radioPrivacy" checked="">
                                            <label class="form-check-label" for="radioPrivacy1">Public (posts are available to all users)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="radioPrivacy2" type="radio" name="radioPrivacy">
                                            <label class="form-check-label" for="radioPrivacy2">Private (posts are available to only users in your groups)</label>
                                        </div>
                                    </form>
                                    <hr class="my-4">
                                    <!-- Data sharing options-->
                                    <h5 class="mb-1">Data Sharing</h5>
                                    <p class="small text-muted">Sharing usage data can help us to improve our products and better serve our users as they navigation through our application. When you agree to share usage data with us, crash reports and usage analytics will be automatically sent to our development team for investigation.</p>
                                    <form>
                                        <div class="form-check">
                                            <input class="form-check-input" id="radioUsage1" type="radio" name="radioUsage" checked="">
                                            <label class="form-check-label" for="radioUsage1">Yes, share data and crash reports with app developers</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="radioUsage2" type="radio" name="radioUsage">
                                            <label class="form-check-label" for="radioUsage2">No, limit my data sharing with app developers</label>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
                        </div>
                        {{-- <div class="col-lg-4">
                            <!-- Two factor authentication card-->
                            <div class="card mb-4">
                                <div class="card-header">Two-Factor Authentication</div>
                                <div class="card-body">
                                    <p>Add another level of security to your account by enabling two-factor authentication. We will send you a text message to verify your login attempts on unrecognized devices and browsers.</p>
                                    <form>
                                        <div class="form-check">
                                            <input class="form-check-input" id="twoFactorOn" type="radio" name="twoFactor" checked="">
                                            <label class="form-check-label" for="twoFactorOn">On</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="twoFactorOff" type="radio" name="twoFactor">
                                            <label class="form-check-label" for="twoFactorOff">Off</label>
                                        </div>
                                        <div class="mt-3">
                                            <label class="small mb-1" for="twoFactorSMS">SMS Number</label>
                                            <input class="form-control" id="twoFactorSMS" type="tel" placeholder="Enter a phone number" value="555-123-4567">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Delete account card-->
                            <div class="card mb-4">
                                <div class="card-header">Delete Account</div>
                                <div class="card-body">
                                    <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below.</p>
                                    <button class="btn btn-danger-soft text-danger" type="button">I understand, delete my account</button>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">fsdlf</div>
        </div>


        {{-- initial nav --}}
        {{-- <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="">Profile</a>
            <a class="nav-link" href="{{  route('customer.home') }}" >Billing</a>
            <a class="nav-link" href="" >Security</a>
            <a class="nav-link" href=""  >Notifications</a>
        </nav>
        <hr class="mt-0 mb-4"> --}}
        
    </div>
    
@endsection