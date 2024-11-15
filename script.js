// Add event listener to payment method dropdown
document
  .getElementById("payment_method")
  .addEventListener("change", function () {
    // Get the selected payment method
    var paymentMethod = this.value;

    // Get references to payment details elements
    var paypalPaymentDetails = document.getElementById(
      "paypal-payment-details"
    );
    var mpesaPaymentDetails = document.getElementById("mpesa-payment-details");
    var bankTransferPaymentDetails = document.getElementById(
      "bank-transfer-payment-details"
    );

    // Show or hide payment details based on selected payment method
    if (paymentMethod === "paypal") {
      // Show PayPal payment details and hide others
      paypalPaymentDetails.style.display = "block";
      mpesaPaymentDetails.style.display = "none";
      bankTransferPaymentDetails.style.display = "none";
    } else if (paymentMethod === "mpesa") {
      // Show M-Pesa payment details and hide others
      paypalPaymentDetails.style.display = "none";
      mpesaPaymentDetails.style.display = "block";
      bankTransferPaymentDetails.style.display = "none";
    } else if (paymentMethod === "bank_transfer") {
      // Show bank transfer payment details and hide others
      paypalPaymentDetails.style.display = "none";
      mpesaPaymentDetails.style.display = "none";
      bankTransferPaymentDetails.style.display = "block";
    }
  });

// Add event listener to terms link
document.getElementById("terms-link").addEventListener("click", function () {
  // Show terms and conditions
  document.getElementById("terms-conditions").style.display = "block";
});

// Add event listener to close terms button
document.getElementById("close-terms").addEventListener("click", function () {
  // Hide terms and conditions
  document.getElementById("terms-conditions").style.display = "none";
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
document.addEventListener("DOMContentLoaded", function () {
  const attendButtons = document.querySelectorAll(".attend-btn");
  attendButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const eventId = this.getAttribute("data-event-id");
      // Send AJAX request to attend event
      fetch("attend_event.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `event_id=${eventId}`,
      })
        .then((response) => response.text())
        .then((message) => {
          alert(`You have successfully attended the event! ${message}`);
        })
        .catch((error) => {
          console.error("Error attending event:", error);
        });
    });
  });
});

function approveVisitor(id) {
  if (confirm("Are you sure you want to approve this visitor?")) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "approve_visitor.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        alert("Visitor approved successfully!");
        location.reload(); // Reload the page to see changes
      } else {
        alert("Error approving visitor: " + xhr.responseText);
      }
    };
    xhr.send("id=" + id);
  }
}

//print reports in admin dashboard
function printReports() {
  //hide the sidebar
  const sidebar = document.querySelector(".sidebar");
  sidebar.style.display = "none";
  // Create a new window for printing
  const printWindow = window.open("", "", "height=600,width=800");

  // Get the content to print
  const content = document.querySelector(".dashboard").innerHTML;

  // Write the content to the new window
  printWindow.document.write("<html><head><title>Print Report</title>");
  printWindow.document.write(
    '<link rel="stylesheet" href="style.css" type="text/css" />'
  );
  printWindow.document.write("</head><body>");
  printWindow.document.write(content);
  printWindow.document.write("</body></html>");

  printWindow.document.close(); // Close the document for writing
  printWindow.print(); // Trigger the print dialog

  // Restore the sidebar
  sidebar.style.display = "block";
}

//print donations in donations data
function printTables() {
  // Hide the sidebar or any other elements you don't want to print
  const sidebar = document.querySelector(".sidebar");
  if (sidebar) {
    sidebar.style.display = "none"; // Hide sidebar
  }

  // Get the table you want to print
  const table = document.querySelector("#processedTable");
  if (!table) {
    alert("No table found to print.");
    // Restore sidebar if no table is found
    if (sidebar) {
      sidebar.style.display = "block"; // Show sidebar again
    }
    return;
  }

  // Create a new window for printing
  const printWindow = window.open("", "", "height=600,width=800");

  // Write the content to the new window
  printWindow.document.write("<html><head><title>Print Donations</title>");
  printWindow.document.write(
    '<link rel="stylesheet" href="style.css" type="text/css" />'
  ); // Include your styles
  printWindow.document.write("</head><body>");
  printWindow.document.write(
    "<h1 style='text-align: center;'>Processed Donations Report</h1>"
  ); // Optional title
  printWindow.document.write(table.outerHTML); // Write the table HTML
  printWindow.document.write("</body></html>");

  printWindow.document.close();
  printWindow.print(); // Trigger the print dialog

  // Restore the sidebar
  sidebar.style.display = "block";
}
//print childrens records
function printChildrensRecords() {
  // Hide the sidebar / any other elements
  const sidebar = document.querySelector(".sidebar");
  if (sidebar) {
    sidebar.style.display = "none"; // Hide sidebar
  }

  // Get the table you want to print
  const table = document.querySelector("#childrensTable");
  if (!table) {
    alert("No table found to print.");
    // Restore sidebar if no table is found
    if (sidebar) {
      sidebar.style.display = "block"; // Show sidebar again
    }
    return;
  }

  // Create a new window for printing
  const printWindow = window.open("", "", "height=600,width=800");

  // Write the content to the new window
  printWindow.document.write(
    "<html><head><title>Print Children's Records</title>"
  );
  printWindow.document.write(
    '<link rel="stylesheet" href="style.css" type="text/css" />'
  );
  printWindow.document.write(
    "<style>td:nth-child(8), th:nth-child(8) { display: none; }</style>"
  );
  printWindow.document.write("</head><body>");
  printWindow.document.write(
    "<h1 style='text-align: center;'>Children's Records</h1>"
  ); // Optional title
  printWindow.document.write(table.outerHTML); // Write the table HTML
  printWindow.document.write("</body></html>");

  printWindow.document.close(); // Close the document for writing
  printWindow.print(); // Trigger the print dialog

  // Restore the sidebar after printing
  printWindow.onafterprint = function () {
    if (sidebar) {
      sidebar.style.display = "block"; // Show sidebar again
    }
    printWindow.close(); // Close the print window after printing
  };
}

//print staff records
function printDataRecords() {
  // Hide the sidebar or any other elements you don't want to print
  const sidebar = document.querySelector(".sidebar");
  if (sidebar) {
    sidebar.style.display = "none"; // Hide sidebar
  }

  // Get the table you want to print
  const table = document.querySelector("#staffTable"); // Replace with the actual ID of your table
  if (!table) {
    alert("No table found to print.");
    // Restore sidebar if no table is found
    if (sidebar) {
      sidebar.style.display = "block"; // Show sidebar again
    }
    return;
  }

  // Create a new window for printing
  const printWindow = window.open("", "", "height=600,width=800");

  // Write the content to the new window
  printWindow.document.write("<html><head><title>Print Data Records</title>");
  printWindow.document.write(
    '<link rel="stylesheet" href="style.css" type="text/css" />'
  ); // Include your styles
  printWindow.document.write(
    "<style>td:nth-child(17), th:nth-child(17) { display: none; }</style>"
  ); // Hide the 7th column (Action column)
  printWindow.document.write("</head><body>");
  printWindow.document.write(
    '<h1 style="text-align: center;" >Staff Records</h1>'
  ); // Optional title
  printWindow.document.write(table.outerHTML); // Write the table HTML
  printWindow.document.write("</body></html>");

  printWindow.document.close(); // Close the document for writing
  printWindow.print(); // Trigger the print dialog

  // Restore the sidebar after printing
  printWindow.onafterprint = function () {
    if (sidebar) {
      sidebar.style.display = "block"; // Show sidebar again
    }
    printWindow.close(); // Close the print window after printing
  };
}

//staff record search
function searchTable() {
  // Get the input value and convert it to lowercase
  const input = document.getElementById("searchInput");
  const filter = input.value.toLowerCase();

  // Get the table and its rows
  const table = document.getElementById("staffTable");
  const rows = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those that don't match the search query
  for (let i = 1; i < rows.length; i++) {
    // Start from 1 to skip the header row
    const cells = rows[i].getElementsByTagName("td");
    let rowContainsSearchTerm = false;

    // Loop through each cell in the row
    for (let j = 0; j < cells.length; j++) {
      const cell = cells[j];
      if (cell) {
        // Check if the cell's text content matches the search term
        if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
          rowContainsSearchTerm = true; // Mark row as containing the search term
          break; // Exit the loop if a match is found
        }
      }
    }

    // Toggle the row's visibility based on whether it contains the search term
    rows[i].style.display = rowContainsSearchTerm ? "" : "none";
  }
}

//childrens record search
function searchchildrensTable() {
  // Get the input value and convert it to lowercase
  const input = document.getElementById("childrenssearchInput");
  const filter = input.value.toLowerCase();

  // Get the table and its rows
  const table = document.getElementById("childrensTable");
  const rows = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those that don't match the search query
  for (let i = 1; i < rows.length; i++) {
    // Start from 1 to skip the header row
    const cells = rows[i].getElementsByTagName("td");
    let rowContainsSearchTerm = false;

    // Loop through each cell in the row
    for (let j = 0; j < cells.length; j++) {
      const cell = cells[j];
      if (cell) {
        // Check if the cell's text content matches the search term
        if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
          rowContainsSearchTerm = true; // Mark row as containing the search term
          break; // Exit the loop if a match is found
        }
      }
    }

    // Toggle the row's visibility based on whether it contains the search term
    rows[i].style.display = rowContainsSearchTerm ? "" : "none";
  }
}

//search adoption
function searchAdoptionTable() {
  // Get the input value and convert it to lowercase
  const input = document.getElementById("adoptionSearchInput");
  const filter = input.value.toLowerCase();

  // Get the adoption table and its rows
  const table = document.getElementById("adoptionTable");
  const rows = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those that don't match the search query
  for (let i = 1; i < rows.length; i++) {
    // Start from 1 to skip the header row
    const cells = rows[i].getElementsByTagName("td");
    let rowContainsSearchTerm = false;

    // Loop through each cell in the row
    for (let j = 0; j < cells.length; j++) {
      const cell = cells[j];
      if (cell) {
        // Check if the cell's text content matches the search term
        if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
          rowContainsSearchTerm = true; // Mark row as containing the search term
          break; // Exit the loop if a match is found
        }
      }
    }

    // Toggle the row's visibility based on whether it contains the search term
    rows[i].style.display = rowContainsSearchTerm ? "" : "none";
  }
}

//search upcoming events

function searchEventsTable() {
  // Get the input value and convert it to lowercase
  const input = document.getElementById("eventsSearchInput");
  const filter = input.value.toLowerCase();

  // Get the events table and its rows
  const table = document.getElementById("eventsTable");
  const rows = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those that don't match the search query
  for (let i = 1; i < rows.length; i++) {
    // Start from 1 to skip the header row
    const cells = rows[i].getElementsByTagName("td");
    let rowContainsSearchTerm = false;

    // Loop through each cell in the row
    for (let j = 0; j < cells.length; j++) {
      const cell = cells[j];
      if (cell) {
        // Check if the cell's text content matches the search term
        if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
          rowContainsSearchTerm = true; // Mark row as containing the search term
          break; // Exit the loop if a match is found
        }
      }
    }

    // Toggle the row's visibility based on whether it contains the search term
    rows[i].style.display = rowContainsSearchTerm ? "" : "none";
  }
}

//search processed donations
function searchDonations() {
  // Get the search input value
  var input = document.getElementById("searchInput");
  var filter = input.value.toLowerCase(); // Convert to lowercase for case-insensitive search
  var table = document.getElementById("processedTable"); // Change to processedTable
  var rows = table.getElementsByTagName("tr"); // Get all rows in the table

  // Loop through all table rows (except the header)
  for (var i = 1; i < rows.length; i++) {
    var row = rows[i];
    var cells = row.getElementsByTagName("td");
    var found = false;

    // Loop through each cell in the row
    for (var j = 0; j < cells.length; j++) {
      var cell = cells[j];
      // Check if the cell contains the search term
      if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
        found = true; // If found, mark the row as visible
        break; // No need to check other cells in this row
      }
    }

    // Show or hide the row based on whether the search term was found
    if (found) {
      row.style.display = ""; // Show the row
    } else {
      row.style.display = "none"; // Hide the row
    }
  }
}

//donation processing
function processDonation(id) {
  console.log("Processing donation with ID: " + id); // Log the ID
  if (confirm("Do you want to complete this donation?")) {
    // Confirmation message
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "donations_data.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      console.log("Response from server: " + xhr.responseText); // Log the server response
      if (xhr.status === 200) {
        // Reload the page to reflect changes regardless of the response
        removeRowFromTable(id);
        location.reload(); // Reload the page to update the table
      } else {
        alert("Error processing donation: " + xhr.status);
      }
    };
    xhr.send("process_donation=true&id=" + id);
  }
}

// Function to remove the row from the table
function removeRowFromTable(id) {
  console.log("Removing row with ID: " + id);
  var table = document.getElementById("donationsTable"); // Get the donations table
  for (var i = 0; i < table.rows.length; i++) {
    if (table.rows[i].getAttribute("data-id") == id) {
      // Check for the matching ID
      table.deleteRow(i); // Remove the row from the table
      console.log("Row removed");
      break; // Exit the loop after deleting the row
    }
  }
}

// delete donation
function deleteDonation(id) {
  if (confirm("Are you sure you want to delete this record?")) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "donations_data.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        console.log("Donation deleted successfully."); // Log success
        location.reload(); // Refresh the page to update the table
      } else {
        alert("Error deleting donation: " + xhr.status);
      }
    };
    xhr.send("delete_donation=true&id=" + id); // Send the request to delete the donation
  }
}

//send thank you email after donation processing
