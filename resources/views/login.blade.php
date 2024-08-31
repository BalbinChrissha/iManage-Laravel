@extends('template.ind')

@section('head')
<style>
  body {
    font-family: 'Poppins';
    width: 100%;
    height: auto;
    background-image: url('/images/banner.jpg');
    background-attachment: fixed;
    background-size: cover;
  }
  .errormessage {
            color: red;
            font-size: 13px;
        }
</style>
@endsection


@section('content')

<nav class="navbar navbar-light bg-light ">
        <div style="padding-left: 40px ;">

            <table>
                <tr>
                    </a>
                    <td> <a class="navbar-brand" href="#">
                            <img src="/images/PSU_logo1.png" width="70" height="70" alt=""></td>
                    <td>
                        <h2 style="color: #0463FA;"><b>IManage: PSU URDANETA CAMPUS</b></h2>
                    </td>
                </tr>
            </table>

        </div>
</nav>


<div class="container" style="margin-top: 8%;">
  <div class="row d-flex justify-content-center">
    <div class="col-md-6 col-xl-4">
      <div class="card mb-5">
        <div class="card-body d-flex flex-column align-items-center">
          <br>
          <div class="iconn">  <img src="images/IMANAGE3.png" width="40" height="40" alt=""></div>
          <span class="sign">Log in to your account</span> <br><br>
           <form class="text-center" action="{{route('login-user')}}" method="post">
          @if(Session::has('success'))
          <div class="alert alert-success">{{Session::get('success')}}</div>
          @endif

          @if(Session::has('fail'))
          <div class="alert alert-danger">{{Session::get('fail')}}</div>
          @endif
            @csrf
            <div class="mb-3" align="left">
            <label class="form-label">Username</label>
                                    @error('username')
                                    <span class="errormessage">{{$message}}</span>
                                    @enderror
              <input class="form-control"  name="username" placeholder="Enter Username" value="{{@old('username')}}" /></div>
            <div class="mb-3"align="left"> <label class="form-label">Password</label>
                                    @error('password')
                                    <span class="errormessage">{{$message}}</span>
                                    @enderror<input class="form-control" type="password" name="password" placeholder="Enter Password" value="{{@old('password')}}"/>
            </div><br>
            <div class="col-6 mb-3 mx-auto"><input type="submit"  name="submit" class="btn btn-primary d-block w-100" value="LOGIN"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>




@endsection