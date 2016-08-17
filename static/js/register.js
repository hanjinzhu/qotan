(function () {
	$(".email").focus();
	$(".email").focusout(function(){
		var self = $(this);
		var email = self.val();
		$.get("/user/checkemail", {email:email},function(data){
		  	if(data.code == 0){
		  		self.parent().css("border","1px solid #2bbbb2");
		  		self.parent().parent().find(".register_alert").remove();
		  	}else{
		  		self.parent().css("border","1px solid #d89090");
		  		self.parent().parent().find(".register_alert").remove();
		  		self.parent().parent().append('<span class="register_alert">'+data.msg+'</span>');
		  	}
		},"json");
	});
	$(".nick").focusout(function(){
		var self = $(this);
		var nick = self.val();
		$.get("/user/checknick", {nick:nick},function(data){
		  	if(data.code == 0){
		  		self.parent().css("border","1px solid #2bbbb2");
		  		self.parent().parent().find(".register_alert").remove();
		  	}else{
		  		self.parent().css("border","1px solid #d89090");
		  		self.parent().parent().find(".register_alert").remove();
		  		self.parent().parent().append('<span class="register_alert">'+data.msg+'</span>');
		  	}
		},"json");
	});
	$(".password").focusout(function(){
		var self = $(this);
		var password = self.val();
		$.get("/user/checkpassword", {password:password},function(data){
		  	if(data.code == 0){
		  		self.parent().css("border","1px solid #2bbbb2");
		  		self.parent().parent().find(".register_alert").remove();
		  	}else{
		  		self.parent().css("border","1px solid #d89090");
		  		self.parent().parent().find(".register_alert").remove();
		  		self.parent().parent().append('<span class="register_alert">'+data.msg+'</span>');
		  	}
		},"json");
	});

	$(".submit_register").click(function(){
		$.get("/user/doregister", {email:$(".email").val(),nick:$(".nick").val(),password:$(".password").val()},function(data){
		  	if(data['code'] == 0){
		  		$(".register_success_info").show();
		  		$(".login-form-section").hide();
		  		var intervalid = setInterval("clock()", 1000);
		  	}else{
		  		if(typeof(data['error_type'])!="undefined"){
		  			var error_type = data['error_type'];
		  			$("."+error_type).parent().css("border","1px solid #d89090");
			  		$("."+error_type).parent().parent().find(".register_alert").remove();
			  		$("."+error_type).parent().parent().append('<span class="register_alert">'+data.msg+'</span>');
		  		}
		  	}
		},"json");
	});
})();

var sec = 5; 
function clock() { 
	if (sec == 0) { 
		window.location.href="/home";
		clearInterval(intervalid); 
	} 
	$("#mes").text(sec); 
	sec--; 
}  