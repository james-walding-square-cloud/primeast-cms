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
                                <input type="text" name='title' class="form-control" id="title" value="{{$associate->title}}" placeholder="{{$associate->title}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="firstName" class="form-label py-1">First Name</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='firstName' class="form-control" id="firstName" value="{{$associate->first_name}}" placeholder="{{$associate->first_name}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="lastName" class="form-label py-1">Last Name</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='lastName' class="form-control" id="lastName" value="{{$associate->last_name}}" placeholder="{{$associate->last_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5">
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="company" class="form-label py-1">Company</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='company' class="form-control" id="company" value="{{$associate->company}}" placeholder="{{$associate->company}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="jobRole" class="form-label py-1">Job Role</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='jobRole' class="form-control" id="jobRole" value="{{$associate->job_role}}" placeholder="{{$associate->job_role}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="department" class="form-label py-1">Department</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='department' class="form-control" id="department" value="{{$associate->department}}" placeholder="{{$associate->department}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5">
                        <div class="col-9 p-1 row">
                            <div class="col-1">
                                <label for="summary" class="form-label py-1">Summary</label>
                            </div>
                            <div class="col-11 ps-5">
                                <textarea name='summary' rows="2" class="form-control" id="elevatorPitch" value="{{$associate->associateData->summary}}" placeholder="{{$associate->associateData->summary ?? 'Summary'}}"></textarea>
                            </div>
                        </div>
                        <div class="col row">
                            <div class="col-3">
                                <label for="dateOfBirth" class="form-label py-1">Date Of Birth</label>
                            </div>
                            <div class="col-9">
                                <input type="date" name='dateOfBirth' class="form-control" id="dateOfBirth" value="{{$associate->date_of_birth}}">
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
                                <input type="text" name='address1' class="form-control" id="address1" value="{{$associate->address1}}" placeholder="{{$associate->address1}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="address2" class="form-label py-1">Address 2</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='address2' class="form-control" id="address2" value="{{$associate->address2}}" placeholder="{{$associate->address2}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="address3" class="form-label py-1">Address 3</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='address3' class="form-control" id="address3" value="{{$associate->address3}}" placeholder="{{$associate->address3}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5">
                        <div class="col p-1 row">
                            <div class="col">
                                <label for="city" class="form-label py-1">City</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='city' class="form-control" value="{{$associate->city}}" id="city" placeholder="{{$associate->city}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="county" class="form-label py-1">County</label>
                            </div>
                            <div class="col-9">
                                <input type="text"name='county' class="form-control" id="county" value="{{$associate->county}}" placeholder="{{$associate->county}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="postcode" class="form-label py-1">Postcode</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='postcode' class="form-control" id="postcode" value="{{$associate->postcode}}" placeholder="{{$associate->postcode}}">
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
                                <input type="text" name='phoneOffice' class="form-control" id="phoneOffice" value="{{$associate->phone_office}}" placeholder="{{$associate->phone_office}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="phoneHome" class="form-label py-1">Phone Home</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='phoneHome' class="form-control" id="phoneHome" value="{{$associate->phone_home}}" placeholder="{{$associate->phone_home}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="phoneMobile" class="form-label py-1">Phone Mobile</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='phoneMobile' class="form-control" id="phoneMobile" value="{{$associate->phone_mobile}}" placeholder="{{$associate->phone_mobile}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-3 p-1 row">
                            <div class="col-3">
                                <label for="email" class="form-label py-1">Email</label>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" id="email" placeholder="{{$associate->email}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="secondaryEmail" class="form-label py-1">Secondary Email</label>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" id="secondaryEmail" placeholder="{{$associate->secondary_email}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="linkedin" class="form-label py-1">Linkedin</label>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" id="linkedin" placeholder="{{$associate->linkedin}}">
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
                                <input type="text" name='emergencyContactName' class="form-control" id="emergencyContactName" value="{{$associate->emergency_contact_name}}" placeholder="{{$associate->emergency_contact_name}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="emergencyContactPhone" class="form-label py-1">Phone</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='emergencyContactPhone' class="form-control" id="emergencyContactPhone" value="{{$associate->emergency_contact_phone}}" placeholder="{{$associate->emergency_contact_phone}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="emergencyContactEmail" class="form-label py-1">Email</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='emergencyContactEmail' class="form-control" id="emergencyContactEmail" value="{{$associate->emergency_contact_email}}" placeholder="{{$associate->emergency_contact_email}}">
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
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="primarySkillset" class="form-label py-1">Primary Skill Set</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='primarySkillset' class="form-control" id="primarySkillset" value="{{str_contains($associate->associateData->primary_skillset, '[') ? str_replace(['[', ']', '"'], "", $associate->associateData->primary_skillset) : $associate->associateData->primary_skillset}}" placeholder="{{$associate->associateData->primary_skillset ?? 'Primary Skill set (Skill 1, Skill 2)'}}">
                            </div>
                        </div>
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="secondarySkillset" class="form-label py-1">Secondary Skill Set</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='secondarySkillset' class="form-control" id="secondarySkillset" value="{{str_contains($associate->associateData->secondary_skillset, '[') ? str_replace(['[', ']', '"'], "", $associate->associateData->secondary_skillset) : $associate->associateData->secondary_skillset}}" placeholder="{{$associate->associateData->secondary_skillset ?? 'Secondary Skill set (Skill 1, Skill 2)'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="primaryLanguage" class="form-label py-1">Primary Language</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='primaryLanguage' class="form-control" id="primaryLanguage" value="{{$associate->associateData->primary_language}}" placeholder="{{$associate->associateData->primary_language ?? 'Primary Language'}}">
                            </div>
                        </div>
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="workingLanguages" class="form-label py-1">All Languages</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='workingLanguages' class="form-control" id="workingLanguages" value="{{str_contains($associate->associateData->working_languages, '[') ? str_replace(['[', ']', '"'], "", $associate->associateData->working_languages) : $associate->associateData->working_languages}}" placeholder="{{$associate->associateData->working_languages ?? 'All Languages including Primary (Language 1, Language 2)'}}">
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
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="educationalQualifications" class="form-label py-1">Educational Qualifications</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='educationalQualifications' class="form-control" id="educationalQualifications" value="{{$associate->associateData->educational_qualifications}}" placeholder="{{$associate->associateData->educational_qualifications ?? 'Educational Qualification'}}">
                            </div>
                        </div>
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="awards" class="form-label py-1">Awards</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='awards' class="form-control" id="awards" value="{{$associate->associateData->awards}}" placeholder="{{$associate->associateData->awards ?? 'Awards (Award 1, Award 2)'}}">
                            </div>
                        </div>

                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="primaryCoachingAccreditations" class="form-label py-1">Primary Coaching Accreditations</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='primaryCoachingAccreditations' class="form-control" id="primaryCoachingAccreditations" value="{{$associate->associateData->primary_coaching_accreditations}}" placeholder="{{$associate->associateData->primary_coaching_accreditations ?? 'Primary Coaching Accreditations'}}">
                            </div>
                        </div>
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="secondaryCoachingAccreditations" class="form-label py-1">Secondary Coaching Accreditations</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='secondaryCoachingAccreditations' class="form-control" id="secondaryCoachingAccreditations" value="{{$associate->associateData->secondary_coaching_accreditations}}" placeholder="{{$associate->associateData->secondary_coaching_accreditations ?? 'Secondary Coaching Accreditations'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="primaryFacilitatingAccreditations" class="form-label py-1">Primary Facilitating Accreditations</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='primaryFacilitatingAccreditations' class="form-control" id="primaryFacilitatingAccreditations" value="{{$associate->associateData->primary_facilitating_accreditations}}" placeholder="{{$associate->associateData->primary_facilitating_accreditations ?? 'Primary Facilitating Accreditations'}}">
                            </div>
                        </div>
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="secondaryFacilitatingAccreditations" class="form-label py-1">Secondary Facilitating Accreditations</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='secondaryFacilitatingAccreditations' class="form-control" id="secondaryFacilitatingAccreditations" value="{{$associate->associateData->secondary_facilitating_accreditations}}" placeholder="{{$associate->associateData->secondary_facilitating_accreditations ?? 'Secondary Facilitating Accreditations'}}">
                            </div>
                        </div>
                    </div>
                    <div class="col row px-5">
                        <div class="col-1 p-0">
                            <label for="credentials" class="form-label py-1">Credentials</label>
                        </div>
                        <div class="col-11 px-5">
                            <input type="text" name='credentials' class="form-control mx-4" id="credentials" value="{{str_contains($associate->associateData->credentials, '[') ? str_replace(['[', ']', '"'], "", $associate->associateData->credentials) : $associate->associateData->credentials}}" placeholder="{{$associate->associateData->credentials ?? 'Credentials (Skill 1, Skill 2)'}}">
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
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="sectors" class="form-label py-1">Sectors Worked In</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='sectors' class="form-control" id="sectors" value="{{$associate->associateData->sectors_worked_in}}" placeholder="{{$associate->associateData->sectors_worked_in ?? 'Sectors (Sector 1, Sector 2)'}}">
                            </div>
                        </div>
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="areasOfExpertise" class="form-label py-1">Areas of Expertise</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='areasOfExpertise' class="form-control" id="areasOfExpertise" value="{{$associate->associateData->areas_of_expertise}}" placeholder="{{$associate->associateData->areas_of_expertise ?? 'Areas of Expertise (Expertise 1, Expertise 2)'}}">
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
                                <input type="text" name='feesPerDay' class="form-control" id="feesPerDay" value="{{$associate->associateData->fees_per_day}}" placeholder="{{$associate->associateData->fees_per_day ?? 'Fees Per Day'}}">
                            </div>
                        </div>
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="endToEndDesign" class="form-label py-1">End to End Design</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='endToEndDesign' class="form-control" id="endToEndDesign" value="{{$associate->associateData->end_to_end_design}}" placeholder="{{$associate->associateData->end_to_end_design ?? 'End to End Design'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="workWithPreference" class="form-label py-1">Preferred Colleague Level</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='workWithPreference' class="form-control" id="workWithPreference" value="{{$associate->associateData->work_with_preference}}" placeholder="{{$associate->associateData->work_with_preference ?? 'Work With Preference (Middle Management etc)'}}">
                            </div>
                        </div>
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="stylePreference" class="form-label py-1">Teaching Style Preference</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='stylePreference' class="form-control" id="stylePreference" value="{{$associate->associateData->style_preference}}" placeholder="{{$associate->associateData->style_preference ?? 'Teaching Style Preference'}}">
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
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="contentType" class="form-label py-1">Content Type</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='contentType' class="form-control" id="contentType" value="{{$associate->associateData->content_type}}" placeholder="{{$associate->associateData->content_type ?? 'Content Type'}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="roomEnergy" class="form-label py-1">Room Energy</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='roomEnergy' class="form-control" id="roomEnergy" value="{{$associate->associateData->room_energy}}" placeholder="{{$associate->associateData->room_energy ?? 'Room Energy'}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="coachingStyle" class="form-label py-1">Coaching Style</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='coachingStyle' class="form-control" id="coachingStyle" value="{{$associate->associateData->coaching_style}}" placeholder="{{$associate->associateData->coaching_style ?? 'Coaching Style'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="technologies" class="form-label py-1">Technologies</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='technologies' class="form-control" id="technologies" value="{{$associate->associateData->technologies}}" placeholder="{{$associate->associateData->technologies ?? 'Technologies'}}">
                            </div>
                        </div>
                        <div class="col-6 p-1 row">
                            <div class="col-3">
                                <label for="learningDeliveryMethods" class="form-label py-1">Learning Delivery Methods</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='learningDeliveryMethods' class="form-control" id="learningDeliveryMethods" value="{{$associate->associateData->learning_delivery_methods}}" placeholder="{{$associate->associateData->learning_delivery_methods ?? 'Learning Delivery Methods'}}">
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
                                <input type="text" name='areasOfInterest' class="form-control" id="areasOfInterest" value="{{$associate->associateData->areas_of_interest}}" placeholder="{{$associate->associateData->areas_of_interest ?? 'Areas of Interest'}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="mobility" class="form-label py-1">Mobility</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='mobility' class="form-control" id="mobility" value="{{$associate->associateData->mobility}}" placeholder="{{$associate->associateData->mobility ?? 'Mobility'}}">
                            </div>
                        </div>
                        <div class="col p-1 row">
                            <div class="col-3">
                                <label for="mobilityDetails" class="form-label py-1">Mobility Details</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name='mobilityDetails' class="form-control" id="mobilityDetails" value="{{$associate->associateData->mobility_details}}" placeholder="{{$associate->associateData->mobility_details ?? 'Mobility Details'}}"></input>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-12 p-1 row">
                            <div class="col-1">
                                <label for="elevatorPitch" class="form-label py-1">Elevator Pitch</label>
                            </div>
                            <div class="col-11">
                                <textarea name='elevatorPitch' rows="3" class="form-control" id="elevatorPitch" value="{{$associate->associateData->elevator_pitch}}" placeholder="{{$associate->associateData->elevator_pitch ?? 'Elevator Pitch'}}"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 px-5 ">
                        <div class="col-12 p-1 row">
                            <div class="col-1">
                                <label for="interestingFacts" class="form-label py-1">Interesting Facts</label>
                            </div>
                            <div class="col-11">
                                <textarea name='interestingFacts' rows="3" class="form-control textbox" id="interestingFacts" value="{{$associate->associateData->interesting_facts}}" placeholder="{{$associate->associateData->interesting_facts ?? 'Interesting Facts'}}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2 float-end px-5 py-1">
                <button type="submit" class="btn btn-success w-100">Save</button>
            </div>
        </fieldset>
    </form>
@endsection
