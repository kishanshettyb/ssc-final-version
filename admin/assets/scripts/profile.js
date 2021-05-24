$(document).ready(function () {
	getAdminDetails();
});
var admin_id = $("nav").attr("data-admin-id");

function getAdminDetails() {
	$.ajax({
		url: ".../../../api/admin/read_one.php?admin_id=" + admin_id,
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (data) {
			console.log(data);
			$(".admin-name").text(data.name);
			$(".branch-name").text(data.branch);
			$(".branch-phone").text(data.phone);
			$(".branch-email").text(data.email);

			var formData = JSON.stringify(data);

			function populate(frm, formData) {
				$.each(formData, function (key, value) {
					$("[name=" + key + "]", frm).val(value);
				});
			}
			populate("#profile-form", $.parseJSON(formData));
		},
		error: function (xhr, textStatus, errorThrown) {
			swal("Oops...", "Something went wrong!", "error");
		},
	});
}

$(document).on("click", ".editProfile", function () {
	$("#edit-profile-modal").modal("show");
	var url = ".../../../api/admin/read_one.php?admin_id=" + admin_id;
	var formName = "edit-profile-form";
	ajaxGetRequest(url, formName);
});

$("#edit-profile-form").on("submit", function (e) {
	e.preventDefault();

	var form = $(this);
	var data = form.serializeArray();
	var url, operation;
	var modal = "#edit-profile-modal";
	var process = "admin";

	if ($("#admin_id").val() != "") {
		url = "../api/admin/update.php";
		operation = "updated";
	} else {
		alert("Something went wrong");
	}

	validateFunction(form);

	if ($(form).valid()) {
		ajaxPostRequest(url, data, modal, operation, process);
		setTimeout(function () {
			getAdminDetails();
		}, 1000);
	} else {
		console.log("Invalid Form");
	}
});

$(document).on("click", ".showpasword", function (e) {
	e.preventDefault();
	$(".showpasword").find("i").toggleClass("fa-eye-slash");
	var x = $(".password");
	if (x.attr("type") == "password") {
		x.attr("type", "text");
	} else {
		x.attr("type", "password");
	}
});
