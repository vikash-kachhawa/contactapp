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
  <title>Manage Filters</title>
  <!-- Include Head Section -->
  <?php include "include/headsection.php"; ?>
  <script type="text/javascript" src="js/tableSorter.min.js"></script>

</head>
<body>
  
  <!-- Include Header -->
  <?php include "include/header.php"; ?>

  <!-- Include Navbar -->
  <?php include "include/navbar.php"; ?>

  <!-------------------------------- Section Start ------------------------------------->

    <section class="body-section-main">

      <!-- Section Wrapper Start -->
      <div class="section-wrapper">

        <!-- Section Heading -->
        <div class="section-heading">Saved Lists</div>

        <!-- Section Content Starts -->
        <div class="section-content">
          
            <table id="lists-table" class="contact-table tablesorter" cellpadding="0" cellspacing="0">
              
            <?php

                  $sqlgetsavedlist = "select * from saved_list";
                  $rowgetsavedlist = mysqli_query($con, $sqlgetsavedlist);
                  if (mysqli_num_rows($rowgetsavedlist) > 0)
                  {
            ?>
              <thead>
              <tr>
                <th>SrNo</th>
                <th>List Name</th>
                <th>Created On</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
            <?php
                    $i = 0;
                    while ($i <= ($resgetsavedlist = mysqli_fetch_array($rowgetsavedlist)))
                    {

                      $listlink = getDomain()."/viewlist".getPageExt()."?i=".$resgetsavedlist['id']."&h=".$resgetsavedlist['hash'];
              ?>
                <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $resgetsavedlist['list_name']; ?></td>
                  <td><?php echo date("d-m-Y  h:i:sa",strtotime($resgetsavedlist['created_on'])); ?></td>
                  <td>
                    <a class="button" href="<?php echo $listlink;?>">View</a>
                    <button 
                      id="delete-list-btn-<?php echo $resgetsavedlist['id']; ?>"
                      class="delete-list-btn" 
                      data-list-id="<?php echo $resgetsavedlist['id']; ?>" 
                      data-list-hash="<?php echo $resgetsavedlist['hash']; ?>" 
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              <?php
                      $i++;
                    }
              ?>
                  </tbody>
              <?php
                  }
                  else
                  {
              ?>
                <tbody>
                  <tr>
                    <td colspan="4"> No Saved Lists Found ! </td>
                  </tr>
                </tbody>
              <?php      
                  }

              ?>
            </table>

        </div>
        <!-- Section Content End -->
      </div>
      <!-- Section Wrapper End -->
    </section>
    <!--X-X-X-X-X-X-X-X-X-X-X-X-X-X-X- Section End -X-X-X-X-X-X-X-X-X-X-X-X-X-X-X-->


   <!-- Custom JS -->
    <?php include "include/customjs.php"; ?>

    <script>
      $(document).ready(function(){
        $("#saved-lists-tab").addClass("active-tab ");
       
          $("#list-table").tablesorter();
      });
    </script>
</body>
</html>