@extends('layout')


@push('page_title')
    School Admin Dashboard
@endpush('page_title')


@section('internal-css')
    <style>
        .c-card {
            height: 170px;
            margin: 10px;
            background-color: white;
            border-radius: 10px;

            /* box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset,
                                    rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset,
                                    rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset,
                                    rgba(0, 0, 0, 0.06) 0px 2px 1px,
                                    rgba(0, 0, 0, 0.09) 0px 4px 2px,
                                    rgba(0, 0, 0, 0.09) 0px 8px 4px,
                                    rgb(0 0 0 / 21%) 0px 16px 8px,
                                    rgba(0, 0, 0, 0.09) 0px 32px 16px; */
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;

            /* box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px; */
            width: 100%;
        }

        .c-card:hover {
            /* box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px; */
            box-shadow: rgb(38, 57, 77) 0px 10px 30px -10px;

        }

        a {
            color: black;
        }

        a:hover {
            color: blue;
        }

        .exo-2-font {
            font-family: "Exo 2", sans-serif;
            font-optical-sizing: auto;
            font-weight: 800;
            font-style: normal;
            font-size: 2rem;
        }
    </style>
@endsection


@section('content')
    <div class="container d-flex flex-column gap-3">
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <a href="{{ route('school_admin.students.index') }}"
                    class="c-card exo-2-font d-flex flex-column justify-content-center align-items-center">
                    <span>
                        {{ $students }}
                    </span>
                    <span><small>Students</small></span>
                </a>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <a href="{{ route('school_admin.staffs.index') }}"
                    class="c-card exo-2-font d-flex flex-column justify-content-center align-items-center">
                    <span>
                        {{ $staffs }}
                    </span>
                    <span><small>Staffs</small></span>
                </a>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <a href="{{ route('school_admin.guardians.index') }}"
                    class="c-card exo-2-font d-flex flex-column justify-content-center align-items-center">
                    <span>
                        {{ $guardians }}
                    </span>
                    <span><small>Guardians</small></span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <a href="{{ route('school_admin.classes.index') }}"
                    class="c-card exo-2-font d-flex flex-column justify-content-center align-items-center">
                    <span>
                        {{ $classes }}
                    </span>
                    <span><small>Classes</small></span>
                </a>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <a href="{{ route('school_admin.subjects.index') }}"
                    class="c-card exo-2-font d-flex flex-column justify-content-center align-items-center">
                    <span>
                        {{ $subjects }}
                    </span>
                    <span><small>Subjects</small></span>
                </a>
            </div>
        </div>
    </div>
@endsection
