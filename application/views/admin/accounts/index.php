<!--<div class="container">-->
<!--<div class="row col-md-8">-->
<section>
    <h2>Accounts</h2>
    <?php echo anchor('admin/accounts/edit', '<span class="glyphicon glyphicon-plus"> </span>Add an Expense'); ?>


    <table class="table table-striped" width="100%">
        <thead>
            <tr>
                <td >Title</td>
                <td >Description</td>
                <td >Starting Amount</td>
                <td >Balance</td>
                <td >Created Date </td>
                <td >Last Modified </td>
                <td>Edit</td>
                <td>Delete</td>

            </tr>
        </thead>
        <tbody>
            <?php
//            echo "<pre>";
//            print_r($accounts);
//            echo "</pre>";
            if (count($accounts)) :
                foreach ($accounts as $account):
                    ?>


                    <tr>
                        <td><?php echo anchor('admin/accounts/edit/' . $account->id, $account->title); ?> </td>
                        <td><?php echo $account->description; ?> </td>
                        <td><?php echo $account->amount; ?> </td>
                        <td><?php echo $account->balance; ?> </td>
                        <td><?php echo $account->created; ?> </td>
                        <td><?php echo $account->modified; ?> </td>
                        <td><?php echo btn_edit('admin/accounts/edit/' . $account->id) ?></td>
                        <td><?php echo btn_delete('admin/accounts/delete/' . $account->id) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"> We could not find any Account.</td>
                </tr>

            <?php endif; ?>

    </table>
</section>

<!--</div></div>-->