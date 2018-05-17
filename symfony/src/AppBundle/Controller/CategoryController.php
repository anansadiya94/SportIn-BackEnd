<?php
/**
 * Created by PhpStorm.
 * User: javi_
 * Date: 03/05/2018
 * Time: 17:41
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{

    //GET /categories/
    public function showCategoriesAction($categoryid){
        $helpers = $this->get("app.helpers");
        if($categoryid != null){
            $categories = $this->getDoctrine()->getRepository("BackendBundle:Category")->findOneBy(
                array("categoryid" => $categoryid)
            );
        }else{
            $categories = $this->getDoctrine()->getRepository("BackendBundle:Category")->findAll();
        }
        return $helpers->json($categories);
    }
}