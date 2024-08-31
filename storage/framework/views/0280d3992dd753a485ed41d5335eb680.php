
<center><canvas id="myChart3" style="width:100%;max-width:700px"></canvas></center>

<script>
    var availablecon = <?php echo e($availablecount); ?>;
    var consumed = <?php echo e($decomcount); ?>;
    var repaircon = <?php echo e($repaircount); ?>;

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
<?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/filter/item_monthly_chart.blade.php ENDPATH**/ ?>