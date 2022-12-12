<?php $this->load->view('templates/header') ?>


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <!-- <h4 class="float-left mb-0 mt-2"><s?php echo $title; ?></h4> -->
            <!-- <a class="btn btn-info float-right" href="<s?php echo base_url('items/form') ?>">Add</a> -->
            <p class="text-danger">Add Multiple name with comma for eg(a,b,c)</p>
            <?php echo form_open('items/form'); ?>                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <p class="text-danger"><?php echo form_error('name'); ?></p>
                        </div>                       
                    </div>
                    <div class="col-md-4">
                        <div class="form-group pt-4">
                            <?php echo form_hidden($csrf); ?>                
                            <button type="submit" name="submit" id="salary_submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>               
             <?php echo form_close();?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable_table" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <!-- <th>Min Qty</th> -->
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sr_no=1 ?>
                        <?php foreach ($items as $row):?>
                        <tr>
                            <td><?php echo $sr_no; ?></td>
                            <td><?php echo $row->name ?></td>
                            <!-- <td><s?php echo $row->min_qty ?></td> -->
                            <td><?php echo $row->created_at ?></td>
                            <td><a class="btn btn-success btn-sm text-white" href="<?php echo base_url('items/form/'.$row->id) ?>"><i class="mdi mdi-pencil"></i>Edit</a>&nbsp;<a class="btn btn-danger btn-sm text-white" href="<?php echo base_url('items/delete/'.$row->id) ?>"><i class="mdi mdi-delete"></i>Delete</a></td>
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
