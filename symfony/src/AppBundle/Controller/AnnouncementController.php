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
        $connection = $em->getConnection(); //arreglado po.name
        $statement = $connection->prepare("SELECT a.`*`,u.`*`, c.name as 
        'categoryName', pp.name as 'PlayerPositionName', r.name as 'RoleName', po.name as 'PopulationName' FROM Announcement a 
        INNER JOIN User u ON a.userId=u.userId
        INNER JOIN Category c ON a.categoryId= c.categoryId
        INNER JOIN PlayerPosition pp ON pp.playerPositionId = a.playerPositionId
        INNER JOIN Role r ON r.roleId = a.searchedRoleId
        INNER JOIN Population po ON u.populationId = po.populationId
        WHERE a.announcementId = $id
        AND a.active = 1;");
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
        $statement = $connection->prepare("SELECT a.*, u.*, c.name as 
        'categoryName', r.name as 'RoleName', pp.name as 'playerPositionName', pp.photo as 'photoPosition',
        p.name as 'populationName', co.name as 'countryName', cl.name as 'clubName'
        FROM Announcement a 
        INNER JOIN User u ON a.userId=u.userId
        INNER JOIN Category c ON a.categoryId= c.categoryId
        INNER JOIN Role r ON r.roleId = u.roleId
        INNER JOIN PlayerPosition pp ON u.playerPositionId=pp.playerPositionId  
        INNER JOIN Country co ON co.countryId=u.countryId
        INNER JOIN Population p ON p.populationId=u.populationId
        INNER JOIN Club cl ON cl.clubId=u.clubId
        WHERE a.active = 1
        ORDER BY a.publicationDate DESC;");
        $statement->execute();
        return new JsonResponse($statement->fetchAll());

    }

    //POST /modifyannouncement
    // {"announcementId": 4}
    public function modifyAnnouncementAction(Request $request){

        // obtener el servicio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");
        // obtener los datos de la petición
        $json_params = $request->get("json", null);
        $user_token = $request->get("token", null);
        //var_dump($user_token);
        //die();

        $announcementId = json_decode($json_params)->{"announcementId"};
        if($user_token != null){
            $user_auth = $jwt_auth->checkToken($user_token);
            //var_dump(($user_auth));
            //die();
            if(is_object($user_auth)){

                $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
                $connection = $em->getConnection();
                $statement = $connection->prepare("UPDATE Announcement 
                SET active = 0
                WHERE announcementId = $announcementId;");
                $statement->execute();
                $result = $helpers->json(
                    array(
                        "status" => "OK",
                        "code" => "200",
                        "data" => "Announcement deActivated correctly"
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


    //GET /announcementPerUser/userid
    public function showUserAnnouncementsAction($user_token){
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");

        $result = "null";
        if($user_token != null){
            $user_auth = $jwt_auth->checkToken($user_token);
            if(is_object($user_auth)){

                /*
                $result = $this->getDoctrine()->getRepository("BackendBundle:Announcement")->findBy(
                    array("userid" => $user_auth->getUserId())
                );
                */
                $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
                $connection = $em->getConnection();
                $statement = $connection->prepare("SELECT * FROM Announcement WHERE userId =".$user_auth->getUserId()." AND active = 1;");
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
        return $helpers->json($result);
    }

    //POST /announcement
    // {"title" : "siu","description" : "descriptionsiiuu","userId" : 4,"active" : "1","modified" : "1","categoryId" : 1, "positionId": "1", "searchedRoleId": "1", "image":"dsfsdfsd"}
    public function announcementAction(Request $request){

        // obtener el servicio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");
        // obtener los datos de la petición
        $json_params = $request->get("json", null);
        $user_token = $request->get("token", null);
        //var_dump($user_token);
        //die();

        if($user_token != null){
            $user_auth = $jwt_auth->checkToken($user_token);
            //var_dump(($user_auth));
            //die();
            if(is_object($user_auth)){

                $announcement = new Announcement();
                //funciona
                $announcement->setUserid($user_auth->getUserId());
                $announcement->setTitle(json_decode($json_params)->{"title"},null);
                $announcement->setPublicationdate(new \DateTime('now'));
                $announcement->setActive(json_decode($json_params)->{"active"},null);
                $announcement->setDescription(json_decode($json_params)->{"description"},null);
                $announcement->setModified(json_decode($json_params)->{"modified"},null);

                $announcement->setPhoto(json_decode($json_params)->{"image"}, null);
                

                $categoryId = json_decode($json_params)->{"categoryId"};

                $category = $this->getDoctrine()->getRepository("BackendBundle:Category")->findOneBy(
                    array("categoryid" => $categoryId)
                );
                $announcement->setCategoryid($category);


                $positionId = json_decode($json_params)->{"positionId"};
                $position = $this->getDoctrine()->getRepository("BackendBundle:Playerposition")->findOneBy(
                    array("playerpositionid" => $positionId)
                );
                $announcement->setPlayerpositionid($position);


                $searchedRoleId = json_decode($json_params)->{"searchedRoleId"};
                $role = $this->getDoctrine()->getRepository("BackendBundle:Role")->findOneBy(
                    array("roleid" => $searchedRoleId)
                );
                $announcement->setSearchedroleid($role);



                //var_dump($announcement);
                // Invocar al manejador de BD
                $manager = $this->getDoctrine()->getManager();
                // Decirle al manejador que daras de alta ese objeto
                $manager->persist($announcement);
                // Decirle que haga los cambios en BD
                $manager->flush();
                //return necesario
                $result = $helpers->json(
                    array(
                        "status" => "OK",
                        "code" => "200",
                        "data" => "Announcement added correctly"
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