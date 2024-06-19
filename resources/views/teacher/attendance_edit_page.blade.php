@extends('teacher.layout')

@section('title')
    Attendance Edit
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
                <button id="reset" class="mt-4 btn btn-warning"
                    onclick="window.location.href='{{ route('teacher.editAttendance', $attendance_records[0]->created_at->format('Y-m-d')) }}'">Reset</button>

            </div>
            <hr>
            <form action="{{ route('teacher.attendence_update', $attendance_records[0]->created_at->format('Y-m-d')) }}"
                method="post">
                @csrf
                <input type="hidden" name="class_id" value="{{ $class->id }}">
                @foreach ($attendance_records as $record)
                    <div class="mx-2 my-2 d-flex align-items-center gap-2">
                        <input class="attendence-checkbox" type="checkbox" name="students[]"
                            value="{{ $record->student->id }}" id="{{ $record->student->id }}"
                            @if ($record->status == 'present') checked @endif>
                        <label for="{{ $record->student->id }}"><strong>
                                {{ $record->student->user->name }}</strong></label>
                    </div>
                    <hr>
                @endforeach

                <button type="submit" class="btn btn-primary">Update</button>
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
    </script>
@endsection
