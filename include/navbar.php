  <nav id="navbar-main" class="body-section-main" >
    <div class="section-wrapper" style="border:none;">
      <div class="nav-item-wrapper">
        <a href="<?php echo getDomain(); ?>"> <span id="home-tab" class="nav-item-name">Home</span> </a>
      </div>
      <div class="nav-item-wrapper">
        <a href="<?php echo getDomain().'/addcontact'.getPageExt(); ?>"> <span id="add-new-tab" class="nav-item-name">Add New</span> </a>
      </div>
      <div class="nav-item-wrapper">
        <a href="<?php echo getDomain().'/viewall'.getPageExt(); ?>"> <span id="view-all-tab" class="nav-item-name">View All</span> </a>
      </div>
      <div class="nav-item-wrapper">
        <a href="<?php echo getDomain().'/managefilters'.getPageExt(); ?>"> <span id="manage-filter-tab" class="nav-item-name">Manage Filters</span> </a>
      </div>
      <div class="nav-item-wrapper">
        <a href="<?php echo getDomain().'/savedlist'.getPageExt(); ?>"> <span id="saved-lists-tab" class="nav-item-name">Saved Lists</span> </a>
      </div>
    </div>
  </nav>