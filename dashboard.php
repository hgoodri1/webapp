<?php include('header.php'); ?>

<div id="AdminDashboard">
    <h1>Dashboard</h1>
    <div>
        <table>
            <tr>
                <td align="center">
                    <!-- FOLLOW THE CHART BELOW AS AN EXAMPLE-->
                    <?php include('widgets/chart-1.php'); ?>
                </td>
                <td align="center">
                    <!-- UNCOMMENT THE LINE BELOW TO ADD YOUR CHART-->
                    <?php include('widgets/chart-2.php'); ?>
                </td>
                <td align="center">
                    <!-- UNCOMMENT THE LINE BELOW TO ADD YOUR CHART-->
                    <?php include('widgets/chart-3.php'); ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <!--MODIFY THE GRID BELOW TO CUSTOMIZE THE DASHBOARD DISPLAY-->
                    <?php include('widgets/grid-1.php'); ?>
                </td>
            </tr>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>
