$(document).ready(function () {
	getBranches();
});

// Get branches list to data table
function getBranches() {
	var table = $("#branchesTable").DataTable({
		ajax: {
			url: "../api/branches/read.php",
			dataSrc: "records",
		},
		columns: [
			{
				data: "branch_id",
				className: " branch_id hide",
			},
			{
				data: "branch_name",
			},
			{
				data: "branch_code",
			},
			{
				data: "branch_phone",
			},
			{
				data: "status",
				className: "action-row-large",
				render: function (data, type, row) {
					if (data == "active") {
						return "<b class='text-success'><i class='fa fa-check'></i> Active</b>";
					}
					return "<b class='text-danger'><i class='fa fa-times'></i> Inactive</b>";
				},
			},
			{
				data: "actions",
				className: "action-row-large",
				render: function (data, type, row) {
					return '<a class="btn btn-success btn-sm editBranch" href="#" role="button">Edit Branch</a><a class="btn btn-danger btn-sm deleteBranch" href="#" role="button">Delete Branch</a>';
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

	$("#branchesTable").DataTable().ajax.reload();
	//remove class from defult data table buttons
	$(".dt-buttons").find("button").removeClass("dt-button");
	$(".dataTables_empty").text("No Records Found");
}

// open modal and populate form
$(document).on("click", ".createBranch, .editBranch", function () {
	var btn = $(this).text();
	var url =
		"../api/branches/read_one.php?branch_id=" +
		$(this).closest("tr").find(".branch_id").text();
	var formName = "branchForm";

	$("#branchesModal").modal("show");

	if (btn == "Create New Branch") {
		$("#branchesModal .modal-title").text("Create New Branch");
		$("#branchForm").find("input").val("");
	} else if (btn == "Edit Branch") {
		$("#branchesModal .modal-title").text("Edit Branch");
		ajaxGetRequest(url, formName);
	}
});
$(document).on("click", ".deleteBranch", function () {
	var url = "../api/branches/update_status.php";
	var branch_id = $(this).closest("tr").find(".branch_id").text();
	var data = {
		branch_id: branch_id,
		status: "inactive",
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
				text: "Branch deleted successfully.",
				icon: "success",
			});
			getBranches();
		},
		error: function (xhr, textStatus, errorThrown) {
			swal("Oops...", "Something went wrong!", "error");
		},
	});
});

// create and update branch
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
			getBranches();
		}, 100);
	} else {
		console.log("Invalid Form");
	}
});

function upperCaseF(a) {
	setTimeout(function () {
		a.value = a.value.toUpperCase();
	}, 1);
}
