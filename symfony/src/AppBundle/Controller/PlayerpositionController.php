<?php
/**
 * Created by PhpStorm.
 * User: javi_
 * Date: 03/05/2018
 * Time: 17:41
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerpositionController extends Controller
{

    //GET /position/
    public function showPositionsAction($positionid){
        $helpers = $this->get("app.helpers");
        if($positionid != null){
            $positions = $this->getDoctrine()->getRepository("BackendBundle:Playerposition")->findOneBy(
                array("playerpositionid" => $positionid)
            );
            return $helpers->json($positions);
        }else{
            //$positions = $this->getDoctrine()->getRepository("BackendBundle:Playerposition")->findAll();
            $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
            $connection = $em->getConnection();
            $statement = $connection->prepare("SELECT * FROM PlayerPosition WHERE active = 1;");
            $statement->execute();
            return new JsonResponse($statement->fetchAll());
        }
        //return $helpers->json($positions);
    }
}