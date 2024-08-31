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
<?php echo $__env->make('template.facultyNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3><b>TRANSFERRED ITEMS</b></h3>
        </center><br>

        <div class="row">
            <div style="overflow-x:auto;">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Record #</th>
                            <th scope="col">Item Category</th>
                            <th scope="col">Item No.</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Department</th>
                            <th scope="col">Room #</th>
                            <th scope="col">Date Transferred</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Add Record</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td> <?php echo e($record -> recordno); ?></td>
                            <td> <?php echo e($record -> category_name); ?></td>
                            <td> <?php echo e($record -> itemid); ?></td>
                            <td> <?php echo e($record -> item_name); ?></td>
                            <td> <?php echo e($record -> item_desc); ?></td>
                            <td> <?php echo e($record -> dep_name); ?></td>
                            <td> <?php echo e($record -> room_no); ?></td>
                            <td> <?php echo e($record -> date_transferred); ?></td>
                            <td> <?php echo e($record -> qty_transferred); ?></td>
                            <td> <a href="/faculty/viewDatachart/<?php echo e($record -> recordno); ?>/<?php echo e($record -> categoryID); ?>"><i class='fa-solid fa-eye'></i></a></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>



<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/faculty/facultyDashboard.blade.php ENDPATH**/ ?>