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
  <title>Add New</title>
  <!-- Include Head Section -->
  <?php include "include/headsection.php"; ?>
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
        <!-- <div class="section-heading">Add New Contact</div> -->

        <!-- Section Content Starts -->
        <div class="section-content" style="padding:0;">
         <div class="form_wrapper">
      <div class="form_container">
        <div class="title_container">
          <h2>Add New Contact</h2>
        </div>
        <div class="row clearfix">
          <div class="">
            <form method="post" id="add-contact-form">
              <div class="sub_heading_container">
                Business Info
              </div>
              <div class="row clearfix">
                <div class="col_half">
                  <label class="form-label" for="person-name">Person Name</label>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" id="person-name" name="person-name" placeholder="Person Name" maxlength="254" />
                  </div>
                </div>
                <div class="col_half">
                  <label class="form-label" for="company-name">Company Name</label>
                  <div class="input_field"> <span><i class="fa-solid fa-building"></i></span>
                    <input type="text" id="company-name" name="company-name" placeholder="Company Name" maxlength="254"  />
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col_half">
                  <label class="designation" for="company-name">Designation</label>
                  <div class="input_field"> <span><i class="fa fa-level-up" aria-hidden="true"></i></span>
                    <input type="text" id="designation" name="designation" placeholder="Designation" maxlength="254" />
                  </div>
                </div>
                <div class="col_half">
                  <label class="form-label" for="business-email">Business E-Mail</label>
                  <div class="input_field"> <span><i class="fa-solid fa-envelope"></i></span>
                    <input type="text" id="business-email" name="business-email" placeholder="Business Email" maxlength="254"/>
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
                          ?>
                                  <option value="<?php echo $resgetgrouptype["id"]; ?>"> <?php echo $resgetgrouptype["name"]; ?></option>
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
                          ?>
                                  <option value="<?php echo $resgetcategorytype["id"]; ?>"> <?php echo $resgetcategorytype["name"]; ?></option>
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
                  <label class="form-label" for="category">Product Type</label>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <div class="input_field select_option">
                    <select id="product-type" name="product-type">
                      <option value="0">Select Product Type</option>
                      <?php
                          $sqlgetproductype = "select * from product_type";
                          $rowgetproductype = mysqli_query($con, $sqlgetproductype);

                          if (mysqli_num_rows($rowgetproductype) > 0)
                          {
                            $i = 0;
                            while ($i <= ($resgetproductype = mysqli_fetch_array($rowgetproductype)))
                            {
                          ?>
                                  <option value="<?php echo $resgetproductype["id"]; ?>"> <?php echo $resgetproductype["name"]; ?></option>
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
                    <input type="text" id="website" name="website" placeholder="Website" maxlength="254"/>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col_half">
                  <label class="form-label" for="company-address">Compnay Address</label>
                  
                  <div class="input_field"> <span><i class="fa-solid fa-address-book"></i></span>
                    <input type="text" id="company-address-1" name="company-address-1" placeholder="Address Line 1" maxlength="254"/>
                  </div>

                  <div class="input_field"> <span><i class="fa-solid fa-address-book"></i></span>
                    <input type="text" id="company-address-2" name="company-address-2" placeholder="Address Line 2" maxlength="254"/>
                  </div>
                  
                  <div class="input_field"> <span><i class="fa-solid fa-address-book"></i></span>
                    <input type="text" id="company-address-3" name="company-address-3" placeholder="Address Line 3" maxlength="254"/>
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
                    <input type="text" id="mobile-no" name="mobile-no" placeholder="Mobile Number" maxlength="99"/>
                  </div>
                </div>
                <div class="col_half">
                  <label class="form-label" for="landline-no">Landline Number</label>
                  <div class="input_field"> <span><i class="fa-solid fa-phone"></i></span>
                    <input type="text" id="landline-no" name="landline-no" placeholder="LandLine Number" maxlength="99"/>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col_half">
                  <label class="form-label" for="personal-email">Personal Email</label>
                  <div class="input_field"> <span><i class="fa-solid fa-envelope"></i></span>
                    <input type="text" id="personal-email" name="personal-email" placeholder="Personal Email" maxlength="254" />
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
                          ?>
                                  <option value="<?php echo $resgetrelatedto["id"]; ?>"> <?php echo $resgetrelatedto["name"]; ?></option>
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
                    <input type="number" id="cr-limit" name="cr-limit" placeholder="Credebility" maxlength="254"/>
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
                          ?>
                                  <option value="<?php echo $resgetimportancetype["id"]; ?>"> <?php echo $resgetimportancetype["name"]; ?></option>
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
                    <input type="text" id="residence-address-1" name="residence-address-1" placeholder="Address Line 1" maxlength="254" />
                  </div>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>  
                    <input type="text" id="residence-address-2" name="residence-address-2" placeholder="Address Line 2" maxlength="254" />
                  </div>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>  
                    <input type="text" id="residence-address-3" name="residence-address-3" placeholder="Address Line 3" maxlength="254" />
                  </div>
                </div>
              </div>
                  
              <input class="button" id="add-contact-form-submit" name="add-contact-form-submit" type="submit" value="Add Contact" />
            </form>
          </div>
        </div>
      </div>
    </div>
        </div>
        <!--X- Section Content End -X-->
      </div>
      <!--X- Section Wrapper End -X-->
    </section>
    
  <!--X-X-X-X-X-X-X-X-X-X-X-X-X-X-X- Section End -X-X-X-X-X-X-X-X-X-X-X-X-X-X-X-->


     <!-- Custom JS -->
      <?php include "include/customjs.php"; ?>
  <script>
    $(document).ready(function(){
      $("#add-new-tab").addClass("active-tab ");
    });
  </script>
</body>
</html>