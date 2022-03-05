<div style="overflow-x:auto;">
    <?php
    session_start();
        
        include("../connection.php");
        include("../functions.php");
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
            <a href="../../logout.php">Logout</a>

            <a href=admin_patients.php>Patients</a>

            <h1>This is the homepage</h1>

            <br>
            Hello, <?php echo $user_data["user_name"], "  ", $user_data["Role"] ; ?>

            <table id="users-table" class= "content-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>user_name</th>
                        <th>Role</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php
                    $conn = mysqli_connect("localhost","root","root","login_sample_db");

    
                    $sql= "SELECT * FROM users ORDER BY id DESC";
                    $result= $conn->query($sql);

                    if ($result-> num_rows>0){

                    while($row = $result->fetch_assoc()){
                        echo "<tr><td>".$row["id"]."<td>".$row["user_name"]."<td>".$row["Role"]."</td></tr>";
                    }
                    }else{echo "No Resutl";}
                    $conn-> close();

                    ?>
                </tbody>  
                
            </table>
        </body>
    </html>

<script>  
    $(document).ready(function(){  
        $('#users-table').Tabledit({
        url:'action.php',
        columns:{
        identifier:[0, 'id'],
        editable:[[2,'Role','{"1":"user","2":"admin"}']]
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

