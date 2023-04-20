<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \PDF;

class BannerController extends Controller
{
    public function index(Request $request) {

    $banners = Banner::get();
        return view('banner/index', [
            'banners' => $banners,
        ]);
    }

    public function create() {
        $banner_id = Banner::orderBy('id', 'desc')->pluck('id')->first();
        $banner_id = $banner_id+1;


        return view('banner/create', [
            'banner_id' => $banner_id,
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

    public function bannerImageUpload (Request $request) {
        $image = $request->file('image');
        $input['imageName'] = $request->user_id. 'ProfileImage' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/banner');
        $image->move($destinationPath, $input['imageName']);

        if ($request->hasFile('bannerImage')) {
            $image      = $request->file('bannerImage');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->stream();

            Storage::disk('local')->put('images/banners'.'/'.$fileName, $img, 'public');
        }
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


        $image = $request->file('image');
        if ($request->file('image') != '' && $request->file('image') != null){
            $input['imageName'] = 'banner' . $request->id . $image->getClientOriginalExtension();
            $destinationPath = public_path('/banner');
            $image->move($destinationPath, $input['imageName']);
        }



        Banner::create([
            'id' => $request->id,
            'name' => $request->name ?? null,
            'start_date' => $request->startDate ?? null,
            'end_date' => $request->endDate ?? null,
            'image_url' => $request->imageUrl ?? null,
            'link' => $request->linkUrl ?? null,
            'link_text' => $request->linkText ?? null,
            'description' => $request->imageUrl ?? null,
            'active' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        return redirect('/admin/banner/index');
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
