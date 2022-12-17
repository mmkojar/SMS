<?php $this->load->view('templates/header') ?>


<div class="col-12">
    <div class="card">
        <!-- <div class="card-header">
            <a class="btn btn-info float-right" href="<s?php echo base_url('expense/form') ?>">Add</a>
        </div> -->
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
				<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#purchase" role="tab"><span
							class="hidden-sm-up"></span> <span class="hidden-xs-down">Purchase</span></a> </li>
				<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sale" role="tab"><span
							class="hidden-sm-up"></span> <span class="hidden-xs-down">Sale</span></a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#stock" role="tab"><span
							class="hidden-sm-up"></span> <span class="hidden-xs-down">Stock</span></a> </li>
			</ul>
            <div class="tab-content tabcontent-border mt-4">
				<div class="tab-pane active" id="purchase" role="tabpanel">
                    <a class="btn btn-info float-right" href="<?php echo base_url('purchase/add') ?>">Add</a>
                    <div class="table-responsive">
                        <table id="stocks_dt1" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>PO.No</th>
                                    <th>Vendor Name</th>
                                    <th>Item Name</th>
                                    <th>Job-Order</th>
                                    <th>Qty</th>
                                    <th>Purchase Rate</th>
                                    <th>Total Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sr_no=1 ?>
                                <?php foreach ($purchases as $row):?>
                                <tr>
                                    <td><?php echo $sr_no; ?></td>
                                    <td><?php echo $row->po_no ?></td>
                                    <td><?php echo $row->vendor_name ?></td>
                                    <td><?php echo $row->item_name ?></td>
                                    <td><?php echo $row->depart_name ? $row->depart_name : '-'; ?></td>
                                    <td><?php echo $row->qty ?></td>
                                    <td><?php echo $row->rate ?></td>
                                    <td><?php echo $row->total_amount ?></td>
                                    <td><?php echo $row->date ?></td>
                                    <td><a class="btn btn-success btn-sm text-white" href="<?php echo base_url('purchase/edit/'.$row->id) ?>"><i class="mdi mdi-pencil"></i>Edit</a>
                                    <a class="btn btn-danger btn-sm text-white" href="<?php echo base_url('purchase/delete/'.$row->id.'/'.$row->item_id.'/'.$row->sub_item_id) ?>"><i class="mdi mdi-delete"></i>Delete</a></td>
                                </tr>
                                <?php $sr_no++; ?>
                                <?php endforeach;?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7" style="text-align:right">Total:</th>
                                    <th></th>
                                    <th colspan="2"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="sale" role="tabpanel">
                    <a class="btn btn-info float-right" href="<?php echo base_url('selling/add') ?>">Add</a>
                    <div class="table-responsive">
                        <table id="stocks_dt2" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Bill No</th>
                                    <th>Vendor Name</th>
                                    <th>Item Name</th>
                                    <th>Job-Order</th>
                                    <th>Qty</th>
                                    <th>Selling Rate</th>
                                    <th>Total Amount</th>
                                    <th>GST</th>
                                    <th>Final Total</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sr_no=1 ?>
                                <?php foreach ($sellings as $row):?>
                                <tr>
                                    <td><?php echo $sr_no; ?></td>
                                    <td><?php echo $row->po_no ?></td>
                                    <td><?php echo $row->vendor_name ?></td>
                                    <td><?php echo $row->item_name ?></td>
                                    <td><?php echo $row->depart_name ? $row->depart_name : '-'; ?></td>
                                    <td class="font-weight-bold"><?php echo $row->qty ?></td>
                                    <td><?php echo $row->rate ?></td>
                                    <td><?php echo $row->total_amount ?></td>
                                    <td><?php echo $row->gst ?></td>
                                    <td><?php echo $row->final_total ?></td>
                                    <td><?php echo $row->date ?></td>
                                    <td><a class="btn btn-success btn-sm text-white" href="<?php echo base_url('selling/edit/'.$row->id) ?>"><i class="mdi mdi-pencil"></i>Edit</a>&nbsp;
                                    <a class="btn btn-danger btn-sm text-white" href="<?php echo base_url('selling/delete/'.$row->id.'/'.$row->item_id.'/'.$row->sub_item_id.'/'.$row->qty) ?>"><i class="mdi mdi-delete"></i>Delete</a></td>
                                </tr>
                                <?php $sr_no++; ?>
                                <?php endforeach;?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="9" style="text-align:right">Total:</th>
                                    <th></th>
                                    <th colspan="2"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="stock" role="tabpanel">
                    <div class="table-responsive">
                        <table id="stock_left" class="table table-bordered table-striped" style="width:100%">
                        <!-- <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Item Name</th>
                                    <th>Job-Order</th>
                                    <th>Purchase Qty</th>
                                    <th>Sale Qty</th>
                                    <th>Qty Remaining</th>
                                </tr>
                            </thead>
                            <tbody>
                                <s?php $sr_no=1 ?>                     
                                <s?php foreach ($instocks as $row):?>                            
                                    <tr>
                                        <td><s?php echo $sr_no; ?></td>
                                        <td class="<s?php echo ($row->qty <= $row->min_qty) ? 'bg-danger text-white' : '' ?>"><s?php echo $row->item_name ?></td>
                                        <td><s?php echo $row->depart_name ? $row->depart_name : '-' ?></td>
                                        <td><s?php echo $row->pqty ?></td>
                                        <td><s?php echo $row->sqty ?></td>
                                        <td><s?php echo $row->qty ?></td>
                                    </tr>
                                    <s?php $sr_no++; ?>
                                <s?php endforeach;?>
                            </tbody> -->
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer') ?>


<script type="text/javascript">
    
    $(document).ready(function() {
        
        $('#stocks_dt1').DataTable({
            dom: 'lBfrtip',
            buttons: [
               'excel'
            ],
            responsive: true,
			footerCallback: function (row, data, start, end, display) {
				var api = this.api();
	
				// Remove the formatting to get integer data for summation
				var intVal = function (i) {
					return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
				};
	
				// Total over all pages
				total = api
					.column(7)
					.data()
					.reduce(function (a, b) {
						return intVal(a) + intVal(b);
					}, 0);
	
				// Total over this page
				pageTotal = api
					.column(7, { page: 'current' })
					.data()
					.reduce(function (a, b) {
						return intVal(a) + intVal(b);
					}, 0);
	
				// Update footer
				$(api.column(7).footer()).html(pageTotal + ' ( ' + total + ' total)');
			},
        });

        $('#stocks_dt2').DataTable({
            dom: 'lBfrtip',
            buttons: [
               'excel'
            ],
            responsive: true,
			footerCallback: function (row, data, start, end, display) {
				var api = this.api();
	
				// Remove the formatting to get integer data for summation
				var intVal = function (i) {
					return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
				};
	
				// Total over all pages
				total = api
					.column(9)
					.data()
					.reduce(function (a, b) {
						return intVal(a) + intVal(b);
					}, 0);
	
				// Total over this page
				pageTotal = api
					.column(9, { page: 'current' })
					.data()
					.reduce(function (a, b) {
						return intVal(a) + intVal(b);
					}, 0);
	
				// Update footer
				$(api.column(9).footer()).html(pageTotal + ' ( ' + total + ' total)');
			},
        });

        $.ajax({
            url:"<?php echo base_url('stocks/api') ?>",
            method:"GET",
            dataType:'json',
            success:function(res)
            {
                // For Purchase
                for (var i in res.pur) {
					res.pur[i].pqty = Number(res.pur[i].qty);
					res.pur[i].type = 'p';
				}			
				const presult =  res.pur.reduce((a2, c2) => {
					let filteredP = a2.filter(el => el.item_id === c2.item_id && el.sub_item_id === c2.sub_item_id)
					if (filteredP.length > 0) {
						a2[a2.indexOf(filteredP[0])].pqty += +c2.pqty;
					} else {
						a2.push(c2);
					}
					return a2;
				}, []);
                
                // For Sale
                for (var i in res.sale) {
					res.sale[i].sqty = Number(res.sale[i].qty);
                    res.sale[i].type = 's';
				}			
				const sresult =  res.sale.reduce((a2, c2) => {
					let filteredP = a2.filter(el => el.item_id === c2.item_id && el.sub_item_id === c2.sub_item_id)
					if (filteredP.length > 0) {
						a2[a2.indexOf(filteredP[0])].sqty += +c2.sqty;
					} else {
						a2.push(c2);
					}
					return a2;
				}, []);

                const reslt = presult.map( r => {
                    const s = sresult.find(o => o.item_id === r.item_id && o.sub_item_id === r.sub_item_id );
                    const sqty = s ? s.sqty : 0;
                    return {
                        item_id: r.item_id,
                        sub_item_id: r.sub_item_id,
                        item_name: r.item_name,
                        sub_item_name: r.depart_name,
                        pqty:r.pqty,
                        sqty:sqty,
                        qty_left: r.pqty - sqty,
                    }
                })
                var html = "";
                    html +=`
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Job-Order</th>
                                <th>Purchase Qty</th>
                                <th>Sale Qty</th>
                                <th>Qty Remaining</th>
                            </tr>
                        </thead>           
                        <tbody>                
                    `;
                for(var i in reslt) {
                    html += `                        
                        <tr>
                            <td>${reslt[i].item_name}</td>
                            <td>${reslt[i].sub_item_name ? reslt[i].sub_item_name : '-'}</td>
                            <td>${reslt[i].pqty}</td>
                            <td>${reslt[i].sqty}</td>
                            <td>${reslt[i].qty_left}</td>
                        </tr>                        
                    `;
                }
                html += `</tbody>`;
                $("#stock_left").html(html);
                $("#stock_left").DataTable({
                    dom: 'lBfrtip',
                    buttons: [
                        'excel'
                    ],
                    responsive: true,
                });
                
            } 
            
        })
    })

</script>