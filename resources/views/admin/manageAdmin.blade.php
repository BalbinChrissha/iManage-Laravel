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



<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><b>Add Admin</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/addAdmin" method="post">
                @csrf
                <div class="modal-body"><br>
                    <div class="col-sm-8 mb-3 mx-auto">

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            @error('name')
                            <span class="errormessage">{{$message}}</span>
                            @enderror
                            <input class="form-control" name="name" value="{{@old('name')}}" placeholder="Enter Full Name" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            @error('username')
                            <span class="errormessage">{{$message}}</span>
                            @enderror
                            <input class="form-control" name="username" value="{{@old('username')}}" placeholder="Enter User Name" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            @error('password')
                            <span class="errormessage">{{$message}}</span>
                            @enderror
                            <input class="form-control" type="password" name="password" value="{{@old('password')}}" placeholder="Enter Password" />
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="create" value="Insert Record">
            </form>
        </div>
    </div>
</div>
</div>
</div>



<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-10 mx-auto p-5">
        <center>
            <h3><b>MANAGE ADMIN</b></h3>
        </center><br>

        <div class="row">
            <div class="col-sm-2 mb-2">
            </div>

            <div class="col-sm-10 mb-2" align="right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Add Admin</button>

            </div>

        </div>
        <div class="row">
            <div style="overflow-x:auto;">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                            <td>{{$admin -> adminID}}</td>
                            <td>{{$admin -> admin_name}}</td>
                            <td>{{$admin -> username}}</td>
                            <td>{{$admin -> password}}</td>
                            <td><a href="/admin/editAdmin/{{$admin -> adminID}}"><i input type="edit" class="fa-solid fa-pen-to-square" style="color:blue;"></i></a> &nbsp; <a href="/admin/delAdmin/{{$admin -> adminID}}"><i input type="submit" class="fas fa-trash-alt" style="color:red;"></i> </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>





@include('template.footer')