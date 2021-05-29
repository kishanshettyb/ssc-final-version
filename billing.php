<?php
session_start();
if(!isset($_SESSION["session_admin_username"]))
{
  header("Location:admin/login.php");
}
error_reporting(0);
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="img/favicon.png" rel="icon" type="image/png">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <!-- <style type="text/css" media="print">
    body.print-page {
      -webkit-transform: scale(0.85);
      -moz-transform: scale(0.85);
      -ms-transform: scale(0.85);
      -o-transform: scale(0.85);
      transform: scale(0.85);
      margin: -50px -73px 0;
    }
  </style> -->

  <title>Sri Sai Cargo</title>
</head>

<body class="bg-grey print-page">
  <section class="mb-4 mt-5  ml-2 mr-2 pb-1 pt-1 shadow-sm section-1">
    <div class="container-fluid">
      <div class="lds-roller">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>

      <form id="bookingForm" class="bookingForm">
        <input name="admin_id" id="admin_id" value="<?php echo $_SESSION["session_admin_id"] ?>" type="text"
          class="form-control small-input hide" placeholder="Enter Admin Id" />
        <input name="booking_id" id="booking_id" type="text" class="form-control small-input hide"
          placeholder="Enter Booking Id" />

        <div class="row  mt-1 pl-2 pr-2">
          <div class="col-md-8 border">
            <!-- address -->
            <div class="row">
              <div class="col-md-8 bb address">
                <h4 class="mb-0 color-pink text-center">Sri Sai Cargo </h4>
                <hr class="mt-2 mb-2">
                <p class="mb-1 text-justify address_line text-center" style="line-height:1">
                  <!-- Shop No. 7, SSBM Complex, Tank Bund Road, Next to Upparpet Police Station, Majestic, Bangalore - 560009.<br /> -->
                  Mobile No: +91 9449507037
                  <span class="pr-2" style="font-weight:600;float:right">
                    GSTIN: 29AKZPM2385H1ZB
                  </span></p>

              </div>
              <div class="col-md-4 bl bb pt-2  text-center">
                <h6 style="font-size:16px;font-weight:700;margin-bottom:0">Goods Consignment Note:</h6>
                <h6 style="font-weight:900;font-size:24px;" class="mb-0 pb-0 gc_no"> </h6>
                <input name="gc_no" id="gc_no" value="BLR0003" type="text" class="form-control small-input hide gc_no"
                  placeholder="Enter gc no" />
              </div>
            </div>
            <!-- Body  -->
            <div class="row mt-2 mb-0">

              <div class="col-md-6">
                <label class="small-label" for="exampleInputEmail1">Consignor Name, Address:</label>
              </div>
              <div class="col-md-3 text-right">
                <label class="small-label" for="exampleInputEmail1">E-Way Bill No:</label>
              </div>
              <div class="col-md-3">
                <input name="eway_bill_no" id='eway_bill_no' minlength="12" type="text" class="form-control small-input"
                  style="margin-top:-4px" />
              </div>

              <div class="col-md-4">
                <input id="consignor_phone" minlength="10" name="consignor_phone" type="text"
                  class="form-control small-input" placeholder="Enter Mobile No" />
              </div>
              <div class="col-md-8">
                <input name="consignor_name_add" type="text"
                  class="consignor_name_add form-control small-input uppercase" placeholder="Enter Address" />
                <select id="consignor_name_add" class="form-control dropdownInput consignor_dropdown">

                </select>
              </div>
              <div class="col-md-12">
                <label class="small-label" for="exampleInputEmail1">Consignee Name, Address:</label>
              </div>
              <div class="col-md-4">
                <input id="consignee_phone" minlength="10" name="consignee_phone" type="text"
                  class="form-control  consignee_phone small-input" placeholder="Enter Mobile No" />
              </div>
              <div class="col-md-8">
                <input name="consignee_name_add" type="text"
                  class="consignee_name_add form-control small-input uppercase" placeholder="Enter Address" />
                <select id="consignee_name_add" class="form-control dropdownInput consignee_dropdown">

                </select>
              </div>
            </div>

            <!-- Parcel Information -->
            <div class="row bg-grey-light mt-2 mb-1">
              <div class="col-md-12">
                <h6>Parcel Information:</h6>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="exampleInputEmail1">No. Pkgs:</label>
                  <input name="no_of_packages" id="no_of_packages" type="text" class="form-control small-input" />
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="exampleInputEmail1">Act. Wt:</label>
                  <input name="act_wt" type="text" class="form-control small-input" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Consignment Value</label>
                  <input id="consignment_value" name="consignment_value" type="text" class="form-control small-input" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Description of Goods</label>
                  <input name="desc_of_goods" type="text" class="form-control small-input" />
                </div>
              </div>
            </div>
            <!-- Policy -->
            <div class="row">
              <div class="col-md-6">
                <p class="text-small text-justify mt-0 mb-2">I/We agree to this G.C Note copy and in the event of loss /
                  damage to the parcel, our claim shall be limited to Rs.5/- per KG of Actual Weight.</p>
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control mt-0 small-input" id="policy" style="font-size:13px">
              </div>
            </div>

            <!-- Signatures & Buttons -->
            <div class="row pt-0 pb-3 text-center">
              <div class="col-md-4">
                <button type="button" class="btn btn-light btn-sm">Booking Person Signature</button>
              </div>
              <div class="col-md-4">
                <button id="link" type="button" class="btn btn-light btn-sm">Delivery Person Signature</button>
                <p id="box"></p>
              </div>
              <div class="col-md-4">
                <button type="button" class="btn btn-light btn-sm">Signature of Incharge</button>
              </div>
            </div>
            <div class="row mt-0 pb-1 buttons-row">
              <div class="col-md-4">
                <div class="custom-control custom-radio custom-control-inline">
                  <input value="To Pay" type="radio" id="customRadioInline1" name="payment_mode"
                    class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline1">To Pay</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input value="Paid" type="radio" id="customRadioInline2" name="payment_mode"
                    class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline2">Paid</label>
                </div>
              </div>
              <div class="col-md-2">
                <button type="reset" class="btn btn-block btn-secondary btn-sm">Cancel</button>
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-block btn-danger btn-sm">Save & Submit</button>
              </div>
              <div class="col-md-4">
              </div>
            </div>
          </div>
          <div class="col-md-4 bg-light br bb bt">
            <div class="row">
              <div class="col-md-12 text-right">
                <h6 class="pt-2">Date: <span class="currentDate">06-08-2019</span></h6>
                <input name="date" type="text" class="form-control small-input hide currentDate"
                  placeholder="Enter date" />
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md-2 text-left">
                <h6>From:</h6>
              </div>
              <div class="col-md-10">
                <input name="from_place" type="text" value="BANGALORE" class="form-control small-input">
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 text-left">
                <h6>To:</h6>
              </div>
              <div class="col-md-10">
                <select name="to_place" class="form-control small_input dropdownInput js-example-basic-single"
                  id="branches">
                </select>
              </div>
              <div class="col-md-12 bg-grey  pt-0 pb-0 mt-1 mb-1">
                <h6 class="text-center"></h6>
              </div>
            </div>
            <!-- charges -->
            <div class="row">
              <!-- charges -->
              <div class="col-md-10">
                <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">Basic Freight:</label>
                  </div>
                  <div class="col-md-6">
                    <input id="basic_freight" name="basic_freight" type="text"
                      class="form-control text-end small-input">
                  </div>
                </div>
                <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">Hamali:</label>
                  </div>
                  <div class="col-md-6">
                    <input name="hamali" id="hamali" value="" type="text" class="form-control text-end small-input">
                  </div>
                </div>
                <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">Stat. Charges:</label>
                  </div>
                  <div class="col-md-6">
                    <input id="stat_charges" name="stat_charges" value="20.00" type="text"
                      class="form-control text-end small-input">
                  </div>
                </div>
                <!-- <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">S C:</label>
                  </div>
                  <div class="col-md-6">
                    <input name="sc" id="sc" type="text" class="form-control text-end small-input">
                  </div>
                </div> -->
                <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">Value S C:</label>
                  </div>
                  <div class="col-md-6">
                    <input name="value_of_sc" id="value_of_sc" type="text" class="form-control text-end small-input">
                  </div>
                </div>
                <!-- <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">A O C:</label>
                  </div>
                  <div class="col-md-6">
                    <input name="aoc" id="aoc" value="16.00" type="text" class="form-control text-end small-input">
                  </div>
                </div> -->
                <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">Transhipment:</label>
                  </div>
                  <div class="col-md-6">
                    <input name="transhipment" id="transhipment" value="" type="text"
                      class="form-control text-end small-input">
                  </div>
                </div>
                <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">C Charges:</label>
                  </div>
                  <div class="col-md-6">
                    <input name="c_charges" id="c_charges" type="text" class="form-control  text-end small-input">
                  </div>
                </div>
                <!-- <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">D Charges:</label>
                  </div>
                  <div class="col-md-6">
                    <input name="d_charges" id="d_charges"  type="text" class="form-control text-end small-input">
                  </div>
                </div> -->
                <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">With Pass:</label>
                  </div>
                  <div class="col-md-6">
                    <input id="with_pass" name="with_pass" value="10.00" type="text"
                      class="form-control text-end small-input">
                  </div>
                </div>
                <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label color-pink">Sub Total:</label>
                  </div>
                  <div class="col-md-6">
                    <input name="subtotal" id="subtotal" type="text" class="form-control small-input text-end">
                  </div>
                </div>
                <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">GST:</label>
                  </div>
                  <div class="col-md-6">
                    <input id="gst" name="gst" type="text" class="form-control small-input text-end">
                  </div>
                </div>
                <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label color-pink f-18">Total:</label>
                  </div>
                  <div class="col-md-6">
                    <input name="total" id="total" type="text" class="form-control small-input text-end">
                  </div>
                </div>
              </div>
              <!-- to pay -->
              <div class="col-md-2">
                <div class="v-line color-pink">
                  TO PAY
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>



  <div class="section-2">

  </div>
  <div class="section-3">

  </div>

  <section class="printSection bg-grey pb-0 mb-0 pt-0" style="background-color:transparent!important">
    <div class="container">
      <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-3">
          <button type="button" class="btn btn-block btn-primary reset btn-sm ">Reset</button>
        </div>
        <div class="col-md-3">
          <button type="button" class="btn btn-block btn-danger printPage btn-sm ">Print</button>

        </div>
        <div class="col-md-3">

        </div>

      </div>

    </div>
  </section>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" charset="utf-8"></script>
  <script src="admin/assets/js/sweetalert.min.js"></script>
  <script src="admin/assets/js/jquery.validate.min.js"></script>
  <script src="./admin/assets/scripts/util.js"></script>
  <script src="scripts/index.js"></script>
 
</body>

</html>