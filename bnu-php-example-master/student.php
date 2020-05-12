<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   //testing what i am getting through post
   //echo"<pre>";
   //print_r($_POST);
   //echo"</pre>";

   if(!empty($_POST['delete']))
   {
     foreach($_POST['delete'] as $student_id => $value)
     {
       //delete a record
       $sql = "DELETE FROM student WHERE studentid = $student_id";

       $result = mysqli_query($conn, $sql);

     }
   }

   // check logged in
   if (isset($_SESSION['id']))
   {
     echo template("templates/partials/header.php");
     //display the navigation
     echo template("templates/partials/nav.php");


   $sql = "SELECT * from student";

   $result = mysqli_query($conn, $sql);

   //wrap table within form which submits when the 'Delete' button is pressed
   $data['content'] .= "<form method='POST' action=''>";

// prepare the table with the headings
   $data['content'] .= "<table border='1'>";
   $data['content'] .= "<tr><th colspan='6' align='center'>Student Record</th></tr>";
   $data['content'] .= "<tr><th>Student ID</th><th>DOB</th><th>First Name</th>";
   $data['content'] .= "<th>Last Name</th><th>Address</th><th>Delete</th></tr>";

// Display student details within the html table
   while($row = mysqli_fetch_array($result))
   {
      $data['content'] .= "<tr><td> $row[studentid] </td><td> $row[dob] </td>";
      $data['content'] .= "<td> $row[firstname] </td><td> $row[lastname] </td>";
      $data['content'] .= "<td> $row[house] $row[town] $row[county] $row[country] $row[postcode]</td>";
      //adding a check box
      $data['content'] .= "<td><input type='checkbox' name='delete[$row[studentid]]'</td></tr>";
   }
   $data['content'] .= "</table>"; //closing html table
   //adding delete button
   $data['content'] .= "<input type='submit' value='Delete'/>";

   //closes form
   $data['content'] .= "</form>";

   // render the template
   echo template("templates/default.php", $data);

  }
    else
    {
       header("Location: index.php");
    }

      echo template("templates/partials/footer.php");

?>
