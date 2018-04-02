<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    public function loginAction(Request $request){
        $helpers = $this->get("app.helpers");
        /* Recibimos los parámetros por POST */
        $json_params = $request->get("json", null);
        if($json_params != null){
            $params = json_decode($json_params);
            $email = (isset($params->email)) ? $params->email : null;
            $password = (isset($params->password)) ? $params->password : null;
            /* Validate Email */
            if(count($helpers->validateEmail($email)) == 0 && $password != null){
                // valid Email

            }

            //var_dump($email, $password);
            $em = $this->getDoctrine()->getManager();
        }else{
            // ER-0001: Faltan parámetros para el login

        }

        die();

    }

    public function rolesAction(){
        $helpers = $this->get("app.helpers");
        $em = $this->getDoctrine()->getManager();
        $roles = $em->getRepository("BackendBundle:Role")->findAll();
        /* VAR_DUMP => Nos permite mostrar los datos de una variable por pantalla */
        //var_dump($roles);
        return $helpers->json($roles);

       // die();
    }
}
