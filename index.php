<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Container</title>
    <style>
    table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
     .container{
width:100%;
height:auto;
position:relative;
background:white;
border:1px solid black;
     }
     .header{
top:0;
width:100%;
height:100px;
background:none;
display:flex;
     }
    </style>
</head>
<body>
    <a href="register.php">signup</a><a href="login.php">signup</a>
    <div class="records">
<h2>total records : 
<?php
include('dbcon.php');
$ref_table ="GET";
$totalrecords = $database->getReference($ref_table)->getSnapshot()->numChildren();
echo $totalrecords;
?>
</h2>

    </div>
 <div class="container">
  <div class="header">
<h1>insert data</h1>
<a href="add-contact.php">add</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Ser No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>EDIT</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('dbcon.php');

            $ref_table = "GET";
            $fetchdata = $database->getReference($ref_table)->getValue();

            if($fetchdata > 0)
            {
                $i=0;
                foreach($fetchdata as $key => $row)
                {
                    
            $i++;
            ?>
                <tr>
                <td><?= $i ?></td>
                <td><?= $row['firstname']; ?></td>
                <td><?= $row['lastname']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['phone']; ?></td>
                <td>
                    <a href="edit.php?id=<?=$key;?>" >edit</a>
            
                </td>
                <td>
                  <form action="code.php" method="POST">
                    <input type="hidden" name="token" value="<?= $key;?>">
                   <button type="submit" name="delete" >delete</button>
                </form>
            
                </td>
                </tr>
            <?php
                }
            }
            else
            {
                ?>
                <tr>
                 <td colspan = "6">no record found</td>   
            </tr>
                <?php
            }
            ?>
            
        </tbody>
    </table>

   <?php
if(isset($_SESSION['status']))
{
    echo "<h4>" . $_SESSION['status']."</h4>";
    unset($_SESSION['status']);
}
   ?>
   
</div>
  
</body>
</html>

