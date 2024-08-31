<table id="table_id10" class="display">
    <thead>
        <tr>
            <th scope="col">Record #</th>
            <th scope="col">Item ID</th>
            <th scope="col">Item Name</th>
            <th scope="col">No. {{$state}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>

            <td>{{ $record -> recordno}}</td>
            <td>{{$record -> itemid}}</td>
            <td>{{$record -> item_name}}</td>
            <td>{{$record -> mema}}</td>
        </tr>

        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#table_id10').DataTable();
    });
</script>