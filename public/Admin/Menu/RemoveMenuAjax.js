$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeMenu(id, route) {
    if (confirm('Bạn có muốn xoá')) {
        $.ajax({
            type: "delete",
            url: route,
            data: {
                idMenu:id
            },
            dataType: "JSON",
            success: function (response) {
                if (response.error)
                    location.reload();
                else
                    alert(response.message);
            }
        });
    }
}
