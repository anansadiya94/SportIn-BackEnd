<?php
/**
 * Created by PhpStorm.
 * User: Diee
 * Date: 02/04/2018
 * Time: 11:20
 */

namespace AppBundle\Services;

use Firebase\JWT\JWT;

class JwtAuth
{
    private $manager;
    public function __construct($manager){
        $this->manager = $manager;
    }

    public function singin($email, $password, $getHash = true){
        $key = 'sportin_2018';
        $singin = false;

        $user = $this->manager->getRepository("BackendBundle:User")->findOneBy(
            array(
                "email" => $email,
                "password" => $password)
        );

        if(is_object($user)){
            $singin = true;
        }
        if($singin){
            $token = array(
                "sub" => $user->getId(),
                "email" => $user->getEmail(),
                "name" => $user->getName(),
                "password" => $user->getPassword(),
                "iat" => time(),
                "exp" => time() + (7 * 24 * 60 * 60)
            );
            $token_encoded = JWT::encode($token, $key, 'HS256');
            $token_no_encoded = JWT::decode($token_encoded, $key, array('HS256'));
            if($getHash){
                return $token_encoded;
            }else{
                return $token_no_encoded;
            }

            /*return array(
                "status" => "success",
                "data" => "Login sucessfull!"
            );*/
        }else{
            // ER-0003 : Login incorrecto
            return array(
                "status" => "error",
                "code" => "ER-0003",
                "data" => "Login failed!"
            );
        }
    }
}