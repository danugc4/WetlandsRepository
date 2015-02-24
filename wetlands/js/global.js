$('#pretreatment-select').on('change', function() {
	var self = $(this);	 
	
	 $.ajax({
		url: 'http://sandbox.dev:8080/git/WetlandsRepository/wetlands/partials/wetlands.php',
		type: 'GET',
		data: { pretreatment: self.val() },
		success: function(data) {
			$('#wetlands-list').html(data);
		}	
	});
});