@include('template.header')
<style>
    body {
        font-family: 'Poppins';
        width: 100%;
        height: auto;
        background-image: url('/images/banner.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .errormessage {
        color: red;
        font-size: 13px;
    }

    a {
        text-decoration: none;
    }
</style>
<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>

@include('template.staffNavbar')




<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><b>Add Faculty In Charge </b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/staff/addFaculty" method="post">
                @csrf
                <div class="modal-body"><br>
                    <div class="col-sm-11 mb-3 mx-auto">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Employee Number</label>
                                @error('employno')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control mb-3" type="number" value="{{@old('employno')}}" name="employno">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Department</label>
                                <select name='depno' class='form-select mb-3'>
                                    @foreach ($departments as $department)
                                    <option value="{{$department -> departmentno}}"> {{$department -> dep_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6"> <label class="form-label">Full Name</label>
                                @error('name')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control" name="name" value="{{@old('name')}}" placeholder="Enter Full Name" />
                            </div>
                            <div class="col-sm-6"> <label class="form-label">Username</label>
                                @error('username')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control" name="username" value="{{@old('username')}}" placeholder="Enter User Name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"> <label class="form-label">Password</label>
                                @error('password')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control" type="password" name="password" value="{{@old('password')}}" placeholder="Enter Password" />
                            </div>
                            <div class="col-sm-6"><label for="">Room No.</label>
                                @error('roomno')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input type="text" name="roomno" value="{{@old('roomno')}}" class="form-control mb-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="">Room Name</label>
                                @error('roomname')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input type="text" name="roomname" value="{{@old('roomname')}}" class="form-control mb-3">
                            </div>
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="add_faculty_incharge" value="Insert Record">
            </form>
        </div>
    </div>
</div>
</div>
</div>





<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-11 mx-auto p-5">
        <center>
            <h3><b>MANAGE FACULTY-IN-CHARGE</b></h3>
        </center><br>
        <div class="row">
            <div class="col-sm-2 mb-2">
            </div>

            <div class="col-sm-10 mb-2" align="right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Add faculty-in-charge</button>

            </div>

        </div>

        <div class="row">
            <div style="overflow-x:auto;">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Employee Number</th>
                            <th scope="col">Department</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Room No.</th>
                            <th scope="col">Room Name</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Reports</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($staffs as $staff)
                        <tr>
                            <td>{{$staff -> facultyID}}</td>
                            <td>{{$staff -> dep_name}}</td>
                            <td>{{$staff -> faculty_name}}</td>
                            <td>{{$staff -> faculty_username}}</td>
                            <td>{{$staff -> faculty_password}}</td>
                            <td>{{$staff -> room_no}}</td>
                            <td>{{$staff -> room_name}}</td>
                            <td> <a href="/staff/editFaculty/{{$staff -> facultyID}}"><i class="fa-solid fa-pen-to-square" style="color:blue;"></i></a> &nbsp; <a href="/staff/delFaculty/{{$staff -> facultyID}}"><i class="fas fa-trash-alt" style="color:red;"></i> </a></td>
                            <td> <a href="/staff/viewFacultyR/{{$staff -> facultyID}}"><i class="fa-solid fa-eye" style="color:blue;"></i>Analytics</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>

@include('template.footer')