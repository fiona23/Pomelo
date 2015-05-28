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

$.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
})();