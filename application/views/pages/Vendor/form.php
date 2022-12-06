<?php $this->load->view('templates/header'); ?>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
        </div>
        <div class="card-body">
            <?php echo form_open(uri_string()); ?>
                <div class="row">                 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"  
                            value="<?php echo isset($vendor['name']) ? $vendor['name'] : '' ?>">
                            <p class="text-danger"><?php echo form_error('name'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Contact No.</label>
                            <input type="text" name="phone" id="phone" class="form-control" 
                            value="<?php echo isset($vendor['phone']) ? $vendor['phone'] : '' ?>">
                            <p class="text-danger"><?php echo form_error('phone'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="address" rows="5"><?php echo isset($vendor['address']) ? $vendor['address'] : '' ?></textarea>
                            <p class="text-danger"><?php echo form_error('address'); ?></p>
                        </div>
                    </div>
                </div>
                <?php echo form_hidden($csrf); ?>                
                <button type="submit" name="submit" id="salary_submit" class="btn btn-success">Save</button>
                <input type="hidden" name="hidden_item" value="<?php echo isset($vendor['name']) ? $vendor['name'] : '' ?>">
             <?php echo form_close();?>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer') ?>