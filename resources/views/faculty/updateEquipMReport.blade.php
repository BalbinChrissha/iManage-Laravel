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
@include('template.facultyNavbar')




<div class="container" style="margin-top: 2%;">
    <div class="div1">
        <center>
            <h3><b>UPDATE STATE OF TRANSFERRED ITEMS </b></h3>
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
            <form action="/faculty/updateInventoryStateReport/{{$stateID}}/{{$checkedID}}/{{$recordno}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Item Name</label>

                        <input class="form-control mb-3" type="text" value="{{$item_name}}" name="item_name" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Item ID</label>
                        <input class="form-control mb-3" value="{{$itemid}}" name="itemID" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Qty. Transfered</label>
                        <input class="form-control mb-3" value="{{$qty_transferred}}" name="qty_transferred" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Qty: Available</label> @error('available_qty')
                        <span class="errormessage">{{$message}}</span>
                        @enderror
                        <input type="number" name="available_qty" value="{{$available_qty}}" class="form-control mb-3">
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Qty: Unavailable - Decommissioned</label> @error('unavailable1_qty')
                        <span class="errormessage">{{$message}}</span>
                        @enderror
                        <input type="number" name="unavailable1_qty" value="{{$unavailable1_qty}}" class="form-control mb-3">
                    </div>
                    <div class="col-lg-6">
                        <label for="">Qty: Unavailable - In Repair</label> @error('unavailable2_qty')
                        <span class="errormessage">{{$message}}</span>
                        @enderror
                        <input type="number" name="unavailable2_qty" value="{{$unavailable2_qty}}" class="form-control mb-3">
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6"> <label for="">Month</label >
                        <select name='month' class='form-select mb-3' name="month" disabled>
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
                    <div class="col-lg-6"><label for="">Year</label> @error('year')
                        <span class="errormessage">{{$message}}</span>
                        @enderror
                        <input type="number" name="year" value="{{$year}}" id="year" class="form-control mb-3" readonly>
                    </div>

                </div>

                <input type="submit" class="btn btn-primary" name="add_itemcondition" value="Update">
                <br><br>
            </form>

        </div>



    </div>
</div>

@include('template.footer')