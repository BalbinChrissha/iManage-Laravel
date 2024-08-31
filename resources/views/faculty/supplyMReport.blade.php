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
            <h3><b>UPDATE ITEM STATE </b></h3>
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
            <form action="/faculty/updateInventoryState/{{$recordno}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Item Name</label>

                        <input class="form-control mb-3" type="text" value="{{$name}}" name="item_name" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Item ID</label>
                        <input class="form-control mb-3" value="{{$itemID}}" name="itemID" readonly>
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
                        <input type="number" name="available_qty" value="{{@old('available_qty')}}" class="form-control mb-3">
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Qty: Consumed</label> @error('unavailable1_qty')
                        <span class="errormessage">{{$message}}</span>
                        @enderror
                        <input type="number" name="unavailable1_qty" value="{{@old('available1_qty')}}" class="form-control mb-3">
                    </div>
                    <div class="col-lg-6">
                        <label for="">Qty: Expired (Perishable Items Only)</label> @error('unavailable2_qty')
                        <span class="errormessage">{{$message}}</span>
                        @enderror
                        <input type="number" name="unavailable2_qty" value="{{@old('available2_qty')}}" class="form-control mb-3">
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6"> <label for="">Month</label>
                        <select name='month' class='form-select mb-3' name="month">
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
                    <div class="col-lg-6"><label for="">Year</label> @error('year')
                        <span class="errormessage">{{$message}}</span>
                        @enderror
                        <input type="number" name="year" value="{{@old('year')}}" id="year" class="form-control mb-3">
                    </div>

                </div>

                <input type="submit" class="btn btn-primary" name="add_itemcondition" value="Update">
                <br><br>
            </form>

        </div>



    </div>
</div>

@include('template.footer')