<?php $this->load->view('components/page_head') ?>

<body>
    <section>
        <h1><?php echo config_item('site_name') ?></h1>
    </section>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Page 1-1</a></li>
                        <li><a href="#">Page 1-2</a></li>
                        <li><a href="#">Page 1-3</a></li>
                    </ul>
                </li>
                <li><a href="#">Page 2</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        <div class="row">
            <!--Main content-->
            <div class="col-md-8">
                <h2>Main Content</h2>
            </div>
            <!--Side bar-->
            <div class="col-md-4">
                <h2>News Article</h2>
            </div>
        </div>
    </div>

</body>

<?php $this->load->view('components/page_tail') ?>