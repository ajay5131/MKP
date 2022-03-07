<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Meet Key People | Admin Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}backend/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}backend/css/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('/') }}backend/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}backend/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}backend/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('/') }}backend/css/custom.min.css" rel="stylesheet" type="text/css" />

        <link href="{{ asset('/') }}backend/css/components.min.css" rel="stylesheet" type="text/css" />

        <link href="{{ asset('/') }}backend/css/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}backend/css/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

        <link href="{{ asset('/') }}backend/css/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}backend/css/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('/') }}backend/css/style.css" rel="stylesheet" type="text/css" />

        <link rel="shortcut icon" href="{{ asset('/') }}backend/images/favicon.ico" /> 
        @stack('custom-style') 
    </head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-header navbar navbar-fixed-top"> 
            <div class="page-header-inner "> 
                <div class="page-logo bg-white"> 
                    <a href="{{ route('admin.dashboard') }}" class="logo__link"> 
                        <img src="{{ asset('/') }}backend/images/logo.png" alt="logo" style="max-width:170px; max-height:40px;" />
                    </a>
                    <div class="menu-toggler sidebar-toggler"> </div>
                </div>
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a> 
                
                @include('backend.layouts.header') 

            </div>
        </div>

        <div class="clearfix"> </div>
        <div class="page-container"> 

            <div class="page-sidebar-wrapper"> @include('backend.layouts.sidebar') </div>

            <div class="page-content-wrapper"> 
                <div class="page-content" style="background-color:#eef1f5;"> 
                    @include('backend.layouts.breadcrumb')

                    @yield('content') 
                </div>
            </div>

        </div>

        <div class="page-footer">
            <div class="page-footer-inner"> {{ date('Y')}} © Meet Key People. Admin Panel. </div>
            <div class="scroll-to-top"> <i class="icon-arrow-up"></i> </div>
        </div>

        <div class="load_page_content">
        </div>        

        
        <script src="{{ asset('/') }}backend/js/jquery.min.js" type="text/javascript"></script>
        <script src="{{ asset('/') }}backend/js/bootstrap.min.js" type="text/javascript"></script>

        <script src="{{ asset('/') }}backend/js/jquery-ui/jquery-ui.min.js" type="text/javascript"></script> 

        <script src="{{ asset('/') }}backend/js/app.min.js" type="text/javascript"></script> 

        <script src="{{ asset('/') }}backend/js/layout.min.js" type="text/javascript"></script> 
        <script src="{{ asset('/') }}backend/js/demo.js" type="text/javascript"></script> 
        <script src="{{ asset('/') }}backend/js/quick-sidebar.min.js" type="text/javascript"></script> 

        <script src="{{ asset('/') }}backend/css/datatables/datatables.min.js" type="text/javascript"></script> 
        <script src="{{ asset('/') }}backend/css/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script> 

        <script src="{{ asset('/') }}backend/css/select2/js/select2.full.min.js" type="text/javascript"></script>

        <script src="{{ asset('/') }}backend/js/tinymce/jquery.tinymce.min.js" type="text/javascript"></script>
        
        <script src="{{ asset('/') }}backend/js/tinymce/tinymce.min.js" type="text/javascript"></script>

        @stack('custom-script') 

        <script>

            $(document).ready(function() {
                setTimeout(() => {
                    $('.alert').slideUp();
                }, 5000);
                init();
            });
        </script>


        <script>
            $(document).on('click', '.add_more_btn', function(e) {
                $('.load_page_content').load($('#add_more_url').val(), function() {
                    var html = $('.load_page_content').html();
                    $('.load_page_content').empty();
                    $('.add_more_lang').append(html);
                    setTimeout(() => {
                        tinymce.remove('.tinymce_editor');
                        init();                        
                    }, 200);
                });
            });
            $(document).on('click', '.remove_btn', function(e) {
                $(this).parents('.add_more_block').remove();
            });

            function init() {
                
                $('.select2').select2();
                tinymce.init({
                    selector: '.tinymce_editor',
                    height: 150,
                    forced_root_block: '',
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table contextmenu paste code'
                    ],
                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
                });
            }
        </script>

    </body>

</html>