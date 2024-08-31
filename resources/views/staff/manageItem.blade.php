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

@include('template.staffNavbar')



<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><b>Add Inventory</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/staff/addItem" method="post">
                @csrf
                <div class="modal-body"><br>
                    <div class="col-sm-11 mb-3 mx-auto">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Item Category</label>

                                <select name='categoryno' class='form-select mb-3'>
                                    @foreach ($categories as $category)
                                    <option value="{{$category -> categoryID}}"> {{$category -> category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Item Name</label> @error('name')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input class="form-control mb-3" value="{{@old('name')}}" name="name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6"> <label for="">Serial No.</label> @error('serialno')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input type="text" name="serialno" value="{{@old('serialno')}}" class="form-control mb-3">
                            </div>
                            <div class="col-lg-6"> <label for="">Description</label> @error('description')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <textarea class="form-control" name="description" rows="3">{{@old('description')}}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6"> <label for="">Overall Cost</label> @error('cost')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input type="number" name="cost" value="{{@old('cost')}}" class="form-control mb-3">
                            </div>
                            <div class="col-sm-6"><label for="">Quantity</label> @error('quantity')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input type="number" name="quantity" value="{{@old('quantity')}}" class="form-control mb-3">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6"><label for="">Date Purchased</label> @error('d8_purchased')
                                <span class="errormessage">{{$message}}</span>
                                @enderror
                                <input type="date" name="d8_purchased" value="{{@old('d8_purchased')}}" class="form-control mb-3">
                            </div>
                        </div>

                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="create_item" value="Insert Record">
            </form>
        </div>
    </div>
</div>
</div>
</div>


<div class="col-11 mx-auto my-5 bg-light rounded">

    <div class="col-sm-11 mx-auto p-5">
        <center>
            <h3><b>MANAGE INVENTORY</b></h3>
        </center><br>
        <div class="row">
            <div class="col-sm-2 mb-2">
            </div>

            <div class="col-sm-10 mb-2" align="right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Add Item</button>

            </div>

        </div>
        <div class="row">
            <div style="overflow-x:auto;">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Serial No.</th>
                            <th scope="col">Description</th>
                            <th scope="col">PPP</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Date Purchased</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Analytics</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>


                            @php
                            $cost = $item->cost;
                            $quantity = $item->quantity;
                            $ppp = number_format($cost / $quantity, 2);
                            @endphp

                            <td>{{$item -> itemid}}</td>
                            <td>{{$item ->  category_name}}</td>
                            <td>{{$item -> item_name}}</td>
                            <td>{{$item -> serialno}}</td>
                            <td>{{$item -> item_desc}}</td>
                            <td>{{$ppp}}</td>
                            <td>{{$item -> cost}}</td>
                            <td>{{$item -> date_purchased}}</td>
                            <td>{{$item -> quantity}}</td>
                            <td> <a href="/staff/editItem/{{$item -> itemid}}"><i class="fa-solid fa-pen-to-square" style="color:blue;"></i></a> &nbsp; <a href="/staff/delItem/{{$item -> itemid}}"><i class="fas fa-trash-alt" style="color:red;"></i> </a></td>
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