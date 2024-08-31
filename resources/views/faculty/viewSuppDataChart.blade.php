@include('template.header')
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
@include('template.facultyNavbar')


<div class="col-10 mx-auto my-5 bg-light rounded">
    <input type="hidden" name="year" id="facultyID" value="{{Session::get('facultyId')}}">
    <input type="hidden" name="year" id="recorID" value="{{$recordno}}">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3 id="title"><b>ITEM {{mb_strtoupper($item_name)}} : REPORT FOR THE YEAR OF {{$year}}</b></h3>
        </center><br>

        <div>
            <center><canvas id="overallChart" style="width:100%;max-width:800px"></canvas></center>
        </div>
    </div>
</div>


<div class="col-10 mx-auto my-5 bg-light rounded">
    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3 id="title"><b>ITEM {{mb_strtoupper($item_name)}} : REPORT FOR THE MONTH OF <span id="buwan">{{mb_strtoupper($month)}}<span></b></h3>
            <h3><b><span id="taon">{{$year}}<span></b></h3>
        </center><br>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-5"> <label for="">Month</label>
                        <select name='month' id="filter" class='form-select mb-3' name="month" required>
                        <option value="January" {{$month == 'January' ? 'selected' : '' }}>January</option>
                            <option value="February" {{$month == 'February' ? 'selected' : '' }}>February</option>
                            <option value="March" {{$month == 'March' ? 'selected' : '' }}>March</option>
                            <option value="April" {{$month == 'April' ? 'selected' : '' }}>April</option>
                            <option value="May" {{$month == 'May'? 'selected' : '' }}>May</option>
                            <option value="June" {{$month == 'June' ? 'selected' : '' }}>June</option>
                            <option value="July" {{$month == 'July'? 'selected' : '' }}>July</option>
                            <option value="August" {{$month == 'August'? 'selected' : '' }}>August</option>
                            <option value="September" {{$month == 'September'? 'selected' : '' }}>September</option>
                            <option value="October" {{$month == 'October'? 'selected' : '' }}>October</option>
                            <option value="November" {{$month == 'November'? 'selected' : '' }}>November</option>
                            <option value="December" {{$month == 'December'? 'selected' : '' }}>December</option>
                        </select>
                    </div>
                    <div class="col-sm-3"><label for="">Year</label>
                        <input type="number" name="year" id="year" value="{{$year}}" class="form-control mb-3" required>
                        <input type="hidden" id="facultyID" value="{{Session::get('facultyId')}}" class="form-control mb-3" required>
                    </div>
                </div>
            </div>
        </div>


        <div id="filterresult">
            <center><canvas id="myChart" style="width:100%;max-width:700px"></canvas></center>
        </div>


    </div>
</div>

<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    var total = <?php echo $qty_transferred; ?>;

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
                label: "Consumed",
                data: decommissioned,
                borderColor: "red",
                fill: true
            }, {
                label: "Expired",
                data: repair,
                borderColor: "green",
                fill: true
            }, {
                label: "Total Quantity",
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


<script>
        var availablecon = <?php echo $Cavailablecount ?>;
        var decom = <?php echo $Cdecomcount ?>;
        var repaircon = <?php echo $Crepaircount ?>;

        var xValues = ["Available", "Consumed", "Expired"];        
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
                url: '{{route("filter.item_monthly_chart2") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
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

@include('template.footer')