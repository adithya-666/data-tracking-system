

var dt;

var hs = null;
var selectorName = '.datatable-ajax';
var selectedPatient = null;



var date = () => {
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
  const newUrl = 'dashboard/datatable?date_from=' + startDate + '&date_to=' + endDate;
  dt.ajax.url(newUrl).load();
});

$('#apply-date-range').on('click', function() {
  dateRangePicker.data('daterangepicker').show();
});

$('#clear-date-range').on('click', function() {
  dateRangePicker.val(''); 
  dateRangePicker.data('daterangepicker').setStartDate('');
  dateRangePicker.data('daterangepicker').setEndDate('');
});
}

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
{data: 'doc_patient.doc_status' , className: 'text-start',
render: function (data, type, row, meta) {
  var status = ``;
  if(  row.doc_status_patient == 'Diajukan'){
    var status = `<span class="badge bg-warning">${row.doc_status_patient}</span>`;
  } else if( row.doc_status_patient == 'Verifikasi') {
    var status = `<span class="badge bg-info">${row.doc_status_patient}</span>`;
  }else if( row.doc_status_patient == 'Upload'){
    var status = `<span class="badge bg-primary">${row.doc_status_patient}</span>`;
  } else if( row.doc_status_patient == 'Grouping'){
    var status = `<span class="badge bg-success">${row.doc_status_patient}</span>`;
  } else if( row.doc_status_patient == 'Revisi'){
    var status = `<span class="badge bg-danger">${row.doc_status_patient}</span>`;
  }  else if( row.doc_status_patient == 'Diajukan ulang'){
    var status = `<span class="badge badge-diajukan">${row.doc_status_patient}</span>`;
   }   else if (row.doc_status_patient == 'Selesai'){
    var status = `<span class="badge bg-success  ">${row.doc_status_patient}</span>`;
  } 
  else if( row.doc_status_patient  != null){
    var status = `<span class="badge bg-secondary">${row.doc_status_patient}</span>`;
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
      datatableUrl = 'dashboard/datatable?date_from=' + date_from + '&' + 'date_to=' + date_to;
    } else {
      datatableUrl = 'dashboard/datatable';
    }
  dt =  $(selectorName).DataTable({
      paging: false,
      scrollY: '400px',
      scrollX: false,
      select: {
        style: 'os'
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
      selectedPatient = $(this);
    
        detailPatient(selectedData);
        detailDocument(selectedData);
        // docDetail(selectedData);
        historyPatient(selectedData);
        // alert(selectedTransactionId);

});


  }


  var columnsHistoryPatient = [

    {data: 'doc_name', className: 'text-center'},
    {data: 'doc_status' , className: 'text-center',
    render: function (data, type, row, meta) {
      var status = ``;
      if(  row.doc_status == 'Diajukan'){
        var status = `<span class="badge bg-warning">${row.doc_status}</span>`;
      } else if(row.doc_status == 'Verifikasi'){
        var status = `<span class="badge bg-info">${row.doc_status}</span>`;
      } else if (row.doc_status == 'Upload'){
        var status = `<span class="badge bg-primary">${row.doc_status}</span>`;
      }  else if (row.doc_status == 'Grouping'){
        var status = `<span class="badge bg-success">${row.doc_status}</span>`;
      } else if (row.doc_status == 'Revisi'){
        var status = `<span class="badge bg-danger  ">${row.doc_status}</span>`;
      } else if (row.doc_status == 'Selesai'){
        var status = `<span class="badge bg-success  ">${row.doc_status}</span>`;
      } 
      else {
        var status = `<span class="badge bg-secondary  ">${row.doc_status}</span>`;
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
      ajax: 'dashboard/history-patient/' + patientId,
      columns: columnsHistoryPatient,
      language: {
        processing: '<div class="loading-indicator">Loading...</div>'
    },
      columnDefs: [{
        "defaultContent": "-",
        "targets": "_all"
      }]

   
  
   
  });



//     hs.on('click', 'td', function () {
//     const selectedDataDocument = hs.row(this).data();
//     if (selectedDataDocument) {
  
  
//         editDocument(selectedDataDocument);
//         // alert(selectedTransactionId);
//     }
// });
    
  }






  // var docDetail = (selectedData) => {

  //   $('.show-edit').empty();
  
  
  //   const patientId = selectedData.id ;

  //   alert(patientId);

  //     $.ajax({
  //       method: "GET",
  //       url: "dashboard/document-detail/" + patientId,
  //       success: function (res) {
  //         console.log(res.data);

      
  //         $('.document-container').removeClass('d-none');
  //         // $.each(collection, function (indexInArray, valueOfElement) { 
            
  //         // });
  //         $.each(res.data, function (index, item) {

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
  //           var containerDocument = $('<div>').addClass('col-lg-6');
  //           containerDocument .append(documentLabel, documentInput);

  //           var containerNote = $('<div>').addClass('col-lg-6');
  //           containerNote .append(noteLabel, noteTextarea);
      
  //           // Tempatkan div container ke dalam '.document-container'
  //           $('.show-edit').append(containerDocument );
  //           $('.show-edit').append(containerNote );
  //         });
  //       }
        
  //     });
  
  // }

  var detailPatient = (selectedData) => {
    const patient_name = selectedData.patient_name;
    const sep = selectedData.no_sep;
    const patient_id = selectedData.id;
    const medrec = selectedData.medrec;
    const birthdate = selectedData.birthdate;
    const gender = selectedData.gender;
    const note_revisi = selectedData.note_revisi;

  
    // nama-pasien ketika pindah
    $("#nama-pasien-pindah").html(patient_name);
    $("#medrec-pasien-pindah").html(medrec);
    $("#pindah-pasien-id").val(patient_id);

    $('#patient-id').val(patient_id);
    $(".name-detail").html(patient_name);
    $(".sep-detail").html(sep);
    $(".medrec-detail").html(medrec);
    $(".gender-detail").html(gender);
    $(".birthdate-detail").html(birthdate);
    $('.revisi-detail').html(note_revisi);
}


var detailDocument = (selectedData) => {
  $('.detailDocument').on('click', function(e) {
    e.preventDefault();
    $('#detailDocument-modal').modal('show');
    const patient_name = selectedData.patient_name;
    const sep = selectedData.no_sep;
    const medrec = selectedData.medrec;
    const doctor = selectedData.doctor;
    const gender = selectedData.gender;
    const room = selectedData.room;
    const date_in = selectedData.date_in;

    const patient_id = selectedData.id;
    const doc_status_patient = selectedData.doc_status_patient;
  

    // alert(doc_status_patient);

    $('#detail-patient-id').val(patient_id);
    $('#edit-status-baru').val(doc_status_patient);
  

    $(".name-detail").html(patient_name);
    $(".sep-detail").html(sep);
    $(".medrec-detail").html(medrec);
    $(".room-detail").html(room);
    $(".gender-detail").html(gender);
    $(".doctor-detail").html(doctor);
    $(".date_in-detail").html(date_in);

});
}

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  var addInput = () => {

    var btnInput = document.getElementById('addInput');

    btnInput.addEventListener('click', function() {
      const form = document.getElementById('form-create');
      const newInput = document.createElement('div');
      newInput.classList.add('mb-3', 'new-input');
      newInput.innerHTML = `
      <div class="row">
      <div class="col-lg-5">
      <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Dokumen <span class="important">*</span></label>
      <input type="text" id="document" name="document[]" class="form-control" id="exampleFormControlInput1">
    </div>
      </div>
      <div class="col-lg-5">
        <div class="mb-3">
          <label for="formFileMultiple" class="form-label">Upload File</label>
          <input class="form-control" id="upload_file" name="file[]"  type="file" id="formFileMultiple" multiple>
        </div>
      </div>
      <div class="col-lg-2">
      <div class="mb-3">
      <button type="button" class="btn btn-danger delete-input"><i class="bi bi-trash"></i></button>
      </div>
      </div>
     </div>
      `;
    
      const addInformation = document.querySelector('.add-information');
      addInformation.parentNode.insertBefore(newInput, addInformation);

      setTimeout(function() {
        newInput.style.opacity = 1;
    
    }, 10);




 // Menangani penghapusan inputan saat tombol "Delete" ditekan
 const deleteButton = newInput.querySelector('.delete-input');
 deleteButton.addEventListener('click', function () {
   // Menghapus elemen input beserta elemennya yang mengelilingi
   newInput.parentNode.removeChild(newInput);
 });


  });
}




$(document).ready(function() {

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

  $('body').on('click', '.revisiDocument', function(e) {
    
    const transactionId = $(this).data('patient-id');

    $('#revisi_doc_note_sub').prop('disabled', false); 
    $('#revisi_doc_note_val').prop('disabled', false);
    $('#revisi_doc_note_ver').prop('disabled', false);
    $('.label-revisi').addClass('d-none');
    $('.input-revisi').addClass('d-none');
    $('.btn-validasi').removeClass('d-none');

  $.get("dashboard/edit-document/" + transactionId,
    function (data, textStatus, jqXHR) {
      $('#revisiDocument-modal').modal('show');

      $("#revisi-doc-id").data('revisi-doc-id', data[0].id);
      $("#revisi-doc-id").data('revisi-patient-id', data[0].patient_id);


      $('#revisi_doc').val(data[0].doc_name);
      console.log(data[0]);
      let link = '/storage/' + data[0].file;
      let doc_file_name = data[0].file_name;
      let linkElement = `<a href="${link}"><small style="font-style:italic;">${doc_file_name}</small></a>`;
      $("#doc-file-name").html(linkElement);

      if(  data[0].doc_status == 'Diajukan'){
        $('.doc-status').html(`<span class="badge bg-warning">${data[0].doc_status}</span>`);
        $('#revisi_doc_note_ver').prop('disabled', true); 
        $('#revisi_doc_note_val').prop('disabled', true); 
        $('#revisi_doc_note_sub').prop('disabled', false); 
        $('.doc-time').html(data[0].doc_time_sub);
        $('.doc-time-name').html('Tanggal Diajukan');
      } else if( data[0].doc_status == 'Verifikasi') {
        $('.doc-status').html(`<span class="badge bg-info">${data[0].doc_status}</span>`);
        $('#revisi_doc_note_sub').prop('disabled', true); 
        $('#revisi_doc_note_ver').prop('disabled', true);
        $('.doc-time-name').html('Tanggal Verifikasi');
        $('.doc-time').html(data[0].doc_time_ver);
      }else if( data[0].doc_status == 'Validasi'){
        $('.doc-status').html(`<span class="badge bg-primary">${data[0].doc_status}</span>`);
        $('#revisi_doc_note_sub').prop('disabled', true); 
        $('#revisi_doc_note_ver').prop('disabled', true);
      } else if( data[0].doc_status == 'Grouping'){
        $('.doc-status').html(`<span class="badge bg-success">${data[0].doc_status}</span>`);
        $('#revisi_doc_note_sub').prop('disabled', true); 
        $('#revisi_doc_note_val').prop('disabled', true);
        $('#revisi_doc_note_ver').prop('disabled', true);
      } else if( data[0].doc_status == 'Revisi'){
        $('.doc-status').html(`<span class="badge bg-danger">${data[0].doc_status}</span>`);
        $('.label-revisi').removeClass('d-none');
        $('.input-revisi').removeClass('d-none');
      
        $('.doc-time-name').html('Tanggal Revisi');
        $('.doc-time').html(data[0].doc_time_revisi);



        $('#revisi_doc_note_revisi').val(data[0].doc_note_revisi);
        $('#revisi_doc_note_sub').prop('disabled', true); 
        $('#revisi_doc_note_val').prop('disabled', true);
        $('#revisi_doc_note_ver').prop('disabled', true);
      }
      
      $('#revisi_doc_note_sub').val(data[0].doc_note_sub);
      $('#revisi_doc_note_ver').val(data[0].doc_note_ver);
      $('#revisi_doc_note_val').val(data[0].doc_note_val);

    }
  );
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
    $('.btn-validasi').removeClass('d-none');

  $.get("dashboard/edit-document/" + transactionId,
    function (data, textStatus, jqXHR) {
      $('#editDocument-modal').modal('show');

      $("#edit-doc-id").data('doc-id', data[0].id);
      $("#edit-doc-id").data('patient-id', data[0].patient_id);


      $('#edit_doc').val(data[0].doc_name);
      console.log(data[0]);
      let link = '/storage/' + data[0].file;
      let doc_file_name = data[0].file_name;
      let linkElement = `<a href="${link}"><small style="font-style:italic;">${doc_file_name}</small></a>`;
      $("#doc-file-name").html(linkElement);

  

      $('#edit-file').attr('src', 'storage/' +data[0].file );



     

      if(  data[0].doc_status == 'Diajukan'){
        $('.doc-status').html(`<span class="badge bg-warning">${data[0].doc_status}</span>`);
        $('#edit-doc_note_ver').prop('disabled', true); 
        $('#edit-doc_note_val').prop('disabled', true); 
        $('#edit-doc_note_sub').prop('disabled', false); 
        $('.doc-time').html(data[0].doc_time_sub);
        $('.doc-time-name').html('Tanggal Diajukan');
      } else if( data[0].doc_status == 'Verifikasi') {
        $('.doc-status').html(`<span class="badge bg-info">${data[0].doc_status}</span>`);
        $('#edit-doc_note_sub').prop('disabled', true); 
        $('#edit-doc_note_ver').prop('disabled', true);
        $('.doc-time-name').html('Tanggal Verifikasi');
        $('.doc-time').html(data[0].doc_time_ver);
      }else if( data[0].doc_status == 'Validasi'){
        $('.doc-status').html(`<span class="badge bg-primary">${data[0].doc_status}</span>`);
        $('#edit-doc_note_sub').prop('disabled', true); 
        $('#edit-doc_note_ver').prop('disabled', true);
      } else if( data[0].doc_status == 'Grouping'){
        $('.doc-status').html(`<span class="badge bg-success">${data[0].doc_status}</span>`);
        $('#edit-doc_note_sub').prop('disabled', true); 
        $('#edit-doc_note_val').prop('disabled', true);
        $('#edit-doc_note_ver').prop('disabled', true);
      } else if( data[0].doc_status == 'Revisi'){
        $('.doc-status').html(`<span class="badge bg-danger">${data[0].doc_status}</span>`);
        $('.label-revisi').removeClass('d-none');
        $('.input-revisi').removeClass('d-none');
        $('.btn-edit-revisi').removeClass('d-none');
        $('.doc-time-name').html('Tanggal Revisi');
        $('.doc-time').html(data[0].doc_time_revisi);
        $('.btn-revisi-doc').addClass('d-none');
        $('.btn-validasi').addClass('d-none');
        $('.btn-edit-doc').addClass('d-none');


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
  

    $("#form-edit").submit(function (e) {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      e.preventDefault();

      const docId = $('#edit-doc-id').data('doc-id');
      var form = this;

      formData = new FormData(form);
      formData.append('_method', 'PATCH');

      $.ajax({
        type: "POST",
        url: "dashboard/update-document/" + docId,
        dataType: 'json',
        data:formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          $('#editDocument-modal').modal('hide');
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Perubahan Data Berhasil disimpan',
            showConfirmButton: false,
            timer: 3000
          })

            dt.ajax.reload();
          hs.ajax.reload();
          
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


    $("#form-revisi").submit(function (e) {
   
      e.preventDefault();

      const docId = $('#revisi-doc-id').data('revisi-doc-id');
      const patientId = $('#revisi-doc-id').data('revisi-patient-id');

      var form = this;

      formData = new FormData(form);
      formData.append('_method', 'PATCH');
 

      $.ajax({
        type: "post",
        url: "dashboard/revisi-document/" + docId + "/" + patientId,
        dataType: 'json',
        data:formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          $('#revisiDocument-modal').modal('hide');
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Perubahan Data Berhasil disimpan',
            showConfirmButton: false,
            timer: 3000
          })

            dt.ajax.reload();
          hs.ajax.reload();
          
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


    
 




  $('body').on('click', '.btn-pasien', function(e) {
    
    const patientId = $('#detail-patient-id').val();
    const statusPasien = $('#edit-status-baru').val();
    const notePasien = $('#edit-note-patient').val();

    // alert(patientId);
    
    var formEdit = {
      status: statusPasien,
      note : notePasien
  };

    $.ajax({
      type: "put",
      url: "dashboard/edit-status-pasien/" + patientId,
      data: formEdit,
      dataType: "json",
      success: function (response) {
        $('#detailDocument-modal').modal('hide');
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Data Status Berhasil disimpan',
          showConfirmButton: false,
          timer: 3000
        })
      
          dt.ajax.reload();
          hs.ajax.reload();
        
      }
      });
  });


  $('body').on('click', '.deleteDocument', function(e) {
    
    const docId = $(this).data('id');
    const patientId = $(this).data('patient-id');

 var patient_id = {
  patientId: patientId
 }

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
          data : patient_id,
          url: "dashboard/delete-document/" + docId,
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


  $("#form-edit").submit(function (e) {
    e.preventDefault(); 
    const docId = $('#edit-doc-id').data('doc-id');
    const patientId = $('#edit-doc-id').data('patient-id');
  
    // alert(patientId);
  
   

   var formData = new FormData('#form-edit');
    formData.append('_method', 'PATCH');
  
  $.ajax({
  type: "post",
  url: "dashboard/revisi-document/" + docId,
  data: formData,
  dataType: "json",
  success: function (response) {
    $('#editDocument-modal').modal('hide');
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
    url: "dashboard/create-data",
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

$("#form-pindahkan-pasien").submit(function (e) {
  e.preventDefault();
  const id = $("#pindah-pasien-id").val();
  const room = $("#pindah-pasien-room").val();
  $.ajax({
    url: '/dashboard/pindahkan-pasien',
    type: 'put',
    dataType: 'json',
    data: {
      id: id,
      room: room
    },
    success: function(response) {
      $('#pindahkan-patient-modal').modal('hide');
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Pasien sudah dipindahkan',
            showConfirmButton: false,
            timer: 3000
          })

            dt.ajax.reload();
          hs.ajax.reload();
    },
    error: function(request, status, error) {
      // alert("-")
    }
  })
})


$('body').on('click', '.ajukanDokumen', function(e){

  const docId = $(this).data('id');

  // alert(docId);

  $.ajax({
    url: '/dashboard/ajukan-dokumen-status/' + docId ,
    type: 'put',
    dataType: 'json',
    success: function(response) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Pasien telah diajukan',
            showConfirmButton: false,
            timer: 3000
          })

            dt.ajax.reload();
          hs.ajax.reload();
    },
    error: function(request, status, error) {
    
    }
  })
})


$('body').on('click', '.ajukanDokumenUlang', function(e){

  const docId = $(this).data('id');

  // alert(docId);

  $.ajax({
    url: '/dashboard/ajukan-dokumen-ulang/' + docId ,
    type: 'put',
    dataType: 'json',
    success: function(response) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Pasien telah diajukan ulang',
            showConfirmButton: false,
            timer: 3000
          })

            dt.ajax.reload();
          hs.ajax.reload();
    },
    error: function(request, status, error) {
    
    }
  })
})


});

var filterEventHandler = () => {
  let submissionFilterBtn = $("#filter-submission-btn");
  let validatedFilterBtn = $("#filter-validasi-btn");
  let verifikasiFilterBtn = $("#filter-verifikasi-btn");
  let groupingFilterBtn = $("#filter-grouping-btn");
  let revisiFilterBtn = $("#filter-revisi-btn");
  let submissionBadge = $("#submission-badge");
  let ajukanDokumenBtn = $("#filter-ajukan-btn");
  let selesaiDokumenBtn = $("#filter-selesai-btn");

  const searchParams = new URLSearchParams(window.location.search);
    const date_from = searchParams.get('date_from');
    const date_to = searchParams.get('date_to');
    var datatableUrl = '';
    if (date_from != '' && date_to != '') {
      datatableUrl = '/dashboard/datatable?search=true&date_from=' + date_from + '&' + 'date_to=' + date_to;
    } else {
      datatableUrl = '/dashboard/datatable?search=true';
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

  ajukanDokumenBtn.on('click', () => {
    dt.ajax.url(datatableUrl + '&' + 'ajukan-dokumen=1').load();
  });

  selesaiDokumenBtn.on('click', () => {
    dt.ajax.url(datatableUrl + '&' + 'selesai-dokumen=1').load();
  });
}


var syncDataEventHandler = () => {
  $("#sync-data-loading").prop('hidden', true);
  $("#sync-data-btn").on('click', () => {
    let dateFrom = $("#sync-date-from").val();
    let dateTo = $("#sync-date-to").val();
    if (dateFrom == '' || dateTo == '') {
      alert("Please insert date to sync");
      return;
    }
    $("#sync-data-btn").hide();
    $("#sync-data-loading").prop('hidden', false);

    $.ajax({
      url: 'dashboard/sync-data?date_from=' + dateFrom + '&date_to=' + dateTo,
      type: 'get',
      dataType: 'json',
      success: function(response) {
        $("#sync-data-btn").show();
        $("#sync-data-loading").prop('hidden', true);
        alert("Sync Completed!");
      },
      error: function(request, status, error) {
        $("#sync-data-btn").show();
        $("#sync-data-loading").prop('hidden', true);
        alert("Sync ERROR!");
      }
    })
  })
}

$('body').on('click', '.sync-single-data', function(){
  let no_order = $(this).data('no-order');

  $.ajax({
    url: 'dashboard/sync-single-data?nomor=' + no_order,
    type: 'get',
    dataType: 'json',
    success: function(response) {
      console.log(response);
      alert("Sync Single Data Completed!");
    },
    error: function(request, status, error) {
      alert("Sync ERROR!");
    }
  })
})



document.addEventListener('DOMContentLoaded', function () {
initDatatable();
addInput();
// detailPatient();
detailDocument();
// docDetail();
// historyPatient();
syncDataEventHandler();
filterEventHandler();
date();

});