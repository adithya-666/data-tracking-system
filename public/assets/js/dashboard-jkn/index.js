

var dt;
var dtArsip;

var hs = null;
var selectorName = '.datatable-ajax';

var customDate = () => {

}

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
{data: 'action' , name : 'action', className: 'text-center'}


];


  var initDatatable = () => {
    const searchParams = new URLSearchParams(window.location.search);
    // const date_from = searchParams.get('date_from');
    // const date_to = searchParams.get('date_to');
    // const room = searchParams.get('room');
    // const jenis_room = searchParams.get('jenis_room');
    

      let datatableUrl = 'dashboard-jkn/datatable?' + searchParams;
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
      ajax: datatableUrl, 
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



  dt.on('click', 'tr', function () {

    if ($(this).hasClass('selected')) {
      $(this).removeClass('selected');
    } else {
        dt.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
    }

      const selectedData = dt.row(this).data();


    const patient_id = selectedData.id;
    alert(patient_id);

      selectedPatient = $(this);
    
        // detailPatient(selectedData);
        detailDocument(selectedData);
        // docDetail(selectedData);
        historyPatient(selectedData);
        // alert(selectedTransactionId);

});



  }


  var columnsHistoryPatient = [

    {data: 'doc_name', className: 'text-center'},
    {data: 'action' , name : 'action', className: 'text-center'}


  ];

  
  var historyPatient = (selectedData) => {



    const patientId = selectedData.id;

   // Hancurkan DataTable jika sudah ada
   if (hs !== null) {
    hs.destroy();
}

  hs =  $('.history-patient').DataTable({
      paging: false,
      scrollY: '400px',
      select: {
        style: 'single'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      searching: false,
      ajax: 'dashboard-jkn/history-patient/' + patientId,
      columns: columnsHistoryPatient,
      language: {
        processing: '<div class="loading-indicator">Loading...</div>'
    },
      columnDefs: [{
        "defaultContent": "-",
        "targets": "_all"
      }]

   
  
   
  });


  $("#selesai-btn").data('patient-id', selectedData.id);
  $("#arsipkan-btn").data('patient-id', selectedData.id);

//     hs.on('click', 'tr', function () {
//     const selectedDataDocument = hs.row(this).data();
//     if (selectedDataDocument) {
      

  
//         // editDocument(selectedDataDocument);
//         alert(selectedDataDocument.doc_name);
//     }
// });
    
  }






  // var docDetail = (selectedData) => {

  //   $('.show-data').empty();
  
  
  //   const patientId = selectedData.id ;

  

  //     $.ajax({
  //       method: "GET",
  //       url: "dashboard-jkn/document-detail/" + patientId,
  //       success: function (res) {
    
      
  //         $('.document-container').removeClass('d-none');
  //         // $.each(collection, function (indexInArray, valueOfElement) { 
            
  //         // });
  //         $.each(res.data, function (index, item) {


  //           // Buat elemen checkbox
  //             var checkboxInput = $('<input>', {
  //               type: 'checkbox',
  //               name: 'verification[]', // Nama yang akan digunakan saat mengirimkan data
  //               value: item.doc_name, // Nilai yang ingin Anda kaitkan dengan checkbox
  //               class: 'form-check-input mb-3'
  //             });

  //             // Buat elemen label untuk checkbox
  //             var checkboxLabel = $('<label>', {
  //               for: 'verification-' + index, // ID unik untuk elemen label
  //               class: 'form-check-label mb-3',
  //               text: 'Verify' // Teks label untuk verifikasi
  //             });


  //           var documentLabel = $('<label>', {
  //             for: 'document-detail-' + index, // ID unik untuk elemen input
  //             class: 'form-label',
  //             text: 'Document' // Teks label
  //           });


  //           var noteLabel = $('<label>', {
  //             for: 'note-detail-' + index, // ID unik untuk elemen textarea
  //             class: 'form-label',
  //             text: 'Note' // Teks label
  //           });

  //           // Buat elemen input untuk document
  //           var documentInput = $('<input>', {
  //             type: 'text',
  //             name: 'document[]',
  //             class: 'form-control document-detail mb-3',
  //             value: item.doc_name, // Isi dengan data yang diterima
  //             required: true
  //           });
      
  //          // Buat elemen textarea untuk note
  //     var noteTextarea = $('<textarea>', {
  //       class: 'form-control note-detail mb-3',
  //       name: 'note[]',
  //       style: 'height: 20px'
  //     });

  //     // Isi nilai pada elemen textarea
  //         noteTextarea.val(item.doc_note_sub);
      
  //           // Buat div kontainer untuk elemen input dan textarea
  //           var containerDocument = $('<div>').addClass('col-lg-5');
  //           containerDocument .append(documentLabel, documentInput);

  //           var containerNote = $('<div>').addClass('col-lg-5');
  //           containerNote.append(noteLabel, noteTextarea);


  //           var containerVerify = $('<div>').addClass('col-lg-2');
  //           containerVerify.append(checkboxLabel, checkboxInput);
      
  //           // Tempatkan div container ke dalam '.document-container'
  //           $('.show-data').append(containerDocument );
  //           $('.show-data').append(containerNote );
  //           $('.show-data').append(containerVerify );
  //         });
  //       }
        
  //     });
  
  // }

//   var detailPatient = (selectedData) => {

//     $('.btn-unver').addClass('d-none');
//     $('.btn-ver').addClass('d-none');
//     $('.btn-ungrouping').addClass('d-none');
//     $('.btn-grouping').addClass('d-none');

//     const patient_name = selectedData.patient_name;
//     const sep = selectedData.no_sep;
//     const patient_id = selectedData.id;
//     const statusVal = selectedData.status_val ;
//     const statusVer = selectedData.status_ver ;
//     const statusGrouping = selectedData.status_grouping ;
//     const medrec = selectedData.medrec;
//     const birthdate = selectedData.birthdate;
//     const gender = selectedData.gender;
//     const note_admin = selectedData.note_admin;
//     const note_jkn = selectedData.note_jkn;
    
//     $("#update-status-doc-patient-id").val(patient_id);
  


//     $('#patient-id').val(patient_id);
//     $(".name-detail").html(patient_name);
//     $(".sep-detail").html(sep);
//     $(".medrec-detail").html(medrec);
//     $(".gender-detail").html(gender);
//     $(".birthdate-detail").html(birthdate);
//     $(".catatan-pengajuan-detail").html(note_admin);
//     $(".catatan-jkn-detail").html(note_jkn);


//     $(".btn-unver").data('patient-id', patient_id);
//     $(".btn-ver").data('patient-id', patient_id);
//     $(".btn-ungrouping").data('patient-id', patient_id);
//     $(".btn-grouping").data('patient-id', patient_id);

//   if(statusVer === 1){
//       $('.btn-unver').removeClass('d-none');
//       $('.btn-grouping').removeClass('d-none');

//     } else {
//       $('.btn-ver').removeClass('d-none');
    
//     }

//     if(statusGrouping === 1){
//       $('.btn-ungrouping').removeClass('d-none');
//       $('.btn-unver').addClass('d-none');
     
//       } 
   
    
// }


var detailDocument = (selectedData) => {
  $('.detailDocument').on('click', function(e) {
    e.preventDefault();
    $('#detailDocument-modal').modal('show');
    const patient_name = selectedData.patient_name;
    const sep = selectedData.no_sep;
    const medrec = selectedData.medrec;
    const order = selectedData.no_order;

   

    $(".name-detail").html(patient_name);
    $(".sep-detail").html(sep);
    $(".medrec-detail").html(medrec);
    $(".order-detail").html(order);

});
}

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

  $('body').on('click', '.editDocument', function(e) {
    
    const transactionId = $(this).data('patient-id');

    $('#edit-doc_note_sub').prop('disabled', false); 
    $('#edit-doc_note_val').prop('disabled', false);
    $('#edit-doc_note_ver').prop('disabled', false);
    $('.label-revisi').addClass('d-none');
    $('.input-revisi').addClass('d-none');
    $('.btn-edit-revisi').addClass('d-none');
    $('.btn-revisi-doc').removeClass('d-none');
    $('.btn-verifikasi').removeClass('d-none');
    $('#edit-doc_note_ver').removeClass('d-none');
    $('.edit-doc_note_ver-label').removeClass('d-none');

  $.get("dashboard-jkn/edit-document/" + transactionId,
    function (data, textStatus, jqXHR) {
   

      $('#editDocument-modal').modal('show');

      $("#edit-doc-id").data('doc-id', data[0].id);
      $("#edit-doc-id").data('patient-id', data[0].patient_id);


      $('#edit-document').val(data[0].doc_name);

      let link = '/storage/' + data[0].file;
      let doc_file_name = data[0].file_name;
  
      let linkElement = `<a href="${link}"><small style="font-style:italic;">${doc_file_name}</small></a>`;
      $("#doc-file-name").html(linkElement);
    

      if(  data[0].doc_status == 'Diajukan'){
        $('.doc-status').html(`<span class="badge bg-warning">${data[0].doc_status}</span>`);

        $('#edit-doc_note_sub').prop('disabled', true); 
      } else if( data[0].doc_status == 'Verifikasi') {
        $('.doc-status').html(`<span class="badge bg-info">${data[0].doc_status}</span>`);
        $('#edit-doc_note_sub').prop('disabled', true); 
      }else if( data[0].doc_status == 'Grouping'){
        $('.doc-status').html(`<span class="badge bg-success">${data[0].doc_status}</span>`);
        $('#edit-doc_note_sub').prop('disabled', true); 
        $('#edit-doc_note_val').prop('disabled', true);
        $('#edit-doc_note_ver').prop('disabled', true);
      } else if( data[0].doc_status == 'Revisi'){
        $('.doc-status').html(`<span class="badge bg-danger">${data[0].doc_status}</span>`);
        $('.label-revisi').removeClass('d-none');
        $('.input-revisi').removeClass('d-none');
        $('.btn-edit-revisi').removeClass('d-none');


        $('.btn-revisi-doc').addClass('d-none');
        $('.btn-verifikasi').addClass('d-none');
        $('.btn-verifikasi').addClass('d-none');
        $('#edit-doc_note_ver').addClass('d-none');
        $('.edit-doc_note_ver-label').addClass('d-none');


        $('#edit-doc_note_revisi').val(data[0].doc_note_revisi);
        $('#edit-doc_note_sub').prop('disabled', true); 
        $('#edit-doc_note_val').prop('disabled', true);
        $('#edit-doc_note_ver').prop('disabled', true);
      }
      
      $('#edit-doc_note_sub').val(data[0].doc_note_sub);
      $('#edit-doc_note_ver').val(data[0].doc_note_ver);
      $('#edit-doc_note_val').val(data[0].doc_note_val);
  
    }
  );
  });



  $('body').on('click', '.revisiDocument', function(e) {
    
    const transactionId = $(this).data('id');

    // alert(transactionId);

    $('#edit-doc_note_sub').prop('disabled', false); 
    $('#edit-doc_note_val').prop('disabled', false);
    $('#edit-doc_note_ver').prop('disabled', false);
    $('.label-revisi').addClass('d-none');
    $('.input-revisi').addClass('d-none');
    $('.btn-edit-revisi').addClass('d-none');
    $('.btn-revisi-doc').removeClass('d-none');
    $('.btn-verifikasi').removeClass('d-none');

  $.get("dashboard-jkn/edit-document/" + transactionId,
    function (data, textStatus, jqXHR) {
   
      console.log(data);
      $('#revisi-modal').modal('show');

     
      $("#revisi-doc-id").data('patient-id', data[0].id);
  

    }
  );
  });




  $('body').on('click', '.patientAction', function(e) {
    
    const docId= $(this).data('id');
    const patientId= $(this).data('patient-id');
    const verifikasi = $(this).data('verifikasi');



    var verify = {
      ver : verifikasi,
      patientId : patientId
      
    };

    $.ajax({
      type: "put",
      url: "dashboard-jkn/update-ver/" + docId,
      data: verify,
      dataType: "json",
      success: function (response) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Validation updated successfully',
          showConfirmButton: false,
          timer: 3000
        })
          
        hs.ajax.reload();
        dt.ajax.reload();
        
      }
    });
  });


  $('body').on('click', '.btn-selesai', function(e) {
    
    const docId= $(this).data('id');
    const patientId= $(this).data('patient-id');
    const verifikasi = $(this).data('verifikasi');

// alert('dasda');

    // var verify = {
    //   ver : verifikasi,
    //   patientId : patientId
      
    // };

    // $.ajax({
    //   type: "put",
    //   url: "dashboard-jkn/update-ver/" + docId,
    //   data: verify,
    //   dataType: "json",
    //   success: function (response) {
    //     Swal.fire({
    //       position: 'top-end',
    //       icon: 'success',
    //       title: 'Validation updated successfully',
    //       showConfirmButton: false,
    //       timer: 3000
    //     })
          
    //     hs.ajax.reload();
    //     dt.ajax.reload();
        
    //   }
    // });
  });


  $('body').on('click', '.deleteDocument', function(e) {
    
    const docId = $(this).data('id');

   

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {

        $.ajax({
          type: "delete",
          url: "dashboard-jkn/delete-document/" + docId,
          success: function (response) {
            hs.ajax.reload();
            dt.ajax.reload();
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          );
      }
    });

  

      }
    });
  });


  $('.btn-revisi-doc').click(function(e){
    e.preventDefault();
 

    const patientId = $('#revisi-doc-id').data('patient-id');

// alert(docId );

   var form  = $('#form-revisi');
 
    var formEdit = {
      note: $('#note_revisi').val(),
    
  };


$.ajax({
  type: "put",
  url: "dashboard-jkn/revisi-document/" + patientId,
  data: formEdit,
  dataType: "json",
  success: function (response) {
    $('#revisi-modal').modal('hide');
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Data Revisi Berhasil disimpan',
      showConfirmButton: false,
      timer: 3000
    })
    form.trigger('reset');
      dt.ajax.reload();
    hs.ajax.reload();
    
  }
});



  });



  $('.btn-edit-revisi').click(function(e){
    e.preventDefault();
    const docId = $('#edit-doc-id').data('doc-id');
    const patientId = $('#edit-doc-id').data('patient-id');

   var form  = $('#form-edit');
 
    var formEdit = {
      note: $('#edit-note').val(),
      doc: $('#edit-doc_note_revisi').val(),
      patient_id : patientId
  };


$.ajax({
  type: "put",
  url: "dashboard-jkn/edit-revisi-document/" + docId,
  data: formEdit,
  dataType: "json",
  success: function (response) {
    $('#editDocument-modal').modal('hide');
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Data Revisi Berhasil di ubah',
      showConfirmButton: false,
      timer: 3000
    })
    form.trigger('reset');
      
    hs.ajax.reload();
    
  }
});



  });

  $('.btn-verifikasi').click(function(e){
    e.preventDefault();
    const docId = $('#edit-doc-id').data('doc-id');
    const patientId = $('#edit-doc-id').data('patient-id');

   var form  = $('#form-edit');
 
    var formEdit = {
      note: $('#edit-note').val(),
      doc: $('#edit-doc_note_ver').val(),
      patient_id : patientId
  };


$.ajax({
  type: "put",
  url: "dashboard-jkn/validasi-note-document/" + docId,
  data: formEdit,
  dataType: "json",
  success: function (response) {
    $('#editDocument-modal').modal('hide');
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Data Revisi Berhasil di ubah',
      showConfirmButton: false,
      timer: 3000
    })
    form.trigger('reset');
      
    hs.ajax.reload();
    
  }
});



  });

  var toastMixin = Swal.mixin({
    toast: true,
    icon: 'success',
    title: 'General Title',
    animation: false,
    position: 'top-right',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });




  function checkCheckbox() {
    let check = true;
    $('.verifikasi-checkbox').each(function(i, elem) {
      if (!$(elem).is(':checked')) {
        check = false;
      }
    });
    
    $('.validasi-checkbox').each(function(i, elem) {
      if (!$(elem).is(':checked')) {
        check = false;
      }
    });
  
    return check;
  }


  $('#form-create').submit(function (e) {

    e.preventDefault();
  
  
  
    if (!checkCheckbox()) {
      alert("INVALID");
      return;
    }
    
  
  
    const patientId =  $('#patient-id').val();
  
  
  
    if (patientId === '') {
      alert("Patient harus dipilih terlebih dahulu");
      return;
    }
  
    $('#submitButton').prop('disabled', true);
  
    var formData = new FormData(this);
    var form =  $('#form-create');
  
    $.ajax({
      type: "post",
      url: "dashboard-jkn/create-data",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
    
      success: function (res) {
        toastMixin.fire({
          animation: true,
          title: 'Data saved successfully'
        });
       
        form.trigger('reset');
        $('#submitButton').prop('disabled', false);
        $('.new-input').remove();
  
        hs.ajax.reload();
        dt.ajax.reload();
        selectedPatient.addClass('selected');
  
        // reset detail document
        // $('#patient-id').val('');
        // $(".name-detail").html('-');
        // $(".sep-detail").html('-');
        // $(".detail-pasien").html('-');
        
    
   
      },
      error: function (xhr, status, error) {
        var errorMessage = "Terjadi kesalahan: " + xhr.status + " - " + xhr.statusText;
       
        toastMixin.fire({
          title: 'Document Required!',
          icon: 'error'
        });
  
        $('#submitButton').prop('disabled', false);
  
        console.log(errorMessage);
    
    }
    });
    
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
    $('.btn-ver').on('click', function(e) {

      const patientId = $(this).data('patient-id');
      const statusVer = $(this).data('status-ver');
  


      var ver = {
        status_ver : statusVer
      };
    
      $.ajax({
        type: "put",
        url: "dashboard-jkn/update-ver-all/" + patientId,
        data: ver,
        dataType: "json",
        success: function (res) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Verifikasi Semua Sukses!',
            showConfirmButton: false,
            timer: 3000
          })
            
          hs.ajax.reload();
          dt.ajax.reload();

          $('.btn-ver').addClass('d-none');
            $('.btn-unver').removeClass('d-none');
            $('.btn-grouping').removeClass('d-none');
         
      

        }
      });
    
    });


    $('.btn-unver').on('click', function(e) {

      const patientId = $(this).data('patient-id');
      const statusVer = $(this).data('status-ver');
  
  
  

      var ver = {
        status_ver : statusVer
      };
    
      $.ajax({
        type: "put",
        url: "dashboard-jkn/update-ver-all/" + patientId,
        data: ver,
        dataType: "json",
        success: function (res) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Verikasi Berhasil Diubah!',
            showConfirmButton: false,
            timer: 3000
          })
            
          hs.ajax.reload();
          dt.ajax.reload();

          $('.btn-ver').removeClass('d-none');
          $('.btn-unver').addClass('d-none');
          $('.btn-grouping').addClass('d-none');

        }
      });
    
    });


    $('body').on('click', '.btn-grouping', function(e) {

      // alert('Hiiii');

      const patientId = $(this).data('id');
      const statusGrouping = $(this).data('status-grouping');
      var grouping = {
        status_grouping : statusGrouping
      };
    
      $.ajax({
        type: "put",
        url: "dashboard-jkn/update-grouping-all/" + patientId,
        data: grouping,
        dataType: "json",
        success: function (res) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Grouping all updated successfully',
            showConfirmButton: false,
            timer: 3000
          })
            
          hs.ajax.reload();
          dt.ajax.reload();
            $('.btn-unver').addClass('d-none');
            $('.btn-grouping').addClass('d-none');
            $('.btn-ungrouping').removeClass('d-none');
        }
      });
    
    });


    $('.btn-ungrouping').on('click', function(e) {
      const patientId = $(this).data('patient-id');
      const statusGrouping = $(this).data('status-grouping');
      var grouping = {
        status_grouping : statusGrouping
      };
    
      $.ajax({
        type: "put",
        url: "dashboard-jkn/update-grouping-all/" + patientId,
        data: grouping,
        dataType: "json",
        success: function (res) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Grouping all updated successfully',
            showConfirmButton: false,
            timer: 3000
          })
            
          hs.ajax.reload();
          dt.ajax.reload();

            $('.btn-unver').removeClass('d-none');
            $('.btn-grouping').removeClass('d-none');
            $('.btn-ungrouping').addClass('d-none');
         
      

        }
      });
    
    });

    $("#selesai-btn, #arsipkan-btn").on('click', function(e) {
      let status = $(this).data('action');
      const patientId = $(this).data('patient-id');
      $.ajax({
        type: "put",
        url: "dashboard-jkn/update-status-document/" + patientId,
        data: {
          status: status
        },
        success: function (response) {
          hs.ajax.reload();
          dt.ajax.reload();
          Swal.fire(
          'Updated!',
          'Status dokumen pasien berhasil diubah',
          'success'
          );
        }
      });
    });


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

var columnsDataTableArsip = [
 
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
{data: 'action' , name : 'action', className: 'text-center'}


];


  var initDatatableArsip = () => {
    const searchParams = new URLSearchParams(window.location.search);
    // const date_from = searchParams.get('date_from');
    // const date_to = searchParams.get('date_to');
    // const room = searchParams.get('room');
    // const jenis_room = searchParams.get('jenis_room');
    

      let datatableUrl = '/datatable-arsip?' + searchParams;
      dtArsip =  $('.datatable-arsip').DataTable({
      paging: false,
      scrollY: '400px',
      scrollX: false,
      select: {
        style: 'single'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: datatableUrl, 
      columns: columnsDataTableArsip,
      language: {
        processing: '<div class="loading-indicator">Loading...</div>'
    },
      
  
   
  });





  }



document.addEventListener('DOMContentLoaded', function () {

initDatatable();
initDatatableArsip();
// detailPatient();
detailDocument();
// docDetail();
historyPatient();
// filterEventHandler();
customDate();

});