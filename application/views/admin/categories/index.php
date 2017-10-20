<!--<div class="container">-->
<!--<div class="row col-md-8">-->
<section>
    <h2>Categories</h2>
    <?php echo anchor('admin/categories/edit', '<span class="glyphicon glyphicon-plus"> </span>Add a Category'); ?>


    <table class="table table-striped" width="100%">
        <thead>
            <tr>
                <td >Category</td>
                <td >Under Category(Parent)</td>
                <td>Edit</td>
                <td>Delete</td>

            </tr>
        </thead>
        <tbody>
            <?php
//            echo "<pre>";
//            print_r($categories);
//            echo "</pre>";
            if (count($categories)) :
                foreach ($categories as $category):
                    ?>


                    <tr>
                        <td><?php echo anchor('admin/categories/edit/' . $category->id, $category->title); ?> </td>
                        <td><?php echo $category->parent_title; ?> </td>
                        <td><?php echo btn_edit('admin/categories/edit/' . $category->id) ?></td>
                        <td><?php echo btn_delete('admin/categories/delete/' . $category->id) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"> We could not find any Category.</td>
                </tr>

            <?php endif; ?>

    </table>
</section>

<!--</div></div>-->