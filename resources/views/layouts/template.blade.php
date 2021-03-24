<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Forecasting | {{$title}}</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{ asset('assets/css/material-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('assets/demo/demo.css') }}" rel="stylesheet" />
  <link href="{{ asset('vendor/select2-develop/dist/css/select2.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
</head>

<body class="dark-edition">
  <div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="black" data-image="{{ asset('assets/img/sidebar-2.jpg') }}">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="{{ url('') }}" class="simple-text logo-normal">
          Forecasting
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item {{Request::segment(1) == 'dashboard' ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item {{Request::segment(1) == 'user' ? 'active' : ''}} ">
            <a class="nav-link" href="{{ url('user') }}">
              <i class="material-icons">person</i>
              <p>User</p>
            </a>
          </li>
          <li class="nav-item {{Request::segment(1) == 'pembelian-bahan-baku' || Request::segment(1) == 'bahan-baku' ? 'active' : ''}}">
            <a
              class="nav-link collapsed"
              href="#"
              data-toggle="collapse"
              data-target="#bahan-baku"
              aria-expanded="true"
              aria-controls="bahan-baku"
            >
            <i class="fas fa-fw fa-tree"></i>
              <span>Bahan Baku</span>
            </a>
            <div
              id="bahan-baku"
              class="collapse"
              aria-labelledby="headingTwo"
              data-parent="#accordionSidebar"
            >
              <div class="py-2 collapse-inner rounded ml-3">
                <a class="nav-link" href="{{url('pembelian-bahan-baku')}}">
                  <span>Pembelian</span>
                </a>
                <a class="nav-link" href="{{url('bahan-baku')}}">
                  <span>Pemakaian</span>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item {{Request::segment(1) == 'pembelian-sparepart' || Request::segment(1) == 'pemakaian-sparepart' ? 'active' : ''}}">
            <a
              class="nav-link collapsed"
              href="#"
              data-toggle="collapse"
              data-target="#bahan-penunjang"
              aria-expanded="true"
              aria-controls="bahan-penunjang"
            >
            <i class="fas fa-fw fa-tools"></i>
              <span>Bahan Penunjang</span>
            </a>
            <div
              id="bahan-penunjang"
              class="collapse"
              aria-labelledby="headingTwo"
              data-parent="#accordionSidebar"
            >
              <div class="py-2 collapse-inner rounded ml-3">
                <a class="nav-link" href="{{url('pembelian-sparepart')}}">
                  <span>Pembelian</span>
                </a>
                <a class="nav-link" href="{{url('pemakaian-sparepart')}}">
                  <span>Pemakaian</span>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item {{Request::segment(1) == 'hasil-produksi' || Request::segment(1) == 'pemakaian-barang-jadi' ? 'active' : ''}}">
            <a
              class="nav-link collapsed"
              href="#"
              data-toggle="collapse"
              data-target="#barang-jadi"
              aria-expanded="true"
              aria-controls="barang-jadi"
            >
            <i class="fas fa-fw fa-box"></i>
              <span>Barang Jadi</span>
            </a>
            <div
              id="barang-jadi"
              class="collapse"
              aria-labelledby="headingTwo"
              data-parent="#accordionSidebar"
            >
              <div class="py-2 collapse-inner rounded ml-3">
                <a class="nav-link" href="{{url('hasil-produksi')}}">
                  <span>Produksi</span>
                </a>
                <a class="nav-link" href="{{url('pemakaian-barang-jadi')}}">
                  <span>Pemakaian</span>
                </a>
              </div>
            </div>
          </li>      
          <li class="nav-item {{Request::segment(1) == 'purchase-order' ? 'active' : ''}} ">
            <a class="nav-link" href="{{ url('purchase-order') }}">
              <i class="material-icons">point_of_sale</i>
              <p>Purchase Order</p>
            </a>
          </li>
          <li class="nav-item {{Request::segment(1) == 'stock-opname' ? 'active' : ''}} ">
            <a class="nav-link" href="{{ url('stock-opname') }}">
              <i class="fas fa-fw fa-warehouse"></i>
              <p>Stock Opname</p>
            </a>
          </li>
          <li class="nav-item {{Request::segment(1) == 'peramalan-po' ? 'active' : ''}} ">
            <a class="nav-link" href="{{ url('peramalan-po') }}">
              <i class="fas fa-fw fa-chart-line"></i>
              <p>Peramalan</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
          <div class="navbar-wrapper">
              <a class="navbar-brand" href="javascript:void(0)">{{$pageTitle}}</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="javascript:void(0)">Ubah Password</a>
                  <div class="dropdown-divider"></div>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item" style="width: 93%">Logout</button>
                  </form>
                </div>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                  
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
              </li> --}}
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      @yield('content')
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            
          </nav>
          <div class="copyright float-right" id="date">
            , made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
        </div>
      </footer>
      <script>
        const x = new Date().getFullYear();
        let date = document.getElementById('date');
        date.innerHTML = '&copy; ' + x + date.innerHTML;
      </script>
    </div>
  </div>
  <div class="fixed-plugin mt-5">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Filters</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger active-color">
            <div class="badge-colors ml-auto mr-auto">
              <span class="badge filter badge-purple active" data-color="purple"></span>
              <span class="badge filter badge-azure" data-color="azure"></span>
              <span class="badge filter badge-green" data-color="green"></span>
              <span class="badge filter badge-warning" data-color="orange"></span>
              <span class="badge filter badge-danger" data-color="danger"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="header-title">Images</li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="{{ asset('assets/img/sidebar-1.jpg') }}" alt="">
          </a>
        </li>
        <li class="active">
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="{{ asset('assets/img/sidebar-2.jpg') }}" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="{{ asset('assets/img/sidebar-3.jpg') }}" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="{{ asset('assets/img/sidebar-4.jpg') }}" alt="">
          </a>
        </li>
        
        <li class="button-container text-center">
          {{-- <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45</button>
          <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50</button> --}}
          <br>
        </li>
      </ul>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap-material-design.min.js') }}"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  
  <!-- Chartist JS -->
  {{-- <script src="{{ asset('assets/js/plugins/chartist.min.js') }}"></script> --}}
  {{-- <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script> --}}
  <script src="{{ asset('assets/js/plugins/chartist.min.js') }}"></script>
  {{-- <script src="/bower_components/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.js"></script> --}}
  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/material-dashboard.js?v=2.1.0') }}"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('assets/demo/demo.js') }}"></script>
  <script src="{{ asset('vendor/select2-develop/dist/js/select2.min.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
</body>

</html>