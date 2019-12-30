$(function() {
 
    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })

    $.extend(true, $.fn.dataTable.defaults, {

        columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
        }, 
        {
          orderable: false,
          searchable: false,
          targets: -1
        }],
        
        select: {
            style:    'multi+shift',
            selector: 'td:first-child'
        },
        order: [],
        scrollX: true,
        pageLength: 100,
        
        dom: 'lBfrtip<"actions">',
        
        buttons: [
            {
                extend: 'copy',
                className: 'btn-default',
                text: 'Copy',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ]
    });
  
    $.fn.dataTable.ext.classes.sPageButton = '';
});
