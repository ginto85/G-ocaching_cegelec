<?php

namespace App\controller;

use App\model\{User,GeoCache};
use App\core\{Session, Cookie};

class FormController
{
    protected User $_user;

    public function __construct(User $user)
    {
        $this->_user = $user;
    }

   //**************** verifies form entries */
    public function checkData($val)
    {
        $val = trim($val);
        $val = stripslashes($val);
        $val = htmlspecialchars($val);
        return $val;
    }

    //**************** function that manages the registration form (empty or incorrect fields)*/
    public function registerForm(array $data)
    {
        
        $messages = [];
        $exist = null;

        $teamName = $this->checkData($data['teamName']);
        $password = $this->checkData($data['password']);
        $password2 = $this->checkData($data['password2']);
        $teamAssignment = $this->checkData($data['teamAssignment']);

        // verif global new user
        if (empty($teamName) || empty($password) || empty($password2)) {
            $messages['errors'][] = 'veuillez remplir tous les champs';
        }
        // verif teamName
        if (!strlen($teamName) >= 3) {
            $messages['errors'][] = 'login trop court ';
        }
        // verif password
        if ($password !== $password2) {
            $messages['errors'][] = 'Les mots de passes doivent être les mêmes';
            
        }if(empty($teamAssignment)){
            $messages['errors'][] = 'Veuillez choisir une équipe dans la liste de sélection';
        }
        // check if teamAssignment is A or B
        if($teamAssignment != 'A' && $teamAssignment != 'B'){
            $messages['errors'][] = 'Choisir une des équipe dans la liste de sélection';
        }else{
            $exist = $this->_user->recupAll($teamName);
        }
        // verif teamName /bdd
        if ($exist) {
            for ($i=0; $i < count($exist); $i++) { 
                if ($exist[$i]['teamName'] === $teamName) {
                    $messages['errors'][] = 'Ce nom d\'équipe est déjà utilisé';
                }
            }
        }
        // validation NewUser in bdd
        if (empty($messages['errors'])) {
            $this->_user->addUser($teamName, $password, $data['teamAssignment']);
            $messages['success'] = ['bravo Inscription réussie'];
        }
        return $messages;
    }

   //**************** manages the login form and the creation of cookies (empty or incorrect fields)*/
    public function loginForm(array $data)
    {
        $messages = [];
        $password = $this->checkData($data['password']);
        $teamName = $this->checkData($data['teamName']);
        
        //if the fields are empty, returns the error message
        if (empty($password) || empty($teamName)) {
            $messages['errors'][] = 'veuillez remplir tous les champs';
            return $messages;
        } else {
            // otherwise retrieves the user's data via the constructor of the class
            $exist = $this->_user->recupUserByTeamName($teamName);
            //if the teamName does not exist, returns error message
            if (!$exist) {
                $messages['errors'][] = 'Ce nom d\'équipe n\'existe pas';
                return $messages;
                //otherwise check the password
            } elseif (password_verify($password, $exist['password'])) {
                Session::setUserSession($exist);
                //if the box 'remember me' is checked then the cookie is created
                isset($data['remember'])
                    ? Cookie::setCookies($exist)
                    : Cookie::deleteCookie($exist);
            } else {
                $messages['errors'][] = 'Mot de passe incorrect';
                return $messages;
            }
        }
        // if no message, return to the home page
        if (empty($messages['errors'])) {
            header('location: index.php');
            exit();
        }
    }

    //************* manages the geoCache form */
    public function addGeoCacheInDB(array $data){
        
        $messages = [];
        $exist = null;
        // verif global new geoCache
        $geoCacheName = $this->checkData($data['geoCacheName']);
        $lat = $this->checkData($data['lat']);
        $lng = $this->checkData($data['lng']);
        $teamAssignment = $this->checkData($data['teamAssignment']);
        $theme = $this->checkData($data['theme']);
        $resp1 = $this->checkData($data['resp1']);
        $resp2 = $this->checkData($data['resp2']);
        $resp3 = $this->checkData($data['resp3']);
        $goodResp = $this->checkData($data['group']);
      
        // check if all fields have been entered
        if(
        empty($geoCacheName) ||
        empty($lat) ||
        empty($lng)){
            $messages['errors'][] = 'veuillez remplir tous les champs';
        }
       
        // verif geoCacheName
        if(strlen($geoCacheName) <= 3) {
            $messages['errors'][] = 'nom de la geo-cache trop court ';
        }
        // verif 'lat' and 'lng' are a number
        if(!is_numeric($lat) || !is_numeric($lng)){
            $messages['errors'][] = 'veuillez saisir des coordonnées valides';
        }
         // check if teamAssignment is selected
        if(empty($teamAssignment)){
            $messages['errors'][] = 'Choisir équipe "A","B" ou "AB" dans la liste de sélection';
        }
        // check if teamAssignment is A or B or AB
        if($teamAssignment != 'A' && $teamAssignment != 'B' && $teamAssignment != 'AB'){
                $messages['errors'][] = 'Choisir une des équipes dans la liste de sélection';
        }
        // check if theme is selected
        if($theme == "Choisir un thème pour la géocache"){
            $messages['errors'][] = 'Choisir un thème dans la liste de sélection';
        }
        // check if all fields responses have been entered
        if(
        empty($resp1) || 
        empty($resp2) || 
        empty($resp3)){
            $messages['errors'][] = 'veuillez saisir 3 réponses ';
        }
        // check if goodResp is selected
        if(empty($goodResp)){
            $messages['errors'][] = 'Choisir une bonne réponse dans la liste de sélection';
        }
        if($resp1 == $resp2 || $resp1 == $resp3 || $resp2 == $resp3){
            $messages['errors'][] = 'Les réponses doivent être différentes';
        }

        
        // check if there are any error messages
        if (empty($messages['errors'])) {
            // if no error message, add GeoCache in bdd
            $geoCache = new GeoCache();
            $idGeoCache = $geoCache->addGeoCache($geoCacheName, $lat, $lng,$teamAssignment,$theme,$resp1,$resp2,$resp3,$goodResp);
            $messages['success'] = ['bravo ajout de geo-cache réussie'];
        }
        return $messages;
    }

    public function updateGeoCacheInDB(array $data){
        $messages = [];
        $exist = null;
        $idGeoCache = $this->checkData($data['geocacheId']);
        $geoCacheName = $this->checkData($data['geoCacheName']);
        $lat = $this->checkData($data['lat']);
        $lng = $this->checkData($data['lng']);
        $teamAssignment = $this->checkData($data['teamAssignment']);
        $theme = $this->checkData($data['theme']);
        $resp1 = $this->checkData($data['resp1']);
        $resp2 = $this->checkData($data['resp2']);
        $resp3 = $this->checkData($data['resp3']);
        $goodResp = $this->checkData($data['group']);
        // check if all fields have been entered
        if(
        empty($geoCacheName) ||
        empty($lat) ||
        empty($lng)){
            $messages['errors'][] = 'veuillez remplir tous les champs';
        }
         // verif 'lat' and 'lng' are a number
         if(!is_numeric($lat) || !is_numeric($lng)){
            $messages['errors'][] = 'veuillez saisir des coordonnées valides';
        }
        // check if teamAssignment is selected
        if(empty($teamAssignment)){
            $messages['errors'][] = 'Choisir équipe "A","B" ou "AB" dans la liste de sélection';
        }
        // check if teamAssignment is A or B or AB
        if($teamAssignment != 'A' && $teamAssignment != 'B' && $teamAssignment != 'AB'){
                $messages['errors'][] = 'Choisir une des équipes dans la liste de sélection';
        }
        // check if theme is selected
        if($theme == "Choisir un thème pour la géocache"){
            $messages['errors'][] = 'Choisir un thème dans la liste de sélection';
        }
        // check if all fields responses have been entered
        if(
        empty($resp1) || 
        empty($resp2) || 
        empty($resp3)){
            $messages['errors'][] = 'veuillez saisir 3 réponses';
        }
         // check if goodResp is selected
         if(empty($goodResp)){
            $messages['errors'][] = 'Choisir une bonne réponse dans la liste de sélection';
        }
        if($resp1 == $resp2 || $resp1 == $resp3 || $resp2 == $resp3){
            $messages['errors'][] = 'Les réponses doivent être différentes';
        }

       // check if there are any errors messages
       if (empty($messages['errors'])) {
        // if no error message, add GeoCache in bdd
        $geoCache = new GeoCache();
        $idGeoCache = $geoCache->updateGeoCache($idGeoCache, $geoCacheName, $lat, $lng,
                                                $teamAssignment, $theme,$resp1,$resp2,$resp3,$goodResp);
       
        $messages['success'] = ['Modification de geo-cache réussie'];
        }
   
    return [$messages, $data];
    }

    //************* manages the User's response in map form page */
    public function checkingTheAnswers(array $data){
      
        $messages = [];
        $geocacheId = $this->checkData($data['geocacheId']);
        $strGeocacheId = (string)$geocacheId;
        $theme = $this->checkData($data['group1']);
        $answer = $this->checkData($data['group2']);
        $user = new User();
        $sessionUser= $user->recupUserByTeamName($_SESSION['user']['teamName']);
        $answeredQuestions = $sessionUser['answered_questions'];
        $UserPoints= 0;
        // check if all fields have been entered
        if(empty($theme) || empty($answer)){
            $messages['errors'][] = 'veuillez remplir tous les champs';
        };
        // get the good answer
        $geocache = new GeoCache();
        $geocache = $geocache->getGeoCacheById($geocacheId);
        // check if the good answer is the same as the user's answer
        if($geocache['theme'] != $theme){
            $messages['errors'][] = 'Ce n\'est pas le bon thème';
        }else{
            // if the theme is the same as the user's answer theme
            // add 10 points to the user's team
           
            $UserPoints+=10;
            $messages['success'][] = 'Bravo, vous avez trouvé le bon thème.';
        }
        if($geocache['good_resp'] != $answer){
            $messages['errors'][] = 'Ce n\'est pas le bonne réponse';
        }else{
            // if the good answer is the same as the user's answer
            // add 10 points to the user's team
           $UserPoints+=10;
            $messages['success'][] = 'Bravo, vous avez trouvé la bonne réponse.</br>';
        }
        // Gif for points
        if($UserPoints == 0){
            $messages['errors'][] = '<img src="https://media.giphy.com/media/3oz8xGvUfhxbjLmZ3O/giphy.gif" 
                                        alt="mauvaises réponses">';
        }else if($UserPoints == 10){
            $messages['success'][] = '<img src="https://media.giphy.com/media/9xijGdDIMovchalhxN/giphy.gif" 
                                        alt="50/50">';
        }else if($UserPoints == 20){
            $messages['success'][] = ' <img src="https://media.giphy.com/media/a0h7sAqON67nO/giphy.gif"
                                    alt="bonnes réponses">';
        }
        if($UserPoints != 0){
            // update the user's points in the bdd
            $_SESSION['user']['points'] . ', ' . $UserPoints;
            $this->_user->addPoints($sessionUser['teamName'],$UserPoints);
        }
        if(!empty($theme) && !empty($answer)){

            if($answeredQuestions ==''){
                $answeredQuestions = $strGeocacheId;
            }else{
            $answeredQuestions = $answeredQuestions . ', ' . $strGeocacheId;
            }
            // update the user's answered questions in $_SESSION
            $_SESSION['user']['answered_questions'] = $_SESSION['user']['answered_questions'] . ', ' . $strGeocacheId;
            
            // dd($answeredQuestions);
            // update the user's answered questions in bdd
            $this->_user->addQuestionID($sessionUser['teamName'], $answeredQuestions);
        };

        return $messages;
    }
}
