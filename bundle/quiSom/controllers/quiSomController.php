<?php
class quiSomController extends Controller
{
    /**
     * Processa la petició per a la pàgina.
     * Carrega la vista de la pàgina "Qui Som" segons els paràmetres rebuts.
     */
    public function process($params)
    {

        $this->data['TITOL'] = "QuiSom";
        if (isset($params[0]) &&$params[0]=="")
        {
            $this->redirect("quiSom");
        }
        else
        {
            $this->twig="quiSom.html";
        }
    }
}
