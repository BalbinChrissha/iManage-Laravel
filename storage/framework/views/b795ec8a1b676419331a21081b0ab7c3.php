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



<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-12 mx-auto p-5">

        <center>
            <h3><b>TRANSFERRED ITEMS TO : <?php echo e(mb_strtoupper($name)); ?> </b></h3>
        </center><br>

        <div class="row">
            <div style="overflow-x:auto;">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Record #</th>
                            <th scope="col">Item No.</th>
                            <th scope="col">Item Category</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Department</th>
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
                            <td><?php echo e($record ->item_name); ?></td>
                            <td><?php echo e($record ->item_desc); ?></td>
                            <td><?php echo e($record ->dep_name); ?></td>
                            <td><?php echo e($record ->room_no); ?></td>
                            <td><?php echo e($record ->date_transferred); ?></td>
                            <td><?php echo e($record ->qty_transferred); ?></td>
                            <td> <a href="/staff/viewFacultyChart/<?php echo e($facultyID); ?>/<?php echo e($record -> recordno); ?>/<?php echo e($record -> categoryID); ?>"><i input class="fa-solid fa-eye" style="color:blue;"></i> Analytics</a></td>
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
            <h3 id="title"><b>EQUIPMENT : OVERALL REPORT FOR THE YEAR OF 2023</b></h3>
        </center><br>


        <div>
            <center><canvas id="overallChart" style="width:100%;max-width:800px"></canvas></center>
        </div>
    </div>
</div>



<div class="col-10 mx-auto my-5 bg-light rounded">
    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3 id="title"><b>SUPPLY: OVERALL REPORT FOR THE YEAR OF 2023</b></h3>
        </center><br>
        <div>
            <center><canvas id="overallChart3" style="width:100%;max-width:800px"></canvas></center>
        </div>
    </div>
</div>





<script>
 
 var available = <?php echo json_encode($available); ?>;
    var decommissioned = <?php echo json_encode($decommissioned); ?>;
    var repair = <?php echo json_encode($repair); ?>;


    var total = <?php echo  $totalqty1; ?>;

    var xValues = ["Januray", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    new Chart("overallChart", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [{
          label: "Available",
          data: available,
          borderColor: "blue",
          fill: true
        }, {
          label: "Unavailable - Decommissioned",
          data: decommissioned,
          borderColor: "red",
          fill: true
        }, {
          label: "Unavailable - In Repair",
          data: repair,
          borderColor: "green",
          fill: true
        }, {
          label: "Total Equipment",
          data: [total, total, total, total, total, total, total, total, total, total, total, total],
          borderColor: "grey",
          fill: false
        }]
      },
      options: {
        legend: {
          display: true,
          position: 'bottom'
        }
      }
    });

    
    var availableCat2  = <?php echo json_encode($availableCat2 ); ?>;
    var consumed = <?php echo json_encode($consumed); ?>;
    var expired = <?php echo json_encode($expired); ?>;


    var total = <?php echo  $totalqty2; ?>;

    var xValues = ["Januray", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    new Chart("overallChart3", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [{
          label: "Available",
          data: availableCat2,
          borderColor: "blue",
          fill: true
        }, {
          label: "Consumed",
          data: consumed,      
          borderColor: "red",
          fill: true
        }, {
          label: "Expired",
          data: expired, 
          borderColor: "green",
          fill: true
        }, {
          label: "Total Supply",
          data: [total, total, total, total, total, total, total, total, total, total, total, total],
          borderColor: "grey",
          fill: false
        }]
      },
      options: {
        legend: {
          display: true,
          position: 'bottom'
        }
      }
    });
  </script>



<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/staff/viewFacultyR.blade.php ENDPATH**/ ?>