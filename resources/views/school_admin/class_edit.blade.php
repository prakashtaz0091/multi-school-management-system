@extends('layout')


@push('page-title')
    Edit {{ $class->name }}
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
    @error('email')
        {{ $message }}
    @enderror



    <!-- Modal -->
    <div class="container">

        <div class="modal-body">
            <form id="formForAll" action="{{ route('school_admin.classes.update', $class->id) }}" method="post">
                @csrf
                @method('put')


                <label for="name">{{ $class->name }}</label>
                <small>(You can't edit class name)</small>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="room_no" name="room_no" placeholder="eg. 101"
                        value="{{ $class->room_no }}" required />
                    <label for="room_no">Class's Room no.</label>
                    <p class="text-danger">{{ $errors->first('room_no') }}</p>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="year" name="year" placeholder="eg. 2080"
                        value="{{ $class->year }}" required helper="eg. 2080" />
                    <label for="year">Class's Year in B.S. eg. 2080</label>
                    <p class="text-danger">{{ $errors->first('year') }}</p>
                </div>








                <button type="submit" class="btn btn-primary float-start">
                    Submit
                </button>
            </form>
        </div>
    </div>
    </div>
@endsection
