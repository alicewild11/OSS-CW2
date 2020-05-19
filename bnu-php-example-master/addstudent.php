<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // check logged in
   if (isset($_SESSION['id']))
   {

     echo template("templates/partials/header.php");
     echo template("templates/partials/nav.php");

     // if the form has been submitted
     if (isset($_POST['submit']))
     {

        // build an sql statment to insert the student details into the table
        $stmt = $conn->prepare("INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode) VALUES (?,?,?,?,?,?,?,?,?,?)");
        //attach variables to the dummy values in the prepared template
        //s specifies that they will be a string value
        $stmt->bind_param("ssssssssss", $_POST['txtstudentid'], $_POST['txtpassword'], $_POST['txtdob'], $_POST['txtfirstname'],
        $_POST['txtlastname'], $_POST['txthouse'], $_POST['txttown'], $_POST['txtcounty'],$_POST['txtcountry'], $_POST['txtpostcode']);
        //runs the code
        $stmt->execute();
        $stmt->close();


        $data['content'] = "<p>Your details have been updated</p>";

     }
     else
     {

          // using <<<EOD notation to allow building of a multi-line string
          $data['content'] = <<<EOD
          <div>
          <h2>Add Student</h2>
          <form name="frmaddstudent" action="" method="post">
          <p>Student ID :</p>
          <input name="txtstudentid" type="text" /><br/>
          <p>Password :</p>
          <input name="txtpassword" type="password" /><br/>
          <p>Date of Birth :</p>
          <input name="txtdob" type="date"/><br/>
          <p>First Name :</p>
          <input name="txtfirstname" type="text"  /><br/>
          <p>Surname :</p>
          <input name="txtlastname" type="text"   /><br/>
          <p>Number and Street :</p>
          <input name="txthouse" type="text" /><br/>
          <p>Town :</p>
          <input name="txttown" type="text"   /><br/>
          <p>County :</p>
          <input name="txtcounty" type="text" /><br/>
          <p>Country :</p>
          <input name="txtcountry" type="text"   /><br/>
          <p>Postcode :</p>
          <input name="txtpostcode" type="text" /><br/>
          <input type="submit" value="Save" name="submit"/>
          </form>
          </div>
          EOD;

          // render the template
          echo template("templates/default.php", $data);

      }

    }
   else
   {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");


?>
