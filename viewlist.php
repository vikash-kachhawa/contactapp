<?php 
    if (session_status() == PHP_SESSION_NONE) 
    {
      session_start();
    }
  
    include "include/config.php";


    if(isset($_GET['h']) && $_GET['h'] != "" && isset($_GET['i']) && $_GET['i'] != "")
    {

      $lid = $_GET['i'];
      $lhash = $_GET['h'];

      $sqlgetlist = "select list_name,created_on from saved_list where id = ".$lid." AND hash = '".$lhash."'";

      $rowgetlist = mysqli_query($con, $sqlgetlist);

      if (mysqli_num_rows($rowgetlist) > 0)
      {  
        $resgetlist = mysqli_fetch_array($rowgetlist);

?>
<!DOCTYPE html>
<html>
<head>
  <title>Manage Filters</title>
  <!-- Include Head Section -->
  <?php include "include/headsection.php"; ?>
  <script>
    var listid = "<?php echo $lid; ?>";
    var listhash = "<?php echo $lhash; ?>";
  </script>
  <script type="text/javascript" src="js/tableSorter.min.js"></script>
  <style>
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }

        #header-main,
        #navbar-main
        {
          display: none;
        }

        .section-wrapper
        {
          padding: 0;
          border: none;
        }
    }
  </style>
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
        <div class="section-heading">List Name : <?php echo $resgetlist['list_name']; ?></div>

        <!-- Section Content Starts -->
        <div class="section-content">
            <button class="print-btn no-print" onclick="window.print();">Print</button>
            <table id="list-contacts-table" class="contact-table tablesorter" cellpadding="0" cellspacing="0">
              
            <?php

                  $sqlgetlistcontact = "select contact_id from list_contact_mapping where list_id = ".$lid;
                  $rowgetlistcontact = mysqli_query($con, $sqlgetlistcontact);
                  if (mysqli_num_rows($rowgetlistcontact) > 0)
                  {
            ?>
                  <thead>
                  <tr>
                    <th>SrNo</th>
                    <th>Person Name</th>
                    <th>Company Name</th>
                    <th>Designation</th>
                    <th>Business Email</th>
                    <th>Company Address</th>
                    <th>Website</th>
                    <th>Mobile No</th>
                    <th>Landline No</th>
                    <th>Personal Email</th>
                    <th>Residence Address</th>
                    <th class="no-print">Remove</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
                    $i = 0;
                    while ($i <= ($resgetlistcontact = mysqli_fetch_array($rowgetlistcontact)))
                    {

                      $sqlgetcontact = "select * from contact where id = ".$resgetlistcontact['contact_id'];
                      $rowgetcontact = mysqli_query($con, $sqlgetcontact);
                      if (mysqli_num_rows($rowgetcontact) > 0)
                      {  
                        $resgetcontact = mysqli_fetch_array($rowgetcontact);

                        // ------- Create Company Address -------
                        $companyaddress = "";

                        // Company Address Line 1
                        if($resgetcontact['company_address_1'] != "")
                        {
                          $companyaddress .= $resgetcontact['company_address_1'];
                        }

                        // Company Address Line 2 
                        if($resgetcontact['company_address_2'] != "")
                        {
                          if($companyaddress == "")
                          {
                            $companyaddress .= $resgetcontact['company_address_2'];
                          }
                          else
                          {
                            $companyaddress .= ", ".$resgetcontact['company_address_2'];
                          }
                        }

                        // Company Address Line 3 
                        if($resgetcontact['company_address_3'] != "")
                        {
                          if($companyaddress == "")
                          {
                            $companyaddress .= $resgetcontact['company_address_3'];
                          }
                          else
                          {
                            $companyaddress .= ", ".$resgetcontact['company_address_3'];
                          }
                        }


                        // ----- Create Residence Address -------
                        $residenceaddress = "";

                        // Residence Address Line 1
                        if($resgetcontact['residence_address_1'] != "")
                        {
                          $residenceaddress .= $resgetcontact['residence_address_1'];
                        }

                        // Residence Address Line 2 
                        if($resgetcontact['residence_address_2'] != "")
                        {
                          if($residenceaddress == "")
                          {
                            $residenceaddress .= $resgetcontact['residence_address_2'];
                          }
                          else
                          {
                            $residenceaddress .= ", ".$resgetcontact['residence_address_2'];
                          }
                        }

                        // Residence Address Line 3 
                        if($resgetcontact['residence_address_3'] != "")
                        {
                          if($residenceaddress == "")
                          {
                            $residenceaddress .= $resgetcontact['residence_address_3'];
                          }
                          else
                          {
                            $residenceaddress .= ", ".$resgetcontact['residence_address_3'];
                          }
                        }                        

                  ?>
                    <tr>
                      <td><?php echo $i+1; ?></td>
                      <td><?php echo $resgetcontact['person_name']; ?></td>
                      <td><?php echo $resgetcontact['company_name']; ?></td>
                      <td><?php echo $resgetcontact['designation']; ?></td>
                      <td><?php echo $resgetcontact['business_email']; ?></td>
                      <td><?php echo $companyaddress; ?></td>
                      <td><?php echo $resgetcontact['website']; ?></td>
                      <td><?php echo $resgetcontact['mobile_no']; ?></td>
                      <td><?php echo $resgetcontact['landline_no']; ?></td>
                      <td><?php echo $resgetcontact['personal_email']; ?></td>
                      <td><?php echo $residenceaddress; ?></td>
                      <td class="no-print">
                        <button 
                          id="remove-list-contact-btn-<?php echo $resgetcontact['id']; ?>" 
                          class="remove-list-contact-btn" 
                          data-contact-id="<?php echo $resgetcontact['id']; ?>"
                          >
                          <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
              <?php
                      }
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
                    <td colspan="11">No Contacts Found!</td>
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
        // $("#saved-lists-tab").addClass("active-tab ");
       
          $("#list-contacts-table").tablesorter();
      });
    </script>
</body>
</html>
<?php
    }
    else
    {
      header("location:".getDomain()."/savedlist".getPageExt());
    }
  }
  else
  {
    header("location:".getDomain()."/savedlist".getPageExt());
  }
?>