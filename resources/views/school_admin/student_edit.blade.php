@extends('layout')


@push('page-title')
    Update {{ $student->user->name }}'s Information
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
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>

@endsection

@section('content')
    @error('email')
        {{ $message }}
    @enderror



    <!-- Modal -->
    <div class="container">
        <div class="modal-header">
            <h4 class="modal-title" id="staticBackdropLabel">
                Update Information Form
            </h4>
        </div>
        <div class="modal-body">
            <form action="{{ route('school_admin.students.update', $student->user->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="full_name" name="full_name"
                        value="{{ $student->user->name }}" placeholder="Fullname" value="{{ old('full_name') }}" required />
                    <label for="full_name">Fullname</label>
                    <p class="text-danger">{{ $errors->first('full_name') }}</p>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" value="{{ $student->user->address }}" id="address"
                                name="address" placeholder="Address" required value="{{ old('address') }}" />
                            <label for="address">Address</label>
                            <p class="text-danger">{{ $errors->first('address') }}</p>

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" value="{{ $student->user->dob }}" id="dob"
                                name="dob" placeholder="Date of Birth" required value="{{ old('dob') }}" />
                            <label for="dob">Date of Birth</label>
                            <p class="text-danger">{{ $errors->first('dob') }}</p>

                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="contact_number"
                                value="{{ $student->user->phone }}" name="contact_number" placeholder="Contact Number"
                                required value="{{ old('contact_number') }}" inputmode="numeric" />
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
                                <option value="male" @if ($student->user->gender == 'male') selected @endif>Male</option>
                                <option value="female" @if ($student->user->gender == 'female') selected @endif>Female</option>
                                <option value="others" @if ($student->user->gender == 'others') selected @endif>Others</option>

                            </select>
                            <label for="gender">Gender</label>
                            <p class="text-danger">{{ $errors->first('gender') }}</p>

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">

                            <input class="form-control" type="file" id="profile_pic" name="profile_pic">
                            <label for="profile_pic">Profile Picture</label>
                            <p class="text-danger">{{ $errors->first('profile_pic') }}</p>

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

                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            @if ($class->id == $student->classes->id) selected @endif>
                                            {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <label for="student_class">Class</label>
                                <p class="text-danger">{{ $errors->first('student_class') }}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            <!-- Content for Staff div -->
                            <h4>Guardian Information</h4>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="guardians" name="guardians[]"
                                    aria-label="label select example" required multiple>

                                    @foreach ($guardians as $guardian)
                                        <option value="{{ $guardian->id }}"
                                            @foreach ($student->guardians as $st_guardian)
                                                @if ($guardian->id == $st_guardian->id)
                                                    selected
                                                @endif @endforeach>
                                            {{ $guardian->user->name }}</option>
                                    @endforeach

                                </select>
                                <p class="text-danger">{{ $errors->first('guardians') }}</p>

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
