@extends('layout.layout')

@push('page-title')
    {{ $staff->user->name }}
@endpush


@section('add-btn')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('staffs.index') }}" class="btn btn-primary">Back</a>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 align-items-center">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="@if ($staff->user->profile_pic != null && $staff->user->profile_pic != '') {{ asset('storage/' . $staff->user->profile_pic) }} @else https://bootdey.com/img/Content/avatar/avatar7.png @endif"
                                                alt="Admin" class="rounded-circle" width="150" />
                                            <div class="mt-3">
                                                <h4> {{ $staff->user->name }} | {{ $staff->user->gender }}
                                                </h4>
                                                <p class="text-secondary mb-1">
                                                    @if ($staff->is_teacher)
                                                        {{-- check if teacher is class teacher --}}
                                                        Class Teacher : class 9
                                                    @endif
                                                </p>
                                                <p class="text-muted font-size-sm">
                                                    {{ $staff->user->address }}

                                                </p>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <a href="" class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">Edit</a>
                                                    <form action="{{ route('staffs.destroy', $staff->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger">Delete</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="card-heading text-center mb-4">
                                            <h3 class="">Staff's Information:</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $staff->user->name }}

                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary"> {{ $staff->user->email }}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $staff->user->contact }}

                                            </div>
                                        </div>

                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $staff->user->address }}

                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Salary</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $staff->salary }}

                                            </div>
                                        </div>
                                        <hr />
                                        <div class="d-flex justify-content-between flex-wrap gap-2">

                                            <a href="" class="btn btn-primary flex-grow-1">Salary History</a>
                                            <a href="" class="btn btn-primary flex-grow-1">View Complaints</a>
                                            <a href="" class="btn btn-primary flex-grow-1">Remaining Payments</a>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('staffs.update', $staff->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" value="{{ $staff->user->name }}"
                                placeholder="Fullname" name="full_name" />

                            <label for="floatingInput">Fullname</label>
                            <p class="text-danger">
                                {{ $errors->first('full_name') }}
                            </p>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" value="{{ $staff->user->address }}"
                                id="floatingInput" placeholder="Address" name="address" />
                            <label for="floatingInput">Address</label>
                            <p class="text-danger">
                                {{ $errors->first('address') }}
                            </p>
                        </div>
                        <div class="row">

                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $staff->user->contact }}""
                                        id="floatingInput" placeholder="Contact Number" name="contact_number" />
                                    <label for="floatingInput">Contact Number</label>
                                    <p class="text-danger">
                                        {{ $errors->first('contact_number') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="dob" name="dob"
                                        placeholder="Date of Birth" value="{{ $staff->user->dob }}" required />
                                    <label for="dob">Date of Birth</label>
                                    <p class="text-danger">
                                        {{ $errors->first('dob') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                                name="gender">

                                <option value="1" @if ($staff->user->gender == 'male') selected @endif>Male</option>
                                <option value="2" @if ($staff->user->gender == 'female') selected @endif>Female</option>
                                <option value="3" @if ($staff->user->gender == 'others') selected @endif>Others</option>
                            </select>
                            <label for="floatingSelect">Gender</label>
                        </div>
                        <div id="staffDiv">
                            <!-- Content for Staff div -->
                            <h3>Staff Information</h3>
                            <div class="form-check d-flex justify-content-start gap-3">
                                <input class="form-check-input" type="checkbox" value="on" id="is_teacher"
                                    name="is_teacher" @if ($staff->is_teacher) checked @endif>
                                <label class="form-check-label" for="is_teacher">
                                    Is Teacher
                                </label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="salary" name="salary"
                                    placeholder="Salary" value="{{ $staff->salary }}" required />
                                <label for="salary">Salary</label>
                                <p class="text-danger">
                                    {{ $errors->first('salary') }}
                                </p>
                            </div>
                            <!-- Add relevant form fields or content for Staff -->
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text" for="profile_pic">Upload</label>
                            <input type="file" class="form-control" id="profile_pic" name="profile_pic" />
                            <p class="text-danger">
                                {{ $errors->first('profile_pic') }}
                            </p>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
