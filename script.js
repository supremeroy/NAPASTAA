// Add event listener to payment method dropdown
document.getElementById('payment_method').addEventListener('change', function() {
  // Get the selected payment method
  var paymentMethod = this.value;
  
  // Get references to payment details elements
  var paypalPaymentDetails = document.getElementById('paypal-payment-details');
  var mpesaPaymentDetails = document.getElementById('mpesa-payment-details');
  var bankTransferPaymentDetails = document.getElementById('bank-transfer-payment-details');

  // Show or hide payment details based on selected payment method
  if (paymentMethod === 'paypal') {
    // Show PayPal payment details and hide others
    paypalPaymentDetails.style.display = 'block';
    mpesaPaymentDetails.style.display = 'none';
    bankTransferPaymentDetails.style.display = 'none';
  } else if (paymentMethod === 'mpesa') {
    // Show M-Pesa payment details and hide others
    paypalPaymentDetails.style.display = 'none';
    mpesaPaymentDetails.style.display = 'block';
    bankTransferPaymentDetails.style.display = 'none';
  } else if (paymentMethod === 'bank_transfer') {
    // Show bank transfer payment details and hide others
    paypalPaymentDetails.style.display = 'none';
    mpesaPaymentDetails.style.display = 'none';
    bankTransferPaymentDetails.style.display = 'block';
  }
});

// Add event listener to terms link
document.getElementById('terms-link').addEventListener('click', function() {
  // Show terms and conditions
  document.getElementById('terms-conditions').style.display = 'block';
});

// Add event listener to close terms button
document.getElementById('close-terms').addEventListener('click', function() {
  // Hide terms and conditions
  document.getElementById('terms-conditions').style.display = 'none';
});

// Function to show or hide terms and conditions
function showTerms() {
  // Get reference to terms element
  var terms = document.getElementById("terms");
  
  // Toggle display of terms
  if (terms.style.display === "none") {
    // Show terms
    terms.style.display = "block";
  } else {
    // Hide terms
    terms.style.display = "none";
  }
}



//show upcoming events in the user page
// Add event listener to attend button
document.addEventListener("DOMContentLoaded", function() {
  const attendButtons = document.querySelectorAll(".attend-btn");
  attendButtons.forEach(button => {
    button.addEventListener("click", function() {
      const eventId = this.getAttribute("data-event-id");
      // Send AJAX request to attend event
      fetch("attend_event.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `event_id=${eventId}`
      })
      .then(response => response.text())
      .then(message => {
        alert(`You have successfully attended the event! ${message}`);
      })
      .catch(error => {
        console.error("Error attending event:", error);
      });
    });
  });
});
