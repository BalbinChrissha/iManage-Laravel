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

        $('#table_id3').DataTable();
    });
</script>
<?php echo $__env->make('template.adminNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="col-11 mx-auto my-5 bg-light rounded">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3><b>INVENTORY</b></h3>
        </center><br>
        <div class="row">
            <div style="overflow-x:auto;">
                <table id="table_id2" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Managing Staff</th>
                            <th scope="col">Item #</th>
                            <th scope="col">Category</th>
                            <th scope="col">Item</th>
                            <th scope="col">Serial No.</th>
                            <th scope="col">Description</th>
                            <th scope="col">PPP</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Date Purchased</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Analytics</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php

                        $ppp = number_format(($record->cost /  $record->quantity), 2);
                        ?>
                        <tr>

                            <td><?php echo e($record -> staff_name); ?></td>
                            <td><?php echo e($record -> itemid); ?></td>
                            <td><?php echo e($record -> category_name); ?></td>
                            <td><?php echo e($record -> item_name); ?></td>
                            <td><?php echo e($record ->serialno); ?></td>
                            <td><?php echo e($record ->item_desc); ?></td>
                            <td><?php echo e($ppp); ?></td>
                            <td><?php echo e($record -> cost); ?></td>
                            <td><?php echo e($record -> date_purchased); ?></td>
                            <td><?php echo e($record -> quantity); ?></td>
                            <td> <a href=""><i class="fa-solid fa-eye" style="color:blue;"></i> Analytics</a></td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>

<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/admin/viewInventory.blade.php ENDPATH**/ ?>