
$(document).ready(function () {
  $(".select2").select2();

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });

  if ($('#peramalanChart').length != 0) {
    /* ----------==========     Peramalan Chart initialization    ==========---------- */
    var label = $('#peramalanChart').data('label').split(",");
    var seriesAktual = $('#peramalanChart').data('series1').split(",").map(Number);
    var seriesPeramalan = $('#peramalanChart').data('series2').split(",").map(Number);
    // console.log($('#peramalanChart').data('label'))
    // console.log(seriesAktual)
    seriesPeramalan[0] = seriesAktual[0];
    dataPeramalanChart = {
      labels: label,
      series: [
        seriesAktual,
        seriesPeramalan
      ]
    };

    optionsPeramalanChart = {
      lineSmooth: Chartist.Interpolation.cardinal({
        tension: 0
      }),
      low: 0,
      high: 2000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
      height: 500,
      chartPadding: {
        top: 0,
        right: 0,
        bottom: 0,
        left: 0
      }
    }

    var peramalanChart = new Chartist.Line('#peramalanChart', dataPeramalanChart, optionsPeramalanChart);

    md.startAnimationForLineChart(peramalanChart);
  }
});