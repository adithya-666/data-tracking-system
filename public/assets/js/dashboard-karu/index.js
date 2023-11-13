

var dt;

var hs = null;
var selectorName = '.datatable-ajax';

var columnsDataTable = [

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
{data: 'insurance' , className: 'text-start'},
{data: 'doc_status_patient' , className: 'text-start',
render: function (data, type, row, meta) {
var status = ``;
if( row.doc_patient && row.doc_status_patient == 'Diajukan'){
  var status = `<span class="badge bg-warning">${row.doc_status_patient}</span>`;
} else if(row.doc_patient && row.doc_status_patient == 'Verifikasi') {
  var status = `<span class="badge bg-info">${row.doc_status_patient}</span>`;
}else if(row.doc_patient && row.doc_status_patient == 'Validasi'){
  var status = `<span class="badge bg-primary">${row.doc_status_patient}</span>`;
} else if(row.doc_patient && row.doc_status_patient == 'Grouping'){
  var status = `<span class="badge bg-success">${row.doc_status_patient}</span>`;
} else if(row.doc_patient && row.doc_status_patient == 'Revisi'){
  var status = `<span class="badge bg-danger">${row.doc_status_patient}</span>`;
}

return status;
}
},
  {data: 'action' , name : 'action', className: 'text-center'}


];

  var initDatatable = () => {
    const searchParams = new URLSearchParams(window.location.search);
    const date_from = searchParams.get('date_from');
    const date_to = searchParams.get('date_to');
    if (date_from != '' && date_to != '') {
      datatableUrl = 'dashboard-karu/datatable?date_from=' + date_from + '&' + 'date_to=' + date_to;
    } else {
      datatableUrl = 'dashboard-karu/datatable';
    }

  dt =  $(selectorName).DataTable({
      paging: false,
      scrollY: '400px',
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
        "defaultContent": "-",
        "targets": "_all"
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

    
        detailPatient(selectedData);
        detailDocument(selectedData);
        docDetail(selectedData);
        historyPatient(selectedData);
        checkStatus(selectedData);
      
  console.log(selectedData);
        // alert(selectedTransactionId);

});


  }


  var columnsHistoryPatient = [

    {data: 'doc_name', className: 'text-center'},
    {data: 'doc_status' , className: 'text-center',
render: function (data, type, row, meta) {
  var status = ``;
  if( row.doc_status && row.doc_status == 'Diajukan'){
    var status = `<span class="badge bg-warning">${row.doc_status}</span>`;
  } else if(row.doc_status && row.doc_status == 'Verifikasi'){
    var status = `<span class="badge bg-info">${row.doc_status}</span>`;
  } else if (row.doc_status && row.doc_status == 'Validasi'){
    var status = `<span class="badge bg-primary">${row.doc_status}</span>`;
  }  else if (row.doc_status && row.doc_status == 'Grouping'){
    var status = `<span class="badge bg-success">${row.doc_status}</span>`;
  }  else if (row.doc_status && row.doc_status == 'Revisi'){
    var status = `<span class="badge bg-danger">${row.doc_status}</span>`;
  }
  
  return status;
}
    },
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
      ajax: 'dashboard-karu/history-patient/' + patientId,
      columns: columnsHistoryPatient,
      language: {
        processing: '<div class="loading-indicator">Loading...</div>'
    },
      columnDefs: [{
        "defaultContent": "-",
        "targets": "_all"
      }]

   
  
   
  });



//     hs.on('click', 'tr', function () {
//     const selectedDataDocument = hs.row(this).data();
//     if (selectedDataDocument) {
      

  
//         // editDocument(selectedDataDocument);
//         alert(selectedDataDocument.doc_name);
//     }
// });
    
  }





  var docDetail = (selectedData) => {

    $('.show-data').empty();
  
  
    const patientId = selectedData.id ;

  

      $.ajax({
        method: "GET",
        url: "dashboard-karu/document-detail/" + patientId,
        success: function (res) {
    
      
          $('.document-container').removeClass('d-none');
          // $.each(collection, function (indexInArray, valueOfElement) { 
            
          // });
          $.each(res.data, function (index, item) {


            // Buat elemen checkbox
              var checkboxInput = $('<input>', {
                type: 'checkbox',
                name: 'verification[]', // Nama yang akan digunakan saat mengirimkan data
                value: item.doc_name, // Nilai yang ingin Anda kaitkan dengan checkbox
                class: 'form-check-input mb-3'
              });

              // Buat elemen label untuk checkbox
              var checkboxLabel = $('<label>', {
                for: 'verification-' + index, // ID unik untuk elemen label
                class: 'form-check-label mb-3',
                text: 'Verify' // Teks label untuk verifikasi
              });


            var documentLabel = $('<label>', {
              for: 'document-detail-' + index, // ID unik untuk elemen input
              class: 'form-label',
              text: 'Document' // Teks label
            });


            var noteLabel = $('<label>', {
              for: 'note-detail-' + index, // ID unik untuk elemen textarea
              class: 'form-label',
              text: 'Note' // Teks label
            });

            // Buat elemen input untuk document
            var documentInput = $('<input>', {
              type: 'text',
              name: 'document[]',
              class: 'form-control document-detail mb-3',
              value: item.doc_name, // Isi dengan data yang diterima
              required: true
            });
      
           // Buat elemen textarea untuk note
      var noteTextarea = $('<textarea>', {
        class: 'form-control note-detail mb-3',
        name: 'note[]',
        style: 'height: 20px'
      });

      // Isi nilai pada elemen textarea
          noteTextarea.val(item.doc_note_sub);
      
            // Buat div kontainer untuk elemen input dan textarea
            var containerDocument = $('<div>').addClass('col-lg-5');
            containerDocument .append(documentLabel, documentInput);

            var containerNote = $('<div>').addClass('col-lg-5');
            containerNote.append(noteLabel, noteTextarea);


            var containerVerify = $('<div>').addClass('col-lg-2');
            containerVerify.append(checkboxLabel, checkboxInput);
      
            // Tempatkan div container ke dalam '.document-container'
            $('.show-data').append(containerDocument );
            $('.show-data').append(containerNote );
            $('.show-data').append(containerVerify );
          });
        }
        
      });
  
  }

  var detailPatient = (selectedData) => {

    $('.btn-unverify').addClass('d-none');
    $('.btn-verify').addClass('d-none');

    const patient_name = selectedData.patient_name;
    const sep = selectedData.no_sep;
    const patient_id = selectedData.id;
    const statusVer = selectedData.status_ver ;
    const medrec = selectedData.medrec;
    const birthdate = selectedData.birthdate;
    const gender = selectedData.gender;




    $('#patient-id').val(patient_id);
    $(".name-detail").html(patient_name);
    $(".sep-detail").html(sep);
    $(".medrec-detail").html(medrec);
    $(".gender-detail").html(gender);
    $(".birthdate-detail").html(birthdate);
    

    $(".btn-unverify").data('patient-id', patient_id);
    $(".btn-verify").data('patient-id', patient_id);

  if(statusVer === 1){
      $('.btn-unverify').removeClass('d-none');
    } else {
      $('.btn-verify').removeClass('d-none');
    }
   

}



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


var checkStatus = (selectedData) => {

var patientId = selectedData.id;

  $.get("dashboard-karu/check-status/" + patientId, 
    function (data, textStatus, jqXHR) {

      console.log(data);
      
    }
  );

}


$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

var filterEventHandler = () => {
  let submissionFilterBtn = $("#filter-submission-btn");
  let validatedFilterBtn = $("#filter-validasi-btn");
  let verifikasiFilterBtn = $("#filter-verifikasi-btn");
  let groupingFilterBtn = $("#filter-grouping-btn");
  let revisiFilterBtn = $("#filter-revisi-btn");
  let submissionBadge = $("#submission-badge");

  const searchParams = new URLSearchParams(window.location.search);
    const date_from = searchParams.get('date_from');
    const date_to = searchParams.get('date_to');
    var datatableUrl = '';
    if (date_from != '' && date_to != '') {
      datatableUrl = '/dashboard-karu/datatable?search=true&date_from=' + date_from + '&' + 'date_to=' + date_to;
    } else {
      datatableUrl = '/dashboard-karu/datatable?search=true';
    }

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
}

$(document).ready(function() {

  $('body').on('click', '.editDocument', function(e) {
    
    const transactionId = $(this).data('patient-id');

    $('#edit-doc_note_sub').prop('disabled', false); 
    $('#edit-doc_note_val').prop('disabled', false);
    $('#edit-doc_note_ver').prop('disabled', false);

  $.get("dashboard-karu/edit-document/" + transactionId,
    function (data, textStatus, jqXHR) {
   

      $('#editDocument-modal').modal('show');
      $("#edit-doc-id").data('doc-id', data[0].id);
      $('#edit-document').val(data[0].doc_name);

      if(  data[0].doc_status == 'Diajukan'){
        $('.doc-status').html(`<span class="badge bg-warning">${data[0].doc_status}</span>`);
        $('#edit-doc_note_sub').prop('disabled', true);
        $('#edit-doc_note_ver').prop('disabled', false); 
        $('#edit-doc_note_val').prop('disabled', true); 
      } else if( data[0].doc_status == 'Verifikasi') {
        $('.doc-status').html(`<span class="badge bg-info">${data[0].doc_status}</span>`);
        $('#edit-doc_note_sub').prop('disabled', true); 
        $('#edit-doc_note_val').prop('disabled', true);
      }else if( data[0].doc_status == 'Validasi'){
        $('.doc-status').html(`<span class="badge bg-primary">${data[0].doc_status}</span>`);
        $('#edit-doc_note_sub').prop('disabled', true); 
        $('#edit-doc_note_ver').prop('disabled', true);
      } else if( data[0].doc_status == 'Grouping'){
        $('.doc-status').html(`<span class="badge bg-success">${data[0].doc_status}</span>`);
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


  $('body').on('click', '.verifikasiDocument', function(e) {
    
    const docId= $(this).data('id');
    const patientId= $(this).data('patient-id');
    const verifikasi = $(this).data('verifikasi');


    var verify = {
      verify : verifikasi,
      patientId : patientId
      
    };

    $.ajax({
      type: "put",
      url: "dashboard-karu/update-verify/" + docId,
      data: verify,
      dataType: "json",
      success: function (response) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Verify updated successfully',
          showConfirmButton: false,
          timer: 3000
        })
          
        hs.ajax.reload();
        dt.ajax.reload();
        
      }
    });
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
          url: "dashboard-karu/delete-document/" + docId,
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


  $('#form-edit').submit(function(e){
    e.preventDefault();


   var form  = $('#form-edit');
 
    var formEdit = {
      note: $('#edit-doc_note_ver').val(),
      doc: $('#edit-document').val()
  };
    const docId = $('#edit-doc-id').data('doc-id');

$.ajax({
  type: "put",
  url: "dashboard-karu/update-document/" + docId,
  data: formEdit,
  dataType: "json",
  success: function (response) {
    $('#editDocument-modal').modal('hide');
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Data updated successfully',
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
  alert("Patient harus dipilih terlebih dahuluuu");
  return;
}

$('#submitButton').prop('disabled', true);

  var formData =  $('#form-create').serialize();
  var form =  $('#form-create');



  $.ajax({
    type: "post",
    url: "dashboard-karu/create-data",
    data: formData,
    dataType: "json",
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

      // reset detail document
      $('#patient-id').val('');
      $(".name-detail").html('-');
      $(".sep-detail").html('-');

 
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

filterEventHandler();



    // console.log(patientId );
    $('.btn-verify').on('click', function(e) {

      const patientId = $(this).data('patient-id');
      const statusVer = $(this).data('status-ver');
  


      var verify = {
        status_verify : statusVer
      };
    
      $.ajax({
        type: "put",
        url: "dashboard-karu/update-verify-all/" + patientId,
        data: verify,
        dataType: "json",
        success: function (res) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Verify all updated successfully',
            showConfirmButton: false,
            timer: 3000
          })
            
          hs.ajax.reload();
          dt.ajax.reload();

          $('.btn-verify').addClass('d-none');
            $('.btn-unverify').removeClass('d-none');
       
         
      

        }
      });
    
    });


    $('.btn-unverify').on('click', function(e) {

      const patientId = $(this).data('patient-id');
      const statusVer = $(this).data('status-ver');
  
  
  

      var verify = {
        status_verify : statusVer
      };
    
      $.ajax({
        type: "put",
        url: "dashboard-karu/update-verify-all/" + patientId,
        data: verify,
        dataType: "json",
        success: function (res) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Verify all updated successfully',
            showConfirmButton: false,
            timer: 3000
          })
            
          hs.ajax.reload();
          dt.ajax.reload();

          $('.btn-verify').removeClass('d-none');
          $('.btn-unverify').addClass('d-none');

        }
      });
    
    });

  
  
    


  

});




 


document.addEventListener('DOMContentLoaded', function () {

initDatatable();

detailPatient();
detailDocument();
docDetail();
historyPatient();
checkStatus();
filterEventHandler();


});