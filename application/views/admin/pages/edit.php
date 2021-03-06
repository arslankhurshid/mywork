<h3><?php echo empty($page->id) ? 'Add a new page' : 'Edit Page:' . '&nbsp' . $page->title ?></h3>
<?php if (!empty(validation_errors())): ?>
    <div class="alert alert-danger" id="errordiv">
        <?php echo validation_errors() ?>
    </div>
<?php endif; ?>
<?php echo form_open(); ?>
<table class="table">
    <tr>
        <td>Parent:</td>
        <td><?php echo form_dropdown('parent_id', $pages_without_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $page->parent_id); ?></td>
    </tr>
    <tr>
        <td>Title:</td>
        <td><?php echo form_input('title', set_value('title', $page->title)); ?></td>
    </tr>
    <tr>
        <td>Slug:</td>
        <td><?php echo form_input('slug', set_value('slug', $page->slug)); ?></td>
    </tr>
    <tr>
        <td>Body:</td>
        <td><?php echo form_textarea('body', set_value('body', $page->body), 'class="tinymce"'); ?></td>
    </tr>

    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>

</table>
<?php echo form_close(); ?>
