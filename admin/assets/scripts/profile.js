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
			if (data.profile != null) {
				$(".rounded-circle").attr(
					"src",
					"assets/img/profile-image/" + data.profile
				);
			}

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

$(".upload-photo").on("click", function () {
	$("#profile-modal").modal("show");
});

/*------------------------------------------------------------------------------
Start upload Profile Pic Images
------------------------------------------------------------------------------*/
Dropzone.autoDiscover = false;

$(document).ready(function () {
	var currentFile = null;

	Dropzone.autoDiscover = false;
	if (document.getElementById("upload_file")) {
		var myDropzone = new Dropzone("#upload_file", {
			addRemoveLinks: true,
			url: "../admin/upload.php",
			addRemoveLinks: true,
			acceptedFiles: "image/*",
			maxFilesize: 1,
			init: function () {
				console.log("init");
				this.on("error", function (file, message) {
					swal({
						title: "Error",
						text: message,
						icon: "error",
						button: "Ok",
					});
					this.removeFile(file);
				});
			},
			// uploadMultiple:true,
			// parallelUploads:10,
			removedfile: function (file) {
				var _ref;
				return (_ref = file.previewElement) != null
					? _ref.parentNode.removeChild(file.previewElement)
					: void 0;
			},
			success: function (file, response) {
				var imgName = response;
				var updated_design_file_id = response;

				if (imgName == "file name exist") {
					swal(
						"File name already Exist!",
						"Please give different filename and try again.",
						"error"
					);
				} else {
					swal("Success", "File Uploaded Successfully!", "success");
					$("#profile").val(imgName);
					setTimeout(function () {
						$("#profile-modal").modal("hide");
					}, 1000);
					var myDropzone = Dropzone.forElement("#upload_file");
					myDropzone.removeAllFiles();
				}
			},
		});
		myDropzone.on("sending", function (file, xhr, formData) {
			var dest_folder = $("#upload_file").attr("data-btn");
			var folder_name = "assets/img/profile-image";
			console.log(folder_name);
			formData.append("folder_name", folder_name);
		});
	}
});
