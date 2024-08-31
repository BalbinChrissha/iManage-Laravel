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
<?php echo $__env->make('template.staffNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




<div class="col-10 mx-auto my-5 bg-light rounded">
    <input type="hidden" name="year" id="facultyID" value="<?php echo $facultyID; ?>">
    <input type="hidden" name="year" id="recorID" value="<?php echo $recordno; ?>">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3 id="title"><b>ITEM <?php echo  strtoupper($item_name); ?> : REPORT FOR THE YEAR OF 2023</b></h3>
        </center><br>


        <div>
            <center><canvas id="overallChart" style="width:100%;max-width:800px"></canvas></center>
        </div>
    </div>
</div>


<div class="col-10 mx-auto my-5 bg-light rounded">
    <input type="hidden" name="year" id="facultyID" value="<?php echo e($facultyID); ?>">
    <input type="hidden" name="year" id="recorID" value="<?php echo e($recordno); ?>">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3 id="title"><b>ITEM <?php echo e(mb_strtoupper($item_name)); ?> : REPORT FOR THE MONTH OF <span id="buwan"><?php echo e(mb_strtoupper($month)); ?><span></b></h3>
            <h3><b><span id="taon"><?php echo e($year); ?><span></b></h3>
        </center><br>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-5"> <label for="">Month</label>
                        <select name='month' id="filter" class='form-select mb-3' name="month" required>
                        <option value="January" <?php echo e($month == 'January' ? 'selected' : ''); ?>>January</option>
                            <option value="February" <?php echo e($month == 'February' ? 'selected' : ''); ?>>February</option>
                            <option value="March" <?php echo e($month == 'March' ? 'selected' : ''); ?>>March</option>
                            <option value="April" <?php echo e($month == 'April' ? 'selected' : ''); ?>>April</option>
                            <option value="May" <?php echo e($month == 'May'? 'selected' : ''); ?>>May</option>
                            <option value="June" <?php echo e($month == 'June' ? 'selected' : ''); ?>>June</option>
                            <option value="July" <?php echo e($month == 'July'? 'selected' : ''); ?>>July</option>
                            <option value="August" <?php echo e($month == 'August'? 'selected' : ''); ?>>August</option>
                            <option value="September" <?php echo e($month == 'September'? 'selected' : ''); ?>>September</option>
                            <option value="October" <?php echo e($month == 'October'? 'selected' : ''); ?>>October</option>
                            <option value="November" <?php echo e($month == 'November'? 'selected' : ''); ?>>November</option>
                            <option value="December" <?php echo e($month == 'December'? 'selected' : ''); ?>>December</option>
                        </select>
                    </div>
                    <div class="col-sm-3"><label for="">Year</label>
                        <input type="number" name="year" id="year" value="<?php echo e($year); ?>" class="form-control mb-3" required>
                        <input type="hidden" name="year" id="facultyID" value="<?php echo e($facultyID); ?>" class="form-control mb-3" required>
                    </div>
                </div>
            </div>
        </div>


        <div id="filterresult">
            <center><canvas id="myChart" style="width:100%;max-width:700px"></canvas></center>
        </div>


    </div>
</div>



<script>
    var available = <?php echo json_encode($available); ?>;
    var decommissioned = <?php echo json_encode($decommissioned); ?>;
    var repair = <?php echo json_encode($repair); ?>;



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



<script>
    var availablecon = <?php echo $pAvailable ?>;
    var decom = <?php echo $pDecommissioned ?>;
    var repaircon = <?php echo $pRepair ?>;

    var xValues = ["Available", "Unavailable - Decommissioned", "Unavailable - In Repair"];
    var yValues = [availablecon, decom, repaircon];
    //var yValues = [0, 0, 0];
    var barColors = [
        "#2F5F98",
        "#2D8BBB",
        "#41B8D5"
    ];

    new Chart("myChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },

    });
</script>


<script>
    $(document).ready(function() {
        $("select#filter").change(function() {
            var inputValue = $('#year').val();
            var facultyno = $('#facultyID').val();
            var recordno = $('#recorID').val();
            var selectedfilter = $(this).children("option:selected").val();
            let newmonth = selectedfilter.toUpperCase();

            // alert(inputValue + " " + facultyno + " " + recordno + " " + selectedfilter);

            // Update the text of the elements
            $('#taon').text(inputValue);
            $('#buwan').text(newmonth);

            $.ajax({
                url: '<?php echo e(route("filter.item_monthly_chart")); ?>',
                type: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    dropdown: selectedfilter,
                    year: inputValue,
                    facultyID: facultyno,
                    recordID: recordno
                },
                success: function(response) {
                    $('#filterresult').html(response);
                }
            });
        });
    });
</script>



<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/staff/viewEquipChartF.blade.php ENDPATH**/ ?>