@extends('layout')


@push('page-title')
    Students
@endpush

@section('add-btn')
    <a href="{{ route('school_admin.students.create') }}" class="btn btn-primary">Admit Student</a>
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th>SN</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Email</th>
                            {{-- @if ($page_name == 'Parents')
                                <th>Profession</th>
                            @endif --}}

                            <th>Actions </th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($students as $student)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td>
                                    <div class="user-avatar">
                                        <a href="https://twitter.com/twcloudchen" class="circle">
                                            <img src="@if ($student->image != null) {{ asset('storage/' . $student->image) }} @else https://bootdey.com/img/Content/avatar/avatar7.png @endif"
                                                alt="Admin" class="rounded-circle" width="40" height="40" />
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $student->name }}</td>

                                <td>{{ $student->address }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->email }}</td>



                                <td>

                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('school_admin.students.show', $student->id) }}">Details</a>

                                </td>


                            </tr>
                        @endforeach
                        {{-- @endif --}}


                    </tbody>

                </table>
            </div>
            {{ $students->links() }}
        </div>
    </div>
@endsection
