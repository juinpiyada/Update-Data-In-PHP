<?php

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
        $sname = strtoupper(trim($_POST["sname"]));
        $phno = trim($_POST["phno"]);
        $email = trim($_POST["em"]);
        $addr = strtoupper(trim($_POST["addr"]));
        $gender = strtoupper(trim($_POST["gender"]));
        $ccat = strtoupper(trim($_POST["ccat"]));
        $cname = strtoupper(trim($_POST["cname"]));

        $sql = "UPDATE student SET sname = '$sname', phno = '$phno', email = '$email', addr = '$addr', gender = '$gender', ccat = '$ccat', cname = '$cname' WHERE sid = '$sid'";

        if ($conn->query($sql) === TRUE) 
        {
            echo "<script>alert('Record updated successfully')</script>";
            echo "<script>window.location.href = 'form2.php'</script>";
        } 
        else 
        {
            echo "<script>alert('Record updation failed')</script>";
            echo "<script>window.location.href = 'form2.php'</script>";            
        }

        $conn->close();
    }

?>