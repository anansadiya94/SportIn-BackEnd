<?php
/**
 * Created by PhpStorm.
 * User: javi_
 * Date: 23/04/2018
 * Time: 17:23
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackendBundle\Entity\Playerpositionperuser;
use BackendBundle\Entity\Playerposition;


class PlayerpositionperuserController extends Controller
{
    //GET playerpositionperuser/userid
    public function showAction($userid){
        $helpers = $this->get("app.helpers");
/*
        $user = $this->getDoctrine()->getRepository("BackendBundle:Playerpositionperuser")->findBy(
            array("userid" => $userid)
        );
        return $helpers->json($user);
*/
        $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT * FROM PlayerPositionPerUser INNER JOIN PlayerPosition ON PlayerPositionPerUser.playerPositionId=PlayerPosition.playerPositionId
        WHERE PlayerPositionPerUser.userId = $userid;");
        $statement->execute();
        return new JsonResponse($statement->fetchAll());
    }

    //POST /playerpositionperuser
    //{"userId" : 1, "prefered" : 0, "active":1, "playerPositionId":8}
    public function playerpositionperuserAction(Request $request){

        // obtener el ser icio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        // obtenr los datos de la petición
        $json_params = $request->get("json", null);
        //$json_token = $request->get("token", null);
        var_dump($json_params);

        $playerPositionPerUser = new Playerpositionperuser();

        $playerPositionPerUser->setUserid(json_decode($json_params)->{"userId"},null);
        $playerPositionPerUser->setPrefered(json_decode($json_params)->{"prefered"},null);
        $playerPositionPerUser->setActive(json_decode($json_params)->{"active"},null);

        $playerpositionid = json_decode($json_params)->{"playerPositionId"};
        $playerposition = $this->getDoctrine()->getRepository("BackendBundle:Playerposition")->findOneBy(
            array("playerpositionid" => $playerpositionid)
        );
        $playerPositionPerUser->setPlayerpositionid($playerposition);

        var_dump($playerPositionPerUser);
        // Invocar al manejador de BD
        $manager = $this->getDoctrine()->getManager();
        // Decirle al manejador que daras de alta ese objeto
        $manager->persist($playerPositionPerUser);
        // Decirle que haga los cambios en BD
        $manager->flush();
        //return necesario
        return new Response();

    }

}