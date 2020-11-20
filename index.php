<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome To Vue-CRUD Application </title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">

<!---- Data Table Design ----->
		<div class="row">
			<div class="header">
				<h1>All User </h1>
				<span>
				  <button @click="modal=true"> Add New </button>	
				</span>
			</div>
			<div :class="className" v-if="message">{{ message }}<span class="closer" @click="message=false">X</span></div>
			<table>
				<thead>
					<th>SL.</th>
					<th>Full Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Action</th>
				</thead>
				<tr v-for="(user , i) in users">
					<td>{{ i+1 }}</td>
					<td>{{ user.name }}</td>
					<td>{{ user.username }}</td>
					<td>{{ user.email }}</td>
					<td>
						<button id="view">View</button>
						<button id="edit" @click="UpdateForm(user); updateModal = true">Edit</button>
						<button id="delete" @click="deleteData(user.id)">Delete</button>
					</td>
				</tr>
			</table>
		</div><!---- end Datatable Design ----->

<!---- Modal desing ----->
	    <div class="modal" v-if="modal">
		    <div class="modal-body">

		    	<button class="float-right" @click="modal = false">X</button>
		    	<div class="modal-header">Add A New User</div>
		    	<hr/>
		    	<div class="modal-content">
		    		<form class="form-group">
		    			<label for="name">Name</label> </br>
		    			<input type="text" id="name" class="form-control" v-model="formData.name"></br>
		    			<label for="username">Username</label></br>
		    			<input type="text" id="username" class="form-control" v-model="formData.username"></br>
		    			<label for="name">Email :</label></br>
		    			<input type="email" id="email" class="form-control" v-model="formData.email">
		    			<input type="button" value="Submit" class="submit-button" @click="modal=false; postData()"
		    			>
		    		</form>
		    	</div>
	    	</div>
	    </div><!-- end modal ---->

<!--------- Model of Edit Data -------------->
	    <div class="modal" v-if="updateModal">
		    <div class="modal-body">

		    	<button class="float-right" @click="updateModal = false">X</button>
		    	<div class="modal-header">Update Your Data</div>
		    	<hr/>
		    	<div class="modal-content">
		    		<form class="form-group">
		    			<label for="name">Name</label> </br>
		    			<input type="text" id="name" class="form-control" v-model="UpdateFormData.name"></br>
		    			<label for="username">Username</label></br>
		    			<input type="text" id="username" class="form-control" v-model="UpdateFormData.username"></br>
		    			<label for="name">Email :</label></br>
		    			<input type="email" id="email" class="form-control" v-model="UpdateFormData.email">
		    			<input type="button" value="Update" class="submit-button" @click="updateModal=false; SaveUpdateData()"
		    			>
		    		</form>
		    	</div>
	    	</div>
	    </div><!-- end modal ---->
	</div><!--end container----->
	<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"></script>
	<script src="myvue.js"></script>
</body>
</html>