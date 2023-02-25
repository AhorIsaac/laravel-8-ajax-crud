@extends('layouts.master')

@section('title', 'All Students')

@section('content')
    <section style="padding-top: 60px;">
        <div class="container font-monospace">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card shadow border border-2">
                        <div class="card-header">
                            All Students
                            <a href="#studentModal" data-bs-toggle="modal" class="btn btn-success btn-sm mr-auto">Add New Student</a>
                            <a href="#" class="btn btn-danger btn-sm" id="deleteAllSelectedRecords"> Deleted Selected </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-white" id="studentTable">
                                <thead>
                                    <tr>
                                        <th> <input type="checkbox" id="chkCheckAll" /> </th>
                                        <th> First Name </th>
                                        <th> Last Name </th>
                                        <th> Email </th>
                                        <th> Phone </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr id="sid{{$student->id}}">
                                            <td> <input type="checkbox" name="ids" class="checkBoxClass" value="{{$student->id}}" </td>
                                            <td> {{ $student->firstname}} </td>
                                            <td> {{ $student->lastname}} </td>
                                            <td> {{ $student->email}} </td>
                                            <td> {{ $student->phone}} </td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="editStudent({{$student->id}});" class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>
                                                <a href="javascript:void(0)" onclick="deleteStudent({{$student->id}})" class="btn btn-danger btn-sm">
                                                    Delete
                                                </a>
                                                <a href="javascript:void(0)" onclick="readStudent({{$student->id}})" class="btn btn-info btn-sm">
                                                    Info
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Student Modal -->
    <div class="modal fade" id="studentModal">
        <div class="modal-dialog">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title"> Add New Student </h5>
                    <button type="modal" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="studentForm">
                        @csrf
                        <div class="form-group">
                            <label for="firstname"> First Name </label>
                            <input type="text" class="form-control" name="firstname" id="firstname" />
                        </div>
                        <div class="form-group">
                            <label for="lastname"> Last Name </label>
                            <input type="text" class="form-control" name="lastname" id="lastname" />
                        </div>
                        <div class="form-group">
                            <label for="email"> Email </label>
                            <input type="text" class="form-control" name="email" id="email" />
                        </div>
                        <div class="form-group">
                            <label for="phone"> Phone </label>
                            <input type="text" class="form-control" name="phone" id="phone" />
                        </div>
                        <hr class="hr" />
                        <button type="submit" class="btn btn-success btn-sm m-2"> Submit </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="studentEditModal">
        <div class="modal-dialog">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title"> Edit Student </h5>
                    <button type="modal" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="studentEditForm">
                        @csrf
                        <input type="hidden" name="id" id="id" />
                        <div class="form-group">
                            <label for="firstname"> First Name </label>
                            <input type="text" class="form-control" name="firstname2" id="firstname2" />
                        </div>
                        <div class="form-group">
                            <label for="lastname"> Last Name </label>
                            <input type="text" class="form-control" name="lastname2" id="lastname2" />
                        </div>
                        <div class="form-group">
                            <label for="email"> Email </label>
                            <input type="text" class="form-control" name="email2" id="email2" />
                        </div>
                        <div class="form-group">
                            <label for="phone"> Phone </label>
                            <input type="text" class="form-control" name="phone2" id="phone2" />
                        </div>
                        <hr class="hr" />
                        <button type="submit" class="btn btn-success btn-sm m-2"> Submit </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Read Student Modal -->
    <div class="modal fade" id="studentReadModal">
        <div class="modal-dialog">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title"> Student Details </h5>
                    <button type="modal" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="studentReadForm">
                        @csrf
                        <div class="form-group">
                            <label for="firstname"> First Name </label>
                            <input type="text" class="form-control-plaintext fw-bold" name="firstname3" id="firstname3" />
                        </div>
                        <div class="form-group">
                            <label for="lastname"> Last Name </label>
                            <input type="text" class="form-control-plaintext fw-bold" name="lastname3" id="lastname3" />
                        </div>
                        <div class="form-group">
                            <label for="email"> Email </label>
                            <input type="text" class="form-control-plaintext fw-bold" name="email3" id="email3" />
                        </div>
                        <div class="form-group">
                            <label for="phone"> Phone </label>
                            <input type="text" class="form-control-plaintext fw-bold" name="phone3" id="phone3" />
                        </div>
                        <hr class="hr" />
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('startscripts')
    <script src="{{ asset('assets/dataTables/jquery-3.6.0.min.js') }}"> </script>
@endsection

@section('endscripts')
    <!-- Add New Student -->
    <script>
        $("#studentForm").submit( (e) => {
            e.preventDefault();

            let firstname = $("#firstname").val();
            let lastname = $("#lastname").val();
            let email = $("#email").val();
            let phone = $("#phone").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('student.add') }}",
                type: "POST",
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    phone: phone,
                    _token: _token
                },
                success: function(response) {
                    if (response) {
                        $("#studentTable tbody").prepend(`<tr>
                        <td>${response.firstname}</td>
                        <td>${response.lastname}</td>
                        <td>${response.email}</td>
                        <td>${response.phone}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="editStudent(${response.id})" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <a href="javascript:void(0)" onclick="deleteStudent(${response.id})" class="btn btn-danger btn-sm">
                                    Delete
                                </a>
                                <a href="javascript:void(0)" onclick="readStudent(${response.id})" class="btn btn-info btn-sm">
                                    Info
                                </a>
                            </td>
                        </tr>`);
                        $("#studentForm")[0].reset();
                        $("#studentModal").modal('hide');
                    }
                }
            });
        });
    </script>
    <!-- Edit Student Record -->
    <script>
        const editStudent = (id) => {
            $.get('/students/'+id, function(student) {
                $("#id").val(student.id);
                $("#firstname2").val(student.firstname);
                $("#lastname2").val(student.lastname);
                $("#email2").val(student.email);
                $("#phone2").val(student.phone);
            });
            $("#studentEditModal").modal("toggle");
        };

        $("#studentEditForm").submit( (event) => {
            event.preventDefault();

            let id = $("#id").val();
            let firstname = $("#firstname2").val();
            let lastname = $("#lastname2").val();
            let email = $("#email2").val();
            let phone = $("#phone2").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('student.update') }}",
                method: "PUT",
                data: {
                    id: id,
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    phone: phone,
                    _token: _token
                },
                success: function(response) {
                    $(`#sid${response.id} td:nth-child(1)`).text(response.firstname);
                    $(`#sid${response.id} td:nth-child(2)`).text(response.lastname);
                    $(`#sid${response.id} td:nth-child(3)`).text(response.email);
                    $(`#sid${response.id} td:nth-child(4)`).text(response.phone);
                    $("#studentEditModal").modal('toggle');
                    $("#studentEditForm")[0].reset();
                }
            });
        });
    </script>
    <!-- Delete Student Record -->
    <script>
        const deleteStudent = (id) => {
            if (confirm('Do you really want to delete this record?')) {
                $.ajax({
                    url: `/students/${id}`,
                    type: "DELETE",
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        $(`#sid${id}`).remove();
                    }
                });
            }
        };
    </script>
    <!-- Read Student Record -->
    <script>
        const readStudent = (id) => {
            $.get(`/students/${id}`, function(student) {
                $("#firstname3").val(student.firstname);
                $("#lastname3").val(student.lastname);
                $("#email3").val(student.email);
                $("#phone3").val(student.phone);
            });
            $("#studentReadModal").modal('toggle');
        };
    </script>
    <!-- Delete Multiple Student Record -->
    <script>
        $((e) => {
            $("#chkCheckAll").click(function() {
                $(".checkBoxClass").prop('checked', $(this).prop('checked'));
            });

            $("#deleteAllSelectedRecords").click(function(event) {
                event.preventDefault();

                let allids = [];
                $("input:checkbox[name=ids]:checked").each(function() {
                    allids.push($(this).val());
                });

                $.ajax({
                    url: "{{ route('students.deleteSelected') }}",
                    type: "DELETE",
                    data: {
                        _token: $("input[name=_token]").val(),
                        ids: allids
                    },
                    success: function(response) {
                        $.each(allids, function(key, val) {
                            $(`#sid${val}`).remove();
                        });
                    }
                });

            });
        });
    </script>
@endsection
