// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

$(window).on('load', function () {
  $.get("/Minrose/home/penjualan", function (response) {

    // buat data
    var response_length = response["data"].length;

    var begin = new Date(response["one_week_ago"]);
    var end = new Date(response["now"]);

    weekly_sale_date = []; //tanggal penjualan
    weekly_sale_data = []; // banyaknya penjualan
    var day_iterate = new Date(begin);

    while (day_iterate <= end) {
      is_get = false;
      let date = day_iterate.getDate();

      for (let i = 0; i < response_length; i++) {
        if (date == response["data"][i]['tanggal']) {
          weekly_sale_data.push(parseInt(response["data"][i]['total_penjualan']));
          is_get = true;
        }
      }

      let month = day_iterate.toLocaleString("default", { month: "short" });
      weekly_sale_date.push(`${month} ${date}`);

      if (!is_get) {
        weekly_sale_data.push(0);
      }

      var newDate = day_iterate.setDate(day_iterate.getDate() + 1);
      day_iterate = new Date(newDate);
    }

    var ctx = document.getElementById("Chart-Penjualan");
    new Chart(ctx, {
      type: "line",
      data: {
        labels: weekly_sale_date,
        datasets: [
          {
            label: "kuantitas",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: weekly_sale_data,
          },
        ],
      },
      options: {
        scales: {
          xAxes: [
            {
              time: {
                unit: "date",
              },
              gridLines: {
                display: false,
              },
              ticks: {
                maxTicksLimit: 7,
              },
            },
          ],
          yAxes: [
            {
              ticks: {
                min: 0,
                max: Math.max.apply(Math, weekly_sale_data) * 1.2,
                maxTicksLimit: 5,
              },
              gridLines: {
                color: "rgba(0, 0, 0, .125)",
              },
            },
          ],
        },
        legend: {
          display: false,
        },
      },
    });

  });
});


