<?php

namespace App\Http\Controllers;

use App\Models\Associate;
use App\Models\AssociateData;
use App\Models\AssociateDocs;
use App\Models\Country;
use App\Models\Language;
use App\Models\Sector;
use App\Models\Skill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \PDF;

class AssociateController extends Controller
{
    public function index(Request $request) {
        $languages = Language::get()->pluck('language');
        $sectors = Sector::get()->pluck('sector');
        $skills = Skill::get()->pluck('title');
        $countries = Country::get()->pluck('name');

        if (!empty($request->all())) {
            $name = $request->searchName ?? null;
            $location = $request->searchLocation ?? null;
            $skill = $request->searchSkill ?? null;
            $qualification = $request->searchQualification ?? null;
            $language = $request->searchLanguage ?? null;
            $sector = $request->searchSector ?? null;
            $associate = Associate::with('associateData')
                ->whereHas('associateData')
                ->when($language != null ,function ($query) use ($language) {
                    $query->whereHas('associateData', function ($q) use ($language) {
                        foreach ($language as $languageItem) {
                            $q->where('working_languages', 'like', "%$languageItem%");
                        }
                        return $q;
                    });
                })
                ->when($name != null ,function ($query) use ($name) {
                    $query->where(function($q) use ($name) {
                        $q->where('first_name', 'like', "%$name%")
                            ->orWhere('last_name', 'like', "%$name%");
                        return $q;
                    });
                })
                ->when($skill != null, function ($query) use ($skill){
                    foreach ($skill as $skillItem) {
                        $query->whereHas('associateData', function ($q) use ($skillItem) {
                            $q->where('primary_skillset', 'like', "%$skillItem%")
                                ->orWhere('secondary_skillsets', 'like', "%$skillItem%")
                                ->orWhere('awards', 'like', "%$skillItem%")
                                ->orWhere('primary_coaching_accreditations', 'like', "%$skillItem%")
                                ->orWhere('secondary_coaching_accreditations', 'like', "%$skillItem%")
                                ->orWhere('primary_facilitating_accreditations', 'like', "%$skillItem%")
                                ->orWhere('secondary_facilitating_accreditations', 'like', "%$skillItem%")
                                ->orWhere('credentials', 'like', "%$skillItem%");
                            return $q;
                        })
                            ->orWhere('search_secondary_skillsets', 'like', "%$skillItem%");
                        return $query;
                    }
                })
                ->when($qualification != null ,function ($query) use ($qualification) {
                    $query->whereHas('associateData', function ($q) use ($qualification) {
                            $q->where('educational_qualifications', 'like', "%$qualification%");
                        return $q;
                    });
                    return $query;
                })
                ->when($location != null, function ($query) use ($location) {
                    foreach ($location as $locationItem) {
                        $query->where(function ($q) use ($locationItem) {
                            $q->where('country', 'like', "%$locationItem%");
                        });
                    }
                })
                ->when($sector != null, function ($query) use ($sector) {
                    foreach ($sector as $sectorItem) {
                        $query->whereHas('associateData', function ($q) use ($sectorItem) {
                            $q->where('Sectors_worked_in', 'like', "%$sectorItem%");
                            return $q;
                        });
                        return $query;
                    }
                })
                ->where('active' , 1)
                ->orderBy('first_name')
                ->paginate(10);
        } else {
            $associate = Associate::with('associateData')
                ->whereHas('associateData')
                ->where('active' , 1)
                ->paginate(10);

        }




        return view('associate/index', [
            'associates' => $associate,
            'languages' => $languages,
            'sectors' => $sectors,
            'skills' => $skills,
            'countries' => $countries,
            'name' => $request->searchName ?? null,
            'location' => $request->searchLocation ?? null,
            'skill' => $request->searchSkill ?? null,
            'language' => $request->searchLanguage ?? null,
            'qualification' => $request->searchQualification ?? null,
        ]);
    }

    public function languagesUpdate() {
        $languageList = [];

        $associate = Associate::whereHas('associateData')->where('active', 1)->get();
        $languages = Language::get()->pluck('language')->toArray();

        foreach ($associate as $person) {
            $knownLanguages = explode(' , ', $person->known_languages);
            $primaryLanguage = $person->associateData->primary_language;
            $workingLanguages = explode(' , ', $person->associateData->working_languages);

            if (is_array($knownLanguages)) {
                foreach ($knownLanguages as $language) {
                    $languageArray[] = $language;
                }
            } elseif ($knownLanguages != null) {
                $languageArray[] = $language;
            }

            if (isset($primaryLanguage)) {
                $languageArray[] = $primaryLanguage;
            }

            if (is_array($workingLanguages)) {
                foreach ($workingLanguages as $language) {
                    $languageArray[] = $language;
                }
            } elseif ($workingLanguages != null) {
                $languageArray[] = $language;
            }

            if (is_array($languageArray) && !empty($languageArray)) {
                $languageArray = array_unique($languageArray);
                foreach ($languageArray as $language) {
                    if (!in_array($language, $languageList)) {
                        $languageList[] = $language;
                    }
                }
            }
        }


        $languageList = array_filter($languageList);
        foreach ($languageList as $languageItem) {
            if (!in_array($languageItem, $languages)) {
                Language::create([
                    'language' => $languageItem,
                ]);
            }
        }
    }

    public function knownlanguages() {
        $associates = Associate::whereHas('associateData')->with('associateData')->take(10)->get();
        foreach ($associates as $associate) {
            $languages = [];
            if (isset($associate->associateData->primary_language)) {
                $languages[] = $associate->associateData->primary_language;
            }
            if (isset($associate->associateData->working_languages)) {

            }

        }
    }

    public function skillsUpdate() {
        $skillsList = [];
        $searchList = [];
        $awardsArray = [];
        $educationalQualificationsArray = [];
        $credentialsArray = [];


        $associate = Associate::whereHas('associateData')->where('active', 1)->get();
        $skills = Skill::get()->pluck('language')->toArray();

        foreach ($associate as $person) {
            $primarySkillset = json_decode($person->associateData->primary_skillset);
            $secondarySkillset = json_decode($person->associateData->secondary_skillsets);
            $primaryCoachingAccreditations = json_decode($person->associateData->primary_coaching_accreditations);
            $credentials = explode(',', $person->associateData->credentials);
            $educationalQualifications = explode(';', $person->associateData->educational_qualifications);
            $awards = explode(',', $person->associateData->awards);
            if (isset($educationalQualifications) && $educationalQualifications[0] != "") {
                foreach ($educationalQualifications as $qual) {
                    $educationalQualificationsArray[] = ltrim($qual);
                }
            }
            if (isset($awards) && $awards[0] != "") {
                foreach ($awards as $award) {
                    $awardsArray[] = ltrim($award);
                }
            }
            if (isset($credentials) && $credentials[0] != "") {
                foreach ($credentials as $credential) {
                    $credentialsArray[] = ltrim($credential);
                }
            }

            array_unique($educationalQualificationsArray);
            array_unique($awardsArray);
            array_unique($credentialsArray);

            $skillsList = array_merge([$primarySkillset ?? null, $secondarySkillset ?? null, $primaryCoachingAccreditations ?? null, $credentialsArray, $educationalQualificationsArray, $awardsArray]);

            foreach ($skillsList as $list) {
                if ($list != [] && $list != null) {
                    foreach ($list as $listItem) {
                        if (!in_array($listItem, $searchList)) {
                            $searchList[] = $listItem;
                        }
                    }
                }
            }
        }

        $arrayChunk = array_chunk($searchList, 50);
//        dd($arrayChunk);

        foreach ($arrayChunk[6] as $skillsItem) {
            if (!in_array($skillsItem, $skills)) {
                Skill::create([
                    'title' => $skillsItem,
                ]);
            }
        }
    }

    public function sectorsUpdate() {
        $sectorList = [];
        $associate = Associate::whereHas('associateData')->where('active', 1)->get();
        $sectors = Sector::get()->pluck('sector')->toArray();

        foreach ($associate as $person) {
            $sectorsWorkedIn = explode(',', $person->associateData->sectors_worked_in);
            foreach ($sectorsWorkedIn as $key => $sector) {
                $sector = str_replace(['[', ']','"'], "", $sector);
                $sectorsWorkedIn[$key] = $sector;
            }

            if (is_array($sectorsWorkedIn)) {
                foreach ($sectorsWorkedIn as $sector) {
                    if (!in_array($sector, $sectorList) && $sector != 'null') {
                        $sectorList[] = $sector;
                    }
                }
            } elseif ($sectorsWorkedIn != null && $sector != 'null') {
                if (!in_array($sector, $sectorList) && $sector != 'null') {
                    $sectorList[] = $sector;
                }
            }
        }

        $sectorArray = array_filter($sectorList);
        foreach ($sectorArray as $sectorItem) {
            $sectorItem = stripslashes($sectorItem);
        }


        foreach ($sectorArray as $sectorItem) {
            if (!in_array($sectorItem, $sectors)) {
                Sector::create([
                    'sector' => $sectorItem,
                ]);
            }
        }
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

        if ($associate->associateData) {
            $associate->associateData = $associate->associateData->getUpdatedValues($associate->associateData);
        }



        $countries = Country::get();
        $selected_country = $associate->country;

        foreach ($countries as $country) {

            $country = (object)$country;
            $country->alt_names = explode(', ', $country->alt_name);
            if (isset($country->alt_name)) {
                foreach ($country->alt_names as $alt_name) {
                    if ($alt_name == $associate->country) {
                        $selected_country = $country;
//                        $associate->country = $country;
                    }
                }
            }
        }

        return view('associate/edit', [
            'associate' => $associate,
            'countries' => $countries,
            'selected_country' => $selected_country,
        ]);
    }

    public function profile($user_id) {
        $associate = Associate::with('associateData')
            ->with('AssociateDocs')
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
            $credentials = explode(', ', $associate->associateData->credentials);
            $associate->associateData->credentials = array_slice($credentials, 0, 5, true);
        }

        if (isset($associate->associateData->relevant_projects)) {
            $associate->associateData->relevant_projects = explode(', ', $associate->associateData->relevant_projects);
            if (count($associate->associateData->relevant_projects) > 5) {
                $associate->projects = array_chunk($associate->associateData->relevant_projects, 5);
            }
        }

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('associate.pdf', compact('associate'));
        return $pdf->setPaper('a4' , 'landscape')->download('associate.pdf');
    }

    public function update(Request $request, $user_id) {
        $associate = Associate::with('associateData')->where('user_id', $user_id)->first();


        AssociateData::where('user_id', $user_id)
            ->update([
                'background' => $request->background ?? $associate->associateData->background,
                'relevant_projects' => $request->relevantProjects ?? $associate->associateData->relevant_projects,
                'style_and_skillset' => $request->styleAndSkillset ?? $associate->associateData->style_and_skillset,
                'feedback' => $request->feedback ?? $associate->associateData->feedback,
                'internal_notes' => $request->internalNotes ?? $associate->associateData->internal_notes,
                'summary' => $request->summary ?? $associate->associateData->summary,
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
