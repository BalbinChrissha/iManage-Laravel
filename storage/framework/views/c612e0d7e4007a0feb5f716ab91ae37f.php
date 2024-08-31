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
            <h3><b><span id="state">
                        EQUIPMENT: AVAILABLE
                    </span> </b></h3>
            <h3 id="title"><b>REPORT FOR THE MONTH OF <span id="buwan"><?php echo e(mb_strtoupper($month)); ?><span></b></h3>
            <h3><b><span id="taon"><?php echo e($year); ?><span></b></h3>
        </center><br>
        <div class="row">
            <div class="col-md">
                <div class="row">
                    <div class="col-sm-2"> <label for="">Category</label>
                        <select id="category" class='form-select mb-3' name="classification" required>
                            <option value="Equipment">Equipment</option>
                            <option value="Supply">Supply</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="changeradio">
                        <label for="">State</label><br>
                        <select id="statefil" class='form-select mb-3' name="classification" required>
                            <option value="Available">Available</option>
                            <option value="Unavailable - Decomissioned">Unavailable - Decomissioned</option>
                            <option value="Unavailable - In repair">Unavailable - In repair</option>
                        </select>
                    </div>
                    <div class="col-sm-3"><label for="">Year</label>
                        <input type="number" name="year" id="year" value="<?php echo e($year); ?>" class="form-control mb-3" required>
                        <input type="hidden" name="year" id="facultyID" value="<?php echo e(Session::get('facultyId')); ?>" class="form-control mb-3" required>
                    </div>
                    <div class="col-sm-3"> <label for="">Month</label>
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
                    <div class="col-1">
                        <center><br><button type="submit" id="filterbutton" class="btn btn-primary">Filter</button></center>
                    </div>
                </div>
            </div>
        </div>

        <br> <br>
        <div class="col mx-auto">
            <div style="overflow-x:auto;" id="filterresult">
                <table id="table_id1" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Record #</th>
                            <th scope="col">Item ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">No. Available</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td><?php echo e($record -> recordno); ?></td>
                            <td><?php echo e($record -> itemid); ?></td>
                            <td><?php echo e($record -> item_name); ?></td>
                            <td><?php echo e($record ->available_qty); ?></td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>




        </div>
    </div>

</div>


<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#filterbutton').click(function() {
            var inputValue = $('#year').val();
            var facultyno = $('#facultyID').val();
            var selectedfilter = $("#filter").val();
            var selectedcategory = $("#category").val();

            var stateitem = $("#statefil").val();

            let newmonth = selectedfilter.toUpperCase();
            let newcategory = selectedcategory.toUpperCase();
            var hehe = stateitem.toUpperCase();
            $('#state').text(newcategory + ": " + hehe);
            $('#taon').text(inputValue);
            $('#buwan').text(newmonth);

           // alert(selectedfilter + " " + selectedcategory + " " + stateitem + " " + inputValue + " " + facultyno)

            $.ajax({
                url: '<?php echo e(route("filter.fac_filter_item")); ?>',
                type: 'POST', // Use the POST method
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    dropdown: selectedfilter,
                    category: selectedcategory,
                    state: stateitem,
                    year: inputValue,
                    facultyID: facultyno
                }, // Send any data that you need to the server
                success: function(html) {
                    $('#filterresult').html(html);
                    console.log(html); // Update the content of the div
                },
            });
        });


        $("select#category").change(function() {
            var selectedcategory = $(this).children("option:selected").val();

            $.ajax({
                url: '<?php echo e(route("filter.changeDropdown")); ?>',
                type: 'POST', // Use the POST method
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    dropdown: selectedcategory,
                }, // Send any data that you need to the server
                success: function(html) {
                    $('#changeradio').html(html); // Update the content of the div
                }
            });
        });



    });
</script>

<?php echo $__env->make('template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/faculty/filterInventory.blade.php ENDPATH**/ ?>