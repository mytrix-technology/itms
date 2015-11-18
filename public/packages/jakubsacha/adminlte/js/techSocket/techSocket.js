

	var MYAPP = {


		appuser : null,
		rootpath : null ,
		socket : {


				method : {


					BROADCAST  : 255, // broadcast
					PRIVATE  : 192 // individual
				},

				connection : {

					CONNECT : 'CONNECT',
					DISCONNECT : 'DISCONNECT'
				},

				size : {

					TWO_WAY : 2,
					THREE_WAY : 3
				}



		}
	};
	
	
	
	
	
	var TechsocketServer = function(endpoint,port,onSuccessCallback,responseCallback){



    	this.app = window.app = {};
    	this.endpoint = endpoint;
    	this.port = port;
    	this.brainsocket = null;
    	this.responseCallback = responseCallback;
    	this.onSuccessCallback = onSuccessCallback;
    	this.isConnected = false;
    	

    	



    	this.connect = function(){


    		this.app.BrainSocket = new BrainSocket(
			        new WebSocket('ws://'+this.endpoint+':'+this.port),
			        new BrainSocketPubSub()
			);

			this.app.BrainSocket.connection.onopen = onopen;
			this.app.BrainSocket.connection.onerror = onerror;
			this.app.BrainSocket.Event.listen('generic.event',onMessage);






    	};

    	onopen = function(){


    		console.log("connection established @ "+endpoint+" with port "+port);


    		// establish connection


			var conpacket = {


				source : MYAPP.appuser,
				size : MYAPP.socket.size.TWO_WAY,
				payload : {


					connect : true

				}

			};


			push(conpacket);

			
			onSuccessCallback();






    	};


    	onerror = function(){


    		console.log("Invalid Connection @ "+endpoint+" with port "+port);


    	};


    	push = function(data,callback){

    		
    		

			app.BrainSocket.message('generic.event',
			{

					"packet" : data 
					
					
			        

			});

			
			if (typeof callback === "function") {

			  callback();


			}
						

			

    	};



    	this.broadcast = function(data,callback){


    		
    		var datapacket = {


				source : MYAPP.appuser,
				type : MYAPP.socket.method.BROADCAST,
				size : MYAPP.socket.size.THREE_WAY,
				payload : data


			};

			

			push(datapacket,function(){


				callback();
			});
			
			


			


    	};

    	

    	

    	

    	onMessage = function(msg){



    		
    		responseCallback(msg);
    		
    		

    		
    		

    	};

    	this.notify = function(dest,data,callback){



    		var datapacket = {


			source : MYAPP.appuser,
			destination : dest,
			type : MYAPP.socket.method.PRIVATE,
			size : MYAPP.socket.size.THREE_WAY,
			payload : data


			};
			

			push(datapacket,function(){

				callback();

			});


    	}


    	

    	

    	



    };
	