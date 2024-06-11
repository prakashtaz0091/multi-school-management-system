@extends('layout')

@push('page-title')
    Staffs
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


    <a href="{{ route('school_admin.staffs.create') }}" class="btn btn-primary">Add Staff</a>
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
                            <th>Staff Role</th>
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

                        @foreach ($staffs as $staff)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td>
                                    <div class="user-avatar">
                                        <a href="https://twitter.com/twcloudchen" class="circle">
                                            <img src="@if ($staff->image != null) {{ asset('storage/' . $staff->image) }} @else https://bootdey.com/img/Content/avatar/avatar7.png @endif"
                                                alt="Admin" class="rounded-circle" width="40" height="40" />
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $staff->name }}</td>
                                <td>
                                    {{ $staff->staff->staff_type }}

                                </td>
                                <td>{{ $staff->address }}</td>
                                <td>{{ $staff->phone }}</td>
                                <td>{{ $staff->email }}</td>



                                <td>

                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('school_admin.staffs.show', $staff->id) }}">Details</a>

                                </td>


                            </tr>
                        @endforeach
                        {{-- @endif --}}


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
