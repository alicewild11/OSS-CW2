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
        $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
        VALUES ('" . $_POST['txtstudentid'] . " ', '" . $_POST['txtpassword'] . " ', '" . $_POST['txtdob'] . " ',
          '" . $_POST['txtfirstname'] . " ','" . $_POST['txtlastname'] . " ', '" . $_POST['txthouse'] . " ','" . $_POST['txttown'] . " ',
          '" . $_POST['txtcounty'] . " ', '" . $_POST['txtcountry'] . " ', '" . $_POST['txtpostcode'] . " ');";
        $result = mysqli_query($conn,$sql);

        echo $sql;

        $data['content'] = "<p>Your details have been updated</p>";

     }
     else
     {

          // using <<<EOD notation to allow building of a multi-line string
          $data['content'] = <<<EOD

          <h2>Add Student</h2>
          <form name="frmaddstudent" action="" method="post">
          Student ID :
          <input name="txtstudentid" type="text" /><br/>
          Password :
          <input name="txtpassword" type="password" /><br/>
          Date of Birth :
          <input name="txtdob" type="date"/><br/>
          First Name :
          <input name="txtfirstname" type="text"  /><br/>
          Surname :
          <input name="txtlastname" type="text"   /><br/>
          Number and Street :
          <input name="txthouse" type="text" /><br/>
          Town :
          <input name="txttown" type="text"   /><br/>
          County :
          <input name="txtcounty" type="text" /><br/>
          Country :
          <input name="txtcountry" type="text"   /><br/>
          Postcode :
          <input name="txtpostcode" type="text" /><br/>
          <input type="submit" value="Save" name="submit"/>
          </form>

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
