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
    public function showClubsAction($clubid){
        $helpers = $this->get("app.helpers");
        if($clubid != null){
            $clubs = $this->getDoctrine()->getRepository("BackendBundle:Club")->findOneBy(
                array("clubid" => $clubid)
            );
            return $helpers->json($clubs);
        }else{
            //$clubs = $this->getDoctrine()->getRepository("BackendBundle:Club")->findAll();

            $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
            $connection = $em->getConnection();
            $statement = $connection->prepare("SELECT * FROM Club WHERE province IS NOT NULL;");
            $statement->execute();
            return new JsonResponse($statement->fetchAll());
        }
        //return $helpers->json($clubs);
    }
}