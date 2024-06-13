@extends('layout')

@push('page-title')
    {{ $student->user->name }}
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
    <a href="{{ route('school_admin.students.index') }}" class="btn btn-primary">Back</a>
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
                                            {{-- {{ $student->user->image }} --}}
                                            <img src="@if ($student->user->image != null) {{ asset('storage/' . $student->user->image) }} @else https://bootdey.com/img/Content/avatar/avatar7.png @endif"
                                                alt="Admin" class="rounded-circle" width="150" />
                                            <div class="mt-3">
                                                <h4> {{ $student->user->name }} | {{ $student->user->gender }}
                                                </h4>
                                                <p class="text-secondary mb-1">
                                                    {{ $student->classes->name }}
                                                </p>
                                                <p class="text-muted font-size-sm">
                                                    {{ $student->user->address }}

                                                </p>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <a href="{{ route('school_admin.students.edit', $student->id) }}"
                                                        class="btn btn-success">Edit</a>
                                                    <form
                                                        action="{{ route('school_admin.students.destroy', $student->id) }}"
                                                        method="post">
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
                                            <h3 class="">Student's Information:</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $student->user->name }}

                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary"> {{ $student->user->email }}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $student->user->phone }}

                                            </div>
                                        </div>

                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $student->user->address }}

                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Guardians</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                @foreach ($student->guardians as $guardian)
                                                    <ul>
                                                        <li>{{ $guardian->user->name }}</li>

                                                    </ul>
                                                @endforeach

                                            </div>
                                        </div>
                                        <hr />
                                        <div class="d-flex justify-content-between flex-wrap gap-2">

                                            <a href="" class="btn btn-primary flex-grow-1">Payment History</a>
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
@endsection
