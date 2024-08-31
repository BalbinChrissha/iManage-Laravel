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
<?php echo $__env->make('template.adminNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-11 mx-auto p-5">
        <center>
            <h3><bFACULTY-IN-CHARGE< /b></h3>
        </center><br>
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
                            <th scope="col">Reports</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($record ->  facultyID); ?></td>
                            <td><?php echo e($record ->  dep_name); ?></td>
                            <td><?php echo e($record ->  faculty_name); ?></td>
                            <td><?php echo e($record ->  faculty_username); ?></td>
                            <td><?php echo e($record ->  faculty_password); ?></td>
                            <td><?php echo e($record ->  room_no); ?></td>
                            <td><?php echo e($record ->  room_name); ?></td>
                            <td> <a href=""><i class="fa-solid fa-eye" style="color:blue;"></i> Analytics</a></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>"


        </div>
    </div>

</div>





<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/admin/viewFaculty.blade.php ENDPATH**/ ?>