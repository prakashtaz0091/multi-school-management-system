@extends('layout')

@push('page-title')
    Guardians
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


    <a href="{{ route('school_admin.guardians.create') }}" class="btn btn-primary">Add Guardian</a>
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
                            <th>Role</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Email</th>


                            <th>Actions </th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($guardians as $guardian)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td>
                                    <div class="user-avatar">
                                        <a href="https://twitter.com/twcloudchen" class="circle">
                                            <img src="@if ($guardian->image != null) {{ asset('storage/' . $guardian->image) }} @else https://bootdey.com/img/Content/avatar/avatar7.png @endif"
                                                alt="Admin" class="rounded-circle" width="40" height="40" />
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $guardian->name }}</td>
                                <td>
                                    {{ $guardian->role }}

                                </td>
                                <td>{{ $guardian->address }}</td>
                                <td>{{ $guardian->phone }}</td>
                                <td>{{ $guardian->email }}</td>



                                <td>

                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('school_admin.guardians.show', $guardian->id) }}">Details</a>

                                </td>


                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>
            {{-- {{ $staffs->links() }} --}}
        </div>
    </div>
@endsection
