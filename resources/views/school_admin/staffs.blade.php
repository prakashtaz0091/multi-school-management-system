@extends('layout')

@push('page-title')
    Staffs
@endpush


@section('add-btn')
    <!-- Button trigger modal -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @error('email')
        {{ $message }}
    @enderror

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Add Staffs
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Registration Form
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formForAll" action="{{ route('school_admin.staffs.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="full_name" name="full_name"
                                placeholder="Fullname" value="{{ old('full_name') }}" required />
                            <label for="full_name">Fullname</label>
                            <p class="text-danger">{{ $errors->first('full_name') }}</p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Address" required value="{{ old('address') }}" />
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
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="E-Mail" required value="{{ old('email') }}" />
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
                        <div class="form-floating mb-3">
                            <select class="form-select" id="gender" name="gender"
                                aria-label="Floating label select example" required>
                                <option selected>Choose your gender...</option>
                                <option value="1" @if (old('gender') == '1') selected @endif>Male</option>
                                <option value="2" @if (old('gender') == '2') selected @endif>Female</option>
                                <option value="3" @if (old('gender') == '3') selected @endif>Others</option>
                            </select>
                            <label for="gender">Gender</label>
                        </div>

                        {{-- <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupFile01">Profile Picture</label>
                            <input type="file" class="form-control" id="inputGroupFile01">
                        </div> --}}



                        <div id="staffDiv">
                            <!-- Content for Staff div -->
                            <h3>Staff Information</h3>
                            <div class="form-check d-flex justify-content-start gap-3">
                                <input class="form-check-input" type="checkbox" value="on" id="is_teacher"
                                    name="is_teacher" @if (old('is_teacher') == 'on') checked @endif>
                                <label class="form-check-label" for="is_teacher">
                                    Is Teacher
                                </label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="salary" name="salary"
                                    placeholder="Salary" required value="{{ old('salary') }}" />
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
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th>SN</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Email</th>
                            {{-- @if ($page_name == 'Parents')
                                <th>Profession</th>
                            @endif --}}

                            <th>Actions </th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($staffs as $staff)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td>
                                    <div class="user-avatar">
                                        <a href="https://twitter.com/twcloudchen" class="circle">
                                            {{-- <img src="@if ($staff->profile_pic != null && $staff->profile_pic != '') {{ asset('storage/' . $staff->profile_pic) }} @else https://bootdey.com/img/Content/avatar/avatar7.png @endif"
                                                alt="Admin" class="rounded-circle" width="40" height="40" /> --}}
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $staff->name }}</td>
                                <td>
                                    Teacher

                                </td>
                                <td>{{ $staff->address }}</td>
                                <td>{{ $staff->phone }}</td>
                                <td>{{ $staff->email }}</td>



                                <td>

                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('school_admin.staffs.show', $staff->id) }}">Details</a>

                                </td>


                            </tr>
                        @endforeach
                        {{-- @endif --}}


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SN</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Email</th>

                            <th>Actions </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('add-scripts')
    {{-- jquery cdn  --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    {{-- jquery cdn  --}}
@endsection
