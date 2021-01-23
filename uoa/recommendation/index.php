
<!DOCTYPE html>
<!-- Submit Reccomendation Here -->
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Recommendation Form</title>
    <style>
        .no_show{
            list-style-type: none;
        }
        .application ul {
            width:700px;
            list-style-position:outside;
            list-style-type: none;
            margin:5px;
            padding:5px;
        }
        .application ul li p{
            display:inline;
        }
        .option_in_form {
            padding:12px; 
            border-top:1px solid lightgray;
            position:relative;
        }
        .first_item {
            padding:12px; 
            border-top:2px solid black;
            position:relative;
        }
        .last_item{
            padding:12px; 
            border-top:1px solid lightgray;
            border-bottom:2px solid black;
            position:relative;
        }
        .only_item {
            padding:12px; 
            border-top:2px solid black;
            border-bottom:2px solid black;
            position:relative;
        }
        span {
            color:gray;
        }
        #submit_button {
            background-color: #4b389e;
            border: 1px solid gray;
            border-bottom: 1px solid #4b389e;;
            color: white;
            font-weight: bold;
            padding: 6px 20px;
            text-align: center;
            text-shadow: 0 -1px 0 #4b389e;
        }
        #submit_button:hover {
            opacity:.85;
            cursor: pointer; 
        }
        #submit_button:active {
            border: 1px solid #4b389e;
            box-shadow: 0 0 10px 5px #4b389e inset;
        }
        #profile{
            width: 200px;
        }
        .required_field {
            color:#d41e1e; 
            margin:5px 0 0 0; 
        }
        .required_asterisk{
            display: inline;
            color:#d41e1e; 
        }

        input[id='SAT'] {
            visibility:hidden;
        }

        input[id='ACT'] {
            visibility:hidden;
        }

        input[id='yesACT']:checked + input[id='ACT'] {
            visibility:visible;
        }

        input[id='yesSAT']:checked + input[id='SAT'] {
            visibility:visible;
        }
        h1 {
            color: #4b389e;
        }
        .center {
			margin-left:10%;
			margin-right:10%;
            padding:1px 16px;
			border: 1px solid #4b389e;
        }

    </style>
</head>

<body>
    <div class='center'>
    <h1>University of Ansh Official Teacher Recommendation Upload</h1>
    <h3></h3>
    <h3>Please ask your student for his/her "Application ID" so we can match your recommendation with his/her application.</h3>
    <h3>All text fields will accept 250 words at maximum and 150 words at minimum.</h3>
    <span class="required_field">* Denotes Required Field</span>
    <form method="post" action="submitted.php" id = "application" name='application' class='application' onsubmit='return valid()'>
        <ul>
            <h4>Recommender Info</h4>  
            <li class="first_item">
                <p class='required_asterisk'>*</p>
                <label for="title"> Recommender's Title</label>
                <input type="text" name="title" id="title" placeholder="Mr." required/>
                <span class="hint">Hint: Mr., Mrs., Dr., etc.</span>
            </li>
            <li class="option_in_form">
                <p class='required_asterisk'>*</p>
                <label for="name"> Recommender's Name:</label>
                <input type="text" name="name" id="name" placeholder="Cool Jeans" required/>
            </li>
            <li class="option_in_form">
                <p class='required_asterisk'>*</p>
                <label for="email"> Recommender's Email:</label>
                <input type="email" name="email" id='email' placeholder="cool.jeaans@bcp.org" required/>
                <span class="hint">Hint: "username@account.org"</span>
            </li>
            <li class="option_in_form">
                <p class='required_asterisk'>*</p>
                <label for="position"> Recommender's Position</label>
                <input type="text" name="position" id="position" placeholder="Math Teacher at Bellarmine College Preparatory" required/>
                <span class="hint">Hint: "Job" at "Employer"</span>
            </li>
            <li class="last_item">
                <p class='required_asterisk'>*</p>
                <label for="app_id"> App Id For Reccomendation</label>
                <input type="number" name="app_id" id="app_id" placeholder="202000" required/>
                <span class="hint">Hint: Please ask your student for his App Id.</span>
            </li>
        </ul>

        <ul>
            <h4>Performance</h4>  
            <li class="first_item">
                <p class='required_asterisk'>*</p> 
                <label for="perform_text"> Describe his perfomance in the classroom. What does he bring to the class?</label>
                <textarea form='application' name='perform_text' rows="5" cols="75" id='perform_text'></textarea>
            </li>  
            <li class="last_item">
                <p class='required_asterisk'>*</p> 
                <label for="perform_percentile"> Performance Percentile (relative to his/her peers):</label>
                <select name="perform_percentile" id="perform_percentile">
                    <option value="1">1%</option>
                    <option value="5">5%</option>
                    <option value="25">25%</option>
                    <option value="50">50%</option>
                    <option value="100">100%</option>
                </select>
            </li> 
        </ul>

        <ul>
            <h4>Collaboration</h4>  
            <li class="first_item">
                <p class='required_asterisk'>*</p> 
                <label for="collab_text"> Describe his collaboration in the classroom. How does he contribute to discussions?</label>
                <textarea form='application' name='collab_text' rows="5" cols="75" id='collab_text'></textarea>
            </li>  
            <li class="last_item">
                <p class='required_asterisk'>*</p> 
                <label for="collab_percentile"> Collaboration Percentile (relative to his/her peers):</label>
                <select name="collab_percentile" id="collab_percentile">
                    <option value="1">1%</option>
                    <option value="5">5%</option>
                    <option value="25">25%</option>
                    <option value="50">50%</option>
                    <option value="100">100%</option>
                </select>
            </li> 
        </ul>
        
        <ul>
            <h4>Potential</h4>  
            <li class="first_item">
                <p class='required_asterisk'>*</p> 
                <label for="potential_text"> Describe his potential beyond the classroom. How successful will he be in a university environment?</label>
                <textarea form='application' name='potential_text' rows="5" cols="75" id='potential_text'></textarea>
            </li>  
            <li class="last_item">
                <p class='required_asterisk'>*</p> 
                <label for="potential_percentile"> Potential Percentile (relative to his/her peers):</label>
                <select name="potential_percentile" id="potential_percentile">
                    <option value="1">1%</option>
                    <option value="5">5%</option>
                    <option value="25">25%</option>
                    <option value="50">50%</option>
                    <option value="100">100%</option>
                </select>
            </li> 
        </ul>

        <ul>
            <h4>Additional Info</h4>
            <li class="only_item">
                <label for="final_words">Please enter in any additional info not found elsewhere in the recommendation. Any final words?</label>
                <textarea form='application' name='final_words' rows="5" cols="75" id="final_words"></textarea>
            </li>
            <li class="option_in_form"> 
                <input id='submit_button' type="submit" name="Submit" value="Enter" />
            </li>
        </ul>



    </form>
    </div>
</body>
<script>
        function valid() 
        {
            vals = document.forms['application']['position'].value;
            if (vals.includes(" at ") == false) {
                alert("Please enter in a valid expression for Position");
                return false;
            }

            vals = document.forms['application']['perform_text'].value;
            nums = vals.split(" ");
            if (nums.length < 150 || nums.length > 250){
                alert("Word count is not in the range of Performance prompt. Current word count: " + nums.length);
                return false;
            }

            vals = document.forms['application']['collab_text'].value;
            nums = vals.split(" ");
            if (nums.length < 150 || nums.length > 250){
                alert("Word count is not in the range of Collaboration prompt. Current word count: "  + nums.length);
                return false;
            }

            vals = document.forms['application']['potential_text'].value;
            nums = vals.split(" ");
            if (nums.length < 150 || nums.length > 250){
                alert("Word count is not in the range of Potential prompt. Current word count: "  + nums.length);
                return false;
            }

            vals = document.forms['application']['final_words'].value;
            nums = vals.split(" ");
            if (nums.length > 250){
                alert("Word count is over 250 words for the Final Words prompt. Current word count: "  + nums.length);
                return false;
            }

            return true;
        
        }
    </script>
</html>
