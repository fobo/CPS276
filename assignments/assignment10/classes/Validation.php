<?php
//YOU MUST WRITE THE CODE FOR THE OTHER REGULAR EXPRESSIONS TO BE USED

class Validation{
	/* USED AS A FLAG CHANGES TO TRUE IF ONE OR MORE ERRORS IS FOUND */
	private $error = false;
	
	/* CHECK FORMAT IS BASCALLY A SWITCH STATEMENT THAT TAKES A VALUE AND THE NAME OF THE FUNCTION THAT NEEDS TO BE CALLED FOR THE REGULAR EXPRESSION */
	public function checkFormat($value, $regex)
	{
		switch($regex){
			case "name": return $this->name($value); break;
			case "phone": return $this->phone($value); break;
			case "address": return $this->address($value); break;
			case "city": return $this->city($value); break;
			case "email": return $this->email($value); break;
			case "dob": return $this->dob($value); break;
		}
	}
	//name phone address city email dob
	/* THE REST OF THE FUNCTIONS ARE THE INDIVIDUAL REGULAR EXPRESSION FUNCTIONS*/
	private function name($value){
		$match = preg_match('/^[a-z-\' ]{1,50}$/i', $value);
		return $this->setError($match);
	}
	private function phone($value){
		$match = preg_match('/\d{3}\.\d{3}.\d{4}/', $value);
		return $this->setError($match);
	}
	private function address($value){
		//start with a number, then alpha chars, spaces, hyphens and periods
		$match = preg_match('/^[0-9]+[a-zA-Z-. ]*/', $value);
		return $this->setError($match);
	}
	private function city($value){
		$match = preg_match('/^[a-zA-Z ]+/', $value);
		return $this->setError($match);
		//must be alpha chars only
	}
	private function email($value){
		//valid email 
		//any amount of chars & nums, followed by @, followed by chars, followed by . and 3 chars
		//very simple and lots of holes, but works for this.
		$match = preg_match('/(^[0-9a-zA-Z]+@[a-zA-Z]+.[a-zA-Z]{3})$/', $value);
		return $this ->setError($match);
	}
	private function dob($value){
		// ##/##/####
		$match = preg_match('/(^[0-9]{2}\/[0-9]{2}\/[0-9]{4})$/', $value);
		return $this->setError($match);
	}

	private function setError($match){
		if(!$match){
			$this->error = true;
			return "error";
		}
		else {
			return "";
		}
	}
	/* THE SET MATCH FUNCTION ADDS THE KEY VALUE PAR OF THE STATUS TO THE ASSOCIATIVE ARRAY */
	public function checkErrors(){
		return $this->error;
	}
	
}
