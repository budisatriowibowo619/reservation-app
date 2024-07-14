$(document).ready(function () {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#form-reservation').submit(function(event) {
        $('#btn-reservation').prop('disabled', true);
        event.preventDefault();
        formData = new FormData($(this)[0]);
        $.ajax({
            url: "/processReservation",
            type: "post",
            data: formData,
            async: false,
            cache: false,
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend: function () {
                Swal.showLoading();
            },
            complete: function () {
                Swal.hideLoading();
            },
            success: function (response) {
                if(response == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Reservation succesfully booked',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'This table has been already booked, please choose a different time',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    });
                    $('#btn-reservation').prop('disabled', false);
                }
            },
            error: function (error) {
                Swal.fire({
                    title: 'Terjadi kesalahan saat menyimpan data!',
                    text: error.responseText, 
                    icon: 'error',
                    showConfirmButton: false
                });
                $('#btn-reservation').prop('disabled', false);
            }
      });
      return false;
    });
});

$('#id-package').select2({
    placeholder: '- Select Package -',
    // allowClear: true,
    ajax: {
        type: 'GET',
        url: '/selectPackage',
        data: function(params) {
            let query = {
                search: params.term,
                page: params.page || 1,
                time: $("input[name='time']:checked").val(),
                category: $("input[name='category']:checked").val()
            }

            return query;
        },
        delay: 500
    }
});

$('#id-table').select2({
    placeholder: '- Select Table -',
    // allowClear: true,
    ajax: {
        type: 'GET',
        url: '/selectTable',
        data: function(params) {
            let query = {
                search: params.term,
                page: params.page || 1
            }

            return query;
        },
        delay: 500
    }
});