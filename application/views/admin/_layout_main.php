<?php $this->load->view('admin/components/page_head'); ?>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><?php echo $meta_title; ?></a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo base_url('/admin/dashboard'); ?>">Dashboard</a></li>
                <li><?php echo anchor('admin/pages', 'pages'); ?></li>
                <li><?php echo anchor('admin/users', 'users'); ?></li>
            </ul>
        </div>
    </nav>
    <?php
    if ($this->session->flashdata('success')) {
        echo $this->session->flashdata('success');
    }
    ?>
    <div class="container">
        <div class="row">
            <!--main column-->
            <div class="col-md-8">
                <section>
                    <?php $this->load->view($subview); // subview is set in Controller?>
                </section>
            </div>
            <!--            <div class="pull-left">
                            <section>
            
                            </section>
                        </div>-->
            <!--Side bar-->
            <div>
                <section class="col-md-4">
                    <?php echo mailto('m.arslan.khurshid@gmail.com', '<span class="glyphicon glyphicon-user"></span> m.arslan.khurshid@gmail.com'); ?> <br>
                    <?php echo anchor('admin/user/logout', '<span class="glyphicon glyphicon-off"></span> logout'); ?> <br>
                </section>
            </div>
        </div>


</body>
