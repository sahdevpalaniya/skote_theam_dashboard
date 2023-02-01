$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function tost(icon, title) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: icon,
        title: title,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
}

var table;

function createDatatable(url, columns) {
    table = $('#dataTable').DataTable({
        ajax: {
            data: function (d) {
                d._token = $('meta[name="csrf-token"]').attr('content');
            },
            url: url,
            type: 'POST',
        },
        serverSide: true,
        processing: true,
        aaSorting: [
            [0, "desc"]
        ],
        columns: columns,
    });
}

function reload() {
    table.ajax.reload("null", false);
}

$(document).on('click', '.btnDelete', function () {
    var id = $(this).data('id');
    var url = $(this).data('url');
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
                type: "POST",
                url: url,
                data: {
                    id: id,
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
            }).done(function (data) {
                if (data.success == true) {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        text: 'Deleted!',
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.message,
                        text: 'Not Deleted!',
                    })
                }
                table.ajax.reload()
            }).fail(function (jqXHR, status, exception) {
                if (jqXHR.status === 0) {
                    error = 'Not connected.\nPlease verify your network connection.';
                } else if (jqXHR.status == 404) {
                    error = 'The requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    error = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    error = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    error = 'Time out error.';
                } else if (exception === 'abort') {
                    error = 'Ajax request aborted.';
                } else {
                    error = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                Swal.fire({
                    icon: 'error',
                    title: error
                })
            });
        }
    })
});

$(document).on('change', '.js-switch', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var status = $(this).prop('checked') == true ? "1" : "0";
    var url = $(this).data('url');

    const Toast = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
    });
    Toast.fire({
        title: 'Are You Sure you want to change status?',
        text: "You can be able to revert this again!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, change it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id: id,
                    status: status
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }).done(function (data) {
                if (data.success == true) {
                    Toast.fire("Status Changed!", data.message, "success");
                } else {
                    Toast.fire("Cancelled!", data.message, "error");
                }
                table.ajax.reload();
            }).fail(function (jqXHR, status, exception) {
                if (jqXHR.status === 0) {
                    error = 'Not connected.\nPlease verify your network connection.';
                } else if (jqXHR.status == 404) {
                    error = 'The requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    error = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    error = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    error = 'Time out error.';
                } else if (exception === 'abort') {
                    error = 'Ajax request aborted.';
                } else {
                    error = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                Swal.fire('Error!', error, 'error');
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Toast.fire('Cancelled', 'Status changing cancelled :)', 'error')
        }
    });
});
