<label for="">State</label><br>
<select id="statefil" class='form-select mb-3' name="classification" required>
    <?php if($dropdown == 'Equipment'): ?>
        <option value="Available">Available</option>
        <option value="Unavailable - Decomissioned">Unavailable - Decomissioned</option>
        <option value="Unavailable - In repair">Unavailable - In repair</option>
    <?php else: ?>
        <option value="Available">Available</option>
        <option value="Consumed">Consumed</option>
        <option value="Expired">Expired</option>
    <?php endif; ?>
</select><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/filter/changeDropdown.blade.php ENDPATH**/ ?>