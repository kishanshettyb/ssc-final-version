var global_total = 0;

$(document).ready(function () {
	getAllBranches();
	getPolicy();
	$("#bookingForm").find("select,input").attr("disabled", true);
	$("#bookingForm").find("select,input").css("background-color", "#f3f3f3");

	$("#consignor_name_add, #consignee_name_add").css(
		"width",
		"calc(100% - 30px)!important"
	);
	$(".js-example-basic-single").select2();
	$(".js-example-basic-single-dynamic").select2({
		tags: true,
	});
});

// current Date
var d = new Date();

var month = d.getMonth() + 1;
var day = d.getDate();

var output =
	d.getFullYear() +
	"-" +
	(("" + month).length < 2 ? "0" : "") +
	month +
	"-" +
	(("" + day).length < 2 ? "0" : "") +
	day;

var from = output;
var milliseconds = moment(from, "YYYY-MM-DD").format("DD-MM-YYYY");
var f = new Date(milliseconds);
console.log(output)
$(".currentDateToday").val(output);
$(".currentDateToday").text(milliseconds);
// get Policy
function getPolicy() {
	$.ajax({
		url: ".../../../api/policy/read.php",
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (data) {
			var formData = JSON.stringify(data);
			$.each(data["records"], function (k, v) {
				$("#policy").val(v.policy_name);
				$("#del_policy").val(v.policy_name);
			});
		},
	});
}
// get branches todropdown
function getAllBranches() {
	$.ajax({
		url: ".../../../api/branches/read.php",
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (data) {
			var formData = JSON.stringify(data);
			$("#branches,  #del_branches,#search_branches").empty();
			$("#branches, #del_branches,#search_branches").append(
				$("<option>").text("").attr("value", "")
			);
			$.each(data["records"], function (k, v) {
				$("#branches , #del_branches,#search_branches").append(
					$("<option id=" + v.branch_phone + ">")
						.text(v.branch_name)
						.attr("value", v.branch_name)
				);
			});
		},
	});
}

$("#search_booking").on("submit", function (e) {
	$("#delivery_charges,#total").attr("disabled", false);
	$("#branches").attr("disabled", false);
	$("#consignee_name_add").attr("disabled", false);
	$("#consignor_name_add").attr("disabled", false);
	$("#delivery_charges,#total").css("background-color", "#fff");
	e.preventDefault();
	var gc_no = $("#gc_no_input").val();
	var form = $(this);

	var branch = $(".branch-text").attr("data-branch-name");
	var to_place = $("#search_branches").find(":selected").val();
	var branch_id = $(".branch-text").attr("data-branch-id");
	var url;
	if (branch == MAINBRANCH) {
		url = "../api/bookings/read_one_gc_no.php?gc_no=" + gc_no;
	} else {
		url = "../api/bookings/read_one_gc_no.php?gc_no=" + gc_no;
	}

	validateFunction(form);

	if ($(form).valid()) {
		$.ajax({
			url: url,
			type: "GET",
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			success: function (data) {
				if (data.payment_mode == "Paid") {
					$(".paid-hide").css("display", "none");
				} else {
					$(".paid-hide").css("display", "inline-block");
				}
				if (data.status === null) {
					swal("Not Found", "No data found", "error");
					$(".new-receipt").addClass("hide");
				} else if (data.status === "delivered") {
					$(".receiving-print-btn").css("display", "block");
					$(".recieving-row").css("display", "none");
					$(".delivered-row").css("display", "block");
					$(".new-receipt").removeClass("hide");
					$(".receivingsTable").css("display", "block");
					$(".receivingsForm").css("display", "none");
					getDeliveryInfo(data.booking_id);
				} else {
					$(".receiving-print-btn").css("display", "none");

					$(".recieving-row").css("display", "block");
					$(".delivered-row").css("display", "none");
					$(".receivingsForm").css("display", "block");
					$(".receivingsTable").css("display", "none");
					$(".new-receipt").removeClass("hide");
				}
				var formData = JSON.stringify(data);
				var res = JSON.parse(formData);
				var to_place = res.to_place;
				var consignor_phone = res.consignor_phone;
				var consignee_phone = res.consignee_phone;
				var consignee_name = res.consignee_name_add;
				var consignor_name = res.consignor_name_add;
				global_total = res.total;
				$("#total").text(res.total);
				$(".total-charges").text(res.total);

				$(document).find("#booking_id_bill").val(res.booking_id);
				console.log(res.booking_id);
				console.log(global_total);
				$(document)
					.find(".currentDate")
					.text(moment(res.date).format("DD-MM-YYYY"));
				$(document)
					.find(".currentDate")
					.val(moment(res.date).format("DD-MM-YYYY"));
				$(".gc_no").text(res.gc_no);
				$("#gc_no").val(res.gc_no);
				var paymode = res.payment_mode;
				if (paymode == "Paid") {
					$(".v-line").text("PAID");
					paymode = "P";
					$(document).find("#customRadioInline2:radio").attr("checked", true);
					$(document).find("#customRadioInline2:radio").attr("value", "Paid");
				} else {
					$(".v-line").text("TO PAY");
					paymode = "P";
					$(document).find("#customRadioInline1").attr("checked", true);
					$(document).find("#customRadioInline1").attr("value", "To Pay");
				}
				consignor(consignor_phone);
				consignee(consignee_phone);
				// populate data to form
				function populate(frm, formData) {
					$.each(formData, function (key, value) {
						$("[name=" + key + "]", frm).val(value);
					});
				}
				populate("#bookingForm", $.parseJSON(formData));
				populate("#recievings-bill-card-form", $.parseJSON(formData));
				if (res.status === "delivered") {
					populate("#delivered-info-form", $.parseJSON(formData));
				}
				setTimeout(function () {
					$("#branches").val(to_place).trigger("change");
					$(document)
						.find("#consignor_name_add, #del_consignor_name_add")
						.val(consignor_name)
						.trigger("change");
					$(document)
						.find("#consignee_name_add,#del_consignee_name_add")
						.val(consignee_name)
						.trigger("change");
				}, 2000);
			},
			error: function (xhr, textStatus, errorThrown) {
				swal("Not Found", "No data found", "error");
			},
		});
	} else {
		swal("Alert!", "Please enter Goods consignment No", "info");
	}
});

function consignee(keyword) {
	if (keyword != "") {
		$.ajax({
			url: ".../../../api/customers/search_consignee.php?s=" + keyword,
			type: "GET",
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			error: function (xhr, status, error) {
				var err = eval("(" + xhr.responseText + ")");
				var $remote = $("#consignee_name_add");
				if (err.message == "No consignee_name found.") {
					$(".consignee_dropdown").css("display", "none");
					$(".consignee_dropdown").empty();
					$(".consignee_name_add").val("");
				}
				console.log(err.message);
			},
			success: function (data) {
				var formData = JSON.stringify(data);
				$(".consignee_dropdown").css("display", "block");
				$(".consignee_dropdown").empty();
				$(".consignee_dropdown").append($("<option>--Select--</option>"));
				$.each(data["records"], function (k, v) {
					$(".consignee_dropdown").append(
						$("<option>").text(v.consignee_name).attr("value", v.consignee_name)
					);
				});
			},
		});
	} else {
		$(".consignee_name_add").val("");
		$(".consignee_dropdown").empty();
		$(".consignee_dropdown").css("display", "none");
	}
}

function consignor(keyword) {
	if (keyword != "") {
		$.ajax({
			url: ".../../../api/customers/search_consignor.php?s=" + keyword,
			type: "GET",
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			error: function (xhr, status, error) {
				var err = eval("(" + xhr.responseText + ")");
				if (err.message == "No consignor_name found.") {
					$(".consignor_dropdown").css("display", "none");
					$(".consignor_dropdown").empty();
					$(".consignor_name_add").val("");
				}
			},
			success: function (data) {
				var formData = JSON.stringify(data);
				$(".consignor_dropdown").css("display", "block");
				$(".consignor_dropdown").empty();
				$(".consignor_dropdown").append($("<option>--Select--</option>"));
				$.each(data["records"], function (k, v) {
					$(".consignor_dropdown").append(
						$("<option>").text(v.consignor_name).attr("value", v.consignor_name)
					);
				});
			},
		});
	} else {
		$(".consignor_dropdown").css("display", "none");
		$(".consignor_dropdown").empty();
		$(".consignor_name_add").val("");
	}
}

$(".btn-save-submit").on("click", function (e) {
	e.preventDefault();
	var booking_id = $("#booking_id").val();
	var deliveryCharge = $.trim($(document).find("#delivery_charges").val());
	console.log(deliveryCharge);
	if (booking_id != "") {
		if (
			typeof deliveryCharge === "undefined" ||
			deliveryCharge === null ||
			deliveryCharge === ""
		) {
			swal("Alert", "Please enter delivery charge", "error");
		} else {
			$("#receivingsModal").modal("show");
		}
		$("#rec_booking_id").val(booking_id);
		$("#rec_delivery_charges").val($("#delivery_charges").val());
	} else {
		swal("Oops...", "Something went wrong!", "error");
	}
});

$(".receivingsForm").on("submit", function (e) {
	e.preventDefault();
	var booking_id = $(document).find("#booking_id_bill").val();

	var form = $(this);
	var data = {
		booking_id: $(document).find("#booking_id_bill").val(),
		receiving_name: $(document).find(".receivingsForm .receiving_name").val(),
		receiving_phone: $(document).find(".receivingsForm .receiving_phone").val(),
		delivery_charges: $(document)
			.find(".receivingsForm .delivery_charges")
			.val(),
	};
	var url = "../api/receivings/create.php";
	console.log(booking_id);
	validateFunction(form);

	if ($(form).valid()) {
		$.ajax({
			url: url,
			type: "POST",
			dataType: "json",
			data: JSON.stringify(data),
			contentType: "application/json; charset=utf-8",
			success: function (data) {
				global_total = data.total;
				console.log(data.total);
				updateStatus(booking_id);
			},
		});
	} else {
		console.log("Invalid Form");
	}
});

function updateStatus(booking_id) {
	var updateData = {
		status: "delivered",
		booking_id: booking_id,
		delivery_charges: $("#delivery_charges").val(),
		total: $("#total").text(),
	};
	if (booking_id != "") {
		$.ajax({
			url: "../api/bookings/update_status.php",
			type: "POST",
			dataType: "json",
			data: JSON.stringify(updateData),
			contentType: "application/json; charset=utf-8",
			success: function (data) {
				var message = data.message;

				if (message == "bookings was updated.") {
					swal({
						title: "Success",
						text: "Recieving created successfully.",
						icon: "success",
						timer: 2000,
					});
					$("#receivingsModal").modal("hide");
					$(".submit-delivery").css("display", "none");
					$(document)
						.find(".receivingsForm .receiving_name")
						.attr("disabled", true);
					$(document)
						.find(".receivingsForm .delivery_charges")
						.attr("disabled", true);
					$(document)
						.find(".receivingsForm .receiving_phone")
						.attr("disabled", true);
					setTimeout(function () {
						$("#printModal").modal({
							keyboard: false,
							show: true,
							backdrop: "static",
						});

						$(".section-1")
							.clone()
							.appendTo(".section-2, .section-3, .section-4");
						// $(".consignor_dropdown").clone();

						$(".section-1 .lds-roller").css("display", "none");
						$(".section-2 .lds-roller").css("display", "none");
						$(".section-3 .lds-roller").css("display", "none");

						$(".section-1 .bookingForm").css("opacity", "1");
						$(".section-2 .bookingForm").css("opacity", "1");
						$(".section-3 .bookingForm").css("opacity", "1");

						$(".printSection").css("display", "block");
						$("html, body").animate(
							{
								scrollTop: $(document).height(),
							},
							"slow"
						);
						var booking_id = $("#booking_id").val();
						console.log(booking_id);
						var url =
							".../../../api/bookings/read_one.php?booking_id=" + booking_id;

						$.ajax({
							url: url,
							type: "GET",
							dataType: "json",
							contentType: "application/json; charset=utf-8",
							success: function (data) {
								var formData = JSON.stringify(data);

								console.log(data);

								var res = JSON.parse(formData);
								var to_place = res.to_place;

								var consignor_phone = res.consignor_phone;
								var consignee_phone = res.consignee_phone;

								var consignee_name = res.consignee_name_add;
								var consignor_name = res.consignor_name_add;

								$(document)
									.find(".currentDate")
									.text(moment(res.date).format("DD-MM-YYYY"));
								$(document)
									.find(".currentDate")
									.val(moment(res.date).format("DD-MM-YYYY"));

								consignor(consignor_phone);
								consignee(consignee_phone);

								setTimeout(function () {
									$("#printModal #branches").val(to_place).trigger("change");
									console.log(consignor_name);
									console.log(consignee_name);
									console.log(to_place);
									$(document)
										.find("#printModal #consignor_name_add")
										.val(consignor_name)
										.trigger("change");
									$(document)
										.find("#printModal #consignee_name_add")
										.val(consignee_name)
										.trigger("change");

									var branchname = $("#branches").find(":selected").text();
									var branchphone = $("#branches").find(":selected").attr("id");
									$(".buttons-row")
										.parent()
										.append(
											`<p class="branch-and-phone"><span class="foot-text"> Branch: ` +
												branchname +
												`</span><span class="foot-text"> Phone No: ` +
												branchphone +
												`</span></p>`
										);
								}, 2000);
							},
						});
					}, 1000);
				}
			},
		});
	} else {
		swal("Something went wrong", "No data found", "error");
	}
}
$(document)
	.find("#delivery_charges")
	.keyup(function () {
		var deliveryCharge = parseFloat($(this).val());
		var total = parseFloat(global_total);
		if (isNaN(deliveryCharge)) {
			$("#total").text(global_total);
		} else {
			calculate(total, deliveryCharge);
		}
	});

function calculate(total, deliveryCharge) {
	var sum = (total + deliveryCharge).toFixed(2);
	$("#total").text(sum);
}

document.getElementById("print").onclick = function () {
	printElement(document.getElementById("printThis"));
};

function printElement(elem) {
	var domClone = elem.cloneNode(true);

	var $printSection = document.getElementById("printSection");

	if (!$printSection) {
		var $printSection = document.createElement("div");
		$printSection.id = "printSection";
		document.body.appendChild($printSection);
	}

	$printSection.innerHTML = "";
	$printSection.appendChild(domClone);
	window.print();
}

$(".close-print-modal").on("click", function () {
	location.reload();
});

function getDeliveryInfo(booking_id) {
	$.ajax({
		url: ".../../../api/receivings/read_one.php?booking_id=" + booking_id,
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (data) {
			var formData = JSON.stringify(data);
			console.log(data);
			$(document)
				.find(".receivingsTable .receiver_name")
				.val(data.receiving_name);
			$(document)
				.find(".receivingsTable .receiver_phone")
				.val(data.receiving_phone);
			$(document)
				.find(".receivingsTable .receiver_time")
				.val(data.receiving_date_time);
			$(document)
				.find(".receivingsTable .delivery_charges")
				.val(parseInt(data.delivery_charges).toFixed(2));
				$(document)
				.find(".receivingsTable .topay_charges")
				.val(parseInt(data.total-data.delivery_charges).toFixed(2));
			$(document).find("#printThis .receiver_name").val(data.receiving_name);
			$(document).find("#printThis .receiver_phone").val(data.receiving_phone);
			$(document)
				.find("#printThis .receiver_time")
				.val(data.receiving_date_time);
			$(document)
				.find("#printThis .delivery_charges")
				.val(data.delivery_charges);

			// function populate(frm, formData) {
			// 	$.each(formData, function (key, value) {
			// 		$("[name=" + key + "]", frm).val(value);
			// 	});
			// }
			// populate(".receivingsForm", $.parseJSON(formData));
		},
	});
}

$(".receiving-print-btn").on("click", function (e) {
	e.preventDefault();
	var booking_id = $(document).find("#booking_id_bill").val();
	setTimeout(function () {
		$(document).find(".section-1").clone().appendTo(".section-2, .section-3");
		$("#printModal").modal({
			keyboard: true,
			show: true,
			backdrop: "static",
		});
	}, 500);
});
