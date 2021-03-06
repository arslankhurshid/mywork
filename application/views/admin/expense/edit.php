<h3><?php echo empty($expense->id) ? 'Add a new expense' : 'Edit Page:' . '&nbsp' . $expense->title ?></h3>

<?php if (!empty(validation_errors())): ?>
    <div class="alert alert-danger" id="errordiv">
        <?php echo validation_errors() ?>
    </div>
<?php endif; ?>
<?php
//echo "<pre>";
//print_r($employee_expenses);
//echo "</pre>";
?>

<?php echo form_open(); ?>
<table class="table">
    <tr>
        <td>Select Account:</td>
        <td><?php echo form_dropdown('account_id', $accounts, $this->input->post('account_id') ? $this->input->post('account_id') : $expense->account_id, 'class="btn btn-default dropdown-toggle btn-select2" id="account"'); ?></td>
    </tr>
    <tr>
        <td>Parent Category:</td>
        <td><?php echo form_dropdown('cat_id', $categories, $this->input->post('category_id') ? $this->input->post('category_id') : $expense->category_id, 'class="btn btn-default dropdown-toggle btn-select2" id="my_id"'); ?></td>
    </tr>
    <tr>
        <td>Sub-Category:</td>
        <td><?php echo form_dropdown('sub_cat_id', $sub_categories, $this->input->post('sub_category_id') ? $this->input->post('sub_category_id') : $expense->sub_category_id, 'class="btn btn-default dropdown-toggle btn-select2" id="my_id2"'); ?></td>
    </tr>
    <tr id="subview_cat">
        <?php $this->load->view($subview_cat); // subview is set in Controller  ?>
    </tr>
    <tr>
        <td>Employees:</td>
        <td><?php echo form_dropdown('employee_id', $employees, $this->input->post('employee_id') ? $this->input->post('employees') : $expense->employee_id, 'class="btn btn-default dropdown-toggle btn-select2" id="my_id2"'); ?></td>
    </tr>
    <tr>
        <td>Date:</td>
        <td><?php echo form_input('date', set_value('date', $expense->date), 'class="datepicker"'); ?></td>
    </tr>
    <tr>
        <td>Description:</td>
        <td><?php echo form_input('title', set_value('title', $expense->title)); ?></td>
    </tr>
    <tr>
        <td>Amount:</td>
        <td><?php echo form_input('amount', set_value('amount', $expense->amount)); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>

</table>
<?php echo form_close(); ?>

<script>
    $(function () {

        $('.datepicker').datepicker({format: 'yyyy-mm-dd'});

    });

    var drop_down = document.getElementById("my_id");
    var hiddenDiv = document.getElementById("subview_cat");
    drop_down.onchange = function () {
        if (this.value == 0) {
            hiddenDiv.style.display = "";
        } else {
            hiddenDiv.style.display = "none";
        }

        $.post('<?php echo site_url('admin/expense/updateDropDownField/'); ?>' + drop_down.value, {dataType: "json"}, function (data) {
            console.info(data);
            var $el = $("#my_id2");
            $el.empty(); // remove old options
            $.each(JSON.parse(data), function (key, value) {

                $('#my_id2').append($('<option>').text(value).attr('value', key));

                console.log(key + ":" + value)
            })
        });
    };

    $(window).load(function () {/*code here*/


        if (document.getElementById("my_id").value != 0) {
            hiddenDiv.style.display = "none";
        } else {
            hiddenDiv.style.display = "";
        }
    });
</script>
