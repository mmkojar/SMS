<?php $this->load->view('templates/header'); ?>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
        </div>
        <div class="card-body">
            <?php if(validation_errors()): ?>
                <div class="card-header">               
                    <p class="text-danger"><?php print_r(validation_errors()); ?></p>
                </div>
            <?php endif ?>
            <?php echo form_open(uri_string()); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vendor_id">Vendor Name</label>
                            <select name="vendor_id" class="form-control">
                                <?php foreach($vendors as $row): ?>
                                    <option value="<?php echo $row->id ?>" 
                                        <?php echo ($row->id == $purchase['vendor_id']) ? 'selected' : '' ?>><?php echo $row->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dsub_item_id">Sub-Item</label>
                            <select name="dsub_item_id" class="form-control" disabled>
                                <?php foreach($departs as $row): ?>
                                    <option value="<?php echo $row->id ?>" 
                                        <?php echo ($row->id == $purchase['sub_item_id']) ? 'selected' : '' ?>><?php echo $row->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="sub_item_id" value="<?php echo $purchase['sub_item_id'] ?>">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ditem_name">Item Name</label>
                            <select name="ditem_name" class="form-control" disabled>
                                <?php foreach($items as $row): ?>
                                    <option value="<?php echo $row->id ?>" 
                                        <?php echo ($row->id == $purchase['item_id']) ? 'selected' : '' ?>><?php echo $row->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
						<input type="hidden" name="item_name" value="<?php echo $purchase['item_id'] ?>">
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="size">Unit</label>
                            <select class="form-control" name="unit" id="unit">
                                <option value="GRAM" <s?php echo ($purchase['unit'] == 'GRAM') ? 'selected' : '' ?>>GRAM</option>
                                <option value="KG" <sphp echo ($purchase['unit'] == 'KG') ? 'selected' : '' ?>>KG</option>
                                <option value="LTR" <s?php echo ($purchase['unit'] == 'LTR') ? 'selected' : '' ?>>LTR</option>
                                <option value="BOX" <s?php echo ($purchase['unit'] == 'BOX') ? 'selected' : '' ?>>BOX</option>
                                <option value="PCS" <s?php echo ($purchase['unit'] == 'PCS') ? 'selected' : '' ?>>PCS</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="text" name="qty" id="qty" class="form-control" 
                            value="<?php echo isset($purchase['qty']) ? $purchase['qty'] : '' ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rate">Purchase Rate</label>
                            <input type="number" name="rate" id="rate" class="form-control" 
                            value="<?php echo isset($purchase['rate']) ? $purchase['rate'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total_amount">Total Amount</label>
                            <input type="text" name="total_amount" id="total_amount" class="form-control" 
                            value="<?php echo isset($purchase['total_amount']) ? $purchase['total_amount'] : '' ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" 
                            value="<?php echo isset($purchase['date']) ? $purchase['date'] : '' ?>" required>
                        </div>
                    </div>
                </div>
                <?php echo form_hidden($csrf); ?>                
                <button type="submit" name="submit" id="salary_submit" class="btn btn-success">Save</button>
             <?php echo form_close();?>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer') ?>


