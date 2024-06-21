@extends('layout')


@push('page_title')
    Attendence
@endpush

@section('internal-css')
    <style>
        #attendenceContainer {
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        }
    </style>
@endsection


@section('content')
    @php
        use carbon\Carbon;
    @endphp
    <div class="accordion accordion-flush" id="attendenceContainer">
        @foreach ($attendance_records as $key => $class_groups)
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-{{ $key }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse{{ $key }}" aria-expanded="false"
                        aria-controls="flush-collapse{{ $key }}">
                        <strong>
                            {{ $class_groups->first()->first()->class->name }}
                        </strong>
                    </button>
                </h2>
                <div id="flush-collapse{{ $key }}" class="accordion-collapse collapse"
                    aria-labelledby="flush-{{ $key }}" data-bs-parent="#attendenceContainer">
                    <div class="accordion-body">

                        <div class="accordion accordion-flush" id="attendence{{ $key }}Container">

                            @foreach ($class_groups as $date_key => $date_groups)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-{{ $date_key }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapse{{ $date_key }}" aria-expanded="false"
                                            aria-controls="flush-collapse{{ $date_key }}">
                                            <strong>

                                                {{ Carbon::parse($date_key)->toFormattedDateString() }}
                                            </strong>
                                        </button>
                                    </h2>
                                    <div id="flush-collapse{{ $date_key }}" class="accordion-collapse collapse"
                                        aria-labelledby="flush-{{ $date_key }}"
                                        data-bs-parent="#attendence{{ $key }}Container">
                                        <div class="accordion-body">
                                            <strong>Present Students</strong>
                                            <ul>

                                                @foreach ($date_groups as $attendence_record)
                                                    <li>{{ $attendence_record->student->user->name }}</li>
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        @endforeach


    </div>
@endsection
