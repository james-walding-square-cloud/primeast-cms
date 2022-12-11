
<style>
    html {
        margin: 0px;
    }
    h-100 {
        height: 100%;
    }
    .w-100{
        width: 100%;
    }
    .w-75{
        width: 75%;
    }
    .w-65 {
        width: 65%;
    }
    .w-50{
        width: 50%;
    }
    .w-35{
        width: 35%;
    }
    .w-25{
        width: 25%;
    }
    .w-10{
        width: 10%;
    }
    .p-10 {
        padding: 10px;
    }
    .profile-blue {
        background-color: #041043;
    }
    .profile-border {
        border: solid 1px #041043;
    }
    .text-white {
        color: #ffffff;
    }
    .text-center {
        text-align: center;
    }
    .v-align-top {
        vertical-align: top;
    }
    .brand-font {
        font-family: Calibri;
        font-size: 16px;
    }
    img {
        border-radius: 50%;
    }


</style>
<table class="w-100 brand-font profile-border h-100">
    <tbody>
    <tr>
        <!-- This is the left side -->
        <td class="w-35 profile-blue text-white v-align-top p-10" style="height: 749px">
            <div class="w-100 text-center p-10">
                <img  class="" src="{{'profile_images/'.$associate->associateData->image_url}}" alt="">
            </div>
            <div class="py-3">
                <div class="row"></div>
                <h1>{{$associate->first_name . ' ' . $associate->last_name}}</h1>
                <hr>
            </div>
            <div class="w-100 row m-0 py-2">
                <h2>Summary</h2>
                <p>{{$associate->associateData->summary}}</p>
            </div>
            <div class="w-100 row m-0 py-2">
                <h2>Credentials</h2>
                <ul>
                    @foreach($associate->associateData->credentials as $credential)
                        <li>{{$credential}}</li>
                    @endforeach
                </ul>
            </div>
        </td>
        <!-- Right side -->
        <td class="w-65 p-10">
            <div class="w-100 row m-0 py-2">
                <h2>Background</h2>
                <p>{{$associate->associateData->background}}</p>
            </div>

            <div class="w-100 row m-0 py-2">
                <h2>Relevant Projects</h2>
                <ul>
                    @foreach($associate->associateData->relevant_projects as $project)
                        <li>{{$project}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="w-100 row m-0 py-2">
                <h2>Style and Skillset</h2>
                <p>{{$associate->associateData->style_and_skillset}}</p>
            </div>
            <div class="w-100 row m-0 py-2">
                <h2>Language and Location</h2>
                <p>{{$associate->associateData->working_languages}}</p>
                <p>{{$associate->associateData->geographical_experience_summary}}</p>
            </div>
        </td>
    </tr>
    </tbody>
</table>

