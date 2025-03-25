<?php
class UsuariManager extends Usuari {
	/**
	 * Returna si un usuari/contrasenya està a la Bdd
	 * @param string $usuari
	 * @param string $contrasenya
	 * @return true|false Si usuari/contraenya és correcte
	 */
	public function Login($usuari=null,$contrasenya=null)
	{
		$resposta = false;
		if ($usuari != null and $contrasenya != null) {
			try {
				$consulta = (BdD::$connection)->prepare('
					SELECT count(*) AS Total
					FROM `usuari`
					WHERE `usuari` = :usuari and `contrasenya` = :contrasenya' );
					
				$consulta->bindParam('usuari',$usuari);
				$consulta->bindParam('contrasenya',$contrasenya);
				$qFiles = $consulta->execute();
				if ($qFiles > 0) {
					$consulta->setFetchMode(PDO::FETCH_ASSOC); 
					$result = $consulta->fetchAll();
					$resposta = ($result[0]["Total"] > 0);
				}
			} catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}
		return $resposta;
	}
	
	/**
	 * Cerca un usuari a la Bdd
	 * @param string $usuari
	 * @return $usuari
	 */
	public function getUsuari($usuari=null)
	{
		$resposta = null;
		if ($usuari != null) {
			try {
				$consulta = (BdD::$connection)->prepare('
					SELECT *
					FROM usuari
					WHERE usuari = :usuari ' );
				$consulta->bindParam('usuari',$usuari);
				$qFiles = $consulta->execute();
				if ($qFiles > 0) {
					$consulta->setFetchMode(PDO::FETCH_ASSOC); 
					$result = $consulta->fetchAll();
					
					$this->id = $result[0]["id"];
					$this->usuari = $result[0]["usuari"];
					$this->contrasenya = $result[0]["contrasenya"];
					$this->nom = $result[0]["Nom"];
					$this->admin = $result[0]["admin"];
					$resposta = $this;
				}
			} catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}
		return $resposta;
	}
	
	
}
?>