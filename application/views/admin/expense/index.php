<!--<div class="container">-->
<!--<div class="row col-md-8">-->
<section>
    <h2>Expenses</h2>
    <?php echo anchor('admin/expense/edit', '<span class="glyphicon glyphicon-plus"> </span>Add an Expense'); ?>


    <table class="table table-striped" width="100%">
        <thead>
            <tr>
                <td >Title</td>
                <td >Date</td>
                <td >Category</td>
                <td >Sub-Category</td>
                <td >Amount</td>
                <td>Edit</td>
                <td>Delete</td>

            </tr>
        </thead>
        <tbody>
            <?php
//            echo "<pre>";
//            print_r($expenses);
//            echo "</pre>";
            if (count($expenses)) :
                foreach ($expenses as $expense):
                    ?>


                    <tr>
                        <td><?php echo anchor('admin/expense/edit/' . $expense->id, $expense->title); ?> </td>
                        <td><?php echo $expense->date; ?> </td>
                        <td><?php echo $expense->category_title; ?> </td>
                        <td><?php echo $expense->sub_category; ?> </td>
                        <td><?php echo $expense->amount; ?> </td>
                        <td><?php echo btn_edit('admin/expense/edit/' . $expense->id) ?></td>
                        <td><?php echo btn_delete('admin/expense/delete/' . $expense->id) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"> We could not find any expense.</td>
                </tr>

            <?php endif; ?>

    </table>
</section>

<!--</div></div>-->