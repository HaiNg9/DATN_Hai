$(document).ready(function () {
    moment.locale("vi");
    if ($("#notify-list").length) {
        $(".time-notify").each(function() {
            let val = moment($(this).data("time")).fromNow();
            $(this).html(val);
        });
    }
});