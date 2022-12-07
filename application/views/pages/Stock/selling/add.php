<?php $this->load->view('templates/header'); ?>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
        </div>
        <div class="card-body pt-2">
            <form action="" method="POST" id="saveForm">
                <div class="row">
					<!-- Multiple Add Form -->
					<div class="col-md-12">
						<span id="errors"></span>
					</div>
                    <div class="col-md-12">						
                        <div class="table-responsive">                            
                            <table id="multi_form" class="table table-striped table-bordered table-responsive-md" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                            			<th>Vendor Name</th>
                                        <th>Item Name</th>
										<th>Sub-Item</th>
                                        <!-- <th>unit</th> -->
                                        <th>Qty</th>
                                        <!-- <th>Purchase Rate</th> -->
                                        <th>Selling Rate</th>
                                        <!-- <th>Outlet</th> -->
                                        <th>Date</th>
                                        <th width="50px" id="remove_rows">
                                            <div class="add_row text-center"><i class="btn btn-sm btn-info mdi mdi-plus-circle"></i></div>
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="append_rows">
                                </tbody>
                            </table>     
                        </div>
                    </div>
					<!-- Single Add Form -->
					<!-- <div class="col-md-12">
						<span id="errors"></span>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="item_id">Item Name</label>
							<select class="form-control item_id select2" name="item_id" id="item_id">
								<option value="" selected>--select--</option>
								<s?php print_r($items); ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="sub_item_id">Department Name</label>
							<select class="form-control sub_item_id select2" name="sub_item_id" id="sub_item_id">
								<option value="" selected>--select--</option>
								<s?php print_r($departs); ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="unit">Select Unit</label>
							<select class="form-control unit" name="unit" id="unit">
								<option value="" selected>--select--</option>
								<option value="GRAM">GRAM</option>
								<option value="KG">KG</option>
								<option value="LTR">LTR</option>
								<option value="BOX">BOX</option>
								<option value="PCS">PCS</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="qty">Quantity</label>
							<input type="number" min="1" id="qty" name="qty" class="form-control qty" />
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="purchase_rate">Purchase Rate</label>
							<input type="number" min="1" id="purchase_rate" name="purchase_rate" class="form-control purchase_rate" readonly/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="rate">Selling Rate</label>
							<input type="number" min="1" id="rate" name="rate" class="form-control rate" />
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="outlet">Outlet</label>
							<select class="form-control outlet" name="outlet" id="outlet">
								<option value="">Select</option>
								<option value="Naaz Kamani">Naaz Kamani</option>
								<option value="Naaz Jarimari">Naaz Jarimari</option>
								<option value="Parel">Parel</option>
								<option value="Patel">Patel</option>
								<option value="Metro">Metro</option>
								<option value="Naaz Executive">Naaz Executive</option>
								<option value="Other">Other</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="date">Date</label>
							<input type="date" id="date" name="date" class="form-control date" />
						</div>
					</div> -->
                </div>
                <?php echo form_hidden($csrf); ?>
				<!-- <input type="hidden" id="hidden_qty" name="hidden_qty" class="form-control" /> -->
                <button type="submit" name="submit" id="saveBtn" class="btn btn-success">Save</button>        
            <?php echo form_close();?>
        </div>
    </div>	
</div>

<?php $this->load->view('templates/footer') ?>

<script type="text/javascript">

    $(document).ready(function() {        

		$(".select2").select2();

		$('#selling_tab').DataTable({
            order: [[8,'desc']],
            responsive: true,
			footerCallback: function (row, data, start, end, display) {
				var api = this.api();
	
				// Remove the formatting to get integer data for summation
				var intVal = function (i) {
					return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
				};
	
				// Total over all pages
				total = api
					.column(3)
					.data()
					.reduce(function (a, b) {
						return intVal(a) + intVal(b);
					}, 0);
	
				// Total over this page
				pageTotal = api
					.column(3, { page: 'current' })
					.data()
					.reduce(function (a, b) {
						return intVal(a) + intVal(b);
					}, 0);
	
				// Update footer
				$(api.column(3).footer()).html(pageTotal + ' ( ' + total + ' total)');
			},
        });
		
        var count = 0;
        function addSellingRows() {
            count += 1;
            var html = '';
            html += '<tr>';
            html += '<td><select class="form-control vendor_id select2" data-sub_item='+count+' name="vendor_id[]" id="vendor_id_' + count + '"><option value="" selected>--select--</option><?php print_r($vendors) ?></select></td>';
            html += '<td><select class="form-control item_id select2" data-sub_item='+count+' name="item_id[]" id="item_id_'+count+'"><option value="" selected>--select--</option><?php print_r($items); ?></select></td>';
            html += '<td><select class="form-control sub_item_id select2" name="sub_item_id[]" data-sub_item='+count+' id="sub_item_id_' + count + '"></select></td>';
            // html += '<td><select class="form-control unit" name="unit[]" data-sub_item='+count+' id="unit_' + count + '"><option value="">Select</option><option value="GRAM">GRAM</option><option value="KG">KG</option><option value="LTR">LTR</option><option value="BOX">BOX</option><option value="PCS">PCS</option></select></td>';
            html += '<td><input type="number" min="1" id="qty_' + count + '" data-sub_item='+count+' name="qty[]" class="form-control qty" placeholder=""/>';
            // html += '<td><input type="number" min="1" id="purchase_rate_' + count + '" data-sub_item='+count+' name="purchase_rate_[]" class="form-control purchase_rate" readonly placeholder=""/>';
            html += '<td><input type="number" min="1" id="rate_' + count + '" data-sub_item='+count+' name="rate[]" class="form-control rate" placeholder=""/>';
            // html += '<td><select class="form-control outlet" name="outlet[]" data-sub_item='+count+' id="outlet_' + count + '"><option value="">Select</option><option value="Naaz Kamani">Naaz Kamani</option><option value="Naaz Jarimari">Naaz Jarimari</option><option value="Parel">Parel</option><option value="Patel">Patel</option><option value="Metro">Metro</option><option value="Naaz Executive">Naaz Executive</option><option value="Other">Other</option></select></td>';
            html += '<td><input type="date" id="date_' + count + '" data-sub_item='+count+' name="date[]" class="form-control date" placeholder=""/>';
            html += '<td><div class="delete_row text-center"><i class="btn btn-sm btn-danger mdi mdi-minus-circle"></i></div></td>';
            html += `<td><input type="hidden" id="hidden_qty_${count }" name="hidden_qty[]" class="form-control" />`;
            $('#append_rows').append(html);
        }

        addSellingRows();

        $(".select2").select2();

        $(document).on('click', '.add_row', function(e){
            addSellingRows();
            
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
			$.ajax({
				url:"<?php echo base_url('Stock/purchase/getSubItemOnChange') ?>/"+dropdownvalue,
                method:"GET",
                dataType:'json',
                success:function(res)
                {
                    var html = '';
					html += '<option value="">Select</option>';
                    for(var i in res) {
                        html += `<option value="${res[i].id}">${res[i].name}</option>`;
                    }
                    $('#sub_item_id_'+sub_item).html(html);
                }
            })
            
        });

		$(document).on('change', '.sub_item_id', function(){
			
			var countitems = $(this).data('sub_item');
			var item_id = $('#item_id_'+countitems).val();
			var sub_item_id = $(this).val();
			console.log("item_id:",item_id);
			console.log("sub_item_id:",sub_item_id);
			var today = new Date();
			document.querySelector("#date_"+countitems).value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
			if(sub_item_id !== "") {
				$.ajax({
					url:"<?php echo base_url('Stock/selling/getPurchaseItemsOnChange') ?>",
					method:"POST",
					data:{item_id:item_id,sub_item_id:sub_item_id},
					dataType:'json',
					success:function(res)
					{
						console.log(res);
						if(res.length > 0) {
							// $('#unit').val(res.unit);
							$('#qty_'+countitems).val(res[0].qty);
							$('#hidden_qty_'+countitems).val(res[0].qty);
							$('#qty_'+countitems).attr('max',res[0].qty);
							// $('#purchase_rate_'+countitems).val(res[0].rate);
							// $('#rate').val(res.selling_rate);
						} 
						else {
							$('#qty_'+countitems).val(0);
							$('#hidden_qty_'+countitems).val(0);
							$('#qty_'+countitems).removeAttr('max');
						}
						
					}
				})
			}
			
		});
		
        $("#saveBtn").on('click', (e) => {
			
            e.preventDefault();
            var errors = '';
            $('.vendor_id,.item_id,.sub_item_id,.qty,.rate,.date').each(function(){
                if($(this).val() == '')
                {
                    errors += 'Fill All Details'+'<br>';              
                    return false;
                }
                else {
                    errors +='';
                    return true;
                }
            });
            $('.qty').each(function() {
				var countitems = $(this).data('sub_item');
                var inputVal = $(this).val();
                var checkQty = $(this).attr('max');
				if(inputVal !== '') {
					if(Number(inputVal) == 0) {
						errors += 'Quantity cannot be 0 at row no ' +countitems;
						return false;
					}
					else if((Number(inputVal) > Number(checkQty))) {
						errors += 'Quantity should be less than '+checkQty+ ' at row no ' +countitems;
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
                    url:'<?php echo base_url('selling/insert'); ?>',
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
                $('#errors').html('<div class="alert alert-danger mb-0">'+errors+'</div>');
            }      
        })

    });

</script>



