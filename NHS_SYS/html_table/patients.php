<div style="overflow-x:auto;">
    <?php
    session_start();
        
        include("connection.php");
        include("functions.php");
        #$user_data = check_login($con);
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
            <!--<a href="localhost/NHS_SYS/Quicklogin/logout.php">Logout</a>-->
            <h1>This is the homepage</h1>

            <br>
            <?php# echo $user_data["user_name"]; ?>
            <table id="patients-table" class= "content-table">
                
            
                <thead>
                    <tr> 
                        <!--These are the headings of the table. -->
                        <th>Id</th>
                        <th>Patient Name</th>
                        <th>Postcode</th>
                        <th>Reason</th>
                        <th>Notes</th>
                        <th>Last_appointment</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php
                    #This creates a connection to the database. 
                    $conn = mysqli_connect("localhost","root","root","login_sample_db");
                    
                    #This sql statement will selected all records in the table patients after ordering the list by descending ID number. 
                    $sql= "SELECT * FROM patients ORDER BY id DESC";
                    $result= $conn->query($sql);

                    #if some records are selected then.....
                    if ($result-> num_rows>0)
                    {

                        while($row = $result->fetch_assoc()) # fetches the rows as an associative array
                        { #The row will be outputted under the headings outlined above. 
                            echo "<tr><td>". $row["id"]."<td>". $row["Patient_name"]."<td>". $row["Postcode"]."<td>". $row["Reason"]."<td>". $row["Notes"]."<td>". $row["Last_appointment"]."</td></tr>";
                        }
                    }
                    else{echo "No Resutl";}#if there are no rows then print no result and close the connection.
                    $conn-> close();
                    ?>
                </tbody>  
                
            </table>
        </body>
    </html>


    <script>
    $(document).ready(function()
    {  
        $('#patients-table').Tabledit(
        {
            // links to server script    
            url:'action.php',
            // Column used to identify table row. 
            columns:
                {
                identifier:[0, "id"],
                //I am specifying which column I need to make editable.
                editable:[[1, 'Patient_name'], [2, 'Postcode'], [3, 'Reason'], [4, 'Notes'], [5, 'Last_appointment']]
                },
            // activates the restore button to undo delete action
            restoreButton:false,
            // the if statement is executed when the ajax request is completed
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

