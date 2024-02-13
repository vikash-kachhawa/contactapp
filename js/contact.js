
function setCheckboxValue()
{
	var tempArray = [];
	$("input.contact-checkbox:checked").each(function(){
	    tempArray.push($(this).val());
	});
	tempArrayStr = tempArray.toString();
	if(tempArrayStr == "")
	{
		$("#extract-contact-form-submit").attr("disabled","disabled");
	}
	else
	{
		$("#extract-contact-form-submit").removeAttr("disabled");
	}

	$("#selected-contact-arr-val").val(tempArrayStr);
}

$(document).ready(function(){

	// Add Contact Form
	$("form#add-contact-form").on("submit",function(e){
		e.preventDefault();

		var formData = new FormData(this);

		if(formData.get('person-name') == "")
	    {
	        alert('Please enter person name.');
	    }
	    else if(!(formData.get('person-name').match(/^[a-zA-Z\s]*$/)))
	    {
	     	alert('Please enter a valid person name.');
	    }
	    else if(formData.get('company-name') == "")
	    {
	        alert('Please enter comapny name.');
	    }
	    else if(formData.get('designation') == "")
	    {
	        alert('Please enter designation.');
	    }
	    else
	    {
			$("#add-contact-form-submit").attr('disabled','disabled');
			$("#add-contact-form-submit").val("Adding...");
			$("#add-contact-form-submit").after("<div id='add-contact-form-spinner' style='text-align:center;'> <img alt='Loading' src='images/gif/spinner.gif' height='30' width='30'></div>");
		
			$.ajax({
			    type: "POST",
			    url: "php_action/createcontact.php",
			    data: formData,
			    dataType: 'JSON',
			    contentType: false,
	        	processData: false,
			    success: function(response) 
			    {
	                if(response.status == 1)
	                { 
	                	//window.location.href = response.rlink;
	                	$("form#add-contact-form")[0].reset();
	                	$("#add-contact-form-submit").removeAttr('disabled');
						$("#add-contact-form-submit").val("Add Contact");
						$("#add-contact-form-spinner").remove();
						alert(response.msg);	
	                }
	                else
	                {
							alert(response.msg); 
		        			$("#add-contact-form-submit").removeAttr('disabled');
							$("#add-contact-form-submit").val("Add Contact");
							$("#add-contact-form-spinner").remove();
	                }         			
	                	                			
	        	},
				error: function(response) 
				{		    	
			    	alert("Error : Failed to connect to server. Please contact your server admin."); 
					$("#add-contact-form-submit").removeAttr('disabled');
					$("#add-contact-form-submit").val("Add Card");
					$("#add-contact-form-spinner").remove();
				}
	  		});
		}

	});


	// Edit Contact Form
	$("form#edit-contact-form").on("submit",function(e){
		e.preventDefault();

		var formData = new FormData(this);

		if(formData.get('person-name') == "")
	    {
	        alert('Please enter person name.');
	    }
	    else if(!(formData.get('person-name').match(/^[a-zA-Z\s]*$/)))
	    {
	     	alert('Please enter a valid person name.');
	    }
	    else if(formData.get('company-name') == "")
	    {
	        alert('Please enter comapny name.');
	    }
	    else if(formData.get('designation') == "")
	    {
	        alert('Please enter designation.');
	    }
	    else
	    {
			$("#edit-contact-form-submit").attr('disabled','disabled');
			$("#edit-contact-form-submit").val("Updating...");
			$("#edit-contact-form-submit").after("<div id='edit-contact-form-spinner' style='text-align:center;'> <img alt='Loading' src='images/gif/spinner.gif' height='30' width='30'></div>");
		
			$.ajax({
			    type: "POST",
			    url: "php_action/updatecontact.php",
			    data: formData,
			    dataType: 'JSON',
			    contentType: false,
	        	processData: false,
			    success: function(response) 
			    {
	                if(response.status == 1)
	                { 
	                	//window.location.href = response.rlink;
						alert(response.msg);	
	                	$("#edit-contact-form-submit").removeAttr('disabled');
						$("#edit-contact-form-submit").val("Update Contact");
						$("#edit-contact-form-spinner").remove();
	                }
	                else
	                {
							alert(response.msg); 
		        			$("#edit-contact-form-submit").removeAttr('disabled');
							$("#edit-contact-form-submit").val("Update Contact");
							$("#edit-contact-form-spinner").remove();
	                }         			
	                	                			
	        	},
				error: function(response) 
				{		    	
			    	alert("Error : Failed to connect to server. Please contact your server admin."); 
					$("#edit-contact-form-submit").removeAttr('disabled');
					$("#edit-contact-form-submit").val("Update Contact");
					$("#edit-contact-form-spinner").remove();
				}
	  		});
		}

	});


	// Delete Contact Button
	$(document).on("click",".delete-contact-btn",function(){

		if(confirm("Are you sure you want to delete this contact ?"))
		{
			var eleid = "#"+$(this).attr("id");
			var cid = $(this).attr("data-id");
			var chash = $(this).attr("data-hash");

			$(eleid).attr('disabled','disabled');
			$(eleid).html("Deleting...");
			$(eleid).after("<img class='spinner-image' id='delete-contact-btn-spinner' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


			var dataArray = 
			{
				cidpost : cid,
				chashpost : chash
			};

			$.ajax({
			    type: "POST",
			    url: "php_action/deletecontact.php",
			    data: dataArray,
			    dataType: 'JSON',
				success: function(response) {
	                if(response.status == 1)
	                { 
	                	// alert(response.msg);
	                	// window.location.href = getDomain+"/viewall"+getPageExt;
	                	filterContactList(1);
	                }
	                else
	                {
	                	alert(response.msg);
						$(eleid).removeAttr('disabled');
						$(eleid).html("Delete");
						$("#delete-contact-btn-spinner").remove();

	                }         			
		                	                			
	            	},
	    			error: function(response) 
	    			{	
	    				alert(response.msg);	    	
		    			$(eleid).removeAttr('disabled');
						$(eleid).html("Delete");
						$("#delete-contact-btn-spinner").remove();

	    			}
		  	});

		}
	});


	// Add Selected Contacts to NEW List
	$("form#add-to-new-list-form").on("submit",function(e){
		e.preventDefault();

		var formid = $(this).attr("id");
		var submitbtnid = "#"+formid+"-submit";
		var spinnerid = formid+"-spinner";
		var btnval = "Create & Add";
		var btnprocessval = "Adding...";
		formid = "#"+formid;

		var formData = new FormData(this);

		if(formData.get("contact-arr-str") == "")
		{
			alert("No Contacts Selected");
		}
		else if(formData.get("list-name") == "")
		{
			alert("Please enter list name");
		}
		else
		{

			$(submitbtnid).attr('disabled','disabled');
          	$(submitbtnid).val(btnprocessval);  	
			$(submitbtnid).after("<img class='spinner-image' id='"+spinnerid+"' alt='Loading' src='images/gif/spinner.gif' height='30' width='30'>"); 	
          	
          	$.ajax(
	        {
	        	type: "POST",
	            url: "php_action/createlist.php",
	            data: formData,
	            dataType: 'JSON',
	            contentType: false,
	            processData: false,
	        })
	          //Success
	        .done(function(response) 
	        {
	            if(response.status == 1)
	            {  
	            	window.location.href = response.msg;
	            }
	            else
	            {
	              	alert(response.msg);
	            }               
	        })
	        //Error
	        .fail(function(response) 
	        {         
	            alert("Server Error : Invalid response from Server.");
	        })
	        // Always
	        .always(function() 
	        {         
	            $(submitbtnid).removeAttr('disabled');
	            $(submitbtnid).val(btnval);
				$("#"+spinnerid).remove();
	        });
		}

	});

	// Add Selected Contacts to SAVED List
	$("form#add-to-saved-list-form").on("submit",function(e){
		e.preventDefault();

		var formid = $(this).attr("id");
		var submitbtnid = "#"+formid+"-submit";
		var spinnerid = formid+"-spinner";
		var btnval = "Add";
		var btnprocessval = "Adding...";
		formid = "#"+formid;

		var formData = new FormData(this);

		if(formData.get("contact-arr-str") == "")
		{
			alert("No Contacts Selected");
		}
		else if(formData.get("list-id") == "0")
		{
			alert("Please select list");
		}
		else
		{

			$(submitbtnid).attr('disabled','disabled');
          	$(submitbtnid).val(btnprocessval);  	
			$(submitbtnid).after("<img class='spinner-image' id='"+spinnerid+"' alt='Loading' src='images/gif/spinner.gif' height='30' width='30'>"); 	
          	
          	$.ajax(
	        {
	        	type: "POST",
	            url: "php_action/addlistcontact.php",
	            data: formData,
	            dataType: 'JSON',
	            contentType: false,
	            processData: false,
	        })
	          //Success
	        .done(function(response) 
	        {
	            if(response.status == 1)
	            {  
	            	window.location.href = response.msg;
	            }
	            else
	            {
	              	alert(response.msg);
	            }               
	        })
	        //Error
	        .fail(function(response) 
	        {         
	            alert("Server Error : Invalid response from Server.");
	        })
	        // Always
	        .always(function() 
	        {         
	            $(submitbtnid).removeAttr('disabled');
	            $(submitbtnid).val(btnval);
				$("#"+spinnerid).remove();
	        });
		}

	});

	// Remove Contact From List Button
	$(document).on("click",".remove-list-contact-btn",function(){

		if(confirm("Are you sure you want to remove this contact ?"))
		{
			var eleid = "#"+$(this).attr("id");
			var cid = $(this).attr("data-contact-id");

			$(eleid).attr('disabled','disabled');
			$(eleid).html("Removing...");
			$(eleid).after("<img class='spinner-image' id='remove-contact-btn-spinner' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


			var dataArray = 
			{
				cidpost : cid,
				lidpost : listid
			};

			$.ajax({
			    type: "POST",
			    url: "php_action/removelistcontact.php",
			    data: dataArray,
			    dataType: 'JSON',
				success: function(response) {
	                if(response.status == 1)
	                { 
	                	// alert(response.msg);
	                	window.location.href = getDomain+"/viewlist"+getPageExt+"?i="+listid+"&h="+listhash;
	                }
	                else
	                {
	                	alert(response.msg);
						$(eleid).removeAttr('disabled');
						$(eleid).html("Remove");
						$("#remove-contact-btn-spinner").remove();

	                }         			
		                	                			
	            	},
	    			error: function(response) 
	    			{	
	    				alert(response.msg);	    	
		    			$(eleid).removeAttr('disabled');
						$(eleid).html("Remove");
						$("#remove-contact-btn-spinner").remove();

	    			}
		  	});

		}
	});


	// Delete List Button
	$(document).on("click",".delete-list-btn",function(){

		if(confirm("Are you sure you want to remove this list?"))
		{
			var eleid = "#"+$(this).attr("id");
			var lid = $(this).attr("data-list-id");
			var lhash = $(this).attr("data-list-hash");

			$(eleid).attr('disabled','disabled');
			$(eleid).html("Deleting...");
			$(eleid).after("<img class='spinner-image' id='delete-list-btn-spinner' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


			var dataArray = 
			{
				lidpost : lid,
				lhashpost : lhash
			};

			$.ajax({
			    type: "POST",
			    url: "php_action/deletelist.php",
			    data: dataArray,
			    dataType: 'JSON',
				success: function(response) {
	                if(response.status == 1)
	                { 
	                	// alert(response.msg);
	                	window.location.href = getDomain+"/savedlist"+getPageExt;
	                }
	                else
	                {
	                	alert(response.msg);
						$(eleid).removeAttr('disabled');
						$(eleid).html("Delete");
						$("#delete-list-btn-spinner").remove();

	                }         			
		                	                			
	            	},
	    			error: function(response) 
	    			{	
	    				alert(response.msg);	    	
		    			$(eleid).removeAttr('disabled');
						$(eleid).html("Delete");
						$("#delete-list-btn-spinner").remove();

	    			}
		  	});

		}
	});


// ========================= Manage Filters ==============================
	
	// --------------------- Importance Filter --------------------

	// Add Importance Filter
	$("form#add-importance-filter-form").on("submit",function(e){
		e.preventDefault();

		var formData = new FormData(this);

		if(formData.get('importance-filter-name') == "")
	    {
	        alert('Please enter filter name.');
	    }
	    else
	    {
			$("#importance-filter-name-submit").attr('disabled','disabled');
			$("#importance-filter-name-submit").val("Adding...");
			$("#importance-filter-name-submit").after("<div id='add-importance-filter-form-spinner' style='text-align:center;'> <img alt='Loading' src='images/gif/spinner.gif' height='30' width='30'></div>");
		
			$.ajax({
			    type: "POST",
			    url: "php_action/addimportancefilter.php",
			    data: formData,
			    dataType: 'JSON',
			    contentType: false,
	        	processData: false,
			    success: function(response) 
			    {
	                if(response.status == 1)
	                { 
	                	window.location.href = getDomain+"/managefilters"+getPageExt;
						// $("form#add-importance-filter-form")[0].reset();
						// $("#importance-filter-name-submit").removeAttr('disabled');
						// $("#importance-filter-name-submit").val("Add Filter");
						// $("#add-importance-filter-form-spinner").remove();	
	                }
	                else
	                {
							alert(response.msg); 
		        			$("#importance-filter-name-submit").removeAttr('disabled');
							$("#importance-filter-name-submit").val("Add Filter");
							$("#add-importance-filter-form-spinner").remove();
	                }         			
	                	                			
	        	},
				error: function(response) 
				{		    	
			    	alert("Error : Failed to connect to server. Please contact your server admin."); 
					$("#importance-filter-name-submit").removeAttr('disabled');
					$("#importance-filter-name-submit").val("Add Filter");
					$("#add-importance-filter-form-spinner").remove();
				}
	  		});
		}

	});


	// Edit Importance Filter Button
	$(".edit-importance-btn").on("click",function(){

		var eleid = "#"+$(this).attr("id");


		var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
		var filternameid = "#"+$(this).attr("data-filter-name-id");
		// var spinnerid = "update-importance-filter-btn-spinner"+fid;

		$(inputwrapperid).show();
		$(filternameid).hide();
		$(this).attr("disabled","disabled");
	});



	// Update Importance Filter

	$(".update-importance-filter-btn").on("click",function(){

			var inputid = "#"+$(this).attr("data-input-id");
			var inputvalue = $(inputid).val();

			if(inputvalue == "")
			{
				alert("Please enter filter name.");
			}
			else
			{

				var eleid = "#"+$(this).attr("id");
				var fid = $(this).attr("data-id");
				
				var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
				var filternameid = "#"+$(this).attr("data-filter-name-id");
				var editbtnid = "#"+$(this).attr("data-edit-btn-id");
				var spinnerid = "update-importance-filter-btn-spinner"+fid;

				$(eleid).attr('disabled','disabled');
				$(eleid).html("Saving...");
				$(eleid).after("<img class='spinner-image' id='"+spinnerid+"' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


				var dataArray = 
				{
					fidpost : fid,
					fnamepost : inputvalue
				};

				$.ajax({
				    type: "POST",
				    url: "php_action/updateimportancefilter.php",
				    data: dataArray,
				    dataType: 'JSON',
					success: function(response) {
		                if(response.status == 1)
		                { 
		                	// window.location.href = getDomain+"/managefilters"+getPageExt;
		                	$(filternameid).html(inputvalue);
							$(inputwrapperid).hide();
							$(filternameid).show();
							$(editbtnid).removeAttr("disabled");
							$(eleid).removeAttr('disabled');
							$(eleid).html("Save");
							$("#"+spinnerid).remove();
		                }
		                else
		                {
		                	alert(response.msg);
							$(eleid).removeAttr('disabled');
							$(eleid).html("Save");
							$("#"+spinnerid).remove();

		                }         			
			                	                			
		            	},
		    			error: function(response) 
		    			{	
		    				alert(response.msg);	    	
			    			$(eleid).removeAttr('disabled');
							$(eleid).html("Save");
							$("#"+spinnerid).remove();

		    			}
			  	});
			}

	});

	// Importance Filter Cancel Button
	$(".cancel-update-importance-filter-btn").on("click",function(){

		var eleid = "#"+$(this).attr("id");


		var inputid = "#"+$(this).attr("data-input-id");
		var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
		var filternameid = "#"+$(this).attr("data-filter-name-id");
		var filternamevalue = $(filternameid).html();
		var editbtnid = "#"+$(this).attr("data-edit-btn-id");

		$(inputwrapperid).hide();
		$(filternameid).show();
		$(editbtnid).removeAttr("disabled");
		$(inputid).val(filternamevalue.trim());

	});


	// Delete Importance Filter
	$(".delete-importance-btn").on("click",function(){

			if(confirm("Are you sure you want to delete this filter ?"))

			{
				var eleid = "#"+$(this).attr("id");
				var fid = $(this).attr("data-id");
				
				var inputid = "#"+$(this).attr("data-input-id");
				var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
				var filternameid = "#"+$(this).attr("data-filter-name-id");
				var filternamevalue = $(filternameid).html();
				var editbtnid = "#"+$(this).attr("data-edit-btn-id");
				var spinnerid = "delete-importance-filter-btn-spinner"+fid;

				$(inputwrapperid).hide();
				$(filternameid).show();
				$(editbtnid).attr("disabled","disabled");
				$(inputid).val(filternamevalue.trim());
				$(inputid).attr("disabled","disabled");

				
				$(eleid).attr('disabled','disabled');
				$(eleid).html("Deleting...");
				$(eleid).after("<img class='spinner-image' id='"+spinnerid+"' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


				var dataArray = 
				{
					fidpost : fid,
				};

				$.ajax({
				    type: "POST",
				    url: "php_action/deleteimportancefilter.php",
				    data: dataArray,
				    dataType: 'JSON',
					success: function(response) 
					{
		                if(response.status == 1)
		                { 
		                	window.location.href = getDomain+"/managefilters"+getPageExt;
		    	 			// $(filternameid).html(inputvalue);
							// $(inputwrapperid).hide();
							// $(filternameid).show();
							// $(editbtnid).removeAttr("disabled");
							// $(eleid).removeAttr('disabled');
							// $(eleid).html("Save");
							// $("#"+spinnerid).remove();
		                }
		                else
		                {
		                	alert(response.msg);
							$(eleid).removeAttr('disabled');
							$(eleid).html("Delete");
							$("#"+spinnerid).remove();
							$(inputwrapperid).hide();
							$(editbtnid).removeAttr("disabled");
							$(inputid).removeAttr("disabled");

		                }         			
			                	                			
	            	},
	    			error: function(response) 
	    			{	
	    				alert(response.msg);	    	
		    			$(eleid).removeAttr('disabled');
						$(eleid).html("Delete");
						$("#"+spinnerid).remove();
						$(inputwrapperid).hide();
						$(editbtnid).removeAttr("disabled");
						$(inputid).removeAttr("disabled");

	    			}
			  	});
			}

	});


	// --X-X-X-X-X-X-X-X-X-X-X- Importance Filter End -X-X-X-X-X-X-X-X-X-X--


	// --------------------- Group Filter --------------------

	// Add Group Filter
	$("form#add-group-filter-form").on("submit",function(e){
		e.preventDefault();

		var formData = new FormData(this);

		if(formData.get('group-filter-name') == "")
	    {
	        alert('Please enter filter name.');
	    }
	    else
	    {
			$("#group-filter-name-submit").attr('disabled','disabled');
			$("#group-filter-name-submit").val("Adding...");
			$("#group-filter-name-submit").after("<div id='add-group-filter-form-spinner' style='text-align:center;'> <img alt='Loading' src='images/gif/spinner.gif' height='30' width='30'></div>");
		
			$.ajax({
			    type: "POST",
			    url: "php_action/addgroupfilter.php",
			    data: formData,
			    dataType: 'JSON',
			    contentType: false,
	        	processData: false,
			    success: function(response) 
			    {
	                if(response.status == 1)
	                { 
	                	window.location.href = getDomain+"/managefilters"+getPageExt;
						
	                }
	                else
	                {
							alert(response.msg); 
		        			$("#group-filter-name-submit").removeAttr('disabled');
							$("#group-filter-name-submit").val("Add Filter");
							$("#add-group-filter-form-spinner").remove();
	                }         			
	                	                			
	        	},
				error: function(response) 
				{		    	
			    	alert("Error : Failed to connect to server. Please contact your server admin."); 
					$("#group-filter-name-submit").removeAttr('disabled');
					$("#group-filter-name-submit").val("Add Filter");
					$("#add-group-filter-form-spinner").remove();
				}
	  		});
		}

	});


	// Edit Group Filter Button
	$(".edit-group-btn").on("click",function(){

		var eleid = "#"+$(this).attr("id");


		var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
		var filternameid = "#"+$(this).attr("data-filter-name-id");

		$(inputwrapperid).show();
		$(filternameid).hide();
		$(this).attr("disabled","disabled");
	});



	// Update Group Filter

	$(".update-group-filter-btn").on("click",function(){

			var inputid = "#"+$(this).attr("data-input-id");
			var inputvalue = $(inputid).val();

			if(inputvalue == "")
			{
				alert("Please enter filter name.");
			}
			else
			{

				var eleid = "#"+$(this).attr("id");
				var fid = $(this).attr("data-id");
				
				var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
				var filternameid = "#"+$(this).attr("data-filter-name-id");
				var editbtnid = "#"+$(this).attr("data-edit-btn-id");
				var spinnerid = "update-group-filter-btn-spinner"+fid;

				$(eleid).attr('disabled','disabled');
				$(eleid).html("Saving...");
				$(eleid).after("<img class='spinner-image' id='"+spinnerid+"' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


				var dataArray = 
				{
					fidpost : fid,
					fnamepost : inputvalue
				};

				$.ajax({
				    type: "POST",
				    url: "php_action/updategroupfilter.php",
				    data: dataArray,
				    dataType: 'JSON',
					success: function(response) {
		                if(response.status == 1)
		                { 
		                	// window.location.href = getDomain+"/managefilters"+getPageExt;
		                	$(filternameid).html(inputvalue);
							$(inputwrapperid).hide();
							$(filternameid).show();
							$(editbtnid).removeAttr("disabled");
							$(eleid).removeAttr('disabled');
							$(eleid).html("Save");
							$("#"+spinnerid).remove();
		                }
		                else
		                {
		                	alert(response.msg);
							$(eleid).removeAttr('disabled');
							$(eleid).html("Save");
							$("#"+spinnerid).remove();

		                }         			
			                	                			
		            	},
		    			error: function(response) 
		    			{	
		    				alert(response.msg);	    	
			    			$(eleid).removeAttr('disabled');
							$(eleid).html("Save");
							$("#"+spinnerid).remove();

		    			}
			  	});
			}

	});

	// Group Filter Cancel Button
	$(".cancel-update-group-filter-btn").on("click",function(){

		var eleid = "#"+$(this).attr("id");


		var inputid = "#"+$(this).attr("data-input-id");
		var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
		var filternameid = "#"+$(this).attr("data-filter-name-id");
		var filternamevalue = $(filternameid).html();
		var editbtnid = "#"+$(this).attr("data-edit-btn-id");

		$(inputwrapperid).hide();
		$(filternameid).show();
		$(editbtnid).removeAttr("disabled");
		$(inputid).val(filternamevalue.trim());

	});


	// Delete Group Filter
	$(".delete-group-btn").on("click",function(){

			if(confirm("Are you sure you want to delete this filter ?"))
			{
				var eleid = "#"+$(this).attr("id");
				var fid = $(this).attr("data-id");
				
				var inputid = "#"+$(this).attr("data-input-id");
				var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
				var filternameid = "#"+$(this).attr("data-filter-name-id");
				var filternamevalue = $(filternameid).html();
				var editbtnid = "#"+$(this).attr("data-edit-btn-id");
				var spinnerid = "delete-group-filter-btn-spinner"+fid;

				$(inputwrapperid).hide();
				$(filternameid).show();
				$(editbtnid).attr("disabled","disabled");
				$(inputid).val(filternamevalue.trim());
				$(inputid).attr("disabled","disabled");

				
				$(eleid).attr('disabled','disabled');
				$(eleid).html("Deleting...");
				$(eleid).after("<img class='spinner-image' id='"+spinnerid+"' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


				var dataArray = 
				{
					fidpost : fid,
				};

				$.ajax({
				    type: "POST",
				    url: "php_action/deletegroupfilter.php",
				    data: dataArray,
				    dataType: 'JSON',
					success: function(response) 
					{
		                if(response.status == 1)
		                { 
		                	window.location.href = getDomain+"/managefilters"+getPageExt;
		    	 			// $(filternameid).html(inputvalue);
							// $(inputwrapperid).hide();
							// $(filternameid).show();
							// $(editbtnid).removeAttr("disabled");
							// $(eleid).removeAttr('disabled');
							// $(eleid).html("Save");
							// $("#"+spinnerid).remove();
		                }
		                else
		                {
		                	alert(response.msg);
							$(eleid).removeAttr('disabled');
							$(eleid).html("Delete");
							$("#"+spinnerid).remove();
							$(inputwrapperid).hide();
							$(editbtnid).removeAttr("disabled");
							$(inputid).removeAttr("disabled");
		                }         			
			                	                			
	            	},
	    			error: function(response) 
	    			{	
	    				alert(response.msg);	    	
		    			$(eleid).removeAttr('disabled');
						$(eleid).html("Delete");
						$("#"+spinnerid).remove();
						$(inputwrapperid).hide();
						$(editbtnid).removeAttr("disabled");
						$(inputid).removeAttr("disabled");

	    			}
			  	});
			}
	});


	// --X-X-X-X-X-X-X-X-X-X-X- Group Filter End -X-X-X-X-X-X-X-X-X-X--


	// --------------------- Category Filter --------------------

	// Add Category Filter
	$("form#add-category-filter-form").on("submit",function(e){
		e.preventDefault();

		var formData = new FormData(this);

		if(formData.get('category-filter-name') == "")
	    {
	        alert('Please enter filter name.');
	    }
	    else
	    {
			$("#category-filter-name-submit").attr('disabled','disabled');
			$("#category-filter-name-submit").val("Adding...");
			$("#category-filter-name-submit").after("<div id='add-category-filter-form-spinner' style='text-align:center;'> <img alt='Loading' src='images/gif/spinner.gif' height='30' width='30'></div>");
		
			$.ajax({
			    type: "POST",
			    url: "php_action/addcategoryfilter.php",
			    data: formData,
			    dataType: 'JSON',
			    contentType: false,
	        	processData: false,
			    success: function(response) 
			    {
	                if(response.status == 1)
	                { 
	                	window.location.href = getDomain+"/managefilters"+getPageExt;
						
	                }
	                else
	                {
							alert(response.msg); 
		        			$("#category-filter-name-submit").removeAttr('disabled');
							$("#category-filter-name-submit").val("Add Filter");
							$("#add-category-filter-form-spinner").remove();
	                }         			
	                	                			
	        	},
				error: function(response) 
				{		    	
			    	alert("Error : Failed to connect to server. Please contact your server admin."); 
					$("#category-filter-name-submit").removeAttr('disabled');
					$("#category-filter-name-submit").val("Add Filter");
					$("#add-category-filter-form-spinner").remove();
				}
	  		});
		}

	});


	// Edit Category Filter Button
	$(".edit-category-btn").on("click",function(){

		var eleid = "#"+$(this).attr("id");


		var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
		var filternameid = "#"+$(this).attr("data-filter-name-id");

		$(inputwrapperid).show();
		$(filternameid).hide();
		$(this).attr("disabled","disabled");
	});



	// Update Category Filter

	$(".update-category-filter-btn").on("click",function(){

			var inputid = "#"+$(this).attr("data-input-id");
			var inputvalue = $(inputid).val();

			if(inputvalue == "")
			{
				alert("Please enter filter name.");
			}
			else
			{

				var eleid = "#"+$(this).attr("id");
				var fid = $(this).attr("data-id");
				
				var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
				var filternameid = "#"+$(this).attr("data-filter-name-id");
				var editbtnid = "#"+$(this).attr("data-edit-btn-id");
				var spinnerid = "update-category-filter-btn-spinner"+fid;

				$(eleid).attr('disabled','disabled');
				$(eleid).html("Saving...");
				$(eleid).after("<img class='spinner-image' id='"+spinnerid+"' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


				var dataArray = 
				{
					fidpost : fid,
					fnamepost : inputvalue
				};

				$.ajax({
				    type: "POST",
				    url: "php_action/updatecategoryfilter.php",
				    data: dataArray,
				    dataType: 'JSON',
					success: function(response) {
		                if(response.status == 1)
		                { 
		                	// window.location.href = getDomain+"/managefilters"+getPageExt;
		                	$(filternameid).html(inputvalue);
							$(inputwrapperid).hide();
							$(filternameid).show();
							$(editbtnid).removeAttr("disabled");
							$(eleid).removeAttr('disabled');
							$(eleid).html("Save");
							$("#"+spinnerid).remove();
		                }
		                else
		                {
		                	alert(response.msg);
							$(eleid).removeAttr('disabled');
							$(eleid).html("Save");
							$("#"+spinnerid).remove();

		                }         			
			                	                			
		            	},
		    			error: function(response) 
		    			{	
		    				alert(response.msg);	    	
			    			$(eleid).removeAttr('disabled');
							$(eleid).html("Save");
							$("#"+spinnerid).remove();

		    			}
			  	});
			}

	});

	// Category Filter Cancel Button
	$(".cancel-update-category-filter-btn").on("click",function(){

		var eleid = "#"+$(this).attr("id");


		var inputid = "#"+$(this).attr("data-input-id");
		var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
		var filternameid = "#"+$(this).attr("data-filter-name-id");
		var filternamevalue = $(filternameid).html();
		var editbtnid = "#"+$(this).attr("data-edit-btn-id");

		$(inputwrapperid).hide();
		$(filternameid).show();
		$(editbtnid).removeAttr("disabled");
		$(inputid).val(filternamevalue.trim());

	});


	// Delete Category Filter
	$(".delete-category-btn").on("click",function(){

			if(confirm("Are you sure you want to delete this filter ?"))
			{
				var eleid = "#"+$(this).attr("id");
				var fid = $(this).attr("data-id");
				
				var inputid = "#"+$(this).attr("data-input-id");
				var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
				var filternameid = "#"+$(this).attr("data-filter-name-id");
				var filternamevalue = $(filternameid).html();
				var editbtnid = "#"+$(this).attr("data-edit-btn-id");
				var spinnerid = "delete-category-filter-btn-spinner"+fid;

				$(inputwrapperid).hide();
				$(filternameid).show();
				$(editbtnid).attr("disabled","disabled");
				$(inputid).val(filternamevalue.trim());
				$(inputid).attr("disabled","disabled");

				
				$(eleid).attr('disabled','disabled');
				$(eleid).html("Deleting...");
				$(eleid).after("<img class='spinner-image' id='"+spinnerid+"' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


				var dataArray = 
				{
					fidpost : fid,
				};

				$.ajax({
				    type: "POST",
				    url: "php_action/deletecategoryfilter.php",
				    data: dataArray,
				    dataType: 'JSON',
					success: function(response) 
					{
		                if(response.status == 1)
		                { 
		                	window.location.href = getDomain+"/managefilters"+getPageExt;
		    	 			// $(filternameid).html(inputvalue);
							// $(inputwrapperid).hide();
							// $(filternameid).show();
							// $(editbtnid).removeAttr("disabled");
							// $(eleid).removeAttr('disabled');
							// $(eleid).html("Save");
							// $("#"+spinnerid).remove();
		                }
		                else
		                {
		                	alert(response.msg);
							$(eleid).removeAttr('disabled');
							$(eleid).html("Delete");
							$("#"+spinnerid).remove();
							$(inputwrapperid).hide();
							$(editbtnid).removeAttr("disabled");
							$(inputid).removeAttr("disabled");
		                }         			
			                	                			
	            	},
	    			error: function(response) 
	    			{	
	    				alert(response.msg);	    	
		    			$(eleid).removeAttr('disabled');
						$(eleid).html("Delete");
						$("#"+spinnerid).remove();
						$(inputwrapperid).hide();
						$(editbtnid).removeAttr("disabled");
						$(inputid).removeAttr("disabled");

	    			}
			  	});
			}
	});


	// --X-X-X-X-X-X-X-X-X-X-X- Category Filter End -X-X-X-X-X-X-X-X-X-X--

	// --------------------- Related-to Filter --------------------

	// Add Related-to Filter
	$("form#add-related-to-filter-form").on("submit",function(e){
		e.preventDefault();

		var formData = new FormData(this);

		if(formData.get('related-to-filter-name') == "")
	    {
	        alert('Please enter filter name.');
	    }
	    else
	    {
			$("#related-to-filter-name-submit").attr('disabled','disabled');
			$("#related-to-filter-name-submit").val("Adding...");
			$("#related-to-filter-name-submit").after("<div id='add-related-to-filter-form-spinner' style='text-align:center;'> <img alt='Loading' src='images/gif/spinner.gif' height='30' width='30'></div>");
		
			$.ajax({
			    type: "POST",
			    url: "php_action/addrelatedtofilter.php",
			    data: formData,
			    dataType: 'JSON',
			    contentType: false,
	        	processData: false,
			    success: function(response) 
			    {
	                if(response.status == 1)
	                { 
	                	window.location.href = getDomain+"/managefilters"+getPageExt;
						
	                }
	                else
	                {
							alert(response.msg); 
		        			$("#related-to-filter-name-submit").removeAttr('disabled');
							$("#related-to-filter-name-submit").val("Add Filter");
							$("#add-related-to-filter-form-spinner").remove();
	                }         			
	                	                			
	        	},
				error: function(response) 
				{		    	
			    	alert("Error : Failed to connect to server. Please contact your server admin."); 
					$("#related-to-filter-name-submit").removeAttr('disabled');
					$("#related-to-filter-name-submit").val("Add Filter");
					$("#add-related-to-filter-form-spinner").remove();
				}
	  		});
		}

	});


	// Edit Related-to Filter Button
	$(".edit-related-to-btn").on("click",function(){

		var eleid = "#"+$(this).attr("id");


		var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
		var filternameid = "#"+$(this).attr("data-filter-name-id");

		$(inputwrapperid).show();
		$(filternameid).hide();
		$(this).attr("disabled","disabled");
	});



	// Update Related-to Filter

	$(".update-related-to-filter-btn").on("click",function(){

			var inputid = "#"+$(this).attr("data-input-id");
			var inputvalue = $(inputid).val();

			if(inputvalue == "")
			{
				alert("Please enter filter name.");
			}
			else
			{

				var eleid = "#"+$(this).attr("id");
				var fid = $(this).attr("data-id");
				
				var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
				var filternameid = "#"+$(this).attr("data-filter-name-id");
				var editbtnid = "#"+$(this).attr("data-edit-btn-id");
				var spinnerid = "update-related-to-filter-btn-spinner"+fid;

				$(eleid).attr('disabled','disabled');
				$(eleid).html("Saving...");
				$(eleid).after("<img class='spinner-image' id='"+spinnerid+"' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


				var dataArray = 
				{
					fidpost : fid,
					fnamepost : inputvalue
				};

				$.ajax({
				    type: "POST",
				    url: "php_action/updaterelatedtofilter.php",
				    data: dataArray,
				    dataType: 'JSON',
					success: function(response) {
		                if(response.status == 1)
		                { 
		                	// window.location.href = getDomain+"/managefilters"+getPageExt;
		                	$(filternameid).html(inputvalue);
							$(inputwrapperid).hide();
							$(filternameid).show();
							$(editbtnid).removeAttr("disabled");
							$(eleid).removeAttr('disabled');
							$(eleid).html("Save");
							$("#"+spinnerid).remove();
		                }
		                else
		                {
		                	alert(response.msg);
							$(eleid).removeAttr('disabled');
							$(eleid).html("Save");
							$("#"+spinnerid).remove();

		                }         			
			                	                			
		            	},
		    			error: function(response) 
		    			{	
		    				alert(response.msg);	    	
			    			$(eleid).removeAttr('disabled');
							$(eleid).html("Save");
							$("#"+spinnerid).remove();

		    			}
			  	});
			}

	});

	// Related-to Filter Cancel Button
	$(".cancel-update-related-to-filter-btn").on("click",function(){

		var eleid = "#"+$(this).attr("id");


		var inputid = "#"+$(this).attr("data-input-id");
		var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
		var filternameid = "#"+$(this).attr("data-filter-name-id");
		var filternamevalue = $(filternameid).html();
		var editbtnid = "#"+$(this).attr("data-edit-btn-id");

		$(inputwrapperid).hide();
		$(filternameid).show();
		$(editbtnid).removeAttr("disabled");
		$(inputid).val(filternamevalue.trim());

	});


	// Delete Related-to Filter
	$(".delete-related-to-btn").on("click",function(){

			if(confirm("Are you sure you want to delete this filter ?"))
			{
				var eleid = "#"+$(this).attr("id");
				var fid = $(this).attr("data-id");
				
				var inputid = "#"+$(this).attr("data-input-id");
				var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
				var filternameid = "#"+$(this).attr("data-filter-name-id");
				var filternamevalue = $(filternameid).html();
				var editbtnid = "#"+$(this).attr("data-edit-btn-id");
				var spinnerid = "delete-related-to-filter-btn-spinner"+fid;

				$(inputwrapperid).hide();
				$(filternameid).show();
				$(editbtnid).attr("disabled","disabled");
				$(inputid).val(filternamevalue.trim());
				$(inputid).attr("disabled","disabled");

				
				$(eleid).attr('disabled','disabled');
				$(eleid).html("Deleting...");
				$(eleid).after("<img class='spinner-image' id='"+spinnerid+"' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


				var dataArray = 
				{
					fidpost : fid,
				};

				$.ajax({
				    type: "POST",
				    url: "php_action/deleterelatedtofilter.php",
				    data: dataArray,
				    dataType: 'JSON',
					success: function(response) 
					{
		                if(response.status == 1)
		                { 
		                	window.location.href = getDomain+"/managefilters"+getPageExt;
		    	 			// $(filternameid).html(inputvalue);
							// $(inputwrapperid).hide();
							// $(filternameid).show();
							// $(editbtnid).removeAttr("disabled");
							// $(eleid).removeAttr('disabled');
							// $(eleid).html("Save");
							// $("#"+spinnerid).remove();
		                }
		                else
		                {
		                	alert(response.msg);
							$(eleid).removeAttr('disabled');
							$(eleid).html("Delete");
							$("#"+spinnerid).remove();
							$(inputwrapperid).hide();
							$(editbtnid).removeAttr("disabled");
							$(inputid).removeAttr("disabled");
		                }         			
			                	                			
	            	},
	    			error: function(response) 
	    			{	
	    				alert(response.msg);	    	
		    			$(eleid).removeAttr('disabled');
						$(eleid).html("Delete");
						$("#"+spinnerid).remove();
						$(inputwrapperid).hide();
						$(editbtnid).removeAttr("disabled");
						$(inputid).removeAttr("disabled");

	    			}
			  	});
			}
	});


	// --X-X-X-X-X-X-X-X-X-X-X- Related-to Filter End -X-X-X-X-X-X-X-X-X-X--

	// --------------------- Product Type Filter --------------------

  // Add Product Type Filter
  $("form#add-product-type-filter-form").on("submit",function(e){
    e.preventDefault();

    var formData = new FormData(this);

    if(formData.get('product-type-filter-name') == "")
      {
          alert('Please enter filter name.');
      }
      else
      {
      $("#product-type-filter-name-submit").attr('disabled','disabled');
      $("#product-type-filter-name-submit").val("Adding...");
      $("#product-type-filter-name-submit").after("<div id='add-product-type-filter-form-spinner' style='text-align:center;'> <img alt='Loading' src='images/gif/spinner.gif' height='30' width='30'></div>");
    
      $.ajax({
          type: "POST",
          url: "php_action/addproducttypefilter.php",
          data: formData,
          dataType: 'JSON',
          contentType: false,
            processData: false,
          success: function(response) 
          {
                  if(response.status == 1)
                  { 
                    window.location.href = getDomain+"/managefilters"+getPageExt;
            
                  }
                  else
                  {
              alert(response.msg); 
                  $("#product-type-filter-name-submit").removeAttr('disabled');
              $("#product-type-filter-name-submit").val("Add Filter");
              $("#add-product-type-filter-form-spinner").remove();
                  }               
                                          
            },
        error: function(response) 
        {         
            alert("Error : Failed to connect to server. Please contact your server admin."); 
          $("#product-type-filter-name-submit").removeAttr('disabled');
          $("#product-type-filter-name-submit").val("Add Filter");
          $("#add-product-type-filter-form-spinner").remove();
        }
        });
    }

  });


  // Edit Product Type Filter Button
  $(".edit-product-type-btn").on("click",function(){

    var eleid = "#"+$(this).attr("id");


    var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
    var filternameid = "#"+$(this).attr("data-filter-name-id");

    $(inputwrapperid).show();
    $(filternameid).hide();
    $(this).attr("disabled","disabled");
  });



  // Update Product Type Filter

  $(".update-product-type-filter-btn").on("click",function(){

      var inputid = "#"+$(this).attr("data-input-id");
      var inputvalue = $(inputid).val();

      if(inputvalue == "")
      {
        alert("Please enter filter name.");
      }
      else
      {

        var eleid = "#"+$(this).attr("id");
        var fid = $(this).attr("data-id");
        
        var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
        var filternameid = "#"+$(this).attr("data-filter-name-id");
        var editbtnid = "#"+$(this).attr("data-edit-btn-id");
        var spinnerid = "update-product-type-filter-btn-spinner"+fid;

        $(eleid).attr('disabled','disabled');
        $(eleid).html("Saving...");
        $(eleid).after("<img class='spinner-image' id='"+spinnerid+"' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


        var dataArray = 
        {
          fidpost : fid,
          fnamepost : inputvalue
        };

        $.ajax({
            type: "POST",
            url: "php_action/updateproducttypefilter.php",
            data: dataArray,
            dataType: 'JSON',
          success: function(response) {
                    if(response.status == 1)
                    { 
                      // window.location.href = getDomain+"/managefilters"+getPageExt;
                      $(filternameid).html(inputvalue);
              $(inputwrapperid).hide();
              $(filternameid).show();
              $(editbtnid).removeAttr("disabled");
              $(eleid).removeAttr('disabled');
              $(eleid).html("Save");
              $("#"+spinnerid).remove();
                    }
                    else
                    {
                      alert(response.msg);
              $(eleid).removeAttr('disabled');
              $(eleid).html("Save");
              $("#"+spinnerid).remove();

                    }               
                                              
                  },
              error: function(response) 
              { 
                alert(response.msg);        
                $(eleid).removeAttr('disabled');
              $(eleid).html("Save");
              $("#"+spinnerid).remove();

              }
          });
      }

  });

  // Product Type Filter Cancel Button
  $(".cancel-update-product-type-filter-btn").on("click",function(){

    var eleid = "#"+$(this).attr("id");


    var inputid = "#"+$(this).attr("data-input-id");
    var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
    var filternameid = "#"+$(this).attr("data-filter-name-id");
    var filternamevalue = $(filternameid).html();
    var editbtnid = "#"+$(this).attr("data-edit-btn-id");

    $(inputwrapperid).hide();
    $(filternameid).show();
    $(editbtnid).removeAttr("disabled");
    $(inputid).val(filternamevalue.trim());

  });


  // Delete Product Type Filter
  $(".delete-product-type-btn").on("click",function(){

      if(confirm("Are you sure you want to delete this filter ?"))
      {
        var eleid = "#"+$(this).attr("id");
        var fid = $(this).attr("data-id");
        
        var inputid = "#"+$(this).attr("data-input-id");
        var inputwrapperid = "#"+$(this).attr("data-input-wrapper-id");
        var filternameid = "#"+$(this).attr("data-filter-name-id");
        var filternamevalue = $(filternameid).html();
        var editbtnid = "#"+$(this).attr("data-edit-btn-id");
        var spinnerid = "delete-product-type-filter-btn-spinner"+fid;

        $(inputwrapperid).hide();
        $(filternameid).show();
        $(editbtnid).attr("disabled","disabled");
        $(inputid).val(filternamevalue.trim());
        $(inputid).attr("disabled","disabled");

        
        $(eleid).attr('disabled','disabled');
        $(eleid).html("Deleting...");
        $(eleid).after("<img class='spinner-image' id='"+spinnerid+"' alt='Loading' src='images/gif/spinner.gif' height='20' width='20'>");


        var dataArray = 
        {
          fidpost : fid,
        };

        $.ajax({
            type: "POST",
            url: "php_action/deleteproducttypefilter.php",
            data: dataArray,
            dataType: 'JSON',
          success: function(response) 
          {
                    if(response.status == 1)
                    { 
                      window.location.href = getDomain+"/managefilters"+getPageExt;
                // $(filternameid).html(inputvalue);
              // $(inputwrapperid).hide();
              // $(filternameid).show();
              // $(editbtnid).removeAttr("disabled");
              // $(eleid).removeAttr('disabled');
              // $(eleid).html("Save");
              // $("#"+spinnerid).remove();
                    }
                    else
                    {
                      alert(response.msg);
              $(eleid).removeAttr('disabled');
              $(eleid).html("Delete");
              $("#"+spinnerid).remove();
              $(inputwrapperid).hide();
              $(editbtnid).removeAttr("disabled");
              $(inputid).removeAttr("disabled");
                    }               
                                              
                },
            error: function(response) 
            { 
              alert(response.msg);        
              $(eleid).removeAttr('disabled');
            $(eleid).html("Delete");
            $("#"+spinnerid).remove();
            $(inputwrapperid).hide();
            $(editbtnid).removeAttr("disabled");
            $(inputid).removeAttr("disabled");

            }
          });
      }
  });


  // --X-X-X-X-X-X-X-X-X-X-X- Product Type Filter End -X-X-X-X-X-X-X-X-X-X--


// ========================= Contact Filter Operations ===========================

	// --------------------- Select All Checkbox ---------------------------

	$(document).on("click","#select-all-checkbox",function () {
	    $(".contact-checkbox").prop('checked', $(this).prop('checked'));
	    setCheckboxValue();
	});

	// --------------------- Uncheck Select All Checkbox ---------------------------

	$(document).on("click",".contact-checkbox",function () {
	    if(!$(this).is(":checked"))
	    {
	    	$("#select-all-checkbox").prop('checked',false);
	    }
	    setCheckboxValue();
	});


});