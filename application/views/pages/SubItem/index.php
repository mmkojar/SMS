<?php $this->load->view('templates/header') ?>


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <!-- <h4 class="float-left mb-0 mt-2"><s?php echo $title; ?></h4> -->
            <!-- <a class="btn btn-info float-right" href="<s?php echo base_url('department/form') ?>">Add</a> -->
            <p class="text-danger">Add Multiple name with comma for eg(a,b,c)</p>
            <?php echo form_open('subitem/form'); ?>                
                <div class="row">  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Item Name</label>
                            <select name="item_id" class="form-control">
                                <option value="">Select Item</option>
                                <?php foreach($items as $item) : ?>
                                    <?php $selected = set_select('item_id',$item->id) ; ?>
                                    <option value="<?php echo $item->id ?>"  <?php echo $selected ?>><?php echo $item->name ?></option>
                                <?php endforeach ?>
                            </select>                            
                            <p class="text-danger"><?php echo form_error('item_id'); ?></p>
                        </div>
                    </div>               
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"  
                            value="<?php echo isset($subitems['name']) ? $subitems['name'] : set_value('name') ?>">
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
                            <th>Item Name</th>
                            <th>Sub-Item</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sr_no=1 ?>
                        <?php foreach ($subitems as $row):?>
                        <tr>
                            <td><?php echo $sr_no; ?></td>
                            <td><?php echo $row->item_name ?></td>
                            <td><?php echo $row->name ?></td>
                            <td><?php echo $row->created_at ?></td>
                            <td><a class="btn btn-success btn-sm text-white" href="<?php echo base_url('SubItem/form/'.$row->id) ?>"><i class="mdi mdi-pencil"></i>Edit</a>&nbsp;<a class="btn btn-danger btn-sm text-white" href="<?php echo base_url('SubItem/delete/'.$row->id) ?>"><i class="mdi mdi-delete"></i>Delete</a></td>
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