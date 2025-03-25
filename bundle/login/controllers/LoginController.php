<?php

class LoginController extends Controller
{

	/**
     * Processa les peticions de login.
     * Gestiona la redirecció i la validació de l'usuari.
     */
	public function process($params)
	{

		$this->data['TITOL'] = "Login";
		// Si hem cridat a Logout
		if (isset($params[0]) && ($params[0]=="logout")){
			$this->logout();
		}
		
		
		
		// Si estem logats ja
		if ($this->EstaLogat())
			$this->redirect("");
		else
		{
			if ($_POST)
			{
				//recollim dades
				$nom = $_POST["usuari"];
				$contrasenya = $_POST["contrasenya"];
				//validem dades
				if ($nom != "" and $contrasenya != "")
				{
					//comprovem a la BdD
					$UsuariMng = new UsuariManager();
					if ($UsuariMng->Login($nom,$contrasenya))
					{						
						$this->login($nom);	
						$this->redirect("");
					}
					else
					{						
						$this->data["missatge"] = "usuari o contrasenya no correcte!";					
						$this->twig = "login.html";	
					}
				}
				else
				{				
					$this->data["missatge"] = "Falten dades!";
					$this->twig = "login.html";				
				}
			}
			else
				{
					$this->twig = "login.html";
				}
		}
	}
}
?>