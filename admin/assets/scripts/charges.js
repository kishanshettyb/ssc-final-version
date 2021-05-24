$(document).ready(function() {
  getHamaliCharges();
  getSCCharges();
  getPolicy();


})

// get hamali charges
function getHamaliCharges() {
  $.ajax({
    url: '../api/hamali/read.php',
    type: "GET",
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function(data) {
      var formData = JSON.stringify(data);
      $.each(data['records'], function(k, v) {
        console.log(v.hamali_charge);
        $('#hamali_charge_id').val(v.hamali_charge_id);
        $('#no_of_packages').val(v.no_of_packages);
        $('#hamali_charge').val(v.hamali_charge);
        $('.hamali_charge').text(v.hamali_charge);
      });
    }
  });
}

//  get SC charges
function getSCCharges() {
  $.ajax({
    url: '../api/sc_charges/read.php',
    type: "GET",
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function(data) {
      var formData = JSON.stringify(data);
      $.each(data['records'], function(k, v) {
        console.log(v.hamali_charge);
        $('#sc_charge_id').val(v.sc_charge_id);
        $('#consignment_value').val(v.consignment_value);
        $('#sc_charge').val(v.sc_charge);
        $('.sc_charge').text(v.sc_charge);
      });
    }
  });
}

// get Policy
function getPolicy() {
  $.ajax({
    url: '../api/policy/read.php',
    type: "GET",
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function(data) {
      var formData = JSON.stringify(data);
      $.each(data['records'], function(k, v) {
        console.log(v.hamali_charge);
        $('#policy_id').val(v.policy_id);
        $('#policy_name').val(v.policy_name);
        $('.policy_name').text(v.policy_name);
      });
    }
  });
}


// create and update hamil charges
$('#hamliForm').on('submit', function(e) {
  e.preventDefault();

  var form = $(this);
  var data = form.serializeArray();
  var url, operation;
  var process = "hamali";
  var modal = "hamali";



  if ($('#hamali_charge_id').val() != '') {
    url = "../api/hamali/update.php";
    operation = "updated";
  } else {
    url = "../api/hamali/create.php";
    operation = "created";
  }

  validateFunction(form);

  if ($(form).valid()) {
    ajaxPostRequest(url, data, modal, operation, process);
    setTimeout(function() {
      getHamaliCharges();
    }, 100);
  } else {
    console.log("Invalid Form");
  }
})



// create and update sc charges
$('#sc_chargesForm').on('submit', function(e) {
  e.preventDefault();

  var form = $(this);
  var data = form.serializeArray();
  var url, operation;
  var process = "sc_charges";
  var modal = "hamali";


  if ($('#sc_charge_id').val() != '') {
    url = "../api/sc_charges/update.php";
    operation = "updated";
  } else {
    url = "../api/sc_charges/create.php";
    operation = "created";
  }

  validateFunction(form);

  if ($(form).valid()) {
    ajaxPostRequest(url, data, modal, operation, process);
    setTimeout(function() {
      getSCCharges();
    }, 100);
  } else {
    console.log("Invalid Form");
  }
})



// create and update sc charges
$('#policyForm').on('submit', function(e) {
  e.preventDefault();

  var form = $(this);
  var data = form.serializeArray();
  var url, operation;
  var process = "policy";
  var modal = "hamali";

  validateFunction(form);

  if ($('#policy_id').val() != '') {
    url = "../api/policy/update.php";
    operation = "updated";
  } else {
    url = "../api/policy/create.php";
    operation = "created";
  }


  if ($(form).valid()) {
    ajaxPostRequest(url, data, modal, operation, process);
    setTimeout(function() {
      getSCCharges();
    }, 100);
  } else {
    console.log("Invalid Form");
  }
})