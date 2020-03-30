

//vue.component vincula la plantilla donde is es el primer componente "msg" v-for envia y recorre los parametros donde sender es el nombre de usuario del index y message el mensaje que se va a enviar

Vue.component('msg', {
	template: '<li\
	  class="chat-message"><span class="sender">{{sender}}</span>\
	  	\
	  	<div class="messageContents"><span class="messageText">{{message}}</span></div>\
	  </li>',
	props: ['sender', 'message']
});



var app = new Vue({
	
	// seleccionamos la app del div de vue de index.php
	el: '#app',
	data: {
		//muestra si se esta escribiendo o no
		writing: false,
		//activa el input
		disabled: 0,
		
		//enviamos el mensaje de bienvenida
		messages: [
		      {
				username: 'Yoda',
				message: 'Hi! Young Padawan...',
				
			},
			
		  
	    ],
		
		//viaciamos mensaje de inputa
		newMsgContent: '',
		//declaramos contador a 0
		notFoundCount: 0
	},
	methods: {
		addNewMsg: function () {
			var message = this.newMsgContent;
			if(this.writing || this.disabled == 1) {
				return;
			}
			
			 if (message != '0') {
				
				this.messages.push({
					username: 'You',
					message: this.newMsgContent
					
				})
				
				if(message.toLowerCase() == 'force') {
					axios.
					get('/chatbot/AjaxBot.php?films')
					.then(
						(response) => {
							
							console.log('response.data = %o',response.data);
//							console.log('response.data = %o',response.data.length);
							
							for(var i = 0; i < response.data.length; i++) {
								//console.log(response.data[i]);
								this.messages.push({
									username: 'Yoda',
									message: response.data[i]							
								});
								
							}			
						}
						
					);
					
					
				}
				
				this.newMsgContent = '';
				
				this.writing = true;
				this.disabled = 1;
				
				axios
				.post('/chatbot/AjaxBot.php', 'message='+message)
				.then(
					(response) => {
						console.log(response.data);
						
						if(Array.isArray(response.data)) {
							for(var i = 0; i < response.data.length; i++) {
									if(response.data[i] != 'notfound') {
										if (message.toLowerCase() == 'force'){
											
											return;
											
										} else {
											this.messages.push({
												username: 'Yoda',
												message: response.data[i],
												notFoundCount: 0
											});
											
										}
											
									} else if (message.toLowerCase() != 'force') {
										this.notFoundCount++;
										if(this.notFoundCount == 2) {
											this.notFoundCount = 0;
											
											axios.
											get('/chatbot/AjaxBot.php?characters')
											.then(
												(response) => {
													
													for(var i = 0; i < response.data.length; i++) {
														console.log(response.data[i]);
														this.messages.push({
															username: 'Yoda',
															message: response.data[i]							
														});
													}			
												}				
											);
											
											this.newMsgContent = '';
											
											this.writing = true;
											this.disabled = 1;
										}
									}
							}
						} else {
							this.messages.push({
								username: 'Yoda',
								message: response.data						
							});
						}
					}
				)
				.finally(
				() => {
					this.writing = false;
					this.disabled = 0;	
					this.newMsgContent = '';
				});
			}
		},
		
		loadChatHistory: function () {
			axios.
			get('/chatbot/AjaxBotHistory.php?history')
			.then(
				(response) => {
					//console.log('response.data = %o',response.data);
					for(var i = 0; i < response.data.length; i++) {
						//console.log(response.data[i]);
						if (response.data[i]['message'].indexOf("search", "Sorry") > -1) {
												
						} else {
							this.messages.push({
								username: response.data[i]['user'] == 'user'? 'You' : 'Yoda',
								message: response.data[i]['message']							
							});
							
						}
						
					}			
				}				
			);
		}
			
	},
	beforeMount() {
		this.loadChatHistory()
	}

})
