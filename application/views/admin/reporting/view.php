<?php ?>

<section>
    <h2><?php echo count($expenses); ?>: &nbsp;Transactions</h2>
    <?php
//    echo "<pre>";
//    print_r($defaultValues);
//    echo "</pre>";
    ?>

    <table class="table table-striped" width="100%">
        <thead>
            <tr>
                <td >Date</td>
                <td >Expense Detail</td>
                <td >Total Amount</td>
                <td >Currency</td>
                <td >Category</td>
                <td >Sub-Category</td>

            </tr>
        </thead>
        <tbody>
            <?php
            if (count($expenses)):
                foreach ($expenses as $expense):
                    ?>
                    <tr>
                        <td><?php echo $expense->date; ?> </td>
                        <td><?php echo anchor('admin/expense/edit/' . $expense->id, $expense->title); ?> </td>
                        <td><?php echo $expense->amount; ?> </td>
                        <td><?php echo 'Euro' ?> </td>
                        <td><?php echo $expense->category_title; ?> </td>
                        <td><?php echo $expense->sub_category; ?> </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"> We could not find any report.</td>
                </tr>

            <?php endif; ?>

    </table>
</section>
