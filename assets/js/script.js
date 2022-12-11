$(function() {
    "use strict";

    // $(".preloader").fadeOut();
});

$(document).ready(function() {
    // Load Branches For Modal
    if(grp_name == 'admin') {
        $("#datatable_table").DataTable({
            dom: 'lBfrtip',
            buttons: [
               'excel'
            ],
            responsive: true,
        });
    }
    else {
        $("#datatable_table").DataTable({
            responsive: true,
        });
    }

});

