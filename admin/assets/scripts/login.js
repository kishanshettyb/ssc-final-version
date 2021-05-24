$("#loginForm").on("submit", function (e) {
	e.preventDefault();

	var form = $(this);
	var data = form.serializeArray();
	var username = $("#loginForm #username").val();
	var password = $("#loginForm #password").val();
	var branch = $("#branches option:selected").text();

	validateFunction(form);

	if ($(form).valid()) {
		$.ajax({
			url:
				".../../../api/admin/admin_login.php?username=" +
				username +
				"&password=" +
				password,
			type: "GET",
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			success: function (data) {
				console.log(data);
				var message = data.message;
				console.log(message);
				console.log(branch);
				if (message == "success") {
					if (branch === MAINBRANCH) {
						window.location.replace("index.php");
					} else {
						window.location.replace("new-bookings");
					}
				} else if (message == "user does not exist") {
					swal("Alert!", "Username or password Incorrect!", "info");
				}
			},
			error: function (xhr, textStatus, errorThrown) {
				swal("Oops...", "Something went wrong!", "error");
			},
		});
	} else {
		console.log("not Valid");
	}
});
