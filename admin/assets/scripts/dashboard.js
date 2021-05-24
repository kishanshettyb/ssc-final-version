$(document).ready(function () {
	getBookings();
});

// Get admin list to data table
function getBookings() {
	var table = $("#bookingTable").DataTable({
		ajax: {
			url: "../api/bookings/read.php",
			dataSrc: "records",
		},
		columns: [
			{
				data: "booking_id",
				className: "booking_id hide",
			},
			{
				data: "admin_id",
				className: " admin_id hide",
			},
			{
				data: "gc_no",
				className: " gc_no  ",
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
				data: "gst",
			},
			{
				data: "total",
			},
			{
				data: "consignor_name_add",
			},
			{
				data: "consignee_name_add",
			},

			{
				data: "actions",
				className: "action-row-large",
				render: function (data, type, row) {
					return '<a class="btn btn-success btn-sm editBooking" href="#" role="button">Edit Booking</a><a class="btn btn-danger btn-sm edit_printBooking"  href="#"  role="button">Edit & Print Booking</a>';
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
