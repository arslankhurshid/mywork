<h3><?php echo empty($expense->id) ? 'Add a new expense' : 'Edit Page:' . '&nbsp' . $expense->title ?></h3>
<?php echo validation_errors() ?>
<?php echo form_open(); ?>
<table class="table">
    <tr>
        <?php
        echo "<pre>";
        print_r($subview_cat);
        echo "</pre>";
        ?>
        <td>Select Category:</td>
        <td><?php echo form_dropdown('cat_id', $categories, $this->input->post('category_id') ? $this->input->post('category_id') : $expense->category_id); ?></td>
    </tr>
     <tr>
        <?php $this->load->view($subview_cat); // subview is set in Controller?>
    </tr>
    <tr>
        <td>Date:</td>
        <td><?php echo form_input('date', set_value('date', $expense->date), 'class="datepicker"'); ?></td>
    </tr>
    <tr>
        <td>Description:</td>
        <td><?php echo form_input('title', set_value('title', $expense->title)); ?></td>
    </tr>
    <tr>
        <td>Amount:</td>
        <td><?php echo form_input('amount', set_value('amount', $expense->amount)); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>

</table>
<?php echo form_close(); ?>

<script>
    $(function () {

        $('.datepicker').datepicker({format: 'yyyy-mm-dd'});

    });
</script>
