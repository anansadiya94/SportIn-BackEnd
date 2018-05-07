<?php
/**
 * Created by PhpStorm.
 * User: javi_
 * Date: 03/05/2018
 * Time: 17:41
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClubController extends Controller
{

    //GET /clubs/
    public function showClubsAction(Request $request, $clubid){
        $helpers = $this->get("app.helpers");
        if($clubid != null){
            $clubs = $this->getDoctrine()->getRepository("BackendBundle:Club")->findOneBy(
                array("clubid" => $clubid)
            );
        }else{
            $clubs = $this->getDoctrine()->getRepository("BackendBundle:Club")->findAll();
        }
        return $helpers->json($clubs);
    }
}