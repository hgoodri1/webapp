<?php include('header.php'); ?>

<h1>Publishers</h1>

<?php
//EXAMPLE ONLY, NOTHING TO EDIT ON THIS PAGE
//USE THIS PAGE AS A GUIDE TO DELETE, INSERT, AND RETRIEVE DATABASE RECORDS
require_once('login.php');

//connect to a database
$conn = new mysqli($hn, $un, $pw, $db);

//if the connection fails, exit and display an error
if ($conn->connect_error) die($conn->connect_error);

//TASK 1: DELETE A RECORD
if (isset($_POST['delete']) && isset($_POST['Publisher_ID'])) {

    //retrieve data from the request
    $publisherID = $_POST['Publisher_ID'];

    //build a delete query
    $query = "DELETE FROM TBL_PUBLISHERS WHERE Publisher_ID = '$publisherID';";

    //send the query to the database, and retrieve the result
    $result = $conn->query($query);

    //if the query fails, exit the script
    if (!$result) die($conn->error);

} else {
    //TASK 2: INSERT A NEW RECORD
    if (isset($_POST['Publisher_Name'])) {

        //retrieve data from the request
        $publisherName = $_POST['Publisher_Name'];

        //build an insert query
        $query = "INSERT INTO TBL_PUBLISHERS (Publisher_Name) VALUES ('$publisherName');";

        //send the query to the database, and retrieve the result
        $result = $conn->query($query);

        //if the query fails, exit the script
        if (!$result) die($conn->error);
    }
}
?>

<!--BEGIN: PUBLISHER FORM-->
<div id="PublisherForm">
    <form method="POST">
        <table>
            <tr>
                <td><label>Publisher Name</label></td>
                <td><input type="text" name="Publisher_Name" maxlength="250" required/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Add Publisher"/>
            </tr>
        </table>
    </form>
</div>
<!--END: PUBLISHER FORM-->

<hr/>

<!-- BEGIN: PUBLISHER LIST-->
<div id="PublisherList">
    <table>
        <thead>
            <tr>
                <th width="10%">ID</th>
                <th>Publisher Name</th>
                <th/>
            </tr>
        </thead>
        <tbody>
            <?php
            //TASK 3: RETRIEVE RECORDS

            //build a select query
            $query = 'SELECT * FROM TBL_PUBLISHERS ORDER BY Publisher_Name ASC;';

            //send the query to the database, and retrieve the result
            $result = $conn->query($query);

            //fetch and process the results
            $rowcount = $result->num_rows;

            for ($j = 0; $j < $rowcount; ++$j) {
                $result->data_seek($j);
                $row = $result->fetch_assoc();

                echo('<tr>');
                echo('  <td>' . $row['Publisher_ID'] . '</td>');
                echo('  <td>' . $row['Publisher_Name'] . '</td>');
                echo('  <td>');
                echo('      <form method="post">');
                echo('          <input type="hidden" name="delete" value="yes" />');
                echo('          <input type="hidden" name="Publisher_ID" value="' . $row['Publisher_ID'] . '" />');
                echo('          <input type="submit" value="Delete"/>');
                echo('      </form>');
                echo('  </td>');
                echo('</tr>');
            }

            //close the results
            $result->close();

            //close the connection
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
<!--END: PUBLISHER LIST-->

<?php include('footer.php'); ?>
