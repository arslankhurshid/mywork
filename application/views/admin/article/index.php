<!--<div class="container">-->
    <!--<div class="row col-md-8">-->
        <section>
            <h2>News Articles</h2>
            <?php echo anchor('admin/article/edit', '<span class="glyphicon glyphicon-plus"> </span>Add an Article'); ?>


            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <td >Title</td>
                        <td >Pubdate</td>
                        <td>Edit</td>
                        <td>Delete</td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($articles)) :
                        foreach ($articles as $article):
                            ?>
                        

                        <tr>
                            <td><?php echo anchor('admin/article/edit/' . $article->id, $article->title); ?> </td>
                            <td><?php echo $article->pub_date; ?> </td>
                            <td><?php echo btn_edit('admin/article/edit/' . $article->id) ?></td>
                            <td><?php echo btn_delete('admin/article/delete/' . $article->id) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3"> We could not find any article.</td>
                        </tr>

                    <?php endif; ?>

            </table>
        </section>

    <!--</div></div>-->