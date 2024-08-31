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
<?php echo $__env->make('template.facultyNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container" style="margin-top: 2%;">
    <div class="div1">
        <center>
            <h3><b>UPDATE ITEM STATE </b></h3>
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
            <form action="/faculty/updateInventoryState/<?php echo e($recordno); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Item Name</label>

                        <input class="form-control mb-3" type="text" value="<?php echo e($name); ?>" name="item_name" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Item ID</label>
                        <input class="form-control mb-3" value="<?php echo e($itemID); ?>" name="itemID" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Qty. Transfered</label>
                        <input class="form-control mb-3" value="<?php echo e($qty_transferred); ?>" name="qty_transferred" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Qty: Available</label> <?php $__errorArgs = ['available_qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="errormessage"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <input type="number" name="available_qty" value="<?php echo e(@old('available_qty')); ?>" class="form-control mb-3">
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Qty: Unavailable - Decommissioned</label> <?php $__errorArgs = ['unavailable1_qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="errormessage"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <input type="number" name="unavailable1_qty" value="<?php echo e(@old('available1_qty')); ?>" class="form-control mb-3">
                    </div>
                    <div class="col-lg-6">
                        <label for="">Qty: Unavailable - In Repair</label> <?php $__errorArgs = ['unavailable2_qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="errormessage"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <input type="number" name="unavailable2_qty" value="<?php echo e(@old('available2_qty')); ?>" class="form-control mb-3">
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6"> <label for="">Month</label>
                        <select name='month' class='form-select mb-3' name="month">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>
                    <div class="col-lg-6"><label for="">Year</label> <?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="errormessage"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <input type="number" name="year" value="<?php echo e(@old('year')); ?>" id="year" class="form-control mb-3">
                    </div>

                </div>

                <input type="submit" class="btn btn-primary" name="add_itemcondition" value="Update">
                <br><br>
            </form>

        </div>



    </div>
</div>

<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/faculty/equipmentMReport.blade.php ENDPATH**/ ?>