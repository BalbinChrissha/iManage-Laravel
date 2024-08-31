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

    .div1 {
        width: 80%;
        padding: 20px;
        margin: auto;
        border-radius: 20px;
        background-color: white;
    }
</style>
@include('template.staffNavbar')

<div class="container" style="margin-top: 5%;">
    <div class="div1">
        <center>
            <h3><b>UPDATE ITEM / INVENTORY </b></h3>
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

        <div class="col-sm-9 mx-auto">
            <form action="/staff/updateTransfer/{{$recordno}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Item</label>
                        <select name='itemID' class='form-select mb-3'>
                            @foreach ($addItems as $add)
                            <option value="{{$add -> itemid}}"  {{$add ->itemid == $itemID ? 'selected' : '' }}> {{$add -> itemquan}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-lg-6">
                        <label for="">Faculty In Charge</label>
                        <select name='facultyID' class='form-select mb-3'>
                            @foreach ($addFacs as $faculty)
                            <option value="{{$faculty -> facultyID}}"  {{$faculty -> facultyID == $facultyID ? 'selected' : '' }}> {{$faculty-> faculty_name}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6"><label for="">Date Transferred</label>
                        <input type="date" name="d8_transfer" value="{{ $date_transferred}}" class="form-control mb-3" required>
                    </div>
                    <div class="col-lg-6"><label for="">Quantity Transferred</label>
                        <input type="number" name="qty_transferred" value="{{$qty_transferred}}" class="form-control mb-3" required>
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-primary" name="update_item_transfer" value="Update">
                <br><br>
            </form>

        </div>



    </div>
</div>



@include('template.footer')