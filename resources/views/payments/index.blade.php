<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-3 col-md-offset-6">
                        @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">?</span>
                            </button>
                            <strong>Error!</strong> {{ $message }}
                        </div>
                        @endif
                        @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}"
                            role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">?</span>
                            </button>
                            <strong>Success!</strong> {{ $message }}
                        </div>
                        @endif
                        <div class="card card-default">
                            <div class="card-header">
                                Laravel 9- Razorpay Payment Gateway Integration
                            </div>
                            {{-- <div class="card-body text-center">
                                <form action="https://www.example.com/payment/success/" method="POST">
                                    <script
                                        src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="rzp_test_8Pa3NdNZRHaNFT" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys
                                        data-amount="29935" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
                                        data-currency="INR"// You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
                                        data-order_id="order_CgmcjRh9ti2lP7"// Replace with the order_id generated by you in the backend.
                                        data-buttontext="Pay with Razorpay"
                                        data-name="Acme Corp"
                                        data-description="A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami"
                                        data-image="https://example.com/your_logo.jpg"
                                        data-prefill.name="Gaurav Kumar"
                                        data-prefill.email="gaurav.kumar@example.com"
                                        data-theme.color="#F37254"
                                    ></script>
                                    <input type="hidden" custom="Hidden Element" name="hidden"/>
                                    </form>
                            </div> --}}

                            <html>
<button id="rzp-button1" class="btn btn-outline-dark btn-lg"><i class="fas fa-money-bill"></i> Own Checkout</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var options = {
    "key": "rzp_test_8Pa3NdNZRHaNFT", // Enter the Key ID generated from the Dashboard
    "amount": "500",
    "order_id":'order_NULXNPwdjebJ1c',
    "currency": "INR",
    "description": "Acme Corp",
    "image": "https://s3.amazonaws.com/rzp-mobile/images/rzp.jpg",
    "prefill":
    {
      "email": "neeraj@mail.com",
      "contact": +919950443432,
    },
    config: {
      display: {
        blocks: {
          utib: { //name for Axis block
            name: "Pay using Axis Bank",
            instruments: [
              {
                method: "card",
                issuers: ["UTIB"]
              },
              {
                method: "netbanking",
                banks: ["UTIB"]
              },
            ]
          },
          other: { //  name for other block
            name: "Other Payment modes",
            instruments: [
              {
                method: "card",
                issuers: ["ICIC"]
              },
              {
                method: 'netbanking',
              }
            ]
          }
        },
        hide: [
          {
          method: "upi"
          }
        ],
        sequence: ["block.utib", "block.other"],
        preferences: {
          show_default_blocks: false // Should Checkout show its default blocks?
        }
      }
    },
    "handler": function (response) {
    //   alert(response.razorpay_payment_id);
    console.log("Res",response);
    },
    "modal": {
      "ondismiss": function () {
        if (confirm("Are you sure, you want to close the form?")) {
          txt = "You pressed OK!";
          console.log("Checkout form closed by the user");
        } else {
          txt = "You pressed Cancel!";
          console.log("Complete the Payment")
        }
      }
    }
  };
  var rzp1 = new Razorpay(options);
  document.getElementById('rzp-button1').onclick = function (e) {
    rzp1.open();
    e.preventDefault();
  }
</script>
</html>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>