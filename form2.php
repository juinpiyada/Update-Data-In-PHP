<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP-MYSQL</title>
        <script>
            function showCourse(ccat)
            {
                document.getElementById("cname").options.length = 0;
                
                opt0 = document.getElementById("cname").options[0]=new Option("--SELECT--", "");
                opt0.setAttribute("selected","true");
                opt0.setAttribute("disabled","true");
                
                if (ccat == "UG")
                {                    
                    document.getElementById("cname").options[1]=new Option("BCA");
                    document.getElementById("cname").options[2]=new Option("BBA");
                    document.getElementById("cname").options[3]=new Option("Biotechnology");
                    document.getElementById("cname").options[4]=new Option("Microbiology");
                    document.getElementById("cname").options[5]=new Option("Media Science");
                    document.getElementById("cname").options[6]=new Option("HHA");
                    document.getElementById("cname").options[7]=new Option("TTM");
                }
                else if (ccat == "PG")
                {                    
                    document.getElementById("cname").options[1]=new Option("Computer Science");
                    document.getElementById("cname").options[2]=new Option("Biotechnology");
                    document.getElementById("cname").options[3]=new Option("Microbiology");
                    document.getElementById("cname").options[4]=new Option("Media Science");
                }                
            }
        </script>
    </head>
    <body>        
        <form action="#" method="post"> 
            <table align="center"> 
                <tr> 
                    <td>Enter ID:</td> 
                    <td><input type="text" id="sid" name="sid" style="text-transform: uppercase;" required></td> 
                </tr>
                <tr>
                    <td colspan="2" align="center"> 
                        <br> 
                        <input type="submit" id="search" name="search" value="SEARCH">                        
                    </td> 
                </tr> 
            </table> 
        </form>

        <?php

            //checking whether the data is present or not,
            //if present, retrieving it
            if (isset($_POST["search"])) 
            {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "school";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) 
                {
                    echo "<script>alert('connection failed')</script>";
                    echo "<script>window.location.href = 'form2.php'</script>";        
                } 
                else
                {
                    $sid = strtoupper(trim($_POST["sid"]));        

                    $sql = "SELECT * FROM student WHERE sid = '$sid'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) 
                    {
                        // output data of each row
                        while($row = $result->fetch_assoc()) 
                        {
                            $sid = $row["sid"];
                            $sname = $row["sname"];
                            $phno = $row["phno"];
                            $email = $row["email"];
                            $addr = $row["addr"];
                            $gender = $row["gender"];
                            $ccat = $row["ccat"];
                            $cname = $row["cname"];                                            
                        }
                    }        
                    else 
                    {
                        echo "<script>alert('Record not found')</script>";
                        echo "<script>window.location.href = 'form2.php'</script>";            
                    }

                    $conn->close();
                }
            }

        ?>

        <hr>
        <h1 align="center">STUDENT DETAILS</h1>         
        <form action="update.php" method="post">
            <input type="hidden" id="sid" name="sid" value="<?php if (isset($_POST["search"])){ echo $sid; } ?>"> 
            <table align="center">  
                <tr> 
                    <td>Name:</td> 
                    <td>
                        <input type="text" id="sname" name="sname" style="text-transform: uppercase;" 
                        value="<?php if (isset($_POST["search"])){ echo $sname; } ?>" required>
                    </td> 
                </tr> 
                <tr> 
                    <td>Contact No.:</td> 
                    <td>
                        <input type="text" id="phno" name="phno" pattern="[0-9]{10}" 
                        value="<?php if (isset($_POST["search"])){ echo $phno; } ?>" required>
                    </td> 
                </tr> 
                <tr> 
                    <td>Email Id:</td> 
                    <td>
                        <input type="email" id="em" name="em" 
                        value="<?php if (isset($_POST["search"])){ echo $email; } ?>" required>
                    </td> 
                </tr> 
                <tr> 
                    <td valign="top">Address:</td> 
                    <td>
                        <textarea id="addr" name="addr" rows="5" cols="15" style="text-transform: uppercase;" required><?php if (isset($_POST["search"])){ echo $addr; } ?></textarea>
                    </td> 
                </tr> 
                <tr> 
                    <td>Gender:</td> 
                    <td>
                        <select id="gender" name="gender" required>
                            <option value="" selected disabled>--SELECT--</option>
                                
                            <?php 
                    
                                $gender_arr = array("MALE", "FEMALE");
                                
                                for ($i = 0; $i < sizeof($gender_arr); $i++) 
                                {  			
                                    if ($gender_arr[$i] == $gender) 
                                    {
                                        echo "
                                            <option value='".$gender_arr[$i]."' selected>".$gender_arr[$i]."</option>				
                                        ";							
                                    }
                                    else
                                    {							
                                        echo "
                                            <option value='".$gender_arr[$i]."''>".$gender_arr[$i]."</option>
                                        ";
                                    }						
                                }				
                            
                            ?>

                        </select>                         
                    </td> 
                </tr>
                <tr> 
                    <td>Course Category:</td> 
                    <td> 
                        <select id="ccat" name="ccat" onchange="showCourse(this.options[this.selectedIndex].value)" required> 
                            <option value="" selected disabled>--SELECT--</option> 
                                                       
                            <?php 

                                $ccat_arr = array("UG", "PG");
                                
                                for ($i = 0; $i < sizeof($ccat_arr); $i++) 
                                {  			
                                    if ($ccat_arr[$i] == $ccat) 
                                    {
                                        echo "
                                            <option value='".$ccat_arr[$i]."' selected>".$ccat_arr[$i]."</option>				
                                        ";							
                                    }
                                    else
                                    {							
                                        echo "
                                            <option value='".$ccat_arr[$i]."''>".$ccat_arr[$i]."</option>
                                        ";
                                    }						
                                }					 

                            ?>

                        </select> 
                    </td> 
                </tr>  
                <tr> 
                    <td>Course:</td> 
                    <td> 
                        <select id="cname" name="cname">                            
                            <option value="" selected disabled>--SELECT--</option>

                            <?php 

                                if ($ccat == "UG") 
                                {
                                    $cname_arr = array("BCA", "BBA", "Biotechnology", "Microbiology", "Media Science", "HHA", "TTM");
                                }
                                elseif ($ccat == "PG") 
                                {
                                    $cname_arr = array("Computer Science", "Biotechnology", "Microbiology", "Media Science");		
                                }
                                
                                for ($i = 0; $i < sizeof($cname_arr); $i++) 
                                {  			
                                    if (strtoupper($cname_arr[$i]) == $cname) 
                                    {
                                        echo "
                                            <option value='".$cname_arr[$i]."' selected>".$cname_arr[$i]."</option>				
                                        ";							
                                    }
                                    else
                                    {							
                                        echo "
                                            <option value='".$cname_arr[$i]."''>".$cname_arr[$i]."</option>
                                        ";
                                    }						
                                }														 

                            ?>

                        </select> 
                    </td> 
                </tr> 
                <tr>
                    <td colspan="2" align="center"> 
                        <br> 
                        <input type="submit" id="update" name="update" value="UPDATE">                        
                    </td> 
                </tr> 
            </table> 
        </form> 
    </body>
</html>