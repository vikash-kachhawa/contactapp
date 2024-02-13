<?php 
    if (session_status() == PHP_SESSION_NONE) 
    {
      session_start();
    }
  
    include "include/config.php";


    if(isset($_GET['h']) && $_GET['h'] != "" && isset($_GET['i']) && $_GET['i'] != "")
    {

      $cid = $_GET['i'];
      $chash = $_GET['h'];

      $sqlgetcontact = "select * from contact where id = ".$cid." AND hash = '".$chash."'";

      $rowgetcontact = mysqli_query($con, $sqlgetcontact);

      if (mysqli_num_rows($rowgetcontact) > 0)
      {  
        $resgetcontact = mysqli_fetch_array($rowgetcontact);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit</title>
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
        <div class="section-heading">Edit Contact</div>

        <!-- Section Content Starts -->
        <div class="section-content">
           <div class="form_wrapper">
      <div class="form_container">
        <div class="title_container">
          <h2> Update Contact Info</h2>
        </div>
        <div class="row clearfix">
          <div class="">
            <form method="post" id="edit-contact-form">
              <input type="hidden" id="c-id" name="c-id" value="<?php echo $cid; ?>">
              <input type="hidden" id="c-hash" name="c-hash" value="<?php echo $chash; ?>">
              <div class="sub_heading_container">
                Business Info
              </div>
              <div class="row clearfix">
                <div class="col_half">
                  <label class="form-label" for="person-name">Person Name</label>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" id="person-name" name="person-name" placeholder="Person Name" maxlength="254"  value="<?php echo $resgetcontact['person_name']; ?>" />
                  </div>
                </div>
                <div class="col_half">
                  <label class="form-label" for="company-name">Company Name</label>
                  <div class="input_field"> <span><i class="fa-solid fa-building"></i></span>
                    <input type="text" id="company-name" name="company-name" placeholder="Company Name" maxlength="254" value="<?php echo $resgetcontact['company_name']; ?>"  />
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col_half">
                  <label class="designation" for="company-name">Designation</label>
                  <div class="input_field"> <span><i class="fa fa-level-up" aria-hidden="true"></i></span>
                    <input type="text" id="designation" name="designation" placeholder="Designation" maxlength="254" value="<?php echo $resgetcontact['designation']; ?>" />
                  </div>
                </div>
                <div class="col_half">
                  <label class="form-label" for="business-email">Business E-Mail</label>
                  <div class="input_field"> <span><i class="fa-solid fa-envelope"></i></span>
                    <input type="text" id="business-email" name="business-email" placeholder="Business Email" maxlength="254" value="<?php echo $resgetcontact['business_email']; ?>"/>
                  </div>
                </div>
              </div>



              <div class="row clearfix">
                <div class="col_half">
                  <label class="form-label" for="cr-limit">Group</label>
                  <div class="input_field"> <span><i class="fa-solid fa-maximize"></i></span>
                    <div class="input_field select_option">
                    <select id="group" name="group">
                      <option value="0">Select Group</option>
                      <?php
                          $sqlgetgrouptype = "select * from group_type";
                          $rowgetgrouptype = mysqli_query($con, $sqlgetgrouptype);

                          if (mysqli_num_rows($rowgetgrouptype) > 0)
                          {
                            $i = 0;
                            while ($i <= ($resgetgrouptype = mysqli_fetch_array($rowgetgrouptype)))
                            {
                              if($resgetcontact['group_type'] == $resgetgrouptype['id'])
                              {
                                $groupselected = "selected";
                              }
                              else
                              {
                                $groupselected = "";
                              }
                          ?>
                                  <option value="<?php echo $resgetgrouptype["id"]; ?>" <?php echo $groupselected; ?> > <?php echo $resgetgrouptype["name"]; ?></option>
                          <?php
                                $i++;
                              }
                            }
                          ?>
                    </select>
                    <div class="select_arrow"></div>
                    </div>
                  </div>
                </div>
                <div class="col_half">
                  <label class="form-label" for="category">Category</label>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <div class="input_field select_option">
                    <select id="category" name="category">
                      <option value="0">Select Category</option>
                      <?php
                          $sqlgetcategorytype = "select * from category_type";
                          $rowgetcategorytype = mysqli_query($con, $sqlgetcategorytype);

                          if (mysqli_num_rows($rowgetcategorytype) > 0)
                          {
                            $i = 0;
                            while ($i <= ($resgetcategorytype = mysqli_fetch_array($rowgetcategorytype)))
                            {
                              if($resgetcontact['category'] == $resgetcategorytype['id'])
                              {
                                $categoryselected = "selected";
                              }
                              else
                              {
                                $categoryselected = "";
                              }
                          ?>
                                  <option value="<?php echo $resgetcategorytype["id"]; ?>" <?php echo $categoryselected; ?> > <?php echo $resgetcategorytype["name"]; ?></option>
                          <?php
                                $i++;
                              }
                            }
                          ?>
                    </select>
                    <div class="select_arrow"></div>
                  </div>
                  </div>
                </div>
              </div>



              <div class="row clearfix">
                <div class="col_half">
                  <label class="form-label" for="category">Product Category</label>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <div class="input_field select_option">
                    <select id="product-type" name="product-type">
                      <option value="0">Select Product Category</option>
                      <?php
                          $sqlgetproducttype = "select * from product_type";
                          $rowgetproducttype = mysqli_query($con, $sqlgetproducttype);

                          if (mysqli_num_rows($rowgetproducttype) > 0)
                          {
                            $i = 0;
                            while ($i <= ($resgetproducttype = mysqli_fetch_array($rowgetproducttype)))
                            {
                              if($resgetcontact['product_type'] == $resgetproducttype['id'])
                              {
                                $producttypeselected = "selected";
                              }
                              else
                              {
                                $producttypeselected = "";
                              }
                          ?>
                                  <option value="<?php echo $resgetproducttype["id"]; ?>" <?php echo $producttypeselected; ?> > <?php echo $resgetproducttype["name"]; ?></option>
                          <?php
                                $i++;
                              }
                            }
                          ?>
                    </select>
                    <div class="select_arrow"></div>
                  </div>
                  </div>

                </div>
                <div class="col_half">
                  <label class="form-label" for="website">Website</label>
                  <div class="input_field"> <span><i class="fa-solid fa-globe"></i></span>
                    <input type="text" id="website" name="website" placeholder="Website" maxlength="254" value="<?php echo $resgetcontact['website']; ?>"/>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col_half">
                  <label class="form-label" for="company-address">Compnay Address</label>
                  
                  <div class="input_field"> <span><i class="fa-solid fa-address-book"></i></span>
                    <input type="text" id="company-address-1" name="company-address-1" placeholder="Address Line 1" maxlength="254" value="<?php echo $resgetcontact['company_address_1']; ?>"/>
                  </div>

                  <div class="input_field"> <span><i class="fa-solid fa-address-book"></i></span>
                    <input type="text" id="company-address-2" name="company-address-2" placeholder="Address Line 2" maxlength="254" value="<?php echo $resgetcontact['company_address_2']; ?>"/>
                  </div>
                  
                  <div class="input_field"> <span><i class="fa-solid fa-address-book"></i></span>
                    <input type="text" id="company-address-3" name="company-address-3" placeholder="Address Line 3" maxlength="254" value="<?php echo $resgetcontact['company_address_3']; ?>"/>
                  </div>
                </div>
              </div>

              <div class="sub_heading_container">
                Personal Info
              </div>

              <div class="row clearfix">
                <div class="col_half">
                  <label class="form-label" for="mobile-no">Mobile Number</label>
                  <div class="input_field"> <span><i class="fa-solid fa-mobile-retro"></i></span>
                    <input type="text" id="mobile-no" name="mobile-no" placeholder="Mobile Number" maxlength="99" value="<?php echo $resgetcontact['mobile_no']; ?>"/>
                  </div>
                </div>
                <div class="col_half">
                  <label class="form-label" for="landline-no">Landline Number</label>
                  <div class="input_field"> <span><i class="fa-solid fa-phone"></i></span>
                    <input type="text" id="landline-no" name="landline-no" placeholder="LandLine Number" maxlength="99" value="<?php echo $resgetcontact['landline_no']; ?>"/>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col_half">
                  <label class="form-label" for="personal-email">Personal Email</label>
                  <div class="input_field"> <span><i class="fa-solid fa-envelope"></i></span>
                    <input type="text" id="personal-email" name="personal-email" placeholder="Personal Email" maxlength="254" value="<?php echo $resgetcontact['personal_email']; ?>" />
                  </div>
                </div>
                <div class="col_half">
                  <label class="form-label" for="cr-limit">Related to</label>
                  <div class="input_field"> <span><i class="fa-solid fa-maximize"></i></span>
                    <div class="input_field select_option">
                    <select id="related-to" name="related-to">
                      <option value="0">Select Group</option>
                      <?php
                          $sqlgetrelatedto = "select * from related_to";
                          $rowgetrelatedto = mysqli_query($con, $sqlgetrelatedto);

                          if (mysqli_num_rows($rowgetrelatedto) > 0)
                          {
                            $i = 0;
                            while ($i <= ($resgetrelatedto = mysqli_fetch_array($rowgetrelatedto)))
                            {
                              if($resgetcontact['related_to'] == $resgetrelatedto['id'])
                              {
                                $relatedtoselected = "selected";
                              }
                              else
                              {
                                $relatedtoselected = "";
                              }
                          ?>
                                  <option value="<?php echo $resgetrelatedto["id"]; ?>" <?php echo $relatedtoselected; ?> > <?php echo $resgetrelatedto["name"]; ?></option>
                          <?php
                                $i++;
                              }
                            }
                          ?>
                    </select>
                    <div class="select_arrow"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col_half">
                  <label class="form-label" for="cr-limit">Credebility</label>
                  <div class="input_field"> <span><i class="fa-solid fa-maximize"></i></span>
                    <input type="number" id="cr-limit" name="cr-limit" placeholder="Credebility" maxlength="254" value="<?php echo $resgetcontact['cr_limit']; ?>"/>
                  </div>
                </div>
                <div class="col_half">
                  <label class="form-label" for="importance">Importance</label>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <div class="input_field select_option">
                    <select id="importance" name="importance">
                      <option value="0">Select Importance</option>
                      <?php
                          $sqlgetimportancetype = "select * from importance_type";
                          $rowgetimportancetype = mysqli_query($con, $sqlgetimportancetype);

                          if (mysqli_num_rows($rowgetimportancetype) > 0)
                          {
                            $i = 0;
                            while ($i <= ($resgetimportancetype = mysqli_fetch_array($rowgetimportancetype)))
                            {
                              if($resgetcontact['importance'] == $resgetimportancetype['id'])
                              {
                                $importanceselected = "selected";
                              }
                              else
                              {
                                $importanceselected = "";
                              }
                          ?>
                                  <option value="<?php echo $resgetimportancetype["id"]; ?>" <?php echo $importanceselected; ?> > <?php echo $resgetimportancetype["name"]; ?></option>
                          <?php
                                $i++;
                              }
                            }
                          ?>
                    </select>
                    <div class="select_arrow"></div>
                  </div>
                  </div>
                </div>
              </div>

              

              <div class="row clearfix">
                
              </div>

              <div class="row clearfix">
                <div class="col_half">
                </div>
                <div class="col_half">  
                  <label class="form-label" for="residence-address">Residence Address</label>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>  
                    <input type="text" id="residence-address-1" name="residence-address-1" placeholder="Address Line 1" maxlength="254" value="<?php echo $resgetcontact['residence_address_1']; ?>" />
                  </div>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>  
                    <input type="text" id="residence-address-2" name="residence-address-2" placeholder="Address Line 2" maxlength="254" value="<?php echo $resgetcontact['residence_address_2']; ?>" />
                  </div>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>  
                    <input type="text" id="residence-address-3" name="residence-address-3" placeholder="Address Line 3" maxlength="254" value="<?php echo $resgetcontact['residence_address_3']; ?>" />
                  </div>
                </div>
              </div>
                  
              <input class="button" id="edit-contact-form-submit" name="edit-contact-form-submit" type="submit" value="Update Contact" />
            </form>
          </div>
        </div>
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
</body>
</html>

<?php
    }
    else
    {
      header("location:".getDomain()."/viewall".getPageExt());
    }
  }
  else
  {
    header("location:".getDomain()."/viewall".getPageExt());
  }
?>