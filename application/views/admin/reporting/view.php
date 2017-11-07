<?php ?>
<h2>Sub-Categories</h2>
<?php echo anchor('admin/reporting/viewDetails/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6), '<span class="glyphicon glyphicon-plus"> </span>Show All'); ?>
<section>
    <table class="table table-striped" width="100%">
        <thead>
            <tr>
                <td >Sub-Category</td>
                <td >Total Amount</td>
                <td >Currency</td>

            </tr>
        </thead>
        <tbody>
            <?php
//            echo "<pre>";
//            print_r($sub_expenses);
//            echo "</pre>";
            ?>
            <?php
            if (count($sub_expenses)):
                foreach ($sub_expenses as $key => $expense):

//                    foreach ($expense as $index => $val):
//                        foreach ($val as $ind => $v):
                    ?>
                    <?php
//                        echo "<pre>";
//                        print_r($val);
//                        echo "</pre>";
                    ?>
                    <tr>
                        <td><?php echo anchor('admin/reporting/viewDetails/' . $expense['cat_id'] . '/' . $expense['date_from'] . '/' . $expense['date_to'] . '/' . $expense['account_id'] . '/' . $expense['sub_category_id'], $expense['sub_category_title']); ?> </td>
                        <td><?php echo $expense['total']; ?> </td>
                        <td><?php echo 'Euro' ?> </td>
                    </tr>
                    <?php // endforeach; ?>
                    <?php // endforeach; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"> We could not find any report.</td>
                </tr>

            <?php endif; ?>

    </table>
</section>

<section>
    <h2><?php echo count($expenses); ?>: &nbsp;Transactions</h2>
    <?php
//    echo "<pre>";
//    print_r($_POST);
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
//            echo "<pre>";
//            print_r($expenses);
//            echo "</pre>";
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
