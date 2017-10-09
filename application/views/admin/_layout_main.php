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
    <div class="container">
        <div class="row">
            <!--main column-->
            <div class="pull-left">
                <section>
                    <h2>Page Name</h2>
                </section>
            </div>
            <!--Side bar-->
            <div class="pull-right">
                <section>
                    <?php echo mailto('m.arslan.khurshid@gmail.com', '<span class="glyphicon glyphicon-user"></span> m.arslan.khurshid@gmail.com'); ?> <br>
                    <?php echo anchor('admin/users/logout', '<span class="glyphicon glyphicon-off"></span> logout'); ?> <br>
                </section>
            </div>
        </div>


</body>
