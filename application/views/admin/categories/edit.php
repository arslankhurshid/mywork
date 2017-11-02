<h3><?php echo empty($category->id) ? 'Add a new category' : 'Edit Page:' . '&nbsp' . $category->title ?></h3>
<?php if (!empty(validation_errors())): ?>
    <div class="alert alert-danger" id="errordiv">
        <?php echo validation_errors() ?>
    </div>
<?php endif; ?>
<?php echo form_open(); ?>
<table class="table">
    <tr>
        <td>Parent:</td>
        <td><?php echo form_dropdown('parent_id', $categories_without_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $category->parent_id, 'class="btn btn-default dropdown-toggle btn-select2"'); ?></td>
    </tr>
    <tr>
        <td>Title:</td>
        <td><?php echo form_input('title', set_value('title', $category->title)); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>

</table>
<?php echo form_close(); ?>
