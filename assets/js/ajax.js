	function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e){		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function get_students(url) {
		var class_id = document.getElementById('class_id').value;
		if( class_id == ""){
			alert('Please Select Class');
			return false;
		}else {
			var strURL=url+"ajax/get_students?class_id="+class_id;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('carry_fw').innerHTML=req.responseText;	
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET",strURL, true);
				req.send(null);
			}
		}
	} 
	
	function get_collection_report(url) {
		var class_id = document.getElementById('class_id').value;
		var year_id = document.getElementById('year_id').value;
		if( class_id == "" || year_id == ""){
			alert('Please Select Class AND Year');
			return false;
		}else {
			var strURL=url+"ajax/get_collection_report?class_id="+class_id+"&year_id="+year_id;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('collection_report').innerHTML=req.responseText;	
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET",strURL, true);
				req.send(null);
			}
		}
	} 
	