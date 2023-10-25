

var dt;
var hs = null;
var selectorName = '.datatable-ajax';


var columnsDataTable = [

    {data: 'no_sep', className: 'text-center'},
    {data: 'patient_name' , className: 'text-center'},
    {data: 'no_order' , className: 'text-center'},
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
{data: 'doc_patient.doc_status' , className: 'text-center',
render: function (data, type, row, meta) {
  var status = ``;
  if( row.doc_patient && row.doc_patient.doc_status == 'Submitted'){
    var status = `<span class="badge bg-warning">${row.doc_patient.doc_status}</span>`;
  }
  
  return status;
}
},
    {data: 'action' , name : 'action', className: 'text-center'}


  ];


  var initDatatable = () => {

  dt =  $(selectorName).DataTable({
      paging: false,
      scrollY: '400px',
      select: {
        style: 'single'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: 'dashboard/datatable',
      columns: columnsDataTable,
      language: {
        processing: '<div class="loading-indicator">Loading...</div>'
    },
      columnDefs: [{
        "defaultContent": "-",
        "targets": "_all"
      }]
  
   
  });
  console.log(dt);

  dt.on('click', 'tr', function () {
    const selectedData = dt.row(this).data();
    if (selectedData) {
    
        detailPatient(selectedData);
        detailDocument(selectedData);
        docDetail(selectedData);
        historyPatient(selectedData);
        // alert(selectedTransactionId);
    }
});


  }


  var columnsHistoryPatient = [

    {data: 'doc_name', className: 'text-center'},
    {data: 'doc_note_sub', className: 'text-center'},
    {data: 'doc_status' , className: 'text-center',
render: function (data, type, row, meta) {
  var status = ``;
  if( row.doc_status && row.doc_status == 'Submitted'){
    var status = `<span class="badge bg-warning">${row.doc_status}</span>`;
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
  console.log(hs);


    hs.on('click', 'tr', function () {
    const selectedDataDocument = hs.row(this).data();
    if (selectedDataDocument) {
    
  
        editDocument(selectedDataDocument);
        // alert(selectedTransactionId);
    }
});
    
  }



  var editDocument = (selectedDataDocument) => {
    $('.editDocument').on('click', function(e) {
      console.log(selectedDataDocument);
    })




  }


  var docDetail = (selectedData) => {

    $('.show-edit').empty();
  
  
    const patientId = selectedData.id ;

    alert(patientId);

      $.ajax({
        method: "GET",
        url: "dashboard/document-detail/" + patientId,
        success: function (res) {
          console.log(res.data);

      
          $('.document-container').removeClass('d-none');
          // $.each(collection, function (indexInArray, valueOfElement) { 
            
          // });
          $.each(res.data, function (index, item) {

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
            var containerDocument = $('<div>').addClass('col-lg-6');
            containerDocument .append(documentLabel, documentInput);

            var containerNote = $('<div>').addClass('col-lg-6');
            containerNote .append(noteLabel, noteTextarea);
      
            // Tempatkan div container ke dalam '.document-container'
            $('.show-edit').append(containerDocument );
            $('.show-edit').append(containerNote );
          });
        }
        
      });
  
  }

  var detailPatient = (selectedData) => {

    const patient_name = selectedData.patient_name;
    const sep = selectedData.no_sep;
    const patient_id = selectedData.id;

  

   
    $('#patient-id').val(patient_id);

    $(".name-detail").html(patient_name);
    $(".sep-detail").html(sep);
    
}


var detailDocument = (selectedData) => {
  $('.detailDocument').on('click', function(e) {
    e.preventDefault();
    $('#detailDocument-modal').modal('show');
    const patient_name = selectedData.patient_name;
    const sep = selectedData.no_sep;
    const medrec = selectedData.medrec;
    const order = selectedData.no_order;

    console.log(medrec);

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

  var addInput = () => {

    var btnInput = document.getElementById('addInput');

    btnInput.addEventListener('click', function() {
      const form = document.getElementById('form-create');
      const newInput = document.createElement('div');
      newInput.classList.add('mb-3', 'new-input');
      newInput.innerHTML = `
      <div class="row">
      <div class="col-lg-6">
        <div class="mb-3">
  
          <label for="exampleFormControlInput1" class="form-label">Document <span class="important">*</span></label>
          <input type="text" id="document" name="document[]" class="form-control" id="exampleFormControlInput1" required >
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Note <span class="important">*</span></label>
          <textarea class="form-control" name="note[]"  id="note" style="height: 20px"></textarea>
        </div>
      </div>

      <div class="col-lg-2">
        <label class="form-check-label" for="flexCheckDefault">
          Ver
         </label>
          <div class="form-check mt-3">
            <input class="form-check-input verifikasi-checkbox" name="verifikasi[]" type="checkbox" value="" id="verifikasi" >  
          </div>
      </div>
      <div class="col-lg-2">
        <label class="form-check-label" for="flexCheckDefault">
          Val
         </label>
          <div class="form-check mt-3">
            <input class="form-check-input validasi-checkbox" name="validasi[]" type="checkbox" value="" id="validasi" >
          </div>
      </div>
      <div class="col-lg-2">
      <button type="button" class="btn btn-danger delete-input"><i class="bi bi-trash"></i></button>
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


$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});



$(document).ready(function() {

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



  jQuery.ajax({
    type: "post",
    url: "http://data-tracking-system.test/create-data",
    data: formData,
    dataType: "json",
    success: function (response) {
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Data saved successfully',
        showConfirmButton: false,
        timer: 3000
      })
      form.trigger('reset');
      $('#submitButton').prop('disabled', false);
    
      $('.new-input').remove();
        
      dt.ajax.reload();
    },
    error: function (xhr, status, error) {
      var errorMessage = "Terjadi kesalahan: " + xhr.status + " - " + xhr.statusText;
      if (xhr.responseJSON && xhr.responseJSON.message) {
          errorMessage = xhr.responseJSON.message;
      }
      console.log(errorMessage);
  }
  });
  
});


});

document.addEventListener('DOMContentLoaded', function () {

initDatatable();
addInput();
detailPatient();
detailDocument();
docDetail();
historyPatient ();
editDocument();

});