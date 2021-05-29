$(document).ready(function () {
	getAdmins();
	getAllBranches();
});

// Get admin list to data table
function getAdmins() {
	var table = $("#adminTable").DataTable({
		ajax: {
			url: "../api/admin/read.php",
			dataSrc: "records",
		},
		columns: [
			{
				data: "admin_id",
				className: " admin_id hide",
			},
			{
				data: "name",
			},
			{
				data: "phone",
			},
			{
				data: "email",
			},
			{
				data: "username",
			},
			{
				data: "actions",
				className: "action-row-large",
				render: function (data, type, row) {
					return '<a class="btn btn-success btn-sm editAdmin" href="#" role="button">Edit Admin</a><a class="btn btn-danger btn-sm deleteAdmin" href="#" role="button">Delete Admin</a>';
				},
			},
		],
		dom: "Blfrtip",
		buttons: [
			{
				extend: "copy",
				text: '<i class="fa fa-copy"></i> &nbsp;&nbsp;COPY',
				className: "dt-button buttons-copy buttons-html5",
			},
			{
				extend: "excel",
				text: '<i class="fa fa-file-excel-o"></i> &nbsp;&nbsp;EXCEL',
				className: "dt-button buttons-copy buttons-html5",
			},
			{
				extend: "pdf",
				text: '<i class="fa fa-file-pdf-o"></i> &nbsp;&nbsp;PDF',
				className: "dt-button buttons-copy buttons-html5",
			},
			{
				extend: "print",
				text: '<i class="fa fa-print"></i> &nbsp;&nbsp;PRINT',
				className: "dt-button buttons-copy buttons-html5",
			},
		],
		language: {
			paginate: {
				next: '<i class="fas fa-angle-right"></i>', // or '→'
				previous: '<i class="fas fa-angle-left"></i>', // or '←'
			},
		},
		select: false,
	});
	$.fn.dataTable.ext.errMode = "none";

	$("#adminTable").DataTable().ajax.reload();
	//remove class from defult data table buttons
	$(".dt-buttons").find("button").removeClass("dt-button");
	$(".dataTables_empty").text("No Records Found");
}

// get branches todropdown
function getAllBranches() {
	$.ajax({
		url: "../api/branches/read.php",
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (data) {
			var formData = JSON.stringify(data);
			console.log(formData);
			$("#branches").empty();
			$.each(data["records"], function (k, v) {
				$("#branches").append(
					$("<option>")
						.text(v.branch_name)
						.attr("value", v.branch_name)
						.attr("data-branch-id", v.branch_id)
				);
			});
		},
	});
}
// Populate admin
$(".create_branch").on("click", function () {
	$("#branchesModal").modal("show");
});

$("#branchForm").on("submit", function (e) {
	e.preventDefault();

	var form = $(this);
	var data = form.serializeArray();
	var url, operation;
	var modal = "#branchesModal";
	var process = "branches";

	if ($("#branch_id_form").val() != "") {
		url = "../api/branches/update.php";
		operation = "updated";
	} else {
		url = "../api/branches/create.php";
		operation = "created";
	}

	validateFunction(form);

	if ($(form).valid()) {
		ajaxPostRequest(url, data, modal, operation, process);
		setTimeout(function () {
			getAllBranches();
		}, 100);
	} else {
		console.log("Invalid Form");
	}
});

// create and update admin
$(document).on("click", ".createAdmin, .editAdmin", function () {
	var btn = $(this).text();
	var url =
		"../api/admin/read_one.php?admin_id=" +
		$(this).closest("tr").find(".admin_id").text();
	var formName = "adminForm";

	$("#adminModal").modal("show");

	if (btn == "Create New Admin") {
		$("#adminModal .modal-title").text("Create New Admin");
		$("#adminForm").find("input").val("");
		setTimeout(function () {
			$("#adminForm").find("input[name='profile']").val("icon-new.png");
		});
		$("#branch_id").val(
			$("select#branches option").filter(":selected").attr("data-branch-id")
		);
	} else if (btn == "Edit Admin") {
		$("#adminModal .modal-title").text("Edit Admin");
		// ajaxGetRequest(url, formName);
		$.ajax({
			url: url,
			type: "GET",
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			success: function (data) {
				var formData = JSON.stringify(data);

				var branches = data.branches;
				var res = JSON.parse(formData);
				var to_place = res.to_place;
				console.log(to_place);

				// populate data to form
				function populate(frm, formData) {
					$.each(formData, function (key, value) {
						$("[name=" + key + "]", frm).val(value);
					});
				}
				populate("#" + formName, $.parseJSON(formData));
			},
		});
	}
});

$(document).on("click", ".deleteAdmin", function () {
	var url = "../api/admin/delete.php";
	var admin_id = $(this).closest("tr").find(".admin_id").text();
	var data = {
		admin_id: admin_id,
	};
	$.ajax({
		url: url,
		type: "POST",
		dataType: "json",
		data: JSON.stringify(data),
		contentType: "application/json; charset=utf-8",
		success: function (data) {
			swal({
				title: "Success",
				text: "admin deleted successfully.",
				icon: "success",
			});
			getAdmins();
		},
		error: function (xhr, textStatus, errorThrown) {
			swal("Oops...", "Something went wrong!", "error");
		},
	});
});

// create branch
$("#branchForm").on("submit", function (e) {
	e.preventDefault();

	var form = $(this);
	var data = form.serializeArray();
	var url, operation;
	var modal = "#branchesModal";
	var process = "branches";

	if ($("#branch_id").val() != "") {
		url = "../api/branches/update.php";
		operation = "updated";
	} else {
		url = "../api/branches/create.php";
		operation = "created";
	}

	validateFunction(form);

	if ($(form).valid()) {
		ajaxPostRequest(url, data, modal, operation, process);
		setTimeout(function () {
			getAllBranches();
		}, 100);
	} else {
		console.log("Invalid Form");
	}
});

//create and update admin
$("#adminForm").on("submit", function (e) {
	e.preventDefault();

	var form = $(this);
	var data = {
		admin_id: $("#adminForm").find(".admin_id").val(),
		username: $("#adminForm").find(".username").val(),
		password: $("#adminForm").find(".password").val(),
		name: $("#adminForm").find(".name").val(),
		email: $("#adminForm").find(".email").val(),
		phone: $("#adminForm").find(".phone").val(),
		address: $("#adminForm").find(".address").val(),
		branch: $("#branches :selected").text(),
		profile: $("#adminForm").find(".profile").val(),

		branch_id: $("#branches :selected").attr("data-branch-id"),
	};
	var url, operation;
	var modal = "#adminModal";
	var process = "admin";

	if ($("#admin_id").val() != "") {
		url = "../api/admin/update.php";
		operation = "updated";
	} else {
		url = "../api/admin/create.php";
		operation = "created";
	}

	validateFunction(form);

	if ($(form).valid()) {
		// ajaxPostRequest(url, data, modal, operation, process);
		$.ajax({
			url: url,
			type: "POST",
			dataType: "json",
			data: JSON.stringify(data),
			contentType: "application/json; charset=utf-8",
			success: function (data) {
				$(modal).modal("hide");
				var message = data.message;
				console.log(process, modal);
				sweetAlert(message, operation, process);
			},
			error: function (xhr, textStatus, errorThrown) {
				swal("Oops...", "Something went wrong!", "error");
			},
		});
		setTimeout(function () {
			getAdmins();
		}, 1000);
	} else {
		console.log("Invalid Form");
	}
});

$(document).on("change", "#branches", function (e) {
	var optionSelected = $("option:selected", this);
	// var valueSelected = this.attr("data-branch-id");
	$("#branch_id").val(optionSelected.attr("data-branch-id"));
});

function upperCaseF(a) {
	setTimeout(function () {
		a.value = a.value.toUpperCase();
	}, 1);
}

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
