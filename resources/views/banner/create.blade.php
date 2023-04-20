@extends('layouts.app')

@section('content')
    <div class="py-3">
        <div class="row"></div>
        <h1 class="text-center">Create Banner</h1>
        <hr>
    </div>
    <form action="/admin/banner/store" method="post">
        {{ csrf_field() }}
        <fieldset>
            <!-- Personal Details -->
            <div class="card m-2 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Banner Details</h5>
                    <div class="row col-12 px-5">
                        <input type="int" hidden name="id" value="{{$banner_id}}">

                    </div>
                    <div class="col-12 px-5 pt-5">
                        <div class="col p-1 row">
                            <div class="col p-1 row">
                                <div class="col-3">
                                    <label for="name" class="form-label py-1">Name</label>
                                </div>
                                <div class="col-9">
                                    <input required type="text" name='name' class="form-control" id="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="col row">
                                <label for="startDate" class="form-label py-1 col-3">Start Date</label>
                                <div id="startDate" class="col-9">
                                    <input name="image" id="image" type="date">
                                </div>
                            </div>
                            <div class="col row">
                                <label for="endDate" class="form-label py-1 col-3">End Date</label>
                                <div id="endDate" class=" col-9">
                                    <input name="image" id="image" type="date">
                                </div>
                            </div>
                        </div>
                        <div class="col p-1 row">

                        </div>
                    </div>
                </div>
            </div>
            <div class="card m-2 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Banner Text</h5>
                </div>
                <div class="row pe-5">
                    <div class="row col px-5">
                        <div class="col-2">
                            <label for="linkText" class="form-label py-1">Link Text</label>
                        </div>
                        <div class="col-10">
                            <input required type="linkText" name='linkText' class="form-control" id="linkText" placeholder="linkText">
                        </div>
                    </div>
                    <div class="col row">
                        <div class="col-2">
                            <label for="linkUrl" class="form-label py-1">Link Url</label>
                        </div>
                        <div class="col-10">
                            <input required type="linkUrl" name='linkUrl' class="form-control" id="linkUrl" placeholder="link Url">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col row px-5">
                        <div class="col-1">
                            <label for="description" class="form-label py-1">Description</label>
                        </div>
                        <div class="col-11">
                            <input required type="description" name='description' class="form-control" id="description" placeholder="description">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card m-2 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Image</h5>
                </div>
                <div class="row col-12 px-5">
                    <div class="col p-1 row">
                        <div class="col-12 row pt-5">
                            <div class="col">
                                <div>Upload image to preview</div>
                            </div>
                            <div id="image" class="col-2">
                                <input name="image" id="image" type="file">
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
