var load_summ = (x) => {
  $(document).gmLoadPage({
    url: "report/load_summ",
     // BAGO NI SA
     data: {
      Branch: x,
     },
    load_on: "#report-summary",
  });
};

var load_items = (x) => {
  $(document).gmLoadPage({
    url: "report/load_items",
    // BAGO NI SA
    data: {
      Branch: x,
     },
    load_on: "#list-items",
  });
};

var load_top_items = () => {
  $(document).gmLoadPage({
    url: "report/load_top_items",
    load_on: "#toplist-items",
  });
};

var load_daily_sales = () => {
  $(document).gmLoadPage({
    url: "report/load_daily_sales",
    load_on: "#load_daily_sales",
  });
};

$(document).ready(function () {
  load_summ();
  load_items();
  load_daily_sales();
});

// BAGO NI SA
$(document).on('change', '#Branch', function() {
  var branch = $(this).val();
  load_summ(branch);
  load_items(branch);
  load_daily_sales(branch);
});

$(document).on('click', '#submit_date', function() {
  console.log($('#d_from').val() + " "+ $('#d_to').val());
  $(document).gmLoadPage({
      url: "report/load_daily_sales",
      data: {
          d_from: $('#d_from').val(),
          d_to: $('#d_to').val(),
          branch: $('#branch_filter').val() //BAGO NI SA
      },
      load_on: "#load_daily_sales",
  })

});

//onchange trigger on year
$(document).on("change", "#sales-year", function () {
  $(document).gmLoadPage({
    url: "report/service/report_service/report_summ",
    data: {
      report_year: $("#sales-year").val(),
    },
    load_on: "#report-summary",
    // load_on: 'index'
  });
//   load_chart();
});

function load_chart() {
  // console.log("fun 3grd");

  // var expenses = [];
  // var profit = [];

  // var sales = [];

  // $('[data-sales]').each(function() {
  //     var salesValue = $(this).data('sales');
  //     console.log(salesValue);
  //     sales.push(salesValue);
  // });

  console.log("da sales:"+sales);

  // $('[data-expenses]').each(function() {
  //     var expenseVal = $(this).data('sales');
  //     // console.log(salesValue);
  //     expenses.push(expenseVal);

  // });

  // $('[data-profit]').each(function() {
  //     var profitVal = $(this).data('sales');
  //     // console.log(salesValue);
  //     sales.push(profitVal);

  // });

  // 'January', 'February', 'March', 'April', add to labels array if january data is filled to avoid mismatch of records and display in chart

  var areaChartData = {
    labels: [
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ],
    datasets: [
      {
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
      xAxes: [
        {
          gridLines: {
            display: true, //set to false if not needed
          },
        },
      ],
      yAxes: [
        {
          gridLines: {
            display: true, //set to false if not needed
          },
        },
      ],
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
}

$(document).on('click', '.btn_void', function() {

  if (confirm("Are you sure you want to void this payment?") == true) {
    $.post({
      url: 'service/Report_service/void',
      data: {
          Payment_ID: $(this).val(),
      },
      success: function(e) {
          var e = JSON.parse(e);
          if (e.has_error == false) {
              toastr.success(e.message);
             
          } else {
              toastr.error(e.message);
          }
      },
  })
  } else {
    return;
  }
//   setTimeout(function() {
//     window.location.reload();
// }, 2000);
});

$(document).on('click', '.btn_veri', function() {

  if (confirm("Are you sure you want to verify this payment?") == true) {
    $.post({
      url: 'service/Report_service/verify',
      data: {
          Payment_ID: $(this).val(),
      },
      success: function(e) {
          var e = JSON.parse(e);
          if (e.has_error == false) {
              toastr.success(e.message);
             
          } else {
              toastr.error(e.message);
          }
      },
  })
  } else {
    return;
  }
//   setTimeout(function() {
//     window.location.reload();
// }, 2000);
});