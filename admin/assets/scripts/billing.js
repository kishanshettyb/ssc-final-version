var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = window.location.search.substring(1),
		sURLVariables = sPageURL.split("&"),
		sParameterName,
		i;
	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split("=");

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined
				? true
				: decodeURIComponent(sParameterName[1]);
		}
	}
};
var payMode = "T";
$(document).ready(function () {
	var gc_no = getUrlParameter("gc_no");

	// $("#subtotal,#gst,#total").attr("disabled", "true");

	$(".js-example-basic-single").select2();
	$(".js-example-basic-single-dynamic").select2({
		tags: true,
	});
	$(".select2-container--default").css("width", "100%");
	var hamali_charges = 0.0;
	var sc_charges = 0.0;
	var paymentType = "To Pay";
	getHamaliCharges();
	getSCCharges();
	getAllBranches();
	// getPolicy();
	calculateTotal();
	getBookingsCount(paymentType);

	// pay button
	if (typeof gc_no === "undefined") {
		$("#customRadioInline1:radio").attr("checked", true);

		var isChecked = $("#customRadioInline1").prop("checked");
		if (isChecked == true) {
			$(".v-line").text("TO PAY");
			paymode = "T";
			console.log(payMode);
		}
	}

	$(document)
		.find("input[type=radio][name=payment_mode]")
		.change(function () {
			if (this.value == "To Pay") {
				$(document).find(".v-line").text("TO PAY");
				payMode = "T";
				getBookingsCount(this.value);
			} else if (this.value == "Paid") {
				$(document).find(".v-line").text("PAID");
				payMode = "P";
				getBookingsCount(this.value);
			}
			console.log(payMode);
		});

	// get Bookings Count
	function getBookingsCount(paymentType) {
		var gc_no = getUrlParameter("gc_no");
		if (typeof gc_no === "undefined") {
			var total_rows;
			var admin_id = $("#admin_id").val();

			$.ajax({
				url:
					".../../../api/bookings/bookings_count.php?admin_id=" +
					admin_id +
					"&payment_mode=" +
					paymentType,
				type: "GET",
				dataType: "json",
				contentType: "application/json; charset=utf-8",
				success: function (data) {
					var formData = JSON.stringify(data);

					var total_rows = data.total_rows;
					var count = parseFloat(total_rows) + parseFloat(1);
					var branchname = $.trim($(".branch-text").attr("data-branch-name"));
					var threeword = branchname.substring(0, 3);

					$(".gc_no").text(threeword + "-" + payMode + "00" + count);
					$("#gc_no").val(threeword + "-" + payMode + "00" + count);
				},
				async: false,
			});
		} else {
			$(".gc_no").text(gc_no);
			$("#gc_no").val(gc_no);
		}
	}
	// get hamali charges
	function getHamaliCharges() {
		$.ajax({
			url: ".../../../api/hamali/read.php",
			type: "GET",
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			success: function (data) {
				var formData = JSON.stringify(data);
				$.each(data["records"], function (k, v) {
					hamali_charges = v.hamali_charge;
				});
			},
			async: false,
		});
	}

	//  get SC charges
	function getSCCharges() {
		$.ajax({
			url: ".../../../api/sc_charges/read.php",
			type: "GET",
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			success: function (data) {
				var formData = JSON.stringify(data);
				$.each(data["records"], function (k, v) {
					sc_charges = v.sc_charge;
				});
			},
			async: false,
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
				$("#branches").empty();
				$("#branches").append($("<option>").text("").attr("value", ""));
				$.each(data["records"], function (k, v) {
					$("#branches").append(
						$("<option id=" + v.branch_phone + ">")
							.text(
								v.branch_name + (v.branch_code ? " - " + v.branch_code : "")
							)
							.attr("value", v.branch_name)
					);
				});
			},
		});
	}

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
				});
			},
		});
	}

	// hamali
	$("#no_of_packages").keyup(function () {
		var no_of_packages = $(this).val();
		var hamalivaue;
		if (no_of_packages == "") {
			$("#hamali").val("00.00");
		} else {
			hamalivaue = parseFloat(hamali_charges * no_of_packages);
			$("#hamali").val(hamalivaue.toFixed(2));
		}
		calculateTotal();
	});

	// value of sc
	$("#consignment_value").keyup(function () {
		var consignment_value = $(this).val();
		var value_of_sc;

		// logic
		var x = 5000;
		var y = 5;
		var z = consignment_value;
		var diff = Math.ceil((parseFloat(z) - parseFloat(x)) / 5000);
		console.log(parseFloat(diff));
		if (diff < 0) {
			value_of_sc = 5;
			$("#value_of_sc").val(value_of_sc.toFixed(2));
		} else {
			value_of_sc = parseFloat(y) + diff * 3;
			$("#value_of_sc").val(value_of_sc.toFixed(2));
		}

		calculateTotal();
	});

	// sc
	$("#basic_freight").keyup(function () {
		var basic_freight = $(this).val();
		var res_basic_freight;
		if (basic_freight == "") {
			$("#sc").val(0.0);
		} else {
			res_basic_freight = parseFloat(basic_freight * 40) / 100;
			$("#sc").val(res_basic_freight.toFixed(2));
		}
		calculateTotal();
	});

	$(
		"#aoc, #with_pass, #stat_charges, #basic_freight, #transhipment, #c_charges, #d_charges,#value_of_sc"
	).keyup(function () {
		var $this = $(this);
		calculateTotal();
		setTimeout(function () {
			// if (isNaN(parseFloat($(this).val()))) {
			// 	console.log("1");
			// }
			$(this).val(parseFloat($(this).val()).toFixed(2));
		}, 2000);
	});

	//new changes

	var booking_id = getUrlParameter("booking_id");
	if (booking_id != "") {
		var isChecked = $("#customRadioInline1").prop("checked");
		if (isChecked == true) {
			$(".v-line").text("TO PAY");
			paymode = "T";
			console.log(payMode);
		}
		$(document)
			.find("input[type=radio][name=payment_mode]")
			.change(function () {
				console.log(this.value);
				if (this.value === "To Pay") {
					$(document).find(".v-line").text("TO PAY");
					payMode = "T";
					getBookingsCount(this.value);
				} else if (this.value === "Paid") {
					$(document).find(".v-line").text("PAID");
					payMode = "P";
					getBookingsCount(this.value);
				}
				console.log(payMode);
			});
	}
	//new changes
});

function calculateTotal() {
	var basic_freight = $("#basic_freight").val();
	var hamali = $("#hamali").val();
	var stat_charges = $("#stat_charges").val();
	var sc = $("#sc").val();
	var value_of_sc = $("#value_of_sc").val();
	var aoc = $("#aoc").val();
	var transhipment = $("#transhipment").val();
	var c_charges = $("#c_charges").val();
	var d_charges = $("#d_charges").val();
	var with_pass = $("#with_pass").val();

	if (transhipment == "") {
		transhipment = 0;
	}
	if (c_charges == "") {
		c_charges = 0;
	}
	if (d_charges == "") {
		d_charges = 0;
	}

	console.log(transhipment);
	var subTotal =
		parseFloat(basic_freight) +
		parseFloat(hamali) +
		parseFloat(stat_charges) +
		parseFloat(value_of_sc) +
		// parseFloat(aoc) +
		parseFloat(transhipment) +
		parseFloat(c_charges) +
		// parseFloat(d_charges) +
		parseFloat(with_pass);

	var gst;
	var total;

	if (isNaN(subTotal)) {
		gst = "";
		$("#gst").val(gst);
		$("#subtotal").val("0.00");
	} else {
		if (subTotal > 749.99) {
			gst = (subTotal * 5) / 100;
			$("#gst").val(gst.toFixed(0) + ".00");
		} else {
			$("#gst").val(0);
		}
		$("#subtotal").val(subTotal.toFixed(0) + ".00");
	}

	total = parseFloat(gst) + parseFloat(subTotal);
	console.log(gst);
	if (gst != "" && typeof gst != "undefined") {
		if (isNaN(total)) {
			total = "";
			$("#total").val(total);
		} else {
			$("#total").val(total.toFixed(0) + ".00");
		}
	} else {
		if (isNaN(subTotal)) {
			gst = "";
			$("#gst").val(gst);
			$("#total").val("0.00");
		} else {
			$("#total").val(subTotal.toFixed(0) + ".00");
		}
	}
}

$("#consignor_phone").keyup(function () {
	var keyword = $(this).val();
	consignor(keyword);
});

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
					$("#consignor_name_add").val("");
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

$(".consignor_dropdown").on("change", function () {
	$(".consignor_name_add").val(this.value);
});

$("#consignee_phone").keyup(function () {
	var keyword = $(this).val();
	consignee(keyword);
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
					$("#consignee_name_add").val("");
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

$(".consignee_dropdown").on("change", function () {
	$(".consignee_name_add").val(this.value);
});

// $("#bookingForm").on("submit", function (e) {
$(".btn-save-submit").on("click", function (e) {
	e.preventDefault();

	var c_charges = $("#c_charges").val();
	var d_charges = $("#d_charges").val();
	var transhipment = $("#transhipment").val();

	var fieldName;

	var form = $("#bookingForm");
	var data = form.serializeArray();
	var url, operation;
	var modal = "#dummy";
	var process = "bookings";
	var payment_mode = $("input[name=payment_mode]:checked").val();
	console.log(payment_mode);

	if ($("#booking_id").val() != "") {
		url = ".../../../api/bookings/update.php";
		operation = "updated";
	} else {
		url = ".../../../api/bookings/create.php";
		operation = "created";
	}

	validateFunction(form);

	if ($(form).valid()) {
		$(".lds-roller").css("display", "block");
		$("#bookingForm").css("opacity", "0.5");
		$(".buttons-row").css("display", "none");

		if (transhipment == "0.0") {
			fieldName = "transhipment";
			checkEmpty(fieldName);
		} else if (c_charges == "0.0") {
			fieldName = "c_charges";
			checkEmpty(fieldName);
		} else if (d_charges == "0.0") {
			fieldName = "d_charges";

			checkEmpty(fieldName);
		} else if (payment_mode == undefined) {
			swal("Alert!!", "Select Payment Mode", "info");
		} else {
			setTimeout(function () {
				ajaxPostRequest(url, data, modal, operation, process);
			}, 3000);
		}
	} else {
		console.log("not valid");
	}
});

function checkEmpty(fieldName) {
	swal({
		title: "Are you sure?",
		text: fieldName + "is empty!",
		icon: "warning",
		buttons: ["Add", "continue"],
		dangerMode: true,
	}).then((willDelete) => {
		if (willDelete) {
			$("#" + fieldName).val("0.00");
		} else {
			$("#" + fieldName).focus();
		}
	});
}

$(".printPage").click(function () {
	// $(".printSection").css("display", "none");
	// window.print();
	// setTimeout(function () {
	// 	$(".printSection").css("display", "block");
	// }, 100);
	$("#printModal").printThis({
		debug: false,
		importCSS: true,
		importStyle: true,
		printContainer: true,
		loadCSS: "../css/style.css",
		pageTitle: "My Modal",
		removeInline: false,
		printDelay: 333,
		header: null,
		formValues: true,
	});

	return false;
});

$(".reset").on("click", function functionName() {
	var gc_no = getUrlParameter("gc_no");
	if (gc_no != "") {
		window.location.replace("billing");
	} else {
		location.reload();
	}
});

var admin_id = getUrlParameter("admin_id");
var booking_id = getUrlParameter("booking_id");

if (typeof admin_id === "undefined" || booking_id === "undefined") {
	console.log("not found");
} else {
	var url = ".../../../api/bookings/read_one.php?booking_id=" + booking_id;
	var formName = "bookingForm";

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

			// populate data to form
			function populate(frm, formData) {
				$.each(formData, function (key, value) {
					$("[name=" + key + "]", frm).val(value);
				});
			}
			populate("#" + formName, $.parseJSON(formData));
			setTimeout(function () {
				$("#branches").val(to_place).trigger("change");
				console.log(consignor_name);
				console.log(consignee_name);
				$(document)
					.find("#consignor_name_add")
					.val(consignor_name)
					.trigger("change");
				$(document)
					.find("#consignee_name_add")
					.val(consignee_name)
					.trigger("change");
				var paymode = res.payment_mode;
				if (paymode == "Paid") {
					$(".v-line").text("PAID");
					paymode = "P";
					$(document).find("#customRadioInline2:radio").attr("checked", true);
					$(document).find("#customRadioInline2:radio").attr("value", "Paid");
				} else {
					$(".v-line").text("TO PAY");
					paymode = "P";
					$(document).find("#customRadioInline1:radio").attr("checked", true);
					$(document).find("#customRadioInline1:radio").attr("value", "To Pay");
				}
			}, 2000);
		},
	});
}

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

$(".currentDate").val(output);
$(".currentDate").text(milliseconds);

$(document).on("change", "select", function () {
	var val = $(this).val(); //get new value
	//find selected option
	$("option", this)
		.removeAttr("selected")
		.filter(function () {
			return $(this).attr("value") == val;
		})
		.first()
		.attr("selected", "selected"); //add selected attribute to selected option
});

$(".close-print-modal").on("click", function () {
	location.reload();
});
