<div style="overflow-x:auto;">
    <?php
    session_start();
        
        include("connection.php");
        include("functions.php");
        $user_data = check_login($con);
    ?>
    <html>
        <head>
            <link rel="stylesheet" href="table.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>            
            <script src="jquery.tabledit.min.js"></script>
        </head>
        <body>     
        <table id="patients-table" class= "content-table">       
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Patient Name</th>
                        <th>Postcode</th>
                        <th>Reason</th>
                        <th>Notes</th>
                        <th>Last_Appointment</th>
                        <th>Assign</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = mysqli_connect("localhost","root","root","login_sample_db");
                    $sql= "SELECT * FROM patients ORDER BY id DESC";
                    //echo"$msg['Last_Appointment']";
                    $result= $conn->query($sql);

                    if ($result-> num_rows>0){

                        while($row = $result->fetch_assoc()){
                        echo "<tr><td>". $row["id"]."<td>". $row["Patient_name"]."<td>". $row["Postcode"]."<td>". $row["Reason"]."<td>". $row["Notes"]."<td>". $row["Last_Appointment"]."<td>". $row["Assign"]."</td></tr>";
                        }


                    }else{echo "No Result";}
                    $conn-> close();

                    ?>
                </tbody>  
                
            </table>

            <form method="post">

            <input type="submit" name="Add-Row" value="Add-Row"> <!-- I added a button, when clicked the post method would be set. -->
            
            <?php
            if(isset($_POST["Add-Row"]))// if the button was clicked then do the following statement.
            {
                $connect = mysqli_connect("localhost","root","root","login_sample_db");

                $query = "INSERT INTO `patients`(`Patient_name`, `Postcode`, `Reason`, `Notes`, `Last_Appointment`, `Assign`) VALUES ('Default','Default','Default','Default','2022-01-02','".$user_data["id"]."')"; // sql query which will update sql table with Assign value as the user id currently using. 


                mysqli_query($connect, $query); // performs the query
            }
            ?>
        </body>
    </html>

    
    <script>  
    $(document).ready(function(){  
        $('#patients-table').Tabledit({
        url:'admin_patients_action.php',
        columns:{
        identifier:[0, "id"],
        editable:[[1, 'Patient_name'], [2, 'Postcode'], [3, 'Reason'],[4, 'Notes'], [5, 'Last_Appointment'], [6,'Assign']]
        },
        restoreButton:false,
        onSuccess:function(data, textStatus, jqXHR)
        {
        if(data.action == 'delete')
        {
            $('#'+data.id).remove();

        }
        }
        });
    
    });  
    </script>


</div>

