<div style="overflow-x:auto;">
    <html>
        <head>
            <link rel="stylesheet" href="table.css">
        </head>
        <body>
            <table id="patients-table" class= "content-table">
                <thead>
                    <tr>
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
                    $sql= "SELECT * FROM patients";
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

            <script type="text/javascript">
                var table = document.getElementById("patients-table");
                var cells = table.getElementsByTagName("td");
                //console.log(cells);

                for (var i=0; i < cells.length; i++){
                    cells[i].onclick= function() {
                        if (this.hasAttribute("data-clicked")){
                            return;
                        }
                            
                        this.setAttribite("data-clicked","yes");
                        this.setAttribute("data-text", this.innerHTML);

                        var input = document.createElement("input");
                        input.setAttribute("type", "text");
                        input.value = this.innerHTML;

                        input.style.width= this.offsetWidth - (this.clientLeft*2)+"px";
                        input.style.height= this.offsetHeight - (this.clientTop*2)+"px";
                        input.style.border ="0px";
                        input.style.fontFamily = "inherit";
                        input.style.fontSize ="inherit";
                        input.style.textAlign = "inherit";
                        input.style.backgrounColor = "LightGoldenRodYellow";

                        input.onblur = function(){
                            var td =input.parentElement;
                            var orig_text = input.parentElement.getAttribute("data-text");
                            var current_text = this.value;

                            if(orig_text != current_text){
                                //save to db with Ajax
                                td.removeAttribute("data-clicked");
                                td.removeAttribute("data-text");
                                td.innerHTML = current_text;
                                td.style.cssText = "padding: 15px";
                                console.log(orig_text +" is changed to "+ current_text);
                            }else{
                                td.removeAttribute("data-clicked");
                                td.removeAttribute("data-text");
                                td.innerHTML = orig_text;
                                td.style.cssText = "padding: 15px";
                                console.log("No changes");
                            }

                        }
                        input.onkeypress = function(){
                            if (event.keyCode ==13){
                                this.blur();
                            }
                        }
                        this.innerHTML ="";
                        this.style.cssText ="padding: 0px 0px";
                        this.append(input);
                        this.firstElementChild.select();
                        

                    }
                }
            </script>
        </body>
    </html>
</div>

