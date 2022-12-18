<?php $this->load->view('templates/header'); ?>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
        </div>
        <div class="card-body">
            <?php echo form_open(uri_string()); ?>
                <!-- <p class="text-danger">Add Multiple with comma for eg(a,b,c)</p> -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vendor_id">Vendor Name</label>
                            <select name="vendor_id" id="vendor_id" class="form-control">
                                <option value="">Select</option>
                                <?php foreach($vendors as $row): ?>
                                    <?php $vid = isset($expense['vendor_id']) ? $expense['vendor_id'] : '' ?>
                                    <option value="<?php echo $row->id ?>" 
                                        <?php echo ($row->id == $vid) ? 'selected' : '' ?>><?php echo $row->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bill_no">Bill No</label>
                            <input type="text" name="bill_no" id="bill_no" class="form-control"  
                            value="<?php echo isset($expense['bill_no']) ? $expense['bill_no'] : '' ?>">
                            <p class="text-danger"><?php echo form_error('bill_no'); ?></p>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="item">Item</label>
                            <input type="text" name="item[]" id="item" class="form-control"  
                            value="<s?php echo isset($expense['item']) ? $expense['item'] : '' ?>">
                            <p class="text-danger"><s?php echo form_error('item'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="text" name="qty[]" id="qty" class="form-control"  
                            value="<s?php echo isset($expense['qty']) ? $expense['qty'] : '' ?>">
                            <p class="text-danger"><s?php echo form_error('qty'); ?></p>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rate">Rate</label>
                            <input type="text" name="rate" id="rate" class="form-control"  
                            value="<?php echo isset($expense['rate']) ? $expense['rate'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control"  
                            value="<?php echo isset($expense['date']) ? $expense['date'] : date('Y-m-d') ?>">
                        </div>
                    </div>
                </div>
                <?php echo form_hidden($csrf); ?>                
                <input type="hidden" id="gst_perc" name="gst_perc" value="<?php echo isset($expense['gst']) ? $expense['gst'] : '' ?>">
                <button type="submit" name="submit" class="btn btn-success">Save</button>
                <input type="hidden" name="hidden_item" value="<?php echo isset($expense['item']) ? $expense['item'] : '' ?>">
             <?php echo form_close();?>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer') ?>

<script type="text/javascript">

    $(document).ready(function() {        
        
        $("#vendor_id").on('change', ()=> {

            var vid = $("#vendor_id").val();
            if(vid) {
                $.ajax({
                    url:"<?php echo base_url('Vendors/gstapi') ?>",
                    method:"POST",
                    data:{vid:vid},
                    dataType:'json',
                    success:function(res)
                    {				
                        console.log(res);
                        $("#gst_perc").val(res.gst_per);
                    }
                })
            }
            else {
                $("#gst_perc").val(0);
            }
           
        })
    });

</script>
