<?php
/**
 * Created by PhpStorm.
 * User: Diee
 * Date: 18/04/2018
 * Time: 10:59
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class CountryController extends Controller
{
    /* GET */
    public function showAction(Request $request, $id){
        $helpers = $this->get("app.helpers");
        $image_loader = $this->get("app.image_loader");
        if($id != null){
            //GET all the countries
            $result =
                $this->getDoctrine()->getRepository("BackendBundle:Country")->findOneBy(
                    array("countryid" => $id)
                );
            $result = $image_loader->loadImage($result);
        }else{

            $result =  array(
                "status" => "error",
                "code" => "ER-0004",
                "data" => "No ID specified!"
            );

        }

        return $helpers->json($result);
    }

    //GET /countries/
     public function showCountriesAction(){
        $helpers = $this->get("app.helpers");
        $image_loader = $this->get("app.image_loader");
        $countries = $this->getDoctrine()->getRepository("BackendBundle:Country")->findAll();
        if($countries != null){
            $countries = $image_loader->loadImage($countries);
        }
        return $helpers->json($countries);
    }

}

