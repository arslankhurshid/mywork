<h3><?php echo empty($employee->id) ? 'Add a new Employee' : 'Edit Account:' . '&nbsp' . $employee->fame ?></h3>


<?php if (!empty(validation_errors())): ?>
    <div class="alert alert-danger" id="errordiv">
        <?php echo validation_errors() ?>
    </div>
<?php endif; ?>

<?php echo form_open(); ?>
<table class="table">
<!--    <tr>
        <td>Select Category:</td>
        <td><?php // echo form_dropdown('cat_id', $categories, $this->input->post('category_id') ? $this->input->post('category_id') : $account->category_id, 'class="target" id="my_id"');      ?></td>
    </tr>-->
<!--    <tr id="subview_cat">
    <?php // $this->load->view($subview_cat); // subview is set in Controller ?>
    </tr>-->
    <tr>
        <td>First Name:</td>
        <td><?php echo form_input('fname', set_value('fname', $employee->fname)); ?></td>
    </tr>
    <tr>
        <td>Last Name:</td>
        <td><?php echo form_input('lname', set_value('lname', $employee->lname)); ?></td>
    </tr>
    <tr>
        <td>Department:</td>
        <td><?php echo form_input('dep', set_value('dep', $employee->dep)); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>

</table>
<?php echo form_close(); ?>

