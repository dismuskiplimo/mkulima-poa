<?php 
	$name = "messages";
	require_once("includes/core.inc.php");
	require_once("includes/userSession.inc.php");
	
	$sessionDetails = $_SESSION['mkulimaUserDetails'];
	$id = $sessionDetails['id'];
	
	//select messages from the message table
	
	$output = '';
	$title = 'MESSAGES';
	
	if($messages = $message->getMessages($id, 'INBOX')){
		$mess = '';
		$title = 'INBOX';
		
		$output.= '<table class = "table no_decoration table-condensed table-hover table-bordered" style = "font-size:0.8em;">';
			$output.= '<tr>';
				
				$output.= '<th>Sender</th>';
				$output.= '<th>Message</th>';
				$output.= '<th>Date and Time</th>';
			$output.= '</tr>';
			
			foreach($messages as $inbox){
				$messageId = $inbox['messageId'];
				$fullName = $inbox['fname'] . ' ' . $inbox['lname'];
				
				$output.= $inbox['readStatus'] == 0 ? '<tr class = "active">' : '<tr>';
					
					$output.= '<td style = "width:200px;"><a href = "messages.php?id=' . $messageId . '">' . $fullName . '</a></td>';
					$output.= '<td><a href = "messages.php?id=' . $messageId . '">' . $inbox['message'] . '</a></td>';
					$output.= '<td style = "width:150px;"><a href = "messages.php?id=' . $messageId . '">' . check_date($inbox['dateCreated']).', '. check_time($inbox['dateCreated']) . '</a></td>';
				$output.= '</tr>';
			}
			
		$output.= '</table>';
	}
	
	else{
		$output.= '<h4>' . $message->error() . '</h4>';
	}
			
	// check for message selection
	if(isset($_GET['id']) && !empty($_GET['id']) && !isset($_GET['action'])){
		$output = '';
		
		$messageId = htmlentities($_GET['id']);
		
		
		
		if(isset($_POST['submit'])){
			if(isset($_POST['text']) && !empty($_POST['text'])){
				$text = htmlentities($_POST['text']);
				$recepient = htmlentities($_POST['recepient']);
				
				if($r = $user->getUserDetails($recepient)){
				
					if($message->newMessage($sessionDetails['id'], $recepient, $text)){
						redirect_to('messages.php?action=outbox');
					}
					
					else{
						$output.= '<p>'. $message->error() .'</p>';
						$output.= '<p><a href = "messages.php?action=compose"><span class = "glyphicon glyphicon-envelope"></span> Compose again</a></p>';
					}
				}
				
				else{
					$output.= '<p>Message not sent, the selected user does not exist</p>';
					$output.= '<p><a href = "messages.php?action=compose"><span class = "glyphicon glyphicon-envelope"></span> Compose again</a></p>';
				}
				
			}
		}
		
		//.....................fetch messages
		if($messo = $message->getMessages($messageId, 'WHERE messages.id = ? ')){
			$output.='<form action = "" method = "post">';
				$output.='<input type = "hidden" name = "id" value = "' . urlencode(htmlentities($messageId)) . '" />';
				$output.='<button class = "btn btn-danger fl_r" style = "margin-top:-45px;" type = "submit" name = "delete_message">Delete Message</button>';
			$output.='</form>';
		
			$output.='<div class = "inbox form" style = "margin-top:20px;">';
				$output.='<div class = "new_messages">';
				
				foreach($messo as $messages){
					
					$fullName = $messages['fname'] . ' ' . $messages['lname'];
					$chat = $fullName;
					$title = strtoupper($fullName);
						
					$output.= '<div class = "not_mine">'; 
						$output.= '<p class = "name">'  . $fullName . '</p>';
						$output.= '<p class = "mes">'  . $messages['message'] . '</p>';
						$output.= '<span class = "time"><span class = "glyphicon glyphicon-time"></span> '  . check_date($messages['dateCreated']). ', ' . check_time($messages['dateCreated']) . '</span>';
					$output.= '</div>'; 
				}
				$output.= '</div>';
			$output.= '</div>';
			
			$output.= '<div>';
				$output.= '<form action = "?id=' . urlencode(htmlentities($messageId)) . '" method = "post" style = margin-top:20px;margin-bottom:20px;"" class = "hundred">';
					$output.= '<textarea placeholder = "message" name = "text" class = "form-control"></textarea>';
					$output.= '<input type = "hidden" name = "recepient" value = ' . $messages['recepientId'] . ' />';
					$output.= '<button class = "btn btn-info fl_r" style = "margin-top:10px;" name = "submit">Send <span class = "fa fa-send"></span></button>';
				$output.= '</form>';
				$output.= '<p><a href = "messages.php"><span class = "glyphicon glyphicon-arrow-left"></span> Back to inbox</a></p>';
			$output.= '</div>';
			$output.='<script>$(document).ready(function(){$(".inbox").scrollTop($(".new_messages")[0].scrollHeight)});</script>';
				
		}
		else{
			die('error');
		}
					
	}
	
	//..................fetch outbox.....................
	
	if(isset($_GET['action']) && $_GET['action'] == 'outbox'){
		$output = '';
		
		$outbox = '';
		$title = 'SENT';
		
		if($messages = $message->getMessages($id, 'OUTBOX')){
			$output.= '<table class = "table no_decoration table-condensed table-hover table-bordered" style = "font-size:0.8em;">';
				$output.= '<tr>';
					
					$output.= '<th>Recepient</th>';
					$output.= '<th>Message</th>';
					$output.= '<th>Date and Time</th>';
				$output.= '</tr>';
				
				foreach($messages as $inbox){
					$messageId = $inbox['messageId'];
					$fullName = $inbox['fname'] . ' ' . $inbox['lname'];
					
					$output.= $inbox['readStatus'] == 0 ? '<tr class = "active">' : '<tr>';
						
						$output.= '<td style = "width:200px;"><a href = "messages.php?id=' . $messageId . '">' . $fullName . '</a></td>';
						$output.= '<td><a href = "messages.php?id=' . $messageId . '">' . $inbox['message'] . '</a></td>';
						$output.= '<td style = "width:150px;"><a href = "messages.php?id=' . $messageId . '">' . check_date($inbox['dateCreated']).', '. check_time($inbox['dateCreated']) . '</a></td>';
					$output.= '</tr>';
				}
				
			$output.= '</table>';
		}
		
		else{
			$output.= '<h4>' . $message->error() . '</h4>';
		}
				
	}
	
	if(isset($_GET['action']) && $_GET['action'] == 'compose'){
		$compose = '';
		$title = 'COMPOSE MESSAGE';
		
		$output = '';
		$chat = '';
		$rec = isset($_GET['recepient']) && !empty($_GET['recepient']) ? $_GET['recepient'] : '';
		$output.= '<form action = "" method = "post" class = "hundred">';
			$output.='<div class = "form-group">';
				$output.='<label for = "recepient">Recepient\'s username</label>';
				
				
				$output .= '<select name = "recepient" id = "recepient" class = "form-control">';
				
					if($users = $user->getAllUserDetails($sessionDetails['id'])){
						
						foreach($users as $detail){
							$fullName = $detail['fname'] . ' ' . $detail['lname'];
							$output .= '<option value = "' . $detail['id'] . '">' . $fullName . '</option>';
						}
					}
					else{
						$output .= '<option value = ""> --' . $user->error() . '-- </option>';
					}
				
				$output .= '</select>';
			
			$output.='</div>';
			$output.='<div class = "form-group">';
				$output.='<label for = "text_message">Message</label>';
				$output.= '<textarea placeholder = "message" id = "text_message" required aria-required = "required" name = "text" style = "margin-top:10px;" class = "form-control"></textarea>';
			$output.='</div>';
			$output.= '<button class = "btn btn-info fl_r" style = "margin-top:10px;" name = "compose">Send <span class = "fa fa-send"></span></button>';
		$output.= '</form>';
	}
	
	//...................verify message and send........................
	if(isset($_POST['compose'])){
		$compose = '';
		
		$output = '';
		
		$requredFields = ['recepient','text'];
		$missingFields = [];
		
		foreach($requredFields as $field){
			if(!isset($_POST[$field]) || empty($_POST[$field])){
				$missingFields[] = $field;
			}
		}
		
		if(!$missingFields){
			foreach($_POST as $key => $value){
				${$key} = htmlentities(trim($value));
			}
			
			if($r = $user->getUserDetails($recepient)){
				
				if($message->newMessage($sessionDetails['id'], $recepient, $text)){
					redirect_to('messages.php?action=outbox');
				}
				
				else{
					$output.= '<p>'. $message->error() .'</p>';
					$output.= '<p><a href = "messages.php?action=compose"><span class = "glyphicon glyphicon-envelope"></span> Compose again</a></p>';
				}
			}
			
			else{
				$output.= '<p>Message not sent, the selected user does not exist</p>';
				$output.= '<p><a href = "messages.php?action=compose"><span class = "glyphicon glyphicon-envelope"></span> Compose again</a></p>';
			}
		}
		
		else{
			$output.='<p>Please fill in the following field(s) before sending : <strong>' . implode(', ', $missingFields) . '</strong></p>';
			$output.= '<p><a href = "messages.php?action=compose"><span class = "glyphicon glyphicon-envelope"></span> Compose again</a></p>';
		}
	}

	
	//........................delete message......................
	if(isset($_POST['delete_message'])){
		if(isset($_POST['id']) && !empty($_POST['id'])){
			$output = '';
			$id = htmlentities($_POST['id']);
			
			if($message->deleteMessage($id)){
				redirect_to('messages.php');
			}
			
			else{
				$output.='<p>' . $message->error() . '</p>';
			}
		}
	}
?>
<?php require_once("includes/header.php");?>
<?php require_once("includes/user_menu.php");?>
<div class = "container-fluid" style = "background-color:rgba(71,97,124,0.1);">
	<div class = "container" >
		<div class = "row px20top">
			<div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
				
			</div>
			<div class = "col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<div class = "panel panel-default">
					<div class = "panel-heading text-center"><?php echo $msg;?> &nbsp;</div>
					<div class = "panel-body" style = "color:rgba(71,97,124,1.0);">		
						<div class = "col-lg-3">
							<h3 class = "text-center"> &nbsp;</h3>
							<a href = "messages.php?action=compose" class = "btn btn-block btn-success <?php echo isset($compose) ? 'active' : '' ?>"><i class = "fa fa-pencil-square-o"></i> COMPOSE</a> 
							<a href = "messages.php" class = "btn btn-block btn-info <?php echo isset($mess) ? 'active' : '' ?>"><i class = "fa fa-inbox"></i> INBOX</a> 
							<a href = "messages.php?action=outbox" class = "btn btn-block btn-warning <?php echo isset($outbox) ? 'active' : '' ?>"><i class = "fa fa-paper-plane"></i> SENT</a>
						</div>
						<div class = "col-lg-9">
							<h3><?php echo $title;?></h3>	
							<?php 
								if(isset($output)){echo $output;}
							
							?>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once("includes/footer.php");?>