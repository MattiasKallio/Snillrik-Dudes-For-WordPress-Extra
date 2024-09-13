jQuery(document).ready(function ($) {


    $('#byggisarna-filter-dudes-lan').change(function () {
        var lan = $(this).val();
        if (lan == '') {
            $('.sndude-dude-wrap-byggisarna .sndude-dude-box').show();
        } else {
            $(".sndude-dude-wrap-byggisarna .sndude-dude-box:not([data-lan='" + lan + "'])").hide();
            $(".sndude-dude-wrap-byggisarna .sndude-dude-box[data-lan='" + lan + "']").show();
        }
    });
});