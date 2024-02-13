<?php
  if (session_status() == PHP_SESSION_NONE) 
  {
    session_start();
  }
      require_once "include/config.php";

  $srchfilter = "";
  
  if(isset($_POST['sq']) && isset($_POST['if']) && isset($_POST['gf']) && isset($_POST['cf']) && isset($_POST['rto']) && isset($_POST['pt']))
  {
    $srchqry = $_POST['sq'];
    $impfilter = $_POST['if'];
    $grfilter = $_POST['gf'];
    $catfilter = $_POST['cf'];
    $rtofilter = $_POST['rto'];
    $ptfilter = $_POST['pt'];


    if($srchqry != "")
    {
      $srchqry = trim($srchqry);

      if($srchfilter == "")
      {
        $srchfilter .= " (";
      }
      else
      {
        $srchfilter .= " OR (";
      }

      $srchfilter .= " 
        person_name LIKE '%".$srchqry."%' OR 
        company_name LIKE '%".$srchqry."%' OR 
        designation LIKE '%".$srchqry."%' OR  
        company_address_1 LIKE '%".$srchqry."%' OR  
        company_address_2 LIKE '%".$srchqry."%' OR  
        company_address_3 LIKE '%".$srchqry."%' OR  
        business_email LIKE '%".$srchqry."%' OR   
        personal_email LIKE '%".$srchqry."%' OR   
        mobile_no LIKE '%".$srchqry."%' OR  
        landline_no LIKE '%".$srchqry."%' OR  
        website LIKE '%".$srchqry."%' OR  
        residence_address_1 LIKE '%".$srchqry."%' OR  
        residence_address_2 LIKE '%".$srchqry."%' OR  
        residence_address_3 LIKE '%".$srchqry."%' OR  
        cr_limit LIKE '%".$srchqry."%') ";
    } 

    // Importance Filter
    if($impfilter != "0" && $impfilter != "")
    {
      if($srchfilter == "")
      {
        $srchfilter .= "";
      }
      else
      {
        $srchfilter .= " AND ";
      }

      $srchfilter .= " importance = '".$impfilter."' ";
    }

    // Group Filter
    if($grfilter != "0" && $grfilter != "")
    {
      if($srchfilter == "")
      {
        $srchfilter .= "";
      }
      else
      {
        $srchfilter .= " AND ";
      }

      $srchfilter .= " group_type = '".$grfilter."' ";
    }

    // Category Filter
    if($catfilter != "0" && $catfilter != "")
    {
      if($srchfilter == "")
      {
        $srchfilter .= "";
      }
      else
      {
        $srchfilter .= " AND ";
      }

      $srchfilter .= " category = '".$catfilter."' ";
    }

    // Related-to Filter
    if($rtofilter != "0" && $rtofilter != "")
    {
      if($srchfilter == "")
      {
        $srchfilter .= "";
      }
      else
      {
        $srchfilter .= " AND ";
      }

      $srchfilter .= " related_to = '".$rtofilter."' ";
    }

    // Product Type Filter
    if($ptfilter != "0" && $ptfilter != "")
    {
      if($srchfilter == "")
      {
        $srchfilter .= "";
      }
      else
      {
        $srchfilter .= " AND ";
      }

      $srchfilter .= " product_type = '".$ptfilter."' ";
    }

    if($srchfilter == "")
    {
      $whereclause = "";
    }
    else
    {
      $whereclause = " where ";
    }

    $srchfilter = $whereclause.$srchfilter;

  }

  // -- Page Size -- 
  if(isset($_POST['ps']))
  {
    $pagesize = (int)$_POST['ps'];
  }
  else
  {
    $pagesize = 5;
  }

  // -- Page Number -- 
  if(isset($_POST['pno']))
  {
    $pageno = (int)$_POST['pno'];
  }
  else
  {
    $pageno = 1;
  }

  $pageoffset = ($pageno * $pagesize) - $pagesize;

  $sqlcontactcount = "select COUNT(*) from contact ".$srchfilter;
  $rowcontactcount = mysqli_query($con,$sqlcontactcount);
  $rescontactcount = mysqli_fetch_array($rowcontactcount);

  $rowcount = (int)$rescontactcount["COUNT(*)"];
  $maxpagecount = $rowcount/$pagesize;
  $maxpagecount = ceil($maxpagecount);


  $limitfilter = " limit ".$pageoffset.",".$pagesize;
  $orderby = " order by id desc ";
?>          
            <?php

                  $sqlgetcontacts = "select * from contact ".$srchfilter.$orderby.$limitfilter;
                  $rowgetcontacts = mysqli_query($con, $sqlgetcontacts);

                  if(mysqli_num_rows($rowgetcontacts) > 0)
                  {
            ?>
          
            <div class="result-page-next-prv-btn-wrapper">
              <button class="contact-list-prev-btn" value="" style="display:none;">Prev</button>
              <button class="contact-list-next-btn" value="" style="display:none;">Next</button>
            </div>
          
          <table id="contact-sort-table" class="contact-table tablesorter" cellpadding="0" cellspacing="0">
            <thead>
              <tr>
                <th><input type="checkbox" id="select-all-checkbox" name="select-all-checkbox" />*</th>
                <th>SrNo</th>
                <th>Person Name</th>
                <th>Company Name</th>
                <th>Designation</th>
                <th>Business Email</th>
                <th>Mobile No.</th>
                <th>Website</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
                    $srno = $pageoffset+1;
                    $i = 0;
                    while ($i <= ($resgetcontacts = mysqli_fetch_array($rowgetcontacts)))
                    {
                  ?>
                      <tr>
                        <td><input class="contact-checkbox" type="checkbox" id="c-id-<?php echo $resgetcontacts['id']; ?>" name="c-id-<?php echo $resgetcontacts['id']; ?>" value="<?php echo $resgetcontacts['id']; ?>"></td>
                        <td><?php echo $srno; ?></td>
                        <td><?php echo $resgetcontacts["person_name"]; ?></td>
                        <td><?php echo $resgetcontacts["company_name"]; ?></td>
                        <td><?php echo $resgetcontacts["designation"]; ?></td>
                        <td><?php echo $resgetcontacts["business_email"]; ?></td>
                        <td><?php echo $resgetcontacts["mobile_no"]; ?></td>
                        <td><?php echo $resgetcontacts["website"]; ?></td>
                        <td>
                          <?php 
                            $editurl = getDomain()."/editcontact".getPageExt()."?i=".$resgetcontacts['id']."&h=".$resgetcontacts['hash'];
                          ?>
                          <a class="button" href="<?php echo $editurl; ?>">Edit</a>
                          <button class="delete-contact-btn action-btn" id="delete-contact-<?php echo $resgetcontacts['id']; ?>" data-id="<?php echo $resgetcontacts['id']; ?>" data-hash="<?php echo $resgetcontacts['hash']; ?>">Delete</button>
                        </td>
                      </tr>
                  <?php
                        $i++;
                        $srno++;
                      }
                  ?>
            </tbody>
          </table>
            <div class="result-page-next-prv-btn-wrapper">
              <button class="contact-list-prev-btn" value="" style="display: none;">Prev</button>
              <button class="contact-list-next-btn" value="" style="display: none;">Next</button>
            </div>
          <form method="post" id="extract-contact-form" action="printcontacts.php">
            <input type="hidden" id="selected-contact-arr-val" name="selected-contact-arr-val" />
            <input type="submit" id="extract-contact-form-submit" name="extract-contact-form-submit" value="Extract Selected" disabled="disabled">
          </form>
                  <?php
                    }
                    else
                    {
                  ?>
                      <div class="no-reslt-found-wrapper">No Matching Result Found !</div>
                  <?php
                    }
                  ?>

<?php
  
  
  $prevpageno = $pageno-1;
  $nextpageno = $pageno+1;

  if($prevpageno >= 1 && $prevpageno <= ($maxpagecount-1))
  {
?>
<script>
  $(document).ready(function(){
    $(".contact-list-prev-btn").show();
    $(".contact-list-prev-btn").val("<?php echo $prevpageno; ?>");
  });
</script>
<?php  
  }

  if($nextpageno >= 1 && $nextpageno <= $maxpagecount)
  {
?>
<script>
  $(document).ready(function(){
    $(".contact-list-next-btn").show();
    $(".contact-list-next-btn").val("<?php echo $nextpageno; ?>");
  });
</script>
<?php

  }
?>

