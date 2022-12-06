<?php $this->load->view('templates/header') ?>


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>            
        </div>
        <div class="card-body">
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
                <table id="purchase_reports" class="table table-bordered table-striped" style="width:100%">
                   
                    
                </table>
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

            $('#purchase_reports').DataTable().destroy();
            getPurchaseReports(month, year);
        })

        var date = new Date();
        var cm = ("0" + (date.getMonth() + 1)).slice(-2)
        var cy = date.getFullYear();

        getPurchaseReports(cm,cy);

        function getPurchaseReports(mt,yr) {
            $.ajax({
                url:'<?php echo base_url('reports/purchaseApi'); ?>',
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
                    for(var i in res) {
                        res[i].total_amount = Number(res[i].total_amount);
                        res[i].qty = Number(res[i].qty);
                    }
                        
                    var helper = {};
                    var result = res.reduce(function(r, o) {
                        var key = o.item_id;
                        // var key = o.vendor_id + '-' + o.date;

                        if(!helper[key]) {
                            helper[key] = Object.assign({}, o);
                            r.push(helper[key]);
                        }
                        else {
                            helper[key].total_amount += o.total_amount;
                            helper[key].qty += o.qty;
                        }
                        return r;
                    }, []);      
                    
                    var  months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    
                    var html = '';
                    var sr_no = 1;
                    html += `
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Item Name</th>
                                <th>Total Qty.</th>
                                <th>Total Amount</th>
                                <th>Month</th>
                                <th>Year</th>
                            </tr>
                        </thead>
                        <tbody>
                    `;
                    for(var i in result) {
                        html += `
                            <tr>
                            <td>${sr_no}</td>
                            <td>${result[i].item_name}</td>
                            <td>${result[i].qty}</td>
                            <td>${result[i].total_amount}</td>
                            <td>${mt ? months[Number(mt)-1] : '-'}</td>
                            <td>${yr ? yr : '-'}</td>
                            </tr>
                        `;
                        sr_no++;
                    }
                    html +=  `</tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th style="text-align:right">Total:</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>`;

                    $("#purchase_reports").html(html);
                    $('#purchase_reports').DataTable({                        
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
                            $(api.column(3).footer()).html('<b>'+pageTotal+'</b>' + ' ( <b>' + total + ' total</b>)');
                        },
                    });

                },
                error:function(err) {
                    console.log(err);                
                }
            })
        }

        
    })

</script>