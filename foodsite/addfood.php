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
        <style>
                        body {
        background-color: #fff8d6;
        font-family: Arial, sans-serif;
      }
      .dashboard {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
      }
      .people {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #617a55;
      }
      .rectangle7 {
        width: 100%;
        height: 10px;
        background-color: #a4d0a4;
        margin-bottom: 20px;
      }
      .avatar {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        height: 200px;
        width: 200px;
        background-color: #f7e1ae;
        border-radius: 50%;
      }
      .frame10067,
      .frame100672,
      .frame100673 {
        height: 90%;
        width: 90%;
        border: 2px solid #617a55;
        border-radius: 50%;
      }
      .rectangle9 {
        width: 100%;
        height: 10px;
        background-color: #a4d0a4;
        margin-bottom: 20px;
      }
      .suggestedrecipes {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #617a55;
      }
      .image {
        width: 400px;
        height: 300px;
        margin-bottom: 20px;
      }
      .image2,
      .image4 {
        max-width: 100%;
        max-height: 100%;
      }
      .image3 {
        width: 400px;
        height: 300px;
        margin-bottom: 20px;
        background-color: #f7e1ae;
      }
        </style>
    </head>
    <body>
        <div id="box dashboard">
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


