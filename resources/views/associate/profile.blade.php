@extends("layouts.app")

@section("content")
    <div class="py-3">
        <div class="row"></div>
        <h1 class="text-center">{{$associate->first_name . " " . $associate->last_name}}</h1>
        <hr>
    </div>
    <form action="/admin/associate/profileUpdate/{{$associate->user_id}}" method="post" enctype="multipart/form-data">
        {{ method_field("PUT") }}
        {{ csrf_field() }}
        <fieldset>
            <div class="row m-0 text-white">
                <div class="col-3 profile-blue text-center py-2">
                    <img src="{{isset($associate->associateData->image_url) ? url("profile_images/".$associate->associateData->image_url) : "profile_images/icon-transparent.png"}}" alt='' class="profile-edit-image">
                        <div id="profile-image" class="w-100 pt-5">
                            <input name="image" id="image" type="file">
                        </div>
                    <div class="w-100 row m-0 py-2">
                        <div class="col-6">
                            <input type="text" name="firstName" class="form-control" id="firstName" value="{{$associate->first_name ?? ""}}" placeholder="{{$associate->first_name ?? ""}}">
                        </div>
                        <div class="col-6">
                            <input type="text" name="lastName" class="form-control" id="lastName" value="{{$associate->last_name}}" placeholder="{{$associate->last_name}}">
                        </div>
                    </div>
                    <div class="w-100 row m-0 py-2">
                        <div class="col-12">
                            <textarea name="summary" rows="5" class="form-control" id="elevatorPitch" value="{{$associate->associateData->summary}}" placeholder="{{$associate->associateData->summary ?? "Summary"}}"></textarea>
                        </div>
                    </div>
                    <div class="w-100 row m-0 py-2">
                        <div class="col-12">
                            <input type="text" name="languages" class="form-control m-0" id="languages" value="{{$associate->associateData->working_languages}}" placeholder="{{$associate->associateData->working_languages ?? "Languages (Language 1, Language 2)"}}">
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="w-100 row m-0 py-2">
                        <div class="col-12">
                            <textarea name="background" rows="5" class="form-control" id="background" value="{{$associate->associateData->background}}" placeholder="{{$associate->associateData->background ?? "Background"}}"></textarea>
                        </div>
                    </div>
                    <div class="w-100 row m-0 py-2">
                        <div class="col-12">
                            <input type="text" name="relevantProjects" class="form-control m-0" id="relevantProjects" value="{{$associate->associateData->relevant_projects}}" placeholder="{{$associate->associateData->relevant_projects ?? "Projects (Project 1, Project 2)"}}">
                        </div>
                    </div>
                    <div class="w-100 row m-0 py-2">
                        <div class="col-12">
                            <textarea name="styleAndSkillset" rows="5" class="form-control" id="styleAndSkillset" value="{{$associate->associateData->style_and_skillset}}" placeholder="{{$associate->associateData->style_and_skillset ?? "Style and Skillset"}}"></textarea>
                        </div>
                    </div>
                    <div class="w-100 row m-0 py-2">
                        <div class="col-12">
                            <textarea name="geographicalExperienceSummary" rows="5" class="form-control" id="geographicalExperienceSummary" value="{{$associate->associateData->geographical_experience_summary}}" placeholder="{{$associate->associateData->geographical_experience_summary ?? "Geographical Summary"}}"></textarea>
                        </div>
                    </div>
                    <div class="w-100 row m-0 py-2">
                        <div class="col-12">
                            <input type="text" name="credentials" class="form-control m-0" id="credentials" value="{{str_contains($associate->associateData->credentials, "[") ? str_replace(["[", "]", '"'], "", $associate->associateData->credentials) : $associate->associateData->credentials}}" placeholder="{{$associate->associateData->credentials ?? "Credentials (Skill 1, Skill 2)"}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 row float-end px-5 py-1">
                <button type="submit" class="btn btn-success col m-1">Save</button>
            </div>
        </fieldset>
    </form>

@endsection
