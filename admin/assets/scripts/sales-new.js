$(document).ready(function () {
	// filter customer type
	var filtervalue = $("#filter-sales-by-customer-type option:selected").text();
	if (filtervalue == "Quater") {
		getSalesByCustomerQater();
		$(".cartSalesByCustomeTypeMonths, .cartSalesByCustomeTypeYear").css(
			"display",
			"none"
		);
		$(".cartSalesByCustomeTypeQuater").css("display", "block");
	}

	// filter customer type
	$("#filter-sales-by-customer-type ").on("change", function () {
		var filtervalue = this.value;
		if (filtervalue == "Quater") {
			getSalesByCustomerQater();
			$(".cartSalesByCustomeTypeMonths,.cartSalesByCustomeTypeYear").css(
				"display",
				"none"
			);
			$(".cartSalesByCustomeTypeQuater").css("display", "block");
		} else if (filtervalue == "Months") {
			getSalesByCustomerMonths();
			$(".cartSalesByCustomeTypeQuater, .cartSalesByCustomeTypeYear").css(
				"display",
				"none"
			);
			$(".cartSalesByCustomeTypeMonths").css("display", "block");
		} else if (filtervalue == "Years") {
			getSalesByCustomerYears();
			$(".cartSalesByCustomeTypeQuater, .cartSalesByCustomeTypeMonths").css(
				"display",
				"none"
			);
			$(".cartSalesByCustomeTypeYear").css("display", "block");
		}
	});

	// filter product type
	var filtervalueProduct = $("#filter-sales-by-product option:selected").text();
	if (filtervalueProduct == "Quater") {
		getSalesByProductQater();
		$(".chartSalesByProductMonths, .chartSalesByProductYear").css(
			"display",
			"none"
		);
		$(".chartSalesByProductQuater").css("display", "block");
	}

	// filter product type
	$("#filter-sales-by-product ").on("change", function () {
		var filtervalueProduct = this.value;
		if (filtervalueProduct == "Quater") {
			getSalesByProductQater();
			$(".chartSalesByProductMonths, .chartSalesByProductYear").css(
				"display",
				"none"
			);
			$(".chartSalesByProductQuater").css("display", "block");
		} else if (filtervalueProduct == "Months") {
			getSalesByProductMonths();
			$(".chartSalesByProductQuater, .chartSalesByProductYear").css(
				"display",
				"none"
			);
			$(".chartSalesByProductMonths").css("display", "block");
		} else if (filtervalueProduct == "Years") {
			getSalesByProductYears();
			$(".chartSalesByProductQuater, .chartSalesByProductMonths").css(
				"display",
				"none"
			);
			$(".chartSalesByProductYear").css("display", "block");
		}
	});
});

function getSalesByCustomerQater() {
	$.ajax({
		url: "../api/customers/read.php",
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (result) {
			// var data = result;

			var data = [
				{
					customer_type: "Individual",
					total_sales: "167",
					quater: "1",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "488",
					quater: "1",
				},
				{
					customer_type: "Individual",
					total_sales: "67",
					quater: "2",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "88",
					quater: "2",
				},

				{
					customer_type: "Individual",
					total_sales: "167",
					quater: "3",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "48",
					quater: "3",
				},
				{
					customer_type: "Individual",
					total_sales: "997",
					quater: "4",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "48",
					quater: "4",
				},
			];

			//------
			$(".cartSalesByCustomeTypeQuater table tbody").empty();
			var q1, q2, q3, q4;
			var q11, q22, q33, q44;

			$.each(data, function (k, v) {
				if (v.customer_type == "Individual") {
					if (v.quater == "1") {
						q1 = v.total_sales;
					} else if (v.quater == "2") {
						q2 = v.total_sales;
					} else if (v.quater == "3") {
						q3 = v.total_sales;
					} else if (v.quater == "4") {
						q4 = v.total_sales;
					}
				}
				if (v.customer_type == "Spa Centers") {
					if (v.quater == "1") {
						q11 = v.total_sales;
					} else if (v.quater == "2") {
						q22 = v.total_sales;
					} else if (v.quater == "3") {
						q33 = v.total_sales;
					} else if (v.quater == "4") {
						q44 = v.total_sales;
					}
				}
			});
			$(".cartSalesByCustomeTypeQuater table tbody").append(
				`<tr>
          <td>Individual</td>
          <td>` +
					q1 +
					`</td>
          <td>` +
					q2 +
					`</td>
          <td>` +
					q3 +
					`</td>
          <td>` +
					q4 +
					`</td>
        </tr>`
			);
			$(".cartSalesByCustomeTypeQuater table tbody").append(
				`<tr>
          <td>Spa Center</td>
          <td>` +
					q11 +
					`</td>
          <td>` +
					q22 +
					`</td>
          <td>` +
					q33 +
					`</td>
          <td>` +
					q44 +
					`</td>
        </tr>`
			);
			// ------

			var quater = [];
			var q1_sales = [],
				q2_sales = [],
				q4_sales = [],
				q3_sales = [];
			var sales = [];
			var customer = [];
			for (var i in data) {
				if (data[i].quater == "1") {
					q1_sales.push(data[i].total_sales);
				} else if (data[i].quater == "2") {
					q2_sales.push(data[i].total_sales);
				} else if (data[i].quater == "3") {
					q3_sales.push(data[i].total_sales);
				} else if (data[i].quater == "4") {
					q4_sales.push(data[i].total_sales);
				}
				quater.push(data[i].quater);
				sales.push(data[i].total_sales);
				if (customer.includes(data[i].customer_type) == false) {
					customer.push(data[i].customer_type);
				}
			}

			var ctx = document
				.getElementById("cartSalesByCustomeTypeQuater")
				.getContext("2d");
			var cartSalesByCustomeTypeQuater = new Chart(ctx, {
				type: "bar",
				data: {
					labels: customer,
					datasets: [
						{
							label: "q1",
							data: q1_sales,
							borderWidth: 1,
							backgroundColor: "#007bff",
						},
						{
							label: "q2",
							data: q2_sales,
							borderWidth: 1,
							backgroundColor: "#dc3545",
						},
						{
							label: "q3",
							data: q3_sales,
							borderWidth: 1,
							backgroundColor: "#ffc107",
						},
						{
							label: "q4",
							data: q4_sales,
							borderWidth: 1,
							backgroundColor: "#28a745",
						},
					],
				},
				options: {
					scales: {
						yAxes: [
							{
								ticks: {
									beginAtZero: true,
								},
							},
						],
					},
				},
			});
		},
	});
}

function getSalesByCustomerMonths() {
	$.ajax({
		url: "../api/customers/read.php",
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (result) {
			// var data = result;

			var data = [
				{
					customer_type: "Individual",
					total_sales: "167",
					months: "January",
				},
				{
					customer_type: "Individual",
					total_sales: "488",
					months: "February",
				},
				{
					customer_type: "Individual",
					total_sales: "67",
					months: "March",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "88",
					months: "April",
				},

				{
					customer_type: "Individual",
					total_sales: "167",
					months: "May",
				},
				{
					customer_type: "Individual",
					total_sales: "48",
					months: "June",
				},
				{
					customer_type: "Individual",
					total_sales: "17",
					months: "June",
				},
				{
					customer_type: "Individual",
					total_sales: "48",
					months: "July",
				},
				{
					customer_type: "Individual",
					total_sales: "48",
					months: "August",
				},
				{
					customer_type: "Individual",
					total_sales: "48",
					months: "September",
				},
				{
					customer_type: "Individual",
					total_sales: "48",
					months: "October",
				},
				{
					customer_type: "Individual",
					total_sales: "48",
					months: "November",
				},
				{
					customer_type: "Individual",
					total_sales: "48",
					months: "December",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "167",
					months: "January",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "488",
					months: "February",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "67",
					months: "March",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "88",
					months: "April",
				},

				{
					customer_type: "Spa Centers",
					total_sales: "167",
					months: "May",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "48",
					months: "June",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "17",
					months: "June",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "48",
					months: "July",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "48",
					months: "August",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "48",
					months: "September",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "48",
					months: "October",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "48",
					months: "November",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "48",
					months: "December",
				},
			];

			var months = [];
			var jan_sales = [],
				feb_sales = [],
				mar_sales = [],
				apr_sales = [],
				may_sales = [],
				jun_sales = [],
				jul_sales = [],
				aug_sales = [],
				sep_sales = [],
				oct_sales = [],
				nov_sales = [],
				dec_sales = [];
			var sales = [];
			var customer = [];
			for (var i in data) {
				if (data[i].months == "January") {
					jan_sales.push(data[i].total_sales);
				} else if (data[i].months == "February") {
					feb_sales.push(data[i].total_sales);
				} else if (data[i].months == "March") {
					mar_sales.push(data[i].total_sales);
				} else if (data[i].months == "April") {
					apr_sales.push(data[i].total_sales);
				} else if (data[i].months == "May") {
					may_sales.push(data[i].total_sales);
				} else if (data[i].months == "June") {
					jun_sales.push(data[i].total_sales);
				} else if (data[i].months == "July") {
					jul_sales.push(data[i].total_sales);
				} else if (data[i].months == "August") {
					aug_sales.push(data[i].total_sales);
				} else if (data[i].months == "September") {
					sep_sales.push(data[i].total_sales);
				} else if (data[i].months == "October") {
					oct_sales.push(data[i].total_sales);
				} else if (data[i].months == "November") {
					nov_sales.push(data[i].total_sales);
				} else if (data[i].months == "descember") {
					dec_sales.push(data[i].total_sales);
				}
				months.push(data[i].months);
				sales.push(data[i].total_sales);
				if (customer.includes(data[i].customer_type) == false) {
					customer.push(data[i].customer_type);
				}
			}

			var ctx = document
				.getElementById("cartSalesByCustomeTypeMonths")
				.getContext("2d");
			var cartSalesByCustomeTypeQuater = new Chart(ctx, {
				type: "bar",
				data: {
					labels: customer,
					datasets: [
						{
							label: "Jan",
							data: jan_sales,
							borderWidth: 1,
							backgroundColor: "#007bff",
						},
						{
							label: "Feb",
							data: feb_sales,
							borderWidth: 1,
							backgroundColor: "#dc3545",
						},
						{
							label: "Mar",
							data: mar_sales,
							borderWidth: 1,
							backgroundColor: "#ffc107",
						},
						{
							label: "Apr",
							data: apr_sales,
							borderWidth: 1,
							backgroundColor: "#28a745",
						},
						{
							label: "May",
							data: may_sales,
							borderWidth: 1,
							backgroundColor: "#ff9800",
						},
						{
							label: "Jun",
							data: jun_sales,
							borderWidth: 1,
							backgroundColor: "#00bcd4",
						},
						{
							label: "Jul",
							data: jul_sales,
							borderWidth: 1,
							backgroundColor: "#795548",
						},
						{
							label: "Aug",
							data: aug_sales,
							borderWidth: 1,
							backgroundColor: "#673ab7",
						},
						{
							label: "Sep",
							data: sep_sales,
							borderWidth: 1,
							backgroundColor: "#e91e63",
						},
						{
							label: "Oct",
							data: oct_sales,
							borderWidth: 1,
							backgroundColor: "#607d8b",
						},
						{
							label: "Nov",
							data: nov_sales,
							borderWidth: 1,
							backgroundColor: "#cddc39",
						},
						{
							label: "Dec",
							data: dec_sales,
							borderWidth: 1,
							backgroundColor: "#5e72e4",
						},
					],
				},
				options: {
					scales: {
						yAxes: [
							{
								ticks: {
									beginAtZero: true,
								},
							},
						],
					},
				},
			});
		},
	});
}

function getSalesByCustomerYears() {
	$.ajax({
		url: "../api/customers/read.php",
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (result) {
			// var data = result;

			var data = [
				{
					customer_type: "Individual",
					total_sales: "10",
					years: "2019",
				},

				{
					customer_type: "Individual",
					total_sales: "167",
					years: "2020",
				},
				{
					customer_type: "Individual",
					total_sales: "67",
					years: "2021",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "80",
					years: "2019",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "88",
					years: "2020",
				},
				{
					customer_type: "Spa Centers",
					total_sales: "17",
					years: "2021",
				},
			];

			var years = [],
				y2019_sales = [],
				y2020_sales = [],
				y2021_sales = [];

			var sales = [];
			var customer = [];
			for (var i in data) {
				if (data[i].years == "2020") {
					y2020_sales.push(data[i].total_sales);
				} else if (data[i].years == "2021") {
					y2021_sales.push(data[i].total_sales);
				} else if (data[i].years == "2019") {
					y2019_sales.push(data[i].total_sales);
				}
				years.push(data[i].years);
				sales.push(data[i].total_sales);
				if (customer.includes(data[i].customer_type) == false) {
					customer.push(data[i].customer_type);
				}
			}

			var ctx = document
				.getElementById("cartSalesByCustomeTypeYear")
				.getContext("2d");
			var cartSalesByCustomeTypeQuater = new Chart(ctx, {
				type: "bar",
				data: {
					labels: customer,
					datasets: [
						{
							label: "2019",
							data: y2020_sales,
							borderWidth: 1,
							backgroundColor: "#007bff",
						},
						{
							label: "2020",
							data: y2021_sales,
							borderWidth: 1,
							backgroundColor: "#dc3545",
						},
						{
							label: "2021",
							data: y2021_sales,
							borderWidth: 1,
							backgroundColor: "#ff9800",
						},
					],
				},
				options: {
					scales: {
						yAxes: [
							{
								ticks: {
									beginAtZero: true,
								},
							},
						],
					},
				},
			});
		},
	});
}

// ----------------------------------------------- //

function getSalesByProductQater() {
	$.ajax({
		url: "../api/orders/sales_by_products_quater.php",
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (result) {
			// var data = result;

			var data = [
				{
					product_name: "Shampoo",
					total_sales: "167",
					quater: "1",
				},
				{
					product_name: "Hair Oil",
					total_sales: "488",
					quater: "1",
				},
				{
					product_name: "Shampoo",
					total_sales: "67",
					quater: "2",
				},
				{
					product_name: "Hair Oil",
					total_sales: "88",
					quater: "2",
				},

				{
					product_name: "Shampoo",
					total_sales: "167",
					quater: "3",
				},
				{
					product_name: "Hair Oil",
					total_sales: "48",
					quater: "3",
				},
				{
					product_name: "Shampoo",
					total_sales: "17",
					quater: "4",
				},
				{
					product_name: "Hair Oil",
					total_sales: "48",
					quater: "4",
				},
			];

			$(".chartSalesByProductQuater table tbody").empty();
			$.each(data, function (k, v) {});

			var quater = [];
			var q1_sales = [],
				q2_sales = [],
				q4_sales = [],
				q3_sales = [];
			var sales = [];
			var product = [];

			for (var i in data) {
				if (data[i].quater == "1") {
					q1_sales.push(data[i].total_sales);
				} else if (data[i].quater == "2") {
					q2_sales.push(data[i].total_sales);
				} else if (data[i].quater == "3") {
					q3_sales.push(data[i].total_sales);
				} else if (data[i].quater == "4") {
					q4_sales.push(data[i].total_sales);
				}
				quater.push(data[i].quater);
				sales.push(data[i].total_sales);
				if (product.includes(data[i].product_name) == false) {
					product.push(data[i].product_name);
				}
			}

			var ctx = document
				.getElementById("chartSalesByProductQuater")
				.getContext("2d");
			var cartSalesByCustomeTypeQuater = new Chart(ctx, {
				type: "bar",
				data: {
					labels: product,
					datasets: [
						{
							label: "q1",
							data: q1_sales,
							borderWidth: 1,
							backgroundColor: "#007bff",
						},
						{
							label: "q2",
							data: q2_sales,
							borderWidth: 1,
							backgroundColor: "#dc3545",
						},
						{
							label: "q3",
							data: q3_sales,
							borderWidth: 1,
							backgroundColor: "#ffc107",
						},
						{
							label: "q4",
							data: q3_sales,
							borderWidth: 1,
							backgroundColor: "#28a745",
						},
					],
				},
				options: {
					scales: {
						yAxes: [
							{
								ticks: {
									beginAtZero: true,
								},
							},
						],
					},
				},
			});
		},
	});
}

function getSalesByProductMonths() {
	$.ajax({
		url: "../api/customers/read.php",
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (result) {
			// var data = result;

			var data = [
				{
					product_name: "Shampoo",
					total_sales: "167",
					months: "January",
				},
				{
					product_name: "Shampoo",
					total_sales: "488",
					months: "February",
				},
				{
					product_name: "Shampoo",
					total_sales: "67",
					months: "March",
				},
				{
					product_name: "Hair Oil",
					total_sales: "88",
					months: "April",
				},

				{
					product_name: "Shampoo",
					total_sales: "167",
					months: "May",
				},
				{
					product_name: "Shampoo",
					total_sales: "48",
					months: "June",
				},
				{
					product_name: "Shampoo",
					total_sales: "17",
					months: "June",
				},
				{
					product_name: "Shampoo",
					total_sales: "48",
					months: "July",
				},
				{
					product_name: "Shampoo",
					total_sales: "48",
					months: "August",
				},
				{
					product_name: "Shampoo",
					total_sales: "48",
					months: "September",
				},
				{
					product_name: "Shampoo",
					total_sales: "48",
					months: "October",
				},
				{
					product_name: "Shampoo",
					total_sales: "48",
					months: "November",
				},
				{
					product_name: "Shampoo",
					total_sales: "48",
					months: "December",
				},
				{
					product_name: "Hair Oil",
					total_sales: "167",
					months: "January",
				},
				{
					product_name: "Hair Oil",
					total_sales: "488",
					months: "February",
				},
				{
					product_name: "Hair Oil",
					total_sales: "67",
					months: "March",
				},
				{
					product_name: "Hair Oil",
					total_sales: "88",
					months: "April",
				},

				{
					product_name: "Hair Oil",
					total_sales: "167",
					months: "May",
				},
				{
					product_name: "Hair Oil",
					total_sales: "48",
					months: "June",
				},
				{
					product_name: "Hair Oil",
					total_sales: "17",
					months: "June",
				},
				{
					product_name: "Hair Oil",
					total_sales: "48",
					months: "July",
				},
				{
					product_name: "Hair Oil",
					total_sales: "48",
					months: "August",
				},
				{
					product_name: "Hair Oil",
					total_sales: "48",
					months: "September",
				},
				{
					product_name: "Hair Oil",
					total_sales: "48",
					months: "October",
				},
				{
					product_name: "Hair Oil",
					total_sales: "48",
					months: "November",
				},
				{
					product_name: "Hair Oil",
					total_sales: "48",
					months: "December",
				},
			];

			var months = [];
			var jan_sales = [],
				feb_sales = [],
				mar_sales = [],
				apr_sales = [],
				may_sales = [],
				jun_sales = [],
				jul_sales = [],
				aug_sales = [],
				sep_sales = [],
				oct_sales = [],
				nov_sales = [],
				dec_sales = [];

			var sales = [];
			var product = [];
			for (var i in data) {
				if (data[i].months == "January") {
					jan_sales.push(data[i].total_sales);
				} else if (data[i].months == "February") {
					feb_sales.push(data[i].total_sales);
				} else if (data[i].months == "March") {
					mar_sales.push(data[i].total_sales);
				} else if (data[i].months == "April") {
					apr_sales.push(data[i].total_sales);
				} else if (data[i].months == "May") {
					may_sales.push(data[i].total_sales);
				} else if (data[i].months == "June") {
					jun_sales.push(data[i].total_sales);
				} else if (data[i].months == "July") {
					jul_sales.push(data[i].total_sales);
				} else if (data[i].months == "August") {
					aug_sales.push(data[i].total_sales);
				} else if (data[i].months == "September") {
					sep_sales.push(data[i].total_sales);
				} else if (data[i].months == "October") {
					oct_sales.push(data[i].total_sales);
				} else if (data[i].months == "November") {
					nov_sales.push(data[i].total_sales);
				} else if (data[i].months == "descember") {
					dec_sales.push(data[i].total_sales);
				}
				months.push(data[i].months);
				sales.push(data[i].total_sales);
				if (product.includes(data[i].product_name) == false) {
					product.push(data[i].product_name);
				}
			}

			var ctx = document
				.getElementById("chartSalesByProductMonths")
				.getContext("2d");
			var cartSalesByCustomeTypeQuater = new Chart(ctx, {
				type: "bar",
				data: {
					labels: product,
					datasets: [
						{
							label: "Jan",
							data: jan_sales,
							borderWidth: 1,
							backgroundColor: "#007bff",
						},
						{
							label: "Feb",
							data: feb_sales,
							borderWidth: 1,
							backgroundColor: "#dc3545",
						},
						{
							label: "Mar",
							data: mar_sales,
							borderWidth: 1,
							backgroundColor: "#ffc107",
						},
						{
							label: "Apr",
							data: apr_sales,
							borderWidth: 1,
							backgroundColor: "#28a745",
						},
						{
							label: "May",
							data: may_sales,
							borderWidth: 1,
							backgroundColor: "#ff9800",
						},
						{
							label: "Jun",
							data: jun_sales,
							borderWidth: 1,
							backgroundColor: "#00bcd4",
						},
						{
							label: "Jul",
							data: jul_sales,
							borderWidth: 1,
							backgroundColor: "#795548",
						},
						{
							label: "Aug",
							data: aug_sales,
							borderWidth: 1,
							backgroundColor: "#673ab7",
						},
						{
							label: "Sep",
							data: sep_sales,
							borderWidth: 1,
							backgroundColor: "#e91e63",
						},
						{
							label: "Oct",
							data: oct_sales,
							borderWidth: 1,
							backgroundColor: "#607d8b",
						},
						{
							label: "Nov",
							data: nov_sales,
							borderWidth: 1,
							backgroundColor: "#cddc39",
						},
						{
							label: "Dec",
							data: dec_sales,
							borderWidth: 1,
							backgroundColor: "#5e72e4",
						},
					],
				},
				options: {
					scales: {
						yAxes: [
							{
								ticks: {
									beginAtZero: true,
								},
							},
						],
					},
				},
			});
		},
	});
}

function getSalesByProductYears() {
	$.ajax({
		url: "../api/orders/sales_by_products_years.php",
		type: "GET",
		dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: function (result) {
			// var data = result;

			var data = [
				{
					product_name: "Shampoo",
					total_sales: "10",
					years: "2019",
				},

				{
					product_name: "Shampoo",
					total_sales: "167",
					years: "2020",
				},
				{
					product_name: "Shampoo",
					total_sales: "67",
					years: "2021",
				},
				{
					product_name: "Hair Oil",
					total_sales: "80",
					years: "2019",
				},
				{
					product_name: "Hair Oil",
					total_sales: "88",
					years: "2020",
				},
				{
					product_name: "Hair Oil",
					total_sales: "17",
					years: "2021",
				},
			];

			var years = [],
				y2019_sales = [],
				y2020_sales = [],
				y2021_sales = [];

			var sales = [];
			var product = [];
			for (var i in data) {
				if (data[i].years == "2020") {
					y2020_sales.push(data[i].total_sales);
				} else if (data[i].years == "2021") {
					y2021_sales.push(data[i].total_sales);
				} else if (data[i].years == "2019") {
					y2019_sales.push(data[i].total_sales);
				}
				years.push(data[i].years);
				sales.push(data[i].total_sales);
				if (product.includes(data[i].product_name) == false) {
					product.push(data[i].product_name);
				}
			}

			var ctx = document
				.getElementById("chartSalesByProductYear")
				.getContext("2d");
			var cartSalesByProductYear = new Chart(ctx, {
				type: "bar",
				data: {
					labels: product,
					datasets: [
						{
							label: "2019",
							data: y2020_sales,
							borderWidth: 1,
							backgroundColor: "#007bff",
						},
						{
							label: "2020",
							data: y2021_sales,
							borderWidth: 1,
							backgroundColor: "#dc3545",
						},
						{
							label: "2021",
							data: y2021_sales,
							borderWidth: 1,
							backgroundColor: "#ff9800",
						},
					],
				},
				options: {
					scales: {
						yAxes: [
							{
								ticks: {
									beginAtZero: true,
								},
							},
						],
					},
				},
			});
		},
	});
}
