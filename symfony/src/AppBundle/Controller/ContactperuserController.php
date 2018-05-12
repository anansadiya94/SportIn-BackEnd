<?php
/**
 * Created by PhpStorm.
 * User: Andres
 * Date: 06/05/2018
 * Time: 12:43
 */

namespace AppBundle\Controller;

use BackendBundle\Entity\User;
use BackendBundle\Entity\Contactperuser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactperuserController extends Controller
{
    //GET /contact/userid
    public function showUserContactsAction($userid){
        $helpers = $this->get("app.helpers");

        $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT * FROM User INNER JOIN ContactPerUser ON ContactPerUser.contact_userId=User.userId
        WHERE ContactPerUser.userId=$userid");
        $statement->execute();
        return new JsonResponse($statement->fetchAll());

    }
    //POST /contact
    // {"userId" : 1,"contactUserId" : 2}
    public function contactAction(Request $request){
/*
        // obtener el servicio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        // obtener los datos de la petición
        $json_params = $request->get("json", null);

        $contact = new Contactperuser();

        $contact->setUserid(json_decode($json_params)->{"userId"},null);
        $contact->setContactUserId(json_decode($json_params)->{"contactUserId"},null);

        // Invocar al manejador de BD
        $manager = $this->getDoctrine()->getManager();
        // Decirle al manejador que daras de alta ese objeto
        $manager->persist($contact);
        // Decirle que haga los cambios en BD
        $manager->flush();
        //return necesario
*/

        // obtener el servicio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        // obtener los datos de la petición
        $json_params = $request->get("json", null);

        $userId = json_decode($json_params)->{"userId"};
        $contact_userId = json_decode($json_params)->{"contact_userId"};
        $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
        $connection = $em->getConnection();

        $statement = $connection->prepare("INSERT INTO Contactperuser(userId, contact_userId) 
        SELECT $userId, $contact_userId FROM DUAL WHERE NOT EXISTS 
        (SELECT userId,contact_userId FROM Contactperuser c 
        WHERE c.userId=$userId AND c.contact_userId=$contact_userId)");
        $statement->execute();
        return $helpers->json(
            array(
                "status" => "OK",
                "code" => "200",
                "data" => "Contact added correctly"
            ));
        die();

    }

}