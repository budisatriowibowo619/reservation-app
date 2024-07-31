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
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Reservation succesfully booked',
                    //     timer: 2000,
                    //     showCancelButton: false,
                    //     showConfirmButton: false,
                    //     allowOutsideClick: false,
                    // });
                    // setTimeout(function() {
                    //     location.reload();
                    // }, 2000);
                    Swal.fire({
                            title: "Terms and conditions",
                            input: "checkbox",
                            inputValue: 1,
                            inputPlaceholder: `
                                I agree with the terms and conditions
                            `,
                            confirmButtonText: `
                                Continue&nbsp;<i class="icon ni ni-arrow-right"></i>
                            `,
                            inputValidator: (result) => {
                                return !result && "You need to agree with T&C";
                            }
                        }).then((result) => {
                            if(result) {
                                Swal.fire("You agreed with T&C :)");
                            }
                        });
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

$('input[type=radio][name=time]').change(function() {
    hitungTotalCost();
});

$('input[type=radio][name=category]').change(function() {
    hitungTotalCost();
});

$('.choose-package').change(function () {
    $('#__containPackage').show('normal');
    $('#__containCategory').hide('normal');
    $('#id-duration').attr("readonly", true);
    $('#id-duration').val(0);
    $('#total-cost').val(0);
    $('#id-total-cost').val(0);
    hitungTotalCost();
});

$('.choose-non-package').change(function () {
    $('#__containPackage').hide('normal');
    $('#__containCategory').show('normal');
    $('#id-duration').attr("readonly", false);
    $('#id-duration').val(0);
    $('#total-cost').val(0);
    $('#id-total-cost').val(0);
    hitungTotalCost();
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
                // category: $("input[name='category']:checked").val()
            }

            return query;
        },
        delay: 500
    }
});

$('#id-package').change(function() {
    
    let package_id  = $('#id-package').val();

    $.ajax({
        type: 'GET',
        url: '/gtMasterPackage',
        data: {
            id: package_id
        },
        dataType: 'JSON',
        async: false,
        cache: false,
        success: function (response) {
            $('#id-duration').val(response.duration);
            var output = 'Rp. '+(response.price/1000).toFixed(3);
            $('#total-cost').val(output);
            $('#id-total-cost').val(response.price);
        },
        error: function (error) {
            Swal.fire({
                title: 'Terjadi kesalahan saat mengambil data!',
                text: error.responseText, 
                icon: 'error',
                showConfirmButton: false
            });
        }
    });
    
});

$("#id-duration").on("input", function(){

    hitungTotalCost();
    
});

const hitungTotalCost = () => {

    var time = $("input[name='time']:checked").val();
    var duration = $('#id-duration').val();

    var total_cost = 0;

    if($("input[name='choosePackage']:checked").val() == 'non-package') {

        if(time >= '17:30'){
            var harga_reguler = 25000;
            var harga_pelajar = 17500;

            if($("input[name='category']:checked").val() == 'reguler'){
                total_cost = harga_reguler*duration;
            } else {
                total_cost = harga_pelajar*duration;
            }
        } else {
            var harga_reguler = 35000;
            var harga_pelajar = 22500;

            if($("input[name='category']:checked").val() == 'reguler'){
                total_cost = harga_reguler*duration;
            } else {
                total_cost = harga_pelajar*duration;
            }
        }

        var output = 'Rp. '+(total_cost/1000).toFixed(3);
        $('#total-cost').val(output);
        $('#id-total-cost').val(total_cost);

    }

}

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