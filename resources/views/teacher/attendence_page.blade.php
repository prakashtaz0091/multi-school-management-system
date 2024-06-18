@extends('teacher.layout')

@section('title')
    Attendance
@endsection
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
    <div class="container">
        <div class="row">
            <select class="form-select" aria-label="Default select example">
                <option selected>Select class</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endsection
