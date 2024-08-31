
<center><canvas id="myChart3" style="width:100%;max-width:700px"></canvas></center>

<script>
    var availablecon = {{ $availablecount }};
    var consumed = {{ $decomcount }};
    var repaircon = {{ $repaircount }};

    var xValues = ["Available", "Unavailable - Decommissioned", "Unavailable - In Repair"];
    var yValues = [availablecon, consumed, repaircon];

    var barColors = [
        "#2F5F98",
        "#2D8BBB",
        "#41B8D5"
    ];

    new Chart("myChart3", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        }
    });
</script>
