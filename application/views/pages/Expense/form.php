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
                            <label for="bill_no">Bill No</label>
                            <input type="text" name="bill_no" id="bill_no" class="form-control"  
                            value="<?php echo isset($expense['bill_no']) ? $expense['bill_no'] : '' ?>">
                            <p class="text-danger"><?php echo form_error('bill_no'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="item">Item</label>
                            <input type="text" name="item" id="item" class="form-control"  
                            value="<?php echo isset($expense['item']) ? $expense['item'] : '' ?>">
                            <p class="text-danger"><?php echo form_error('item'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="text" name="qty" id="qty" class="form-control"  
                            value="<?php echo isset($expense['qty']) ? $expense['qty'] : '' ?>">
                            <p class="text-danger"><?php echo form_error('qty'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rate">Rate</label>
                            <input type="number" name="rate" id="rate" class="form-control"  
                            value="<?php echo isset($expense['rate']) ? $expense['rate'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control"  
                            value="<?php echo isset($expense['date']) ? $expense['date'] : '' ?>">
                        </div>
                    </div>
                </div>
                <?php echo form_hidden($csrf); ?>                
                <button type="submit" name="submit" class="btn btn-success">Save</button>
                <input type="hidden" name="hidden_item" value="<?php echo isset($expense['item']) ? $expense['item'] : '' ?>">
             <?php echo form_close();?>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer') ?>