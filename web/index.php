<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	
	<title>YodaBot Ultimate v2</title>
	
	<meta name="viewport" content="width=device-width" />
	
	<link rel="stylesheet" type="text/css" href="css	/style.css">
	<script src="https://cdn.jsdelivr.net/npm/vue"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="chatbot/vue-chat-scroll.js"></script>
		
	


</head>
<body>
	

	
	
	<div id="background">
		<div class="container" id="separator">
			<div class="jumbotron" id="terminal-bck">
				<img src="assets/image/yoda-gif.gif" id="yoda-gif" alt="Yoda Gif" />
				
				<div class="jumbotron" id="display-console">
					<div class="chat">
						<div id="app">
							<div id="messages">
								<ul class="chat-new-messages" v-chat-scroll>
									<li
								     is="msg"
								     v-for="(message, index) in messages"
								     v-bind:sender="message.username"
								 	 v-bind:message="message.message"
								 	 
								   ></li>								
								
								</ul>
								
							
								<div class="jumbotron" id="send-bot">
									<form v-on:submit.prevent="addNewMsg">
										<div class="inputContainer"><span v-if="writing" id="writing">Bot Writing...</span>
											
											<div class="chat-inputform">
												<!--<input :disabled="previousAnswerRef === 'lastMessage'" ref="chatInput" class="chat-input" type="text" @keyup.enter="userSendMessage" v-model="currentUserMessage" />-->
												
												<input v-model="newMsgContent" :disabled="disabled == 1 ? true : false" class="chat-input" type="text" name="message" value="" placeholder="Write here what you want to send to YodaBot" />
											</div>
											
											
											
																					
											
											<span class="inputLabel">
												<button class="btn btn-success" :disabled="disabled == 1 ? true : false">SEND</button>
											</span></form>
										</div>
										</div>
										</div>
										</div>
										</div>
										</div>
										</div>
										</div>
										</div>
										
										<div id="container"></div>
										</div>
										
										
										
										
										
										
										
										
										
										<footer><script src="chatbot/BotInfo.js" type="text/javascript"></script></footer>
										</body>
										</html>