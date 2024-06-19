@extends('teacher.layout')

@section('title')
    Attendance History
@endsection


@section('content')
    @php
        use Carbon\Carbon;

        // Assuming $record_date is already available in the context

    @endphp


    @if (session()->has('warning'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto text-warning">!Attendance Alert</strong>
                    <small>just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('warning') }}, {{ now()->toDayDateTimeString() }}
                </div>
            </div>
        </div>
    @endif
    <div class="container py-5">
        <div class="d-flex justify-content-between algin-items-center mb-2">
            <div class="badge bg-primary pb-0">
                <h5>{{ $class_name }}</h5>
            </div>

            <form action="{{ route('teacher.filterRecordsByDate') }}" method="get">
                <div class="d-flex gap-2 align-items-center">
                    <input class="form-control" type="date" name="start_date" id="start_date">
                    <span>to</span>
                    <input class="form-control" type="date" name="end_date" id="end_date">

                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Present</th>
                    <th scope="col">Absent</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($attendance_records as $record_date => $record)
                    @php
                        $date_obj = Carbon::parse($record_date);
                    @endphp
                    <tr title="Click this to view details">
                        <td>{{ $date_obj->toFormattedDateString() }}
                        <td>{{ $record['present_count'] }}</td>
                        <td>{{ $record['absent_count'] }}</td>
                        <td>
                            <a href="" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
