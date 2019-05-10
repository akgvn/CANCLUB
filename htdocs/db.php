<?php

class DB_Connector
{
    private $conn;

    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with password) */
    private $host = "localhost";
    private $db_name = "project_canclub";
    private $username = "root";
    private $password = "study4moar";

    public function dbConnection()
    {
        $this->conn = null;
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

}

class DB_Middleman
{
    private $db_conn;

    // TODO

    public function __construct()
    {
        $database = new DB_Connector();
        $db = $database->dbConnection();
        $this->db_conn = $db;
    }

    public function registerUser($user_data)
    {
        try
        {
            // $new_password = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $this->db_conn->prepare("INSERT INTO users(email, username, password, fname, lname, birthdate, dept_id)
                                          VALUES(:ue, :un, :up, :uf, :ul, :ub, :ud)");

            $stmt->bindparam(":ue", $user_data->email);
            $stmt->bindparam(":un", $user_data->uname);
            $stmt->bindparam(":uf", $user_data->fname);
            $stmt->bindparam(":ul", $user_data->lname);
            $stmt->bindparam(":up", $user_data->pass);
            $stmt->bindparam(":ud", $user_data->dept);
            $stmt->bindparam(":ub", $user_data->birth);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function userExists($user_data)
    {

    }

    public function proposeActivity($user_data, $activity_data)
    {

    }

    public function voteActivity($user_data, $vote_data)
    {

    }

    public function newComment($user_data, $activity_data, $comment_data)
    {

    }

    public function getAllDepartments()
    {
        try {
            $stmt = $this->db_conn->prepare("SELECT dept_id, dept_name FROM departments");
            $stmt->execute();

            $depts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $depts;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

$db = new DB_Middleman();
