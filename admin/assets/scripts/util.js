$(".menu-icon").on("click", function (e) {
	e.preventDefault();
	$(".main-content").toggleClass("hide-sidebar");
	$(".main-content .container-fluid.mt--7").toggleClass("bg-body-gray");
});

//get form input data
function getFormData(data) {
	var unindexed_array = data;
	var indexed_array = {};
	$.map(unindexed_array, function (n, i) {
		indexed_array[n["name"]] = n["value"];
	});
	return indexed_array;
}

// validation
function validateFunction(form) {
	$(form).validate({
		rules: {
			branch_name: {
				required: true,
			},
			// branch_code: {
			// 	required: true,
			// },
			username: {
				required: true,
			},
			password: {
				required: true,
			},
			name: {
				required: true,
			},
			// email: {
			// 	required: true,
			// },
			phone: {
				required: true,
				digits: true,
				minlength: 10,
			},
			address: {
				required: true,
			},
			no_of_packages: {
				required: true,
				digits: true,
			},
			hamali_charge: {
				required: true,
				digits: true,
			},
			hamali: {
				required: true,
			},
			consignment_value: {
				required: true,
				digits: true,
			},
			sc_charge: {
				required: true,
				digits: true,
			},
			policy_name: {
				required: true,
			},
			from_place: {
				required: true,
			},
			to_place: {
				required: true,
			},
			consignor_phone: {
				required: true,
				digits: true,
			},
			consignee_phone: {
				required: true,
				digits: true,
			},
			consignor_name_add: {
				required: true,
			},
			consignee_name_add: {
				required: true,
			},
			consignor_name: {
				required: true,
			},
			consignee_name: {
				required: true,
			},
			// extra
			act_wt: {
				required: true,
				digits: true,
			},
			desc_of_goods: {
				required: true,
			},
			basic_freight: {
				required: true,
			},
			stat_charges: {
				required: true,
			},
			sc: {
				required: true,
			},
			value_of_sc: {
				required: true,
			},
			aoc: {
				required: true,
			},
			transhipment: {
				required: true,
			},
			c_charges: {
				required: true,
			},
			d_charges: {
				required: true,
			},
			with_pass: {
				required: true,
			},
			gst: {
				required: true,
			},
			total: {
				required: true,
			},
			eway_bill_no: {
				required: function () {
					return $("#consignment_value").val() >= 50000;
				},
			},
		},
		messages: {
			username: {
				required: "Please enter username",
			},
			password: {
				required: "Please enter password",
			},
			branch_name: {
				required: "Please enter branch name",
			},
			// branch_code: {
			// 	required: "Please enter branch code",
			// },
			name: {
				required: "Please enter name",
			},
			// email: {
			// 	required: "Please enter email",
			// },
			phone: {
				required: "Please enter phone",
				digits: "Enter only digits",
				minlength: "Enter valid number",
			},
			address: {
				required: "Please enter address",
			},
			no_of_packages: {
				required: "Enter no of pack",
				digits: "Enter only digits",
			},
			hamali_charge: {
				required: "Please enter hamali charge",
			},
			hamali: {
				required: "Enter hamali charge",
			},
			consignment_value: {
				required: "Please enter consignment value",
				digits: "Enter only digits",
			},
			sc_charge: {
				required: "Please enter sc charge",
			},
			policy_name: {
				required: "Please enter policy name",
			},
			from_place: {
				required: "Please enter from palce",
			},
			to_place: {
				required: "Please enter to place",
			},
			consignor_phone: {
				required: "Please enter phone",
				digits: "Enter only digits",
			},
			consignor_name_add: {
				required: "Please enter name & address",
			},
			consignor_name: {
				required: "Please enter name & address",
			},
			consignee_phone: {
				required: "Please enter phone",
				digits: "Enter only digits",
			},
			consignee_name_add: {
				required: "Please enter name & address",
			},
			consignee_name: {
				required: "Please enter name & address",
			},
			// extra
			act_wt: {
				required: "Enter Weight",
			},
			desc_of_goods: {
				required: "Enter Description",
			},
			basic_freight: {
				required: "Enter basic freight",
			},
			stat_charges: {
				required: "Enter stat charge ",
			},
			sc: {
				required: "Enter SC charge",
			},
			value_of_sc: {
				required: "Enter value of sc",
			},
			aoc: {
				required: "Enter AOC",
			},
			transhipment: {
				required: "Enter transhipment",
			},
			c_charges: {
				required: "Enter C Charge",
			},
			d_charges: {
				required: "Enter D Charge",
			},
			with_pass: {
				required: "Enter pass charge",
			},
			gst: {
				required: "Enter GST",
			},
			total: {
				required: "Enter Total",
			},
			eway_bill_no: {
				required: "Enter E-way Bill No",
			},
		},
	});
}

// Ajax Post Request
function ajaxPostRequest(url, data, modal, operation, process) {
	try {
		$.ajax({
			url: url,
			type: "POST",
			dataType: "json",
			data: JSON.stringify(getFormData(data)),
			contentType: "application/json; charset=utf-8",
			success: function (data) {
				$(modal).modal("hide");
				var message = data.message;
				console.log(process, modal);
				sweetAlert(message, operation, process);
				if (process == "bookings" && modal == "#dummy") {
					var html = $(".section-1").html();
					var consignor_phone = $("#consignor_phone").val();
					var consignor_name_add = $(".consignor_name_add").val();

					var consignee_phone = $("#consignee_phone").val();
					var consignee_name_add = $(".consignee_name_add").val();

					var customerData = {
						consignor_phone: consignor_phone,
						consignor_name: consignor_name_add,
						consignee_phone: consignee_phone,
						consignee_name: consignee_name_add,
					};
					var branchname = $("#branches").find(":selected").text();
					var branchphone = $("#branches").find(":selected").attr("id");

					addCustomer(customerData);
					$("#printModal").modal({
						keyboard: false,
						show: true,
						backdrop: "static",
					});
					$(".buttons-row")
						.parent()
						.append(
							`<p class="branch-and-phone"><span class="foot-text">Delivery Branch: ` +
								branchname +
								`</span><span class="foot-text"> Phone No: ` +
								branchphone +
								`</span></p>`
						);

					$(".section-1")
						.clone()
						.appendTo(".section-2, .section-3, .section-4");
					$(".consignor_dropdown").clone();

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
					// $(".section-2, .section-3").css("display", "none");
				}
			},
			error: function (xhr, textStatus, errorThrown) {
				swal("Oops...", "Something went wrong!", "error");
			},
		});
	} catch (e) {
		console.log(e);
	}
}

//Ajax Get Request
function ajaxGetRequest(url, formName) {
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
			// var option = new Option(res.to_place, res.to_place, true, true);
			// $('#branches').append(option).trigger('change');
			//
			// // manually trigger the `select2:select` event
			// $('#branches').trigger({
			//   type: 'select2:select',
			//   params: {
			//     data: res
			//   }
			// });
		},
	}).then(function (data) {
		var formData = JSON.stringify(data);

		var branches = data.branches;
		var res = JSON.parse(formData);
		var to_place = res.to_place;
		var option = new Option(res.to_place, res.to_place, true, true);
		$("#branches").append(option).trigger("change");

		// manually trigger the `select2:select` event
		$("#branches").trigger({
			type: "select2:select",
			params: {
				data: res,
			},
		});
	});
}

// Sweet Alert
function sweetAlert(message, operation, process) {
	if (message == "" + process + " was " + operation + ".") {
		swal({
			title: "Success",
			text: "" + process + " was " + operation + " successfully.",
			icon: "success",
			timer: 2000,
		});
	}
}

$(document).ready(function () {
	var pagename = "./" + document.location.pathname.match(/[^\/]+$/)[0];
	console.log(pagename);

	$(".navbar-nav li").each(function (k, v) {
		if ($(this).find("a").attr("href") == pagename) {
			$(this).find("a").addClass("active");
		}
	});
	$(".nav-sm li").each(function () {
		if ($(this).find("a").hasClass("active")) {
			$(".collapse").addClass("show");
			$(".bookings-menu").attr("aria-expanded", "true");
		}
	});
	if (
		pagename === "./new-bookings" ||
		pagename === "./receivings" ||
		pagename === "./new-bookings.php"
	) {
		$(".collapse").addClass("show");
		$(".bookings-menu").attr("aria-expanded", "true");
		$(".main-content").toggleClass("hide-sidebar");
		$(".main-content .container-fluid.mt--7").toggleClass("bg-body-gray");
	}
});

function addCustomer(customerData) {
	$.ajax({
		url: "../api/customers/create.php",
		type: "POST",
		dataType: "json",
		data: JSON.stringify(customerData),
		contentType: "application/json; charset=utf-8",
		success: function (data) {
			console.log(data);
		},
	});
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
