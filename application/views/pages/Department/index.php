<?php $this->load->view('templates/header') ?>


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
            <a class="btn btn-info float-right" href="<?php echo base_url('department/form') ?>">Add</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable_table" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Item Name</th>
                            <th>Sub-Item</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sr_no=1 ?>
                        <?php foreach ($departments as $row):?>
                        <tr>
                            <td><?php echo $sr_no; ?></td>
                            <td><?php echo $row->item_name ?></td>
                            <td><?php echo $row->name ?></td>
                            <td><?php echo $row->created_at ?></td>
                            <td><a class="btn btn-success btn-sm text-white" href="<?php echo base_url('department/form/'.$row->id) ?>"><i class="mdi mdi-pencil"></i>Edit</a>&nbsp;<a class="btn btn-danger btn-sm text-white" href="<?php echo base_url('department/delete/'.$row->id) ?>"><i class="mdi mdi-delete"></i>Delete</a></td>
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