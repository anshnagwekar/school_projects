<!DOCTYPE html>
<html lang='en'>
<meta charset="utf-8">
<title>Login</title>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<!-- 
  This is the login page for the Pet Vault.
  It uses regular password protection but also checks for correct images upon login.
  -->
<style>
  * {
    box-sizing: border-box;
  }

  body {
    background-color: #f1f1f1;
  }

  #regForm {
    background-color: #ffffff;
    margin: 100px auto;
    font-family: Raleway;
    padding: 40px;
    width: 70%;
    min-width: 300px;
  }

  h1 {
    text-align: center;  
    color: #4b389e;
  }

  input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
  }

  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: #ffdddd;
  }

  /* Hide all steps by default: */
  .tab {
    display: none;
    width: 100%;
  }

  button {
    background-color: #4b389e;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;
  }

  button:hover {
    opacity: 0.8;
  }

  #prevBtn {
    background-color: #bbbbbb;
  }

  /* Make circles that indicate the steps of the form: */
  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;  
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }

  .step.active {
    opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: #4b389e;
  }

  p.error
      {
        background-color: #4b389e;
        border-bottom: 1px solid #efefef;
        font-weight: bold;
        color: white;
        padding: 6px;
      }

      ul {
        list-style-type: none;
      }

      li {
        display: inline-block;
      }

      input[type="checkbox"][id^="cb"] {
        display: none;
      }

      label {
        border: 1px solid #fff;
        padding: 10px;
        display: block;
        position: relative;
        margin: 10px;
        cursor: pointer;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      label::before {
        background-color: white;
        color: white;
        content: " ";
        display: block;
        border-radius: 50%;
        border: 1px solid grey;
        position: absolute;
        top: -5px;
        left: -5px;
        width: 25px;
        height: 25px;
        text-align: center;
        line-height: 28px;
        transition-duration: 0.4s;
        transform: scale(0);
      }

      label img {
        height: 100px;
        width: 100px;
        transition-duration: 0.2s;
        transform-origin: 50% 50%;
      }

      :checked+label {
        border-color: #ddd;
      }

      :checked+label::before {
        content: "✓";
        background-color: grey;
        transform: scale(1);
      }

      :checked+label img {
        transform: scale(0.9);
        box-shadow: 0 0 5px #333;
        z-index: -1;
      }
</style>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='login.js'></script>
<?php
		$error = "";
		if (! empty($_POST)) {
			/* Start the PHP Session */
			session_start();

			/* Include the database connection file (remember to change the connection parameters) */
			require 'config.php';

			/* Include the Account class file */
			require 'account_class.php';

			/* Create a new Account object */
			$account = new Account();

      $login = FALSE;


      $dog_arr = $_POST['dog'];
      if (count($dog_arr) == 3){
        $dog_layer = pow(10, intval($dog_arr[0])) + pow(10, intval($dog_arr[1])) + pow(10, intval($dog_arr[2])); 
      }
      else {
        $error = "You did not select 3 images for the dog layer. Please try again!";
      }
      
      $cat_arr = $_POST['cat'];
      if (count($cat_arr) == 3){
        $cat_arr = $_POST['cat'];
        $cat_layer = pow(10, intval($cat_arr[0])) + pow(10, intval($cat_arr[1])) + pow(10, intval($cat_arr[2])); 
      }
      else {
        $error = "You did not select 3 images for the cat layer. Please try again!";
      }

      $fish_arr = $_POST['fish'];
      if (count($fish_arr) == 3){
        $fish_arr = $_POST['fish'];
        $fish_layer = pow(10, intval($fish_arr[0])) + pow(10, intval($fish_arr[1])) + pow(10, intval($fish_arr[2])); 
      }
      else {
        $error = "You did not select 3 images for the fish layer. Please try again!";
      }

      // $dog_layer = '1 0 11 00000';
      // $cat_layer = '1 000 1 0 1 000';
      // $fish_layer = '11 00000 1 0000';

      if ($error == ""){
        try
        {
          $login = $account->login($_POST['user'], $_POST['pass'], $dog_layer, $cat_layer, $fish_layer);
          if (! $login){
            $error = "You have entered one of your images wrong or entered in an invalid userame/password. Please try again!";
          }
        }
        catch (Exception $e)
        {
          echo $e->getMessage();
          die();
        }
      }

			if ($login)
			{
        header('Location: ./vault/index.php');
			}
			else
			{
				$error = "<p class='error'>$error</p>";
			}
		}
	?>
<form id="regForm" method='POST'>

  <h1>Log into the Pet Vault:</h1>
  <?php echo $error; ?>
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  <!-- One "tab" for each step in the form: -->
  <br>
  <div class="tab">Select your three dogs!
    <ul>
    <li><input class='dog' name='dog[]' type="checkbox" id="cb0" value='0'/>
        <label for="cb0"><img src="img\dog\0.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb1" value='1'/>
        <label for="cb1"><img src="img\dog\1.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb2" value='2'/>
        <label for="cb2"><img src="img\dog\2.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb3" value='3'/>
        <label for="cb3"><img src="img\dog\3.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb4" value='4'/>
        <label for="cb4"><img src="img\dog\4.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb5" value='5'/>
        <label for="cb5"><img src="img\dog\5.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb6" value='6'/>
        <label for="cb6"><img src="img\dog\6.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb7" value='7'/>
        <label for="cb7"><img src="img\dog\7.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb8" value='8'/>
        <label for="cb8"><img src="img\dog\8.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb9" value='9'/>
        <label for="cb9"><img src="img\dog\9.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb10" value='10'/>
        <label for="cb10"><img src="img\dog\10.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb11" value='11'/>
        <label for="cb11"><img src="img\dog\11.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb12" value='12' />
        <label for="cb12"><img src="img\dog\12.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb13" value='13'/>
        <label for="cb13"><img src="img\dog\13.jpg" /></label>
      </li>
      <li><input class='dog' name='dog[]' type="checkbox" id="cb14" value='14'/>
        <label for="cb14"><img src="img\dog\14.jpg" /></label>
      </li>
    </ul>
  </div>
  <div class='tab'>Select your three cats!
  <ul>
    <li><input class='cat' name='cat[]' type="checkbox" id="cb15" value='0'/>
        <label for="cb15"><img src="img\cat\0.jpeg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb16" value='1'/>
        <label for="cb16"><img src="img\cat\1.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb17" value='2'/>
        <label for="cb17"><img src="img\cat\2.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb18" value='3' />
        <label for="cb18"><img src="img\cat\3.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb19" value='4' />
        <label for="cb19"><img src="img\cat\4.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb20" value='5'/>
        <label for="cb20"><img src="img\cat\5.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb21" value='6' />
        <label for="cb21"><img src="img\cat\6.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb22" value='7'/>
        <label for="cb22"><img src="img\cat\7.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb23" value='8'/>
        <label for="cb23"><img src="img\cat\8.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb24" value='9'/>
        <label for="cb24"><img src="img\cat\9.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb25" value='10' />
        <label for="cb25"><img src="img\cat\10.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb26" value='11'/>
        <label for="cb26"><img src="img\cat\11.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb27" value='12' />
        <label for="cb27"><img src="img\cat\12.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb28" value='13' />
        <label for="cb28"><img src="img\cat\13.jpg" /></label>
      </li>
      <li><input class='cat' name='cat[]' type="checkbox" id="cb29" value='14'/>
        <label for="cb29"><img src="img\cat\14.jpg" /></label>
      </li>
    </ul> 
  </div>
  <div class="tab">Select your three fish!  
  <ul>
    <li><input class='fish' name='fish[]' type="checkbox" id="cb30" value='0'/>
        <label for="cb30"><img src="img\fish\0.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb31" value='1'/>
        <label for="cb31"><img src="img\fish\1.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb32" value='2'/>
        <label for="cb32"><img src="img\fish\2.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb33" value='3'/>
        <label for="cb33"><img src="img\fish\3.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb34" value='4'/>
        <label for="cb34"><img src="img\fish\4.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb35" value='5'/>
        <label for="cb35"><img src="img\fish\5.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb36" value='6'/>
        <label for="cb36"><img src="img\fish\6.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb37" value='7' />
        <label for="cb37"><img src="img\fish\7.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb38" value='8'/>
        <label for="cb38"><img src="img\fish\8.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb39" value='9'/>
        <label for="cb39"><img src="img\fish\9.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb40" value='10'/>
        <label for="cb40"><img src="img\fish\10.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb41" value='11'/>
        <label for="cb41"><img src="img\fish\11.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb42" value='12'/>
        <label for="cb42"><img src="img\fish\12.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb43" value='13'/>
        <label for="cb43"><img src="img\fish\13.jpg" /></label>
      </li>
      <li><input class='fish' name='fish[]' type="checkbox" id="cb44" value='14'/>
        <label for="cb44"><img src="img\fish\14.jpg" /></label>
      </li>
    </ul> 
  </div>
  <div class="tab">Enter your login info:
    <p><input placeholder='username' name="user" oninput="this.className" type="text"></p>
    <p><input placeholder='password' name="pass" oninput="this.className" type="password"></p>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
  <h4>Don't have an account? <a href='create_account.php'>Click here</a> to create an account!</h4>
</form>

<script>

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input.dog");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}




// script 

</script>

</body>
</html>
