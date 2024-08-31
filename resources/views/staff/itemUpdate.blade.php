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


<div class="container" style="margin-top: 2%;">
    <div class="div1">
        <center>
            <h3><b>UPDATE ITEM / INVENTORY </b></h3>
        </center><br>
        <div class="col-sm-9 mx-auto">
            <form action="/staff/updateItem/{{$itemId}}" method="post">
                @csrf

                <div class="row">
                            <div class="col-sm-6">
                                <label for="">Item Category</label>

                                <select name='categoryno' class='form-select mb-3'>
                                    @foreach ($categories as $category)
                                    <option value="{{$category -> categoryID}}"  {{$category -> categoryID == $categoryno? 'selected' : '' }}> {{$category -> category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Item Name</label> @error('name')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control mb-3" value="{{$name}}" name="name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6"> <label for="">Serial No.</label> @error('serialno')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input type="text" name="serialno" value="{{$serialno}}" class="form-control mb-3">
                            </div>
                            <div class="col-lg-6"> <label for="">Description</label> @error('description')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <textarea class="form-control" name="description" rows="3">{{$description}}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6"> <label for="">Overall Cost</label> @error('cost')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input type="number" name="cost" value="{{$cost}}" class="form-control mb-3">
                            </div>
                            <div class="col-sm-6"><label for="">Quantity</label> @error('quantity')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input type="number" name="quantity" value="{{$quantity}}" class="form-control mb-3">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6"><label for="">Date Purchased</label> @error('d8_purchased')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input type="date" name="d8_purchased" value="{{$d8_purchased}}" class="form-control mb-3">
                            </div>
                        </div>
                <input type="submit" class="btn btn-primary" name="update_item" value="Update">
                <br><br>
            </form>

        </div>



    </div>
</div>


@include('template.footer')