<div class="modal-header">
    <h3><?php 
    echo "<pre>";
    print_r($user);
    echo "</pre>";
    echo empty($user->id) ? 'Add a new user' : 'Edit' ?></h3>
    <p>Please log in using your credentials</p>
    <div class="modal-body">
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
