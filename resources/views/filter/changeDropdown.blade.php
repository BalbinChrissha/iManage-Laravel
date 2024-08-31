<label for="">State</label><br>
<select id="statefil" class='form-select mb-3' name="classification" required>
    @if($dropdown == 'Equipment')
        <option value="Available">Available</option>
        <option value="Unavailable - Decomissioned">Unavailable - Decomissioned</option>
        <option value="Unavailable - In repair">Unavailable - In repair</option>
    @else
        <option value="Available">Available</option>
        <option value="Consumed">Consumed</option>
        <option value="Expired">Expired</option>
    @endif
</select>