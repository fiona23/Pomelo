(function () {
    $('#upload-form').on('change', function () {
        var formData = new FormData(this);
        $.ajax({
            url: 'upload/add',
            type: 'POST',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function (responseText) {
                console.log(responseText)
                var json = jQuery.parseJSON(responseText)
                $('#uploaded-postcards').append(json.img)
                $('#count').html('上传了'+json.count+'张明信片')
            }
        }) 
    })

$.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });   
})()