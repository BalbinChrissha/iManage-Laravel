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
<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
        $('#table_id1').DataTable();
        $('#table_id2').DataTable();

        $('#table_id3').DataTable();
    });
</script>
@include('template.facultyNavbar')



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

                        @foreach ($records as $record)
                        <tr>
                            <td> {{$record -> recordno}}</td>
                            <td> {{$record -> category_name}}</td>
                            <td> {{$record -> itemid}}</td>
                            <td> {{$record -> item_name}}</td>
                            <td> {{$record -> item_desc}}</td>
                            <td> {{$record -> dep_name}}</td>
                            <td> {{$record -> room_no}}</td>
                            <td> {{$record -> date_transferred}}</td>
                            <td> {{$record -> qty_transferred}}</td>
                            <td> <a href="/faculty/addMonthlyReport/{{$record -> recordno}}/{{$record -> categoryID}}"><i class='fa-solid fa-circle-plus'></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>





<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3 id="title"><b>EQUIPMENT REPORT FOR THE MONTH OF <span id="buwan">{{$month}}<span></b></h3>
            <h3><b><span id="taon">{{$year}}<span></b></h3>
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
                        @foreach ($equipments as $equip)
                        <tr>
                            <td>{{$equip -> recordno}}</td>
                            <td>{{$equip -> itemid}}</td>
                            <td>{{$equip -> item_name}}</td>
                            <td>{{$equip -> available_qty}}</td>
                            <td>{{$equip -> unavailable1_qty}}</td>
                            <td>{{$equip -> unavailable2_qty}}</td>
                            <td><a href="/faculty/editInventoryState/{{$equip -> stateID}}/{{$equip -> checkedID}}/{{2}}"><i input type="edit" class="fa-solid fa-pen-to-square" style="color:blue;"></i></a> &nbsp;<a href="/faculty/delInventoryState/{{$equip -> stateID}}/{{$equip -> checkedID}}"><i input type="submit" class="fas fa-trash-alt" style="color:red;"></i> </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>






<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3 id="title"><b>SUPPLY REPORT FOR THE MONTH OF <span id="buwan1">{{$month}}<span></b></h3>
            <h3><b><span id="taon1">{{$year}}<span></b></h3>
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
                        @foreach ($supplies as $supply)
                        <tr>
                            <td>{{$supply -> recordno}}</td>
                            <td>{{$supply -> itemid}}</td>
                            <td>{{$supply -> item_name}}</td>
                            <td>{{$supply -> available_qty}}</td>
                            <td>{{$supply -> unavailable1_qty}}</td>
                            <td>{{$supply -> unavailable2_qty}}</td>
                            <td><a href=""><i input type="edit" class="fa-solid fa-pen-to-square" style="color:blue;"></i></a> &nbsp; <a href=""><i input type="submit" class="fas fa-trash-alt" style="color:red;"></i> </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>









@include('template.footer')