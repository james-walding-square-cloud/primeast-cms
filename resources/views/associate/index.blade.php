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
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            deactivate
                                        </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Deactivate User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to Deactivate {{$associate->first_name . ' ' . $associate->last_name}}
                                </div>
                                <div class="modal-footer">
                                    <a href="/admin/associate/deactivate/{{$associate->user_id}}">
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                    </a>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
                @endforeach
                </tbody>
            </table>
            <div class="w-100 d-flex justify-content-center align-items-middle">
                <div>
                    {{ $associates->links() }}
                </div>
            </div>
            <div class="col-12">
                <div class="col-2 float-end px-5 py-2">
                    <a href="/admin/associate/create">
                        <button type="submit" class="btn btn-success w-100">Create</button>
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
