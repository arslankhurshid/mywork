<section>
    <div id="orderResult"></div>
    <h2>Reporting</h2>
    <?php
//    echo "<pre>";
//    print_r($userAccounts);
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
                'value' => $this->input->post('date_from') ? $this->input->post('date_from') : $report->date_from,
                'style' => 'width:15%; height:8%',
                'class' => 'datepicker'
            );
            echo form_input($data);
            ?>To:
            <?php
            $data = array(
                'name' => 'date_to',
                'id' => '',
                'value' => $this->input->post('date_to') ? $this->input->post('date_to') : $report->date_to,
                'style' => 'width:15%; height:8%',
                'class' => 'datepicker'
            );
            echo form_input($data);
            ?>
            <?php
            echo form_button('button', 'Apply', 'class="btn btn-primary btn-xs" onClick="some_function()"');
            ?>
            <?php echo form_reset('reset', 'reset', 'class="btn btn-primary btn-xs"'); ?>
            <div class="clr"></div>
        </div>
    </div>
    <br>
    <?php echo form_close(); ?>


    <table class="table table-striped" width="100%" id="table">
        <thead>
            <tr>
                <td >Categories</td>
                <td >Total Amount</td>
                <td >Currency</td>

            </tr>
        </thead>
        <tbody id="grid">

        </tbody>

    </table>
</section>

<script>
    function some_function()
    {
        var str = $("form").serialize();
        var date_from = document.getElementsByName("date_from")[0].value;
        var to_bank = document.getElementsByName("to_bank")[0].value;
        var date_to = document.getElementsByName("date_to")[0].value;
//        console.info(date_from);
        $.ajax({
            type: "POST",
            url: "reporting/displayReports/",
            data: str,
            dataType: "json",
            success: function (data) {
//                console.info(data);
                if (Object.keys(data).length === 0)
                {
                    $("#grid").empty();
                    var tr;
                    tr = $('<tr/>');
                    tr.append("<td>" + "No Record Found" + "</td>");
                    $('table').append(tr);
                } else {
                    $("#grid").empty();
                    $.each(data, function (key, value) {
//                        $.each(value, function (k, val) {
                        var tr;

                        tr = $('<tr/>');
                        tr.append("<td>" + value.category_title.link("reporting/viewDetails/" + value.cat_id + "/" + Date.parse(value.date_from) / 1000 + "/" + Date.parse(value.date_to) / 1000 + "/" + value.account_id) + "</td>");
                        tr.append("<td>" + value.total + "</td>");
                        tr.append("<td>" + "Euro" + "</td>");
                        $('table').append(tr);

//                        });

                    });
                }

            }
        });
    }


    for (i = 1; i <= 3; i++)
    {
        var drop_down = document.getElementById("my_id" + i);
        drop_down.onchange = function () {
            var drop_down_type = $('#my_id1').find('option:selected').val();
            var drop_down_account = $('#my_id2').find('option:selected').val();
            var drop_down_date = $('#my_id3').find('option:selected').val();
//            console.info(drop_down_date);

            $.ajax({
                type: "POST",
                url: "reporting/displayReports/" + drop_down_date + "/" + drop_down_account,
                dataType: "json",
                cache: false,
                success: function (data) {
                    if (Object.keys(data).length === 0)
                    {

                        $("#grid").empty();
                        var tr;

                        tr = $('<tr/>');
                        tr.append("<td>" + "No Record Found" + "</td>");
                        $('table').append(tr);
                    } else {
//                        console.info(data);
                        $("#grid").empty();
                        $.each(data, function (key, value) {
//                            $.each(value, function (k, val) {
                            var tr;

                            tr = $('<tr/>');
                            tr.append("<td>" + value.category_title.link("reporting/viewDetails/" + value.cat_id + "/" + Date.parse(value.date_from) / 1000 + "/" + Date.parse(value.date_to) / 1000 + "/" + value.account_id) + "</td>");
                            tr.append("<td>" + value.total + "</td>");
                            tr.append("<td>" + "Euro" + "</td>");
                            $('table').append(tr);

//                            });

                        });
                    }

                }
            });

        };

    }
    $(window).load(function () {/*code here*/

        var drop_down_type = $('#my_id1').find('option:selected').val();
        var drop_down_account = $('#my_id2').find('option:selected').val();
        var drop_down_date = $('#my_id3').find('option:selected').val();

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "reporting/displayReports/" + drop_down_date + "/" + drop_down_account,
//            data: {data: $(dataString).serializeArray()},
            cache: false,
            success: function (data) {
//                console.info(data);
//                console.info(url);
                $("#grid").empty();
                $.each(data, function (key, value) {
//                    console.info(value.category_title);
//                    $.each(value, function (k, val) {

                    var tr;
                    tr = $('<tr/>');
                    tr.append("<td>" + value.category_title.link("reporting/viewDetails/" + value.cat_id + "/" + Date.parse(value.date_from) / 1000 + "/" + Date.parse(value.date_to) / 1000 + "/" + value.account_id) + "</td>");
                    tr.append("<td>" + value.total + "</td>");
                    tr.append("<td>" + "Euro" + "</td>");

                    $('table').append(tr);

//                    });


                });

            },
            error: function (e) {
//                console.info(e));
            },
        });

    });


    $(function () {

        $('.datepicker').datepicker({format: 'yyyy-mm-dd'});

    });
</script>
