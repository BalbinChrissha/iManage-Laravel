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
</style>
<?php echo $__env->make('template.adminNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


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
                        <form class="text-center" action="/admin/updateAdmin/<?php echo e($adminId); ?>" method="post">
                            <?php echo csrf_field(); ?>

                            <div class="mb-3" align="left">
                                <label class="form-label">Full Name</label>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="errormessage"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input class="form-control" name="name" value="<?php echo e($name); ?>" placeholder="Enter Full Name" />
                            </div>
                            <div class="mb-3" align="left">
                                <label class="form-label">Username</label>
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="errormessage"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input class="form-control" name="username" value="<?php echo e($username); ?>" placeholder="Enter User Name" />
                            </div>
                            <div class="mb-3" align="left">
                                <label class="form-label">Password</label>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="errormessage"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input class="form-control" type="password" name="password" value="<?php echo e($password); ?>" placeholder="Enter Password" />
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


<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/admin/adminUpdate.blade.php ENDPATH**/ ?>