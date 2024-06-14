@extends('layout')

@push('page-title')
    Subjects
@endpush

@section('add-btn')
    <a class="btn btn-primary" href="{{ route('school_admin.subjects.create') }}">
        Add Subject
    </a>
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Class List</h5>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>

                            <th>Class</th>
                            <th>Teacher</th>
                            <th>Full Marks</th>
                            <th>Pass Marks</th>


                            <th>Actions </th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($subjects as $subject)
                            <tr>
                                <td>{{ $subject->name }}</td>

                                <td>
                                    {{ $subject->classes->name }}
                                </td>
                                <td>
                                    <a href="{{ route('school_admin.staffs.show', $subject->teacher->user->id) }}">
                                        {{ $subject->teacher->user->name }}
                                    </a>
                                </td>
                                <td>{{ $subject->full_marks }}</td>
                                <td>{{ $subject->pass_marks }}</td>

                                <td class="d-flex gap-2">
                                    <div class="btn btn-sm btn-primary">Update</div>
                                    <form action="{{ route('school_admin.subjects.destroy', $subject->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')

                                        <button class="btn btn-sm btn-danger">Delete
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
                {{ $subjects->links() }}
            </div>
        </div>
    </div>
@endsection
