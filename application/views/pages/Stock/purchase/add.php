<?php $this->load->view('templates/header'); ?>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>            
        </div>
        <div class="card-body">
            <form action="" method="POST" id="saveForm">
                <div class="row">
                    <div class="col-md-12">                
                        <div class="table-responsive">
                            <span id="errors"></span>
                            <table id="multi_form" class="table table-striped table-bordered table-responsive-md" cellspacing="0" width="100%">
                                <thead>
                                    <tr>    
                                        <th>Vendor Name</th>
                                        <th>Department Name</th>
                                        <th>Item Name</th>
                                        <th>Qty</th>
                                        <th>Select Unit</th>
                                        <th>Purchase Rate</th>
                                        <!-- <th>Selling Rate</th> -->
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
            html += '<td><select class="form-control vendor_id select2" data-sub_item='+count+' name="vendor_id[]" id="vendor_id_' + count + '"><option value="" selected>--select--</option><?php print_r($vendors) ?></select></td>';
            html += '<td><select class="form-control dpt_id select2" data-sub_item='+count+' name="dpt_id[]" id="dpt_id_' + count + '"><option value="" selected>--select--</option><?php print_r($departs) ?></select></td>';
            html += '<td><select class="form-control item_name select2" data-sub_item='+count+' name="item_name[]" id="item_name_' + count + '"><option value="" selected>--select--</option><?php print_r($items) ?></select></td>';
            html += '<td><input type="number" min="1" id="qty_' + count + '" data-sub_item='+count+' name="qty[]" class="form-control qty" placeholder=""/>';
            html += '<td><select class="form-control unit" data-sub_item='+count+' name="unit[]" id="unit_' + count + '"><option value="">Select</option><option value="GRAM">GRAM</option><option value="KG">KG</option><option value="LTR">LTR</option><option value="BOX">BOX</option><option value="PCS">PCS</option></select></td>';
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

        $(document).on('change', '.item_name', function(){            
            var sub_item = $(this).data('sub_item');
			
			var dropdownvalue = $(this).val();
			$(".item_name").not(this).find('option[value="' + dropdownvalue + '"]').remove();
            
            var today = new Date();
            document.querySelector("#date_"+sub_item).value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);            
        });
		
        
        $("#saveBtn").on('click', (e) => {

            e.preventDefault();
            var errors = '';
            $('.vendor_id,.dpt_id,.item_name,.unit,.qty,.rate,.date').each(function(){
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








