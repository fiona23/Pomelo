(function () {
var btn = $('.sf-follow-btn').eq(0);
btn.click(function () {
    var followBtn = $('.follow-btn').eq(0);
    var unfollowBtn = $('.unfollow-btn').eq(0);
    if ($('.follow-btn')[0]) {
        $.ajax({
            url: '/people',
            type: 'POST',
            data: "followId="+followBtn.attr('id'),
            success: function () {
                followBtn.html('取消关注');
                followBtn.removeClass('follow-btn');
                followBtn.addClass('unfollow-btn');
            }
        })
    } else if ($('.unfollow-btn')[0]) {
        $.ajax({
            url: '/people',
            type: 'POST',
            data: "unfollowId="+unfollowBtn.attr('id'),
            success: function () {
                unfollowBtn.html('关注');
                unfollowBtn.removeClass('unfollow-btn');
                unfollowBtn.addClass('follow-btn');
            }
        })
    }
})

var postWrapper = $('#postcard-wrapper');
postWrapper.delegate('button', 'click', function (event) {
    var text = $(this).html();
    var status = text ==='我想换' ? '1' : '0';
    text = text ==='我想换' ? '取消' : '我想换';
    $(this).html(text);
    $.ajax({
        url: '/exchange/sure',
        type: 'POST',
        //contentType: 'application/json',
        data: 'demand_user=' + $('.auth-link').eq(0).attr('data-auth') + '&postcard_id='+$(this).attr('data-postcard') +
                               '&status =' + status,
        // {
        //     demand_user: $('.auth-link').eq(0)['data-auth'],
        //     postcard_id: target.id
        // },
        success: function () {
            
        }
    })
})


$.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

})();