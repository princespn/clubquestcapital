<!DOCTYPE html>


<html>

<head lang="en">
  <!--start new script -->
  <!-- PAGE TITLE HERE -->
  <title>ClubQuestCapital</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <meta name="robots" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="" />
  <meta property="og:title" content="" />
  <meta property="og:description" content="" />
  <meta property="og:image" content="social-image.png" />
  <meta name="format-detection" content="telephone=no">
  
<!-- FAVICONS ICON -->
  <!-- <link rel="shortcut icon" type="image/png" href="{{ asset('user_files/assets/images/favicon.png') }}" /> -->
  <link rel="icon" type="image/svg" href="{{ asset('user_files/assets/favicon/favicon.svg') }}">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="{{ asset('user_files/assets/css/bootstrap.min.css') }}">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('user_files/assets/css/style2.css') }}">
	<link rel="stylesheet" href="{{ asset('user_files/assets/font-awesome/css/font-awesome.min.css') }}">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('user_files/assets/css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user_files/assets/css/dataTables.bootstrap4.min.css') }}">
	<!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
 
 
  <link rel="stylesheet" href="{{ asset('user_files/assets/css/style-account.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="{{ asset('user_files/assets/js/jquery.slim.min.js') }}"></script>
  <script src="{{ asset('user_files/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('user_files/assets/js/bootstrap.bundle.min.js') }}"></script>
  
 
  
</head>

<body data-sidebar="dark">
  <div id="user-app"></div>
   
   <script src="{{ asset('js/app.js')}}"></script>

   <!-- Required vendors -->
    <!-- <script src="{{ asset('user_files/assets/vendor/global/global.min.js') }}"></script> -->

       <!-- jQuery CDN - Slim version (=without AJAX) -->
       <!-- <script src="{{ asset('user_files/assets/js/jquery-3.3.1.slim.min.js') }}"></script> -->
    <!-- Popper.JS -->
    <script src="{{ asset('user_files/assets/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('user_files/assets/js/bootstrap.min.js') }}"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="{{ asset('user_files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('user_files/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('user_files/assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
	<!-- <script>
	  $(document).ready(function() {
		$('.report-table').DataTable();
	} );
	</script> -->
   <script type="text/javascript">
  $(document).ready(function() {
      $('#report-table').DataTable();
  } );
  </script>
	<script>
		$('button.copyButton1').click(function(){
			$('.inputr-1').select();      
			document.execCommand("copy");
		});
		$('button.copyButton2').click(function(){
			$('.inputr-2').select();      
			document.execCommand("copy");
		});

  function myFunctionRefLeft() {
  var copyText = document.getElementById("referral-left");
  // alert(copyText);
  copyText.select();
  document.execCommand("copy");

  var tooltip = document.getElementById("refcopy1");
  tooltip.innerHTML = "<span class='btn-icon-start text-secondary'><i class='fa fa-copy color-secondary'></i> </span>Copied !"; // + copyText.value;
}

function myFunctionRefRight() {
  var copyText = document.getElementById("myRightInput");
  copyText.select();
  document.execCommand("copy");

  var tooltip = document.getElementById("right-refcopy");
  tooltip.innerHTML = "<span class='btn-icon-start text-secondary'><i class='fa fa-copy color-secondary'></i> </span> Copied !"; // + copyText.value;
}
   </script>
 

 


         

 










</body>