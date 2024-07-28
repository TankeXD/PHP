
document.addEventListener('DOMContentLoaded', function () {
    // Inicialización de la DataTable con configuración de idioma en español
    let exampleTable = new DataTable('#agregar_prod', {
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
    
    let scrollVerticalTable = new DataTable('#scroll-vertical', {
        "scrollY": "210px",
        "scrollCollapse": true,
        "paging": false
    });
    
    let scrollHorizontalTable = new DataTable('#scroll-horizontal', {
        "scrollX": true
    });
    
    let alternativePaginationTable = new DataTable('#alternative-pagination', {
        "pagingType": "full_numbers"
    });
    
    let fixedHeaderTable = new DataTable('#fixed-header', {
        "fixedHeader": true
    });
    
    let modalDatatablesTable = new DataTable('#model-datatables', {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return 'Detalles para ' + data[0] + ' ' + data[1];
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        }
    });
    
    let buttonsDatatablesTable = new DataTable('#buttons-datatables', {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print', 'pdf'
        ]
    });
    
    let ajaxDatatablesTable = new DataTable('#ajax-datatables', {
        "ajax": 'assets/json/datatable.json'
    });
    
    // Inicialización de la DataTable con configuración de idioma en español
    let dataClientTable = $('#dataClient').DataTable({
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});