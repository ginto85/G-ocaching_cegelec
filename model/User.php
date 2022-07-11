<?php

namespace App\model;

use App\core\Connect;

class User extends Connect
{
    protected $_pdo;

    public function __construct()
    {
        $this->_pdo = $this->connexion();
    }
    /**
     * @param array $data
     * @return array
     */
    public function recupUserByTeamName(string $teamName)
    {
        $sql = "SELECT
                    `id`, `teamName`,`password`, `type`,`team_assignment`,`points`,`answered_questions`
                FROM
                    `user`
                WHERE
                teamName = :teamName";
        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':teamName' => $teamName,
        ]);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * @param string $teamName
     * @return array
     */
    public function recupAll()
    {
        $sql = "SELECT
                    `id`, `teamName`,`team_assignment`,`points`
                FROM
                    `user`
                    ORDER BY `team_assignment` ASC";
        $query = $this->_pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param string $teamName
     * @param string $password
     * @return bool
     */
    public function addUser(string $teamName, string $password, string $teamAssignment)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `user` (`teamName`, `password`, `team_assignment`)
         VALUES (:teamName, :password, :team_assignment)";
        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':teamName' => $teamName,
            ':password' => $password,
            ':team_assignment' => $teamAssignment,
        ]);
    }
    /**
     * @param string $teamName
     * @param string $password
     * @param string $teamAssignment
     * @return bool
     */
    public function addPoints(string $teamName, int $points)
    {
        $sql = "UPDATE `user` SET `points` = `points` + :points  WHERE `teamName` = :teamName";
        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':teamName' => $teamName,
            ':points' => $points,
        ]);
    }
    /**
     * @param string $teamName
     * @param string $answeredQuestions
     * @return bool
     */
    public function addQuestionID(string $teamName,string $geocacheID)
    {
        $sql = "UPDATE `user` SET `answered_questions`= :geocacheID  WHERE `teamName` = :teamName";
        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':teamName' => $teamName,
            ':geocacheID' => $geocacheID,
        ]);
    }
}
