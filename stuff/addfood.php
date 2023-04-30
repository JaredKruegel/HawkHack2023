<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);


if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $food_name = $_POST['food_name'];
    $food_recipe = $_POST['food_recipe'];
    $user_id = $user_data['user_id'];

    if(!empty($food_name) && !is_numeric($food_name) && !empty($food_recipe) && !is_numeric($food_recipe))
    {
        $food_id = random_num(20);
        $query = "insert into food (food_id,food_name,food_recipe,user_id) values ('$food_id', '$food_name', '$food_recipe','$user_id')";

        mysqli_query($con, $query);

        header("Location: mypage.php");
        die;
    } else 
    {
        echo "Please enter some valid information";
    }
}



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add a Food Item</title>
    </head>
    <body>
        <div id="box">
            <form method="post">
                <div>Add an item</div>

                <label for="food_name">Name of Food:</label>
                <input id="text" type="text" name="food_name"><br>

                <label for="food_recipe">Recipe of Food:</label>
                <input id="text" type="text" name="food_recipe"><br>

                <input id="button" type="submit" value="Submit">

                <a href="mypage.php">Back</a>
            </form>
        </div>
    </body>
</html>


