@extends('layout')

@push('page-title')
    Exams
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

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <a href="{{ route('school_admin.exams.create') }}" class="btn btn-primary">Add Exam</a>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>


                            <th>Name</th>
                            <th>Exam Type</th>

                            <th>Actions </th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($exams as $exam)
                            <tr>

                                <td> {{ $exam->name }} </td>
                                <td> {{ $exam->exam_type }} </td>
                                <td>

                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('school_admin.exams.addSubjects', $exam->id) }}">Add Subjects</a>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('school_admin.exams.show', $exam->id) }}">Exam Details</a>

                                </td>
                            </tr>
                        @endforeach




                    </tbody>

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
