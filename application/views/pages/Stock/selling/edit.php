<?php $this->load->view('templates/header',$pagename); ?>

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
                            <label for="po_no">PO.NO</label>
                            <input type="text" name="po_no" id="po_no" class="form-control" 
                            value="<?php echo isset($purchase['po_no']) ? $purchase['po_no'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vendor_id">Vendor Name</label>
                            <select name="vendor_id" id="vendor_id" class="form-control">
                                <?php foreach($vendors as $row): ?>
                                    <option value="<?php echo $row->id ?>"
                                        <?php echo ($row->id == $selling['vendor_id']) ? 'selected' : '' ?>><?php echo $row->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="item_id">Item Name</label>
                            <select name="item_id" class="form-control item_id">
                                <?php foreach($items as $row): ?>
                                    <option value="<?php echo $row->id ?>" 
                                        <?php echo ($row->id == $selling['item_id']) ? 'selected' : '' ?>><?php echo $row->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
						<!-- <input type="hidden" name="item_id" value="<s?php echo $selling['item_id'] ?>"> -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sub_item_id">Sub-Item</label>
                            <select name="sub_item_id" id="sub_item_id" class="form-control">
                                <?php if($selling['sub_item_id'] !== '0'): ?>
                                <?php foreach($departs as $row): ?>
                                    <option value="<?php echo $row->id ?>" 
                                        <?php echo ($row->id == $selling['sub_item_id']) ? 'selected' : '' ?>><?php echo $row->name; ?>
                                    </option>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="0">No Data Dound</option>
                                <?php endif ?>
                            </select>
                        </div>
                        <!-- <input type="hidden" name="sub_item_id" value="<s?php echo $selling['sub_item_id'] ?>"> -->
                    </div>                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="number" name="qty" id="qty" class="form-control" 
                            value="<?php echo isset($selling['qty']) ? $selling['qty'] : '' ?>" required>
                            <!-- <input type="hidden" name="tot_qty" value="<s?php echo $totqty ?>"> -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rate">Selling Rate</label>
                            <input type="number" name="rate" id="rate" class="form-control" 
                            value="<?php echo isset($selling['rate']) ? $selling['rate'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" 
                            value="<?php echo isset($selling['date']) ? $selling['date'] : '' ?>" required>
                        </div>
                    </div>
                </div>
                <?php echo form_hidden($csrf); ?>
                <input type="hidden" id="gst_perc" name="gst_perc" value="<?php echo isset($selling['gst']) ? $selling['gst'] : '' ?>">
                <input type="hidden" name="total_qty" value="<?php echo isset($selling['tqty']) ? $selling['tqty'] : '' ?>">
                <button type="submit" name="submit" id="salary_submit" class="btn btn-success">Save</button>
             <?php echo form_close();?>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer') ?>

<script>
    $(document).ready(function() {
        $(document).on('change', '.item_id', function(){
            			
			var dropdownvalue = $(this).val();        
            
            $.ajax({
				url:"<?php echo base_url('Stock/purchase/getSubItemOnChange') ?>/"+dropdownvalue,
                method:"GET",
                dataType:'json',
                success:function(res)
                {         
                    var html = '';
                    if(res.length > 0) {
                        for(var i in res) {
                            html += `<option value="${res[i].id}">${res[i].name}</option>`;
                        }
                    }
                    else {
                        html += '<option value="0">No Data Dound</option>';
                    }
                    $('#sub_item_id').html(html);
                }
            })
        });

        $("#vendor_id").on('change', ()=> {

            var vid = $("#vendor_id").val();
            $.ajax({
                url:"<?php echo base_url('Vendors/gstapi') ?>",
                method:"POST",
                data:{vid:vid},
                dataType:'json',
                success:function(res)
                {
                    $("#gst_perc").val(res.gst_per);
                }
            })
        })

    })
</script>