<?php 
    if (session_status() == PHP_SESSION_NONE) 
    {
      session_start();
    }
  
    include "include/config.php";


    if(isset($_POST['selected-contact-arr-val']) && $_POST['selected-contact-arr-val'] != "")
    {

      $contactarrstr = $_POST['selected-contact-arr-val'];
      $contactarr = explode(",",$contactarrstr);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Print Contacts</title>
  <!-- Include Head Section -->
  <?php include "include/headsection.php"; ?>
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

  
  <!------------------------------ Section Start ----------------------------------------->
    <section class="body-section-main">

      <!-- Section Wrapper Start -->
      <div class="section-wrapper">

        <!-- Section Content Starts -->
        <div class="section-content">
          <button class="print-btn no-print" onclick="window.print();">Print</button>
          <table class="contact-table" cellpadding="0" cellspacing="0">
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
            </tr>

          <?php 
            $i = 1;
            foreach ($contactarr as $value) 
            {
              $sqlgetselectedcontact = "select * from contact where id = ".$value;
              $rowgetselectedcontact = mysqli_query($con, $sqlgetselectedcontact);
              if (mysqli_num_rows($rowgetselectedcontact) > 0)
              {
                $resgetselectedcontact = mysqli_fetch_array($rowgetselectedcontact);

                // ------- Create Company Address -------
                $companyaddress = "";

                // Company Address Line 1
                if($resgetselectedcontact['company_address_1'] != "")
                {
                  $companyaddress .= $resgetselectedcontact['company_address_1'];
                }

                // Company Address Line 2 
                if($resgetselectedcontact['company_address_2'] != "")
                {
                  if($companyaddress == "")
                  {
                    $companyaddress .= $resgetselectedcontact['company_address_2'];
                  }
                  else
                  {
                    $companyaddress .= ", ".$resgetselectedcontact['company_address_2'];
                  }
                }

                // Company Address Line 3 
                if($resgetselectedcontact['company_address_3'] != "")
                {
                  if($companyaddress == "")
                  {
                    $companyaddress .= $resgetselectedcontact['company_address_3'];
                  }
                  else
                  {
                    $companyaddress .= ", ".$resgetselectedcontact['company_address_3'];
                  }
                }


                // ----- Create Residence Address -------
                $residenceaddress = "";

                // Residence Address Line 1
                if($resgetselectedcontact['residence_address_1'] != "")
                {
                  $residenceaddress .= $resgetselectedcontact['residence_address_1'];
                }

                // Residence Address Line 2 
                if($resgetselectedcontact['residence_address_2'] != "")
                {
                  if($residenceaddress == "")
                  {
                    $residenceaddress .= $resgetselectedcontact['residence_address_2'];
                  }
                  else
                  {
                    $residenceaddress .= ", ".$resgetselectedcontact['residence_address_2'];
                  }
                }

                // Residence Address Line 3 
                if($resgetselectedcontact['residence_address_3'] != "")
                {
                  if($residenceaddress == "")
                  {
                    $residenceaddress .= $resgetselectedcontact['residence_address_3'];
                  }
                  else
                  {
                    $residenceaddress .= ", ".$resgetselectedcontact['residence_address_3'];
                  }
                }


                

          ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $resgetselectedcontact['person_name']; ?></td>
              <td><?php echo $resgetselectedcontact['company_name']; ?></td>
              <td><?php echo $resgetselectedcontact['designation']; ?></td>
              <td><?php echo $resgetselectedcontact['business_email']; ?></td>
              <td><?php echo $companyaddress; ?></td>
              <td><?php echo $resgetselectedcontact['website']; ?></td>
              <td><?php echo $resgetselectedcontact['mobile_no']; ?></td>
              <td><?php echo $resgetselectedcontact['landline_no']; ?></td>
              <td><?php echo $resgetselectedcontact['personal_email']; ?></td>
              <td><?php echo $residenceaddress; ?></td>
            </tr>
          <?php
                $i++;
              }
            }
          ?>
        </table>

        </div>


        <!-- Section Content End -->
      </div>
      <!-- Section Wrapper End -->
    </section>
  <!--X-X-X-X-X-X-X-X-X-X-X-X-X-X- Section End -X-X-X-X-X-X-X-X-X-X-X-X-X-->


  <!------------------------------ Section Start ----------------------------------------->
    <section class="body-section-main no-print">

      <!-- Section Wrapper Start -->
      <div class="section-wrapper">

        <!-- Section Heading -->
        <div class="section-heading">Add above contacts to :- </div>

        <!-- Section Content Starts -->
        <div class="section-content">
           
          
          <div class="save-list-form-wrapper" id="add-to-saved-list-wrapper">
            <form metho="post" id="add-to-saved-list-form" >
              <input type="hidden" id="contact-arr-str" name="contact-arr-str" value="<?php echo $contactarrstr; ?>">
              <label for="list-id">Saved Lists : </label>
              <select id="list-id" name="list-id">
                <option value="0">Select List</option>
                <?php
                  $sqlgetlist = "select * from saved_list";
                  $rowgetlist = mysqli_query($con, $sqlgetlist);

                  if (mysqli_num_rows($rowgetlist) > 0)
                  {
                    $i = 0;
                    while ($i <= ($resgetlist = mysqli_fetch_array($rowgetlist)))
                    {
                  ?>
                      <option value="<?php echo $resgetlist["id"]; ?>"> <?php echo $resgetlist["list_name"]; ?></option>
                  <?php
                        $i++;
                      }
                    }
                  ?>
              </select>
              <input type="submit" id="add-to-saved-list-form-submit" name="add-to-saved-list-form-submit" value="Add" />
            </form>
          </div>

          <div class="or-seperater"><span>OR</span></div>

          <div class="save-list-form-wrapper" id="create-new-list-wrapper">
            <form metho="post" id="add-to-new-list-form" >
              <input type="hidden" id="contact-arr-str" name="contact-arr-str" value="<?php echo $contactarrstr; ?>">
              <label for="list-name">New List : </label>
              <input type="text" id="list-name" name="list-name" placeholder="List Name" />
              <input type="submit" id="add-to-new-list-form-submit" name="add-to-new-list-form-submit" value="Create & Add"  />
            </form>
          </div>

        </div>
        <!-- Section Content End -->
      </div>
      <!-- Section Wrapper End -->
    </section>
  <!--X-X-X-X-X-X-X-X-X-X-X-X-X-X- Section End -X-X-X-X-X-X-X-X-X-X-X-X-X-->


     <!-- Custom JS -->
    <?php include "include/customjs.php"; ?>
</body>
</html>

<?php
  //   }
  //   else
  //   {
  //     header("location:".getDomain()."/viewall".getPageExt());
  //   }
  // }
  // else
  // {
  //   header("location:".getDomain()."/viewall".getPageExt());
  }
?>