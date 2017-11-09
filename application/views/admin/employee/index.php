<!--<div class="container">-->
<!--<div class="row col-md-8">-->
<section>
    <h2>Employee's</h2>
    <p style="text-align:left;">
        <?php echo anchor('admin/employee/edit', '<span class="glyphicon glyphicon-plus"> </span>Add an Employee'); ?>
    </p>

    <table class="table table-striped" width="100%">
        <thead>
            <tr>
                <td >First Name</td>
                <td >Last Name</td>
                <td >Department</td>
                <td >Created Date </td>
                <td>Edit</td>
                <td>Delete</td>

            </tr>
        </thead>
        <tbody>
            <?php
//            echo "<pre>";
//            print_r($employees);
//            echo "</pre>";
            if (count($employees)) :
                foreach ($employees as $employee):
                    ?>


                    <tr>
                        <td><?php echo anchor('admin/employee/edit/' . $employee->id, $employee->fname); ?> </td>
                        <td><?php echo $employee->lname; ?> </td>
                        <td><?php echo $employee->dep; ?> </td>
                        <td><?php echo $employee->created; ?> </td>
                        <td><?php echo btn_edit('admin/employee/edit/' . $employee->id) ?></td>
                        <td><?php echo btn_delete('admin/employee/delete/' . $employee->id) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"> We could not find any Employee.</td>
                </tr>

            <?php endif; ?>

    </table>
</section>

<!--</div></div>-->