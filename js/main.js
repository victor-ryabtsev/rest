Application = function () {
	this.container = $('#content');
	//initialization after page reloading
	this.init = function () {
		var self = this;

		//assign userList with top menu link via ajax
		$('#mainmenu a').click(function(event){
			self.userList();
			event.preventDefault();
		});
		this.userList();
	};

	//user list page
	this.userList = function () {
		var self = this;
		self.container.html('');
		$.ajax({
			url: '/api/users',
			type: 'GET',
			success: function(users) {
				if ('errors' in users) {
					alert(JSON.stringify(users.errors));
					return;
				}

				$.each(users, function(index, user){
					self.container.append(user.login + '</BR>');
				});
			}
		});
	};


	this.init();
};


$(function () {
	new Application();
});

