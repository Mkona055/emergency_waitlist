
function markAsServed(id){
    $.ajax({
        type: "POST",
        url: `/api.php?action=/markServed&id=${id}`,
        data: {
            id: id
        },
        success: function(res) {
            console.log(res);
            if(res.success){
                window.location = "./home.php?success=true";

            }else{
                window.location = "./home.php?error=true";

            }
        }
    });
}
$(document).ready(function () {
    $("#validationCustom05").inputmask('(999)-999-9999');
    $.ajax({
        type: "GET",
        url: `/api.php?action=/getUnservedPatients`,
        success: function(res) {
            patients = res.patients;

            table = document.getElementById("patientsUnserved");
            for (let i = 0 ; i < patients.length ; i++){            
                var row = document.createElement("tr");                
                var data = document.createElement("td");
                data.innerText = i + 1 ;
                row.appendChild(data);
                var data = document.createElement("td");
                data.innerText = patients[i].code;
                row.appendChild(data);
                var data = document.createElement("td");
                data.innerText = patients[i].first_name;
                row.appendChild(data);
                var data = document.createElement("td");
                data.innerText = patients[i].last_name;
                row.appendChild(data);
                var data = document.createElement("td");
                data.innerText = patients[i].email;
                row.appendChild(data);
                var data = document.createElement("td");
                data.innerText = patients[i].injury_severity;
                row.appendChild(data);
                var data = document.createElement("td");
                data.innerText = patients[i].came_at;
                row.appendChild(data);
                var data = document.createElement("td");
                data.innerText = patients[i].phone;
                row.appendChild(data);
                var data = document.createElement("button");
                if (i == 0){                
                    data.className =  "btn btn-success mt-2 mb-2 ms-auto me-auto";
                    data.style.setProperty("background-color", "#198754", "important");
                    data.addEventListener("mouseover", function() {
                        this.style.backgroundColor = "#0f5032";
                    });
                    data.addEventListener("mouseout", function() {
                        this.style.backgroundColor = "#198754";
                    });
                    data.innerText = "Mark as served";

                }else{

                    data.className = "d-flex justify-content-center btn btn-outline-success mt-2 mb-2 ms-auto me-auto";
                    data.disabled = true;                
                    data.innerText = "In queue";

                }
                data.addEventListener("click", function() {
                    markAsServed(patients[i].id);
                });
                row.appendChild(data);         
                res.className = "text-center";
                table.appendChild(row);    

            } 
            table.className += "table";
        }
    });
});