<!-- group 6 apply.html (job application form) -->
<!DOCTYPE html>
<html lang="en">
	
	<head>
		<link href="styles/style.css" rel="stylesheet">
		<meta charset="UTF-8">
        <meta name="description" content="Job applications">
        <meta name ="keywords" content="html,form,hyperlinks">
        <meta name ="author" content ="De Hecketeers">

  		<title> De Hecketeers apply.html </title>
		
	</head>

<body>
	<?php include 'header.inc';?>
    <?php include 'nav.inc';?>	
	
	<section id="signup">
    <h1> De Hacketeers Job Application Form </h1>

    <form method="POST" action="process_eoi.php" autocomplete="on" novalidate>
	
	<p> 
		Please fill in the De Hacketeers job application form below. 
		<br> 
		Our staff will contact you regarding your application as soon as possible in 5 business days. 
	</p>
	<p><span class="required">*</span> Indicates a compulsory field.</p>	
	<p>
    	<label for="JRNum">
        Job Reference Number
        <span class="required">*</span>
    	</label>

    	<select name="JRNum" id="JRNum">
        <option value="">Please select a job</option>
        <option value="1GRPH">1GRPH</option>
        <option value="2WDEV">2WDEV</option>
        <option value="3CONM">3CONM</option>
    	</select>
	</p> 
	
	<hr>
	
	<fieldset>
    <legend>1. Personal Details</legend>

    <p>
        <label for="fstname">
            First Name <span class="required">*</span>
        </label>
        <input type="text" name="fstname" id="fstname">
    </p>

    <p>
        <label for="lstname">
            Last Name <span class="required">*</span>
        </label>
        <input type="text" name="lstname" id="lstname">
    </p>

    <p>
        <label for="dob">
            Date of Birth <span class="required">*</span>
        </label>
        <input type="date" name="dob" id="dob">
    </p>

    <p>
        <span>Gender <span class="required">*</span></span>

        <br>

        <label for="male">Male</label>
        <input type="radio" name="gender" id="male" value="male">

        <br>

        <label for="female">Female</label>
        <input type="radio" name="gender" id="female" value="female">

        <br>

        <label for="other">Other</label>
        <input type="radio" name="gender" id="other" value="other">

        <br>

        <label for="gender_specify">Please specify:</label>
        <input type="text" name="gender_other" id="gender_specify">
    </p>
	</fieldset>
		
	<fieldset>
	<legend> 2. Accomodation Details </legend>
			
		<p>
			<label for="address"> Street Address: <span class="required">*</span></label> 
			<input type="text" name= "address" id="address" >
		</p>
		
		<p>	
			<label for="suburbtown"> Suburb/Town: <span class="required">*</span></label> 
			<input type="text" name= "suburbtown" id="suburbtown" >
		</p>
		
		<hr>

		<p> 
			<label for="state"> State of Residence: <span class="required">*</span></label> 
			<select name="state" id="state" >
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
			<label for="postcode"> Postcode (4 numbers only): <span class="required">*</span></label> 
			<input type="text" name= "postcode" id="postcode" > 
		</p>
	</fieldset>

	<fieldset>
	<legend> 3. Your Contact Info </legend>
						
		<p> 
			<label for="email"> Email Address: <span class="required">*</span></label> 
			<input type="email" name= "email" id="email" >
		</p>
		
		<hr>

		<p>
			<label for="phone"> Phone Number: <span class="required">*</span></label> 
			<input type="text" name= "phone" id="phone" > 
		</p>

	</fieldset>
		
	<fieldset>
    <legend>4. Skill Description</legend>

    <p>
        <span>Skill List <span class="required">*</span></span>

        <br>

        <label for="skill1">Creative directing</label>
        <input type="checkbox" id="skill1"
               name="slist[]" value="skill1">

        <br>

        <label for="skill2">Accounting</label>
        <input type="checkbox" id="skill2"
               name="slist[]" value="skill2">

        <br>

        <label for="skill3">Content managing</label>
        <input type="checkbox" id="skill3"
               name="slist[]" value="skill3">

        <br>

        <label for="skill4">Videographing</label>
        <input type="checkbox" id="skill4"
               name="slist[]" value="skill4">

        <br>

        <label for="skill5">
            Video editing/Motion designing
        </label>
        <input type="checkbox" id="skill5"
               name="slist[]" value="skill5">
    </p>

    <p>
        <label for="oskills">Other Skills:</label>
        <br>

        <textarea id="oskills" name="oskills"
                  rows="5" cols="50"
                  placeholder="Describe some of your other skills here..."></textarea>
    </p>
	</fieldset>

		
	<p>Many thanks from us, De Hacketeers!</p>
	
	<input type= "submit" value="Submit Application">
	<br>
	<input type= "reset" value="Reset Form Contents">

</form>
</section>
</body>

</html>
