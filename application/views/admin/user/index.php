<!--<div class="container">-->
    <!--<div class="row col-md-8">-->
        <section>
            <h2>Users</h2>
            <?php echo anchor('admin/user/edit', '<span class="glyphicon glyphicon-plus"> </span>Add a User'); ?>


            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <td >Email</td>
                        <td>Edit</td>
                        <td>Delete</td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($users)) :
                        foreach ($users as $user):
                            ?>
                        <?php endforeach; ?>

                        <tr>
                            <td><?php echo anchor('admin/user/edit/' . $user->id, $user->email); ?> </td>
                            <td><?php echo btn_edit('admin/user/edit/' . $user->id) ?></td>
                            <td><?php echo btn_delete('admin/user/delete/' . $user->id) ?></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="3"> We could not find any users.</td>
                        </tr>

                    <?php endif; ?>

            </table>
        </section>

    <!--</div></div>-->