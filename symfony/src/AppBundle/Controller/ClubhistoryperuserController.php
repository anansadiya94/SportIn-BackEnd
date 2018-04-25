<?php
/**
 * Created by PhpStorm.
 * User: javi_
 * Date: 24/04/2018
 * Time: 0:04
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BackendBundle\Entity\Clubhistoryperuser;
use BackendBundle\Entity\Country;
use BackendBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\HttpFoundation\Response;

class ClubhistoryperuserController extends Controller
{
    //GET /clubhistoryperuser/userid
    public function showAction($userid){
        $helpers = $this->get("app.helpers");

        $history = $this->getDoctrine()->getRepository("BackendBundle:Clubhistoryperuser")->findBy(
            array("userid" => $userid)
        );

        return $helpers->json($history);
    }

    //POST /clubhistoryperuser
    // {"userId" : "1","bio" : "biosdasdasda","clubId" : 4,"active" : "1","current" : "1","startDate" : "1998-04-07", "endDate": "1999-05-07"}
    public function clubhistoryperuserAction(Request $request){

        // obtener el ser icio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        // obtenr los datos de la petición
        $json_params = $request->get("json", null);
        //$json_token = $request->get("token", null);
        var_dump($json_params);

        $clubHistoryPerUser = new Clubhistoryperuser();

        /*
        //Deberia ser asi el userId
        $userId = json_decode($json_params)->{"userId"};
        $user = $this->getDoctrine()->getRepository("BackendBundle:User")->findOneBy(
            array("userid" => $userId)
        );
        $clubHistoryPerUser->setUserid($user);
        */
        $clubHistoryPerUser->setUserid(json_decode($json_params)->{"userId"},null);



        $clubId = json_decode($json_params)->{"clubId"};
        $club = $this->getDoctrine()->getRepository("BackendBundle:Club")->findOneBy(
            array("clubid" => $clubId)
        );
        $clubHistoryPerUser->setClubid($club);

        $clubHistoryPerUser->setBio(json_decode($json_params)->{"bio"},null);
        $clubHistoryPerUser->setStartdate(new \DateTime(json_decode($json_params)->{"startDate"},null));
        $clubHistoryPerUser->setEnddate(new \DateTime(json_decode($json_params)->{"endDate"},null));
        $clubHistoryPerUser->setActive(json_decode($json_params)->{"active"},null);
        $clubHistoryPerUser->setCurrent(json_decode($json_params)->{"current"},null);


        var_dump($clubHistoryPerUser);
        // Invocar al manejador de BD
        $manager = $this->getDoctrine()->getManager();
        // Decirle al manejador que daras de alta ese objeto
        $manager->persist($clubHistoryPerUser);
        // Decirle que haga los cambios en BD
        $manager->flush();
        //return necesario
        return new Response();

    }

}