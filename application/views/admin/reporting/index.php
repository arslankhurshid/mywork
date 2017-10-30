<?php ?>
<style>
    .custom_input{
        width:50px;/*use according to your need*/
        height:30px;/*use according to your need*/
    }
</style>
<!--<div class="container">-->
<!--<div class="row col-md-8">-->
<section>
    <h2>Reporting</h2>
    <?php
//    echo "<pre>";
//    print_r($defaultValues);
//    echo "</pre>";
    ?>

    <?php echo form_open('admin/reporting/search') . PHP_EOL; ?>
    <div class="well carousel-search hidden-sm">
        <div class="btn-group"> <a class="btn btn-default dropdown-toggle btn-select" data-toggle="dropdown" href="">Select Type <span class="caret"></span></a>

            <ul class="dropdown-menu">
                <?php foreach ($defaultValues as $value): ?>
                    <?php if ($value->type !== ''): ?>
                        <li value="<?php echo $value->id ?>"><a href="#"><?php echo $value->type; ?></a></li>
                    <?php endif; ?>       
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="btn-group"> <a class="btn btn-default dropdown-toggle btn-select2" data-toggle="dropdown" href="#">Select an Account <span class="caret"></span></a>

            <ul class="dropdown-menu">
                <?php foreach ($accounts as $account): ?>
                    <li value="<?php echo $account->id ?>"><a href="#"><?php echo $account->title; ?></a></li>

                <?php endforeach; ?>
                <li class="divider"></li>
                <li><a href="#">Other</a>
                </li>
            </ul>
        </div>
        <div class="btn-group"> <a class="btn btn-default dropdown-toggle btn-select" data-toggle="dropdown" href="#">Date<span class="caret"></span></a>

            <ul class="dropdown-menu">
                <?php foreach ($defaultValues as $dateValues): ?>
                    <?php if ($dateValues->period != ''): ?>
                <li value="<?php echo $dateValues->id; ?>"><a href="<?php echo base_url('admin/reporting/selected_date/'. $dateValues->id)?>"><?php echo $dateValues->period ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>

                <li class="divider"></li>
                <table>
                    <span>
                        <tr>
                            <td>From:</td>
                            <td><?php
                                $data = array(
                                    'name' => 'date_from',
                                    'id' => '',
                                    'value' => $report->date_from,
                                    'style' => 'width:90%',
                                    'class' => 'datepicker'
                                );
                                echo form_input($data);
                                ?></td>
                        </tr>
                        <tr>
                            <td>To:</td>
                            <td><?php
                                $data = array(
                                    'name' => 'date_to',
                                    'id' => '',
                                    'value' => $report->date_to,
                                    'style' => 'width:90%',
                                    'class' => 'datepicker'
                                );
                                echo form_input($data);
                                ?></td>
                        </tr>
                    </span>
                </table>
                <li class="divider"></li>
                <div class="btn-group">

                    <p style="text-align:left;">
                        <?php echo form_submit('submit', 'Apply', 'class="btn btn-primary btn-xs"'); ?>&nbsp;
                        <span style="float:right;"><?php echo form_reset('reset', 'reset', 'class="btn btn-primary btn-xs"'); ?></span>
                    </p>

                </div>
            </ul>
        </div>

    </div>

    <?php echo form_close() . PHP_EOL; ?>


    <table class="table table-striped" width="100%">
        <thead>
            <tr>
                <td >Categories</td>
                <td >Total Amount</td>
                <td >Currency</td>

            </tr>
        </thead>
        <tbody>
            <?php
//            exit();
            if (count($expense_month)):
                foreach ($expense_month as $key => $expense):
                    ?>
                    <?php
                    foreach ($expense as $value => $val):
//                        echo "<pre>";
//                        print_r($value);
//                        echo "</pre>";
                        ?>

                        <tr>
                            <td><?php echo anchor('admin/reporting/view/' . $key, $value); ?> </td>
                            <td><?php echo $val; ?> </td>
                            <td><?php echo 'Euro' ?> </td>
                            <td><?php // echo $expense->sub_category;                                                                     ?> </td>
                            <td><?php // echo $expense->amount;                                                                     ?> </td>
                            <td><?php // echo btn_edit('admin/expense/edit/' . $expense->id)                                                                     ?></td>
                            <td><?php // echo btn_delete('admin/expense/delete/' . $expense->id)                                                                     ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"> We could not find any report.</td>
                </tr>

            <?php endif; ?>

    </table>
</section>

<!--</div></div>-->
<script>
    $(".dropdown-menu li a").click(function () {
        var selText = $(this).text();
        $(this).parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
    });

    $(function () {

        $('.datepicker').datepicker({format: 'yyyy-mm-dd'});

    });
</script>
