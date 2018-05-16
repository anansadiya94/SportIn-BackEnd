<?php
/**
 * Created by PhpStorm.
 * User: javi_
 * Date: 26/04/2018
 * Time: 23:56
 */

namespace AppBundle\Controller;


use BackendBundle\Entity\Reactedannouncement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReactedannouncementController extends Controller
{

    //GET /reactedannouncement/userid/interested
    //userid soy yo, es decir, el usuario que quiere ver sus ofertas
    //interested 0:espera - 1:aceptado - 2:rechazado
    public function showAction($token, $interested){
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");

        if($token != null) {

            $user = $jwt_auth->checkToken($token);
            if(is_object($user)){

                $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
                $connection = $em->getConnection();
                $statement = $connection->prepare("SELECT * FROM ReactedAnnouncement INNER JOIN Announcement ON ReactedAnnouncement.announcementId=Announcement.announcementId
                INNER JOIN User ON Announcement.userId=User.userId
                WHERE ReactedAnnouncement.interested = $interested
                AND ReactedAnnouncement.userId = $user->getUserid();");
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
    }

    //GET /reactedannouncementnotification/userid
    //user id aqui es la persona que quiere ver sus notificaciones.
    public function showNotificationsAction($token)
    {
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");

        if ($token != null) {
            $user = $jwt_auth->checkToken($token);
            if (is_object($user)) {
                $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
                $connection = $em->getConnection();
                $statement = $connection->prepare("SELECT * FROM ReactedAnnouncement INNER JOIN Announcement ON ReactedAnnouncement.announcementId=Announcement.announcementId
                INNER JOIN User ON ReactedAnnouncement.userId=User.userId
                WHERE ReactedAnnouncement.interested = 0
                AND Announcement.userId = $user->getUserid();");
                $statement->execute();
                return new JsonResponse($statement->fetchAll());
            }else {
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
    }

    //POST /updatereactedannouncement
    // {"reactedAnnouncementId" : 3,"interested" : 2}
    public function updatereactedannouncementAction(Request $request){

        // obtener el ser icio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        // obtenr los datos de la petición
        $json_params = $request->get("json", null);
        //$json_token = $request->get("token", null);
        var_dump($json_params);

        $interested = null;
        $reactedAnnouncementId = null;
        $interested = json_decode($json_params)->{"interested"};
        $reactedAnnouncementId = json_decode($json_params)->{"reactedAnnouncementId"};
        $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
        $connection = $em->getConnection();
        $statement = $connection->prepare("UPDATE ReactedAnnouncement 
        SET interested = $interested
        WHERE reactedannouncementId = $reactedAnnouncementId;");
        $statement->execute();

        return $helpers->json(
            array(
                "status" => "OK",
                "code" => "200",
                "data" => "Announcement added correctly"
            ));
        die();

    }



    //POST /reactedannouncement
    // {"userId" : 9,"announcementId" : 3}
    public function reactedannouncementAction(Request $request){

        // obtener el ser icio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        // obtenr los datos de la petición
        $json_params = $request->get("json", null);
        //$json_token = $request->get("token", null);
        var_dump($json_params);


        $userId = json_decode($json_params)->{"userId"};
        $announcementId = json_decode($json_params)->{"announcementId"};
        $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
        $connection = $em->getConnection();
        $statement = $connection->prepare("INSERT INTO `ReactedAnnouncement` (`reactedAnnouncementId`, `announcementId`, `userId`, `liked`, `interested`, `moment`, `active`) 
        VALUES (NULL, $announcementId, $userId, '1', '0', CURRENT_TIMESTAMP, '1');
        ");
        $statement->execute();

/*
        $reactedannouncement = new Reactedannouncement();

        $reactedannouncement->setActive(1);
        $reactedannouncement->setInterested(0); //Siempre a 0, en pendiente
        $reactedannouncement->setLiked(1);
        $reactedannouncement->setMoment(new \DateTime('now'));

        $userId = json_decode($json_params)->{"userId"};
        $user = $this->getDoctrine()->getRepository("BackendBundle:User")->findOneBy(
            array("userid" => $userId)
        );
        var_dump($user);
        $reactedannouncement->setUserid($user);

        $announcementId = json_decode($json_params)->{"announcementId"};
        $announcement = $this->getDoctrine()->getRepository("BackendBundle:Announcement")->findOneBy(
            array("announcementid" => $announcementId)
        );
        $reactedannouncement->setAnnouncementid($announcement);


        var_dump($reactedannouncement);
        // Invocar al manejador de BD
        $manager = $this->getDoctrine()->getManager();
        // Decirle al manejador que daras de alta ese objeto
        $manager->persist($reactedannouncement);
        // Decirle que haga los cambios en BD
        $manager->flush();
        //return necesario
*/
        return $helpers->json(
            array(
                "status" => "OK",
                "code" => "200",
                "data" => "Announcement added correctly"
            ));
        die();

    }
}