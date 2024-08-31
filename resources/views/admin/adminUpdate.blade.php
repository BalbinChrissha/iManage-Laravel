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
@include('template.adminNavbar')


<div class="container" style="margin-top: 5%;">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-5">
                <div class="card-body d-flex flex-column ">
                    <br>
                    <div class="col-10 mx-auto">
                        <center><span class="sign">
                                <h4>Update Admin<h4>
                            </span></center> <br>
                        <form class="text-center" action="/admin/updateAdmin/{{$adminId}}" method="post">
                            @csrf

                            <div class="mb-3" align="left">
                                <label class="form-label">Full Name</label>
                                @error('name')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control" name="name" value="{{$name}}" placeholder="Enter Full Name" />
                            </div>
                            <div class="mb-3" align="left">
                                <label class="form-label">Username</label>
                                @error('username')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control" name="username" value="{{$username}}" placeholder="Enter User Name" />
                            </div>
                            <div class="mb-3" align="left">
                                <label class="form-label">Password</label>
                                @error('password')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control" type="password" name="password" value="{{$password}}" placeholder="Enter Password" />
                            </div>
                            <br>
                            <div class="col-6 mb-3 mx-auto"><input type="submit" name="update" class="btn btn-primary d-block w-100" value="UPDATE"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('template.footer')