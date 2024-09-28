<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5c5946fe44.js" crossorigin="anonymous"></script>
    <title>Pay Page</title>

    <style>
      body {
        background-color: #f7f7f7;
      }

      .navbar {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }

      .payment-container {
        margin-top: 50px;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      }

      .paypal-button {
        display: flex;
        justify-content: center;
        margin-top: 20px;
      }

      .loading-spinner {
        display: none;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }

      .loading-spinner.active {
        display: flex;
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <div class="container">
        <a class="navbar-brand text-white" href="#">
          <i class="fas fa-credit-card"></i> Pay Page
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <!-- Main Container -->
    <div class="container payment-container">
      <h2 class="text-center mb-4">Complete Your Payment</h2>

      <div class="text-center mb-4">
        <i class="fas fa-money-bill-wave fa-3x text-success"></i>
        <p class="mt-3">Please proceed with PayPal to complete your transaction.</p>
      </div>

      <!-- PayPal Button Container -->
      <div id="paypal-button-container" class="paypal-button"></div>

      <!-- Loading Spinner -->
      <div class="loading-spinner" id="loading-spinner">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>

    <!-- PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AYU9Wq8TBbAoc-XV9JCX9PEWe5AVkCbcO9dFx8yymE0B1sPENFSG7QI9fxYYubivsGdMEI9CjoStY_cw&currency=USD"></script>

    <!-- Custom PayPal Integration -->
    <script>
      const spinner = document.getElementById('loading-spinner');

      paypal.Buttons({
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '{{ $totalPrice }}' // Can also reference a variable or function
              }
            }]
          });
        },
        onApprove: (data, actions) => {
          spinner.classList.add('active'); // Show spinner while processing
          return actions.order.capture().then(function(orderData) {
            window.location.href = 'http://127.0.0.1:8000/traveling/success';
          });
        },
        onError: (err) => {
          spinner.classList.remove('active'); // Hide spinner if there's an error
          alert("There was an issue with your payment. Please try again.");
        }
      }).render('#paypal-button-container');
    </script>

    <!-- Bootstrap JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  </body>
</html>
