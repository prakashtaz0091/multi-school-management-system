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

        input[type="checkbox"] {
            transform: scale(1.5);
            /* Adjust the scale factor as needed */
            -webkit-transform: scale(1.5);
            /* For Safari */
            -moz-transform: scale(1.5);
            /* For Firefox */
            -ms-transform: scale(1.5);
            /* For Internet Explorer */
            -o-transform: scale(1.5);
            /* For Opera */
            margin: 10px;
            /* Optional: adjust the margin if necessary */
        }
    </style>
@endsection


@section('content')
    <div class="container">

        <h5 class="mt-4" style="text-decoration: underline">{{ $class->name }} - Attendence - {{ now()->format('d M Y') }}
            - {{ now()->format('h:i A') }} - {{ now()->format('l') }}
        </h5>
        <small>Click on checkbox or student name to mark student as present</small>

        <div class="container">
            <div class="d-flex gap-2">
                <button id="all-present" class="mt-4 btn btn-success">All Present</button>
                <button id="reset" class="mt-4 btn btn-warning">Reset</button>

            </div>
            <hr>
            <form action="{{ route('teacher.attendence_store') }}" method="post">
                @csrf
                <input type="hidden" name="class_id" value="{{ $class->id }}">
                @foreach ($students as $student)
                    <div class="mx-2 my-2 d-flex align-items-center gap-2">
                        <input class="attendence-checkbox" type="checkbox" name="students[]" value="{{ $student->id }}"
                            id="{{ $student->id }}">
                        <label for="{{ $student->id }}"><strong>
                                {{ $student->user->name }}</strong></label>
                    </div>
                    <hr>
                @endforeach

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>

    <script>
        const allPresentBtn = document.getElementById('all-present');
        const resetBtn = document.getElementById('reset');

        resetBtn.disabled = true;

        allPresentBtn.addEventListener('click', () => {
            const checkboxes = document.querySelectorAll('.attendence-checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = true;
            });
            allPresentBtn.disabled = true;
            resetBtn.disabled = false;
        });

        resetBtn.addEventListener('click', () => {
            const checkboxes = document.querySelectorAll('.attendence-checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = false;
            });
            resetBtn.disabled = true;
            allPresentBtn.disabled = false;
        });
    </script>
@endsection
