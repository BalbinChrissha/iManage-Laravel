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
        $('#table_id1').DataTable();

    });
</script>
@include('template.staffNavbar')



<div class="col-10 mx-auto my-5 bg-light rounded">

    <div class="col-sm-11 mx-auto p-5">
        <center>
            <h3><b><span id="state">
                        EQUIPMENT: AVAILABLE
                    </span> </b></h3>
            <h3 id="title"><b>REPORT FOR THE MONTH OF <span id="buwan">{{mb_strtoupper($month)}}<span></b></h3>
            <h3><b><span id="taon">{{$year}}<span></b></h3>
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
                        <input type="number" name="year" id="year" value="{{$year}}" class="form-control mb-3" required>
                        <input type="hidden" name="year" id="staffID" value="{{Session::get('sosId')}}" class="form-control mb-3" required>
                    </div>
                    <div class="col-sm-3"> <label for="">Month</label>
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
                    <div class="col-1">
                        <center><br><button type="submit" id="filterbutton" class="btn btn-primary">Filter</button></center>
                    </div>
                </div>
            </div>
        </div>

        <br> <br>

        <div class="row">
            <div style="overflow-x:auto;" id="filterresult">
                <table id="table_id1" class="display">
                    <thead>
                        <tr>

                            <th scope="col">Item ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Quantity Transferred</th>
                            <th scope="col">Available</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                        <tr>

                            <td>{{ $record -> itemid }}</td>
                            <td>{{ $record -> item_name}}</td>
                            <td>{{ $record -> quantity}}</td>
                            <td>{{ $record -> totaltransfer}}</td>
                            <td>{{ $record -> available_qty}}</td>
                        </tr>

                        @endforeach
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
            var staffno = $('#staffID').val();
            var selectedfilter = $("#filter").val();
            var selectedcategory = $("#category").val();

            var stateitem = $("#statefil").val();

            let newmonth = selectedfilter.toUpperCase();
            let newcategory = selectedcategory.toUpperCase();
            var hehe = stateitem.toUpperCase();
            $('#state').text(newcategory + ": " + hehe);
            $('#taon').text(inputValue);
            $('#buwan').text(newmonth);

            //alert(selectedfilter + " " + selectedcategory + " " + stateitem + " " + inputValue + " " + staffno)

            $.ajax({
                url: '{{route("filter.staff_filter_item") }}',
                type: 'POST', // Use the POST method
                data: {
                    _token: '{{ csrf_token() }}',
                    dropdown: selectedfilter,
                    category: selectedcategory,
                    state: stateitem,
                    year: inputValue,
                    staffID: staffno,
                }, // Send any data that you need to the server
                success: function(html) {
                    $('#filterresult').html(html);
                    console.log(html); // Update the content of the div
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("Error Thrown: " + errorThrown);
                    console.log("Text Status: " + textStatus);
                    console.log("XMLHttpRequest: " + XMLHttpRequest);
                    console.warn(XMLHttpRequest.responseText)
                }
            });
        });


        $("select#category").change(function() {
            var selectedcategory = $(this).children("option:selected").val();

            $.ajax({
                url: '{{route("filter.changeDropdown") }}',
                type: 'POST', // Use the POST method
                data: {
                    _token: '{{ csrf_token() }}',
                    dropdown: selectedcategory,
                }, // Send any data that you need to the server
                success: function(html) {
                    $('#changeradio').html(html); // Update the content of the div
                }
            });
        });



    });
</script>



@include('template.footer')