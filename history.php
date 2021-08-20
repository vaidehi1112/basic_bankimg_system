<!DOCTYPE html>
<html>

    <style>  
    html { 
  background: url(bank.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
table, th, td {  
    background-color: whitesmoke;
  border: 1px solid black;  
  border-collapse: collapse;  
}  
th, td {  
  padding: 10px;  
}  
table#alter tr:nth-child(even) {  
  background-color: #eee;  
}  
table#alter tr:nth-child(odd) {  
  background-color: #fff;  
}  
table#alter th {  
  color: white;  
  background-color: gray;  
}  

body {
  background-color: ;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: ;
  position: fixed;
  top: 0;
  width: 100%;
}

.active {
  background-color: ;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
li a:hover {
  background-color: lightslategrey;
}
</style>  
   
<head>

<ul>
  <li><a href="homenew.php"><font color="black"><b>Home</font></a></li>
</ul>

<head>
<body>
<?php
    error_reporting(0);
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "bank";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
    $sql = "SELECT * FROM transaction";
    $result = mysqli_query($conn,$sql);
?>

<div class="container">
    <center>
    <br><br><br>
        <h2 class="text-center pt-4"><font size="10">Transaction History</font></h2>
        <br><br><br>
    
            <div class="row">
                <div class="col">
                    <div class="tables">
                    <table class="table">
                        <thead>
                            <tr>
                            <th class="text-center py-3" color="white">Transaction ID</th>
                            <th class="text-center py-3">Sender</th>
                            <th class="text-center py-3">Receiver</th>
                            <th class="text-center py-3">Amount</th>

                            </tr>
                        </thead>
                        <tbody>
                        </center>
                <?php 
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td class="py-3"><?php echo $rows['tid'] ?></td>
                        <td class="py-3"><?php echo $rows['sender']?></td>
                        <td class="py-3"><?php echo $rows['receiver'] ?></td>
                        <td class="py-3"><?php echo $rows['balance']?></td>
                        </tr>
          
                <?php
                    }
                ?>
            
                        </tbody>
                    </table>
                    </div>
                </div>
            </div> 
         </div>
     </body>

</head>
</html>