$(document).ready(function(){
	//initiallize stellar 
	$(window).stellar();
	
	//back to top Position
	$('.back_to_top').click(function(){
		$('body,html').animate({
			scrollTop: 0
		},2000,'easeInOutQuint');
	});
	
	
	//do smooth scrolling
	$('a').click(function(){
		if(this.hash){
			var no_hash = this.hash.substr(1);
			var $toElement = $('a[name=' + no_hash + ']');
			var toPosition = $toElement.offset();
				toPosition= toPosition.top;
			$('body,html').animate({
				scrollTop: toPosition
			},2000,'easeOutExpo');
			this.hash = "";
			return false;
		}
	});
	
	//get hash from url
	if(location.hash){
		var hash = location.hash;
		var target = window.location.hash;
		window.location.hash = "";
		window.scroll(0,0);
		$('a[href='+ hash +']').click();
	}
	
	
	//handle navbar while scrolling
	var docElement = $(document),
		nav = $('.navbar'),
		back_to_top = $('.back_to_top');
		lastScroll = 0;
	docElement.on('scroll', function(){
		currentScroll = $(this).scrollTop();
		if(currentScroll > 600){
			if(currentScroll > lastScroll){
				//hide navbar
				nav.addClass('scroll_nav');
			}
			else{
				//display navbar
				nav.removeClass('scroll_nav');
			}
			lastScroll = currentScroll;
			back_to_top.removeClass('hidden');
		}
		else{
			//display navbar
			nav.removeClass('scroll_nav');
			back_to_top.addClass('hidden');
		}
	});
	var email_stat = 2;
	var username_stat = 2;
	
	//.................login.............................
	$('#submit_info').on('click',function(e){
		var username = $("#username").val();
		var password = $("#password").val();
		$.ajax({
			url : 'process/processLogin.php',
			method : 'POST',
			data: {username:username,password:password},
			dataType: 'json',
			success : function(data){
				console.log(data);
				var status;
				var name;
				var img_url;
				$(data.item).each(function(index, value){
					status = value.status_id;
					if(status == 1 || status == 2){
						name = value.name;
						img_url = value.img_url;
					}
				});
				
				
				if(status == 0){
					swal("Ooops!", "Sorry, wrong username and or password!", "error")
				}
				
				if(status == 1){
					swal({
						title:name,
						html:true,						
						text:"<span style = \"font-size:3em\" class = \"fa fa-spin fa-cog\"></span>",
						imageUrl:img_url,
						imageSize:"300x300",
						confirmButtonText: "Proceed  to Dashboard"
					},function(){
						$(location).attr('href','dashboard.php');
					});
					setTimeout(function(){
						$(location).attr('href','dashboard.php');
					},3000);
				}
				
				if(status == 2){
					swal({
						title:name, 
						text:"<span style = \"font-size:3em\" class = \"fa fa-spin fa-cog\"></span>",
						html:true,
						imageUrl:img_url,
						imageSize:"300x300",
						confirmButtonText: "Proceed  to Dashboard"
					},function(){
						$(location).attr('href','admin.php');
					});
					
					setTimeout(function(){
						$(location).attr('href','admin.php');
					},2000);
				}
				
				if(status == 3){
					swal("Ooops!", "Sorry, we had an error connecting to our databases!", "error")
				}
				
				if(status == 4){
					swal("Ooops!", "Fill in the missing fields to proceed!", "error")
				}
			},
			error : function(){
				alert('error');
			}
			
		});
		e.preventDefault();
	});
	//......................./login......................
	 
	 
	//check if there's an existing user
	function validate_username(){
		$.post('process/processCheckExistence.php',{username:form_register.username.value},function(result){
			if(result == 0){
				$('.username_error').html("available");
				$('.username_status').addClass('has-success');
				$('.username_status').removeClass('has-error');
				username_stat = result;
			}
			if(result == 1){
				$('.username_error').html("already in use");
				$('.username_status').addClass('has-error');
				$('.username_status').removeClass('has-success');
				username_stat = result;
			}
			if(result == 2){
				$('.username_error').html("must be at least 4 characters");
				$('.username_status').addClass('has-error');
				$('.username_status').removeClass('has-success');
				username_stat = result;
			}
		});
	}
	
	//check if the email exists
	function validate_email(){
		$.post('process/processCheckExistence.php',{email:form_register.email.value},function(result){
			if(result == 0){
				$('.email_error').html("available");
				$('.email_status').addClass('has-success');
				$('.email_status').removeClass('has-error');
				email_stat = result;
			}
			if(result == 1){
				$('.email_error').html("already in use");
				$('.email_status').addClass('has-error');
				$('.email_status').removeClass('has-success');
				email_stat = result;
			}
			if(result == 2){
				$('.email_error').html("must be at least 4 characters");
				$('.email_status').addClass('has-error');
				$('.email_status').removeClass('has-success');
				email_stat = result;
			}
			if(result == 3){
				$('.email_error').html("provided is invalid");
				$('.email_status').addClass('has-error');
				$('.email_status').removeClass('has-success');
				email_stat = result;
			}
		});
	}
	$('#email_reg').on('blur', validate_email);
	$('#username_reg').on('blur', validate_username);
	
	//when form is submitted
	$('#form_register').submit(function(event){
		$('#email_reg').validate_email();
		$('#username_reg').validate_username();
		if(email_stat == 3 || username_stat == 2 || email_stat == 2 || username_stat == 1 || email_stat ==1  ){
			$('#message').html('<span class = "text-danger">Please make the corrections before proceeding</span>');
			$('body,html').animate({
				scrollTop: 0
			},2000,'easeInOutQuint');
			event.preventDefault();
		}
	});
	
	//initialize data table
	$('#weather').dataTable();
	$('.products').dataTable();
	
	//click on chat list
	$('.jq_list_header').click(function(){
		$('.jq_chat_list').toggleClass('open');
	});
	
	
	//click on chat
	$('.jq_header').click(function(){
		$('.jq_chatbox').toggleClass('open');
	});
	
	//nice scroll effects
	 $(".message, .inbox").niceScroll({cursorborder:"",cursorcolor:"rgb(71,97,124)",boxzoom:false,touchbehavior:true});
	 $(".jq_list_body").niceScroll({cursorborder:"",cursorcolor:"rgb(71,97,124)",boxzoom:false});
	 $(".links_container").niceScroll({cursorborder:"",cursorcolor:"rgb(71,97,124)",boxzoom:false,horizrailenabled: false,touchbehavior:true});
	 
	 $('.blue, .red').matchHeight();
	 
	 //..................intialize fancybox..........................
	$(".pretty").fancybox({
		
		padding: 0,

		openEffect : 'elastic',
		openSpeed  : 200,

		closeEffect : 'elastic',
		closeSpeed  : 300,

		closeClick : true,
		
		helpers : {
			overlay : {
				css : {
					'background' : 'rgba(0,0,0,0.8)'
				}
			}
		}
	});
	
	//............................logout ....................................
	$('.logout').on('click',function(e){
		swal(
		{
			title: "Logout  <i class = 'fa fa-meh-o'></i> ?",
			text: "Are you sure you want to logout?",
			showCancelButton: true,
			html: true,
			confirmButtonColor: "#ff4136",
			cancelButtonText: "No please",
			cancelButtonColor: "#fff",
			confirmButtonText: "Yes, log me out",
			closeOnConfirm: false
		},
			
		function(){
		  $(location).attr('href','logout.php');
		});
		
		e.preventDefault();
	});
	
	$('.add_item_to_market').on('click',function(e){
		var that = $(this);
		that.parents('tr').fadeOut();
		//tr.hide();
		
		e.preventDefault();
		
	});
	
	$('#print').on('click', function(){
		window.print();
	});
	
	
	
	//.................image slider........................................
	var wssI = 0;
	var wssArray = ['mkulima Fine', 'mkulima Awesome', '<span class = "text-warning">mkulima poa</span>', '<span class = "text-success">karibu</span>'];
	var wssElem = $('#wss');
	
	function wssNext(){
		wssI++;
		wssElem.css({'opacity' : '0'});
		
		if(wssI > wssArray.length - 1){
			wssI = 0;
		}
		
		setTimeout(wssSlide, 1000);
	}
	function wssSlide(){
		wssElem.html(wssArray[wssI]);
		wssElem.css({'opacity' : '1'});
		setTimeout(wssNext, 2000);
	}
	
	wssSlide();
	
	
	//..............................................................homepage image........
	var windowHeight = $(window).height() - 60;
	
	$('.fullscreen').height(windowHeight);
	$('.fullscreen h1').css({'margin-top' : (windowHeight / 3) + 'px'});

	$(window).resize(function(){
		var windowHeight = $(window).height() - 60;
		$('.fullscreen h1').css({'margin-top' : (windowHeight / 3) + 'px'});
		$('.fullscreen').height(windowHeight);
	});
	
	
	//initialize WOW
	wow = new WOW({
		animateClass: 'wow',
		offset:       100,
		mobile:       false,
		callback:     function(box) {
		  //function here
		}
	});
	wow.init();
	wow.sync();
});