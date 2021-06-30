var baseUrl = document.querySelector("head base")["href"];

// EVENT CONVERT DATE
$(document).ready(function () {
    moment.locale("vi");
    $(".date-convert-full").each(function( index ) {
        $(this).text(moment($(this).data("time")).format('LLLL'));
    });
});

$('#btn-search-user').click(function(){
    window.location.href = baseUrl + 'seach-home-user/' + $('#input-search-user').val() + '/1';;
});

$("#input-choose-image").on("change", function () {
    $("#img-show").css("display", "none");

    let file = this.files[0];
    let fileType = file["type"];
    let extend = ["image/jpg", "image/jpeg", "image/png"];

    if ($.inArray(fileType, extend) < 0) {
        $("#input-choose-image").val("");
        alert("Sai định dạng tệp. Vui lòng chọn hình ảnh.");
    }
    else {
        var img = new Image();
        img.src = window.URL.createObjectURL(file);
        img.onload = function () {
            let width = img.naturalWidth;
            let height = img.naturalHeight;
            window.URL.revokeObjectURL(img.src);

            if (width <= 2000 && height <= 2000) {
                $("#img-show").css("display", "block");
                var reader = new FileReader();
                reader.onload = (function (e) {
                    $("#img-show").attr("src", e.target.result);
                });
                reader.readAsDataURL(file);
            }
            else {
                $("#input-choose-image").val("");
                alert("Kích thước ảnh quá lớn. Chỉ dùng ảnh từ 1000x1000.");
            }
        };
    }
});

$("#change-password").change(function () {
    let status = !$(this).is(":checked");
    showChangePass(status);
});

function showChangePass(status) {
    $("#password").attr("readonly", status);
    $("#password-confirm").attr("readonly", status);
    $("#password").val("");
    $("#password-confirm").val("");
}