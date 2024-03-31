    
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
for (let hour = 8; hour <= 20; hour++) { // 8am to 8pm
    for (let minute = 0; minute < 60; minute += 30) { // 30 minute intervals
        const formattedHour = hour.toString().padStart(2, '0');
        const formattedMinute = minute.toString().padStart(2, '0');
        const time = `${formattedHour}:${formattedMinute}:00`;
        const button = document.createElement('button');
        button.textContent = time;
        button.value = time; // You can use this value when the button is clicked to record the selected time
        timeButtonsContainer.appendChild(button);
    }
}



    const appointmentTime = document.getElementById("appointmentTime");
    const buttons = document.querySelectorAll('#timeButtons button');
    
    // Loop through each button and add click event listener
    buttons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission behavior
            appointmentTime.value = button.textContent; // Set the value of the appointment time input field to the text content of the clicked button
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
                    buttons.forEach(button => {
                        if (bookedTimes.includes(button.value)) {
                            button.style.display = 'none'; // Hide buttons with booked times
                        } else {
                            button.style.display = 'block'; // Show buttons with available times
                        }
                    });
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
    
    