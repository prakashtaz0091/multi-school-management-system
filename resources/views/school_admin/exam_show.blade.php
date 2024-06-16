@extends('layout')


@push('page-title')
    {{ $exam->name }}
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
    <!-- Modal -->
    <div class="container">

        <div class="modal-body">
            <div class="accordion" id="exam_details">

                @foreach ($exam->subjects as $subject)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="{{ $subject->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $subject->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $subject->id }}">
                                {{ $subject->name }}
                            </button>
                        </h2>
                        <div id="collapse{{ $subject->id }}" class="accordion-collapse collapse"
                            aria-labelledby="{{ $subject->id }}" data-bs-parent="#exam_details">
                            <div class="accordion-body">
                                <strong>This is the second item's accordion body.</strong> It is hidden by default, until
                                the
                                collapse plugin adds the appropriate classes that we use to style each element. These
                                classes
                                control the overall appearance, as well as the showing and hiding via CSS transitions. You
                                can
                                modify any of this with custom CSS or overriding our default variables. It's also worth
                                noting
                                that just about any HTML can go within the <code>.accordion-body</code>, though the
                                transition
                                does limit overflow.
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    </div>
@endsection
