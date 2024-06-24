@extends('layout')


@push('page-title')
    {{ $examData['exam_name'] }}
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
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>


                            <th>Subject</th>
                            <th>Class</th>
                            <th>Full Marks</th>

                            <th>Pass Marks </th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($examData['subjects'] as $subject)
                            <tr>

                                <td> {{ $subject['subject_name'] }} </td>
                                <td> {{ $subject['class']['class_name'] }} </td>
                                <td> {{ $subject['full_marks'] }} </td>
                                <td> {{ $subject['pass_marks'] }} </td>

                            </tr>
                        @endforeach




                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
