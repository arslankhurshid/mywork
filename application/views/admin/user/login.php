<div class="modal-header">
    <h3>Log in</h3>
    <p>Please log in using your credentials</p>
    <div class="modal-body">
        <?php
//        echo "<pre>";
//        echo print_r($this->session->userdata, TRUE);
//        print_r($this->session);
//        echo "</pre>";
//        echo "</pre>";
//        echo "Session ID:" . session_id() . "<br>";
//        echo "Remote Address: " . $_SERVER['REMOTE_ADDR'] . "<br>";
//        echo "User Agent: " . $this->input->user_agent() . "<br>";
        ?>
        <?php
        echo validation_errors();
        echo $this->session->flashdata('success');
        if ($this->session->flashdata('errors')) {
            echo $this->session->flashdata('errors');
        }
        
        ?>
        <?php echo form_open(); ?>
        <table class="table">
            <tr>
                <td>Email:</td>
                <td><?php echo form_input('email'); ?></td>
            </tr>
            <tr>
                <td>Password:</td> 
                <td><?php echo form_password('password'); ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo form_submit('submit', 'login', 'class="btn btn-primary"'); ?></td>
            </tr>

        </table>
        <?php echo form_close(); ?>
        <?php if ($this->session->flashdata('success')) {
            echo $this->session->flashdata('success');
        }?>
    </div>
</div>
