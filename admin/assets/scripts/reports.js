$.fn.datepicker.defaults.format = "yyyy-mm-dd";
$(document).ready(function () {
	$(".input-daterange input").each(function () {
		$(this).datepicker("clearDates");
	});
	getAllBranches();
	getBookings();
});

function getAllBranches() {
	$.ajax({
		url: ".../../../api/branches/read.php",
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (data) {
			var formData = JSON.stringify(data);
			$("#branches").empty();
			$("#branches").append($("<option>").text("All").attr("value", "All"));
			$.each(data["records"], function (k, v) {
				$("#branches").append(
					$("<option>")
						.text(v.branch_name + (v.branch_code ? " - " + v.branch_code : ""))
						.attr("value", v.branch_name)
				);
			});
		},
	});
}
// Get admin list to data table
function getBookings() {
	var branch = $.trim($(".branch-text").attr("data-branch-name"));
	var branch_id = $(".branch-text").attr("data-branch-id");

	var url;
	if (branch == "BENGALURU") {
		url = "../api/bookings/read.php";
		$(".branch-div").css("display", "block");
		setTimeout(function () {
			$(document).find("#branches").val(branch);
		}, 1000);
	} else {
		url = "../api/bookings/read_branch.php?branch_id=" + branch_id;
		setTimeout(function () {
			console.log(branch);
			$(document).find("#branches").val(branch);
		}, 2000);
	}
	var table = $("#bookingTable").DataTable({
		ordering: false,

		ajax: {
			url: url,
			dataSrc: "records",
		},
		columns: [
			{
				data: "gc_no",
				className: "gc_no",
			},

			{
				data: "date",
				render: function (data, type, row) {
					return moment(data).format("DD/MM/YYYY h:mm:ss a");
				},
			},
			{
				data: "from_place",
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
				data: "hamali",
			},
			{
				data: "stat_charges",
			},
			{
				data: "value_of_sc",
			},
			{
				data: "transhipment",
			},
			{
				data: "c_charges",
			},
			{
				data: "with_pass",
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
				data: "payment_mode",
			},
			{
				data: "consignor_name_add",
			},
			{
				data: "consignee_name_add",
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

// Filter Custome function
$("#filterForm").on("submit", function (e) {
	e.preventDefault();
	var form = $(this);
	var data = form.serializeArray();

	var start_date = $("#filterForm #start_date").val();
	var end_date = $("#filterForm #end_date").val();
	console.log(start_date);
	if (start_date == "") {
		start_date = "All";
	}
	if (end_date == "") {
		end_date = "All";
	}
	if ((start_date == end_date) != "All") {
		start_date = start_date + " 00:01:00.000000";
		end_date = end_date + " 23:59:00.000000";
	}
	var payment_mode = $("#filterForm #payment_mode option:selected").text();
	var branches = $("#filterForm #branches option:selected").val();
	var status = $("#filterForm #status option:selected").text();

	var url =
		"../api/bookings/filter.php?start_date=" +
		start_date +
		"&end_date=" +
		end_date +
		"&payment_mode=" +
		payment_mode +
		"&status=" +
		status +
		"&branch_name=" +
		branches;

	setTimeout(function () {
		$.ajax({
			url: url,
			type: "GET",
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			success: function (data) {
				var formData = JSON.stringify(data);
				var message = data.message;
				if (message == "No data found") {
					$.toast({
						text: "No results found.", // Text that is to be shown in the toast
						heading: "Not Found", // Optional heading to be shown on the toast
						icon: "error", // Type of toast icon
						showHideTransition: "fade", // fade, slide or plain
						allowToastClose: true, // Boolean value true or false
						hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
						stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
						position: "top-center", // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
						textAlign: "left", // Text alignment i.e. left, right or center
						loader: true, // Whether to show loader or not. True by default
						loaderBg: "#9EC600", // Background color of the toast loader
					});
					var table = $("#bookingTable").DataTable();
					table.clear().draw();
				} else {
					$.toast({
						text: "Results Found.", // Text that is to be shown in the toast
						heading: "Success", // Optional heading to be shown on the toast
						icon: "success", // Type of toast icon
						showHideTransition: "fade", // fade, slide or plain
						allowToastClose: true, // Boolean value true or false
						hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
						stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
						position: "top-center", // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
						textAlign: "left", // Text alignment i.e. left, right or center
						loader: true, // Whether to show loader or not. True by default
						loaderBg: "#00d278", // Background color of the toast loader
					});
					var table = $("#bookingTable").DataTable();
					table.destroy();
					var table = $("#bookingTable").DataTable({
						ordering: false,

						ajax: {
							url: url,
							dataSrc: "records",
						},
						columns: [
							{
								data: "gc_no",
								className: "gc_no",
							},

							{
								data: "date",
								render: function (data, type, row) {
									return moment(data).format("DD/MM/YYYY h:mm:ss a");
								},
							},
							{
								data: "from_place",
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
								data: "hamali",
							},
							{
								data: "stat_charges",
							},
							{
								data: "value_of_sc",
							},
							{
								data: "transhipment",
							},
							{
								data: "c_charges",
							},
							{
								data: "with_pass",
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
								data: "payment_mode",
							},
							{
								data: "consignor_name_add",
							},
							{
								data: "consignee_name_add",
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
						select: true,
					});
					$("#bookingTable").DataTable().ajax.reload();
					$.fn.dataTable.ext.errMode = "none";
					//remove class from defult data table buttons
					$(".dt-buttons").find("button").removeClass("dt-button");
					$(".dataTables_empty").text("No Records Found");
				}
			},
		});
	});
});
