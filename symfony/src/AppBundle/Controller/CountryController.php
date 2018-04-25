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
        if($id == null){
            //GET all the countrys
            $country_results =
                $this->getDoctrine()->getRepository("BackendBundle:Country")->findAll();
        }else{
            $country_results =
                $this->getDoctrine()->getRepository("BackendBundle:Country")->findOneBy(
                    array("countryid" => $id)
                );
        }

        $country_results = $image_loader->loadImage($country_results);
        return $helpers->json($country_results);
    }

    //GET /countries/
     public function showCountriesAction(){
        $helpers = $this->get("app.helpers");

        $history = $this->getDoctrine()->getRepository("BackendBundle:Country")->findAll();

        return $helpers->json($history);
    }

    //GET /populations/
    public function showPopulationsAction(){
        $helpers = $this->get("app.helpers");

        $history = $this->getDoctrine()->getRepository("BackendBundle:Population")->findAll();

        return $helpers->json($history);
    }
}

