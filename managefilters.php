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
        <div class="section-heading">Importance Filter</div>

        <!-- Section Content Starts -->
        <div class="section-content">


          <div class="add-filter-wrapper">
            <div class="section-sub-heading add-filter-comman">
              Add New Importance Type : 
            </div>
            <div class="add-filter-form-wrapper add-filter-comman">
              <form id="add-importance-filter-form">
                <input type="text" id="importance-filter-name" name="importance-filter-name">
                <input type="submit" id="importance-filter-name-submit" name="importance-filter-name-submit" value="Add Filter">
              </form>
            </div>
          </div>

          <div class="filter-list-wrapper">
            <div class="section-sub-heading add-filter-comman">
              Importance Types : 
            </div>
            <table id="importance-table" class="filter-table tablesorter" cellpadding="0" cellspacing="0">
              <thead>
            <tr>
              <th>SrNo</th>
              <th>Filter Name</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php

                  $sqlgetimportance = "select * from importance_type";
                  $rowgetimportance = mysqli_query($con, $sqlgetimportance);

                  if (mysqli_num_rows($rowgetimportance) > 0)
                  {
                    $i = 0;
                    while ($i <= ($resgetimportance = mysqli_fetch_array($rowgetimportance)))
                    {
                  ?>
                      <tr>
                        <td><?php echo $i+1; ?></td>
                        <td>

                          <div class="filter-name" id="imp-filter-name-<?php echo $resgetimportance['id']; ?>">
                            <?php echo $resgetimportance["name"]; ?>
                          </div>

                          <div class="filter-name-edit-input-wrapper" id="imp-filter-name-edit-input-<?php echo $resgetimportance['id']; ?>" style="display: none;" >
                              <input 
                                type="text" 
                                id="edit-importance-filter-name-<?php echo $resgetimportance['id']; ?>" 
                                name="edit-importance-filter-name-<?php echo $resgetimportance['id']; ?>" 
                                value="<?php echo $resgetimportance["name"]; ?>" 
                              />
                              <button  
                                class="update-importance-filter-btn" 
                                id="update-importance-filter-btn-<?php echo $resgetimportance['id']; ?>" 
                                name="update-importance-filter-btn-<?php echo $resgetimportance['id']; ?>" 
                                data-id="<?php echo $resgetimportance['id']; ?>" 
                                data-input-id="edit-importance-filter-name-<?php echo $resgetimportance['id']; ?>"
                                data-input-wrapper-id="imp-filter-name-edit-input-<?php echo $resgetimportance['id']; ?>"
                                data-filter-name-id="imp-filter-name-<?php echo $resgetimportance['id']; ?>"
                                data-edit-btn-id="edit-importance-<?php echo $resgetimportance['id']; ?>"
                              >
                                  Save
                              </button>
                              <button
                                class="cancel-update-importance-filter-btn" 
                                data-input-id="edit-importance-filter-name-<?php echo $resgetimportance['id']; ?>"
                                data-input-wrapper-id="imp-filter-name-edit-input-<?php echo $resgetimportance['id']; ?>"
                                data-filter-name-id="imp-filter-name-<?php echo $resgetimportance['id']; ?>"
                                data-edit-btn-id="edit-importance-<?php echo $resgetimportance['id']; ?>"
                              >
                                Cancel
                              </button>
                            </form>
                          </div>

                        </td>
                        <td>
                          <button 
                            class="edit-importance-btn action-btn" 
                            id="edit-importance-<?php echo $resgetimportance['id']; ?>" 
                            data-id="<?php echo $resgetimportance['id']; ?>"
                            data-input-wrapper-id="imp-filter-name-edit-input-<?php echo $resgetimportance['id']; ?>"
                            data-filter-name-id="imp-filter-name-<?php echo $resgetimportance['id']; ?>" 
                          >
                            Edit
                          </button>
                          <button 
                            class="delete-importance-btn action-btn" 
                            id="delete-importance-<?php echo $resgetimportance['id']; ?>" 
                            data-id="<?php echo $resgetimportance['id']; ?>" 
                            data-input-id="edit-importance-filter-name-<?php echo $resgetimportance['id']; ?>"
                            data-edit-btn-id="edit-importance-<?php echo $resgetimportance['id']; ?>"
                            data-input-wrapper-id="imp-filter-name-edit-input-<?php echo $resgetimportance['id']; ?>"
                            data-filter-name-id="imp-filter-name-<?php echo $resgetimportance['id']; ?>"
                          >
                            Delete
                          </button>
                        </td>
                      </tr>
                  <?php
                        $i++;
                      }
                    }
                  ?>
                  </tbody>
            </table>
          </div>
        

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
        <div class="section-heading">Group Filter</div>

        <!-- Section Content Starts -->
        <div class="section-content">
          
          <div class="add-filter-wrapper">
            <div class="section-sub-heading add-filter-comman">
              Add New Group Type : 
            </div>
            <div class="add-filter-form-wrapper add-filter-comman">
              <form id="add-group-filter-form">
                <input type="text" id="group-filter-name" name="group-filter-name">
                <input type="submit" id="group-filter-name-submit" name="group-filter-name-submit" value="Add Filter">
              </form>
            </div>
          </div>

          <div class="filter-list-wrapper">
            <div class="section-sub-heading add-filter-comman">
              Group Types : 
            </div>
            <table class="filter-table" cellpadding="0" cellspacing="0">
            <tr>
              <th>SrNo</th>
              <th>Filter Name</th>
              <th>Action</th>
            </tr>
            <?php

                  $sqlgetgroup = "select * from group_type";
                  $rowgetgroup = mysqli_query($con, $sqlgetgroup);

                  if (mysqli_num_rows($rowgetgroup) > 0)
                  {
                    $i = 0;
                    while ($i <= ($resgetgroup = mysqli_fetch_array($rowgetgroup)))
                    {
                  ?>
                      <tr>
                        <td><?php echo $i+1; ?></td>
                        <td>

                          <div class="filter-name" id="group-filter-name-<?php echo $resgetgroup['id']; ?>">
                            <?php echo $resgetgroup["name"]; ?>
                          </div>

                          <div class="filter-name-edit-input-wrapper" id="group-filter-name-edit-input-<?php echo $resgetgroup['id']; ?>" style="display: none;" >
                              <input 
                                type="text" 
                                id="edit-group-filter-name-<?php echo $resgetgroup['id']; ?>" 
                                name="edit-group-filter-name-<?php echo $resgetgroup['id']; ?>" 
                                value="<?php echo $resgetgroup["name"]; ?>" 
                              />
                              <button  
                                class="update-group-filter-btn" 
                                id="update-group-filter-btn-<?php echo $resgetgroup['id']; ?>" 
                                name="update-group-filter-btn-<?php echo $resgetgroup['id']; ?>" 
                                data-id="<?php echo $resgetgroup['id']; ?>" 
                                data-input-id="edit-group-filter-name-<?php echo $resgetgroup['id']; ?>"
                                data-input-wrapper-id="group-filter-name-edit-input-<?php echo $resgetgroup['id']; ?>"
                                data-filter-name-id="group-filter-name-<?php echo $resgetgroup['id']; ?>"
                                data-edit-btn-id="edit-group-<?php echo $resgetgroup['id']; ?>"
                              >
                                  Save
                              </button>
                              <button
                                class="cancel-update-group-filter-btn" 
                                data-input-id="edit-group-filter-name-<?php echo $resgetgroup['id']; ?>"
                                data-input-wrapper-id="group-filter-name-edit-input-<?php echo $resgetgroup['id']; ?>"
                                data-filter-name-id="group-filter-name-<?php echo $resgetgroup['id']; ?>"
                                data-edit-btn-id="edit-group-<?php echo $resgetgroup['id']; ?>"
                              >
                                Cancel
                              </button>
                            </form>
                          </div>

                        </td>
                        <td>
                          <button 
                            class="edit-group-btn action-btn" 
                            id="edit-group-<?php echo $resgetgroup['id']; ?>" 
                            data-id="<?php echo $resgetgroup['id']; ?>"
                            data-input-wrapper-id="group-filter-name-edit-input-<?php echo $resgetgroup['id']; ?>"
                            data-filter-name-id="group-filter-name-<?php echo $resgetgroup['id']; ?>" 
                          >
                            Edit
                          </button>
                          <button 
                            class="delete-group-btn action-btn" 
                            id="delete-group-<?php echo $resgetgroup['id']; ?>" 
                            data-id="<?php echo $resgetgroup['id']; ?>" 
                            data-input-id="edit-group-filter-name-<?php echo $resgetgroup['id']; ?>"
                            data-edit-btn-id="edit-group-<?php echo $resgetgroup['id']; ?>"
                            data-input-wrapper-id="group-filter-name-edit-input-<?php echo $resgetgroup['id']; ?>"
                            data-filter-name-id="group-filter-name-<?php echo $resgetgroup['id']; ?>"
                          >
                            Delete
                          </button>
                        </td>
                      </tr>
                  <?php
                        $i++;
                      }
                    }
                  ?>
            </table>
          </div>

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
        <div class="section-heading">Category Filter</div>

        <!-- Section Content Starts -->
        <div class="section-content">
          
          <div class="add-filter-wrapper">
            <div class="section-sub-heading add-filter-comman">
              Add New Category Type : 
            </div>
            <div class="add-filter-form-wrapper add-filter-comman">
              <form id="add-category-filter-form">
                <input type="text" id="category-filter-name" name="category-filter-name">
                <input type="submit" id="category-filter-name-submit" name="category-filter-name-submit" value="Add Filter">
              </form>
            </div>
          </div>

          <div class="filter-list-wrapper">
            <div class="section-sub-heading add-filter-comman">
              Category Types : 
            </div>
            <table class="filter-table" cellpadding="0" cellspacing="0">
            <tr>
              <th>SrNo</th>
              <th>Filter Name</th>
              <th>Action</th>
            </tr>
            <?php

                  $sqlgetcategory = "select * from category_type";
                  $rowgetcategory = mysqli_query($con, $sqlgetcategory);

                  if (mysqli_num_rows($rowgetcategory) > 0)
                  {
                    $i = 0;
                    while ($i <= ($resgetcategory = mysqli_fetch_array($rowgetcategory)))
                    {
                  ?>
                      <tr>
                        <td><?php echo $i+1; ?></td>
                        <td>

                          <div class="filter-name" id="category-filter-name-<?php echo $resgetcategory['id']; ?>">
                            <?php echo $resgetcategory["name"]; ?>
                          </div>

                          <div class="filter-name-edit-input-wrapper" id="category-filter-name-edit-input-<?php echo $resgetcategory['id']; ?>" style="display: none;" >
                              <input 
                                type="text" 
                                id="edit-category-filter-name-<?php echo $resgetcategory['id']; ?>" 
                                name="edit-category-filter-name-<?php echo $resgetcategory['id']; ?>" 
                                value="<?php echo $resgetcategory["name"]; ?>" 
                              />
                              <button  
                                class="update-category-filter-btn" 
                                id="update-category-filter-btn-<?php echo $resgetcategory['id']; ?>" 
                                name="update-category-filter-btn-<?php echo $resgetcategory['id']; ?>" 
                                data-id="<?php echo $resgetcategory['id']; ?>" 
                                data-input-id="edit-category-filter-name-<?php echo $resgetcategory['id']; ?>"
                                data-input-wrapper-id="category-filter-name-edit-input-<?php echo $resgetcategory['id']; ?>"
                                data-filter-name-id="category-filter-name-<?php echo $resgetcategory['id']; ?>"
                                data-edit-btn-id="edit-category-<?php echo $resgetcategory['id']; ?>"
                              >
                                  Save
                              </button>
                              <button
                                class="cancel-update-category-filter-btn" 
                                data-input-id="edit-category-filter-name-<?php echo $resgetcategory['id']; ?>"
                                data-input-wrapper-id="category-filter-name-edit-input-<?php echo $resgetcategory['id']; ?>"
                                data-filter-name-id="category-filter-name-<?php echo $resgetcategory['id']; ?>"
                                data-edit-btn-id="edit-category-<?php echo $resgetcategory['id']; ?>"
                              >
                                Cancel
                              </button>
                            </form>
                          </div>

                        </td>
                        <td>
                          <button 
                            class="edit-category-btn action-btn" 
                            id="edit-category-<?php echo $resgetcategory['id']; ?>" 
                            data-id="<?php echo $resgetcategory['id']; ?>"
                            data-input-wrapper-id="category-filter-name-edit-input-<?php echo $resgetcategory['id']; ?>"
                            data-filter-name-id="category-filter-name-<?php echo $resgetcategory['id']; ?>" 
                          >
                            Edit
                          </button>
                          <button 
                            class="delete-category-btn action-btn" 
                            id="delete-category-<?php echo $resgetcategory['id']; ?>" 
                            data-id="<?php echo $resgetcategory['id']; ?>" 
                            data-input-id="edit-category-filter-name-<?php echo $resgetcategory['id']; ?>"
                            data-edit-btn-id="edit-category-<?php echo $resgetcategory['id']; ?>"
                            data-input-wrapper-id="category-filter-name-edit-input-<?php echo $resgetcategory['id']; ?>"
                            data-filter-name-id="category-filter-name-<?php echo $resgetcategory['id']; ?>"
                          >
                            Delete
                          </button>
                        </td>
                      </tr>
                  <?php
                        $i++;
                      }
                    }
                  ?>
            </table>
          </div>

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
        <div class="section-heading">Related-to Filter</div>

        <!-- Section Content Starts -->
        <div class="section-content">
          
          <div class="add-filter-wrapper">
            <div class="section-sub-heading add-filter-comman">
              Add New Related-to Type : 
            </div>
            <div class="add-filter-form-wrapper add-filter-comman">
              <form id="add-related-to-filter-form">
                <input type="text" id="related-to-filter-name" name="related-to-filter-name">
                <input type="submit" id="related-to-filter-name-submit" name="related-to-filter-name-submit" value="Add Filter">
              </form>
            </div>
          </div>

          <div class="filter-list-wrapper">
            <div class="section-sub-heading add-filter-comman">
              Related-to Types : 
            </div>
            <table class="filter-table" cellpadding="0" cellspacing="0">
            <tr>
              <th>SrNo</th>
              <th>Filter Name</th>
              <th>Action</th>
            </tr>
            <?php

                  $sqlgetrelatedto = "select * from related_to";
                  $rowgetrelatedto = mysqli_query($con, $sqlgetrelatedto);

                  if (mysqli_num_rows($rowgetrelatedto) > 0)
                  {
                    $i = 0;
                    while ($i <= ($resgetrelatedto = mysqli_fetch_array($rowgetrelatedto)))
                    {
                  ?>
                      <tr>
                        <td><?php echo $i+1; ?></td>
                        <td>

                          <div class="filter-name" id="related-to-filter-name-<?php echo $resgetrelatedto['id']; ?>">
                            <?php echo $resgetrelatedto["name"]; ?>
                          </div>

                          <div class="filter-name-edit-input-wrapper" id="related-to-filter-name-edit-input-<?php echo $resgetrelatedto['id']; ?>" style="display: none;" >
                              <input 
                                type="text" 
                                id="edit-related-to-filter-name-<?php echo $resgetrelatedto['id']; ?>" 
                                name="edit-related-to-filter-name-<?php echo $resgetrelatedto['id']; ?>" 
                                value="<?php echo $resgetrelatedto["name"]; ?>" 
                              />
                              <button  
                                class="update-related-to-filter-btn" 
                                id="update-related-to-filter-btn-<?php echo $resgetrelatedto['id']; ?>" 
                                name="update-related-to-filter-btn-<?php echo $resgetrelatedto['id']; ?>" 
                                data-id="<?php echo $resgetrelatedto['id']; ?>" 
                                data-input-id="edit-related-to-filter-name-<?php echo $resgetrelatedto['id']; ?>"
                                data-input-wrapper-id="related-to-filter-name-edit-input-<?php echo $resgetrelatedto['id']; ?>"
                                data-filter-name-id="related-to-filter-name-<?php echo $resgetrelatedto['id']; ?>"
                                data-edit-btn-id="edit-related-to-<?php echo $resgetrelatedto['id']; ?>"
                              >
                                  Save
                              </button>
                              <button
                                class="cancel-update-related-to-filter-btn" 
                                data-input-id="edit-related-to-filter-name-<?php echo $resgetrelatedto['id']; ?>"
                                data-input-wrapper-id="related-to-filter-name-edit-input-<?php echo $resgetrelatedto['id']; ?>"
                                data-filter-name-id="related-to-filter-name-<?php echo $resgetrelatedto['id']; ?>"
                                data-edit-btn-id="edit-related-to-<?php echo $resgetrelatedto['id']; ?>"
                              >
                                Cancel
                              </button>
                            </form>
                          </div>

                        </td>
                        <td>
                          <button 
                            class="edit-related-to-btn action-btn" 
                            id="edit-related-to-<?php echo $resgetrelatedto['id']; ?>" 
                            data-id="<?php echo $resgetrelatedto['id']; ?>"
                            data-input-wrapper-id="related-to-filter-name-edit-input-<?php echo $resgetrelatedto['id']; ?>"
                            data-filter-name-id="related-to-filter-name-<?php echo $resgetrelatedto['id']; ?>" 
                          >
                            Edit
                          </button>
                          <button 
                            class="delete-related-to-btn action-btn" 
                            id="delete-related-to-<?php echo $resgetrelatedto['id']; ?>" 
                            data-id="<?php echo $resgetrelatedto['id']; ?>" 
                            data-input-id="edit-related-to-filter-name-<?php echo $resgetrelatedto['id']; ?>"
                            data-edit-btn-id="edit-related-to-<?php echo $resgetrelatedto['id']; ?>"
                            data-input-wrapper-id="related-to-filter-name-edit-input-<?php echo $resgetrelatedto['id']; ?>"
                            data-filter-name-id="related-to-filter-name-<?php echo $resgetrelatedto['id']; ?>"
                          >
                            Delete
                          </button>
                        </td>
                      </tr>
                  <?php
                        $i++;
                      }
                    }
                  ?>
            </table>
          </div>

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
        <div class="section-heading">Product Type Filter</div>

        <!-- Section Content Starts -->
        <div class="section-content">
          
          <div class="add-filter-wrapper">
            <div class="section-sub-heading add-filter-comman">
              Add New Product Type : 
            </div>
            <div class="add-filter-form-wrapper add-filter-comman">
              <form id="add-product-type-filter-form">
                <input type="text" id="product-type-filter-name" name="product-type-filter-name">
                <input type="submit" id="product-type-filter-name-submit" name="product-type-filter-name-submit" value="Add Filter">
              </form>
            </div>
          </div>
          
          <div class="filter-list-wrapper">
            <div class="section-sub-heading add-filter-comman">
              Product Types : 
            </div>
            <table class="filter-table" cellpadding="0" cellspacing="0">
            <tr>
              <th>SrNo</th>
              <th>Filter Name</th>
              <th>Action</th>
            </tr>
            <?php

                  $sqlgetproducttype = "select * from product_type";
                  $rowgetproducttype = mysqli_query($con, $sqlgetproducttype);

                  if (mysqli_num_rows($rowgetproducttype) > 0)
                  {
                    $i = 0;
                    while ($i <= ($resgetproducttype = mysqli_fetch_array($rowgetproducttype)))
                    {
                  ?>
                      <tr>
                        <td><?php echo $i+1; ?></td>
                        <td>

                          <div class="filter-name" id="product-type-filter-name-<?php echo $resgetproducttype['id']; ?>">
                            <?php echo $resgetproducttype["name"]; ?>
                          </div>

                          <div class="filter-name-edit-input-wrapper" id="product-type-filter-name-edit-input-<?php echo $resgetproducttype['id']; ?>" style="display: none;" >
                              <input 
                                type="text" 
                                id="edit-product-type-filter-name-<?php echo $resgetproducttype['id']; ?>" 
                                name="edit-product-type-filter-name-<?php echo $resgetproducttype['id']; ?>" 
                                value="<?php echo $resgetproducttype["name"]; ?>" 
                              />
                              <button  
                                class="update-product-type-filter-btn" 
                                id="update-product-type-filter-btn-<?php echo $resgetproducttype['id']; ?>" 
                                name="update-product-type-filter-btn-<?php echo $resgetproducttype['id']; ?>" 
                                data-id="<?php echo $resgetproducttype['id']; ?>" 
                                data-input-id="edit-product-type-filter-name-<?php echo $resgetproducttype['id']; ?>"
                                data-input-wrapper-id="product-type-filter-name-edit-input-<?php echo $resgetproducttype['id']; ?>"
                                data-filter-name-id="product-type-filter-name-<?php echo $resgetproducttype['id']; ?>"
                                data-edit-btn-id="edit-product-type-<?php echo $resgetproducttype['id']; ?>"
                              >
                                  Save
                              </button>
                              <button
                                class="cancel-update-product-type-filter-btn" 
                                data-input-id="edit-product-type-filter-name-<?php echo $resgetproducttype['id']; ?>"
                                data-input-wrapper-id="product-type-filter-name-edit-input-<?php echo $resgetproducttype['id']; ?>"
                                data-filter-name-id="product-type-filter-name-<?php echo $resgetproducttype['id']; ?>"
                                data-edit-btn-id="edit-product-type-<?php echo $resgetproducttype['id']; ?>"
                              >
                                Cancel
                              </button>
                            </form>
                          </div>

                        </td>
                        <td>
                          <button 
                            class="edit-product-type-btn action-btn" 
                            id="edit-product-type-<?php echo $resgetproducttype['id']; ?>" 
                            data-id="<?php echo $resgetproducttype['id']; ?>"
                            data-input-wrapper-id="product-type-filter-name-edit-input-<?php echo $resgetproducttype['id']; ?>"
                            data-filter-name-id="product-type-filter-name-<?php echo $resgetproducttype['id']; ?>" 
                          >
                            Edit
                          </button>
                          <button 
                            class="delete-product-type-btn action-btn" 
                            id="delete-product-type-<?php echo $resgetproducttype['id']; ?>" 
                            data-id="<?php echo $resgetproducttype['id']; ?>" 
                            data-input-id="edit-product-type-filter-name-<?php echo $resgetproducttype['id']; ?>"
                            data-edit-btn-id="edit-product-type-<?php echo $resgetproducttype['id']; ?>"
                            data-input-wrapper-id="product-type-filter-name-edit-input-<?php echo $resgetproducttype['id']; ?>"
                            data-filter-name-id="product-type-filter-name-<?php echo $resgetproducttype['id']; ?>"
                          >
                            Delete
                          </button>
                        </td>
                      </tr>
                  <?php
                        $i++;
                      }
                    }
                  ?>
            </table>
          </div>

        </div>
        <!-- Section Content End -->
      </div>
      <!-- Section Wrapper End -->
    </section>
    <!--X-X-X-X-X-X-X-X-X-X-X-X-X-X-X- Section End -X-X-X-X-X-X-X-X-X-X-X-X-X-X-X-->


    <!-------------------------------- Section Start ------------------------------------->

    <section class="body-section-main" style="display: none;">

      <!-- Section Wrapper Start -->
      <div class="section-wrapper">

        <!-- Section Heading -->
        <div class="section-heading">Related to Filter</div>

        <!-- Section Content Starts -->
        <div class="section-content">
          Related to Content
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
        $("#manage-filter-tab").addClass("active-tab ");
       
          $("#importance-table").tablesorter();
      });
    </script>
</body>
</html>