 <?php $this->load->view('templates/header'); ?>

 <style type="text/css">
.error {
    color: red;
}
</style>
      <div class="col-12">
          <div class="card">
          <?php $this->load->view('templates/header_title'); ?>
              <div class="card-body">
                  <?php echo form_open(uri_string());?>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <?php echo lang('edit_user_fname_label', 'first_name');?>
                          <?php echo form_input($first_name);?>
													<?php echo form_error('first_name','<p class="error">', '</p>'); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <?php echo lang('edit_user_lname_label', 'last_name');?> 
                          <?php echo form_input($last_name);?>
                        </div>  
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <?php echo lang('edit_user_phone_label', 'phone');?> 
                          <?php echo form_input($phone);?>
													<?php echo form_error('phone','<p class="error">', '</p>'); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <?php echo lang('edit_user_email_label', 'email');?> 
                          <?php echo form_input($email);?> 
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <?php echo lang('edit_user_password_label', 'password');?>
                          <?php echo form_input($password);?>
                          <!-- <?php //echo form_error($password); ?> -->
                        </div>
                      </div>
                      <div class="col-md-6">
                      <div class="form-group"> 
                        <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?>
                        <?php echo form_input($password_confirm);?>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <?php echo form_hidden('id', $user->id);?>
                      <?php echo form_hidden($csrf); ?>
                      <button type="submit" name="submit" class="btn btn-success">Update</button>
                    </div>                                                   
                  <?php echo form_close();?> 
              </div>
          </div>
      </div>
 
 <?php $this->load->view('templates/footer') ?> 
