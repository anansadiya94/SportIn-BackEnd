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

class PlayerpositionController extends Controller
{

    //GET /position/
    public function showPositionsAction(Request $request, $positionid){
        $helpers = $this->get("app.helpers");
        if($positionid != null){
            $positions = $this->getDoctrine()->getRepository("BackendBundle:Playerposition")->findOneBy(
                array("positionid" => $positionid)
            );
        }else{
            $positions = $this->getDoctrine()->getRepository("BackendBundle:Playerposition")->findAll();
        }
        return $helpers->json($positions);
    }
}