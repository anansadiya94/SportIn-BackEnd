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
    private $key = 'sportin_2018';
    public function __construct($manager){
        $this->manager = $manager;
    }

    public function singin($email, $password, $getHash = true){
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
                "sub" => $user->getUserId(),
                "email" => $user->getEmail(),
                "name" => $user->getUserName(),
                "password" => $user->getPassword(),
                "iat" => time(),
                "exp" => time() + (7 * 24 * 60 * 60)
            );
            $token_encoded = JWT::encode($token, $this->key, 'HS256');
            $token_no_encoded = JWT::decode($token_encoded, $this->key, array('HS256'));
            if($getHash){
                return
                    array(
                        "status" => "success",
                        "code" => "200",
                        "data" => $token_encoded);
            }else{
                return array(
                    "status" => "success",
                    "code" => "200",
                    "data" => $token_no_encoded);
            }
        }else{
            // ER-0003 : Login incorrecto
            return array(
                "status" => "error",
                "code" => "ER-0003",
                "data" => "Login failed!"
            );
        }
    }

    public function checkToken($token){
        $result = false;
        $user = null;
        try{
            $token_decoded = JWT::decode($token, $this->key, array('HS256'));
            $email = $token_decoded->email;
            $password = $token_decoded->password;

            $user = $this->manager->getRepository("BackendBundle:User")->findOneBy(
                array(
                    "email" => $email,
                    "password" => $password)
            );
        }catch (\Exception $e){

        }

        if(!is_null($user)) $result = $user;
        return $result;
    }
}