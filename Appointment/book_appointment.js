const form = document.getElementById("appointmentForm");


const appointmentDateInput = document.getElementById("appointmentDate");

// Set minimum date to today
appointmentDateInput.min = new Date().toISOString().split("T")[0];

