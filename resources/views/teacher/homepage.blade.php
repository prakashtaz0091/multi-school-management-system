@extends('teacher.layout')


@section('internal-css')
    <style>
        body {
            background-color: azure;
        }

        .card {
            border: none;
            background-color: azure;
        }

        .row {
            border: none;

        }

        .profile-card,
        .profile-desc {
            box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 48px;

        }
    </style>
@endsection


@section('content')
    <div class="container d-md-flex align-items-center justify-content-center" style="height: 80vh">
        <div class="row">
            <div class="col-md-12 align-items-center">
                <div class="card mt-4">

                    <div class="card-body">
                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3 d-flex align-items-center profile-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div
                                            class="d-flex flex-column align-items-center justify-content-center text-center">
                                            <img src="@if ($teacher->image != null) {{ asset('storage/' . $teacher->image) }} @else https://bootdey.com/img/Content/avatar/avatar7.png @endif"
                                                alt="Admin" class="rounded-circle" width="150" />
                                            <div class="mt-3">
                                                <h4> {{ $teacher->name }} | {{ $teacher->gender }}
                                                </h4>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3  profile-desc">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $teacher->name }}

                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary"> {{ $teacher->email }}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $teacher->phone }}

                                            </div>
                                        </div>

                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $teacher->address }}

                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Salary</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $teacher->staff->salary }}

                                            </div>
                                        </div>
                                        <hr />


                                        <div class="d-flex justify-content-between flex-wrap gap-2">

                                            <a href="" class="btn btn-primary flex-grow-1">Salary History</a>
                                            <a href="" class="btn btn-primary flex-grow-1">Make Complaint</a>
                                            <a href="" class="btn btn-primary flex-grow-1">Remaining Salary</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
