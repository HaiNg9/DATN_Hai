$(document).ready(function () {
    moment.locale("vi");
    if ($("#user-edit-update-time").length) {
        let val = "<strong><i>Cập nhật " + moment($("#user-edit-update-time").data("time")).fromNow() + "!</i></strong>";
        $("#user-edit-update-time").html(val);
    }
});

var baseUrl = document.querySelector("head base")["href"];

$("#change-password").change(function () {
    let status = !$(this).is(":checked");
    showChangePass(status);
});

$("#btn-reset-edit-user").click(function () {
    showChangePass(true);
});

function showChangePass(status) {
    $("#password").attr("readonly", status);
    $("#password-confirm").attr("readonly", status);
    $("#password").val("");
    $("#password-confirm").val("");
}

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

$(".btn-save-role-user").click(function () {
    let id = $(this).data("id");
    let role = $("#text-role-user-" + id).val();
    let url = "admin/user/role/" + id + "/" + role;
    window.location.href = baseUrl + url;
});

$(".btn-delete-confirm").click(function () {
    if (confirm("Bạn có chắn chắn thực hiện xóa dữ liệu?")) {
        let url = $(this).data("url");
        window.location.href = baseUrl + url;
    }
});

$("#btn-changeRole-user").click(function () {
    let roleListID = "";
    $(".checkbox-role-user:checked").each(function () {
        roleListID += $(this).val() + ",";
    });
    roleListID = roleListID.slice(0, -1);
    $("#txt-value-roles").val(roleListID);
    $("#form-change-role-user").submit();
});

$("#check-all-role-user").change(function () {
    let isChecked = $(this).is(":checked");
    $(".checkbox-role-user").each(function () {
        if ($(this).val() != 1) {
            $(this).prop("checked", isChecked);
        }
    });
});

// EVENT AJAX CHOOSE TYPES BY ID CATEGORY
$("#category-news").on('change', function () {
    $.ajax({
        url: baseUrl + 'post/ajax/getTypesByCategory',
        type: 'POST',
        data: { id : $(this).val() },
        dataType: 'json',
        success: function (response) {
            $("#type-news").empty();
            response.forEach(types => $("#type-news").append('<option value="'+ types.id +'">'+ types.name +'</option>'));
        }
    });
});

// EVENT FOR POSITION
$("#list-position").change(function () {
    $("#position-name").val("");
    $("#position-id").val("");
    $("#btn-del-position").css("display", "none");
    let id = $(this).val();
    let text = $("#list-position option:selected").text();
    if (id != 0) {
        $("#position-id").val(id);
        $("#btn-del-position").css("display", "inline");
    }
    $("#position-name").val(text);
});

$("#btn-save-position").click(function () {
    $("#form-position").submit();
});

$("#btn-del-position").click(function () {
    if (confirm("Dữ liệu sẽ không thể phục hồi. Bạn có chắn chắn thực hiện xóa dữ liệu?")) {
        let url = "admin/position/delete/" + $("#position-id").val();
        window.location.href = baseUrl + url;
    }
});

// EVENT BIN
$(".btn-del-forever").click(function () {
    if (confirm("Dữ liệu liên quan của các bản khác cũng sẽ bị xóa và không thể phục hồi. Bạn có chắn chắn thực hiện xóa dữ liệu?")) {
        let url = $(this).data("url");
        window.location.href = baseUrl + url;
    }
});

$("#choose-bin-table").change(function () {
    $("#form-search-bin-data").submit();
});

$(".btn-update-bin-data").click(function () {
    if (confirm("Dữ liệu liên quan của các bản khác cũng sẽ được phục hồi. Bạn có chắn chắn thực hiện khôi phục dữ liệu?")) {
        let url = $(this).data("url");
        window.location.href = baseUrl + url;
    }
});

