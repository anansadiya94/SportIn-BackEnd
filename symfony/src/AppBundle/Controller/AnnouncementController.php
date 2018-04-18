<?php
/**
 * Created by PhpStorm.
 * User: javi_
 * Date: 12/04/2018
 * Time: 19:15
 */

namespace AppBundle\Controller;

use BackendBundle\Entity\Announcement;
use BackendBundle\Entity\Country;
use BackendBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;

class AnnouncementController extends Controller
{

    //announcement/1
    public function showAction($id){
        $helpers = $this->get("app.helpers");
        if($id == null){
            $announcement = $this->getDoctrine()->getRepository("BackendBundle:Announcement")->findAll();
        }else{
            $announcement = $this->getDoctrine()->getRepository("BackendBundle:Announcement")->findOneBy(
                array("announcementid" => $id)
            );
        }


        return $helpers->json($announcement);

    }

    // /announcement
    public function announcementAction(Request $request){

        // obtener el ser icio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        // obtenr los datos de la petición
        $json_params = $request->get("json", null);
        //$json_token = $request->get("token", null);
        var_dump($json_params);

        $announcement = new Announcement();

        //FALLA LA FECHA, NO SE CAMBIA BIEN AL FORMATO DE LA BASE DE DATOS
        json_decode($json_params);
        $announcement->setUserid(json_decode($json_params)->{"userId"},null);
        $announcement->setTitle(json_decode($json_params)->{"title"},null);
        $announcement->setPublicationdate(json_decode($json_params)->{"publicationDate"},null);
        $announcement->setActive(json_decode($json_params)->{"active"},null);
        $announcement->setDescription(json_decode($json_params)->{"description"},null);
        $announcement->setModified(json_decode($json_params)->{"modified"},null);

        $categoryId = json_decode($json_params)->{"categoryId"};

        $category = $this->getDoctrine()->getRepository("BackendBundle:Category")->findOneBy(
            array("categoryid" => $categoryId)
        );
        $announcement->setCategoryid($category);

        var_dump($announcement);
        // Invocar al manejador de BD
        //$manager = $this->manager->getDoctrine()->getRepository("BackendBundle:User");
        //$manager = $this->getDoctrine()->getRepository("BackendBundle:User");
        $manager = $this->getDoctrine()->getManager();
        // Decirle al manejador que daras de alta ese objeto
        $manager->persist($announcement);
        // Decirle que haga los cambios en BD
        $manager->flush();

    }





}