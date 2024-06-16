@extends('layout')


@push('page-title')
    {{ $exam->name }} | Add subjects
@endpush

@section('head-links')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        .hidden {
            display: none;
        }
    </style>
@endsection


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
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        {{-- <input type="hidden" id="url" value="{{ route('school_admin.exams.getSubjectsForClass') }}"> --}}
                        <select class="form-select" aria-label="Default select example" id="class_id" required>
                            <option value="not selected" selected>Select Class</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">

                    <button id="get_subjects_btn" class="btn btn-primary">Get Subjects</button>
                </div>
            </div>

            <div class="card hidden" id="class_subjects_card">
                <div class="card-body">
                    <form action="{{ route('school_admin.exams.storeSubjects_Exam', $exam->id) }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">

                                <thead>
                                    <tr>

                                        <th>
                                            <button class="btn btn-primary" id="select_all">Select all</button>
                                            <button class="btn btn-primary hidden" id="dis_select_all">Dis-select
                                                all</button>
                                        </th>
                                        <th>Class</th>
                                        <th>Name</th>
                                        <th>Full Marks</th>
                                        <th> Pass Marks</th>



                                    </tr>
                                </thead>




                                <tbody id="class_subjects">
                                </tbody>

                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary add_subject_btn">Add Selected</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('add-scripts')
    <script>
        $(document).ready(function() {




            $('#get_subjects_btn').on('click', function() {
                let class_id = $('#class_id').val();

                if (class_id == 'not selected') { // if not selected any class
                    alert('Please select class');
                    return;
                }

                let url =
                    "{{ route('school_admin.exams.getSubjectsForClass', ':class_id') }}"; //prepare url
                url = url.replace(':class_id', class_id); //prepare url
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(classes) {
                        const subjects = classes.subjects;

                        if (subjects.length == 0) { // if no subjects found
                            alert(
                                'No subjects found for this class, please create them first.'
                            );
                            return;
                        }

                        $('#class_subjects').html('');
                        for (let i = 0; i < subjects.length; i++) { //show subjects
                            let subject = subjects[i];
                            $('#class_subjects').append(
                                `
                                <tr>
                                    <td> <input type="checkbox" name="subjects[]" class="subject" value="${subject.id}"> </td>  
                                    <td> ${classes.name} </td>  
                                    <td> ${subject.name} </td>  
                                    <td> ${subject.full_marks} </td>  
                                    <td> ${subject.pass_marks} </td>  
                                   
                                
                                </tr>
                                
                                `
                            )

                        }


                        $('#class_subjects_card').removeClass(
                            'hidden'); //show card if subjects found

                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            });
        });



        $('#select_all').on('click', function(event) {
            event.preventDefault();
            $('.subject').prop('checked', true);
            $('#dis_select_all').removeClass('hidden');
            $('#select_all').addClass('hidden');
        });
        $('#dis_select_all').on('click', function(event) {
            event.preventDefault();
            $('.subject').prop('checked', false);
            $('#select_all').removeClass('hidden');
            $('#dis_select_all').addClass('hidden');
        });
    </script>
@endsection
