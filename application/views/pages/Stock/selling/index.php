<?php $this->load->view('templates/header') ?>


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
            <a class="btn btn-info float-right" href="<?php echo base_url('selling/add') ?>">Add</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="selling_tab" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Item Name</th>
                            <th>Department Name</th>
                            <th>Qty Sell</th>
                            <th>Unit</th>
                            <th>Selling Rate</th>
                            <th>Total Amount</th>
                            <!-- <th>Outlet</th> -->
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sr_no=1 ?>
                        <?php foreach ($sellings as $row):?>
                        <tr>
                            <td><?php echo $sr_no; ?></td>
                            <td><?php echo $row->item_name ?></td>
                            <td><?php echo $row->depart_name; ?></td>
                            <td class="font-weight-bold"><?php echo $row->qty ?></td>
                            <td><?php echo $row->unit ?></td>
                            <td><?php echo $row->rate ?></td>
                            <td><?php echo $row->total_amount ?></td>
                            <!-- <td><?php echo $row->outlet ?></td> -->
                            <td><?php echo $row->date ?></td>
                            <td><a class="btn btn-success btn-sm text-white" href="<?php echo base_url('selling/edit/'.$row->id) ?>"><i class="mdi mdi-pencil"></i>Edit</a>&nbsp;
                            <a class="btn btn-danger btn-sm text-white" href="<?php echo base_url('selling/delete/'.$row->id.'/'.$row->item_id.'/'.$row->qty) ?>"><i class="mdi mdi-delete"></i>Delete</a></td>
                        </tr>
                        <?php $sr_no++; ?>
                        <?php endforeach;?>
                    </tbody>
					<tfoot>
						<tr>
							<th colspan="3" style="text-align:right">Total:</th>
							<th></th>
							<th colspan="5"></th>
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
        
        $('#selling_tab').DataTable({
            order: [[1,'desc']],
            rowGroup: {
                dataSrc: [1]
            },
            columnDefs: [{
                targets: [1],
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
    })

</script>
