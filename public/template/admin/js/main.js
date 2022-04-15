$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    if (confirm('Xóa không thể khôi phục. Bạn có chắc chắn không?')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message)
                    location.reload();
                } else {
                    alert('Xóa lỗi! Vui lòng thử lại!')
                }
            }
        })
    }
}

// Upload files
$('#upload').change(function () {
    console.log('input file on change')
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function (results) {
            if (results.error === false) {
                console.log(results)
                results.url = results.url.replace("public", "storage");
                $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                    '<img src="' + results.url + '" width=100px></a>')

                $('#file').val(results.url);
            } else {
                alert('Upload file loi!')
            }
            console.log('result: ', results);
        }
    })

})

// $('#upload').val('');
// $('#upload').change(function () {
//     var img_path = $(this)[0].value;
//     var img_holder = $('#image_show');
//     var extension = img_path.substring(img_path.lastIndexOf('.') + 1).toLowerCase();

//     if (extension == 'jpeg' || extension == 'jpg' || extension == 'png') {
//         if (typeof (FileReader) != 'undefined') {
//             img_holder.empty();
//             var reader = new FileReader();
//             reader.onload = function (e) {
//                 $('<img/>', {
//                     'src': e.target.result,
//                     'class': 'img-fluid',
//                     'style': 'width:100px; margin-top:12px'
//                 }).appendTo(img_holder)
//             }
//             img_holder.show();
//             reader.readAsDataURL($(this)[0].files[0]);
//         } else {
//             $(img_holder).html('This browser doest not support FileReader!')
//         }
//     } else {
//         $(img_holder).empty();
//     }
// })

