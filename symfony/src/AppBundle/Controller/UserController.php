<?php

namespace AppBundle\Controller;

use BackendBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;


class UserController extends Controller
{
    public function loginAction(Request $request){
        $jwt_auth = $this->get("app.jwt_auth");
        $helpers = $this->get("app.helpers");
        /* Recibimos los parámetros por POST */
        $json_params = $request->get("json", null);
        if($json_params != null){
            $params = json_decode($json_params);
            $email = (isset($params->email)) ? $params->email : null;
            $password = (isset($params->password)) ? $params->password : null;
            /* Validate Email */
            if(count($this->validateEmail($email)) == 0 && $password != null){
                // valid Email
                return new JsonResponse(
                    $jwt_auth->singin($email, $password));

            }else{
                //ER-0002: email inválido o password vacío
                return $helpers->json(
                    array(
                        "status" => "error",
                        "code" => "ER-0002",
                        "data" => "Email or password not valids!"

    

                    ));
                die();
            }
        }else{
            // ER-0001: Faltan parámetros para el login
            return $helpers->json(
                array(
                    "status" => "error",
                    "code" => "ER-0001",
                    "data" => "Data not found"
                ));
            die();
        }
    }

    // /user POST
    // {"username": "funciona", "surname": "hola", "email": "hsdd@gmail.com", "password": "vvsdsdad", "active": "1", "birthDate": "1982-04-05", "age": "22", "height": "22", "weight": "44", "bio": "adasdasdasdasdasdasdasdasdasdasddas", "sex": "H", "foot": "R", "historial": "he jugado aqui", "playerPositionId": 2, "roleId": 3, "countryId": 4, "populationId": 3, "clubId": 900}
    public function userAction(Request $request){

        // obtener el servicio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");

        // obtener los datos de la petición
        $json_params = $request->get("json", null);
        
        $user = new User();

        json_decode($json_params);
        $user->setUsername(json_decode($json_params)->{"username"},null);
        $user->setSurname(json_decode($json_params)->{"surname"},null);
        $user->setEmail(json_decode($json_params)->{"email"},null);
        $user->setPassword(json_decode($json_params)->{"password"},null); //cifrar
        $user->setActive(json_decode($json_params)->{"active"},null);
         $user->setBirthdate(new \DateTime(json_decode($json_params)->{"birthDate"},null));
        $user->setAge(json_decode($json_params)->{"age"},null);
        //$user->setProfilephoto(json_decode($json_params)->{"profilePhoto"},null);
        $user->setHeight(json_decode($json_params)->{"height"},null);
        $user->setWeight(json_decode($json_params)->{"weight"},null);
        $user->setBio(json_decode($json_params)->{"bio"},null);
        $user->setSex(json_decode($json_params)->{"sex"},null);
        $user->setFoot(json_decode($json_params)->{"foot"},null);
        $user->setHistorial(json_decode($json_params)->{"historial"},null);

        $playerPositionId = json_decode($json_params)->{"playerPositionId"};
        $playerPosition = $this->getDoctrine()->getRepository("BackendBundle:Playerposition")->findOneBy(
            array("playerpositionid" => $playerPositionId)
        );
        $user->setPlayerpositionid($playerPosition);

        $roleId = json_decode($json_params)->{"roleId"};
        $role = $this->getDoctrine()->getRepository("BackendBundle:Role")->findOneBy(
            array("roleid" => $roleId)
        );

        $user->setRoleid($role);

        $countryId = json_decode($json_params)->{"countryId"};
        $country = $this->getDoctrine()->getRepository("BackendBundle:Country")->findOneBy(
            array("countryid" => $countryId)
        );
        $user->setCountryid($country);


        $populationId = json_decode($json_params)->{"populationId"};
        $population = $this->getDoctrine()->getRepository("BackendBundle:Population")->findOneBy(
          array("populationid" => $populationId)
        );
        $user->setPopulationid($population);

        $clubId = json_decode($json_params)->{"clubId"};
        $club = $this->getDoctrine()->getRepository("BackendBundle:Club")->findOneBy(
          array("clubid" => $clubId)
        );
        $user->setClubid($club);

        $manager = $this->getDoctrine()->getManager();
        // Decirle al manejador que daras de alta ese objeto
        $manager->persist($user);
        // Decirle que haga los cambios en BD
        $manager->flush();

        return new JsonResponse(
            $jwt_auth->singin($user->getEmail(), $user->getPassword()));

       /* return $helpers->json(
            array(
                "status" => "OK",
                "code" => "200",
                "data" => "User added correctly"
            ));
        die();*/

    }

    // USER/ GET
    public function showAction($token){
/*
        $helpers = $this->get("app.helpers");
        if($id == null){
            $user = $this->getDoctrine()->getRepository("BackendBundle:User")->findAll();
        }else{
            $user = $this->getDoctrine()->getRepository("BackendBundle:User")->findOneBy(
                array("userid" => $id)
            );
        }
        return $helpers->json($user);
*/
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");
        if($token != null){

            $user = $jwt_auth->checkToken($token);
            if(is_object($user)){
                $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
                $connection = $em->getConnection();
                $query = "SELECT u.* , r.name as 'roleName', c.name as 'countryName', 
                c.NOC, p.name as 'populationName', p.province, pp.name as 'playerPositionName', cl.name as 'ClubName', pp.photo as 'photoPosition' 
                FROM User u 
                LEFT JOIN Role r ON r.roleId = u.roleId 
                LEFT JOIN Country c ON c.countryId = u.countryId 
                LEFT JOIN Population p ON p.populationId = u.populationId 
                LEFT JOIN PlayerPosition pp ON pp.playerPositionId = u.playerPositionId 
                LEFT JOIN Club cl ON cl.clubId = u.clubId WHERE u.userId = ".$user->getUserId();
                $statement = $connection->prepare($query);
                $statement->execute();
                return new JsonResponse($statement->fetchAll());

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

    }


    //POST /deactivateuser
    // {"userId" : 3}
    public function deactivateuserAction(Request $request){

        // obtener el servicio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");
        // obtener los datos de la petición
        //$json_params = $request->get("json", null);
        $user_token = $request->get("token", null);
        
        if($user_token != null){
            $user_auth = $jwt_auth->checkToken($user_token);
            if(is_object($user_auth)){
            $active = 0;
            //$userId = json_decode($json_params)->{"userId"};
            $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
            $connection = $em->getConnection();
            $statement = $connection->prepare("UPDATE User 
            SET active = $active
            WHERE userId = ".$user_auth->getUserId().";");
            $statement->execute();

            $result = $helpers->json(
                array(
                    "status" => "OK",
                    "code" => "200",
                    "data" => "User has been deactivated correctly"
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

    private function validateEmail($email){
        $email_constraint = new Email();
        $email_constraint->message = "The email is not valid!";
        return $this->get("validator")->validate($email, $email_constraint);
    }

    public function repeatedEmailAction($email){

        // obtener el servicio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT * FROM User u WHERE u.email='$email'");
        $statement->execute();
        
        if($statement->rowCount() == 0){
            return $helpers->json(
                array(
                    "status" => "ok",
                    "code" => "201",
                    "data" => "Valid Email"
                ));
            die();
        }else{
            return $helpers->json(
                array(
                    "status" => "error",
                    "code" => "202",
                    "data" => "Email already exists in the DB"
                ));
            die();

        }
    }


    //POST /editbiography
    // {"bio" : "dsdfasdfsdf"}
    public function editBiographyAction(Request $request){

        // obtener el servicio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");
        // obtener los datos de la petición
        $json_params = $request->get("json", null);
        $user_token = $request->get("token", null);

        $bio = json_decode($json_params)->{"bio"};
        
        if($user_token != null){
            $user_auth = $jwt_auth->checkToken($user_token);
            if(is_object($user_auth)){
            //$userId = json_decode($json_params)->{"userId"};
            $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
            $connection = $em->getConnection();
            $statement = $connection->prepare("UPDATE User 
            SET bio = '$bio'
            WHERE userId = ".$user_auth->getUserId().";");
            $statement->execute();

            $result = $helpers->json(
                array(
                    "status" => "OK",
                    "code" => "200",
                    "data" => "bio updated correctly"
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

    //POST /edithistorial
    // {"historial" : "dsdfasdfsdf"}
    public function editHistorialAction(Request $request){

        // obtener el servicio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");
        // obtener los datos de la petición
        $json_params = $request->get("json", null);
        $user_token = $request->get("token", null);

        $historial = json_decode($json_params)->{"historial"};
        
        if($user_token != null){
            $user_auth = $jwt_auth->checkToken($user_token);
            if(is_object($user_auth)){
            //$userId = json_decode($json_params)->{"userId"};
            $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
            $connection = $em->getConnection();
            $statement = $connection->prepare("UPDATE User 
            SET historial = '$historial'
            WHERE userId = ".$user_auth->getUserId().";");
            $statement->execute();

            $result = $helpers->json(
                array(
                    "status" => "OK",
                    "code" => "200",
                    "data" => "historial updated correctly"
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
