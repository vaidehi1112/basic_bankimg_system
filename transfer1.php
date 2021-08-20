<?php
error_reporting(0);
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "bank";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from user where id = $from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from user where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';
        echo '</script>';
    }


  
    
    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")'; 
        echo '</script>';
    }
    


   
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE user set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             

                
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE user set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction (`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='view.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<html>
<head>
</head>

<body>

<ul>
	<li><a href="home1.html"><font color="black"><b>Home</font></a></li>
</ul>

<head><font color="white" size="50" align="center"><h3>Customer Details</h3></font></head>
            <?php
                error_reporting(0);
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "bank";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  user where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
       <div>	
	<table align = "center" border="1" cellspacing="15">
	<tr>
	<th class="text-center py-3" color="white">User ID</th>
	<th class="text-center py-3">Name</th>
	<th class="text-center py-3">Email ID</th>
	<th class="text-center py-3">Balance</th>
	</tr>
	
	<tr>
	<td class="py-3"><?php echo $rows['id'] ?></td>
	<td class="py-3"><?php echo $rows['name'] ?></td>
	<td class="py-3"><?php echo $rows['email'] ?></td>
	<td class="py-3"><?php echo $rows['balance'] ?></td>
	</tr>
	</table>
	</div>
        <head><font color="white" size="50" align="center"><h3>Transfer Money</h3></font></head>
		<label><center>Transfer To: </label>
        <select name="to" class="form" required>
            <option value="" disabled selected>Choose:</option>
            <?php
                error_reporting(0);
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "bank";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}
                $sid=$_GET['id'];
                $sql = "SELECT * FROM user where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?>
               
                </option>
            <?php 
			
                } 
				
            ?>
            <div>
        </select>
        <br>
        <br>
            <label><center>Enter Amount To Transfer:</label>
			
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button class="btn" name="submit" type="submit" id="btn1">Transfer</button>
            </div>
        </form>
    </div> 