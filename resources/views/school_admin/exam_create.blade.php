@extends('layout')


@push('page-title')
    New Exam | {{ $year_bs }}
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
            <form action="{{ route('school_admin.exams.store') }}" method="post">
                @csrf


                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Exam Name" />
                    <label for="name">Exam Name</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="exam_type" class="form-select" id="exam_type">
                        <option value="first_term">First Term</option>
                        <option value="second_term">Second Term</option>
                        <option value="third_term">Third Term</option>
                        <option value="final">Final</option>
                        <option value="others">Others</option>
                    </select>
                    <label for="exam_type">Exam Type</label>
                </div>



                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
    </div>
@endsection

@section('add-scripts')
    <script>
        $(document).ready(function() {
            $('#create_exam_btn').on('click', function() {
                let class_id = $('#class_id').val();

                if (class_id == 'not selected') {
                    alert('Please select class');
                    return;
                }

                let url = "{{ route('school_admin.exams.getSubjectsForClass', ':class_id') }}";
                url = url.replace(':class_id', class_id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        const subjects = response.subjects;

                        if (subjects.length == 0) {
                            alert(
                                'No subjects found for this class, please create them first.'
                            );
                            return;
                        }

                        $('#class_subjects').html('');
                        for (let i = 0; i < subjects.length; i++) {
                            let subject = subjects[i];
                            $('#class_subjects').append(
                                `
                                <tr>
                                    <td> <input type="checkbox" name="subjects[]" value="${subject.id}"> </td>  
                                    <td> ${subject.name} </td>  
                                    <td> ${subject.full_marks} </td>  
                                    <td> ${subject.pass_marks} </td>  
                                
                                </tr>
                                
                                `
                            )

                        }

                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
