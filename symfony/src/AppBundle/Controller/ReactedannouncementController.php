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

class ReactedannouncementController extends Controller
{

    //GET /reactedannouncement/userid/interested
    //interested 0:espera - 1:aceptado - 2:rechazado
    public function showAction($userid,$interested){
        $helpers = $this->get("app.helpers");

        $reactedannouncement = $this->getDoctrine()->getRepository("BackendBundle:Reactedannouncement")->findBy(
            array("userid" => $userid,
                "interested" => $interested)
        );

        return $helpers->json($reactedannouncement);
    }

    //POST /reactedannouncement
    // {"userId" : 9,"announcementId" : 3,"active" : 1,"interested" : 2,"liked" : 1}
    public function reactedannouncementAction(Request $request){

        // obtener el ser icio que me permitirá convertir a JSON
        $helpers = $this->get("app.helpers");
        // obtenr los datos de la petición
        $json_params = $request->get("json", null);
        //$json_token = $request->get("token", null);
        var_dump($json_params);

        $reactedannouncement = new Reactedannouncement();

        $reactedannouncement->setActive(json_decode($json_params)->{"active"},null);

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

        $reactedannouncement->setInterested(json_decode($json_params)->{"interested"},null);
        $reactedannouncement->setLiked(json_decode($json_params)->{"liked"},null);
        $reactedannouncement->setMoment(new \DateTime('now'));


        var_dump($reactedannouncement);
        // Invocar al manejador de BD
        $manager = $this->getDoctrine()->getManager();
        // Decirle al manejador que daras de alta ese objeto
        $manager->persist($reactedannouncement);
        // Decirle que haga los cambios en BD
        $manager->flush();
        //return necesario
        return new Response();

    }
}