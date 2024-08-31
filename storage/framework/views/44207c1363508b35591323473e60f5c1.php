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

    .div1 {
        width: 80%;
        padding: 20px;
        margin: auto;
        border-radius: 20px;
        background-color: white;
    }
</style>
<?php echo $__env->make('template.staffNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container" style="margin-top: 2%;">
    <div class="div1">
        <center>
            <h3><b>UPDATE FACULTY-IN-CHARGE</b></h3>
        </center><br>
        <div class="col-sm-9 mx-auto">
            <form action="/staff/updateFaculty/<?php echo e($facultyId); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-body"><br>
                    <div class="col-sm-11 mb-3 mx-auto">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Employee Number</label>
                                <?php $__errorArgs = ['employno'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="errormessage"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input class="form-control mb-3" type="number" value="<?php echo e($facultyId); ?>" name="employno">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Department</label>
                                <select name='depno' class='form-select mb-3'>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($department -> departmentno); ?>" <?php echo e($department->departmentno == $depno ? 'selected' : ''); ?>> <?php echo e($department -> dep_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6"> <label class="form-label">Full Name</label>
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
                            <div class="col-sm-6"> <label class="form-label">Username</label>
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
                        </div>
                        <div class="row">
                            <div class="col-sm-6"> <label class="form-label">Password</label>
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
                            <div class="col-sm-6"><label for="">Room No.</label>
                                <?php $__errorArgs = ['roomno'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="errormessage"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="text" name="roomno" value="<?php echo e($roomno); ?>" class="form-control mb-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="">Room Name</label>
                                <?php $__errorArgs = ['roomname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="errormessage"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="text" name="roomname" value="<?php echo e($roomname); ?>" class="form-control mb-3">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="update_faculty" value="Update">
                        <br><br>
            </form>

        </div>

    </div>
</div>









<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/staff/facultyUpdate.blade.php ENDPATH**/ ?>