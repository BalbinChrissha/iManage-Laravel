@extends('template.ind')

@section('head')
<style>
     body {
        font-family: 'Poppins';
        width: 100%;
        height: auto;
       // background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)), url('/images/welcomebanner.png/');
        /* //background-image: url('images/welcomebanner.png'); */
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
        padding-bottom: 50px;
    }

    #headerlogo img {

        height: 150px;
        width: 150px;
    }

    #headerlogo {
        padding: 20px 20px 20px 20px;
    }

    h1{
        text-align: center;
        color: white;
        font-size:  50px;
        font-weight: bold;
    }

    #parag{
        color: white;
        text-align: justify;  
    }
</style>
@endsection


@section('content')

<link rel="icon" type="image/png" href="/images/PSU_logo1.png/">
</head>

<body class="">

<div id="headerlogo">
    <img src="/images/PSU_logo1.png/" alt="">
</div>

<div>
    <h1>iManage : Laboratory Equipment <br> Management System with<br> Data Analytics</h1>
</div>

<div class="col-10 mx-auto" id="parag">
    <br><br>
    iManage, the comprehensive Laboratory Equipment Management System with cutting-edge Data Analytics capabilities. iManage helps PSU optimize laboratory operations, ensuring maximum efficiency and accuracy. With iManage's user-friendly interface and analytics tools, managing laboratory equipment and supplies has never been easier. Harnessing the power of technology to revolutionize the way we manage our laboratories.
    <br><br>
    <center>
    <center><button type="button" onclick="" class="btn btn-primary">LOGIN</button></center>
</center>
</div>

<table>
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Username</td>
        <td>Action</td>
    </tr>
    <tr>
    <td>{{$data->adminID}}</td>
        <td>{{$data->admin_name}}</td>
        <td>{{$data->username}}</td>
        <td><a href="logout">Logout</a></td>
    </tr>
</table>


@endsection