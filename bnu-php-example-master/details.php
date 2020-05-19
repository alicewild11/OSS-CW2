<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

     //$stmt = $conn->prepare ("UPDATE student set firstname = ? WHERE id = ?");
     //$stmt->bind_param("si", $_POST['txtfirstname'], $_SESSION['id']);
     //$stmt->execute();

     //$stmt->close();


      // build an sql statment to update the student details
      $sql = "UPDATE student set firstname ='" . $_POST['txtfirstname'] . "',";
      $sql .= "lastname ='" . $_POST['txtlastname']  . "',";
      $sql .= "house ='" . $_POST['txthouse']  . "',";
      $sql .= "town ='" . $_POST['txttown']  . "',";
      $sql .= "county ='" . $_POST['txtcounty']  . "',";
      $sql .= "country ='" . $_POST['txtcountry']  . "',";
      $sql .= "postcode ='" . $_POST['txtpostcode']  . "' ";
      $sql .= "where studentid = '" . $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);

      $data['content'] = "<p>Your details have been updated</p>";

   }
   else
   {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.


      $sql = "SELECT * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD
       <div>
       <h2>My Details</h2>
       <form name="frmdetails" action="" method="post">
       <p>First Name :<p>
       <input name="txtfirstname" type="text" value="{$row['firstname']}" /><br/>
       <p>Surname :<p>
       <input name="txtlastname" type="text"  value="{$row['lastname']}" /><br/>
       <p>Number and Street :<p>
       <input name="txthouse" type="text"  value="{$row['house']}" /><br/>
       <p>Town :<p>
       <input name="txttown" type="text"  value="{$row['town']}" /><br/>
       <p>County :<p>
       <input name="txtcounty" type="text"  value="{$row['county']}" /><br/>
       <p>Country :<p>
       <input name="txtcountry" type="text"  value="{$row['country']}" /><br/>
       <p>Postcode :<p>
       <input name="txtpostcode" type="text"  value="{$row['postcode']}" /><br/>
       <input type="submit" value="Save" name="submit"/>
       </form>
       </div>

       EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
