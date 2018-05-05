<?php
/**
 * Created by PhpStorm.
 * User: Diee
 * Date: 24/04/2018
 * Time: 12:18
 */

namespace AppBundle\Services;


class ImageLoader
{
    private $root_dir;
    public function __construct($root_dir_param){
        $this->root_dir = $root_dir_param;
    }

    public function loadImage($c){
        if(!is_array($c)){
            $this->loadImageFromPath($c);
        }else{
            foreach($c as $country){
                self::loadImageFromPath($country);
            }
        }
        return $c;
    }

    public function loadImageFromPath($country){
        $publicResourcesFolderPath =
            $this->root_dir.
            '/../web/resources/images/countries';
        $filename = "/".$country->getFlag();
        $encoded_image = base64_encode(
            file_get_contents($publicResourcesFolderPath.$filename));
        $country->setFlagEncoded($encoded_image);
        return $country;
    }
}