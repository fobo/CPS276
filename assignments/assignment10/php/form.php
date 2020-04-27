<?php

/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY FORM.  THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/
require_once('classes/StickyForm.php');
require 'classes/Pdo_methods.php';
$stickyForm = new StickyForm();

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF IT IS CALLED FROM THE INDEX.PHP PAGE */
function init(){
  global $elementsArr, $stickyForm;

  /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */
  if(isset($_POST['submit'])){

    /*THIS METHODS TAKE THE POST ARRAY AN THE ELEMENTS ARRAY (SEE BELOW) AND PASSES THEM TO THE VALIDATION FORM METHOD OF THE STICK FORM CLASS.  IT UPDATES THE ELEMENTS ARRAY AND RETURNS IT WHICH IS STORED IN THE $POSTARR VARIABLE */
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);

    /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND THE STATUS IS CHANGED TO ERRORS FORM THE DEFAULT OF NOERRORS.  DEPENDING ON WHAT IS RETURNED DEPENDS ON WHAT HAPPENS NEXT.  IN THIS CASE THE RETURN MESSAGE HAS NO ERRORS SO WE HAVE NO PROBLEMS WITH OUR VALIDATION AND WE CAN SUBMIT THE FORM */
    if($postArr['masterStatus']['status'] == "noerrors"){
      
      /*addData() IS THE METHOD TO CALL TO ADD THE FORM INFORMATION TO THE DATABASE (NOT WRITTEN IN THIS EXAMPLE) THEN WE CALL THE GETFORM METHOD WHICH RETURNS AND ACKNOWLEDGEMENT AND THE ORGINAL ARRAY (NOT MODIFIED). THE ACKNOWLEDGEMENT IS THE FIRST PARAMETER THE ELEMENTS ARRAY IS THE ELEMENTS ARRAY WE CREATE (AGAIN SEE BELOW) */
      addData($_POST);
      return getForm("Contact Information Added", $elementsArr);

    }
    else{
      /* IF THERE WAS A PROBLEM WITH OUT FORM VALIDATION THEN THE MODIFIED ARRAY ($POSTARR) WILL BE SENT AS THE SECOND PARAMETER.  THIS MODIFIED ARRAY IS THE SAME AS THE ELEMENTS ARRAY BUT ERROR MESSAGES AND VALUES HAVE BEEN ADDED TO DISPLAY ERRORS AND MAKE IT STICKY */
      return getForm("",$postArr);
    }
    
  }

  /* THIS CREATES THE FORM BASED ON THE ORIGINAL ARRAY THIS IS CALLED WHEN THE PAGE FIRST LOADS AND A FORM HAS NOT BEEN SUBMITTED */
  else {
      return getForm("",$elementsArr);
    } 
}

/* THIS IS THE DATA OF THE WHOLE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE VALUE OF "NAME". NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/
$elementsArr = [
  "masterStatus"=>[
    "status"=>"noerrors",
    "type"=>"masterStatus"
  ],
	  "name"=>[
	      "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Name cannot be blank, and must be a standard name</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"Scott",
		    "regex"=>"name"
    ],
    "address"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Address cannot be blank and must be a valid address</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"123 Street",
        "regex"=>"address"
    ],
    "city"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>City cannot be blank and must be a valid city</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"Uultar",
        "regex"=>"city"
    ],
    "email"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be a valid email</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"kevindiehr@mail.com",
        "regex"=>"email"
    ],
	  "phone"=>[
		    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Phone cannot be blank and must be a valid phone number</span>",
        "errorOutput"=>"",
        "type"=>"text",
		    "value"=>"999.999.9999",
		    "regex"=>"phone"
    ],
    "dob"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Date of Birth cannot be blank and must be a valid Date of Birth</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"01/01/1970",
        "regex"=>"dob"
    ],
    "state"=>[
        "type"=>"select",
        "options"=>["mi"=>"Michigan","oh"=>"Ohio","pa"=>"Pennslyvania","tx"=>"Texas", "ca"=>"California"],
		    "selected"=>"oh",
		    "regex"=>"name"
    ],
    "contact"=>[
        "type"=>"checkbox",
        "action"=>"notRequired",
        "status"=>["newsletter"=>"", "emailupdate"=>"", "textupdate"=>""]
    ],
    "ageRange"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>You must select an age range.</span>",
        "errorOutput"=>"",
        "type"=>"radio",
        "action"=>"required",
        "value"=>["10-18"=>"", "19-30"=>"", "31-50"=>"", "51+"=>""]
    ],
];
/*THIS FUNCTION CAN BE CALLED TO ADD DATA TO THE DATABASE */
function addData($post){

  $contactTypes = implode(",",$post['contact']);
  /* IF EVERYTHING WORKS ADD THE DATA HERE */
  $pdo = new PdoMethods();
  $sql = "INSERT INTO contacts (name, address, city, state, phone, email, dob, agerange, contypes) VALUES (:name, :address, :city, :state, :phone, :email, :dob, :ageRange, :contact)"; //BUILD QUERY HERE
  //BINDINGS
  $bindings = [
    [':name', $post['name'], 'str'],
    [':address', $post['address'], 'str'],
    [':city', $post['city'], 'str'],
    [':state', $post['state'], 'str'],
    [':phone', $post['phone'], 'str'],
    [':email', $post['email'], 'str'],
    [':dob', $post['dob'], 'str'],
    [':contact', $contactTypes, 'str'],
    [':ageRange', $post['ageRange'], 'str']
  ];

  //SEND QUERY
  $result = $pdo->otherBinded($sql, $bindings);

  //ALL CLEAR
  if($result === 'error'){

    return 'There was an error adding to the database.';
  
  }else {
    return 'Added your contact.';
  
  }
}
   

/*THIS IS THE GET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr){

global $stickyForm;
$options = $stickyForm->createOptions($elementsArr['state']);

/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
    <form method="post" action="index.php">
    <div class="form-group">
      <label for="name">Name (letters only){$elementsArr['name']['errorOutput']}</label>
      <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}" >
    </div>
    <div class="form-group">
      <label for="address">Address (just number and street) {$elementsArr['address']['errorOutput']}</label>
      <input type="text" class="form-control" id="address" name="address" value="{$elementsArr['address']['value']}" >
    </div>
    <div class="form-group">
      <label for="city">City {$elementsArr['city']['errorOutput']}</label>
      <input type="text" class="form-control" id="city" name="city" value="{$elementsArr['city']['value']}" >
    </div>
    <div class="form-group">
      <label for="state">State</label>
      <select class="form-control" id="state" name="state">
        $options
      </select>
    </div>
    <div class="form-group">
      <label for="phone">Phone (format 999.999.9999) {$elementsArr['phone']['errorOutput']}</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{$elementsArr['phone']['value']}" >
    </div>
    <div class="form-group">
      <label for="email">Email Address{$elementsArr['email']['errorOutput']}</label>
      <input type="text" class="form-control" id="email" name="email" value="{$elementsArr['email']['value']}" >
    </div>
    <div class="form-group">
      <label for="dob">Date of Birth{$elementsArr['dob']['errorOutput']}</label>
      <input type="text" class="form-control" id="dob" name="dob" value="{$elementsArr['dob']['value']}" >
    </div>
    
    <p>Please check all contact types you would like (optional):</p>

    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contact[]" id="contact1" value="newsletter" {$elementsArr['contact']['status']['newsletter']}>
      <label class="form-check-label" for="contact1">Newsletter</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contact[]" id="contact2" value="emailupdate" {$elementsArr['contact']['status']['emailupdate']}>
      <label class="form-check-label" for="contact2">Email Update</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contact[]" id="contact3" value="textupdate" {$elementsArr['contact']['status']['textupdate']}>
      <label class="form-check-label" for="contact3">Text Update</label>
    </div>

        
    <p>Please select an age range (mandatory):{$elementsArr['ageRange']['errorOutput']}</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="ageRange" id="ageRange1" value="10-18"  {$elementsArr['ageRange']['value']['10-18']}>
      <label class="form-check-label" for="ageRange">10-18</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="ageRange" id="ageRange2" value="19-30"  {$elementsArr['ageRange']['value']['19-30']}>
      <label class="form-check-label" for="ageRange">19-30</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="ageRange" id="ageRange3" value="31-50"  {$elementsArr['ageRange']['value']['31-50']}>
      <label class="form-check-label" for="ageRange">31-50</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="ageRange" id="ageRange4" value="51+"  {$elementsArr['ageRange']['value']['51+']}>
      <label class="form-check-label" for="ageRange">51+</label>
    </div>



    <div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
HTML;

//10-18 19-30 31-50 51+
/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
return [$acknowledgement, $form];

}

?>