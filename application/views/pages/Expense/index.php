<?php $this->load->view('templates/header') ?>


<div class="col-12">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
				<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#expense" role="tab"><span
							class="hidden-sm-up"></span> <span class="hidden-xs-down">Expenses</span></a> </li>
				<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profit" role="tab"><span
							class="hidden-sm-up"></span> <span class="hidden-xs-down">Total Profit</span></a> </li>
			</ul>
            <div class="tab-content tabcontent-border mt-4">
				<div class="tab-pane active" id="expense" role="tabpanel">
                    <a class="btn btn-info float-right" href="<?php echo base_url('expense/form') ?>">Add</a>
                    <div class="table-responsive">
                        <table id="datatable_table" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Bill No</th>
                                    <!-- <th>Item Name</th> -->
                                    <!-- <th>Qty</th> -->
                                    <th>Rate</th>
                                    <th>Total Amount</th>
                                    <th>GST</th>
                                    <th>Final Total</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sr_no=1 ?>
                                <?php foreach ($expenses as $row):?>
                                <tr>
                                    <td><?php echo $sr_no; ?></td>
                                    <td><?php echo $row->bill_no; ?></td>
                                    <!-- <td><s?php echo $row->item ?></td>
                                    <td><s?php echo $row->qty ?></td> -->
                                    <td><?php echo $row->rate ?></td>
                                    <td><?php echo $row->total_amount ?></td>
                                    <td><?php echo $row->gst ?></td>
                                    <td><?php echo number_format($row->final_total,2) ?></td>
                                    <td><?php echo $row->date ?></td>
                                    <td><a class="btn btn-success btn-sm text-white" href="<?php echo base_url('expense/form/'.$row->id) ?>"><i class="mdi mdi-pencil"></i>Edit</a>&nbsp;<a class="btn btn-danger btn-sm text-white" href="<?php echo base_url('expense/delete/'.$row->id) ?>"><i class="mdi mdi-delete"></i>Delete</a></td>
                                </tr>
                                <?php $sr_no++; ?>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="profit" role="tabpanel">
                    <?php $month = ['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct',
									'11'=>'Nov','12'=>'Dec'] ?>
                    <?php $year = ['2022','2023','2024','2025','2026','2027','2028','2029','2030'] ?>
                    <form method="post" name="filter_report_form">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <select name="months" id="filter_month" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach($month as $key => $value): ?>
                                            <option <?php echo date('m') == $key ? 'selected' : '' ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <select name="year" id="filter_year" class="form-control">
                                        <?php foreach($year as $row): ?>
                                            <option <?php echo date('Y') == $row ? 'selected' : '' ?> value="<?php echo $row ?>"><?php echo $row ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-success" id="filter_reports">Submit</button>
                                </div>
                            </div>
                        </div>
                                                    
                    </form>
                    <div class="table-responsive">
                        <table id="profit_tb" class="table table-bordered table-striped" style="width:100%">
                        
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

        $("#filter_reports").on('click', function(e) {

            e.preventDefault();

            var month = $("#filter_month").val();
            var year = $("#filter_year").val();
            
            $('#selling_reports').DataTable().destroy();
            getSellingReports(month, year);
        })

        var date = new Date();
        var cm = ("0" + (date.getMonth() + 1)).slice(-2)
        var cy = date.getFullYear();

        getSellingReports(cm,cy);

        function getSellingReports(mt,yr) {
            $.ajax({
                url:'<?php echo base_url('expense/api'); ?>',
                method:'GET',
                data:{
                    mt:mt,
                    yr:yr
                },
                dataType:'json',
                beforeSend:() => {
                    $(".preloader").show();
                },
                success:function(res) {
                    $(".preloader").hide();
                    var  months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    const saletot = res.sell.map((res)=> Number(res.final_total)).reduce((total,count) => total+count,0);
                    const exptot = res.expense.map((res)=> Number(res.final_total)).reduce((total,count) => total+count,0);
                    var profit = saletot-exptot;
                    var html = `
                        <thead>
                            <tr>
                                <th>Total Selling</th>
                                <th>Total Expense</th>
                                <th>Total Profit</th>
                                <th>Month</th>
                                <th>Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>${saletot.toFixed(2)}</td>
                                <td>${exptot.toFixed(2)}</td>
                                <td>${profit.toFixed(2)}</td>
                                <td>${mt ? months[Number(mt)-1] : '-'}</td>
                                <td>${yr ? yr : '-'}</td>
                            </tr>
                        </tbody>
                    `;
                    $("#profit_tb").html(html);                    
                },
                error:function(err) {
                    console.log(err);                
                }
            })
        }        
    })

</script>