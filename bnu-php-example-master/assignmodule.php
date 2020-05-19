<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // If a module has been selected
   if (isset($_POST['selmodule'])) {

     // build an sql statment to insert the student details into the table
     $stmt = $conn->prepare("INSERT INTO studentmodules (studentid, modulecode) VALUES (?,?)");
     //attach variables to the dummy values in the prepared template
     //s specifies that they will be a string value
     $stmt->bind_param("ss", $_POST['studentid'], $_POST['modulecode']);
     //runs the code
     $stmt->execute();
     $stmt->close();

      $data['content'] .= "<p>The module " . $_POST['selmodule'] . " has been assigned to you</p>";
   }
   else  // If a module has not been selected
   {

     // Build sql statment that selects all the modules
     $sql = "select * from module";
     $result = mysqli_query($conn, $sql);

     $data['content'] .= "<form name='frmassignmodule' action='' method='post' >";
     $data['content'] .= "<h2>Select a Module to Assign</h2><br/>";
     $data['content'] .= "<select name='selmodule' >";
     // Display the module name sin a drop down selection box
     while($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<option value='$row[modulecode]'>$row[name]</option>";
     }
     $data['content'] .= "</select><br/>";
     $data['content'] .= "<input type='submit' name='confirm' value='Save' />";
     $data['content'] .= "</form>";
   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
