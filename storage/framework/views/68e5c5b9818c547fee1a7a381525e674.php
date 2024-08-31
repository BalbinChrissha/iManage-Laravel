<?php echo $__env->make('template.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('template.staffNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


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


<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/staff/viewNone.blade.php ENDPATH**/ ?>