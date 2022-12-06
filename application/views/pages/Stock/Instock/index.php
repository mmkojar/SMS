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
                            <th>Unit</th>
                            <th>Qty Remaining</th>
                            <th>Purcahse Rate</th>
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
                                <td><?php echo $row->unit ?></td>
                                <td><?php echo $row->qty ?></td>
                                <td><?php echo $row->rate ?></td>
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
