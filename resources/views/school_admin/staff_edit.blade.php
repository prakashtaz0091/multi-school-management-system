@extends('layout')


@push('page-title')
    Update Staff
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
    <a href="{{ route('school_admin.staffs.index') }}" class="btn btn-primary">Back</a>
@endsection

@section('content')
    <!-- Modal -->
    <div class="container">
        <div class="modal-header">
            <h4 class="modal-title" id="staticBackdropLabel">
                Staff Update Form
            </h4>
        </div>
        <div class="modal-body">
            <form id="formForAll" action="{{ route('school_admin.staffs.update', $user->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="full_name" value="{{ $user->name }}" name="full_name"
                        placeholder="Fullname" value="{{ old('full_name') }}" required />
                    <label for="full_name">Fullname</label>
                    <p class="text-danger">{{ $errors->first('full_name') }}</p>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="address" value="{{ $user->address }}"
                                name="address" placeholder="Address" required value="{{ old('address') }}" />
                            <label for="address">Address</label>
                            <p class="text-danger">{{ $errors->first('address') }}</p>

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="dob" value="{{ $user->dob }}"
                                name="dob" placeholder="Date of Birth" required value="{{ old('dob') }}" />
                            <label for="dob">Date of Birth</label>
                            <p class="text-danger">{{ $errors->first('dob') }}</p>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">

                            <label for="email">E-Mail : {{ $user->email }}</label>
                            <small>(You can't change E-Mail)</small>
                            <p class="text-danger">{{ $errors->first('email') }}</p>

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" value="{{ $user->phone }}" id="contact_number"
                                name="contact_number" placeholder="Contact Number" required
                                value="{{ old('contact_number') }}" inputmode="numeric" />
                            <label for="contact_number">Contact Number</label>
                            <p class="text-danger">{{ $errors->first('contact_number') }}</p>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="gender" name="gender"
                                aria-label="Floating label select example" required>
                                <option selected>Choose your gender...</option>
                                <option value="male" @if (old('gender') == 'male' || $user->gender == 'male') selected @endif>Male</option>
                                <option value="female" @if (old('gender') == 'female' || $user->gender == 'female') selected @endif>Female</option>
                                <option value="others" @if (old('gender') == 'others' || $user->gender == 'others') selected @endif>Others</option>
                            </select>
                            <label for="gender">Gender</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">

                            <input class="form-control" type="file" id="profile_pic" name="profile_pic">
                            <label for="profile_pic">Profile Picture</label>
                        </div>
                    </div>
                </div>





                <div id="staffDiv">
                    <!-- Content for Staff div -->
                    <h4>Staff Information</h4>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="staff_type" name="staff_type"
                            aria-label="Floating label select example" required>
                            <option selected>Choose staff_type...</option>
                            <option value="teacher" @if (old('staff_type') == 'teacher' || $user->staff->staff_type == 'teacher') selected @endif>Teacher</option>
                            <option value="helper" @if (old('staff_type') == 'helper' || $user->staff->staff_type == 'helper') selected @endif>Helper</option>
                            <option value="driver" @if (old('staff_type') == 'driver' || $user->staff->staff_type == 'driver') selected @endif>Driver</option>
                            <option value="others" @if (old('staff_type') == 'others' || $user->staff->staff_type == 'others') selected @endif>Others</option>
                        </select>
                        <label for="staff_type">Staff Type</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" value="{{ $user->staff->salary }}" id="salary"
                            name="salary" placeholder="Salary" required value="{{ old('salary') }}" />
                        <label for="salary">Salary</label>
                    </div>
                    <!-- Add relevant form fields or content for Staff -->
                </div>




                <button type="submit" class="btn btn-primary float-start">
                    Submit
                </button>
            </form>
        </div>
    </div>
    </div>
@endsection
