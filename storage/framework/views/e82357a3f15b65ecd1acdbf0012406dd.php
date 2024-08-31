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
<?php echo $__env->make('template.facultyNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3><b>MONTHLY REPORTS - ITEM MANAGEMENT</b></h3>
        </center><br>

        <div class="row">
            <div style="overflow-x:auto;">
                <table id="table_id2" class="display">
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
                            <td> <a href="/faculty/addMonthlyReport/<?php echo e($record -> recordno); ?>/<?php echo e($record -> categoryID); ?>"><i class='fa-solid fa-circle-plus'></i></a></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>





<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3 id="title"><b>EQUIPMENT REPORT FOR THE MONTH OF <span id="buwan"><?php echo e($month); ?><span></b></h3>
            <h3><b><span id="taon"><?php echo e($year); ?><span></b></h3>
        </center><br>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-5"> <label for="">Month</label>
                        <select name='month' id="filter" class='form-select mb-3' name="month" required>
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
                    <div class="col-sm-3"><label for="">Year</label>
                        <input type="number" name="year" id="year" value="2023" class="form-control mb-3" required>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div style="overflow-x:auto;" id="filterresult">
                <table id="table_id1" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Record #</th>
                            <th scope="col">Item ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Available</th>
                            <th scope="col">Unavailable - Decommissioned </th>
                            <th scope="col">Unavailable - In Repair</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($equip -> recordno); ?></td>
                            <td><?php echo e($equip -> itemid); ?></td>
                            <td><?php echo e($equip -> item_name); ?></td>
                            <td><?php echo e($equip -> available_qty); ?></td>
                            <td><?php echo e($equip -> unavailable1_qty); ?></td>
                            <td><?php echo e($equip -> unavailable2_qty); ?></td>
                            <td><a href="/faculty/editInventoryState/<?php echo e($equip -> stateID); ?>/<?php echo e($equip -> checkedID); ?>/<?php echo e(2); ?>"><i input type="edit" class="fa-solid fa-pen-to-square" style="color:blue;"></i></a> &nbsp;<a href="/faculty/delInventoryState/<?php echo e($equip -> stateID); ?>/<?php echo e($equip -> checkedID); ?>"><i input type="submit" class="fas fa-trash-alt" style="color:red;"></i> </a></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>






<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3 id="title"><b>SUPPLY REPORT FOR THE MONTH OF <span id="buwan1"><?php echo e($month); ?><span></b></h3>
            <h3><b><span id="taon1"><?php echo e($year); ?><span></b></h3>
        </center><br>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-5"> <label for="">Month</label>
                        <select name='month' id="filter1" class='form-select mb-3' name="month" required>
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
                    <div class="col-sm-3"><label for="">Year</label>
                        <input type="number" name="year" id="year1" value="2023" class="form-control mb-3" required>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div style="overflow-x:auto;" id="filterresult1">
                <table id="table_id3" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Record #</th>
                            <th scope="col">Item ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Available</th>
                            <th scope="col">Comsumed</th>
                            <th scope="col">Expired</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $supplies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($supply -> recordno); ?></td>
                            <td><?php echo e($supply -> itemid); ?></td>
                            <td><?php echo e($supply -> item_name); ?></td>
                            <td><?php echo e($supply -> available_qty); ?></td>
                            <td><?php echo e($supply -> unavailable1_qty); ?></td>
                            <td><?php echo e($supply -> unavailable2_qty); ?></td>
                            <td><a href=""><i input type="edit" class="fa-solid fa-pen-to-square" style="color:blue;"></i></a> &nbsp; <a href=""><i input type="submit" class="fas fa-trash-alt" style="color:red;"></i> </a></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>









<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/faculty/monthlyReport.blade.php ENDPATH**/ ?>