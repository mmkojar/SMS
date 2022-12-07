<?php $this->load->view('templates/header') ?>


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
            <a class="btn btn-info float-right" href="<?php echo base_url('purchase/add') ?>">Add</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="purchase_stocks" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Vendor Name</th>
                            <th>Item Name</th>
                            <th>Sub-Item</th>
                            <!-- <th>Unit</th> -->
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
                            <td><?php echo $row->vendor_name ?></td>
                            <td><?php echo $row->item_name ?></td>
                            <td><?php echo $row->depart_name; ?></td>
                            <!-- <td><s?php echo $row->unit ?></td> -->
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
							<th colspan="4" style="text-align:right">Total:</th>
							<th></th>
							<th colspan="4"></th>
						</tr>
					</tfoot>
                </table>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('templates/footer') ?>

<script type="text/javascript">
    
    $(document).ready(function() {
        
         $('#purchase_stocks').DataTable({
            order: [[2,'desc']],
            rowGroup: {
                dataSrc: [2]
            },
            columnDefs: [{
                targets: [2],
                visible: false
            }],
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
					.column(4)
					.data()
					.reduce(function (a, b) {
						return intVal(a) + intVal(b);
					}, 0);
	
				// Total over this page
				pageTotal = api
					.column(4, { page: 'current' })
					.data()
					.reduce(function (a, b) {
						return intVal(a) + intVal(b);
					}, 0);
	
				// Update footer
				$(api.column(4).footer()).html(pageTotal + ' ( ' + total + ' total)');
			},
        });
    })

</script>
