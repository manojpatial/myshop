	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script> 
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/coworker.js"></script>

	<script type="text/javascript">
	///// // ///  change lanuage dropdown menu url   	
   jQuery(document).ready( function() {
   jQuery('#Dropdownlanguage').change( function() {
      location.href = jQuery(this).val();
     });
   });
	
	</script>
</body>
</html>
 