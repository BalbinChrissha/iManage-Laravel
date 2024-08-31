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
@include('template.staffNavbar')


@include('template.footer')