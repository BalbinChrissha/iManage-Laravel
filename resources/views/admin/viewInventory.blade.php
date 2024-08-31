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
@include('template.adminNavbar')


<div class="col-11 mx-auto my-5 bg-light rounded">

    <div class="col-sm-12 mx-auto p-5">
        <center>
            <h3><b>INVENTORY</b></h3>
        </center><br>
        <div class="row">
            <div style="overflow-x:auto;">
                <table id="table_id2" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Managing Staff</th>
                            <th scope="col">Item #</th>
                            <th scope="col">Category</th>
                            <th scope="col">Item</th>
                            <th scope="col">Serial No.</th>
                            <th scope="col">Description</th>
                            <th scope="col">PPP</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Date Purchased</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Analytics</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach($records as $record)
                        <?php

                        $ppp = number_format(($record->cost /  $record->quantity), 2);
                        ?>
                        <tr>

                            <td>{{ $record -> staff_name }}</td>
                            <td>{{ $record -> itemid }}</td>
                            <td>{{ $record -> category_name }}</td>
                            <td>{{ $record -> item_name }}</td>
                            <td>{{ $record ->serialno }}</td>
                            <td>{{ $record ->item_desc }}</td>
                            <td>{{$ppp}}</td>
                            <td>{{ $record -> cost }}</td>
                            <td>{{ $record -> date_purchased }}</td>
                            <td>{{ $record -> quantity }}</td>
                            <td> <a href=""><i class="fa-solid fa-eye" style="color:blue;"></i> Analytics</a></td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>

@include('template.footer')