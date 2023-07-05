<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Line Chart</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<script>
    //note: to be revamped if a specific issue exist in displaying data where a data skips/misaligns on a month. Example: January total:100 February total:0 March total: 100.
    var monthlyData = <?php echo json_encode($monthly); ?>;
    // console.log(monthlyData);

    var month = [];
    var monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    var convertedMonth = [];
    var sales = [];
    monthlyData.forEach(function(data) {
        var date = new Date(data.Date_paid);
        var monthDate = date.getMonth();
        month.push(monthDate);
        sales.push(data.total);
    });

    month.forEach(function(m) {
        var cm = monthNames[m];
        convertedMonth.push(cm);
    });

    // console.log(convertedMonth);

    var areaChartData = {
        labels: //comment array below if convertedMonth[] is preferred
        // [
        //     "May",
        //     "June",
        //     "July",
        //     "August",
        //     "September",
        //     "October",
        //     "November",
        //     "December",
        // ]
        convertedMonth //uncomment if month is based on existing/fixed months
        ,
        datasets: [{
                label: "Sales",
                backgroundColor: "rgba(60,141,188,0.9)",
                borderColor: "rgba(60,141,188,0.8)",
                pointRadius: false,
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: sales,
            },
            // {
            //     label: 'Expenses',
            //     backgroundColor: 'rgba(210, 214, 222, 1)',
            //     borderColor: 'rgba(210, 214, 222, 1)',
            //     pointRadius: false,
            //     pointColor: 'rgba(210, 214, 222, 1)',
            //     pointStrokeColor: '#c1c7d1',
            //     pointHighlightFill: '#fff',
            //     pointHighlightStroke: 'rgba(220,220,220,1)',
            //     data: expenses
            // },
            // {
            //     label: 'Profit',
            //     backgroundColor: 'rgba(255, 114, 222, 1)',
            //     borderColor: 'rgba(255, 114, 222, 1)',
            //     pointRadius: false,
            //     pointColor: 'rgba(210, 214, 222, 1)',
            //     pointStrokeColor: '#c2c3d4',
            //     pointHighlightFill: '#fff',
            //     pointHighlightStroke: 'rgba(220,220,220,1)',
            //     data: profit
            // },
        ],
    };

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: true, //set to false if not needed
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: true, //set to false if not needed
                },
            }, ],
            yAxes: [{
                gridLines: {
                    display: true, //set to false if not needed
                },
            }, ],
        },
    };

    // This will get the first returned node in the jQuery collection.
    // new Chart(areaChartCanvas, {
    //   type: 'line',
    //   data: areaChartData,
    //   options: areaChartOptions
    // });

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChartOptions = $.extend(true, {}, areaChartOptions);
    var lineChartData = $.extend(true, {}, areaChartData);
    lineChartData.datasets[0].fill = false; //sales
    // lineChartData.datasets[1].fill = false; //expenses
    // lineChartData.datasets[2].fill = false; //profit
    lineChartOptions.datasetFill = false;

    var lineChart = new Chart(lineChartCanvas, {
        type: "line",
        data: lineChartData,
        options: lineChartOptions,
    });
    console.log("end");
</script>