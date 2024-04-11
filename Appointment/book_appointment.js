    
    const form = document.getElementById("appointmentForm");
    const appointmentDateInput = document.getElementById("appointmentDate");

    // Get today's date
    const today = new Date();

    // Calculate the maximum date allowed (4 days after today)
    const maxDate = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 4);

    // Set the minimum date to today
    appointmentDateInput.min = today.toISOString().split("T")[0];

    // Set the maximum date to 4 days after today
    appointmentDateInput.max = maxDate.toISOString().split("T")[0];

    const logout = document.querySelector('.logout');

    logout.addEventListener('click', function(){
        window.location.href = '../logout/logout.php';
    });

// Get the container for buttons
const timeButtonsContainer = document.getElementById("timeButtons");

// Generate buttons for each half-hour interval
for (let hour = 8; hour < 19; hour++) { // 8am to 8pm
    for (let minute = 0; minute < 60; minute += 30) { // 30 minute intervals
        const ampm = (hour < 12 || hour === 24) ? 'AM' : 'PM';
        const hour12 = (hour % 12 === 0) ? 12 : hour % 12;
        const formattedMinute = minute.toString().padStart(2, '0');
        const time12hr = `${hour12}:${formattedMinute} ${ampm}`;
        const formattedHour = hour.toString().padStart(2, '0');
        const time24hr = `${formattedHour}:${formattedMinute}:00`; // HH:MM:SS format

        const button = document.createElement('button');
        button.textContent = time12hr; // Display format
        button.value = time24hr; // Database format
        timeButtonsContainer.appendChild(button);
    }
}




    const appointmentTime = document.getElementById("appointmentTime");
    const buttons = document.querySelectorAll('#timeButtons button');

    buttons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); 
            appointmentTime.value = button.textContent;
        });
    });
    

    appointmentDateInput.addEventListener('input', () => {
          
        const selectedDate = appointmentDateInput.value;
        $.ajax({
            type: 'post',
            url: 'date_send.php',
            data: { selectDate: selectedDate },
            success: function (response) {
                if (response) {
                    const bookedTimes = JSON.parse(response);
                    const totalPossibleAppointments = 22;
                    console.log("Booked Times: ", bookedTimes);
                    console.log("Total Possible Appointments: ", totalPossibleAppointments);
                    if (bookedTimes.length >= totalPossibleAppointments) {
                        alert("Sorry, all appointments are full for the day!!!");
                        window.location.href = "../Dashboard/user_dash.php"; // Redirect to dashboard
                    } else {
                        timeButtonsContainer.style.display = "grid";
                        buttons.forEach(button => {
                            if (bookedTimes.includes(button.value)) {
                                button.style.display = 'none'; // Hide buttons with booked times
                            } else {
                                button.style.display = 'block'; // Show buttons with available times
                            }
                        });
                    }
                } else {
                    buttons.forEach(button => {
                        button.style.display = 'block';
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
    
    const serviceInput = document.getElementById("service");

    // Event listener to prevent form submission on Enter key press
    serviceInput.addEventListener('keydown', function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); 
        }
    });
    
    // Event listener to get the selected service
    serviceInput.addEventListener('change', function(event) {
        const selectedService = event.target.value;
        console.log(selectedService); // You can replace console.log with whatever action you want to perform with the selected service
    });
    