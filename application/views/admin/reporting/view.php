<?php ?>
<h2>Sub-Categories</h2>
<?php
//print_r($cat_id)
?>
<?php echo anchor('admin/reporting/viewDetails/' . $cat_id. '/' . $date_from . '/' . $date_to. '/'. $account_id, '<span class="glyphicon glyphicon-plus"> </span>Show All'); ?>

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
    <?php
//    echo "<pre>";
//    print_r($employee_expenses);
//    echo "</pre>";
    ?>
    <div id="msgDivId">
        <h3>Employee Details</h3>
        <table id ="results-table" class="table table-striped" width="100%">
            <thead>
                <tr>
                    <td >Employee Name</td>
                    <td >Salary</td>
                    <td >Advance</td>
                    <td >Eidi</td>
                    <td >Category</td>
                </tr>
            </thead>

            <?php
            if (count($employee_expenses)):
                foreach ($employee_expenses as $key => $expense):
                    ?>
                    <?php
                    if (!empty($key)):
                        ?>

                        <tr>
                            <td><?php echo anchor('admin/reporting/viewDetails?cat_id=' . $expense['cat_id'] . "&date_from=" . $expense['date_from'] . "&date_to=" . $expense['date_to'] . "&account_id=" . $expense['account_id'] . "&employee_id=" . $key, $expense['employee_fname'] . ' ' . $expense['employee_lname']); ?> </td>
                            <td><?php echo $expense['Salary']; ?> </td>
                            <td><?php
                                if (isset($expense['Advance'])) {
                                    echo $expense['Advance'];
                                } else {
                                    echo "";
                                }
                                ?> </td>
                            <td><?php
                                if (isset($expense['Eidi'])) {
                                    echo $expense['Eidi'];
                                } else {
                                    echo "";
                                }
                                ?> </td>
                            <td><?php echo $expense['cat_name']; ?> </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>




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
                        <?php if (isset($expense->category_title) && $expense->category_title == 'Employee\'s'): ?>
                            <td><?php echo $expense->employee_fname . " " . $expense->employee_lname; ?> </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"> We could not find any report.</td>
                </tr>

            <?php endif; ?>

    </table>
</section>
<script>


//    console.info($('#results-table > tbody > tr').length);
    if ($('#results-table > tbody > tr').length == 0) {
        $('#results-table > thead > tr').css('display', 'none');
        document.getElementsByTagName('h3')[0].style.display = 'none';

    }
    console.info(document.getElementById("hid"));
</script>