


var selectRoom = () => {
        $('#room').select2({
          placeholder: 'Pilih Ruangan',
          allowClear: true,
    
        });
    }

    $(document).ready(function() {
        $('#role').select2({
          placeholder: 'Pilih opsi',
          allowClear: true, // Menampilkan tombol hapus
          tags: true, // Mengizinkan pengguna menambahkan opsi baru
        });
      });

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
document.addEventListener('DOMContentLoaded', function() {

    selectRoom();
});
