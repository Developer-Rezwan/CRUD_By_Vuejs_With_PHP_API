var app = new Vue({
	el:".container",
	data:{		
		users:[],
		modal:false,
		updateModal:false,
		formData:{
			name: null,
			username: null,
			email: null
		},	
		UpdateFormData:{
			id: null,
			name: null,
			username: null,
			email: null
		},
		message:false,
		className:null,
	},
	methods:{
       getData:function(){
       	 axios.get("http://localhost/vue-crud/api.php?action=read")
         .then(function(response){
           app.users = response.data.users;
         });
       },

       postData:function(){
       	var mydata = this.FormDataCollector(this.formData);
       	axios.post("http://localhost/vue-crud/api.php?action=create",mydata)
       	.then(function(response){
       		if(response.data.error){
       			app.className = "alert-danger";
       			return app.message = response.data.message;
       		}else{
       			app.formData.name = null;
       			app.formData.username = null;
       			app.formData.email = null;
       			app.getData();
       			app.className = "alert-success";
       			return app.message = response.data.message;
       		}
       	});
       },

       deleteData:function(id){
       	var mydata = this.FormDataCollector({id:id});
       	axios.post("http://localhost/vue-crud/api.php?action=delete",mydata)
       	.then(function(response){
       		if(response.data.error){
       			app.className = "alert-danger";
       			return app.message = response.data.message;
       		}else{
       			app.getData();
       			app.className = "alert-danger";
       			return app.message = response.data.message;
       		}
       	});
       },

       UpdateForm:function(user){
       	  this.UpdateFormData.id = user.id;
       	  this.UpdateFormData.name = user.name;
       	  this.UpdateFormData.username = user.username;
       	  this.UpdateFormData.email = user.email;
       },

       SaveUpdateData:function(){
       		var id = this.UpdateFormData.id;
       		var updatedata = this.FormDataCollector(this.UpdateFormData);
	       		
	       	axios.post("http://localhost/vue-crud/api.php?action=update",updatedata)
	       	.then(function(response){
	       		if(response.data.error){
	       			app.className = "alert-danger";
	       			return app.message = response.data.message;
	       		}else{
	       			app.getData();
	       			app.className = "alert-success";
	       			return app.message = response.data.message;
	       		}
	       	});	
       },

      FormDataCollector(formdata){
      	var jsFormCollectLib = new FormData();
      	for(var key in formdata){
      		jsFormCollectLib.append(key,formdata[key]);
      	}
      	return jsFormCollectLib;
      }
	},
	mounted:function(){
		this.getData();
	}
})
