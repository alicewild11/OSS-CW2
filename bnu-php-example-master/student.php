<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   // check logged in
   if (isset($_SESSION['id']))
   {
     echo template("templates/partials/header.php");
     //display the navigation
     echo template("templates/partials/nav.php");


   $sql = "SELECT * from student";

   $result = mysqli_query($conn, $sql);

// prepare the table with the headings
   $data['content'] .= "<table border='1'>";
   $data['content'] .= "<tr><th colspan='5' align='center'>Student Record</th></tr>";
   $data['content'] .= "<tr><th>Student ID</th><th>DOB</th><th>First Name</th>";
   $data['content'] .= "<th>Last Name</th><th>Address</th></tr>";

// Display student details within the html table
   while($row = mysqli_fetch_array($result))
   {
      $data['content'] .= "<tr><td> $row[studentid] </td><td> $row[dob] </td>";
      $data['content'] .= "<td> $row[firstname] </td><td> $row[lastname] </td>";
      $data['content'] .= "<td> $row[house] $row[town] $row[county] $row[country] $row[postcode]</td></tr>";
   }
   $data['content'] .= "</table>";

   // render the template
   echo template("templates/default.php", $data);

  }
    else
    {
       header("Location: index.php");
    }

      echo template("templates/partials/footer.php");

?>
