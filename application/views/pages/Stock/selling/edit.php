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
                            <label for="item_name">Item Name</label>
                            <select name="item_id" class="form-control">
                                <option value="<?php echo $selling['item_id'] ?>"><?php echo isset($selling['item_name']) ? $selling['item_name'] : '' ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dpt_id">Department</label>
                            <select name="dpt_id" class="form-control">
                                <?php foreach($departs as $row): ?>
                                    <option value="<?php echo $row->id ?>" 
                                        <?php echo ($row->id == $selling['dpt_id']) ? 'selected' : '' ?>><?php echo $row->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <select class="form-control" name="unit" id="unit">
                                <option value="GRAM" <?php echo ($selling['unit'] == 'GRAM') ? 'selected' : '' ?>>GRAM</option>
                                <option value="KG" <?php echo ($selling['unit'] == 'KG') ? 'selected' : '' ?>>KG</option>
                                <option value="LTR" <?php echo ($selling['unit'] == 'LTR') ? 'selected' : '' ?>>LTR</option>
                                <option value="BOX" <?php echo ($selling['unit'] == 'BOX') ? 'selected' : '' ?>>BOX</option>
                                <option value="PCS" <?php echo ($selling['unit'] == 'PCS') ? 'selected' : '' ?>>PCS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="number" name="qty" id="qty" class="form-control" 
                            value="<?php echo isset($selling['qty']) ? $selling['qty'] : '' ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rate">Selling Rate</label>
                            <input type="number" name="rate" id="rate" class="form-control" 
                            value="<?php echo isset($selling['rate']) ? $selling['rate'] : '' ?>" required>
                        </div>
                    </div>

                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="outlet">Outlet</label>
                            <select class="form-control" name="outlet" id="outlet">
                                <option value="Naaz Kamani" <?php //echo ($selling['outlet'] == 'Naaz Kamani') ? 'selected' : '' ?>>Naaz Kamani</option>
                                <option value="Naaz Jarimari" <?php //echo ($selling['outlet'] == 'Naaz Jarimari') ? 'selected' : '' ?>>Naaz Jarimari</option>
                                <option value="Parel" <?php //echo ($selling['outlet'] == 'Parel') ? 'selected' : '' ?>>Parel</option>
                                <option value="Patel" <?php //echo ($selling['outlet'] == 'Patel') ? 'selected' : '' ?>>Patel</option>
                                <option value="Metro" <?php //echo ($selling['outlet'] == 'Metro') ? 'selected' : '' ?>>Metro</option>
                                <option value="Naaz Executive" <?php //echo ($selling['outlet'] == 'Naaz Executive') ? 'selected' : '' ?>>Naaz Executive</option>
                                <option value="Other" <?php //echo ($selling['outlet'] == 'Other') ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                    </div> -->

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" 
                            value="<?php echo isset($selling['date']) ? $selling['date'] : '' ?>" required>
                        </div>
                    </div>
                </div>
                <?php echo form_hidden($csrf); ?>
                <input type="hidden" name="total_qty" value="<?php echo isset($selling['tqty']) ? $selling['tqty'] : '' ?>">
                <button type="submit" name="submit" id="salary_submit" class="btn btn-success">Save</button>
             <?php echo form_close();?>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer') ?>

