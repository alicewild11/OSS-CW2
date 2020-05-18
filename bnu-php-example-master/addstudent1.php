<?php
      include("_includes/config.inc");
      include("_includes/dbconnect.inc");
      include("_includes/functions.inc");

      echo template("templates/partials/header.php");
      //display the navigation
      echo template("templates/partials/nav.php");

      // build an sql statment to update the student details
      $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)";
      $sql = $sql . " VALUES ('$_POST[txtstudentid]', '$_POST[txtpassword]', '$_POST[txtdob]', '$_POST[txtfirstname]', '$_POST[txtlastname]',
      '$_POST[txthouse]', '$_POST[txttown]', '$_POST[txtcounty]', '$_POST[txtcountry]', '$_POST[txtpostcode]')";

      $result = mysqli_query($conn,$sql);



 ?>
