<?php $this->load->view('templates/header',$pagename); ?>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
        </div>
        <div class="card-body">
            <form action="" method="POST" id="saveForm">
                <div class="row">
                    <div class="col-md-12">
						<span id="errors"></span>
					</div>
                    <div class="col-md-12">                
                        <div class="table-responsive">
                            <table id="multi_form" class="table table-striped table-bordered table-responsive-md" cellspacing="0" width="100%">
                                <thead>
                                    <tr>    
                                        <th>PO.NO</th>
                                        <th>Vendor Name</th>
                                        <th>Item</th>
                                        <th>Sub-Item</th>
                                        <th>Qty</th>
                                        <th>Purchase Rate</th>
                                        <th>Date</th>
                                        <th width="50px" id="remove_rows">
                                            <div class="add_row text-center"><i class="btn btn-sm btn-info mdi mdi-plus-circle"></i></div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="append_rows">
                                </tbody>
                            </table>     
                        </div>
                    </div>
                </div>
                <?php echo form_hidden($csrf); ?>
                <button type="submit" name="submit" id="saveBtn" class="btn btn-success">Save</button>        
            <?php echo form_close();?>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer') ?>

<script type="text/javascript">

    $(document).ready(function() {
        var count = 0;
        function addPurchaseRows() {
            count += 1;
            var html = '';
            html += '<tr>';
            html += '<td><input type="text" id="po_no_' + count + '" data-sub_item='+count+' name="po_no[]" class="form-control po_no" placeholder=""/></td>';
            html += '<td><select class="form-control vendor_id select2" data-sub_item='+count+' name="vendor_id[]" id="vendor_id_' + count + '"><option value="" selected>--select--</option><?php print_r($vendors) ?></select></td>';
            html += '<td><select class="form-control item_id select2" data-sub_item='+count+' name="item_id[]" id="item_id_' + count + '"><option value="" selected>--select--</option><?php print_r($items) ?></select></td>';
            html += '<td><select class="form-control sub_item_id select2" data-sub_item='+count+' name="sub_item_id[]" id="sub_item_id_' + count + '"></select></td>';
            html += '<td><input type="number" min="1" id="qty_' + count + '" data-sub_item='+count+' name="qty[]" class="form-control qty" placeholder=""/>';
            // html += '<td><select class="form-control unit" data-sub_item='+count+' name="unit[]" id="unit_' + count + '"><option value="">Select</option><option value="GRAM">GRAM</option><option value="KG">KG</option><option value="LTR">LTR</option><option value="BOX">BOX</option><option value="PCS">PCS</option></select></td>';
            html += '<td><input type="number" min="1" id="rate_' + count + '" data-sub_item='+count+' name="rate[]" class="form-control rate" placeholder=""/>';
            // html += '<td><input type="number" min="0" id="selling_rate_' + count + '" data-sub_item='+count+' name="selling_rate[]" class="form-control selling_rate" placeholder=""/>';
            html += '<td><input type="date" id="date_' + count + '" name="date[]" data-sub_item='+count+' class="form-control date" placeholder=""/>';
            html += '<td><div class="delete_row text-center"><i class="btn btn-sm btn-danger mdi mdi-minus-circle"></i></div></td></tr>';
            $('#append_rows').append(html);
        }

        addPurchaseRows();

        $(".select2").select2();

        $(document).on('click', '.add_row', function(e){ 
		
            addPurchaseRows();
            if($("#append_rows").find('tr').length == 0){
                $("#saveBtn").hide();
                
            }
            else{
                $("#saveBtn").show();
            }
            $(".select2").select2();
        });

        $(document).on('click', '.delete_row', function(){
            $(this).closest('tr').remove();
            if($("#append_rows").find('tr').length == 0){
                $("#saveBtn").hide();
                count = 0;
            }
            else{
                $("#saveBtn").show();
            } 
        });

        $(document).on('change', '.item_id', function(){
            var sub_item = $(this).data('sub_item');
			
			var dropdownvalue = $(this).val();
			/* $(".item_id").not(this).find('option[value="' + dropdownvalue + '"]').remove();*/
            
            var today = new Date();
            document.querySelector("#date_"+sub_item).value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2); 
            
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
                    $('#sub_item_id_'+sub_item).html(html);
                }
            })
        });
		
        
        $("#saveBtn").on('click', (e) => {

            e.preventDefault();
            var errors = '';
            $('.vendor_id,.item_id,.qty,.rate,.date').each(function(){
                var sub_item = $(this).data('sub_item');
                if($(this).val() == '')
                {
                    errors += 'Fill All Values at row '+sub_item+'<br/>';              
                    return false;
                }
                else {
                    errors +='';
                    return true;
                }
            });
            $('.qty').each(function() {
                var sub_item = $(this).data('sub_item');
                var inputVal = $(this).val();
				if(inputVal !== ''){
					if(Number(inputVal) == 0) {
						errors += 'Quantity should be greater than 0 at row '+sub_item;
						return false;
					}
					else {
						errors +='';
						return true;
					}
				}
            });
            if(errors == '') {
                $.ajax({
                    url:'<?php echo base_url('purchase/insert'); ?>',
                    method:'POST',
                    data: $("#saveForm").serialize(),
                    beforeSend:function() {
                        $("#saveBtn").text('Loading...');
                        $("#saveBtn").attr('disabled',true);
                    },
                    success:function(res) {
                        var res = JSON.parse(res);
                        alert(res.msg);
                        $("#saveBtn").text('Save');
                        $("#saveBtn").attr('disabled',false);
                        window.location.reload();
                    },
                    error:function(err) {
                        $("#saveBtn").attr('disabled',false);
                        alert(err);
                    }
                })
            }
            else {
                $('#errors').html('<div class="alert alert-danger">'+errors+'</div>');
            }
        })

    })

</script>








