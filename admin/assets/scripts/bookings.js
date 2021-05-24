$(document).ready(function () {
	var branch = $(".branch-text").attr("data-branch-name");
	var branch_id = $(".branch-text").attr("data-branch-id");
	var url;
	if (branch == MAINBRANCH) {
		url = "../api/bookings/read.php";
	} else {
		url = "../api/bookings/read_branch.php?branch_id=" + branch_id;
	}
	getBookings(url);
});

// Get admin list to data table
function getBookings(url) {
	var table = $("#bookingTable").DataTable({
		ordering: false,
		ajax: {
			url: url,
			dataSrc: "records",
		},
		columns: [
			{
				data: "booking_id",
				className: "booking_id  hide",
			},
			{
				data: "admin_id",
				className: " admin_id hide",
			},
			{
				data: "gc_no",
				className: " gc_no",
			},
			{
				data: "date",
				render: function (data, type, row) {
					return moment(data).format("DD/MM/YYYY h:mm:ss a");
				},
			},

			{
				data: "to_place",
			},
			{
				data: "no_of_packages",
			},
			{
				data: "act_wt",
			},
			{
				data: "basic_freight",
			},
			{
				data: "subtotal",
			},
			{
				data: "gst",
			},
			{
				data: "delivery_charges",
				className: "action-row-large",
				render: function (data, type, row) {
					if (data === null) {
						return "<td>-</td>";
					} else {
						return "<td><b>" + data + "</b></td>";
					}
				},
			},

			{
				data: "total",
			},
			{
				data: "status",
				className: "action-row-large",
				render: function (data, type, row) {
					if (data == "booked") {
						return '<td><b  class="text-danger">' + data + "</b></td>";
					} else {
						return '<td><b  class="text-success">' + data + "</b></td>";
					}
				},
			},
			{
				data: "consignor_name_add",
			},
			{
				data: "consignee_name_add",
			},

			{
				data: "status",
				className: "action-row-large",
				render: function (data, type, row) {
					if (data == "delivered") {
						return "";
					} else {
						return '<a class="btn btn-success btn-sm editBooking" href="#" role="button">Edit Booking</a><a class="btn btn-danger btn-sm edit_printBooking"  href="#"  role="button">Edit & Print Booking</a>';
					}
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

	$("#bookingTable").DataTable().ajax.reload();
	//remove class from defult data table buttons
	$(".dt-buttons").find("button").removeClass("dt-button");
	$(".dataTables_empty").text("No Records Found");
}

$(document).on("click", ".editBooking", function () {
	$("#editBookingModal").modal("show");
	var url =
		"../api/bookings/read_one.php?booking_id=" +
		$(this).closest("tr").find(".booking_id").text();
	var formName = "bookingForm";
	ajaxGetRequest(url, formName);
});

$("#bookingForm").on("submit", function (e) {
	e.preventDefault();

	var form = $(this);
	var data = form.serializeArray();
	var url, operation;
	var modal = "#editBookingModal";
	var process = "bookings";

	if ($("#booking_id").val() != "") {
		url = "../api/bookings/update.php";
		operation = "updated";
	} else {
		alert("Something went wrong");
	}

	validateFunction(form);

	if ($(form).valid()) {
		ajaxPostRequest(url, data, modal, operation, process);
		setTimeout(function () {
			getBookings();
		}, 100);
	} else {
		console.log("Invalid Form");
	}
});

$(document).on("click", ".edit_printBooking", function () {
	var booking_id = $(this).closest("tr").find(".booking_id").text();
	var admin_id = $(this).closest("tr").find(".admin_id").text();
	var gc_no = $(this).closest("tr").find(".gc_no").text();
	window.location.href =
		"new-bookings.php?booking_id=" +
		booking_id +
		"&admin_id=" +
		admin_id +
		"&gc_no=" +
		gc_no;
});
