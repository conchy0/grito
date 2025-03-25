<?php
/**
 * Gestiona les sol·licituds de Artistes
 * Es responsable de donar alta, baixa i modificar Artistes.
 * Gestiona els Artista (nomes si ets admin)
 */
require_once './bundle/artista/models/ArtistaModel.php'; //agafem model per interectuar amb la base de dades

class UsuariController extends Controller
{
    public function process($params)
    {
        $this->data['TITOL'] = "Admin";
       
         // Comprova si l'usuari està logat, si no, redirigeix a la pàgina d'inici
        if (!$this->EstaLogat()) {
            $this->redirect("");
            return;
        }
        
        
		if (isset($params[0]) && $params[0] == "") {
            $this->redirect("usuari");
			return;
            
        } 
         
         // Si el paràmetre és "eliminar", elimina l'artista amb el ID indicat
		if (isset($params[0]) && $params[0] == "eliminar" && isset($params[1])) {
            $this->eliminarArtista($params[1]);  
            return;
        }
         // Si el paràmetre és "editar", mostra el formualri amb l'artista per editar l'artista amb el ID indicat
		if (isset($params[0]) && $params[0] == "editar" && isset($params[1])) {
			if ($_POST){
				$this->editarArtista(); //si es post l'edita
			}

			else{
				$this->mostrarFormulari($params[1]); //si es get mostra el formulari
				return;
			}
         
        }

        // Si el paràmetre és "afegir", mostra el formulari per afegir un nou artista
		if (isset($params[0]) && $params[0] == "afegir") {
            if ($_POST){
                $this->afegirArtista();
            }

            else{
                $this->mostrarFormulariAfegir();
                return;
            }
		
		}

        //obte la llista da'rtistes
		$artistaModel = new ArtistaModel();
            
		$artistes = $artistaModel->obtenirArtistes();// Obté tots els artistes de la base de dades
		
		$this->data['artistes'] = $artistes;
		
		$this->twig = "usuari.html"; //mostra tota l'informacio dels artistes
		
	}

	private function eliminarArtista($idArtista)
    {
        $artistaModel = new ArtistaModel();

        if ($artistaModel->eliminarArtista($idArtista)) { //si es true (elimina amb èxit) retorna a usuari
            
            $this->redirect("usuari");
        } else {
            echo "No s'ha pogut eliminar l'artista.";
        }
    }

     /**
     * Mostra el formulari per editar un artista.
     * 
     * @param int $idArtista ID de l'artista a editar.
     */

	private function mostrarFormulari($idArtista)
    {
        $artistaModel = new ArtistaModel();
        $artista = $artistaModel->obtenirArtistaPerId($idArtista);
         // Si l'artista existeix, es mostra el formulari d'edició
        if ($artista) {
            $this->data['artista'] = $artista;// Passa les dades de l'artista a la vista
            $this->twig = "formulariEditarArtista.html"; 
        } else {
            echo "L'artista no existeix.";
        }
	}

     /**
     * Mostra el formulari per afegir un nou artista.
     */
	private function mostrarFormulariAfegir()
	{
		$this->twig = "formulariAfegirArtista.html"; 
	}

    /**
     * Actualitza la informació d'un artista existent.
     */
    public function editarArtista()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Recull les dades del formulari
            $idArtista = $_POST['id_artista'];
            $nom = $_POST['nom'];
            $horaInici = $_POST['hora_inici'];
            $horaFi = $_POST['hora_fi'];
            $espai = $_POST['espai'];
            $tipus = $_POST['tipus'];
    
            
            $artistaModel = new ArtistaModel();
            $artista = $artistaModel->obtenirArtistaPerId($idArtista);
            
            // Manté la imatge existent de l'artista, a menys que se'n carregui una de nova
            $imatge = $artista['imatge_url'];
    
           
            if (isset($_FILES['imatge_file']) && $_FILES['imatge_file']['error'] == 0) {
                $target_dir = "images/imatgeArtistes/";// Directori on es guardaran les imatges
                $imageFileType = strtolower(pathinfo($_FILES['imatge_file']['name'], PATHINFO_EXTENSION));
                $target_file = $target_dir . "artista_" . $idArtista . "." . $imageFileType;
    
              
                if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
                    echo "Només es permeten arxius JPG, JPEG, PNG i GIF.<br>";
                    return;
                }
    
                //intenta moure l'arxiu
                if (move_uploaded_file($_FILES['imatge_file']['tmp_name'], $target_file)) {
                    $imatge = $target_file;  
                } else {
                    echo "Error en la pujada de la imatge.<br>";
                    return;
                }
            }
    
         // Actualitza les dades de l'artista
            if ($artistaModel->actualitzarArtista($idArtista, $nom, $horaInici, $horaFi, $espai, $tipus, $imatge)) {
               
                $this->redirect("usuari");
            } else {
                echo "No s'ha pogut actualitzar l'artista.<br>";
            }
        }
    }
    
 /**
     * Afegeix un nou artista a la base de dades.
     */
public function afegirArtista()
{
    //dades de formulari
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $nom = $_POST['nom'];
        $horaInici = $_POST['hora_inici'];
        $horaFi = $_POST['hora_fi'];
        $espai = $_POST['espai'];
        $tipus = $_POST['tipus'];
        $imatge = null; 

        // Si es carrega una nova imatge, es processa
        if (isset($_FILES['imatge_file']) && $_FILES['imatge_file']['error'] == 0) {
            $target_dir = "images/imatgeArtistes/";
            $imageFileType = strtolower(pathinfo($_FILES['imatge_file']['name'], PATHINFO_EXTENSION));
            $target_file = $target_dir . "artista_" . uniqid() . "." . $imageFileType; 

            
            if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
                echo "Només es permeten arxius JPG, JPEG, PNG i GIF.<br>";
                return;
            }

            
            if (move_uploaded_file($_FILES['imatge_file']['tmp_name'], $target_file)) {
                $imatge = $target_file; 
            } else {
                echo "Error en la pujada de la imatge.<br>";
                return;
            }
        }

        
        $artistaModel = new ArtistaModel();
        $idArtista = $artistaModel->afegirArtista($nom, $horaInici, $horaFi, $espai, $tipus, $imatge);

        if ($idArtista) {
           
            $this->redirect("usuari");
        } else {
            echo "Error en afegir l'artista.<br>";
        }
    }
}


}

?>
