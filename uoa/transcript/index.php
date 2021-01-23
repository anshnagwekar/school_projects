<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Upload transcript to your application. -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Transcript Submission</title>
    <style>
        body {
        margin: 0;
        }

        ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 10%;
        background-color: #f1f1f1;
        position: fixed;
        height: 100%;
        overflow: auto;
        }

        li a {
        display: block;
        color: #000;
        padding: 8px 16px;
        text-decoration: none;
        }

        li a.active {
        background-color: #4b389e;
        color: white;
        }

        li a:hover:not(.active) {
        background-color: #555;
        color: white;
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
        p.error
        {
            font-weight: bold;
            color: #4b389e;
        }
        b {
            color: #4b389e;  
        }
        span {
            color: gray;
        }
    </style>
</head>
<body>
    <div class="center">
        <h1>University of Ansh Transcript Upload</h1>
        <form method="post" action='submitted.php' id='trascript' name='transcript' enctype="multipart/form-data" onsubmit='return validFile()'>
            <input type="hidden" name="MAX_FILE_SIZE" />
            <p><label for="name"><b>Select file (only pdf accepted)</b></label><br />
            <input type="file" name="file" id="file" required/></p>
            <label for="app_id"><b>App Id of Applicant</b></label>
            <br>
            <input type="number" name="app_id" id="app_id" placeholder="202000" required/>
            <span class="hint">Hint: Please ask your student for his App Id.</span>
            <br><br>
            <input type="submit" name="submit" value="Start upload" />
        </form>   
        <br>
    </div>  
</body>
<script>
    function validFile() {
        var fileName = document.forms['transcript']['file'].value;
        fileType = fileName.substring(fileName.length - 3, fileName.length);

        if(fileType == 'pdf'){
            return true;
        }
        else {
            alert('Please select a valid file type! (pdf)')
        }

        return false;
    }
</script>
</html>