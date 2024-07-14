$(document).ready(function () {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
});

const DTMasterTable = () => {
    NioApp.DataTable('#tableTable', {
        processing: true,
        serverSide: true,
        bDestroy: true,
        ajax: "/DTMasterTable",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'description', name: 'description', class: 'text-center', width: '90%'},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center', width:'5%'},
        ],
        responsive: {
            details: true
        }
    });
}

DTMasterTable();

const clearFormTable = () => {
    $('#formTable').trigger('reset');
    $('#idTable').val('');
}

const showMasterTable = () => {
    clearFormTable();
    $('#modalMasterTable').modal('show');
}

const hideMasterTable = () => {
    clearFormTable();
    $('#modalMasterTable').modal('hide');
}

const editMasterTable = (id_table) => {
    clearFormTable();
    $.ajax({
        type: 'GET',
        url: '/gtMasterTable',
        data: {
            id: id_table
        },
        dataType: 'JSON',
        async: false,
        cache: false,
        success: function (response) {
            $('#modalMasterTable').modal('show');
            $('#idTable').val(response.id);
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

const deleteMasterTable = (id_table) => {
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
                url: '/deleteMasterTable',
                data: {
                    id: id_table
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
                    DTMasterTable();
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

$("#formTable").submit(function(event) {
    event.preventDefault();
    dataFormTable = new FormData($(this)[0]);
    $.ajax({
        type: "POST",
        url: "/processMasterTable",
        data: dataFormTable,
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
                onAfterClose: () => $('#modalMasterTable').modal('hide')
            });
            DTMasterTable();
            clearFormTable();
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