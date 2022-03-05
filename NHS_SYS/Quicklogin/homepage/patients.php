<div style="overflow-x:auto;">
    <?php
        session_start();
        include("connection.php");
        include("functions.php");
        include("index.html"); // to access the navbar I need to include index.html
        $user_data = check_login($con);#THIS will also give id
        $_SESSION['assignedId'] = $user_data["id"] // i will access this variable for the google maps 
    
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
           <div class="someHeader">fooheader</div> <!-- adds more space-->
           <!-- <a href="google/index.php">Journey planner</a> Will take them to the page with the google maps-->

           <!-- <a href="../logout.php">Logout</a> This link will log them out of the page and direct them to login page. -->

            
            <h1>This is the homepage</h1>

            <br>
            Hello, <?php echo $user_data["user_name"], "  ", $user_data["Role"], $_SESSION['assignedId'] ; ?>
            <table id="patients-table" class= "content-table">
                
            
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Patient Name</th>
                        <th>Postcode</th>
                        <th>Reason</th>
                        <th>Notes</th>
                        <th>Last_Appointment</th>
                    </tr>
                    
                </thead>
                <tbody id="tableBody">
                    <?php
                    $connect = mysqli_connect("localhost","root","root","login_sample_db");
                   
                    $query = "
                    SELECT * 
                    FROM patients
                
                    WHERE Assign = '".$user_data["id"]."' 
                    ";

                    #fixed query
                    $result= mysqli_query($connect, $query);                    

                    if ($result-> num_rows>0){

                    while($row = $result->fetch_assoc()){
                        echo "<tr><td>". $row["id"]."<td>". $row["Patient_name"]."<td>". $row["Postcode"]."<td>". $row["Reason"]."<td>". $row["Notes"]."<td>". $row["Last_Appointment"]."</td></tr>";
                    }

                    }else{echo "No Result";}
                    $connect-> close();
                    
                    ?>
                </tbody>  
                
            </table>
            <?php
            ?>


           

        </body>
    </html>

    
    
    <script>  

    $(document).ready(function(){  
        $('#patients-table').Tabledit({
        url:'patient_action.php',
        columns:{
        identifier:[0, "id"],
        editable:[[1, 'Patient_name'], [2, 'Postcode'], [3, 'Reason'], [4, 'Notes'], [5, 'Last_Appointment']]
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

