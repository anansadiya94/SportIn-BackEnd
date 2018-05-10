<?php
/**
 * Created by PhpStorm.
 * User: javi_
 * Date: 12/04/2018
 * Time: 19:15
 */

namespace AppBundle\Controller;

use BackendBundle\Entity\Announcement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AnnouncementController extends Controller
{

    //GET /announcement/id
    public function showAction($id){
        $helpers = $this->get("app.helpers");

        $announcement = $this->getDoctrine()->getRepository("BackendBundle:Announcement")->findAll();

        //return $helpers->json($announcement);

        $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT a.`*`,u.`*`, c.name as 
        'categoryName', pp.name as 'PlayerPositionName', r.name as 'RoleName' FROM Announcement a 
        INNER JOIN User u ON a.userId=u.userId
        INNER JOIN Category c ON a.categoryId= c.categoryId
        INNER JOIN PlayerPosition pp ON pp.playerPositionId = a.playerPositionId
        INNER JOIN Role r ON r.roleId = a.searchedRoleId
        WHERE a.userId = $id;");
        $statement->execute();
        return new JsonResponse($statement->fetchAll());

    }

     //GET /announcementPerRole/roleid
     public function showRoleAnnouncementsAction($roleid){
        $helpers = $this->get("app.helpers");

        $announcement = $this->getDoctrine()->getRepository("BackendBundle:Announcement")->findAll();

        //return $helpers->json($announcement);

        $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT a.`*`,u.`*`, c.name as 
        'categoryName', pp.name as 'PlayerPositionName', r.name as 'RoleName' FROM Announcement a 
        INNER JOIN User u ON a.userId=u.userId
        INNER JOIN Category c ON a.categoryId= c.categoryId
        INNER JOIN PlayerPosition pp ON pp.playerPositionId = a.playerPositionId
        INNER JOIN Role r ON r.roleId = a.searchedRoleId
        WHERE a.searchedRoleId = $roleid;");
        $statement->execute();
        return new JsonResponse($statement->fetchAll());

    }

    //GET /announcement/
    public function showsAction(){
 
 /*
        $helpers = $this->get("app.helpers");
        $announcement = new Announcement();

        $announcement = $this->getDoctrine()->getRepository("BackendBundle:Announcement")->findAll();

        return $helpers->json($announcement);
*/  
        $helpers = $this->get("app.helpers");
        $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT a.`*`,u.`*`, c.name as 
        'categoryName', pp.name as 'PlayerPositionName', r.name as 'RoleName' FROM Announcement a 
        INNER JOIN User u ON a.userId=u.userId
        INNER JOIN Category c ON a.categoryId= c.categoryId
        INNER JOIN PlayerPosition pp ON pp.playerPositionId = a.playerPositionId
        INNER JOIN Role r ON r.roleId = a.searchedRoleId;");
        $statement->execute();
        return new JsonResponse($statement->fetchAll());

    }


    //GET /announcementPerUser/userid
    public function showUserAnnouncementsAction($user_token){
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");

        if($user_token != null){
            $user_auth = $jwt_auth->checkToken($user_token);
            if(is_object($user_auth)){

                $result = $this->getDoctrine()->getRepository("BackendBundle:Announcement")->findBy(
                    array("userid" => $user_auth->getUserid())
                );
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
        return $helpers->json($result);
    }

    //POST /announcement
    // {"title" : "siu","description" : "descriptionsiiuu","userId" : 4,"active" : "1","modified" : "1","categoryId" : 1, "positionId": "1", "searchedRoleId": "1"}
    public function announcementAction(Request $request){

        // obtener el ser icio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        // obtenr los datos de la petición
        $json_params = $request->get("json", null);
        //$json_token = $request->get("token", null);
        var_dump($json_params);

        $announcement = new Announcement();

        $announcement->setUserid(json_decode($json_params)->{"userId"},null);
        $announcement->setTitle(json_decode($json_params)->{"title"},null);
        $announcement->setPublicationdate(new \DateTime('now'));
        $announcement->setActive(json_decode($json_params)->{"active"},null);
        $announcement->setDescription(json_decode($json_params)->{"description"},null);
        $announcement->setModified(json_decode($json_params)->{"modified"},null);

        $categoryId = json_decode($json_params)->{"categoryId"};

        $category = $this->getDoctrine()->getRepository("BackendBundle:Category")->findOneBy(
            array("categoryid" => $categoryId)
        );
        $announcement->setCategoryid($category);


        $positionId = json_decode($json_params)->{"positionId"};
        $position = $this->getDoctrine()->getRepository("BackendBundle:Playerposition")->findOneBy(
            array("playerpositionid" => $positionId)
        );
        $announcement->setPlayerpositiondid($position);


        $searchedRoleId = json_decode($json_params)->{"searchedRoleId"};
        $role = $this->getDoctrine()->getRepository("BackendBundle:Role")->findOneBy(
            array("roleid" => $searchedRoleId)
        );
        $announcement->setSearchedroleid($role);



        var_dump($announcement);
        // Invocar al manejador de BD
        $manager = $this->getDoctrine()->getManager();
        // Decirle al manejador que daras de alta ese objeto
        $manager->persist($announcement);
        // Decirle que haga los cambios en BD
        $manager->flush();
        //return necesario
        return new Response();

    }
}