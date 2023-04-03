$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: `./api.php?action=/getPatient`,

    }).then(function(res){ 
        let firstName = res.data.first_name;
        let lastName = res.data.last_name;
        $.ajax({
                type: "GET",
                url: `./api.php?action=/getPatientPosition`,
                success: function(res) {
                    rank = res.rank;
                    $("#welcome-text").text(`Welcome ${firstName} ${lastName}!`);
                    if (rank == 0) {
                        $("#position-text").text(`Good news ! It your turn to be served`);
                    }else{
                        $("#position-text").text(`You are currently ${rank} in line.`);

                    }
                    
                    $("#estimated-time").text(`Estimated time: ${rank * 15} minutes`);
                    
                }
            });
        });
    
});