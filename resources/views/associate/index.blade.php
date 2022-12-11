@extends('layouts.app')

@section('content')
    <div>
        <form action="/admin/associate/index">
            <fieldset>
                <div class="search p-5 row text-center">
                    <div class="col">
                        <label for="searchName" class="form-label">
                            Name
                        </label>
                        <input type="text" name="searchName" id="searchName" class="form-control">
                    </div>
                    <div class="col">
                        <label for="searchLanguage" class="form-label">
                            Language
                        </label>
                        <input type="text" name="searchLanguage" id="searchLanguage" class="form-control">
                    </div>
                    <div class="col">
                        <label for="searchSkills" class="form-label">
                            Skills and Qualifications
                        </label>
                        <input type="text" name="searchSkills" id="searchSkills" class="form-control">
                    </div>
                    <div class="col">
                        <label for="searchLocation" class="form-label">
                            Location
                        </label>
                        <input type="text" name="searchLocation" id="searchLocation" class="form-control">
                    </div>
                    <div class="col">
                        <a href="/admin/associate/index">
                            <label>

                            </label>
                            <button class="btn btn-success w-100">
                                Search
                            </button>
                        </a>
                    </div>
                </div>
            </fieldset>
        </form>

        <div class="results py-2 ">
            <div class="w-100 d-flex justify-content-center align-items-middle">
                <div>
                    {{ $associates->links() }}
                </div>
            </div>
            <table class="table-striped table text-center">
                <thead>
                <tr>
                    <th class="col-2">Name</th>
                    <th class="col-1">Status</th>
                    <th class="col-1">Country</th>
                    <th class="col-1">City</th>
                    <th class="col-1">Primary Language</th>
                    <th class="col-2">Company</th>
                    <th class="col-3">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($associates as $associate)
                    <tr>
                        <td>{{$associate->first_name . ' ' . $associate->last_name}}</td>
                        <!-- todo add db field for status -->
                        <td>Active</td>
                        <td>{{$associate->country}}</td>
                        <td>{{$associate->city}}</td>
                        <td>{{$associate->associateData ? $associate->associateData->primary_language : ''}}</td>
                        <td>{{$associate->company}}</td>
                        <td>
                            <div class="row">
                                <div class="col-3">
                                    <a href="/admin/associate/edit/{{$associate->user_id}}">
                                        <button class="btn btn-warning w-100">
                                            edit
                                        </button>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="/admin/associate/profile/{{$associate->user_id}}">
                                        <button class="btn btn-primary w-100">
                                            profile
                                        </button>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="/admin/associate/profilePDF/{{$associate->user_id}}">
                                        <button class="btn btn-success w-100">
                                            view
                                        </button>
                                    </a>
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger w-100">
                                        deactivate
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="w-100 d-flex justify-content-center align-items-middle">
                <div>
                    {{ $associates->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
