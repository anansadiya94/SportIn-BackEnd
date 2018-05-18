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
    public function showUserContactsAction($token){
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");


        if($token != null) {
            $user = $jwt_auth->checkToken($token);
            if (is_object($user)) {
                $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
                $connection = $em->getConnection();
                $statement = $connection->prepare(
                    "SELECT * FROM User INNER JOIN ContactPerUser ON ContactPerUser.contact_userId=User.userId
              WHERE ContactPerUser.userId=".$user->getUserId());
                $statement->execute();
                return new JsonResponse($statement->fetchAll());

            } else {
                //ER-0006: not a valid token
                return $helpers->json(
                    array(
                        "status" => "error",
                        "code" => "ER-0006",
                        "data" => "Received token not valid!"
                    ));
                die();
            }
        }else{
            //ER-0005: token not specified
            return $helpers->json(
                array(
                    "status" => "error",
                    "code" => "ER-0005",
                    "data" => "token not specified"
                ));
            die();
        }

    }
    //POST /contact
    // {"userId" : 1,"contact_userId" : 2}
    public function contactAction(Request $request){

        // obtener el servicio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");
        // obtener los datos de la petición
        $json_params = $request->get("json", null);
        $user_token = $request->get("token", null);
        
        if($user_token != null){
            $user_auth = $jwt_auth->checkToken($user_token);
            if(is_object($user_auth) &&
                ($user_auth->getUserId() == json_decode($json_params)->{"userId"}) ){


            $userId = json_decode($json_params)->{"userId"};
            $contact_userId = json_decode($json_params)->{"contact_userId"};
            $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
            $connection = $em->getConnection();

            $statement = $connection->prepare("INSERT INTO ContactPerUser(userId, contact_userId) 
            SELECT $userId, $contact_userId FROM DUAL WHERE NOT EXISTS 
            (SELECT userId,contact_userId FROM ContactPerUser c 
            WHERE c.userId=$user_auth->getUserId() AND c.contact_userId=$contact_userId)");
            $statement->execute();
            $result = $helpers->json(
                array(
                    "status" => "OK",
                    "code" => "200",
                    "data" => "Contact added correctly"
                ));

            }else{
                    //ER-0006: not a valid token
                    return $helpers->json(
                        array(
                            "status" => "error",
                            "code" => "ER-0006",
                            "data" => "Received token not valid!"
                        ));
                    die();
                }
        }else{
            //ER-0005: token not specified
            return $helpers->json(
                array(
                    "status" => "error",
                    "code" => "ER-0005",
                    "data" => "token not specified"
                ));
            die();
        }

        return $result;

    }

}