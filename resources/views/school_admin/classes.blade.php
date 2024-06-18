@extends('layout')


@push('page-title')
    Classes
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


    <a href="{{ route('school_admin.classes.create') }}" class="btn btn-primary">Add Class</a>
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th>Year (Batch)</th>
                            <th>Name</th>
                            <th>Class Teacher</th>
                            <th>Room No.</th>
                            <th> Students</th>


                            <th>Actions </th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($classes as $class)
                            <tr>
                                <td> {{ $class->year == '' ? 'N/A' : $class->year }} </td>

                                <td>{{ $class->name }}</td>
                                <td>{{ $class->class_teacher == null ? 'N/A' : $class->class_teacher->user->name }}</td>

                                <td>{{ $class->room_no }}</td>
                                <td>count</td>



                                <td>

                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('school_admin.classes.edit', $class->id) }}">Edit</a>

                                </td>


                            </tr>
                        @endforeach
                        {{-- @endif --}}


                    </tbody>

                </table>
            </div>
            {{ $classes->links() }}
        </div>
    </div>
@endsection
