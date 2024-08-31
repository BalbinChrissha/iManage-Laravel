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
    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3 id="title"><b>EQUIPMENT : OVERALL REPORT FOR THE YEAR OF {{$year}}</b></h3>
        </center><br>
        <div>
            <center><canvas id="overallChart" style="width:100%;max-width:800px"></canvas></center>
        </div>
    </div>
</div>




<div class="col-10 mx-auto my-5 bg-light rounded">
    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3 id="title"><b>SUPPLY: OVERALL REPORT FOR THE YEAR OF {{$year}}</b></h3>
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

    var total = <?php echo  $total1; ?>;
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
                label: "Total Equipments",
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

    var total2 = <?php echo  $total2;  ?>;
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
                borderColor: "green",
                fill: true
            }, {
                label: "Expired",
                data: expired,               
                borderColor: "red",
                fill: true
            }, {
                label: "Total Perishable Items",
                data: [total2, total2, total2, total2, total2, total2, total2, total2, total2, total2, total2, total2],
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


@include('template.footer')