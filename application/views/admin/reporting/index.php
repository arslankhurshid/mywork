<?php ?>
<style>
    .f {
        float: none;
    }
    .clr {
        clear: both;
    }
    .custom_input{
        width:50px;/*use according to your need*/
        height:30px;/*use according to your need*/
    }
</style>
<!--<div class="container">-->
<!--<div class="row col-md-8">-->
<section>
    <div id="orderResult"></div>
    <h2>Reporting</h2>
    <?php
//    echo "<pre>";
//    print_r($dates);
//    echo "</pre>";
    ?>
    <?php echo form_open('', array('onsubmit' => 'return validate();')); ?>

    <div class="well carousel-search hidden-sm">

        <div id="dropdown">
            <?php echo form_dropdown('type', $accout_types, $this->input->post('type') ? $this->input->post('type') : '$account->from_bank', 'class="btn btn-default dropdown-toggle btn-select2" id="my_id1"'); ?> &nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;
            <?php echo form_dropdown('to_bank', $userAccounts, $this->input->post('to_bank') ? $this->input->post('to_bank') : '$account->to_bank', 'class="btn btn-default dropdown-toggle btn-select2" id="my_id2"'); ?>&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;
            <?php echo form_dropdown('date', $dates, $this->input->post('date') ? $this->input->post('date') : '$account->date', 'class="btn btn-default dropdown-toggle btn-select2" id="my_id3"'); ?>&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;

            <div class="clr"></div>
        </div>
        <div>
            <br>
        </div>
        <div id="buttons">
            From:
            <?php
            $data = array(
                'name' => 'date_from',
                'id' => '',
                'value' => $report->date_from,
                'style' => 'width:15%; height:8%',
                'class' => 'datepicker'
            );
            echo form_input($data);
            ?>To:
            <?php
            $data = array(
                'name' => 'date_to',
                'id' => '',
                'value' => $report->date_to,
                'style' => 'width:15%; height:8%',
                'class' => 'datepicker'
            );
            echo form_input($data);
            ?>
            <?php echo form_submit('submit', 'Apply', 'class="btn btn-primary btn-xs"'); ?>
            <?php echo form_reset('reset', 'reset', 'class="btn btn-primary btn-xs"'); ?>
            <div class="clr"></div>
        </div>
    </div>
    <br>
    <?php echo form_close(); ?>

    <?php echo form_open('admin/reporting/index') . PHP_EOL; ?>
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
                    <li value="<?php echo $account->id ?>"><a href="<?php
                        if ($_SERVER['QUERY_STRING'] != '') {
                            echo base_url('admin/reporting/index?' . $_SERVER['QUERY_STRING'] . '&account=' . $account->id);
                        } else {
                            echo base_url('admin/reporting/index?account=' . $account->id);
                        }
                        ?>"><?php echo $account->title; ?></a></li>

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
                        <li value="<?php echo $dateValues->id; ?>"><a href="<?php
                            if ($_SERVER['QUERY_STRING'] != '') {
                                echo base_url('admin/reporting/index?' . $_SERVER['QUERY_STRING'] . '&date=' . $dateValues->id);
                            } else {
                                echo base_url('admin/reporting/index?date=' . $dateValues->id);
                            }
                            ?>"><?php echo $dateValues->period ?></a></li>
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
                <td >Categories</td>
                <td >Amount</td>

            </tr>
        </thead>
        <tbody>
            <?php
//            echo "<pre>";
//            print_r($expense_month);
//            echo "</pre>";
            if (count($expense_month)):
                foreach ($expense_month as $key => $expense):
                    ?>
                    <?php
                    foreach ($expense as $value => $val):
//                        echo "<pre>";
//                        print_r($value);
//                        echo "</pre>";
//                        echo "<pre>";
//                        print_r(json_encode($data));
//                        echo "</pre>";
                        ?>

                        <tr>
                            <td><?php
                                if ($_SERVER['QUERY_STRING'] != '') {
                                    echo anchor('admin/reporting/view?cat_id=' . $key . '&' . $_SERVER['QUERY_STRING'], $value);
//                                    echo base_url('admin/reporting/index?' . $_SERVER['QUERY_STRING'] . '&account=' . $account->id);
                                } else {
                                    echo anchor('admin/reporting/view?cat_id=' . $key, $value);
                                }
                                ?> </td>
                            <td><?php echo $val; ?> </td>
                            <td><?php echo 'Euro' ?> </td>
                            <td id="category"></td>
                            <td id="amount"></td>
                            <td><?php // echo $expense->sub_category;                                                                                                                              ?> </td>
                            <td><?php // echo $expense->amount;                                                                                                                              ?> </td>
                            <td><?php // echo btn_edit('admin/expense/edit/' . $expense->id)                                                                                                                             ?></td>
                            <td><?php // echo btn_delete('admin/expense/delete/' . $expense->id)                                                                                                                             ?></td>
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
//    for (i = 1; i <= 3; i++)
//    {
//        var drop_down = document.getElementById("my_id" + i);
//         var drop_down_selected = $('#my_id'+i).find('option:selected').val();
////        var test = $('#my_id' + i).find('option:selected').val();
////        console.info(test);
//
////        console.info(drop_down.find('option:selected'));
//        drop_down.onchange = function () {
//
//            $.ajax({
//                type: "POST",
//                url: "reporting/displayReports/" + drop_down.value + "/" + drop_down_account,
////            data: {data: $(dataString).serializeArray()},
//                cache: false,
//                success: function () {
//                }
//            });
//
//        };
//
//    }
    $(window).load(function () {/*code here*/

//        for (i = 1; i <= 3; i++)
//        {
        var drop_down_type = $('#my_id1').find('option:selected').val();
        var drop_down_account = $('#my_id2').find('option:selected').val();
        var drop_down_date = $('#my_id3').find('option:selected').val();
//        console.info(dataString);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "reporting/displayReports/" + drop_down_date + "/" + drop_down_account,
            
//            data: {data: $(dataString).serializeArray()},
            cache: false,
            success: function (data) {


//                var json = JSON.parse(data);
                console.info(data);
                $('#orderResult').html(json_decode(data));
//                document.getElementById("category").innerHTML = data[0];
//                $.each(JSON.parse(data), function (key, value) {
//
//
//
//                    console.log(key + ":" + value)
//                })
//                document.getElementById("name").innerHTML = data[0];
//                document.getElementById("age").innerHTML = data[1];
//                document.getElementById("location").innerHTML = data[2];
//                $.each(JSON.parse(data), function (key, value) {
//
////                    $('#my_id2').append($('<option>').text(value).attr('value', key));
//
//                    console.log(key + ":" + value)
//                })
            }
        });

    });


//    var drop_down = document.getElementById("my_id1");

    var hiddenDiv = document.getElementById("subview_cat");
//    drop_down.onchange = function () {
//        alert('eys');

//        $.post('<?php // echo site_url('admin/expense/index/');                     ?>' + drop_down.value, {dataType: "json"}, function (data) {
//            console.info(data);
//            var $el = $("#my_id2");
//            $el.empty(); // remove old options
//            $.each(JSON.parse(data), function (key, value) {
//
//                $('#my_id2').append($('<option>').text(value).attr('value', key));
//
//                console.log(key + ":" + value)
//            })
//        });
//    };

    $(function () {

        $('.datepicker').datepicker({format: 'yyyy-mm-dd'});

    });
</script>
