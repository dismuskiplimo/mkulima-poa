$(document).ready(function(){
	function update() { 
		 // Sends request to update.php
		setInterval(function(){
			$.ajax({
				url: 'js/chat/chatFunctions.php',
				method : 'POST',
				data : {method:'UPDATE_USER'},
				success: function(){
					console.log("updating");
				},
				error: function(){
					console.log("error updating");
				}
			})
		},10000);
	} 
	
	function getList() {
		setInterval(function(){
			$.ajax({
				url: 'js/chat/chatFunctions.php',
				dataType: 'json',
				method : 'POST',
				data : {method:'GET_USERS'},
				success: function(data){
					var people = '';
					var count = 0;
					
					if(data == null){
						$('.jq_list_header').html('no users online at the moment');
						$('#active_chats').html("<p>nobody is online :(</p>");
					}else{
						$(data.active).each(function(index, value){
							people = people + '<li><a class = "active_text" data-client= "' + value.id + '" title = "' + value.fname + ' ' + value.lname + '"><img src = "images/default.png"> ' + value.fname + ' ' + value.lname + '</div></a>';
							count++;
						});
						if(count ==1 ){
							$('#active_chats').html(people);
							$('.jq_list_header').html(''+count+' user online');	
						}
						
						if(count > 1 ){
							$('#active_chats').html(people);
							$('.jq_list_header').html(''+count+' users online');	
						}
						console.log('getting');
					}
					
				},
				error: function(err){
					console.log("error getting active list. " + err.responseText);
				}
			})
		},2000);
	} 
	
	update(); // Update every 10 seconds 
	getList(); // Get users-online every 10 seconds 
	var getmesso = '';
	function getMsg(recepient, name){
		
		var data = {method:'GET_USER_MESSAGES', recepient:recepient};
		$.ajax({
			url: 'js/chat/chatFunctions.php',
			method: 'POST',
			data: data,
			success: function(data){
				$('.chat_message').html(data);
				$('.jq_header').html(name);
				$('.message').scrollTop($('.chat_message')[0].scrollHeight);
			},
			error:function(){
				console.log('failed to open stream');
			}
		});
	}
	
	function updateMsg(recepient){
		
		var data = {method:'GET_USER_MESSAGES', recepient:recepient};
		$.ajax({
			url: 'js/chat/chatFunctions.php',
			method: 'POST',
			data: data,
			success: function(data){
				$('.chat_message').html(data);
				$('.message').scrollTop($('.chat_message')[0].scrollHeight);
			},
			error:function(){
				console.log('failed to open stream');
			}
		});
	}
	
	//send message
	function sendMsg(recepient, text){
		
		var data = {method:'SEND',recepient:recepient, text:text};
		$.ajax({
			url: 'js/chat/chatFunctions.php',
			method: 'POST',
			data: data,
			success: function(data){
				console.log(data);
			},
			error:function(){
				console.log('failed to open send message stream');
			}
		});
	}
	
	//select a chat
	$(document.body).on('click', '.active_text' ,function (e){
		var dt = $(this).data('client');
		var name = $(this).attr('title');
		$('.jq_chatbox').removeClass('hidden');
		$('.jq_chatbox').addClass('open');
		getMsg(dt,name);
		$('#send').data('recepient',dt);
		
	});
	
	//send message
	$('#send').click(function(){
		var text = $('#new_text').val();
		var recepient = $(this).data('recepient');
		sendMsg(recepient, text);
		updateMsg(recepient);
		$('#new_text').val('');
	});
});