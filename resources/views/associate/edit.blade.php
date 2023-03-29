@extends('layouts.app')

@section('content')
    <div class="py-3">
        <div class="row"></div>
        <h1 class="text-center">{{$associate->first_name . ' ' . $associate->last_name}}</h1>
        <hr>
    </div>
    <form action="/admin/associate/update/{{$associate->user_id}}" method="post">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <fieldset>
            <!-- Personal Details -->
            <div class="card m-2 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Personal Details</h5>
                    <div class="row col-12 px-5">
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="title" class="form-label py-1">Title</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='title' class="form-control" id="title" value="{{$associate->title}}" placeholder="{{$associate->title}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="firstName" class="form-label py-1">First Name</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='firstName' class="form-control" id="firstName" value="{{$associate->first_name}}" placeholder="{{$associate->first_name}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="lastName" class="form-label py-1">Last Name</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='lastName' class="form-control" id="lastName" value="{{$associate->last_name}}" placeholder="{{$associate->last_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5">
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="company" class="form-label py-1">Company</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='company' class="form-control" id="company" value="{{$associate->company}}" placeholder="{{$associate->company}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="jobRole" class="form-label py-1">Job Role</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='jobRole' class="form-control" id="jobRole" value="{{$associate->job_role}}" placeholder="{{$associate->job_role}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="department" class="form-label py-1">Department</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='department' class="form-control" id="department" value="{{$associate->department}}" placeholder="{{$associate->department}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5">
                        <div class="col-9 p-1 row">
                            <div class="col-1">
                                <label for="summary" class="form-label py-1">Summary</label>
                            </div>
                            <div class="col-11 ps-5">
                                <textarea name='summary' rows="2" class="form-control" id="elevatorPitch" value="{{$associate->associateData->summary}}" placeholder="{{$associate->associateData->summary ?? 'Summary'}}">{{$associate->associateData->summary ?? 'Summary'}}</textarea>
                            </div>
                        </div>
                        <div class="col row">
                            <div class="col-3">
                                <label for="dateOfBirth" class="form-label py-1">Date Of Birth</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="date" name='dateOfBirth' class="form-control" id="dateOfBirth" value="{{$associate->date_of_birth}}">
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
                                <input readonly type="text" name='address1' class="form-control" id="address1" value="{{$associate->address1}}" placeholder="{{$associate->address1}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="address2" class="form-label py-1">Address 2</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='address2' class="form-control" id="address2" value="{{$associate->address2}}" placeholder="{{$associate->address2}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="address3" class="form-label py-1">Address 3</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='address3' class="form-control" id="address3" value="{{$associate->address3}}" placeholder="{{$associate->address3}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5">
                        <div class="col p-1 row">
                            <div class="col">
                                <label for="city" class="form-label py-1">City</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='city' class="form-control" value="{{$associate->city}}" id="city" placeholder="{{$associate->city}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="county" class="form-label py-1">County</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text"name='county' class="form-control" id="county" value="{{$associate->county}}" placeholder="{{$associate->county}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="postcode" class="form-label py-1">Postcode</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='postcode' class="form-control" id="postcode" value="{{$associate->postcode}}" placeholder="{{$associate->postcode}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="country" class="form-label py-1">Country</label>
                            </div>
                            <div class="col-9">
                                <select class="form-select" name="country" id="country">
                                    @foreach($countries as $country)
                                        <option {{$country->name == $selected_country ? 'selected' : ''}} value="{{$country->name}}">{{$country->name}}</option>
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
                                <input readonly type="text" name='phoneOffice' class="form-control" id="phoneOffice" value="{{$associate->phone_office}}" placeholder="{{$associate->phone_office}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="phoneHome" class="form-label py-1">Phone Home</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='phoneHome' class="form-control" id="phoneHome" value="{{$associate->phone_home}}" placeholder="{{$associate->phone_home}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="phoneMobile" class="form-label py-1">Phone Mobile</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='phoneMobile' class="form-control" id="phoneMobile" value="{{$associate->phone_mobile}}" placeholder="{{$associate->phone_mobile}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-3 p-1 row">
                            <div class="col-3">
                                <label for="email" class="form-label py-1">Email</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" class="form-control" id="email" value="{{$associate->email}}" placeholder="{{$associate->email}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="secondaryEmail" class="form-label py-1">Secondary Email</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" class="form-control" id="secondaryEmail" value="{{$associate->secondary_email}}" placeholder="{{$associate->secondary_email}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="linkedin" class="form-label py-1">Linkedin</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" class="form-control" id="linkedin" value="{{$associate->linkedin}}" placeholder="{{$associate->linkedin}}">
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
                                <input readonly type="text" name='emergencyContactName' class="form-control" id="emergencyContactName" value="{{$associate->emergency_contact_name}}" placeholder="{{$associate->emergency_contact_name}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="emergencyContactPhone" class="form-label py-1">Phone</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='emergencyContactPhone' class="form-control" id="emergencyContactPhone" value="{{$associate->emergency_contact_phone}}" placeholder="{{$associate->emergency_contact_phone}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="emergencyContactEmail" class="form-label py-1">Email</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='emergencyContactEmail' class="form-control" id="emergencyContactEmail" value="{{$associate->emergency_contact_email}}" placeholder="{{$associate->emergency_contact_email}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SkillSets -->
            <div class="card m-2 my-5 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Skill Sets</h5>
                    <div class="row col-12 px-5 ">
                        <div class="col-6 p-1">
                            <div class="col-12">
                                <label for="primarySkillset" class="form-label p-2 fs-5 bold">Skills</label>
                            </div>
                            <div class="col-12">
                                <ul class="list-group">
                                    @foreach($associate->associateData->skillset as $skillset)
                                        <li class="list-group-item list-group-item-action">{{$skillset}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 p-1">
                            <div class="col-12">
                                <label for="primaryLanguage" class="form-label p-2 fs-5 bold">Languages</label>
                            </div>
                            <div class="col-12">
                                <ul class="list-group">
                                    @foreach($associate->associateData->working_languages as $language)
                                        <li class="list-group-item list-group-item-action">{{$language}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Qualifications -->
            <div class="card m-2 my-5 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Qualifications</h5>
                    <div class="row col-12 px-5 ">
                        <div class="col-12 p-1 row">
                            <div class="col-6 p-1">
                                <div class="col-12">
                                    <label for="qualifications" class="form-label p-2 fs-5 bold">Educational Qualifications</label>
                                </div>
                                <div class="col-12">
                                    <ul class="list-group">
                                        @if(!empty($associate->associateData->educational_qualifications))
                                            @foreach($associate->associateData->educational_qualifications as $qualification)
                                                <li class="list-group-item list-group-item-action">{{$qualification}}</li>
                                            @endforeach
                                        @else
                                            <li class="list-group-item list-group-item-action">No Qualifications</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6 p-1">
                                <div class="col-12">
                                    <label for="awards" class="form-label p-2 fs-5 bold">Awards</label>
                                </div>
                                <div class="col-12">
                                    <ul class="list-group">
                                        @if(!empty($associate->associateData->awards))
                                            @foreach($associate->associateData->awards as $award)
                                                <li class="list-group-item list-group-item-action">{{$award}}</li>
                                            @endforeach
                                        @else
                                            <li class="list-group-item list-group-item-action">No Awards</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 p-1 row">
                            <div class="col-6 p-1">
                                <div class="col-12">
                                    <label for="accreditations" class="form-label p-2 fs-5 bold">Coaching accreditations</label>
                                </div>
                                <div class="col-12">
                                    <ul class="list-group">
                                        @if(!empty($associate->associateData->coaching_accreditations))
                                            @foreach($associate->associateData->coaching_accreditations as $coaching_accreditation)
                                                <li class="list-group-item list-group-item-action">{{$coaching_accreditation}}</li>
                                            @endforeach
                                        @else
                                            <li class="list-group-item list-group-item-action">No Coaching Accreditations</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6 p-1 row">
                                <div class="col-12">
                                    <label for="facilitatingAccreditations" class="form-label p-2 fs-5 bold">Facilitating Accreditations</label>
                                </div>
                                <div class="col-12">
                                    <ul class="list-group">
                                        @if(!empty($associate->associateData->facilitating_accreditations))
                                            @foreach($associate->associateData->facilitating_accreditations as $facilitating_accreditation)
                                                <li class="list-group-item list-group-item-action">{{$facilitating_accreditation}}</li>
                                            @endforeach
                                        @else
                                            <li class="list-group-item list-group-item-action">No Facilitating Accreditation</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 p-1 row">
                            <div class="col-12 p-1">
                                <div class="col-12">
                                    <label for="credentials" class="form-label p-2 fs-5 bold">Credentials</label>
                                </div>
                                <div class="col-12">
                                    <ul class="list-group">
                                        @if(!empty($associate->associateData->credentials))
                                            @foreach($associate->associateData->credentials as $credential)
                                                <li class="list-group-item list-group-item-action">{{$credential}}</li>
                                            @endforeach
                                        @else
                                            <li class="list-group-item list-group-item-action">No Credentials</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Experience -->
            <div class="card m-2 my-5 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Experience</h5>
                    <div class="row col-12 px-5 ">
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="geographicalExperience" class="form-label py-1">Geographical Experience</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='geographicalExperience' class="form-control" id="geographicalExperience" value="{{$associate->associateData->geographical_experience}}" placeholder="{{$associate->associateData->geographical_experience ?? 'Geographical Experience (Location 1, Location 2)'}}">
                            </div>
                        </div>
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="industrialExperience" class="form-label py-1">Industrial Experience</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='industrialExperience' class="form-control" id="industrialExperience" value="{{$associate->associateData->industry_experience}}" placeholder="{{$associate->associateData->industry_experience ?? 'Industry Experience (Industry 1, Industry 2)'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-6 p-1">
                            <div class="col-12">
                                <label for="sectors" class="form-label p-2 fs-5 bold">Sectors</label>
                            </div>
                            <div class="col-12">
                                <ul class="list-group">
                                    @if(!empty($associate->associateData->sectors_worked_in))
                                        @foreach($associate->associateData->sectors_worked_in as $sector_worked_in)
                                            <li class="list-group-item list-group-item-action">{{$sector_worked_in}}</li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item list-group-item-action">No Sectors</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 p-1">
                            <div class="col-12">
                                <label for="areaOfExpertise" class="form-label p-2 fs-5 bold">Areas Of Expertise</label>
                            </div>
                            <div class="col-12">
                                <ul class="list-group">
                                    @if(!empty($associate->associateData->areas_of_expertise))
                                        @foreach($associate->associateData->areas_of_expertise as $area_of_expertise)
                                            <li class="list-group-item list-group-item-action">{{$area_of_expertise}}</li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item list-group-item-action">No Areas of Expertise</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- workplace behaviors and preferences -->
            <div class="card m-2 my-5 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Behaviors and Preferences</h5>
                    <div class="row col-12 px-5 ">
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="feesPerDay" class="form-label py-1">Fees Per Day</label>
                            </div>
                            <div class="col-9">
                                <input type="text" readonly name='feesPerDay' class="form-control" id="feesPerDay" value="{{$associate->associateData->fees_per_day}}" placeholder="{{$associate->associateData->fees_per_day ?? 'Fees Per Day'}}">
                            </div>
                        </div>
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="stylePreference" class="form-label py-1">Teaching Style Preference</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='stylePreference' class="form-control" id="stylePreference" value="{{$associate->associateData->style_preference}}" placeholder="{{$associate->associateData->style_preference ?? 'Teaching Style Preference'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-6 p-1">
                            <div class="col-12">
                                <label for="preferredColleagueLevel" class="form-label p-2 fs-5 bold">Preferred Colleague Level</label>
                            </div>
                            <div class="col-12">
                                <ul class="list-group">
                                    @if(!empty($associate->associateData->work_with_preferences))
                                        @foreach($associate->associateData->work_with_preferences as $work_with_preference)
                                            <li class="list-group-item list-group-item-action">{{$work_with_preference}}</li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item list-group-item-action">No Preference</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 p-1">
                            <div class="col-12">
                                <label for="endToEndDesign" class="form-label p-2 fs-5 bold">End to End Design</label>
                            </div>
                            <div class="col-12">
                                <ul class="list-group">
                                    @if(!empty($associate->associateData->end_to_end_design))
                                        @foreach($associate->associateData->end_to_end_design as $end_to_end_design)
                                            <li class="list-group-item list-group-item-action">{{$end_to_end_design}}</li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item list-group-item-action">N/A</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Coaching -->
            <div class="card m-2 my-5 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Coaching</h5>
                    <div class="row col-12 px-5 ">
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="contentType" class="form-label py-1">Content Type</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='contentType' class="form-control" id="contentType" value="{{$associate->associateData->content_type}}" placeholder="{{$associate->associateData->content_type ?? 'Content Type'}}">
                            </div>
                        </div>
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="roomEnergy" class="form-label py-1">Room Energy</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='roomEnergy' class="form-control" id="roomEnergy" value="{{$associate->associateData->room_energy}}" placeholder="{{$associate->associateData->room_energy ?? 'Room Energy'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-6 p-1">
                            <div class="col-12">
                                <label for="technologies" class="form-label p-2 fs-5 bold">Technologies</label>
                            </div>
                            <div class="col-12">
                                <ul class="list-group">
                                    @if(!empty($associate->associateData->technologies))
                                        @foreach($associate->associateData->technologies as $technology)
                                            <li class="list-group-item list-group-item-action">{{$technology}}</li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item list-group-item-action">No Technologies</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 p-1">
                            <div class="col-12">
                                <label for="coachingStyle" class="form-label p-2 fs-5 bold">Coaching Style</label>
                            </div>
                            <div class="col-12">
                                <ul class="list-group">
                                    @if(!empty($associate->associateData->coaching_style))
                                        @foreach($associate->associateData->coaching_style as $coaching_style)
                                            <li class="list-group-item list-group-item-action">{{$coaching_style}}</li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item list-group-item-action">No Coaching Style</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 p-1">
                            <div class="col-12">
                                <label for="learningDeliveryMethods" class="form-label p-2 fs-5 bold">Learning Delivery Methods</label>
                            </div>
                            <div class="col-12">
                                <ul class="list-group">
                                    @if(!empty($associate->associateData->learning_delivery_methods))
                                        @foreach($associate->associateData->learning_delivery_methods as $learning_delivery_method)
                                            <li class="list-group-item list-group-item-action">{{$learning_delivery_method}}</li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item list-group-item-action">No Learning Delivery Methods</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Other -->
            <div class="card m-2 my-5 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Other</h5>
                    <div class="row col-12 px-5 ">
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="areasOfInterest" class="form-label py-1">Areas of Interest</label>
                            </div>
                            <div class="col-9">
                                <input readonly type="text" name='areasOfInterest' class="form-control" id="areasOfInterest" value="{{$associate->associateData->areas_of_interest}}" placeholder="{{$associate->associateData->areas_of_interest ?? 'Areas of Interest'}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="mobility" class="form-label py-1">Mobility</label>
                            </div>
                            <div class="col-9">
                                <input readonly  type="text" name='mobility' class="form-control" id="mobility" value="{{$associate->associateData->mobility}}" placeholder="{{$associate->associateData->mobility ?? 'Mobility'}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="mobilityDetails" class="form-label py-1">Mobility Details</label>
                            </div>
                            <div class="col-9">
                                <input readonly  type="text" name='mobilityDetails' class="form-control" id="mobilityDetails" value="{{$associate->associateData->mobility_details}}" placeholder="{{$associate->associateData->mobility_details ?? 'Mobility Details'}}"></input>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-12 p-1 row">
                            <div class="col-1">
                                <label for="elevatorPitch" class="form-label py-1">Elevator Pitch</label>
                            </div>
                            <div class="col-11">
                                <textarea readonly name='elevatorPitch' rows="3" class="form-control" id="elevatorPitch" value="{{$associate->associateData->elevator_pitch}}" placeholder="{{$associate->associateData->elevator_pitch ?? 'Elevator Pitch'}}">{{$associate->associateData->elevator_pitch}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-12 p-1 row">
                            <div class="col-1">
                                <label for="interestingFacts" class="form-label py-1">Interesting Facts</label>
                            </div>
                            <div class="col-11">
                                <textarea readonly  name='interestingFacts' rows="3" class="form-control textbox" id="interestingFacts" value="{{$associate->associateData->interesting_facts}}" placeholder="{{$associate->associateData->interesting_facts ?? 'Interesting Facts'}}">{{$associate->associateData->interesting_facts}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Other -->
            <div class="card m-2 my-5 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Admin</h5>
                    <div class="row col-12 px-5 ">
                        <div class="col-12 p-1 row">
                            <div class="col-2">
                                <label for="background" class="form-label py-1">Background</label>
                            </div>
                            <div class="col-10">
                                <textarea name='background' rows="3" class="form-control" id="background" value="{{$associate->associateData->background}}" placeholder="{{$associate->associateData->background ?? 'Background'}}">{{$associate->associateData->background}}</textarea>
                            </div>
                        </div>
                        <div class="col-12 p-1 row">
                            <div class="col-2">
                                <label for="relevantProjects" class="form-label py-1">Relevant Projects</label>
                            </div>
                            <div class="col-10">
                                <input  type="text" name='relevantProjects' class="form-control" id="relevantProjects" value="{{$associate->associateData->relevantProjects}}" placeholder="{{$associate->associateData->relevantProjects ?? 'Relevant Projects'}}">
                            </div>
                        </div>
                        <div class="col-12 p-1 row">
                            <div class="col-2">
                                <label for="styleAndSkillset" class="form-label py-1">Style and Skillset</label>
                            </div>
                            <div class="col-10">
                                <textarea  name='styleAndSkillset' rows="3" class="form-control" id="styleAndSkillset" value="{{$associate->associateData->style_and_skillset}}" placeholder="{{$associate->associateData->style_and_skillset ?? 'Style and Skillset'}}">{{$associate->associateData->style_and_skillset}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-12 p-1 row">
                            <div class="col-2">
                                <label for="feedback" class="form-label py-1">Feedback/Comments</label>
                            </div>
                            <div class="col-10">
                                <textarea name='feedback' rows="3" class="form-control" id="feedback" value="{{$associate->associateData->feedback}}" placeholder="{{$associate->associateData->feedback ?? 'Feedback'}}">{{$associate->associateData->feedback}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-12 p-1 row">
                            <div class="col-2">
                                <label for="internalNotes" class="form-label py-1">Internal Notes</label>
                            </div>
                            <div class="col-10">
                                <textarea  name='internalNotes' rows="3" class="form-control textbox" id="internalNotes" value="{{$associate->associateData->internal_notes}}" placeholder="{{$associate->associateData->internal_notes ?? 'Internal Notes'}}">{{$associate->associateData->internal_notes}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 row float-end px-5 py-1">
                <button type="button" class="btn btn-primary col me-1" data-bs-toggle="modal" data-bs-target="#docsModal">View Documents</button>
                <button type="submit" class="btn btn-success col">Save</button>
            </div>
        </fieldset>
    </form>
    <div class="modal fade" id="docsModal" tabindex="-1" role="dialog" aria-labelledby="docsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="docsModalLabel">{{$associate->first_name . ' ' . $associate->last_name ."'s Documents"}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach($associate->AssociateDocs as $doc)
                            <div class="col-6 col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$doc->name}}</h5>
                                        <p class="card-text">Date Uploaded: {{$doc->date}}</p>
                                        <p class="card-text">Renewal Date: {{$doc->renewal_date}}</p>
                                        <a href="{{'https://www.primeast.com'.$doc->location}}" target="_blank" class="btn btn-primary">View Document</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
