<?php
/**
 * Created by PhpStorm.
 * User: javi_
 * Date: 03/05/2018
 * Time: 17:37
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PopulationController extends Controller
{
    //GET /populations/
    public function showPopulationsAction(){
        $helpers = $this->get("app.helpers");

        $history = $this->getDoctrine()->getRepository("BackendBundle:Population")->findAll();

        return $helpers->json($history);
    }
}