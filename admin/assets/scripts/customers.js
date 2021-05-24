$(document).ready(function () {
	getCustomers();
});

// Get admin list to data table
function getCustomers() {
	var table = $("#customersTable").DataTable({
		ajax: {
			url: "../api/customers/read.php",
			dataSrc: "records",
		},
		columns: [
			{
				data: "customer_id",
				className: "customer_id hide",
			},
			{
				data: "consignor_name",
			},
			{
				data: "consignor_phone",
			},
			{
				data: "consignee_name",
			},
			{
				data: "consignee_phone",
			},
			{
				data: "actions",
				className: "action-row-large",
				render: function (data, type, row) {
					return '<a class="btn btn-primary btn-sm editCustomer" href="#" role="button"><i class="fas fa-edit pr-2"></i>Edit Customer</a><a class="btn btn-danger btn-sm deleteCustomer" href="#" role="button"><i class="fas fa-trash pr-2"></i>Delete Customer</a>';
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

	$("#customersTable").DataTable().ajax.reload();
	//remove class from defult data table buttons
	$(".dt-buttons").find("button").removeClass("dt-button");
	$(".dataTables_empty").text("No Records Found");
}

$(document).on("click", ".deleteCustomer", function () {
	var url = "../api/customers/delete.php";
	var customer_id = $(this).closest("tr").find(".customer_id").text();
	var data = {
		customer_id: customer_id,
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
				text: "Customer deleted successfully.",
				icon: "success",
			});
			getCustomers();
		},
		error: function (xhr, textStatus, errorThrown) {
			swal("Oops...", "Something went wrong!", "error");
		},
	});
});

$(document).on("click", ".editCustomer", function () {
	var customer_id = $(this).closest("tr").find(".customer_id").text();
	var url = "../api/customers/read_one.php?customer_id=" + customer_id;

	$.ajax({
		url: url,
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (data) {
			var formData = JSON.stringify(data);

			$("#editCustomer").modal("show");
			function populate(frm, formData) {
				$.each(formData, function (key, value) {
					$("[name=" + key + "]", frm).val(value);
				});
			}
			populate("#edit-customer-form", $.parseJSON(formData));
		},
		error: function (xhr, textStatus, errorThrown) {
			swal("Oops...", "Something went wrong!", "error");
		},
	});
});

$("#edit-customer-form").on("submit", function (e) {
	e.preventDefault();

	var form = $(this);
	var data = form.serializeArray();
	var url, operation;
	var modal = "#editCustomer";
	var process = "customer";

	if ($("#customer_id").val() != "") {
		url = ".../../../api/customers/update.php";
		operation = "updated";
	} else {
		swal("Oops...", "Something went wrong!", "error");
	}

	validateFunction(form);

	if ($(form).valid()) {
		setTimeout(function () {
			ajaxPostRequest(url, data, modal, operation, process);
			swal({
				title: "Success",
				text: "Customer updated successfully.",
				icon: "success",
				timer: 2000,
			});
			getCustomers();
		}, 1000);
	} else {
		console.log("not valid");
	}
});
