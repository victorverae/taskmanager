<?php

class Reverse extends Controller {

	function reverse()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$st ="";
		echo strrev($st);
	}
}