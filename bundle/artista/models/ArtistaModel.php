<?php

class ArtistaModel {
    
    /**
     
     * @return array
     */

     /**
     * Obté tots els artistes de la Base de Dades
     * Realitza una consulta JOIN entre les taules Artista i Tipus.
     * Retorna un array amb tots els artistes.
     */
    public function obtenirArtistes()
    {
        try {
            
            //Obte tot + join per saber canviar id tipus amb el nom
            $consulta = BdD::$connection->prepare('SELECT Artista.*, Tipus.nom_tipus FROM Artista JOIN Tipus ON Artista.id_tipus = Tipus.id_tipus;');
            $consulta->execute();
            
          
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            return $consulta->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); //En cas d'error
            return [];
        }
    }
     /**
     * Obté un artista per la seva ID.
     * Filtra els resultats per l'ID proporcionat.
     */

    public function obtenirArtistaPerId($idArtista)
    {
        try {
            $consulta = BdD::$connection->prepare('SELECT Artista.*, Tipus.nom_tipus FROM Artista JOIN Tipus ON Artista.id_tipus = Tipus.id_tipus WHERE Artista.id_artista = :id');
            $consulta->bindParam(':id', $idArtista, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error a obtenir l'artista: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Elimina un artista de la base de dades per ID.
     * Retorna true si l'artista ha estat eliminat correctament.
     */
    public function eliminarArtista($idArtista)
    {
        try {
            $consulta = BdD::$connection->prepare('DELETE FROM Artista WHERE id_artista = :id');
            $consulta->bindParam(':id', $idArtista, PDO::PARAM_INT);
            $consulta->execute();
            
            // Si afecta alguna columna, es perfecte (retorna true)
            return $consulta->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error a l'eliminar artista: " . $e->getMessage();
            return false;
        }
    }

     /**
     * Actualitza les dades d'un artista existent.
     * Modifica diversos camps de la taula Artista.
     * Retorna true si s'ha actualitzat correctament.
     */
    public function actualitzarArtista($idArtista, $nom, $horaInici, $horaFi, $espai, $tipus, $imatge)
    {
        try {
           
            $consulta = BdD::$connection->prepare(
                'UPDATE Artista 
                SET nom = :nom, hora_inici = :hora_inici, hora_fi = :hora_fi, nom_espai = :espai, id_tipus = :tipus, imatge_url = :imatge 
                WHERE id_artista = :id_artista'
            );
    
          
            $consulta->bindParam(':nom', $nom);
            $consulta->bindParam(':hora_inici', $horaInici);
            $consulta->bindParam(':hora_fi', $horaFi);
            $consulta->bindParam(':espai', $espai);
            $consulta->bindParam(':tipus', $tipus, PDO::PARAM_INT);
            $consulta->bindParam(':imatge', $imatge);
            $consulta->bindParam(':id_artista', $idArtista, PDO::PARAM_INT);
    
            
            $consulta->execute();
    
           
            if ($consulta->rowCount() > 0) {
                return true;
            } else {
                echo "No hi ha canvis o l'artista no existeix.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Error a l'actualitzar l'artista: " . $e->getMessage();
            return false;
        }
    }
    

     /**
     * Afegeix un nou artista a la base de dades.
     * Retorna l'ID de l'artista creat.
     */

    public function afegirArtista($nom, $horaInici, $horaFi, $espai, $tipus, $imatge = null)
{
    try {
        
        $consulta = BdD::$connection->prepare(
            'INSERT INTO Artista (nom, hora_inici, hora_fi, nom_espai, id_tipus, imatge_url) 
            VALUES (:nom, :hora_inici, :hora_fi, :espai, :tipus, :imatge)'
        );
        
       
        $consulta->bindParam(':nom', $nom);
        $consulta->bindParam(':hora_inici', $horaInici);
        $consulta->bindParam(':hora_fi', $horaFi);
        $consulta->bindParam(':espai', $espai);
        $consulta->bindParam(':tipus', $tipus, PDO::PARAM_INT);
        $consulta->bindParam(':imatge', $imatge);

       
        $consulta->execute();

        // Retorna l'ID de l'artista afegit per despres
        $idArtista = BdD::$connection->lastInsertId();

        return $idArtista; 

    } catch (PDOException $e) {
        echo "Error a l'afegir l'artista: " . $e->getMessage();
        return false;
    }
}


    
}
?>
