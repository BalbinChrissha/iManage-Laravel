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
@include('template.adminNavbar')


<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-11 mx-auto p-5">
        <center>
            <h3><bFACULTY-IN-CHARGE< /b></h3>
        </center><br>
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
                            <th scope="col">Reports</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                        <tr>
                            <td>{{ $record ->  facultyID}}</td>
                            <td>{{ $record ->  dep_name}}</td>
                            <td>{{ $record ->  faculty_name}}</td>
                            <td>{{ $record ->  faculty_username}}</td>
                            <td>{{ $record ->  faculty_password}}</td>
                            <td>{{ $record ->  room_no}}</td>
                            <td>{{ $record ->  room_name}}</td>
                            <td> <a href=""><i class="fa-solid fa-eye" style="color:blue;"></i> Analytics</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>"


        </div>
    </div>

</div>





@include('template.footer')