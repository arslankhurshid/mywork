<h3><?php echo empty($account->id) ? 'Add a new account' : 'Edit Account:' . '&nbsp' . $account->title ?></h3>
<h3><?php print_r($accout_type); ?></h3>

<?php exit();?>
<?php if (!empty(validation_errors())): ?>
    <div class="alert alert-danger" id="errordiv">
        <?php echo validation_errors() ?>
    </div>
<?php endif; ?>

<?php echo form_open(); ?>
<table class="table">
<!--    <tr>
        <td>Select Category:</td>
        <td><?php // echo form_dropdown('cat_id', $categories, $this->input->post('category_id') ? $this->input->post('category_id') : $account->category_id, 'class="target" id="my_id"'); ?></td>
    </tr>-->
<!--    <tr id="subview_cat">
        <?php // $this->load->view($subview_cat); // subview is set in Controller?>
    </tr>-->
    <tr>
        <td>Title:</td>
        <td><?php echo form_input('title', set_value('title', $account->title)); ?></td>
    </tr>
    <tr>
        <td>Description:</td>
        <td><?php echo form_input('description', set_value('description', $account->description)); ?></td>
    </tr>
    <tr>
        <td>Starting Amount:</td>
        <td><?php echo form_input('amount', set_value('amount', $account->amount)); ?></td>
    </tr>
    <tr>
        <td>Balance:</td>
        <td><?php echo form_input('balance', set_value('balance', $account->balance)); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>

</table>
<?php echo form_close(); ?>

