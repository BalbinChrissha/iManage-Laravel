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
@include('template.staffNavbar')

<div class="col-10 mx-auto my-5 bg-light rounded">
    <input type="hidden" name="year" id="itemID" value="<?php //echo $itemid; ?>">

    <div class="col-sm-8 mx-auto p-5">
      <center>
        <h3 id="title"><b>EQUIPMENT : QUANTITY TRANSFERRED</b></h3>
      </center><br>

      <div>
        <center><canvas id="TransferChart" style="width:100%;max-width:800px"></canvas></center>
      </div>
      <br>
      <h5 style="text-align: justify;"><?php



                                        if (($totaltransfer == 0) && ($remainder == 0) && ($totalqty1 == 0)) {
                                          echo "<b>No equipment handling yet</b>";
                                        } elseif (($totaltransfer == 0) && ($remainder == $totalqty1)) {
                                          echo "100% of the equipment inventory, or " . $totalqty . " items, have not been transferred to a Faculty In Charge.";
                                        } else if ($totaltransfer  == $totalqty1) {
                                          $transfpercent = round((($totaltransfer / $totalqty1) * 100), 2);
                                          $nottransfpercent = round((($remainder / $totalqty1) * 100), 2);
                                          echo $transfpercent . "% of the equipment inventory, or " . $totaltransfer . " out of " . $totalqty1 . " items, have been transferred to the Faculty In Charge.";
                                        } else {
                                          $transfpercent = round((($totaltransfer / $totalqty1) * 100), 2);
                                          $nottransfpercent = round((($remainder / $totalqty1) * 100), 2);
                                          echo $transfpercent . "% of the equipment inventory, or " . $totaltransfer . " out of " . $totalqty1 . " items, have been transferred to the Faculty In Charge, while the remaining " . $nottransfpercent . "% or " . $remainder . " items have not been transferred.";
                                        }
                                        ?></h5>
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
    <div class="col-sm-8 mx-auto p-5">
      <center>
        <h3 id="title"><b>SUPPLY: QUANTITY TRANSFERRED</b></h3>
      </center><br>

      <div>
        <center><canvas id="TransferChart2" style="width:100%;max-width:800px"></canvas></center>
      </div>
      <br>
      <h5 style="text-align: justify;"><?php

                                        if (($totaltransfer2 == 0) && ($remainder2 == 0) && ($totalqty2 == 0)) {
                                          echo "<b>No supply handling yet</b>";
                                        } else if (($totaltransfer2 == 0) && ($remainder2 == $totalqty2)) {
                                          echo "100% of the supply inventory, or " . $totalqty2 . " items, have not been transferred to a Faculty In Charge.";
                                        } else if ($totaltransfer2  == $totalqty2 ) {
                                          $transfpercent2 = round((($totaltransfer2 / $totalqty2) * 100), 2);
                                          $nottransfpercent2 = round((($remainder2 / $totalqty2) * 100), 2);
                                          echo $transfpercent2 . "% of the supply inventory, or " . $totaltransfer2 . " out of " . $totalqty2 . " items, have been transferred to the Faculty In Charge.";
                                        } else {
                                          $transfpercent2 = round((($totaltransfer2 / $totalqty2) * 100), 2);
                                          $nottransfpercent2 = round((($remainder2 / $totalqty2) * 100), 2);
                                          echo $transfpercent2 . "% of the supply inventory, or " . $totaltransfer2 . " out of " . $totalqty2 . " items, have been transferred to the Faculty In Charge, while the remaining " . $nottransfpercent2 . "% or " . $remainder2 . " items have not been transferred.";
                                        }
                                        ?></h5>
    </div>
  </div>


  <div class="col-10 mx-auto my-5 bg-light rounded">
    <div class="col-sm-12 mx-auto p-5">
      <center>
        <h3 id="title"><b>SUPPLY: OVERALL REPORT FOR THE YEAR OF 2023</b></h3>
      </center><br>


      <div>
        <center><canvas id="overallChart2" style="width:100%;max-width:800px"></canvas></center>
      </div>
    </div>
  </div>


  <script>
    var rem = <?php echo  $remainder;  ?>;
    var transferred = <?php echo  $totaltransfer; ?>;

    var xValues = ["Transferred", "Not Transferred"];
    var yValues = [transferred, rem];
    //var yValues = [0, 0, 0];
    var barColors = [
      "#2F5F98",
      "#2D8BBB",

    ];

    new Chart("TransferChart", {
      type: "pie",
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
    var rem = <?php echo  $remainder2;  ?>;
    var transferred = <?php echo  $totaltransfer2; ?>;

    var xValues = ["Transferred", "Not Transferred"];
    var yValues = [transferred, rem];
    //var yValues = [0, 0, 0];
    var barColors = [
      "#2F5F98",
      "#2D8BBB",

    ];

    new Chart("TransferChart2", {
      type: "pie",
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
 
 var available = <?php echo json_encode($available); ?>;
    var decommissioned = <?php echo json_encode($decommissioned); ?>;
    var repair = <?php echo json_encode($repair); ?>;


    var rem = <?php echo  $remainder;  ?>;
    var total = <?php echo  $totaltransfer; ?>;

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
          label: "Total Equipment Transferred",
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
    
    var availableCat2  = <?php echo json_encode($availableCat2 ); ?>;
    var consumed = <?php echo json_encode($consumed); ?>;
    var expired = <?php echo json_encode($expired); ?>;


    var rem = <?php echo  $remainder;  ?>;
    var total = <?php echo  $totaltransfer2; ?>;

    var xValues = ["Januray", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    new Chart("overallChart2", {
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
          label: "Total Supply Transferred",
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




@include('template.footer')