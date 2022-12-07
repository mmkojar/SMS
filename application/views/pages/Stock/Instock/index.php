<?php $this->load->view('templates/header') ?>


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable_table" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Item Name</th>
                            <th>Sub-Item</th>
                            <!-- <th>Unit</th> -->
                            <th>Purchase Qty</th>
                            <th>Sale Qty</th>
                            <th>Qty Remaining</th>
                            <!-- <th>Purcahse Rate</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sr_no=1 ?>
                        <!-- <?php //$countAlert = 0 ?> -->
                        <?php foreach ($instocks as $row):?>
                            <?php if($row->qty <= $row->min_qty): ?>
                                <!-- <?php //$countAlert++ ?> -->
                                <!-- <?php //$_SESSION['min_qty_alrert'] = $countAlert; ?> -->
                                <div class="alert alert-danger">
                                    <?php echo $row->item_name ?> Need to be Purcahse -- Min Quantity is (<?php echo $row->min_qty ?>).<br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top: -30px;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php else: ?>
                                    <!-- <?php //unset($_SESSION['min_qty_alrert']); ?> -->
                                    <!-- <?php// $countAlert = 0 ?> -->
                                <?php endif ?>
                            <?php endforeach;?>
                           
                        <?php foreach ($instocks as $row):?>
                            
                            <tr>
                                <td><?php echo $sr_no; ?></td>
                                <td class="<?php echo ($row->qty <= $row->min_qty) ? 'bg-danger text-white' : '' ?>"><?php echo $row->item_name ?></td>
                                <!-- <td><s?php echo $row->unit ?></td> -->
                                <td><?php echo $row->depart_name ?></td>
                                <td><?php echo $row->pqty ?></td>
                                <td><?php echo $row->sqty ?></td>
                                <td><?php echo $row->qty ?></td>
                                <!-- <td><s?php echo $row->rate ?></td> -->
                            </tr>
                            <?php $sr_no++; ?>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('templates/footer') ?>
<script type="text/javascript">

    $(document).ready(function() {
        
        $.ajax({
            url:"<?php echo base_url('Stock/InStock/stockapi') ?>/",
            method:"GET",
            dataType:'json',
            success:function(res)
            {
                console.log(res);
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
                console.log(presult);
                
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
                console.log(sresult);

              /*   const finalstock = presult.map((item, index) => ({
                        item_name: item.item_name,
                        sub_item_name: item.depart_name,
                        purchase_qty: item.pqty,
                        sale_qty: sresult[index].sqty,
                        stock: item.pqty - sresult[index].sqty
                    })
                )
                console.log(finalstock); */
                
            } 
            
        })
    });
</script>