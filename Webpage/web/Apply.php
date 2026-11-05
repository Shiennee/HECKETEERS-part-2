<!-- group 6 apply.html (job application form) -->
<!DOCTYPE html>
<html lang="en">
	
	<head>
		<link href="style.css" rel = "stylesheet">
		<meta charset="UTF-8">
        <meta name="description" content="Job applications">
        <meta name ="keywords" content="html,form,hyperlinks">
        <meta name ="Yee Chee Xuen" content ="De Hecketeers">

  		<title> De Hecketeers apply.html </title>
		
	</head>
<header>
            
            <img src="logo.png" alt="home" width="80px" height="80px"></p>
            <h1 class ="Main">DE_HECKETEERS</h1>

            <nav>
                <a href="index.html">Home</a>
                <a href="jobs.html">Jobs</a>
                <a href="Apply.html">Apply</a>
                <a href="About.html">About</a>
            </nav>

             <search>
                <form action="/search" method="get">
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search">
                    <button type="submit">Search</button>
                </form>
            </search>
        </header>

<body>
	
	<section id="signup">
	<h1> De Hacketeers job application form </h1>
	<form method="post" action="http://mercury.swin.edu.au/it000000/formtest.php" autocomplete="on">
	
	<p> 
		Please fill in the De Hacketeers job application form below. 
		<br> 
		Our staff will contact you regarding your application as soon as possible in 5 business days. 
	</p>
		
	<label for="JRNum"> Job Reference Number (5 alphanumeric characters) </label> 
	<input type="text" name= "JRNum" id="JRNum" pattern="[A-Za-z0-9]{5}" required="required"> 
	
	<hr>
	
	<fieldset>
	<legend> 1. Personal Details </legend>
		
		<p>	
			<label for="fstname"> First Name: </label> 
			<input type="text" name="fstname" id="fstname" pattern="[a-zA-Z]{1,20}" required="required">
		</p>	
		
		<p>	
			<label for="lstname"> Last Name: </label> 
			<input type="text" name="lstname" id="lstname" pattern="[a-zA-Z]{1,20}" required="required">
		</p>
		
		<hr>

		<p> 
			<label for="dob"> Date of Birth: </label> 
			<input type="date" name="dob" id="dob">
		</p>
		
		<hr>

		<p>
			<span> Gender: </span> 
			
			<br>
			
			<label for="male"> Male </label>
			<input type="radio" name="gender" id="male" value="male" required="required">
			
			<br>
			
			<label for="female"> Female </label>
			<input type="radio" name="gender" id="female" value="female">
			
			<br>
			
			<label for="other"> Other </label>
			<input type="radio" name="gender" id="other" value="other">
			<label for="gender_specify"> (Please specify): </label> 
			<input type="text" name="gender" id="gender_specify" pattern="[a-zA-Z]{1,20}">
		</p>
	</fieldset>
		
	<fieldset>
	<legend> 2. Accomodation Details </legend>
			
		<p>
			<label for="address"> Street Address: </label> 
			<input type="text" name= "address" id="address" pattern="[A-Za-z0-9]{1,40}" required="required">
		</p>
		
		<p>	
			<label for="suburbtown"> Suburb/Town: </label> 
			<input type="text" name= "suburbtown" id="suburbtown" pattern="[A-Za-z0-9]{1,40}" required="required">
		</p>
		
		<hr>

		<p> 
			<label for="state"> State of Residence: </label> 
			<select name="state" id="state" required="required">
				<option value=""> Please Select a State </option>
				<option value="vic"> Victoria (VIC) </option>			
				<option value="nsw"> New South Wales (NSW) </option>
				<option value="qld"> Queensland (QLD) </option>
				<option value="nt"> Northen Territory (NT) </option>
				<option value="wa"> Western Australia (WA) </option>			
				<option value="sa"> South Australia (SA) </option>
				<option value="tas"> Tasmania (TAS) </option>
				<option value="act"> Australian Capital Territory (ACT) </option>
			</select>
		</p>

		<p>
			<label for="postcode"> Postcode (5 numbers only): </label> 
			<input type="text" name= "postcode" id="postcode" pattern="\d{5}" required="required"> 
		</p>
	</fieldset>

	<fieldset>
	<legend> 3. Your Contact Info </legend>
						
		<p> 
			<label for="email"> Email Address: </label> 
			<input type="text" name= "email" id="email" pattern="[A-Za-z0-9@_-]{1,40}" required="required">
		</p>
		
		<hr>

		<p>
			<label for="phone"> Phone Number: </label> 
			<input type="text" name= "phone" id="phone" pattern="[0-9]{8,12}" required="required"> 
		</p>

	</fieldset>
		
	<fieldset>
	<legend> 4. Skill Description </legend>

		<p>
			<span> Skill List (Check on Your Skills): </span>
			
			<br>
			
			<label for="skill1"> Creative directing </label> 
			<input type="checkbox" id="skill1" name="slist" value="skill1" checked="checked" required="required">
			
			<br>
			
			<label for="skill2"> Accounting </label> 
			<input type="checkbox" id="skill2" name="slist" value="skill2">
			
			<br>
			
			<label for="skill3"> Content managing </label> 
			<input type="checkbox" id="skill3" name="slist" value="skill3">
			
			<br>
			
			<label for="skill4"> Videographing </label> 
			<input type="checkbox" id="skill4" name="slist" value="skill4">
			
			<br>
			
			<label for="skill5"> Video editing/Motion designing </label> 
			<input type="checkbox" id="skill5" name="slist" value="skill5">
		</p>

		<p>
			<label for="oskills"> Other Skills: </label>
			<br>
			<textarea id="oskills" name="oskills" rows="5" cols="50"> Describe some of your other skills here...
			</textarea>
		</p>

	</fieldset>

		
	<p>Many thanks from us, De Hacketeers!</p>
	
	<input type= "submit" value="Submit Application">
	<br>
	<input type= "reset" value="Reset Form Contents">

</form>
</Section>
</body>

</html>
