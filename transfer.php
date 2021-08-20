<!DOCTYPE html>
<?php
            $conn = new mysqli("localhost" , "root", "", "banking_system");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from cutomers where id =$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from customers where id =$to";
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
                $sql = "UPDATE customers set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             

                
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE customers set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='Customers.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<html>
<head>
    
    <style>
  
  
    </style>
</head>

<body>

<div class="container">
        <h2 class="text-center pt-5">Transaction</h2>
            <?php
            $conn = new mysqli("localhost" , "root", "", "banking_system");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  customers where id = $sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="">
                <tr>
                    <th class="text-center">Customer ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr>
                    <td class="a"><?php echo $rows['id'] ?></td>
                    <td class="b"><?php echo $rows['name'] ?></td>
                    <td class="c"><?php echo $rows['email'] ?></td>
                    <td class="d"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <label>Transfer To: </label>
        <select name="to" class="form" required>
            <option value="" disabled selected>Choose:</option>
            <?php
                $conn = new mysqli("localhost" , "root", "", "banking_system");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
                $sid=$_GET['id'];
                $sql = "SELECT * FROM customers where id!=$sid";
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
            <label>Enter Amount To Transfer:</label>
      
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button class="btn" name="submit" type="submit" id="btn1">Transfer</button>
            </div>
        </form>
    </div>
</body>
</html>