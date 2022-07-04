<?php

	include_once 'AccVerif.php';

	class account {

		protected $accName;
		protected $accUser;
		protected $accPass;

		public function __construct($n,$u,$p){

		$this->setName($n); //check name
		$this->setUser($u); //check user
		$this->setPass($p); //check password
		}

		public function getName(){

			return $this->accName;

		}

		public function getUser(){

			return $this->accUser;

		}

		public function getPassword(){

			return $this->accPass;

		}

		public function setName($n){

			$this->accName = $n;
		}

		public function setUser($u){

			$this->accUser = $u;
		}

		public function setPass($p){

			$this->accPass = $p;
		}

	}

?>