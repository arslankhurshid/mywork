<section>
    <h3>
        Order Pages
    </h3>
    <p class="alert alert-info">Drag to order pages and click 'Save'</p>
    <div id="orderResult"></div>
</section>

<script>
    $(function(){
       $.post('<?php echo site_url('admin/page/order_ajax'); ?>', function(data){
           $('#orderResult').html(data);
           
       });
           
    });
</script>