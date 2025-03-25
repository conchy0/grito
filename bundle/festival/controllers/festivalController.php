<?php
class festivalController extends Controller
{

    /**
     * Processa les peticions per la pàgina del festival.
     * Depenent dels paràmetres rebuts, redirigeix o carrega la vista corresponent.
     */
    public function process($params)
    {
        //Assignar Titol
        $this->data['TITOL'] = "Festival";
        if (isset($params[0]) &&$params[0]=="")
        {
            $this->redirect("festival");
        }
        else
        {
            $this->twig="festival.html";
        }
    }
}
