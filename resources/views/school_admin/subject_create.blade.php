@extends('layout')


@push('page-title')
    Add Subject
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
    <a href="{{ route('school_admin.subjects.index') }}" class="btn btn-primary">Back</a>
@endSection

@section('content')
    <!-- Modal -->
    <div class="container">

        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="">
                        <form action="{{ route('school_admin.subjects.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label float-start">Subject Name *</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="eg. English" required />
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="subject_code" class="form-label float-start">Subject code</label>
                                        <input type="text" class="form-control" name="subject_code" id="subject_code"
                                            placeholder="eg. ENG101 (optional)" />
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="full_marks" class="form-label float-start">Full Marks *</label>
                                        <input type="number" placeholder="eg. 100" class="form-control" name="full_marks"
                                            id="full_marks" required />
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pass_marks" class="form-label float-start">Pass Marks *</label>
                                        <input type="number" placeholder="eg. 32" class="form-control" name="pass_marks"
                                            id="pass_marks" required />
                                    </div>

                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label float-start">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="(optional)"></textarea>

                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <select class="form-select" id="class-id" name="class_id" title="Select Class"
                                            required>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <select class="form-select" id="teacher-id" name="teacher_id" title="Select Teacher"
                                            required>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->user->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-start">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection
