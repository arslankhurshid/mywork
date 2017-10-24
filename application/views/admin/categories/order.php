<section>
    <h3>
        Order Categories
    </h3>
    <p class="alert alert-info">Drag to order categories and click 'Save'</p>
    <div id="orderResult"></div>
    <input type="button" id="save" value="Save" class="btn btn-primary" />
</section>

<script>
    $(function () {
        $.post('<?php echo site_url('admin/categories/order_ajax'); ?>', function (data) {
            $('#orderResult').html(data);

        });

        $('#save').click(function () {
            oSortable = $('.sortable').nestedSortable('toArray');
            $('#orderResult').slideUp(function () {
                $.post('<?php echo site_url('admin/categories/order_ajax'); ?>', {sortable: oSortable}, function (data) {
                    $('#orderResult').html(data);
                    $('#orderResult').slideDown();
                });
            });

        });

    });
</script>