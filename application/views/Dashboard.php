<?php $this->load->view('templates/header') ?>
                           
    <div class="col-12">
        <div class="card">         
            <div class="card-header">
                <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
                <p></p>
                <br>
                <?php echo form_open('dashboard/form'); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" name="date" id="date" class="form-control"
                                value="<?php echo isset($_SESSION['filter_date']) ? $_SESSION['filter_date'] : date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" name="submit" value="Submit" class="btn btn-info"><i class="mdi mdi-arrow-right"></i></button>
                                <input type="submit" name="clear" value="Clear Filter" class="btn btn-danger">
                            </div>
                        </div>
                    </div>
                </form>
            </div>           
            <div class="card-body">
                <div class="row">
                   <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="<?php echo base_url('purchase') ?>">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h6 class="text-white">Total Purchase</h6>
                                    <h1 class="font-light text-white"><?php echo $ptotal_amt ?></h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="<?php echo base_url('selling') ?>">
                            <div class="card card-hover">
                                <div class="box bg-success text-center">
                                    <h6 class="text-white">Total Sell</h6>
                                    <h1 class="font-light text-white"><?php echo $stotal_amt ?></h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="<?php echo base_url('vendors') ?>">
                            <div class="card card-hover">
                                <div class="box bg-warning text-center">
                                    <h6 class="text-white">Vendors</h6>
                                    <h1 class="font-light text-white"><?php echo $vendors ?></h1>
                                </div>
                            </div>
                        </a>
                    </div>                                     
                </div>
            </div>
        </div>
    </div>
    
<?php $this->load->view('templates/footer') ?>