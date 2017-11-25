	//////////////////////////////////////////////////////////////////
	// These are functions in global scope hence not defined in .ready
	//////////////////////////////////////////////////////////////////
	/* wrapper function to make the ajax call
	 * if output contains redirect parameter then it will be redirected to the page
	 * url : contains the redirect url
	 * data : contains the post parameters
	 * actionFunction contains the response function
	 */
	function customAjaxCall(url, data, actionFunction,loadIcon){
		$.ajax({ 
			url: url,
	        data: data,
	        type: 'post',
	        dataType: "json",
		beforeSend: function() {
				if(loadIcon === 1){
                                           //to do loading
                                           
							$('.loading').show();
                                                    }
				  		},
		complete: function(){
			
		    				$('.loading').hide();
				  	  },	        
	        success: function(output) { 
                   
			    if (output.redirect) {
			        // data.redirect contains the string URL to redirect to
			        window.location.href = output.redirect;
			    }
                            else {
                               
			        //this is the function defined for the action 
			    	actionFunction(output);
			    }
	       }
		});
	}
        
        function imageUploadAjax(url, data, actionFunction){
            $.ajax({
                    url: url, // Url to which the request is send
                    type: "POST", 
                    dataType: "json",// Type of request to be send, called as method
                    data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    success: function(output){ 
                        actionFunction(output);
                    }
                    });
        }
        
        function changeMainBodyContent(output) { 
           
		$("#main").html(output.html);
              
	}
	
        //sweetalerts on response
        function sweet_alert(code, message) {
            if (code == "103") {

                swal({
                    title: '',
                    text: message,
                    timer: 1000,
                    type: 'success',
                    showConfirmButton:false,
                  });
            } else {
                   swal({
                        title: '',
                        text: message,
                        type: 'error',
                        showConfirmButton:true,
                      });
            }
        }