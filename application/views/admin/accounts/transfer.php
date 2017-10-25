<h3><?php // echo empty($tranfer->id) ? 'Add a new account' : 'Edit Page:' . '&nbsp' . $tranfer->title    ?></h3>

<?php if (!empty(validation_errors())): ?>
    <div class="alert alert-danger" id="errordiv">
        <?php echo validation_errors() ?>
    </div>
<?php endif; ?>
<?php
echo "<pre>";
print_r($user_accounts);
echo "</pre>";
//exit();
?>

<?php echo form_open('', array('onsubmit' => 'return validate();'));?>

<table class="table">
    <tr>
        <td>From:</td>
        <td><?php echo form_dropdown('from_bank', $user_accounts, $this->input->post('from_bank') ? $this->input->post('from_bank') : $account->from_bank, 'class="target" id="my_id"'); ?></td>
    </tr>
    <tr>
        <td>To:</td>
        <td><?php echo form_dropdown('to_bank', $user_accounts, $this->input->post('to_bank') ? $this->input->post('to_bank') : $account->to_bank, 'class="target" id="my_id"'); ?></td>
    </tr>
<!--    <tr id="subview_cat">
    <?php // $this->load->view($subview_cat); // subview is set in Controller?>
    </tr>-->
    <tr>
        <td>Transfer Amount:</td>
        <td><?php echo form_input('amount', set_value('title', $account->amount)); ?></td>
    </tr>
    <tr>
        <td>Reference:</td>
        <td><?php echo form_input('reference', set_value('reference', $account->reference)); ?></td>
    </tr><!--
    <tr>
        <td>Starting Amount:</td>
        <td><?php // echo form_input('amount', set_value('amount', $account->amount));    ?></td>
    </tr>
    <tr>
        <td>Balance:</td>
        <td><?php // echo form_input('balance', set_value('balance', $account->balance));    ?></td>
    </tr>>-->
    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>

</table>
<?php echo form_close(); ?>

<script>
function validate()
{
     var r=confirm("Do you want to Transfer this?")
    if (r==true)
      return true;
    else
      return false;
}
</script>
