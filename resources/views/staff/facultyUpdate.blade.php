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

    .div1 {
        width: 80%;
        padding: 20px;
        margin: auto;
        border-radius: 20px;
        background-color: white;
    }
</style>
@include('template.staffNavbar')

<div class="container" style="margin-top: 2%;">
    <div class="div1">
        <center>
            <h3><b>UPDATE FACULTY-IN-CHARGE</b></h3>
        </center><br>
        <div class="col-sm-9 mx-auto">
            <form action="/staff/updateFaculty/{{$facultyId}}" method="post">
                @csrf
                <div class="modal-body"><br>
                    <div class="col-sm-11 mb-3 mx-auto">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Employee Number</label>
                                @error('employno')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control mb-3" type="number" value="{{$facultyId}}" name="employno" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Department</label>
                                <select name='depno' class='form-select mb-3'>
                                    @foreach ($departments as $department)
                                    <option value="{{$department -> departmentno}}" {{ $department->departmentno == $depno ? 'selected' : '' }}> {{$department -> dep_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6"> <label class="form-label">Full Name</label>
                                @error('name')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control" name="name" value="{{$name}}" placeholder="Enter Full Name" />
                            </div>
                            <div class="col-sm-6"> <label class="form-label">Username</label>
                                @error('username')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control" name="username" value="{{$username}}" placeholder="Enter User Name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"> <label class="form-label">Password</label>
                                @error('password')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control" type="password" name="password" value="{{$password}}" placeholder="Enter Password" />
                            </div>
                            <div class="col-sm-6"><label for="">Room No.</label>
                                @error('roomno')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input type="text" name="roomno" value="{{$roomno}}" class="form-control mb-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="">Room Name</label>
                                @error('roomname')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input type="text" name="roomname" value="{{$roomname}}" class="form-control mb-3">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="update_faculty" value="Update">
                        <br><br>
            </form>

        </div>

    </div>
</div>









@include('template.footer')