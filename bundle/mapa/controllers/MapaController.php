<?php
class mapaController extends Controller
{
     /**
     * Petició per a la pàgina del mapa.
     * Redirigeix o carrega la vista del mapa segons els paràmetres rebuts.
     */
    public function process($params)
    {
        //titol
        $this->data['TITOL'] = "Mapa";
        if (isset($params[0]) &&$params[0]=="")
        {
            $this->redirect("mapa");
        }
        else
        {
            $this->twig="mapa.html";//crida el html
        }
    }
}
