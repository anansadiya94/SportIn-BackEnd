<?php
/**
 * Created by PhpStorm.
 * User: javi_
 * Date: 03/05/2018
 * Time: 17:39
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RoleController extends Controller
{
    //GET /roles/
    public function showRolesAction(){
        $helpers = $this->get("app.helpers");

        $history = $this->getDoctrine()->getRepository("BackendBundle:Role")->findAll();

        return $helpers->json($history);
    }
}