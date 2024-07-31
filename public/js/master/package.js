$(document).ready(function () {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
});

const DTMasterPackage = () => {
    NioApp.DataTable('#tablePackage', {
        processing: true,
        serverSide: true,
        bDestroy: true,
        ajax: "/DTMasterPackage",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            // {data: 'category', name: 'category', class: 'text-center', width: '10%'},
            {data: 'description', name: 'description', class: 'text-center', width: '35%'},
            {data: 'price', name: 'price', class: 'text-center', width: '10%'},
            {data: 'time', name: 'time', class: 'text-center', width: '15%'},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center', width:'5%'},
        ],
        responsive: {
            details: true
        }
    });
}

DTMasterPackage();

const clearFormPackage = () => {
    $('#formPackage').trigger('reset');
    $('#idPackage').val('');
}

const showMasterPackage = () => {
    clearFormPackage();
    $('#modalMasterPackage').modal('show');
}

const hideMasterPackage = () => {
    clearFormPackage();
    $('#modalMasterPackage').modal('hide');
}

const editMasterPackage = (id_package) => {
    clearFormPackage();
    $.ajax({
        type: 'GET',
        url: '/gtMasterPackage',
        data: {
            id: id_package
        },
        dataType: 'JSON',
        async: false,
        cache: false,
        success: function (response) {
            $('#modalMasterPackage').modal('show');
            $('#idPackage').val(response.id);
            $('#inputPrice').val(response.price);
            $('#inputDuration').val(response.duration);
            if(response.category === "pelajar"){
                $('#radioPelajar').prop('checked',true);
            } else if (response.category === "reguler"){
                $('#radioReguler').prop('checked',true);
            }
            if(response.time === "siang"){
                $('#radioSiang').prop('checked',true);
            } else if (response.status === "malam"){
                $('#radioMalam').prop('checked',true);
            }
            $('#inputDescription').val(response.description);
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

const deleteMasterPackage = (id_package) => {
    Swal.fire({
        title: 'Are you sure ?',
        text: 'You will delete this data',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: '/deleteMasterPackage',
                data: {
                    id: id_package
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
                    DTMasterPackage();
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

$("#formPackage").submit(function(event) {
    event.preventDefault();
    dataFormPackage = new FormData($(this)[0]);
    $.ajax({
        type: "POST",
        url: "/processMasterPackage",
        data: dataFormPackage,
        dataType: "JSON",
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            Swal.showLoading();
        },
        complete: function() {
            Swal.hideLoading();
        },
        success: function (response) {
            Swal.fire({
                title : response.message,
                icon: 'success',
                timer: 3000,
                showConfirmButton: false,
                onAfterClose: () => $('#modalMasterPackage').modal('hide')
            });
            DTMasterPackage();
            clearFormPackage();
        },
        error: function (error) {
            Swal.fire({
                title: 'Terjadi kesalahan saat menyimpan data!',
                text: error.responseText, 
                icon: 'error',
                showConfirmButton: false
            });
        }
    });
});