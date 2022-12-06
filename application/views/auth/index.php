<?php $this->load->view('templates/header') ?>


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
            <a class="btn btn-info float-right" href="<?php echo base_url('users/add') ?>">Add User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable_table" class="display nowrap table table-bordered table-striped"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo lang('index_fname_th');?></th>
                            <th scope="col"><?php echo lang('index_lname_th');?></th>
                            <th scope="col"><?php echo lang('index_email_th');?></th>
                            <th scope="col">Mobile No.</th>
                            <th scope="col"><?php echo lang('index_action_th');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user):?>
                        <tr>
                            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
                            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
                            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
                            <td><?php echo htmlspecialchars($user->phone,ENT_QUOTES,'UTF-8');?></td>
                            <td><a class="btn btn-success text-white"
                                    href="<?php echo base_url('profile/'.$user->id) ?>"><i
                                        class="mdi mdi-pencil"></i></a>
                                        <a class="btn btn-danger text-white"
                                    href="<?php echo base_url('auth/delete/'.$user->id) ?>"><i
                                        class="mdi mdi-delete"></i></a></td>

                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('templates/footer') ?>