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
            <div class="row m-0 text-white">
                <div class="col-3 profile-blue">
                    <div id="profile-image" class="w-100">

                    </div>
                    <div class="w-100 row m-0">
                        <div class="col-6">
                            <input type="text" name='firstName' class="form-control" id="firstName" value="{{$associate->first_name}}" placeholder="{{$associate->first_name}}">
                        </div>
                        <div class="col-6">
                            <input type="text" name='lastName' class="form-control" id="lastName" value="{{$associate->last_name}}" placeholder="{{$associate->last_name}}">
                        </div>
                    </div>
                    <div class="w-100">
                        <p class="fs-3">
                            OSCAR IS A FACILITATOR, MENTOR, ACCREDITED COACH AND AN INTERNATIONAL SPEAKER WITH NATIONAL AND INTERNATIONAL EXPERIENCE IN EVALUATING AND INTERPRETING LEARNING NEEDS
                        </p>
                    </div>
                    <div class="w-100">
                        <span class="fs-3 bold">CREDENTIALS</span><br>
                        <p class="fs-4">
                            Certification for DISC/Behaviour
                            Strength Deployment Inventory (SDI) Facilitator
                            Emotional Intelligence Accreditation (EIP)
                            Leadership Climate Accreditation (LCI)
                            Level 5 Coaching and Mentoring in Management, ILM
                            Master Practitioner Neuro Linguistic Programming (NLP)
                        </p>
                    </div>
                </div>
                <div class="col-9">

                </div>
            </div>
            <div class="col-2 float-end px-5 py-1">
                <button type="submit" class="btn btn-success w-100">Save</button>
            </div>
        </fieldset>
    </form>
@endsection
