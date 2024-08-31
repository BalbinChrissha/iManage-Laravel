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
            <h3><b>UPDATE ITEM / INVENTORY </b></h3>
        </center><br>
        <div class="col-sm-9 mx-auto">
            <form action="/staff/updateItem/<?php echo e($itemId); ?>" method="post">
                <?php echo csrf_field(); ?>

                <div class="row">
                            <div class="col-sm-6">
                                <label for="">Item Category</label>

                                <select name='categoryno' class='form-select mb-3'>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category -> categoryID); ?>"  <?php echo e($category -> categoryID == $categoryno? 'selected' : ''); ?>> <?php echo e($category -> category_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Item Name</label> <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="errormessage"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input class="form-control mb-3" value="<?php echo e($name); ?>" name="name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6"> <label for="">Serial No.</label> <?php $__errorArgs = ['serialno'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="errormessage"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="text" name="serialno" value="<?php echo e($serialno); ?>" class="form-control mb-3">
                            </div>
                            <div class="col-lg-6"> <label for="">Description</label> <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="errormessage"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <textarea class="form-control" name="description" rows="3"><?php echo e($description); ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6"> <label for="">Overall Cost</label> <?php $__errorArgs = ['cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="errormessage"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="number" name="cost" value="<?php echo e($cost); ?>" class="form-control mb-3">
                            </div>
                            <div class="col-sm-6"><label for="">Quantity</label> <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="errormessage"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="number" name="quantity" value="<?php echo e($quantity); ?>" class="form-control mb-3">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6"><label for="">Date Purchased</label> <?php $__errorArgs = ['d8_purchased'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="errormessage"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="date" name="d8_purchased" value="<?php echo e($d8_purchased); ?>" class="form-control mb-3">
                            </div>
                        </div>
                <input type="submit" class="btn btn-primary" name="update_item" value="Update">
                <br><br>
            </form>

        </div>



    </div>
</div>


<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/staff/itemUpdate.blade.php ENDPATH**/ ?>