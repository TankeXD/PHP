
$(document).ready(function() {
    if (!$.fn.DataTable.isDataTable('#example')) {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    className: 'btn-pdf',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the last column (Acción)
                    },
                    customize: function(doc) {
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        doc.styles.tableHeader.alignment = 'center'; // Center the header text
                        doc.styles.tableBodyEven.alignment = 'center'; // Center the body text for even rows
                        doc.styles.tableBodyOdd.alignment = 'center'; // Center the body text for odd rows
                        doc.content[1].layout = {
                            hLineWidth: function(i, node) {
                                return (i === 0 || i === node.table.body.length) ? 2 : 1;
                            },
                            vLineWidth: function(i, node) {
                                return (i === 0 || i === node.table.widths.length) ? 2 : 1;
                            },
                            hLineColor: function(i, node) {
                                return (i === 0 || i === node.table.body.length) ? 'black' : 'gray';
                            },
                            vLineColor: function(i, node) {
                                return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray';
                            },
                            paddingLeft: function(i) {
                                return i === 0 ? 0 : 8;
                            },
                            paddingRight: function(i, node) {
                                return i === node.table.widths.length - 1 ? 0 : 8;
                            }
                        };
                        doc.styles.title = {
                            alignment: 'center',
                            fontSize: 20
                        };
                        doc.defaultStyle.alignment = 'center';
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    className: 'btn-excel',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the last column (Acción)
                    }
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    className: 'btn-print',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the last column (Acción)
                    }
                }
            ],
            
            language: {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                "infoFiltered": "(filtrado de _MAX_ entradas totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": activar para ordenar la columna ascendente",
                    "sortDescending": ": activar para ordenar la columna descendente"
                }
            }
        });
    }
});
