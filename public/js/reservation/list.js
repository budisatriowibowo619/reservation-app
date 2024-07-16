$(document).ready(function () {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
});

const DTReservationList = () => {
    NioApp.DataTable('#tableListReservation', {
        processing: true,
        serverSide: true,
        bDestroy: true,
        ajax: "/DTReservationList",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', class: 'text-center', width: '10%'},
            {data: 'phone_number', name: 'phone_number', class: 'text-center', width: '10%'},
            {data: 'package', name: 'package', class: 'text-center', width: '15%'},
            {data: 'tablename', name: 'tablename', class: 'text-center', width: '15%'},
            {data: 'date_time', name: 'date_time', class: 'text-center', width: '10%'},
            {data: 'total_cost', name: 'total_cost', class: 'text-center', width: '10%'},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center', width:'5%'},
        ],
        responsive: {
            details: true
        }
    });
}

DTReservationList();

const cancelReservation = (id_reservation) => {
    Swal.fire({
        title: 'Are you sure ?',
        text: 'You will cancel this reservation',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: '/cancelReservation',
                data: {
                    id: id_reservation
                },
                dataType: 'JSON',
                async: false,
                cache: false,
                success: function (response) {
                    Swal.fire({
                        title : response.message,
                        icon: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    DTRekapitulasiKendaraan();
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
        }
    })   
}