@extends('layout')


@push('page-title')
    Admission Form
@endpush

@section('content')
    @error('email')
        {{ $message }}
    @enderror



    <!-- Modal -->
    <div class="container">
        <div class="modal-header">
            <h4 class="modal-title" id="staticBackdropLabel">
                Registration Form
            </h4>
        </div>
        <div class="modal-body">
            <form id="formForAll" action="{{ route('school_admin.staffs.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Fullname"
                        value="{{ old('full_name') }}" required />
                    <label for="full_name">Fullname</label>
                    <p class="text-danger">{{ $errors->first('full_name') }}</p>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address"
                                required value="{{ old('address') }}" />
                            <label for="address">Address</label>
                            <p class="text-danger">{{ $errors->first('address') }}</p>

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="dob" name="dob"
                                placeholder="Date of Birth" required value="{{ old('dob') }}" />
                            <label for="dob">Date of Birth</label>
                            <p class="text-danger">{{ $errors->first('dob') }}</p>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="E-Mail"
                                required value="{{ old('email') }}" />
                            <label for="email">E-Mail</label>
                            <p class="text-danger">{{ $errors->first('email') }}</p>

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="contact_number" name="contact_number"
                                placeholder="Contact Number" required value="{{ old('contact_number') }}"
                                inputmode="numeric" />
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
                                <option value="male" @if (old('gender') == 'male') selected @endif>Male</option>
                                <option value="female" @if (old('gender') == 'female') selected @endif>Female</option>
                                <option value="others" @if (old('gender') == 'others') selected @endif>Others</option>
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




                <div class="row">
                    <div class="col">

                        <div>
                            <!-- Content for Staff div -->
                            <h4>Student Information</h4>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="student_class" name="student_class"
                                    aria-label="Floating label select example" required>
                                    <option selected>Choose class...</option>
                                    <option value="class_1">Class 1</option>
                                    <option value="class_1">Class 2</option>
                                    <option value="class_1">Class 3</option>
                                    <option value="class_1">Class 4</option>
                                    <option value="class_1">Class 5</option>
                                    <option value="class_1">Class 6</option>
                                    <option value="class_1">Class 7</option>
                                </select>
                                <label for="student_class">Class</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            <!-- Content for Staff div -->
                            <h4>Guardian Information</h4>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="student_class" name="student_class"
                                    aria-label="label select example" required multiple>
                                    <option value="class_1">Ram bahadur</option>
                                    <option value="class_1">Sita Maaya</option>
                                    <option value="class_1">shyam poudel</option>
                                    <option value="class_1">Rita Thakur</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>




                <button type="submit" class="btn btn-primary float-start">
                    Submit
                </button>
            </form>
        </div>
    </div>
    </div>
@endsection
