<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
            Bar Chart
        </h3>
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
        <div id="bar-chart" style="height: 400px;"></div>
    </div>
    <!-- /.card-body-->
</div>

<script>
    var itemarr = <?php echo json_encode($ilist); ?>;

    var itemdata = [];
    var listdata = [];

    var x = 0;
    itemarr.forEach(function(data) {
        itemdata.push([x + 1, data.Quantity]);
        listdata.push([x + 1,data.item_name]);
        x++;
    });

    console.log(itemdata);
    console.log(listdata);

    var bar_data = {
        data:
            // [
            //     [1, 10],
            //     [2, 8],
            //     [3, 4],
            //     [4, 13],
            //     [5, 17],
            //     [6, 9]
            // ]
            itemdata,
        bars: {
            show: true,
            barWidth: 0.5,
        }
    }
    $.plot('#bar-chart', [bar_data], {
        grid: {
            borderWidth: 1,
            borderColor: '#f3f3f3',
            tickColor: '#f3f3f3'
        },
        series: {
            bars: {
                show: true,
                barWidth: 0.5,
                align: 'center',
            },
        },
        colors: ['#3c8dbc'],
        xaxis: {
            ticks:
                // [[1, 'January'],]
                listdata,
            font: {
                size: 12
            }
        }
    })

    // var bar_data = {
    //     data: itemdata,
    //     bars: {
    //         show: true,
    //         horizontal: true // Set horizontal option to true
    //     }
    // };

    // $.plot('#bar-chart', [bar_data], {
    //     grid: {
    //         borderWidth: 1,
    //         borderColor: '#f3f3f3',
    //         tickColor: '#f3f3f3'
    //     },
    //     series: {
    //         bars: {
    //             show: true,
    //             barWidth: 0.5,
    //             align: 'center',
    //         }
    //     },
    //     colors: ['#3c8dbc'],
    //     yaxis: {
    //         ticks: listdata,
    //         font: {
    //             size: 10
    //         }
    //     }
    // });
</script>