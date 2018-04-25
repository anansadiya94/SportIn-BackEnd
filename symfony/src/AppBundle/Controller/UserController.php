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
    //MIRAR DE HACER BIEN!!
    public function userAction(Request $request){

        /* No ACABADO AÚN */
        // obtener el ser icio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        // obtenr los datos de la petición
        $json_params = $request->get("json", null);
        //$json_params = $this->get($request)->getContent();
        //$json_params = $request->getContent();
        //$json_token = $request->get("token", null);
        //var_dump($json_params);

        $user = new User();

        json_decode($json_params);
        $user->setUsername(json_decode($json_params)->{"username"},null);
        $user->setSurname(json_decode($json_params)->{"surname"},null);
        //$user->setSurname2(json_decode($json_params)->{"surname2"},null);
        $user->setEmail(json_decode($json_params)->{"email"},null);
        $user->setPassword(json_decode($json_params)->{"password"},null); //cifrar
        $user->setActive(json_decode($json_params)->{"active"},null);
        //$user->setBirthdate(json_decode($json_params)->{"birthDate"},null);
         $user->setBirthdate(new \DateTime(json_decode($json_params)->{"birthDate"},null));
        $user->setAge(json_decode($json_params)->{"age"},null);
        //$user->setProfilephoto(json_decode($json_params)->{"profilePhoto"},null);
        $user->setHeight(json_decode($json_params)->{"height"},null);
        $user->setWeight(json_decode($json_params)->{"weight"},null);
        $user->setBio(json_decode($json_params)->{"bio"},null);
        $user->setSex(json_decode($json_params)->{"sex"},null);
        $user->setFoot(json_decode($json_params)->{"foot"},null);
        $user->setPosition(json_decode($json_params)->{"position"},null);
        $user->setHistorial(json_decode($json_params)->{"historial"},null);
/*
        $roleId = json_decode($json_params)->{"roleId"};
        $role = $this->getDoctrine()->getRepository("BackendBundle:Role")->findOneBy(
            array("roleid" => $roleId)
        );

        $user->setRoleid($role);
*/

/**     $countryId = json_decode($json_params)->{"countryId"};
        $country = $this->getDoctrine()->getRepository("BackendBundle:Country")->findOneBy(
            array("countryid" => $countryId)
        );
        $user->setCountryid($country);
*/
/*
        $populationId = json_decode($json_params)->{"populationId"};
        $population = $this->getDoctrine()->getRepository("BackendBundle:Population")->findOneBy(
          array("populationid" => $populationId)
        );
        $user->setPopulationid($population);
/*/
        $manager = $this->getDoctrine()->getManager();
        // Decirle al manejador que daras de alta ese objeto
        $manager->persist($user);
        // Decirle que haga los cambios en BD
        $manager->flush();

        return $helpers->json(
            array(
                "status" => "OK",
                "code" => "200",
                "data" => "User added correctly"
            ));
        die();

    }

    // USER/ GET
    public function showAction(Request $request, $id){
        $helpers = $this->get("app.helpers");
        if($id == null){
            $user = $this->getDoctrine()->getRepository("BackendBundle:User")->findAll();
        }else{
            $user = $this->getDoctrine()->getRepository("BackendBundle:User")->findOneBy(
                array("userid" => $id)
            );
        }
        return $helpers->json($user);

    }
    private function validateEmail($email){
        $email_constraint = new Email();
        $email_constraint->message = "The email is not valid!";
        return $this->get("validator")->validate($email, $email_constraint);
    }
}
