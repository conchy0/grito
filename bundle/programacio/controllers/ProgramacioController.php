<?php

//per poder fer servir les seves funcions
require_once './bundle/artista/models/ArtistaModel.php';

/**
     * Petició per a la pàgina de programació.
     * Carrega la vista de programació amb la llista d'artistes.
     */
class ProgramacioController extends Controller {

    public function process($params) {
        $this->data['TITOL'] = "Programacio";
        if (isset($params[0]) && $params[0] == "") {
            $this->redirect("programacio");
        } else {
           
            // Instància del model ArtistaModel
            $artistaModel = new ArtistaModel();
            
             // Obtenir tots els artistes de la base de dades
            $artistes = $artistaModel->obtenirArtistes();
            
            // Posa a data la llista d'artistes per passar-la a la vista
            $this->data['artistes'] = $artistes;
            $this->head['title'] = "La programació";
            
            $this->twig = "programacio.html"; 
            
        }
    }
}   
?>
