/**
 * Theme: Simple Admin Template
 * Author: Coderthemes
 * Component: Datatable
 */

$('#datatable').dataTable({order:[]});
$('#datatable-french').dataTable({
    order:[[ 0, "asc" ]],
    "language": {
        "lengthMenu": "Afficher _MENU_ lignes",
        "zeroRecords": "Aucun résultat - désolé...",
        "info": "Lignes _START_ à _END_ sur _TOTAL_",
        "infoEmpty": "Aucune ligne à afficher",
        "infoFiltered": "(sur _MAX_ lignes au total)",
        "search":"Rechercher :",
        "paginate":{
            "previous":"Précédent",
            "next":"Suivant"
        }
    }
});
$('#datatable-english').dataTable({
    order:[[ 0, "asc" ]],
    "language": {
        "lengthMenu": "Show _MENU_ records",
        "zeroRecords": "No record found - sorry...",
        "info": "Records from _START_ to _END_ on _TOTAL_",
        "infoEmpty": "No record to show",
        "infoFiltered": "(on _MAX_ total records)",
        "search":"Search :",
        "paginate":{
            "previous":"Previous",
            "next":"Next"
        }
    }
});

$('#datatable-keytable').DataTable({keys: true});
$('#datatable-responsive-french').DataTable({
    "order":[[ 2, "desc" ]],
    "language": {
        "lengthMenu": "Afficher _MENU_ lignes",
        "zeroRecords": "Aucun résultat - désolé...",
        "info": "Lignes _START_ à _END_ sur _TOTAL_",
        "infoEmpty": "Aucune ligne à afficher",
        "infoFiltered": "(sur _MAX_ lignes au total)",
        "search":"Rechercher :",
        "paginate":{
            "previous":"Précédent",
            "next":"Suivant"
        }
    }
});
$('#datatable-responsive-english').DataTable({
    "order":[[ 2, "desc" ]],
    "language": {
        "lengthMenu": "Show _MENU_ records",
        "zeroRecords": "No record found - sorry...",
        "info": "Records from _START_ to _END_ on _TOTAL_",
        "infoEmpty": "No record to show",
        "infoFiltered": "(on _MAX_ total records)",
        "search":"Search :",
        "paginate":{
            "previous":"Previous",
            "next":"Next"
        }
    }
});
$('#datatable-colvid').DataTable({
    "dom": 'C<"clear">lfrtip',
    "colVis": {
        "buttonText": "Change columns"
    }
});
$('#datatable-scroller').DataTable({
    ajax: "assets/plugins/datatables/json/scroller-demo.json",
    deferRender: true,
    scrollY: 380,
    scrollCollapse: true,
    scroller: true
});
//var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
var table = $('#datatable-fixed-col').DataTable({
    scrollY: "300px",
    scrollX: true,
    scrollCollapse: true,
    order:[],
    paging: false,
    fixedColumns: {
        leftColumns: 1,
        rightColumns: 1
    }
});

var handleDataTableButtons = function () {
    "use strict";
    0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
        dom: "Bfrtip",
        buttons: [{
            extend: "copy",
            className: "btn-sm"
        }, {
            extend: "csv",
            className: "btn-sm"
        }, {
            extend: "excel",
            className: "btn-sm"
        }, {
            extend: "pdf",
            className: "btn-sm"
        }, {
            extend: "print",
            className: "btn-sm"
        }],
        order:[],
        responsive: !0
    })
},
    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                handleDataTableButtons()
            }
        }
    }();
TableManageButtons.init();
