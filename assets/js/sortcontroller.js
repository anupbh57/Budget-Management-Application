$(document).ready(function () { 
    $('#table').DataTable({ //Sort Table
        "searching": true // false to disable search (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
});

$('#dwnjson').on('click', function () {
    $("#table").tableHTMLExport({ type: 'json', filename: 'sample.json' });
})
$('#dwncsv').on('click', function () {
    $("#table").tableHTMLExport({ type: 'csv', filename: 'sample.csv' });
})
$('#dwnpdf').on('click', function () {
    $("#table").tableHTMLExport({ type: 'pdf', filename: 'sample.pdf' });
})

