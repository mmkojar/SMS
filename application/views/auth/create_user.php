<?php $this->load->view('templates/header'); ?>

<style type="text/css">
.error {
    color: red;
}
</style>

<div class="col-12">
    <?php if($message != ""): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $message;?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
        </div>
        <div class="card-body">
            <?php echo form_open("auth/create_user");?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <?php echo form_input($first_name);?>
                        <?php echo form_error('first_name','<p class="error">', '</p>'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="father_name">Last Name</label>
                        <?php echo form_input($last_name);?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_name">Company Name</label>
                        <?php echo form_input($company);?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <?php echo form_input($phone);?>
                        <?php echo form_error('phone','<p class="error">', '</p>'); ?>
                    </div>
                    <div class="form-group">
                        <?php
                            if($identity_column!=='email') {
                                echo '<p>';
                                echo lang('create_user_identity_label', 'identity');
                                echo '<br />';
                                echo form_error('identity');
                                echo form_input($identity);
                                echo '</p>';
                            }
                            ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <?php echo form_input($email);?>
                        <?php echo form_error('email','<p class="error">', '</p>'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <?php echo form_input($password);?>
                        <?php echo form_error('password','<p class="error">', '</p>'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirm">Confirm Password</label>
                        <?php echo form_input($password_confirm);?>
                        <?php echo form_error('password','<p class="error">', '</p>'); ?>
                    </div>
                </div>
            </div>
            <?php echo form_hidden($csrf); ?>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
            <?php echo form_close();?>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer') ?>
