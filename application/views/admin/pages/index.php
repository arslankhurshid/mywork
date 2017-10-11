<!--<div class="container">-->
    <!--<div class="row col-md-8">-->
        <section>
            <h2>Pages</h2>
            <?php echo anchor('admin/page/edit', '<span class="glyphicon glyphicon-plus"> </span>Add a Page'); ?>


            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <td >Title</td>
                        <td>Edit</td>
                        <td>Delete</td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($pages)) :
                        foreach ($pages as $page):
                            ?>
                        

                        <tr>
                            <td><?php echo anchor('admin/page/edit/' . $page->id, $page->title); ?> </td>
                            <td><?php echo btn_edit('admin/page/edit/' . $page->id) ?></td>
                            <td><?php echo btn_delete('admin/page/delete/' . $page->id) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3"> We could not find any page.</td>
                        </tr>

                    <?php endif; ?>

            </table>
        </section>

    <!--</div></div>-->