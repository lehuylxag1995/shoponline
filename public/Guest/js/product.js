$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#btnLoadMore").off('click').on('click',function (e) {
    e.preventDefault();
    var pageCurrent = $(this).data("page");
    $.ajax({
        type: "post",
        url: "/LoadMore",
        data: {
            page:pageCurrent
        },
        dataType: "JSON",
        success: function (response) {
            if (response.status)
            {
                $("#LoadProduct").append(response.data);
                $("#btnLoadMore").data("page", pageCurrent+1);
            }
            else
            {
                alert('Đã load xong');
                $("#divLoadMore").attr('hidden','hidden');
            }
        }
    });
});
