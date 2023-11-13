

var dt;

var hs = null;
var selectorName = '.datatable-ajax';



var columnsDataTable = [
  {data: 'id', className: 'text-center'},
  {data: 'no_sep', className: 'text-center'},
  {data: 'patient_name' , className: 'text-start'},
  {data: 'medrec' , className: 'text-start'},
  { data: 'date_in',
  render: function (data, type, row, meta) {
      var date = moment(row.date_in).format("DD/MM/YYYY");
      return date;
  }
},
  { data: 'date_out',
  render: function (data, type, row, meta) {
      var date = moment(row.date_out).format("DD/MM/YYYY");
      return date;
  }
},
{data: 'room' , className: 'text-start'},
{data: 'insurance' , className: 'text-start'},
{data: 'note_admin' , className: 'text-start'},
{data: 'note_revisi' , className: 'text-start'},
{data: 'doc_status_patient' , className: 'text-start',
render: function (data, type, row, meta) {
var status = ``;
if(  row.doc_status_patient == 'Diajukan'){
  var status = `<span class="badge bg-warning">${row.doc_status_patient}</span>`;
} else if( row.doc_status_patient == 'Verifikasi') {
  var status = `<span class="badge bg-info">${row.doc_status_patient}</span>`;
}else if( row.doc_status_patient == 'Upload'){
  var status = `<span class="badge bg-primary">Download</span>`;
} else if( row.doc_status_patient == 'Grouping'){
  var status = `<span class="badge bg-secondary">${row.doc_status_patient}</span>`;
} else if( row.doc_status_patient == 'Revisi'){
  var status = `<span class="badge bg-danger">${row.doc_status_patient}</span>`;
 } else if( row.doc_status_patient == 'Selesai'){
  var status = `<span class="badge bg-success">${row.doc_status_patient}</span>`;
 }  else if( row.doc_status_patient == 'Diajukan ulang'){
  var status = `<span class="badge badge-diajukan">${row.doc_status_patient}</span>`;
 } 
else if (row.doc_status_patient) {
  var status = `<span class="badge bg-secondary">${row.doc_status_patient}</span>`;
}

return status;
}
},


];


  var initDatatable = () => {
  
      dt =  $(selectorName).DataTable({
      paging: false,
      scrollY: '400px',
      scrollX: false,
      select: {
        style: 'single'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: '/datatable-arsip', 
      columns: columnsDataTable,
      language: {
        processing: '<div class="loading-indicator">Loading...</div>'
    },
      columnDefs: [{
        "targets": 0,
        "checkboxes": {
          'selectRow' : true 
        }
      }]
  
   
  });


  }


  var columnsHistoryPatient = [

    {data: 'doc_name', className: 'text-center'},
    {data: 'action' , name : 'action', className: 'text-center'}


  ];

  







  

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

// var filterEventHandler = () => {

// }






$(document).ready(function() {

  
  if ($('#jenis_room').val() == '') {
    $('#room option').show();
  }

  $('#jenis_room').on('change', function() {
    $('#room option').hide();
    let jenis_ruangan = $(this).val();
    if (jenis_ruangan == '') {
      $('#room option').show();
    } else {
      $('#room option[data-jenis="' + jenis_ruangan + '"]').show();
    }
  });

  

  $('#config-demo').daterangepicker({
    "showButtonPanel": true,
    "ranges": {
      'Hari ini': [moment(), moment()],
      'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      '7 Hari lalu': [moment().subtract(6, 'days'), moment()],
      '30 Hari Lalu': [moment().subtract(29, 'days'), moment()],
      'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
      'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
 
}, function(start, end, label) {
  console.log("New date range selected: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');

  const startDate = start.format('YYYY-MM-DD');
  const endDate = end.format('YYYY-MM-DD');
  const newUrl = 'dashboard-jkn/datatable?date_from=' + startDate + '&date_to=' + endDate;
  dt.ajax.url(newUrl).load();
});

$('#apply-date-range').on('click', function() {
  dateRangePicker.data('daterangepicker').show();
});

$('#clear-date-range').on('click', function() {
  dateRangePicker.val(''); 
  dateRangePicker.data('daterangepicker').setStartDate('');
  dateRangePicker.data('daterangepicker').setEndDate('');
  const newUrl = 'dashboard-jkn/datatable';
  dt.ajax.url(newUrl).load();
});


    // console.log(patientId );
   


    let submissionFilterBtn = $("#filter-submission-btn");
    let validatedFilterBtn = $("#filter-validasi-btn");
    let verifikasiFilterBtn = $("#filter-verified-btn");
    let groupingFilterBtn = $("#filter-grouping-btn");
    let revisiFilterBtn = $("#filter-revisi-btn");
    let submissionBadge = $("#submission-badge");
    let ajukanDokumenBtn = $("#filter-ajukan-btn");
    let selesaiDokumenBtn = $("#filter-selesai-btn");
  
    const searchParams = new URLSearchParams(window.location.search);
    let datatableUrl = 'dashboard-jkn/datatable?' + searchParams;
    
  
    submissionFilterBtn.on('click', () => {
      if (submissionFilterBtn.hasClass('btn-ajukan')) {
        // Change the button class and text
        // submissionFilterBtn.removeClass('btn-outline-warning btn-ajukan');
        // submissionFilterBtn.addClass('btn-outline-secondary btn-cancel');
        // submissionFilterBtn.html('Batal');
    
        // Remove the badge
        submissionBadge.remove();
    
        // Handle the logic for your filter here (e.g., dt.ajax.url(...) )
        dt.ajax.url(datatableUrl + '&' + 'submission=1').load();
      } else {
        // Restore the button class and text
        submissionFilterBtn.removeClass('btn-outline-secondary btn-cancel');
        submissionFilterBtn.addClass('btn-outline-warning btn-ajukan');
        submissionFilterBtn.html('Diajukan');
    
        // Add the badge back
        submissionFilterBtn.append(submissionBadge);
        dt.ajax.url(datatableUrl + '&' + 'allData=1').load();
        // Handle the logic for reverting the filter state here
      }
    });
  
    validatedFilterBtn.on('click', () => {
      dt.ajax.url(datatableUrl + '&' + 'validated=1').load();
    });
  
    verifikasiFilterBtn.on('click', () => {
      dt.ajax.url(datatableUrl + '&' + 'verifikasi=1').load();
    });
  
    groupingFilterBtn.on('click', () => {
      dt.ajax.url(datatableUrl + '&' + 'grouping=1').load();
    });
  
    revisiFilterBtn.on('click', () => {
      dt.ajax.url(datatableUrl + '&' + 'revisi=1').load();
    });
  
    ajukanDokumenBtn.on('click', () => {
      dt.ajax.url(datatableUrl + '&' + 'ajukan-dokumen=1').load();
    });

    selesaiDokumenBtn.on('click', () => {
      dt.ajax.url(datatableUrl + '&' + 'selesai-dokumen=1').load();
    });


    $('#btn-checkbox').on('click', function(){

   var selectedRows = dt.column(0).checkboxes.selected();

      var rowIds = [];

   $.each(selectedRows, function (key, patient_id) { 
    rowIds.push(patient_id);
   });

   console.log(rowIds);

   var data = { 
    rowIds : rowIds
   };

   $.ajax({
    type: "put",
    url: "dashboard-jkn/update-status-patient",
    data:  data,
    success: function (response) {
      dt.ajax.reload();
      Swal.fire(
      'Updated!',
      'Status pasien berhasil diubah',
      'success'
      );
    }
   });

    } );


});



document.addEventListener('DOMContentLoaded', function () {

initDatatable();

// detailPatient();
// detailDocument();
// docDetail();
// historyPatient();
// filterEventHandler();
// customDate();

});