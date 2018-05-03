<?php
/**
 * Created by PhpStorm.
 * User: javi_
 * Date: 03/05/2018
 * Time: 17:41
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class ClubController extends Controller
{

    //GET /clubs/
    public function showClubsAction(){
        $helpers = $this->get("app.helpers");

        $history = $this->getDoctrine()->getRepository("BackendBundle:Club")->findAll();

        return $helpers->json($history);
    }
}