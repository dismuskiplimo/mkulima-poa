$(document).ready(function(){
	(function($){
	$.fn.get_figures = function(user_request){
		var that = this;
		
			$.ajax({
				url: '',
				method : 'POST',
				data : {method:user_request},
				success: function(result){
					console.log(result);
					that.html(result);
				},
				error: function(){
					console.log("error getting figures");
					that.html(0);
				}
			});
		
	}
	}(jQuery));
	
	$("#submit_remove_cat").on('click',function(e){
		stat = confirm("Are you sure you want to delete category?");
		if(stat === false){
			e.preventDefault();
		}
	});
	
	$("#submit_remove_sub").on('click',function(e){
		stat = confirm("Are you sure you want to delete sub category?");
		if(stat === false){
			e.preventDefault();
		}
	});
});
