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
    });
</script>
@include('template.staffNavbar')



<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><b>Transfer Item to Faculty In Charge</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/staff/addTransfer" method="post">
                @csrf
                <div class="modal-body"><br>
                    <div class="col-sm-11 mb-2 mx-auto">
                        <?php //echo display_error_sos(); 
                        ?>
                        <div class="col">
                            <label for="">Item</label>
                            <select name='itemID' class='form-select mb-3'>
                                @foreach ($addItems as $add)
                                <option value="{{$add -> itemid}}"> {{$add -> itemquan}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col">
                            <label for="">Faculty In Charge</label>
                            <select name='facultyID' class='form-select mb-3'>
                                @foreach ($addFacs as $faculty)
                                <option value="{{$faculty -> facultyID}}"> {{$faculty-> faculty_name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col"><label for="">Date Transfer</label> @error('d8_transfer')
                            <span class="errormessage">{{$message}}</span>
                            @enderror
                            <input type="date" name="d8_transfer" value="{{@old('d8_transfer')}}" class="form-control mb-3">
                        </div>
                        <div class="col"><label for="">Quantity</label> @error('qty_transferred')
                            <span class="errormessage">{{$message}}</span>
                            @enderror
                            <input type="number" name="qty_transferred" value="{{@old('qty_transferred')}}" class="form-control mb-3">
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="item_transfer" value="Insert Record">
            </form>
        </div>
    </div>
</div>
</div>
</div>





<!------------------------------------------- end of modal -->



<div class="col-10 mx-auto my-5 bg-light rounded">
    <div class="col-sm-11 mx-auto p-5">
        <center>
            <h3><b>RECORDS FOR TRANSFERING</b></h3>
        </center><br>

        @if($errors->any())
        <div class="alert alert-danger">
            <center>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </center>
        </div>
        @endif

        <div class="row">
            <div class="col-sm-2 mb-2">
            </div>

            <div class="col-sm-10 mb-2" align="right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Transfer Item</button>

            </div>

        </div>

        <div class="row">
            <div style="overflow-x:auto;" class="col-md-6">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Employee No.</th>
                            <th scope="col">Departmeent</th>
                            <th scope="col">Name</th>
                            <th scope="col">Room No.</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($faculties as $faculty)
                        <tr>
                            <td>{{$faculty -> facultyID}}</td>
                            <td>{{$faculty -> dep_name}}</td>
                            <td>{{$faculty -> faculty_name}}</td>
                            <td>{{$faculty -> room_no}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br><br>
            </div>




            <div style="overflow-x:auto;" class="col-md-6">
                <table id="table_id1" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Item ID</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date Purchased</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)

                        <tr>

                            <td>{{$item -> itemid}}</td>
                            <td>{{$item -> category_name}}</td>
                            <td>{{$item -> item_name}}</td>
                            <td>{{$item -> date_purchased}}</td>
                            <td>{{$item -> quantity}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- end of first div ---------------------------------------------------------->



<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3><b>TRANSFERRED ITEMS</b></h3>
        </center><br>
        <div class="row">
            <div class="col-sm-2 mb-2">
            </div>

            <div class="col-sm-10 mb-2" align="right">
                <!-- Button trigger modal -->
                <!-- <button type="button" onclick="downloadPDF()" class="btn btn-primary">Print Transfer Report</button> -->
            </div>
        </div>

        <div class="row">
            <div style="overflow-x:auto;">
                <table id="table_id2" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Record #</th>
                            <th scope="col">Item No.</th>
                            <th scope="col">Item Category</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Employee #</th>
                            <th scope="col">Department</th>
                            <th scope="col">Faculty In Charge</th>
                            <th scope="col">Room #</th>
                            <th scope="col">Date Transferred</th>
                            <th scope="col">Qty. Transferred</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                        <tr>
                            <td>{{$record -> recordno}}</td>
                            <td>{{$record -> itemid}}</td>
                            <td>{{$record -> category_name}}</td>
                            <td>{{$record -> item_name}}</td>
                            <td>{{$record -> facultyID}}</td>
                            <td>{{$record -> dep_name}}</td>
                            <td>{{$record -> faculty_name}}</td>
                            <td>{{$record -> room_no}}</td>
                            <td>{{$record -> date_transferred}}</td>
                            <td>{{$record -> qty_transferred}}</td>
                            <td> <a href="/staff/editTransfer/{{$record -> recordno}}"><i input class="fa-solid fa-pen-to-square" style="color:blue;"></i></a> &nbsp; <a href="/staff/delTransfer/{{$record -> recordno}}"><i input class="fas fa-trash-alt" style="color:red;"></i> </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>






@include('template.footer')