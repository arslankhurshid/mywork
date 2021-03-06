<h3><?php echo empty($article->id) ? 'Add a new article' : 'Edit Page:' . '&nbsp' . $article->title ?></h3>
<?php if (!empty(validation_errors())): ?>
    <div class="alert alert-danger" id="errordiv">
        <?php echo validation_errors() ?>
    </div>
<?php endif; ?>
<?php echo form_open(); ?>
<table class="table">

    <tr>
        <td>Publication Date:</td>
        <td><?php echo form_input('pub_date', set_value('pub_date', $article->pub_date), 'class="datepicker"'); ?></td>
    </tr>
    <tr>
        <td>Title:</td>
        <td><?php echo form_input('title', set_value('title', $article->title)); ?></td>
    </tr>
    <tr>
        <td>Slug:</td>
        <td><?php echo form_input('slug', set_value('slug', $article->slug)); ?></td>
    </tr>
    <tr>
        <td>Body:</td>
        <td><?php echo form_textarea('body', set_value('body', $article->body), 'class="tinymce"'); ?></td>
    </tr>

    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>

</table>
<?php echo form_close(); ?>

<script>
$(function(){
   
   $('.datepicker').datepicker({format: 'yyyy-mm-dd'});
    
});
</script>
