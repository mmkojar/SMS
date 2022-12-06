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
                            value="<?php echo isset($department['name']) ? $department['name'] : '' ?>">
                            <p class="text-danger"><?php echo form_error('name'); ?></p>
                        </div>
                    </div>
                </div>
                <?php echo form_hidden($csrf); ?>                
                <button type="submit" name="submit" id="salary_submit" class="btn btn-success">Save</button>
                <input type="hidden" name="hidden_item" value="<?php echo isset($department['name']) ? $department['name'] : '' ?>">
             <?php echo form_close();?>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer') ?>