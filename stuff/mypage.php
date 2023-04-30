<?php 
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $id = $_SESSION['user_id'];

    // $query = "select * from food where user_id = '$id' limit 1";
    // $result = mysqli_query($con,$query);
    // if($result && mysqli_num_rows($result) > 0)
    // {
    //     $food_data = mysqli_fetch_assoc($result);
    // }

    $query = "select * from food where user_id = '$id'";
    $queryresult = mysqli_query($con,$query);

    // while ($result = mysqli_fetch_array($queryresult))
    // {
    //     echo $result['food_name'];
    //     echo "<br>";
    // }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Page</title>
    </head>

    <body>
        <h1>Hello <?php echo $user_data['user_name']; ?></h1>
        <h3>Food</h3>
        <a href="addfood.php">Add Food</a>
        <?php 
            while ($result = mysqli_fetch_array($queryresult))
            {
                echo "<p>Food Name: ";
                echo $result['food_name'];
                echo "</p>";
                echo "<p>Food Recipe: ";
                echo $result['food_recipe'];
                echo "</p>";
                echo "<hr>";
            }
        ?>



        <!-- <p><?php echo $food_data['food_name']; ?></p> -->
        <!-- /<p><?php echo $food_data['food_recipe']; ?></p> -->
    </body>
</html>




