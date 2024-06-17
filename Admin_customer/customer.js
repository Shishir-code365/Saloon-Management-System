    const logout = document.querySelector('.logout');

    logout.addEventListener('click', function(){
        window.location.href = '../logout/logout.php';
    });


    function searchCustomers() {
        var input, filter, users, cards, username, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.trim().toUpperCase();
        users = document.getElementsByClassName("grid-container")[0];
        cards = users.getElementsByClassName("card");
    
        for (i = 0; i < cards.length; i++) {
            username = cards[i].getElementsByClassName("detail")[0].getElementsByTagName("p")[0];
            txtValue = username.textContent || username.innerText;
            txtValue = txtValue.toUpperCase();
    
            // Check if the username contains the filter text
            if (txtValue.indexOf(filter) > -1 || filter === "") {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }
    
    
    

    const add_service = document.querySelector('.add-service');
    const fullscreen = document.querySelector('.full-screen');
    const exit = document.querySelector('.exit');
    $(document).ready(function() {
        $(".delete-button").click(function() {
        
        var email = $(this).closest('.card').find('.customer-email').text().trim().replace("Email: ", "");
            
            if (confirm("Are you sure you want to delete this customer?")) {
                

                $.ajax({
                

                    type: 'post',
                    url: 'customer_del.php',
                    data: { email: email },
                    
                    success: function(response) {
                        console.log(response);
                        if (response === "success" ) {
                            
                            alert("Customer account successfully deleted!!");
                            window.location.href = "customer.php"; 
                        } else{
                            alert("Failed to delete account. Please try again later.");
                        }
                    },
                    error: function() {
                        alert("Error: Unable to process the request.");
                    }
                });
            }
        });

    });



$(document).ready(function(){
    $(".see-button").click(function(event){
   
    event.preventDefault();
    console.log("clicked");
        fullscreen.style.display = "inline";
        add_service.style.display = "inline";
        add_service.style.display = "flex";
        var email = $(this).closest('.card').find('.customer-email').text().trim().replace("Email: ", "");
        console.log(email);
        $('.svg p').text(email);
        
            $.ajax({
                type: 'POST',
                url: 'customer_data.php',
                data: { email_customer: email},
                dataType: 'json',
                success: function(response2)
                {   
                    
                    
                    if(response2)
                    {
                        // console.log("AJAX Success:", response2);
                        // console.log($('.name'));
                        // console.log(response2.username);
                    $('.email').text(response2.email);
                    $('.name').text(response2.name);
                    $('.phone').text(response2.phone);
                    $('.username').text(response2.username);
                    $('.svg h4').text(response2.name);         
                    }
                    else{
                        console.log("no response");
                    }
                    
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            })
        
            $.ajax({
                type: 'POST',
                url: 'customer_appointmentdata.php',
                data: { email_customer: email },
                dataType: 'json',
                success: function(response3){
                    if(response3){
                    console.log(response3);}
                    if (Array.isArray(response3)) {
                        
                        let tbody = $('#appointmentBody');
                        tbody.empty();  // Clear existing rows
                        response3.forEach((appointments, index) => {
                            let row = `<tr>
                                <td>${index + 1}</td>
                                <td class='appointmentDate'>${appointments.appointmentDate}</td>
                                <td class='appointmentTime'>${appointments.appointmentTime}</td>
                                <td class='service'>${appointments.service}</td>
                                <td class='status' style="color: ${appointments.status === 'unpaid' ? 'red' : appointments.status === 'paid' ? 'green' : 'inherit'};">${appointments.status}</td>
                            </tr>`;
                            
                            tbody.append(row);
                        });
                    } else if (response3.error) {
                        let row1 = `<tr>
                                    <td colspan="5">No Records to show</td></tr>
                        `;
                        tbody.append(row1);
                        console.log(response3.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });

    })
})   
let tbody = $('#appointmentBody');
    exit.addEventListener('click',function(){
        add_service.style.display = "none";
        fullscreen.style.display = "none";
        tbody.empty();
    })


