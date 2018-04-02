<?php

namespace AppBundle\Controller;

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

    private function validateEmail($email){
        $email_constraint = new Email();
        $email_constraint->message = "The email is not valid!";
        return $this->get("validator")->validate($email, $email_constraint);
    }
}
