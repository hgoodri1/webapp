<?php include('header.php'); ?>

<h1>Authors</h1>

<?php
//FOLLOW PUBLISHERS.PHP AS AN EXAMPLE
//MODIFY THIS PAGE TO DELETE, INSERT, AND RETRIEVE DATABASE RECORDS
require_once('login.php');

//connect to a database
$conn = new mysqli($hn, $un, $pw, $db);

//if the connection fails, exit and display an error
if ($conn->connect_error) die($conn->connect_error);

//TASK 1: DELETE A RECORD
if (isset($_POST['delete']) && isset($_POST['Author_ID'])) {

    //STEP 1: RETRIEVE DATA FROM THE REQUEST
$authorID = $_POST['Author_ID'];
    //STEP 2: BUILD A DELETE QUERY
    $query = "DELETE FROM TBL_AUTHORS WHERE AUTHOR_ID = '$authorID';";

    //send the query to the database, and retrieve the result
    $result = $conn->query($query);

    //if the query fails, exit the script
    if (!$result) die($conn->error);

} else {
    //TASK 2: INSERT A NEW RECORD
    if (isset($_POST['Author_Name'])) {

        //STEP 1: RETRIEVE DATA FROM THE REQUEST
$authorName = $_POST['Author_Name'];
        //STEP 2: BUILD AN INSERT QUERY
        $query = "INSERT INTO TBL_BOOKS (Author_Name) VALUES ('$authorName');";

        //send the query to the database, and retrieve the result
        $result = $conn->query($query);

        //if the query fails, exit the script
        if (!$result) die($conn->error);
    }
}
?>

<!--BEGIN: AUTHOR FORM-->
<div id="AuthorForm">
    <form method="POST">
        <table>
            <tr>
                <td><label>Author Name</label></td>
                <td><input type="text" name="Author_Name" maxlength="250" required/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Insert Author"/>
            </tr>
        </table>
    </form>
</div>
<!--END: AUTHOR FORM-->

<hr/>

<!-- BEGIN: AUTHOR LIST-->
<div id="AuthorList">
    <table>
        <thead>
            <tr>
                <th width="10%">ID</th>
                <th>Author Name</th>
                <th/>
            </tr>
        </thead>
        <tbody>
            <?php
            //TASK 3: RETRIEVE RECORDS

            //STEP 1: BUILD A SELECT QUERY
            $query = "SELECT * FROM TBL_AUTHORS ORDER BY Author_Name ASC;";

            //send the query to the database, and retrieve the result
            $result = $conn->query($query);

            //fetch and process the results
            $rowcount = $result->num_rows;

            for ($j = 0; $j < $rowcount; ++$j) {
                $result->data_seek($j);
                $row = $result->fetch_assoc();

                echo('<tr>');
                echo('  <td>' . $row['Author_ID'] . '</td>');
                echo('  <td>' . $row['Author_Name'] . '</td>');
                echo('  <td>');
                echo('      <form method="post">');
                echo('          <input type="hidden" name="delete" value="yes" />');
                echo('          <input type="hidden" name="Author_ID" value="' . $row['Author_ID'] . '" />');
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
<!--END: AUTHOR LIST-->

<?php include('footer.php'); ?>
