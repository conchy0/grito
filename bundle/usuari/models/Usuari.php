<?php
	//
	// fitxer de dades
	//
	
	//creem una classe on hi guardem les dades de l'usuari
	class Usuari
	{
		var $id;
		var $usuari;
		var $contrasenya;
		var $nom;
		var $admin;

		
		function __construct($valors=null)
		{
			if ($valors == null) {
				$this->usuari = "";
				$this->contrasenya = "";
				$this->nom = "";
				$this->admin = false;
			}
			else {
				if (is_array($valors)) {
					if (isset($valors["usuari"])) $this->usuari = $valors["usuari"];
					if (isset($valors["contrasenya"])) $this->contrasenya = $valors["contrasenya"];
					if (isset($valors["nom"])) $this->nom = $valors["nom"];
					if (isset($valors["admin"])) $this->admin = $valors["admin"];
				}
			}
		}
		public function Assignar($usuari,$contrasenya,$nom,$admin)
		{
			if (isset($usuari)) $this->usuari = $usuari;
			if (isset($contrasenya)) $this->contrasenya = $contrasenya;
			if (isset($nom)) $this->nom = $nom;
			if (isset($admin)) $this->admin = admin;
		}
		public function getUsuari($parametre = null) {
			return array(
				"usuari" =>$this->usuari,
				"contrasenya" =>$this->contrasenya,
				"nom" =>$this->nom,
				"admin" =>$this->admin,
			);
		}
		public function getNom() {
			return ($this->nom);
		}
		
		public function getAdmin() {
			return ($this->admin);
		}
		
		public function IsAdmin() {
			return ($this->admin);
		}
			
	}
?>