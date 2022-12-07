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
                            <label for="name">Item Name</label>
                            <select name="item_id" class="form-control">
                                <option value="">Select Item</option>
                                <?php foreach($items as $item) : ?>
                                    <?php isset($department['item_id']) ? ($selected = ($department['item_id'] == $item->id) ? 'selected' : '') : $selected = set_select('item_id',(isset($department['id']) ? $department['id'] : $item->id )) ; ?>
                                    <option value="<?php echo $item->id ?>"  <?php echo $selected ?>><?php echo $item->name ?></option>
                                <?php endforeach ?>
                            </select>                            
                            <p class="text-danger"><?php echo form_error('item_id'); ?></p>
                        </div>
                    </div>               
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"  
                            value="<?php echo isset($department['name']) ? $department['name'] : set_value('name') ?>">
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