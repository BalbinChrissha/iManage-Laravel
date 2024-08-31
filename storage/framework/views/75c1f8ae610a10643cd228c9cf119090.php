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
                <h5 class="modal-title" id="staticBackdropLabel"><b>Add Inventory</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/staff/addItem" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-body"><br>
                    <div class="col-sm-11 mb-3 mx-auto">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Item Category</label>

                                <select name='categoryno' class='form-select mb-3'>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category -> categoryID); ?>"> <?php echo e($category -> category_name); ?></option>
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
                                <input class="form-control mb-3" value="<?php echo e(@old('name')); ?>" name="name">
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
                                <input type="text" name="serialno" value="<?php echo e(@old('serialno')); ?>" class="form-control mb-3">
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
                                <textarea class="form-control" name="description" rows="3"><?php echo e(@old('description')); ?></textarea>
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
                                <input type="number" name="cost" value="<?php echo e(@old('cost')); ?>" class="form-control mb-3">
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
                                <input type="number" name="quantity" value="<?php echo e(@old('quantity')); ?>" class="form-control mb-3">
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
                                <input type="date" name="d8_purchased" value="<?php echo e(@old('d8_purchased')); ?>" class="form-control mb-3">
                            </div>
                        </div>

                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="create_item" value="Insert Record">
            </form>
        </div>
    </div>
</div>
</div>
</div>


<div class="col-11 mx-auto my-5 bg-light rounded">

    <div class="col-sm-11 mx-auto p-5">
        <center>
            <h3><b>MANAGE INVENTORY</b></h3>
        </center><br>
        <div class="row">
            <div class="col-sm-2 mb-2">
            </div>

            <div class="col-sm-10 mb-2" align="right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Add Item</button>

            </div>

        </div>
        <div class="row">
            <div style="overflow-x:auto;">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Serial No.</th>
                            <th scope="col">Description</th>
                            <th scope="col">PPP</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Date Purchased</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Analytics</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>


                            <?php
                            $cost = $item->cost;
                            $quantity = $item->quantity;
                            $ppp = number_format($cost / $quantity, 2);
                            ?>

                            <td><?php echo e($item -> itemid); ?></td>
                            <td><?php echo e($item ->  category_name); ?></td>
                            <td><?php echo e($item -> item_name); ?></td>
                            <td><?php echo e($item -> serialno); ?></td>
                            <td><?php echo e($item -> item_desc); ?></td>
                            <td><?php echo e($ppp); ?></td>
                            <td><?php echo e($item -> cost); ?></td>
                            <td><?php echo e($item -> date_purchased); ?></td>
                            <td><?php echo e($item -> quantity); ?></td>
                            <td> <a href="/staff/editItem/<?php echo e($item -> itemid); ?>"><i class="fa-solid fa-pen-to-square" style="color:blue;"></i></a> &nbsp; <a href="/staff/delItem/<?php echo e($item -> itemid); ?>"><i class="fas fa-trash-alt" style="color:red;"></i> </a></td>
                            <td> <a href=""><i class="fa-solid fa-eye" style="color:blue;"></i> Analytics</a></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>


<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/staff/manageItem.blade.php ENDPATH**/ ?>