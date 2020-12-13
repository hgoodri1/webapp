<!--TASK 1: CREATE A CHART WIDGET -->
<div id="Chart2" class="widget">LOADING...</div>

<script type="text/javascript">
    //FOLLOW THE EXAMPLE CODE IN chart1.php TO CREATE YOUR OWN CHART WIDGET

    //Load the Google Charts Visualization API.
    google.charts.load('current', {'packages': ['corechart']});

    //Set the callback function to execute and draw the chart when the API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    //The callback function that creates and draws the chart.
    function drawChart() {
        //Create a chart DataTable.
        var data = new google.visualization.DataTable();

        //STEP 1: ADD COLUMNS TO THE CHART DATATABLE
        data.addColumn('string', 'Author_Name');
        data.addColumn('number', 'Count');

        //Add rows to the chart DataTable using PHP
        <?php
        require_once('login.php');

        $conn = new mysqli($hn, $un, $pw, $db);

        if ($conn->connect_error) die($conn->connect_error);

        //STEP 2: BUILD A QUERY
        $query = 'SELECT Author_Name, COUNT(*) AS Count FROM TBL_AUTHORS GROUP BY Author_Name;';

        $result = $conn->query($query);

        if(!$result) die($conn->error);

        //Fetch and process the results.
        while($row = $result->fetch_assoc()) {
            //STEP 3: ADD EACH ROW TO THE CHART DATATABLE
                echo('data.addRow(["' . $row['Author_Name'] . '", ' . $row['Count'] . ']);' . PHP_EOL);
        }

        $result->close();
        $conn->close();
        ?>

        //TO CUSTOMIZE YOUR CHART IN THE STEPS BELOW
        //REFER TO THE GOOGLE CHARTS DOCUMENTATION

        //STEP 4: SET CHART OPTIONS
        var options = {
            'title': 'Customers Favorite Authors',
            'width': 400,
            'height': 300};

        //STEP 5: DRAW THE CHART (CHANGE THE CHARTTYPE, THEN UNCOMMENT THE LINES BELOW)
        var chart = new google.visualization.PieChart(document.getElementById('Chart2'));
        chart.draw(data, options);
    }
</script>
