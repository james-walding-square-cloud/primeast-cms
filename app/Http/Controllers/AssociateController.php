<?php

namespace App\Http\Controllers;

use App\Models\Associate;
use App\Models\AssociateData;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \PDF;

class AssociateController extends Controller
{
    public function index(Request $request) {
        if (!empty($request->all())) {
            $name = $request->searchName ?? null;
            $location = $request->searchLocation ?? null;
            $skills = $request->searchSkills ?? null;
            $language = $request->searchLanguage ?? null;
            $associate = Associate::with('associateData')
                ->when($language != null, function ($query) use ($language) {
                    $query->where('known_languages', 'like', "%$language%");
                    return $query;
                })
                ->when($name != null ,function ($query) use ($name) {
                    $query->where('first_name', 'like', "%$name%")
                        ->orWhere('last_name', 'like', "%$name%");
                    return $query;
                })
                ->when($skills != null, function ($query) use ($skills){
                    $query->whereHas('associateData', function ($q) use ($skills) {
                        $q->where('primary_skillset', 'like', "%$skills%")
                        ->orWhere('educational_qualifications', 'like', "%$skills%")
                        ->orWhere('secondary_skillsets', 'like', "%$skills%")
                        ->orWhere('awards', 'like', "%$skills%")
                        ->orWhere('primary_coaching_accreditations', 'like', "%$skills%")
                        ->orWhere('secondary_coaching_accreditations', 'like', "%$skills%")
                        ->orWhere('primary_facilitating_accreditations', 'like', "%$skills%")
                        ->orWhere('secondary_facilitating_accreditations', 'like', "%$skills%")
                        ->orWhere('credentials', 'like', "%$skills%");
                        return $q;
                    })
                    ->orWhere('search_secondary_skillsets', 'like', "%$skills%");
                    return $query;
                })
                ->when($location != null, function ($query) use ($location) {
                    $query->where('address1', 'like', "%$location%")
                        ->orWhere('address2', 'like', "%$location%")
                        ->orWhere('address3', 'like', "%$location%")
                        ->orWhere('city', 'like', "%$location%")
                        ->orWhere('county', 'like', "%$location%")
                        ->orWhere('country', 'like', "%$location%")
                        ->orWhere('postcode', 'like', "%$location%");
                    return $query;
                })
                ->where('active' , 1)
                ->whereHas('associateData')
                ->paginate(10);
        } else {
            $associate = Associate::where('active' , 1)
                ->paginate(10);
        }

        return view('associate/index', [
            'associates' => $associate
        ]);
    }

    public function create() {
        $user_id = Associate::orderBy('user_id', 'desc')->pluck('user_id')->first();
        $user_id = $user_id+1;

        $countries = Country::all();

        return view('associate/create', [
            'user_id' => $user_id,
            'countries' => $countries,
        ]);

    }

    public function edit($user_id) {
        $associate = Associate::with('associateData')
            ->where('user_id', $user_id)
            ->first();

        $countries = Country::get();
        $selected_country = $associate->country;

        foreach ($countries as $country) {

            $country->alt_names = explode(', ', $country->alt_name);
            if (isset($country->alt_name)) {
                foreach ($country->alt_names as $alt_name) {
                    if ($alt_name == $associate->country) {
                        $selected_country = $country;
                        $associate->country == $country;
                    }
                }
            }
        }

//        dd($selected_country);


        return view('associate/edit', [
            'associate' => $associate,
            'countries' => $countries,
            'selected_country' => $selected_country,
        ]);
    }

    public function profile($user_id) {
        $associate = Associate::with('associateData')
            ->where('user_id', $user_id)
            ->first();

        return view('associate/profile', [
            'associate' => $associate,
        ]);
    }

    public function profileImageUpload (Request $request, $user_id) {
        $associate = Associate::with('associateData')->where('user_id', $user_id)->first();
        $image = $request->file('image');
        $input['imageName'] = $request->user_id. 'ProfileImage' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/profile_images');
        $image->move($destinationPath, $input['imageName']);
    }

    public function profileUpdate(Request $request, $user_id) {
        $associate = Associate::with('associateData')->where('user_id', $user_id)->first();

        $image = $request->file('image');
        if ($request->file('image') != '' && $request->file('image') != null){
            $input['imageName'] = $request->user_id. 'ProfileImage.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/profile_images');
            $image->move($destinationPath, $input['imageName']);
        }


        Associate::where('user_id', $user_id)
            ->update([
                'first_name' => $request->firstName ?? $associate->first_name,
                'last_name' => $request->lastName ?? $associate->last_name,
                'updated_at' => Carbon::now(),
            ]);

        AssociateData::where('user_id', $user_id)
            ->update([
                'working_languages' => $request->workingLanguages ?? $associate->associateData->working_languages,
                'geographical_experience_summary' => $request->geographicalExperienceSummary ?? $associate->associateData->geographical_experience_summary,
                'background' => $request->background ?? $associate->associateData->background,
                'relevant_projects' => $request->relevantProjects ?? $associate->associateData->relevant_projects,
                'style_and_skillset' => $request->styleAndSkillset ?? $associate->associateData->style_and_skillset,
                'summary' => $request->summary ?? $associate->associateData->summary,
                'credentials' => $request->credentials ?? $associate->associateData->credentials,
                'image_url' => $input['imageName'] ?? $associate->associateData->image_url,
                'updated_at' => Carbon::now(),
            ]);

        return redirect('/admin/associate/index');
    }

    public function profilePDF($user_id) {
        $associate = Associate::with('associateData')
            ->where('user_id', $user_id)
            ->first();

        if (isset($associate->associateData->credentials)) {
            $associate->associateData->credentials = explode(', ', $associate->associateData->credentials);
        }
        if (isset($associate->associateData->relevant_projects)) {
            $associate->associateData->relevant_projects = explode(', ', $associate->associateData->relevant_projects);
            if (count($associate->associateData->relevant_projects) > 5) {
                $associate->projects = array_chunk($associate->associateData->relevant_projects, 5);
            }
        }

        $pdf = PDF::loadView('associate.pdf', compact('associate'));
        return $pdf->setPaper('a4' , 'landscape')->download('associate.pdf');
    }

    public function update(Request $request, $user_id) {
        $associate = Associate::with('associateData')->where('user_id', $user_id)->first();


        Associate::where('user_id', $user_id)
            ->update([
                'title' => $request->title ?? $associate->title,
                'first_name' => $request->firstName ?? $associate->first_name,
                'last_name' => $request->lastName ?? $associate->last_name,
                'job_role' => $request->jobRole ?? $associate->job_role,
                'department' => $request->department ?? $associate->department,
                'address1' => $request->address1 ?? $associate->address1,
                'address2' => $request->address2 ?? $associate->address2,
                'address3' => $request->address3 ?? $associate->address3,
                'city' => $request->city ?? $associate->city,
                'county' => $request->county ?? $associate->county,
                'country' => $request->country ?? $associate->country,
                'postcode' => $request->postcode ?? $associate->postcode,
                'phone_office' => $request->phoneOffice ?? $associate->phone_office,
                'phone_home' => $request->phoneHome ?? $associate->phone_home,
                'phone_mobile' => $request->phoneMobile ?? $associate->phone_mobile,
                'emergency_contact_name' => $request->emergencyContactName ?? $associate->emrgency_contact_name,
                'emergency_contact_phone' => $request->emergencyContactPhone ?? $associate->emrgency_contact_phone,
                'emergency_contact_email' => $request->emergencyContactEmail ?? $associate->emrgency_contact_email,
                'known_languages' => $request->workingLanguages ?? $associate->associateData->working_languages,
                'search_qualifications' => $request->educationalQualifications ?? $associate->associateData->educational_qualifications,
                'search_primary_skillset' => $request->primarySkillset ?? $associate->associateData->primary_skillset,
                'search_secondary_skillsets' => $request->secondarySkillset ?? $associate->associateData->secondary_skillsets,
                'date_of_birth' => $request->dateOfBirth ?? $associate->date_of_birth,
                'updated_at' => Carbon::now(),
            ]);

        AssociateData::where('user_id', $user_id)
            ->update([
                'areas_of_interest' => $request->areasOfInterest ?? $associate->associateData->areas_of_interest,
                'primary_skillset' => $request->primarySkillset ?? $associate->associateData->primary_skillset,
                'secondary_skillsets' => $request->secondarySkillset ?? $associate->associateData->secondary_skillsets,
                'primary_language' => $request->primaryLanguage ?? $associate->associateData->primary_language,
                'working_languages' => $request->workingLanguages ?? $associate->associateData->working_languages,
                'sectors_worked_in' => $request->sectors ?? $associate->associateData->sectors_worked_in,
                'geographical_experience' => $request->geographicalExperience ?? $associate->associateData->geographical_experience,
                'mobility' => $request->mobility ?? $associate->associateData->mobility,
                'mobility_details' => $request->mobiltyDetails ?? $associate->associateData->mobility_details,
                'educational_qualifications' => $request->educationalQualifications ?? $associate->associateData->educational_qualifications,
                'awards' => $request->awards ?? $associate->associateData->awards,
                'fees_per_day' => $request->feesPerDay ?? $associate->associateData->fees_per_day,
                'elevator_pitch' => $request->elevatorPitch ?? $associate->associateData->elevator_pitch,
                'interesting_facts' => $request->interestingFacts ?? $associate->associateData->interesting_facts,
                'areas_of_expertise' => $request->areasOfExpertise ?? $associate->associateData->areas_of_expertise,
                'primary_accreditations' => $request->primaryAccreditations ?? $associate->associateData->primary_accreditations,
                'secondary_accreditations' => $request->secondaryAccreditations ?? $associate->associateData->secondary_accreditations,
                'end_to_end_design' => $request->endToEndDesign ?? $associate->associateData->end_to_end_design,
                'work_with_preferences' => $request->workWithPreferences ?? $associate->associateData->work_with_preferences,
                'style_preference' => $request->stylePreference ?? $associate->associateData->style_preference,
                'content_type' => $request->contentType ?? $associate->associateData->content_type,
                'industry_experience' => $request->industryExperience ?? $associate->associateData->industry_experience,
                'room_energy' => $request->roomEnergy ?? $associate->associateData->room_energy,
                'technologies' => $request->technologies ?? $associate->associateData->technologies,
                'learning_delivery_methods' => $request->learningDeliveryMethods ?? $associate->associateData->learning_delivery_methods,
                'primary_coaching_accreditations' => $request->primaryCoachingMethods ?? $associate->associateData->primary_coaching_accreditations,
                'secondary_coaching_accreditations' => $request->secondaryCoachingMethods ?? $associate->associateData->secondary_coaching_accreditations,
                'summary' => $request->summary ?? $associate->associateData->summary,
                'credentials' => $request->credentials ?? $associate->associateData->credentials,
                'updated_at' => Carbon::now(),
            ]);

        return redirect('/admin/associate/index');
    }

    public function store(Request $request) {

//        $request->validate([
//            'title' => 'required',
//            'firstName' => 'required',
//            'lastName' => 'required',
//            'address1' => 'required',
//            'city' => 'required',
//            'postcode' => 'required',
//            'county' => 'required',
//            'country' => 'required',
//            'email' => 'required',
//            'emergencyContactName' => 'required',
//            'emergencyContactPhone' => 'required',
//            'emergencyContactEmail' => 'required',
//        ]);

        Associate::create([
            'user_id' => $request->user_id,
            'title' => $request->title ?? null,
            'first_name' => $request->firstName ?? null,
            'last_name' => $request->lastName ?? null,
            'job_role' => $request->jobRole ?? null,
            'department' => $request->department ?? null,
            'address1' => $request->address1 ?? null,
            'address2' => $request->address2 ?? null,
            'address3' => $request->address3 ?? null,
            'city' => $request->city ?? null,
            'county' => $request->county ?? null,
            'country' => $request->country ?? null,
            'postcode' => $request->postcode ?? null,
            'email' => $request->email ?? null,
            'phone_office' => $request->phoneOffice ?? null,
            'phone_home' => $request->phoneHome ?? null,
            'phone_mobile' => $request->phoneMobile ?? null,
            'emergency_contact_name' => $request->emergencyContactName ?? null,
            'emergency_contact_phone' => $request->emergencyContactPhone ?? null,
            'emergency_contact_email' => $request->emergencyContactEmail ?? null,
            'known_languages' => $request->known_languages ?? null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        AssociateData::create([
            'user_id' => $request->user_id,
            'areas_of_interest' => null,
            'primary_skillset' => null,
            'secondary_skillsets' => null,
            'primary_language' => null,
            'working_languages' => null,
            'sectors_worked_in' => null,
            'geographical_experience' => null,
            'mobility' => null,
            'mobility_details' => null,
            'educational_qualifications' => null,
            'awards' => null,
            'fees_per_day' => null,
            'elevator_pitch' => null,
            'interesting_facts' => null,
            'areas_of_expertise' => null,
            'primary_accreditations' => null,
            'secondary_accreditations' => null,
            'end_to_end_design' => null,
            'work_with_preferences' => null,
            'style_preference' => null,
            'content_type' => null,
            'industry_experience' => null,
            'room_energy' => null,
            'technologies' => null,
            'learning_delivery_methods' => null,
            'primary_facilitating_accreditations' => null,
            'secondary_facilitating_accreditations' => null,
            'coaching_style' => null,
            'primary_coaching_accreditations' => null,
            'secondary_coaching_accreditations' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        return redirect('/admin/associate/edit/'.$request->user_id);
    }

    public function deactivate($user_id) {
        Associate::where('user_id', $user_id)
            ->update([
                'active' => 0,
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->back();
    }
}
