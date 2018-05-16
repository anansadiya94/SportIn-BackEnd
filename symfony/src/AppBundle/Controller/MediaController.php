<?php
/**
 * Created by PhpStorm.
 * User: Diee
 * Date: 13/05/2018
 * Time: 19:42
 */

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MediaController extends Controller
{
    public function imageUploadAction(Request $request){
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");
        $token = $request->get("token");
        if($token != null){
            $user = $jwt_auth->checkToken($token);
            if($user != null){
                $manager = $this->getDoctrine()->getManager();
                $file = $request->files->get("image");
                if(!empty($file) && $file != null){
                    $file_ext = $file->guessExtension();
                    $file_name = time().".".$file_ext;
                    $file->move("uploads/users/images", $file_name);

                    //Update user Object (DB)
                    $user->setProfilePhoto($file_name);
                    $manager->persist($user);
                    $manager->flush();

                    //Return success
                    return $helpers->json(
                        array(
                            "status" => "OK",
                            "code" => "200",
                            "data" => "Image uploaded successful!"
                        ));
                }else{
                    // ER-0008: Image not found!
                    return $helpers->json(
                        array(
                            "status" => "error",
                            "code" => "ER-0008",
                            "data" => "Image not found!"
                        ));
                    die();
                }
            }else{
                // ER-0007: User does not exists!
                return $helpers->json(
                    array(
                        "status" => "error",
                        "code" => "ER-0007",
                        "data" => "User does not exists!"
                    ));
                die();
            }
        }else{
            // ER-0006: No se ha enviado un token
            return $helpers->json(
                array(
                    "status" => "error",
                    "code" => "ER-0006",
                    "data" => "Token not found!"
                ));
            die();
        }
    }
}