@extends('layouts.app')

@section('content')
    <div>
        <form action="/admin/banner/index">
            <fieldset>
                <div class="search p-5 row text-center">
                    <div class="col-2">
                        <label for="searchName" class="form-label">
                            Name
                        </label>
                        <input type="text" name="searchName" id="searchName" class="form-control" value="{{$name ?? ''}}">
                    </div>
                    <div class="col-2">
                        <label for="searchStartDate" class="form-label">
                            Start Date
                        </label>
                        <input type="date" name="searchStartDate" id="searchStartDate" class="form-control" value="{{$startDate ?? ''}}">
                    </div>
                    <div class="col-2">
                        <label for="searchEndDate" class="form-label">
                            End Date
                        </label>
                        <input type="date" name="searchEndDate" id="searchName" class="form-control" value="{{$endDate ?? ''}}">
                    </div>
                </div>
            </fieldset>
        </form>

        <div class="results py-2">
            <div class="w-100 d-flex justify-content-center align-items-middle">
                <div>
{{--                    {{ $banners->links() }}--}}
                </div>
            </div>
            <table class="table-striped table text-center">
                <thead>
                <tr>
                    <th class="col-2">Name</th>
                    <th class="col-1">Active</th>
                    <th class="col-1">Start Date</th>
                    <th class="col-1">End Date</th>
                    <th class="col-3">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <td>{{$banner->name}}</td>
                        <td>{{$banner->active}}</td>
                        <td>{{$banner->start_date}}</td>
                        <td>{{$banner->end_date}}</td>
                        <td>
                            <div class="row m-0">
                                <div class="col-6 col-xl">
                                    <a href="/admin/associate/edit/{{$banner->id}}">
                                        <button class="btn btn-warning w-100">
                                            edit
                                        </button>
                                    </a>
                                </div>
                                <div class="col-6 col-xl">
                                        <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$banner->id}}">
                                            archive
                                        </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop{{$banner->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Archive User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to Archive {{$banner->name}}
                                </div>
                                <div class="modal-footer">
                                    <a href="/admin/associate/deactivate/{{$banner->id}}">
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
{{--                    {{ $banners->links() }}--}}
                </div>
            </div>
            <div class="col-12">
                <div class="col-2 float-end px-5 py-2">
                    <a href="/admin/banner/create">
                        <button type="submit" class="btn btn-success w-100">Create</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).on('click', '.pagination li a', function (e) {
            e.preventDefault();
            if ($(this).attr('href')) {
                var queryString = '';
                var allQueries = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                if(allQueries[0].split('=').length >1){
                    for (var i = 0; i < allQueries.length; i++) {
                        var hash = allQueries[i].split('=');
                        if (hash[0] !== 'page') {
                            queryString += '&' + hash[0] + '=' + hash[1];
                        }
                    }
                }
                window.location.replace($(this).attr('href') + queryString);
            }
        });

    </script>


@endsection
