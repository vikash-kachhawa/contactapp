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
  <title></title>
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
        <div class="section-heading">Search Contacts</div>

        <!-- Section Content Starts -->
        <div class="section-content">

          <div class="contact-filter-main">
            <!-- Text Search Filter -->
            <div class="contact-filter-wrapper" style="display:block;">
              <label for="contact-filter-search-qry">Search : </label>
              <input type="text" id="contact-filter-search-qry" name="contact-filter-search-qry" placeholder="Search for Keywords" style="width: 500px;" />
              <button id="clear-all-filter-btn" disabled="disabled"> Clear All </button>
            </div>
            <div class="contact-filter-wrapper" style="display:block;">
              <h3>Filter By : </h3>
            </div>
            <!-- Importance Filter -->
            <div class="contact-filter-wrapper">
              <label for="importance-filter">Importance : </label>
              <select id="importance-filter" name="importance-filter">
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
            </div>
            <!-- Group Filter -->
            <div class="contact-filter-wrapper">
              <label for="group-filter">Group : </label>
              <select id="group-filter" name="group-filter">
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
            </div>
            <!-- Category Filter -->
            <div class="contact-filter-wrapper">
              <label for="category-filter">Category : </label>
              <select id="category-filter" name="category-filter">
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
            </div>
            <!-- Related-to Filter -->
            <div class="contact-filter-wrapper">
              <label for="related-to-filter">Related to : </label>
              <select id="related-to-filter" name="related-to-filter">
                <option value="0">Select Related to</option>
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
            </div>


            <!-- Product Type Filter -->
            <div class="contact-filter-wrapper">
              <label for="product-type-filter">Product Type : </label>
              <select id="product-type-filter" name="product-type-filter">
                <option value="0">Select Product Type</option>
                <?php
                    $sqlgetproducttype = "select * from product_type";
                    $rowgetproducttype = mysqli_query($con, $sqlgetproducttype);

                    if (mysqli_num_rows($rowgetproducttype) > 0)
                    {
                      $i = 0;
                      while ($i <= ($resgetproducttype = mysqli_fetch_array($rowgetproducttype)))
                      {
                    ?>
                            <option value="<?php echo $resgetproducttype["id"]; ?>"> <?php echo $resgetproducttype["name"]; ?></option>
                    <?php
                          $i++;
                        }
                      }
                    ?>
              </select>
            </div>





          </div>

          <!-- <button id="test-btn">Filter</button> -->

        </div>
        <!-- Section Content End -->
      </div>
      <!-- Section Wrapper End -->
    </section>
    <!--X-X-X-X-X-X-X-X-X-X-X-X-X-X-X- Section End -X-X-X-X-X-X-X-X-X-X-X-X-X-X-X-->

    <!-------------------------------- Section Start ------------------------------------->

    <section class="body-section-main">

      <!-- Section Wrapper Start -->
      <div class="section-wrapper">

        <!-- Section Heading -->
        <div class="section-heading">List of Contacts</div>

        <!-- Section Content Starts -->
        <div class="section-content">
          <div class="result-page-size-filter">
            <select id="result-page-size" name="result-page-size">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
              <option value="250">250</option>
              <option value="500">500</option>
            </select>
          </div>
          
          <div class="contact-list-wrapper">
            <div class="spinner-overlay" id="contact-list-loading" style="display:none;">
              <div class="spinner-ovelay-wrapper">
                <img src="<?php echo getImageDomain();?>/images/gif/spinner.gif" height="50" width="50">
              </div>
            </div>
            <div id="contact-list-section">
              <?php include "contactlistsection.php";  ?>
            </div>
          </div>
        </div>
        <!-- Section Content End -->
      </div>
      <!-- Section Wrapper End -->
    </section>
    <!--X-X-X-X-X-X-X-X-X-X-X-X-X-X-X- Section End -X-X-X-X-X-X-X-X-X-X-X-X-X-X-X-->



    <!-- Custom JS -->
    <?php include "include/customjs.php"; ?>
    <script type="text/javascript" src="js/filter.js"></script>
    <script>
      $(document).ready(function(){
        $("#view-all-tab").addClass("active-tab ");
      });
    </script>
</body>
</html>