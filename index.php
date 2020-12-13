<?php include('header.php'); ?>

<div id="AdminHomepage">
    <table>
        <thead>
            <tr>
                <th colspan="2">
                    Admin Report
                </th>
            </tr>
        </thead>
        <tr>
            <td>
                <?php
                echo('Welcome, Admin!');
                ?>
            </td>
            <td align="right">
                <?php
                echo('Today is ' . date("l, F j, Y h:t A"));
                ?>
            </td>
        </tr>
    </table>
    </br>
    <table>
        <thead>
            <tr>
                <th colspan="4">
                    Recent Orders
                </th>
            </tr>
            <tr>
                <th>
                    Order #
                </th>
                <th>
                    Order Date
                </th>
                <th>
                    Customer
                </th>
                <th>
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once('login.php');

            //FOLLOW THE INSTRUCTIONS BELOW AND ADD THE MISSING LINES
            //TO CONNECT TO THE DATABASE AND RETURN A REPORT

            //STEP 1: CONNECT TO THE DATABASE
            $conn = new mysqli($hn, $un, $pw, $db);


            //STEP 2: IF THE CONNECTION FAILS, EXIT AND DISPLAY AN ERROR
    if ($conn->connect_error) die($conn->connect_error);
            //BUILD A QUERY
            $query = 'SELECT '
                    . '     TBL_ORDERS.Order_ID, '
                    . '     TBL_ORDERS.Order_Date, '
                    . '     TBL_CUSTOMERS.First_Name, '
                    . '     TBL_CUSTOMERS.Last_Name, '
                    . '     SUM(Price * Quantity) AS "Total"'
                    . ' FROM TBL_ORDERS'
                    . '     JOIN TBL_CUSTOMERS ON TBL_ORDERS.Customer_ID = TBL_CUSTOMERS.Customer_ID'
                    . '     JOIN TBL_ORDER_ITEMS ON TBL_ORDER_ITEMS.Order_ID = TBL_ORDERS.Order_ID'
                    . ' GROUP BY TBL_ORDERS.Order_ID '
                    . ' ORDER BY TBL_ORDERS.Order_Date DESC;';

            //STEP 3: SEND THE QUERY TO THE DATABASE AND RETRIEVE THE RESULT
            $result = $conn->query($query);

            //STEP 4: IF THE QUERY FAILS, EXIT THE SCRIPT
            if(!$result) die($conn->error);
            //STEP 5: FETCH AND PROCESS THE RESULTS
            $rowcount = $result->num_rows;
            for ($j = 0; $j <$rowcount; ++$j) {
              $result->data_seek($j);
              $row = $result->fetch_assoc();

              echo('<tr>');
              echo('  <td>' .$row['Order_ID'] . '</td>');
              echo('  <td>' .$row['Order_Date'] . '</td>');
              echo('  <td>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</td>');
              echo('  <td>' .$row['Total'] . '</td>');
              echo('</tr>');

            };

            //STEP 6: CLOSE THE RESULTS

            $result->close();

            //STEP 7: DISCONNECT FROM THE DATABASE
$conn->close();
            ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>
