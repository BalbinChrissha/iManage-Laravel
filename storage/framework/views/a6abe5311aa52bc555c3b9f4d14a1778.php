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
<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>

<?php echo $__env->make('template.staffNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><b>Add Faculty In Charge </b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/staff/addFaculty" method="post">
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
                                <input class="form-control mb-3" type="number" value="<?php echo e(@old('employno')); ?>" name="employno">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Department</label>
                                <select name='depno' class='form-select mb-3'>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($department -> departmentno); ?>"> <?php echo e($department -> dep_name); ?></option>
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
                                <input class="form-control" name="name" value="<?php echo e(@old('name')); ?>" placeholder="Enter Full Name" />
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
                                <input class="form-control" name="username" value="<?php echo e(@old('username')); ?>" placeholder="Enter User Name" />
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
                                <input class="form-control" type="password" name="password" value="<?php echo e(@old('password')); ?>" placeholder="Enter Password" />
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
                                <input type="text" name="roomno" value="<?php echo e(@old('roomno')); ?>" class="form-control mb-3">
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
                                <input type="text" name="roomname" value="<?php echo e(@old('roomname')); ?>" class="form-control mb-3">
                            </div>
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="add_faculty_incharge" value="Insert Record">
            </form>
        </div>
    </div>
</div>
</div>
</div>





<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-11 mx-auto p-5">
        <center>
            <h3><b>MANAGE FACULTY-IN-CHARGE</b></h3>
        </center><br>
        <div class="row">
            <div class="col-sm-2 mb-2">
            </div>

            <div class="col-sm-10 mb-2" align="right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Add faculty-in-charge</button>

            </div>

        </div>

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
                            <th scope="col">Actions</th>
                            <th scope="col">Reports</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($staff -> facultyID); ?></td>
                            <td><?php echo e($staff -> dep_name); ?></td>
                            <td><?php echo e($staff -> faculty_name); ?></td>
                            <td><?php echo e($staff -> faculty_username); ?></td>
                            <td><?php echo e($staff -> faculty_password); ?></td>
                            <td><?php echo e($staff -> room_no); ?></td>
                            <td><?php echo e($staff -> room_name); ?></td>
                            <td> <a href="/staff/editFaculty/<?php echo e($staff -> facultyID); ?>"><i class="fa-solid fa-pen-to-square" style="color:blue;"></i></a> &nbsp; <a href="/staff/delFaculty/<?php echo e($staff -> facultyID); ?>"><i class="fas fa-trash-alt" style="color:red;"></i> </a></td>
                            <td> <a href="/staff/viewFacultyR/<?php echo e($staff -> facultyID); ?>"><i class="fa-solid fa-eye" style="color:blue;"></i>Analytics</a></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>

<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/staff/manageFaculty.blade.php ENDPATH**/ ?>