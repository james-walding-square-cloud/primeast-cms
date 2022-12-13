@extends('layouts.app')

@section('content')
    <div class="py-3">
        <div class="row"></div>
        <h1 class="text-center">Create Associate</h1>
        <hr>
    </div>
    <form action="/admin/associate/store" method="post">
        {{ csrf_field() }}
        <fieldset>
            <!-- Personal Details -->
            <div class="card m-2 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Personal Details</h5>
                    <div class="row col-12 px-5">
                        <input type="int" hidden name="user_id" value="{{$user_id}}">
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="title" class="form-label py-1">Title</label>
                            </div>
                            <div class="col-9">
                                <input required type="text" name='title' class="form-control" id="title" placeholder="Title">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="firstName" class="form-label py-1">First Name</label>
                            </div>
                            <div class="col-9">
                                <input required type="text" name='firstName' class="form-control" id="firstName" placeholder="First name">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="lastName" class="form-label py-1">Last Name</label>
                            </div>
                            <div class="col-9">
                                <input required type="text" name='lastName' class="form-control" id="lastName" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5">
                        <div class="col p-1 row">
                            <div class="col-2">
                                <label for="jobRole" class="form-label py-1">Job Role</label>
                            </div>
                            <div class="col-10">
                                <input type="text" name='jobRole' class="form-control" id="jobRole" placeholder="Job Role">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-2">
                                <label for="department" class="form-label py-1">Department</label>
                            </div>
                            <div class="col-10">
                                <input type="text" name='department' class="form-control" id="department" placeholder="Department">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Location -->
            <div class="card m-2 shadow-lg my-5">
                <div class="card-body">
                    <h5 class="card-title">Location</h5>
                    <div class="row col-12 px-5">
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="address1" class="form-label py-1">Address 1</label>
                            </div>
                            <div class="col-9">
                                <input required type="text" name='address1' class="form-control" id="address1" placeholder="Address 1">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="address2" class="form-label py-1">Address 2</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='address2' class="form-control" id="address2" placeholder="Address 2">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="address3" class="form-label py-1">Address 3</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='address3' class="form-control" id="address3" placeholder="Address 3">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5">
                        <div class="col p-1 row">
                            <div class="col">
                                <label for="city" class="form-label py-1">City</label>
                            </div>
                            <div class="col-9">
                                <input required type="text" name='city' class="form-control" id="city" placeholder="City">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="county" class="form-label py-1">County</label>
                            </div>
                            <div class="col-9">
                                <input required type="text"name='county' class="form-control" id="county" placeholder="County">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="postcode" class="form-label py-1">Postcode</label>
                            </div>
                            <div class="col-9">
                                <input required type="text" name='postcode' class="form-control" id="postcode" placeholder="Postcode">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="country" class="form-label py-1">Country</label>
                            </div>
                            <div class="col-9">
                                <select class="form-select" name="country" id="country">
                                    @foreach($countries as $country)
                                        <option value="{{$country->name}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Information -->
            <div class="card m-2 my-5 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Contact Information</h5>
                    <div class="row col-12 px-5 ">
                        <div class="col-3 p-1 row">
                            <div class="col-3">
                                <label for="phoneOffice" class="form-label py-1">Phone Office</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='phoneOffice' class="form-control" id="phoneOffice" placeholder="Phone Number (Office)">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="phoneHome" class="form-label py-1">Phone Home</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='phoneHome' class="form-control" id="phoneHome" placeholder="Phone Number (Home)">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="phoneMobile" class="form-label py-1">Phone Mobile</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='phoneMobile' class="form-control" id="phoneMobile" placeholder="Phone Number (Mobile)">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-3 p-1 row">
                            <div class="col-3">
                                <label for="email" class="form-label py-1">Email</label>
                            </div>
                            <div class="col-9">
                                <input required type="text" name='email' class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="secondaryEmail" class="form-label py-1">Secondary Email</label>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" id="secondaryEmail" placeholder="Secondary Email">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="linkedin" class="form-label py-1">Linkedin</label>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" id="linkedin" placeholder="Linkedin">
                            </div>
                        </div>
                    </div>
                    <h5>Emergency Contact</h5>
                    <div class="row col-12 px-5 ">
                        <div class="col-3 p-1 row">
                            <div class="col-3">
                                <label for="emergencyContactName" class="form-label py-1">Name</label>
                            </div>
                            <div class="col-9">
                                <input required type="text" name='emergencyContactName' class="form-control" id="emergencyContactName" placeholder="Full Name">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="emergencyContactPhone" class="form-label py-1">Phone</label>
                            </div>
                            <div class="col-9">
                                <input required type="text" name='emergencyContactPhone' class="form-control" id="emergencyContactPhone" placeholder="Phone Number">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="emergencyContactEmail" class="form-label py-1">Email</label>
                            </div>
                            <div class="col-9">
                                <input required type="text" name='emergencyContactEmail' class="form-control" id="emergencyContactEmail" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="col-2 float-end px-5 py-1">
                        <button type="submit" class="btn btn-success w-100">Save</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
@endsection
