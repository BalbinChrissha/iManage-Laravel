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
  });
</script>
@include('template.facultyNavbar')


<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3><b>TRANSFERRED ITEMS</b></h3>
        </center><br>

        <div class="row">
            <div style="overflow-x:auto;">
                <table id="table_id" class="display">
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
                            <td> <a href="/faculty/viewDatachart/{{$record -> recordno}}/{{$record -> categoryID}}"><i class='fa-solid fa-eye'></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>



@include('template.footer')