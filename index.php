<?php 
    if (session_status() == PHP_SESSION_NONE) 
    {
      session_start();
    }
  
    include "include/config.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <!-- Include Head Section -->
  <?php include "include/headsection.php"; ?>
</head>
<body>
  
  <!-- Include Header -->
  <?php include "include/header.php"; ?>

  <!-- Include Navbar -->
  <?php include "include/navbar.php"; ?>

  
  <!-- Section Start -->
    <section class="body-section-main">

      <!-- Section Wrapper Start -->
      <div class="section-wrapper">

        <!-- Section Heading -->
        <div class="section-heading">Home</div>

        <!-- Section Content Starts -->
        <div class="section-content">
          
          <div class="count-wrapper">
            <div class="count-heading">Total Contacts</div>
            <div class="count-value">
              <?php
                $sqlgetcontactcount = "select COUNT(*) from contact";
                $rowgetcontactcount = mysqli_query($con, $sqlgetcontactcount);

                if (mysqli_num_rows($rowgetcontactcount) > 0)
                {  
                  $resgetcontactcount = mysqli_fetch_array($rowgetcontactcount);
                  echo $resgetcontactcount['COUNT(*)'];
                }
              ?>
            </div>
          </div>

          <div class="count-wrapper">
            <div class="count-heading">Total Lists</div>
            <div class="count-value">
              <?php
                $sqlgetlistcount = "select COUNT(*) from saved_list";
                $rowgetlistcount = mysqli_query($con, $sqlgetlistcount);

                if (mysqli_num_rows($rowgetcontactcount) > 0)
                {  
                  $resgetlistcount = mysqli_fetch_array($rowgetlistcount);
                  echo $resgetlistcount['COUNT(*)'];
                }
              ?>
            </div>
          </div>

        </div>
        <!-- Section Content End -->
      </div>
      <!-- Section Wrapper End -->
    </section>
  <!-- Section End -->


    <!-- Custom JS -->
    <?php include "include/customjs.php"; ?>
    
    <script>
      $(document).ready(function(){
        $("#home-tab").addClass("active-tab ");
      });
    </script>
</body>
</html>