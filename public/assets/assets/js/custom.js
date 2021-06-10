
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

  if ($('#laporanChart').length != 0) {
    /* ----------==========     Peramalan Chart initialization    ==========---------- */
    var label = $('#laporanChart').data('label').split(",");
    var qty = $('#laporanChart').data('series1').split(",").map(Number);
    // var nominal = $('#laporanChart').data('series2').split(",").map(Number);
    // console.log($('#peramalanChart').data('label'))
    // console.log(qty)
    dataLaporanChart = {
      labels: label,
      series: [
        qty,
        // nominal
      ]
    };

    optionsLaporanChart = {
      lineSmooth: Chartist.Interpolation.cardinal({
        tension: 0
      }),
      low: 0,
      high: 5000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
      height: 500,
      chartPadding: {
        top: 0,
        right: 0,
        bottom: 0,
        left: 0
      }
    }

    var laporanChart = new Chartist.Line('#laporanChart', dataLaporanChart, optionsLaporanChart);

    md.startAnimationForLineChart(laporanChart);
  }

  if ($('#laporanPemakaianSpChart').length != 0) {
    /* ----------==========     Peramalan Chart initialization    ==========---------- */
    var label = $('#laporanPemakaianSpChart').data('label').split(",");
    var qty = $('#laporanPemakaianSpChart').data('series1').split(",").map(Number);
    // var nominal = $('#laporanPemakaianSpChart').data('series2').split(",").map(Number);
    // console.log($('#peramalanChart').data('label'))
    // console.log(qty)
    dataLaporanChart = {
      labels: label,
      series: [
        qty,
        // nominal
      ]
    };

    optionsLaporanChart = {
      lineSmooth: Chartist.Interpolation.cardinal({
        tension: 0
      }),
      low: 0,
      high: 170000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
      height: 500,
      chartPadding: {
        top: 0,
        right: 0,
        bottom: 0,
        left: 0
      }
    }

    var laporanPemakaianSpChart = new Chartist.Line('#laporanPemakaianSpChart', dataLaporanChart, optionsLaporanChart);

    md.startAnimationForLineChart(laporanPemakaianSpChart);
  }

  if ($('#laporanProduksiChart').length != 0) {
    /* ----------==========     Peramalan Chart initialization    ==========---------- */
    var label = $('#laporanProduksiChart').data('label').split(",");
    var qty = $('#laporanProduksiChart').data('series1').split(",").map(Number);
    // var nominal = $('#laporanProduksiChart').data('series2').split(",").map(Number);
    // console.log($('#peramalanChart').data('label'))
    // console.log(qty)
    dataLaporanChart = {
      labels: label,
      series: [
        qty,
        // nominal
      ]
    };

    optionsLaporanChart = {
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

    var laporanProduksiChart = new Chartist.Line('#laporanProduksiChart', dataLaporanChart, optionsLaporanChart);

    md.startAnimationForLineChart(laporanProduksiChart);
  }

  if ($('#laporanPOChart').length != 0) {
    /* ----------==========     Peramalan Chart initialization    ==========---------- */
    var label = $('#laporanPOChart').data('label').split(",");
    var qty = $('#laporanPOChart').data('series1').split(",").map(Number);
    // var nominal = $('#laporanPOChart').data('series2').split(",").map(Number);
    // console.log($('#peramalanChart').data('label'))
    // console.log(qty)
    dataLaporanChart = {
      labels: label,
      series: [
        qty,
        // nominal
      ]
    };

    optionsLaporanChart = {
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

    var laporanPOChart = new Chartist.Line('#laporanPOChart', dataLaporanChart, optionsLaporanChart);

    md.startAnimationForLineChart(laporanPOChart);
  }
});