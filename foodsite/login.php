<?php 

session_start();
    
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // print_r($_POST);
        if($_POST['login'])
        {
            //something was posted
            $user_name = $_POST['user_name'];
            $password = $_POST['password'];

            if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
            {

                //read from database
                $query = "select * from users where user_name = '$user_name' limit 1";
                $result = mysqli_query($con, $query);

                if($result)
                {
                    if($result && mysqli_num_rows($result) > 0)
                    {

                        $user_data = mysqli_fetch_assoc($result);
                        if($user_data['password'] === $password)
                        {

                            $_SESSION['user_id'] = $user_data['user_id'];
                            header("Location: index.php");
                            die;
                        }
                    }
                }
                echo "Wrong username or password!";
            }else
            {
                echo "Wrong username or password!";
            }
        }
        else if($_POST['signup'])
        {
            //something was posted
            $user_name = $_POST['user_name'];
            $password = $_POST['password'];

            if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
            {

                //save to database
                $user_id = random_num(20);
                $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

                mysqli_query($con, $query);

                header("Location: login.php");
                die;
            }else
            {
                echo "Please enter some valid information!";
            }
            }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=cyrillic,latin);

/* -------------------------------- 
Primary style
-------------------------------- */
*, *::after, *::before {
  box-sizing: border-box;
  outline: 0;
  padding: 0;
  margin: 0;
}

*::after, *::before {
  content: '';
}

body {
  font-size: 100%;
  font-family: 'Open Sans', sans-serif;
  font-weight: normal;
  color: #444;
  background-color: #fafafa;
}

a {
  color: #444;
  text-decoration: none;
}

/* -------------------------------- 
Main components 
-------------------------------- */

.logo {
  display: block;
  margin: 0 auto;
  margin-top: 5%;
  margin-bottom: 20px;
  width: 120px;
  height: 120px;
  opacity: 0.5;
}

.cd-tabs {
  position: relative;
  width: 90%;
  max-width: 600px;
  min-width: 400px;
  margin: 0 auto;
}
.cd-tabs:after {
  content: '';
  display: table;
  clear: both;
}

.cd-tabs nav {
  overflow: hidden;
  position: relative;
}
.cd-tabs-navigation:after {
  content: "";
  display: table;
  clear: both;
}

  .cd-tabs-navigation {
    padding: 0;
    margin: 0;
    width: 100%;
    background-color: #fff;
    border: 1px solid #e9e9e9;
    border-bottom: none;
    box-shadow: 0 2px 1px #f1f1f1;
    }

  .cd-tabs-navigation li {
    display: block;
    float: left;
    height: 60px;
    width: 49%;
    max-width: 298px;
    line-height: 60px;
    text-align: center;
   }
  .cd-tabs-navigation a {
    position: relative;
    display: block;
    height: 60px;
    width: 100%;
    font-size: 18px;
    padding: 0 0 0 20px;
  }
  .cd-tabs-navigation a::before {
  /* icons */
  position: absolute;
    top: 50%;
    margin-top: -16px;
    left: 30%;
  display: inline-block;
  height: 26px;
  width: 26px;
  background: url('http://image005.flaticon.com/1/svg/32/32317.svg');
  background-repeat: no-repeat;
  background-size: contain;
}

.cd-tabs-navigation a[data-content='signup']::before {
  background-image: url('http://image005.flaticon.com/1/svg/1/1819.svg');
}

  .cd-tabs-navigation a.selected {
    box-shadow: inset 0 2px 0 #617a55;
  }

  .cd-tabs-navigation a[data-content='signup']::before {
    left: 20%;
  }

/* трохи попраимо розміщення іконок коли вікно стає меншим */
@media only screen and (max-width: 768px) {
  .cd-tabs-navigation a::before {
    left: 20%;
  }

  .cd-tabs-navigation a[data-content='signup']::before {
    left: 8%;
  }
}

.cd-tabs-navigation a.selected {
  background-color: #fff !important;
  box-shadow: inset 0 2px #617a55;
  color: #29314e;
}

/* -------------------------------- 
Вміст вкладок 
-------------------------------- */

.cd-tabs-content {
  background: #ffffff;
  margin: 0;
  padding: 0;
}
.cd-tabs-content li {
  display: none;
  padding: 1.4em;
}
.cd-tabs-content li.selected {
  border: 1px solid #e9e9e9;
  border-top: 1px solid rgba(0,0,0,.02);
  box-shadow: 0 2px 1px #f1f1f1;
  display: block;

  -webkit-animation: cd-fade-in 0.5s;
  animation: cd-fade-in 0.5s;
}

form {
  display: block;
  position: relative;
}

.form-fild {
  position: relative;
  display: block;
  width: 90%;
  height: 60px;
  margin: 10px auto;
}

.form-fild input {
  position: relative;
  z-index: 99;
  border: none;
  border-bottom: 1px solid #e0e0e0; 
  display: block;
  width: 100%;
  height: 40px;
  outline: none;
  font-family: 'Open Sans', sans-serif;
  font-size: 16px;
  color: #444;
  background: transparent;
} 

input:-webkit-autofil,
textarea:-webkit-autofill, 
select:-webkit-autofill  {background-color: transparent;}

.form-fild label {
  position: absolute;
  top: 7px;
  text-transform: lowercase;
  transition: all 0.3s;
}

label.focused {
  font-size: 12px;
  top: -10px;
}

form button {
  display: block;
  width: 100px;
  height: 40px;
  margin: 0 auto;
  margin-top: 10px;
  background: none;
  border: 1px solid #444;
  text-transform: uppercase;
  color: #444;
  cursor: pointer;
  transition: all 0.3s;
}

form button:hover {
  border: 2px solid #617A55;
}

/* тут буде вставляти текст помилок */
.error {
    display: none;
    position: absolute;
    width: 184px;
    line-height: 18px;
    top: -198px;
    left: 353px;
    padding: 10px;
    color: #DC3B3B;
    background: rgba(255, 0, 0, 0.17);
    text-transform: uppercase;
    font-size: 15px;
    text-align: center;
}

@-webkit-keyframes cd-fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
@keyframes cd-fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

/* -------------------------------- 
FOOTER
-------------------------------- */

footer {
  margin-top: 100px;
  display: block;
  height: 60px;
  width: 100%;
  text-align: center;
/*   background: #000; */
  border-top: 1px solid #617a55; 
  line-height: 60px;
}

footer a {border-bottom: 3px solid rgba(0,0,0,.1);}
footer a:hover {border-bottom: 3px solid rgba(0,0,0,.6);}
    </style>
    </head>
</head>
<body>
    <!--<div id='cover' class='cover'>
        <button id='button' class='button'>
        <div id='label' class='label'>
        Log-In</div>
        </button>
        <button id='button2' class='button2'>
        <div id='label2' class='label2'>
        Sign-Up</div>
        </button>
        </div> -->
        <img src="http://image005.flaticon.com/1/svg/74/74229.svg" alt="user icon" class="logo">
    <div class="cd-tabs">
      <nav>
        <ul class="cd-tabs-navigation">
          <li><a href="#" data-content="login" class="selected">login</a></li>
          <li><a href="#" data-content="signup">signup</a></li>
        </ul>
      </nav>
      <ul class="cd-tabs-content">
        <li data-content="login" class="selected">
          <form method="post">
            <div class="form-fild">
              <label for="user_name">username</label>
              <input type="text" name="user_name">
            </div>
            <div class="form-fild">
              <label for="password">password</label>
              <input type="password" name="password">
            </div>
            <span class="error"></span>
            <!-- <button type="submit">Submit</button> -->
            <input type="submit" name="login" value=submit>
          </form>
        </li>
        <li data-content="signup">
          <form name="signup-form" method="post">
            <div class="form-fild">
              <label for="user_name">username</label>
              <input type="text" name="user_name">
            </div>
            <div class="form-fild">
              <label for="password">password</label>
              <input type="password" name="password">
            </div>
            <div class="form-fild">
              <label for="password">password again</label>
              <input type="password" name="password">
            </div>
            <span class="error"></span>
            <!-- <button type="submit">Submit</button> -->
            <input type="submit" name="signup" value="Submit">
          </form>
        </li>
      </ul>
    </div> <!-- end cd-tabs -->
   <footer>
     <div>Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
     </div>
     <div>Thanks to a lesson: <a href="https://codyhouse.co/gem/responsive-tabbed-navigation/" title="Responsive Tabbed Navigation">Responsive Tabbed Navigation</a> from <a href="https://codyhouse.co">www.codyhouse.co</a>
     </div>
   </footer>

        <script>
            'use strict';

window.addEventListener('load', windowLoaded, false);

function windowLoaded() {
	var 
		tabs = document.querySelectorAll('.cd-tabs')[0],
		login = document.querySelectorAll('a[data-content=\'login\']')[0],
		signup = document.querySelectorAll('a[data-content=\'signup\']')[0],
		tabContentWrapper = document.querySelectorAll('ul.cd-tabs-content')[0],
		currentContent = document.querySelectorAll('li.selected')[0];

	login.addEventListener('click', clicked, false);
	signup.addEventListener('click', clicked, false);

	function clicked(event) {
		event.preventDefault();
    
		var selectedItem = event.currentTarget;
		if (selectedItem.className === 'selected') {
      // ...       
		} else {
			var selectedTab = selectedItem.getAttribute('data-content'),
				selectedContent = document.querySelectorAll('li[data-content=\'' + selectedTab + '\']')[0];

			if (selectedItem == login) {
				signup.className = '';
				login.className = 'selected';
			} else {
				login.className = '';
				signup.className = 'selected';
			}

			currentContent.className = '';
			currentContent = selectedContent;
			selectedContent.className = 'selected';

		}
	}

	var inputs = document.querySelectorAll('input');
	for (var i = 0; i < inputs.length; i++) {
		inputs[i].addEventListener('focus', inputFocused, false);
	}

	function inputFocused(event) {
		var label = document.querySelectorAll('label[for=\''+ this.name +'\']')[0];
		label.className = 'focused';
	}
}	

        </script>
</body>
</html>