<?php
namespace App\controller;

use App\model\{User, GeoCache};
use Ifsnop\Mysqldump\Mysqldump;
use App\controller\FormController;
use App\core\{Cookie, Session, Https};

require 'vendor/autoload.php';

/*** function to remove answered geocaches  */
function removeGeocacheAnsweredByID($geoCaches, $geoCachesList) {
    foreach ($geoCaches as $key => $geoCache) {
        if(in_array($geoCache['id'], $geoCachesList)) {
            unset($geoCaches[$key]);
        }
    }
    return $geoCaches;
}
class FrontController
{
    // public function test()
    // {
    //     echo 'test';
    // }
   //**************** controller that displays the HOME page */
    public function home()
    {
        $this->render('home/index');
    }
    //**************** controller that displays the THEM page*/
    public function themes()
    {
        $this->render('themes/themes');
    }
    //**************** controller which displays the ADMIN page*/
    public function admin()
    {
        Session::adminOnline() ? '' : Https::redirect('index.php');
        // form to add a new team or a new geocache
        if (!empty($_POST)) {
            if(isset($_POST['teamName'])) {
                $form = new FormController(new User());
                $messages = $form->registerForm($_POST);
            }
            elseif(isset($_POST['geoCacheName'])) {
                $form = new FormController(new User());
                $messages = $form->addGeoCacheInDB($_POST);
            }
            // backup of the database each time the administrator adds, change or delete to the DB
            $dump = new Mysqldump();
            $dump->start('dump.sql');
        }
        $this->render('admin/dashboard',['messages'=>$messages ?? null]);
    }

    public function update()
    {
        Session::adminOnline() ?  '' :  Https::redirect('index.php') ; 
        $messages = null;
        if(!array_key_exists('numGeocache',$_GET))
        {
            Https::redirect('index.php?p=admin');
        }
        $geocache = new GeoCache();
        $geocacheData = $geocache->getGeocache($_GET['numGeocache']);
      
         // if the user wants to update the geocache
        if($_POST)
        {
            if(isset($_POST['geoCacheName'])) {
                $form = new FormController(new User());
                $messages = $form->updateGeoCacheInDB($_POST);
            //   dd($messages);
            }else{
                Https::redirect('index.php?p=admin');
            }
            return $this->render('admin/dashboard',['messages'=> $messages]);
        }
  
        $this->render('admin/part/updateGeocache',['messages'=> $messages,'geocacheData'=> $geocacheData]);
    }


    public function deletee()
    {
       
        Session::adminOnline() ?  '' :  Https::redirect('index.php') ; 
        if(!array_key_exists('numGeocache',$_GET))
        {
            Https::redirect('index.php?p=admin');
        }
        $geocache = new GeoCache();
        $messages['success'] = $geocache->deleteGeocache($_GET['numGeocache']);

        $this->render('admin/dashboard',['messages'=> $messages]);
        
 
    }
    //**************** controller that display the LOGIN page(se connecter)*/
    public function login()
    {
        // if the user is already connected, redirect to the home page
        Session::online() ? Https::redirect('index.php') : '';
        if (!empty($_POST)) {
            $form = new FormController(new User());
            $messages = $form->loginForm($_POST);
        }
        $this->render('connexion/login', [
            'messages' => $messages ?? null,
            'cookie' => new Cookie(),
        ]);
    }
    //**************** Controller that allows the user to disconnect*/
    public function logout()
    {
        Session::deconnect();
        Https::redirect('index.php');
    }

    //************************ controller that displays the map page*/
    public function map()
    {
        Session::online() ? '' : Https::redirect('index.php');
        $geoCaches = new GeoCache();
        $userTeamAssigned =$_SESSION['user']['team_assignment'];
        // $geoCachesList = 0;

        if(!empty($_POST)) {
            $form = new FormController(new User());
            $messages = $form->checkingTheAnswers($_POST);
        };

        if($_SESSION['user']['type'] == 1) {
            $geoCaches = $geoCaches->recupAllGeocacheAdmin();
            /***** takes all answered geocaches from admin   ******/
            $geoCachesList = explode(',', $_SESSION['user']['answered_questions']);
            // returns unanswered geocaches
            $geoCaches = removeGeocacheAnsweredByID($geoCaches, $geoCachesList);
        }else{
           
            if($userTeamAssigned == "A"){
                /***** takes all answered geocaches from team A   ******/
                $geoCachesList = explode(',', $_SESSION['user']['answered_questions']);
                //takes all geocaches from team A 
                $geoCaches = $geoCaches->recupAllGeocacheTeamAssigned($userTeamAssigned);
                // returns unanswered geocaches
                $geoCaches = removeGeocacheAnsweredByID($geoCaches, $geoCachesList);
              
            }
            else if($userTeamAssigned == "B"){
                //takes all answered geocaches from team B
                $geoCachesList = explode(',', $_SESSION['user']['answered_questions']);
                //takes all geocaches from team A 
                $geoCaches = $geoCaches->recupAllGeocacheTeamAssigned($userTeamAssigned);
                // returns unanswered geocaches
                $geoCaches = removeGeocacheAnsweredByID($geoCaches, $geoCachesList);
            }
             // backup of the database each time the user answers a question
             $dump = new Mysqldump();
             $dump->start('dump.sql');
        };
        $this->render('map/map', [
            'messages' => $messages ?? null,
            'geoCaches' => $geoCaches,
        ]);
    }

    public function render(string $path, $array = [])
    {
        if (count($array) > 0) {
            foreach ($array as $key => $value) {
                ${$key} = $value;
            }
        }
        // to keep the session active at each page change
        $session = new Session();
        $https = new Https();
        $path = $path . '.php';
        require 'template/template.php';
    }
}
