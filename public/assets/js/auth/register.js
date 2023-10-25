
var FormValidation =  function()   {
    $('#registration-form').on('submit', function(e) {
 

        e.preventDefault();

  
      alert($('#name').val());

        // Mengambil data dari formulir
        var formData = {
            name: $('#name').val(),
            role: $('#role').val(),
            room: $('#room').val(),
            username: $('#user_name').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val(),
       
        };

  

        // Melakukan validasi klien dengan Ajax
        $.ajax({
            method: 'post',
            dataType: 'json' ,
            data: formData,
            url: '/create-register',
           
            success: function(data) {
                // Jika validasi sukses, lanjutkan ke pengiriman formulir
                $('#registration-form')[0].submit();
            }
        });
    });

 
}


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
document.addEventListener('DOMContentLoaded', function() {
    FormValidation();
});
