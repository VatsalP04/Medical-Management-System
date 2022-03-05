<div style="overflow-x:auto;">
    <html>
        <head>
            <link rel="stylesheet" href="table.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <script type="text/javascript" src="dist/jquery.tabledit.js"></script>
        </head>
        <body>
            <table id="patients-table" class= "content-table">
                <thead>
                    <tr>
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
                    $conn = mysqli_connect("localhost","root","","login_sample_db");
                    $sql= "SELECT * FROM patients ORDER BY id DESC";
                    $result= $conn->query($sql);

                    if ($result-> num_rows>0){

                    while($row = $result->fetch_assoc()){
                        echo "<tr><td>". $row["Patient_name"]."<td>". $row["Postcode"]."<td>". $row["Reason"]."<td>". $row["Notes"]."<td>". $row["Last_appointment"]."</td></tr>";
                    }

                    }else{echo "No Resutl";}
                    $conn-> close();

                    ?>
                </tbody>  
                
            </table>
        </body>
    </html>
</div>