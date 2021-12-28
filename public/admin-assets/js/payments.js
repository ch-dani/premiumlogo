$(function () {

    "use strict";

    let $table = $('#tableData');
    let table = $table.DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "order": [[0, "desc"]],
        "aoColumns": [
            {
                data: 'id',
                bSortable: true
            },
            {
                data: 'user',
                bSortable: false,
                searchable: false,
            },
            {
                data: 'email',
                bSortable: false,
                searchable: false,
            },
            {
                data: 'payment',
                searchable: false,
                bSortable: false
            },
            {
                data: 'price',
                searchable: false,
                bSortable: true
            },
            {
                data: 'type',
                searchable: true,
                bSortable: true
            },
            {
                data: 'paymentId',
                searchable: true,
                bSortable: true
            },
            {
                data: 'created_at',
                searchable: false,
                bSortable: true
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": ""
    });
});

