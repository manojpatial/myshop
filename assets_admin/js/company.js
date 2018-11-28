$(document).ready(function() {
	//alert('hello company');
	var base_url = $('#base').val();
	//alert('base_url');
	 $(document).on("change", "#companychangelogo", function() {
		// alert('company logo');
		var name = document.getElementById("companychangelogo").files[0].name;
		var form_data = new FormData(); 
		var ext = name.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{
		   alert("Invalid Image File");
		}
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("companychangelogo").files[0]);
		var f = document.getElementById("companychangelogo").files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
			alert("Image File Size is very big");
		}
		else
		{
		form_data.append("file", document.getElementById('companychangelogo').files[0]);
		$.ajax({
			 
			url: base_url+"Admin/change_company_logo",
			method:"POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend:function(){
			},   
			success:function(data)
			{
				var imageName = data;
				var Url = base_url+'assets/uploads/corporate-logo/'+imageName;
				
			   $('#change_image').show();
			  
			   $("#img-thumbnail").attr("src",Url);
			   $("#companylogo").val(imageName);
			}
	   });
	  }
	});
	
	
	/*****------chnage company logo-------*****/
	$(document).on("click", "#companylogochange", function() {
		//alert('companylogochange');
		var comapny_user_id = $("#comapny_user_id").val();
		//alert (comapny_user_id);
		var companylogo = $("#companylogo").val();
		//alert (companylogo);
		var dataString = {'comapny_user_id':comapny_user_id,'companylogo': companylogo,};
		$.ajax({
	          type: "POST",
              url: base_url+"Admin/change_companylogo/",
              data:dataString,
              //dataType: 'json',
              cache: false,
              success: function(result){
				  var imageName = result;
				var Url = base_url+'assets/uploads/corporate-logo/'+companylogo;
				//alert(Url);
			  
			  
			   $("#companylogo").attr("src",Url);
			  return false;
	            }
            });
	});
	
});