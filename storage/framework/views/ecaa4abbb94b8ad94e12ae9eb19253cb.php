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

<div class="container" style="margin-top: 5%;">
    <div class="div1">
        <center>
            <h3><b>UPDATE ITEM / INVENTORY </b></h3>
        </center><br>


        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <center>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </center>
        </div>
        <?php endif; ?>

        <div class="col-sm-9 mx-auto">
            <form action="/staff/updateTransfer/<?php echo e($recordno); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Item</label>
                        <select name='itemID' class='form-select mb-3'>
                            <?php $__currentLoopData = $addItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($add -> itemid); ?>"  <?php echo e($add ->itemid == $itemID ? 'selected' : ''); ?>> <?php echo e($add -> itemquan); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                    </div>
                    <div class="col-lg-6">
                        <label for="">Faculty In Charge</label>
                        <select name='facultyID' class='form-select mb-3'>
                            <?php $__currentLoopData = $addFacs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faculty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($faculty -> facultyID); ?>"  <?php echo e($faculty -> facultyID == $facultyID ? 'selected' : ''); ?>> <?php echo e($faculty-> faculty_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6"><label for="">Date Transferred</label>
                        <input type="date" name="d8_transfer" value="<?php echo e($date_transferred); ?>" class="form-control mb-3" required>
                    </div>
                    <div class="col-lg-6"><label for="">Quantity Transferred</label>
                        <input type="number" name="qty_transferred" value="<?php echo e($qty_transferred); ?>" class="form-control mb-3" required>
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-primary" name="update_item_transfer" value="Update">
                <br><br>
            </form>

        </div>



    </div>
</div>



<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/staff/updateTransfer.blade.php ENDPATH**/ ?>