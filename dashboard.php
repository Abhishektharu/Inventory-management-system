<?php
// start the session.
session_start();

if (!isset($_SESSION['user'])) header('Location: homepage.php');
$user = $_SESSION['user'];
include('database/product_order_status_pie.php');
//show the barchart of supplier ;

include('database/supplier_bar_chart.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="shortcut icon" type="x-icon" href="Vector.svg">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/user_add2.css">
    <style>
        .wrapper .section .main_container {
            margin: 30px;
            background: #fff;
            padding: 50px;
            line-height: 28px;
            color: green;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!--Top menu -->
        <div class="section">
            <?php
            include('partials/top_nav.php');
            ?>


            <!-- container main -->
            <div class="main_container">
                <div class="dashboard_content_main">
                    <div class="charts">


                        <div class="dashColumn">

                            <figure class="highcharts-figure">
                                <div id="container"></div>
                                <p class="highcharts-description">
                                    This pie chart shows the current status of products that have been ordered.
                                    This includes the products that have been pending , incomplete to deliver or the delivery is completed.
                                </p>
                            </figure>
                        </div>

                        <div class="dashColumn">

                            <figure class="highcharts-figure">
                                <div id="containerBarChart"></div>
                                <p class="highcharts-description">
                                    A basic column chart comparing estimated corn and wheat production
                                    in some countries.

                                    The chart is making use of the axis crosshair feature, to highlight
                                    the hovered country.
                                </p>
                            </figure>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include('partials/app_sidebar.php');
        ?>
    </div>

    <script src="js/script.js"></script>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        var graphData = <?= json_encode($results) ?>;


        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Purchase Orders by Status',
                align: 'left'
            },
            tooltip: {
                pointFormatter: function() {
                    var point = this,
                        series = point.series;

                    return `<b>${point.name}</b>: <b>${point.y}</b>`
                }

            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.2f} %'
                    }
                }
            },
            series: [{
                name: 'Status',
                colorByPoint: true,
                data: graphData
            }]
        });





        var barGraphData = <?= json_encode($bar_chart_data) ?>;
        var barGraphCategories = <?= json_encode($categories) ?>;

        // console.log(barGraphCategories, barGraphData)

        Highcharts.chart('containerBarChart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Supplier Information ',
                align: 'left'
            },
            xAxis: {
                categories: barGraphCategories,
                crosshair: true,
                accessibility: {
                    description: 'Suppliers'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Supplier Count'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormatter: function() {
                    var point = this,
                        series = point.series;

                    return `<b>${point.category}</b>: <b>${point.y}</b>`
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Supplier',
                data: barGraphData
            }]
        });
    </script>
</body>

</html>