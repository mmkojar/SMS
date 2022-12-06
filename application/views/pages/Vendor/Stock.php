<?php $this->load->view('templates/header') ?>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left mb-0 mt-2"><?php echo $title; ?></h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="vendors_stocks" class="table table-bordered table-striped" style="width:100%">
                    
                    
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer') ?>

<script type="text/javascript">
    
    $(document).ready(function() {
        
        $.ajax({
            url:'<?php echo base_url('vendors/vendorsApi'); ?>',
            method:'GET',
            dataType:'json',
            success:function(res) {
                console.log(res)
                for(var i in res) {
                    res[i].total_amount = Number(res[i].total_amount);
                }
                    
                var helper = {};
                var result = res.reduce(function(r, o) {
                    var key = o.vendor_id;
                    // var key = o.vendor_id + '-' + o.date;

                    if(!helper[key]) {
                        helper[key] = Object.assign({}, o);
                        r.push(helper[key]);
                    }
                    else {
                        helper[key].total_amount += o.total_amount;
                    }
                    return r;
                }, []);
                console.log(result);
                var html = '';
                var sr_no = 1;
                html += `
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Vendor Name</th>
                            <th>Total Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                `;
                for(var i in result) {
                    html += `
                        <tr>
                        <td>${sr_no}</td>
                        <td>${result[i].vendor_name}</td>
                        <td>${result[i].total_amount}</td>
                        <td>${result[i].date}</td>
                        </tr>
                    `;
                    sr_no++;
                }
                $("#vendors_stocks").html(html);
                $('#vendors_stocks').DataTable({
                    /* order: [[5,'desc']],
                    rowGroup: {
                        dataSrc: [5]
                    },
                    columnDefs: [{
                        targets: [5],
                        visible: false
                    }], */
                    responsive: true,
                });

            },
            error:function(err) {
                console.log(err);                
            }
        })
    })

</script>