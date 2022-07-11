<?php

namespace App\controller;

use App\model\{User,GeoCache};


class AjaxController{
    /**GEOCACHES */
    public static function geoCacheList(){
        //geocachesList
        $geoCache = new GeoCache();
        $geoCaches = $geoCache->recupAllGeocacheAdmin();
    
        require './views/admin/part/geoCacheList.php';
    }

    public static function addGeoCache(){
        require './views/admin/part/addGeoCache.php';
    } 

    /** TEAMS */
    public static function teamList(){
        // users list
        $user = new User();
        $users = $user->recupAll();
        require './views/admin/part/teamList.php';
    }

    public static function addTeam(){
        require './views/admin/part/addTeam.php';
    }

    public static function removeGeocache(){
        $geoCache = new GeoCache();
        $geoCaches = $geoCache->recupAllGeocacheAdmin();
        require './views/admin/part/removeGeocache.php' ;
    }
}