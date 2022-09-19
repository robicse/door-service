 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="x-ua-compatible" content="ie=edge">

     <title>@yield('title') | Doorservice </title>
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- Font Awesome Icons -->
     <link rel="stylesheet" href="{{ asset('backend/plugins/font-awesome/css/font-awesome.min.css') }}">
     <!-- Theme style -->
     <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
     <!-- Google Font: Source Sans Pro -->
     <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
     {{-- toastr js --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

     <style>
         .nav-item>.active {
             background: #E5A11C !important;
         }

         .swal2-icon.swal2-info {
             border-color: #feaa9a !important;
             color: #fe6140 !important;
         }

         .navbar-badge {
             top: 0px !important;
         }
     </style>
     @stack('css')
 </head>

 <body class="hold-transition sidebar-mini">
     <div class="wrapper">
         <!-- Navbar -->
         @include('backend.includes.header')
         <!-- /.navbar -->

         <!-- Main Sidebar Container -->

         @if ((Auth::check() && Auth::user()->role_id == 1) || Auth::user()->role_id == 4)
             @include('backend.includes.admin_sidebar')
         @endif
         @if (Auth::check() && Auth::user()->role_id == 2)
             @include('backend.includes.vendor_sidebar')
         @endif

         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             @yield('content')
         </div>
         <!-- /.content-wrapper -->

         <!-- Control Sidebar -->
         <aside class="control-sidebar control-sidebar-dark">
             <!-- Control sidebar content goes here -->
         </aside>
         <!-- /.control-sidebar -->

         <!-- Main Footer -->
         @include('backend.includes.footer')
     </div>
     <!-- ./wrapper -->

     <!-- REQUIRED SCRIPTS -->
     <!-- jQuery -->
     <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
     <!-- Bootstrap -->
     <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
     <!-- AdminLTE App -->
     <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>

     <!-- OPTIONAL SCRIPTS -->
     <script src="{{ asset('backend/dist/js/demo.js') }}"></script>

     <!-- PAGE PLUGINS -->
     <!-- SparkLine -->
     <script src="{{ asset('backend/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
     <!-- jVectorMap -->
     <script src="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
     <script src="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
     <!-- SlimScroll 1.3.0 -->
     <script src="{{ asset('backend/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
     <!-- ChartJS 1.0.2 -->
     <script src="{{ asset('backend/plugins/chartjs-old/Chart.min.js') }}"></script>

     <!-- PAGE SCRIPTS -->
     <script src="{{ asset('backend/dist/js/pages/dashboard2.js') }}"></script>
     <script src="{{ asset('backend/plugins/form.js') }}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
     <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
     {!! Toastr::message() !!}
     <script>
         //...............toastr.....................
         @if ($errors->any())
             @foreach ($errors->all() as $error)
                 toastr.error('{{ $error }}', 'Error', {
                     closeButton: true,
                     progressBar: true
                 });
             @endforeach
         @endif
         //................toastr....................

         var my_id = "{{ Auth::id() }}";
         var notiSound = "{{ asset('backend/sound/notification2.mp3') }}"
         var baseUrl = "{{ url('/') }}";

         $(document).ready(function() {
             Pusher.logToConsole = true;

             var pusher = new Pusher('2c7abd3574eb20e399ae', {
                 cluster: 'ap2'
             });

             var channel = pusher.subscribe('my-channel'); // Pusher data get........
             channel.bind('my-event', function(data) {
                 //alert(JSON.stringify(data));
                 dataf = data.message
                 if (my_id === dataf.from) {
                     playSound = () => { // order notification function
                         const audio = new Audio(notiSound);
                         audio.play();
                     }
                     $.ajax({
                         url: baseUrl + "/vendor/notification/ajax/" + dataf.from,
                         method: "get",
                         success: function(successData) {
                             document.getElementById('unread_count').innerText = successData
                                 .noti_count;

                             playSound(); //notification sound
                             $("#d-none").addClass("d-none");

                             Swal.fire({ //order notification alert
                                 title: 'Order Notification!',
                                 text: successData.response.message,
                                 icon: 'info',
                                 showCancelButton: false,
                                 confirmButtonColor: '#fe6140',
                                 /*cancelButtonColor: '#d33',*/
                                 confirmButtonText: 'Show Me Order Details'
                             }).then((result) => {
                                 if (result.isConfirmed) {
                                     window.location.href = baseUrl +
                                         "/vendor/notification/read/" + successData
                                         .response.id;
                                 }
                             })
                             //list append
                             var child = ' <a href="' + baseUrl + '/vendor/notification/read/' +
                                 successData.response.id + '" class="dropdown-item">\n' +
                                 '<i class="fa fa-bell mr-2 text-success"></i> ' + successData
                                 .response.message.substr(0, 15) + '...' + '\n' +
                                 '<span class="float-right text-muted text-sm">1 second ago</span>\n' +
                                 '</a>\n' +
                                 '<div class="dropdown-divider"></div>'
                             $('#add_row p:first').after(child);

                         }
                     });
                 }

             });

         })
     </script>
     @stack('js')
 </body>

 </html>
