

$(document).ready(function() {


    $('#table-excel').dataTable({
        //"bJQueryUI": true,
        "bPaginate": true,
        "iDisplayLength": 10,
        //"sPaginationType": "full_numbers",
        //"iDeferLoading": 25,
        "sDom": 'T<"clear">lfrtip',
        //"sDom":'T<"clear"><"H"lfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
                "print",
                "xls",
                "pdf"
            ],
            "sSwfPath": "../DataTables-1.9.4/extras/TableTools/media/swf/copy_csv_xls_pdf.swf",
            "sRowSelect": "single"
        }
    });
   TableTools.DEFAULTS.aButtons = ["copy", "csv", "xls"];



});


function excellExport() {
    var leads = $('input').attr('aria-controls', 'DataTables_Table_0').val();
    console.log("export-xls.php?ex=leads&search=" + leads);
    location.replace("export-xls.php?ex=leads&search=" + leads);
}
