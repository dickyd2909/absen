<html>
	<head>
		<title>Untitled Document</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="Content-Style-Type" content="text/css">
		<meta http-equiv="Content-Script-Type" content="text/javascript">
		<script type="text/javascript">
		window.onload = function() {
			var x = 20;
			var y = document.getElementById("timer");
			setInterval(function() {
				if (x <= 21 && x >= 1) {
					x--;
					y.innerHTML = '' + x + '';
					if (x == 1) {
						x = 21;
					}
				}
			}, 1000);
			// Form Submitting after 20s
			var auto_refresh = setInterval(function() {
				submitform();
			}, 10000);
			
			// Form submit function
			function submitform() {
				if (validate()) // Calling validate function
				{
					alert('Form is submitting.....');
					document.getElementById("form").submit();
				}
			}
			// To validate form fields before submission
			function validate() {
			// Storing Field Values in variables
			var name = document.getElementById("name").value;
			var email = document.getElementById("email").value;
			var contact = document.getElementById("contact").value;
			// Regular Expression For Email
			var emailReg = '/^([w-.]+@([w-]+.)+[w-]{2,4})?$/';
			// Conditions
				if (name != '' && email != '' && contact != '') {
					if (document.getElementById("male").checked || document.getElementById("female").checked) {
						if (contact.length == 10) {
							return true;
						} else {
							alert("The Contact No. must be at least 10 digit long!");
							return false;
						}
					} else {
						alert("You must select gender.....!");
						return false;
					}

				} else {
					alert("All fields are required.....!");
					return false;
				}
			}
		};
		</script>
	</head>
	<body>
		<div class="container">
<div class="main">
<form action="success.html" method="post" id="form">
<h2>Javascript AutoSubmit Form Example</h2>
<span>Form will automatically submit in <b id="timer">20</b> <b>seconds</b>.</span>
<label>Name :</label>
<input type="text" name="name" id="name" placeholder="Name" />
<label>Email :</label>
<input type="text" name="email" id="email" placeholder="Valid Email" />
<label>Gender :</label>
<input type="radio" name="gender" value="Male" id="male" />
<label>Male</label>
<input type="radio" name="gender" value="Female" id="female" />
<label>Female</label>
<label>Contact No. :</label>
<input type="text" name="contact" id="contact" placeholder="Contact No." />
</form>
</div>
</div>
	</body>
</html>