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
        $('#table_id1').DataTable();
        $('#table_id2').DataTable();
    });
</script>
<?php echo $__env->make('template.staffNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><b>Transfer Item to Faculty In Charge</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/staff/addTransfer" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-body"><br>
                    <div class="col-sm-11 mb-2 mx-auto">
                        <?php //echo display_error_sos(); 
                        ?>
                        <div class="col">
                            <label for="">Item</label>
                            <select name='itemID' class='form-select mb-3'>
                                <?php $__currentLoopData = $addItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($add -> itemid); ?>"> <?php echo e($add -> itemquan); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                        </div>
                        <div class="col">
                            <label for="">Faculty In Charge</label>
                            <select name='facultyID' class='form-select mb-3'>
                                <?php $__currentLoopData = $addFacs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faculty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($faculty -> facultyID); ?>"> <?php echo e($faculty-> faculty_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                        </div>
                        <div class="col"><label for="">Date Transfer</label> <?php $__errorArgs = ['d8_transfer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="errormessage"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <input type="date" name="d8_transfer" value="<?php echo e(@old('d8_transfer')); ?>" class="form-control mb-3">
                        </div>
                        <div class="col"><label for="">Quantity</label> <?php $__errorArgs = ['qty_transferred'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="errormessage"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <input type="number" name="qty_transferred" value="<?php echo e(@old('qty_transferred')); ?>" class="form-control mb-3">
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="item_transfer" value="Insert Record">
            </form>
        </div>
    </div>
</div>
</div>
</div>





<!------------------------------------------- end of modal -->



<div class="col-10 mx-auto my-5 bg-light rounded">
    <div class="col-sm-11 mx-auto p-5">
        <center>
            <h3><b>RECORDS FOR TRANSFERING</b></h3>
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

        <div class="row">
            <div class="col-sm-2 mb-2">
            </div>

            <div class="col-sm-10 mb-2" align="right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Transfer Item</button>

            </div>

        </div>

        <div class="row">
            <div style="overflow-x:auto;" class="col-md-6">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Employee No.</th>
                            <th scope="col">Departmeent</th>
                            <th scope="col">Name</th>
                            <th scope="col">Room No.</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $faculties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faculty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($faculty -> facultyID); ?></td>
                            <td><?php echo e($faculty -> dep_name); ?></td>
                            <td><?php echo e($faculty -> faculty_name); ?></td>
                            <td><?php echo e($faculty -> room_no); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <br><br>
            </div>




            <div style="overflow-x:auto;" class="col-md-6">
                <table id="table_id1" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Item ID</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date Purchased</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>

                            <td><?php echo e($item -> itemid); ?></td>
                            <td><?php echo e($item -> category_name); ?></td>
                            <td><?php echo e($item -> item_name); ?></td>
                            <td><?php echo e($item -> date_purchased); ?></td>
                            <td><?php echo e($item -> quantity); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- end of first div ---------------------------------------------------------->



<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3><b>TRANSFERRED ITEMS</b></h3>
        </center><br>
        <div class="row">
            <div class="col-sm-2 mb-2">
            </div>

            <div class="col-sm-10 mb-2" align="right">
                <!-- Button trigger modal -->
                <!-- <button type="button" onclick="downloadPDF()" class="btn btn-primary">Print Transfer Report</button> -->
            </div>
        </div>

        <div class="row">
            <div style="overflow-x:auto;">
                <table id="table_id2" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Record #</th>
                            <th scope="col">Item No.</th>
                            <th scope="col">Item Category</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Employee #</th>
                            <th scope="col">Department</th>
                            <th scope="col">Faculty In Charge</th>
                            <th scope="col">Room #</th>
                            <th scope="col">Date Transferred</th>
                            <th scope="col">Qty. Transferred</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($record -> recordno); ?></td>
                            <td><?php echo e($record -> itemid); ?></td>
                            <td><?php echo e($record -> category_name); ?></td>
                            <td><?php echo e($record -> item_name); ?></td>
                            <td><?php echo e($record -> facultyID); ?></td>
                            <td><?php echo e($record -> dep_name); ?></td>
                            <td><?php echo e($record -> faculty_name); ?></td>
                            <td><?php echo e($record -> room_no); ?></td>
                            <td><?php echo e($record -> date_transferred); ?></td>
                            <td><?php echo e($record -> qty_transferred); ?></td>
                            <td> <a href="/staff/editTransfer/<?php echo e($record -> recordno); ?>"><i input class="fa-solid fa-pen-to-square" style="color:blue;"></i></a> &nbsp; <a href="/staff/delTransfer/<?php echo e($record -> recordno); ?>"><i input class="fas fa-trash-alt" style="color:red;"></i> </a></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>






<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/staff/transferItem.blade.php ENDPATH**/ ?>