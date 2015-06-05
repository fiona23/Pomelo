(function () {
    $('#exchange-btn').on('click', function () {
        var _this = $(this); 
        var text = _this.html();
        var status = text ==='我想换' ? '1' : '0';
        text = text ==='我想换' ? '取消' : '我想换';
        $.ajax({
            url: '/exchange/sure',
            type: 'POST',
            //contentType: 'application/json',
            data: 'demand_user=' + $('.auth-link').eq(0).attr('data-auth') + '&postcard_id='+_this.attr('data-postcard') +
                                   '&status =' + status,
            // {
            //     demand_user: $('.auth-link').eq(0)['data-auth'],
            //     postcard_id: target.id
            // },
            success: function () {
                _this.html(text);
            }
        })
    }) 

$('#demand-users').delegate('a', 'click', function (event){
    _this = this;
    var userName = $(this).attr('data-user');
    $.ajax({
        url: '/exchange/showList',
        type: 'POST',
        data: 'demand_user=' + userName,
        success: function (responseText) {
            $('body').append('<div class="overlay-background">'
                            +'<div id="choose-list" class="choose-overlay">'
                            + '<a target="_blank" href="/people/'+ userName +'">'+ userName +'</a>' 
                            + '可以与你交换的明信片，点击即选中'
                            +responseText
                            +'</div></div>')
            //选定
            $('#choose-list').delegate('a', 'click', function () {
                var postcardId = $(this).attr('data-postcard')
                if (!postcardId) {
                    return;
                }
                $.ajax({
                    url: '/exchange/choose',
                    type: 'POST',
                    data: 'postcard_id_ed=' + postcardId
                                         + '&get_user='
                                         + userName
                                         + '&postcard_id='
                                         + $('#each-postcard').attr('data-postcard'),
                    success: function (responseText) {
                        window.location.replace('/exchange/sure');
                    }
                })
            })
            //
            $('.overlay-background').eq(0).on('click', function (e) {
                if (e.target === this) {
                    this.remove();
                } else {
                    return
                }
            })
        }
    })
})

if (document.getElementById('choose-list')) {
    
}

$.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
})()