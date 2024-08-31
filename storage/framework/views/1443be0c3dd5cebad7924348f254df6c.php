<table id="table_id10" class="display">
    <thead>
        <tr>
            <th scope="col">Record #</th>
            <th scope="col">Item ID</th>
            <th scope="col">Item Name</th>
            <th scope="col">No. <?php echo e($state); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>

            <td><?php echo e($record -> recordno); ?></td>
            <td><?php echo e($record -> itemid); ?></td>
            <td><?php echo e($record -> item_name); ?></td>
            <td><?php echo e($record -> mema); ?></td>
        </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#table_id10').DataTable();
    });
</script><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/filter/fac_filter_item.blade.php ENDPATH**/ ?>