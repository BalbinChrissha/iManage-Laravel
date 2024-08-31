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


<div class="container" style="margin-top: 10%;">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-xl-8">
            <div class="card mb-8">
                <div class="card-body d-flex flex-column align-items-center">

                    <h2><b>THERE IS NO RECORD YET FOR THIS TRANSFERRED ITEM</b></h2>
                </div>
            </div>
        </div>
    </div>
</div>


@include('template.footer')