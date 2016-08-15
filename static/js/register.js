(function () {
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
})();