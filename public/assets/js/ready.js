
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});

jQuery(document).ready(function(){
    jQuery('.scrollbar-inner').scrollbar();
});

// Select all functionality
$(document).ready(function() {
    $('[data-select="checkbox"]').change(function(){
        $target = $(this).attr('data-target');
        $($target).prop('checked', $(this).prop("checked"));
    });

    $('#upload_excel').click(function() {
        var fileInput = $('#excel_file')[0];
        if(fileInput.files.length === 0) {
            $('#upload_status').html('<div class="alert alert-danger">Pilih file Excel terlebih dahulu</div>');
            return;
        }

        var formData = new FormData($('#excelUploadForm')[0]);

        $('#upload_status').html('<div class="alert alert-info">Sedang mengupload...</div>');

        $.ajax({
            // Pastikan URL ini dirender melalui template Blade
            url: uploadUrl, // Variabel ini harus didefinisikan di template Blade
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.success) {
                    $('#upload_status').html('<div class="alert alert-success">Berhasil mengupload data</div>');
                    // Opsional: refresh halaman setelah beberapa detik
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    $('#upload_status').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function(xhr) {
                let errorMessage = 'Terjadi kesalahan';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                $('#upload_status').html('<div class="alert alert-danger">' + errorMessage + '</div>');
            }
        });
    });
});