// Get the payment method select element
const paymentMethodSelect = document.getElementById('payment_method');

// Get the M-Pesa payment details container
const mpesaPaymentDetailsContainer = document.getElementById('mpesa-payment-details');

// Add an event listener to the payment method select element
paymentMethodSelect.addEventListener('change', function() {
  const selectedPaymentMethod = paymentMethodSelect.value;
  
  // Show the M-Pesa payment details fields if the user selects M-Pesa
  if (selectedPaymentMethod === 'mpesa') {
    mpesaPaymentDetailsContainer.style.display = 'block';
  } else {
    mpesaPaymentDetailsContainer.style.display = 'none';
  }
});

document.getElementById('terms-link').addEventListener('click', function() {
  document.getElementById('terms-conditions').style.display = 'block';
});

document.getElementById('close-terms').addEventListener('click', function() {
  document.getElementById('terms-conditions').style.display = 'none';
});
