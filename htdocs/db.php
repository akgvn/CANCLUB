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
        // TODO Look for existing user!

        try
        {
            // $new_password = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $this->db_conn->prepare("INSERT INTO users(email, username, password, fname, lname, birthdate, dept_id, has_president_rights)
            VALUES(:ue, :un, :up, :uf, :ul, :ub, :ud, :prez)");

            $stmt->bindparam(":ue", $user_data->email);
            $stmt->bindparam(":un", $user_data->uname);
            $stmt->bindparam(":uf", $user_data->fname);
            $stmt->bindparam(":ul", $user_data->lname);
            $stmt->bindparam(":up", $user_data->pass);
            $stmt->bindparam(":ud", $user_data->dept);
            $stmt->bindparam(":ub", $user_data->birth);
            $stmt->bindparam(":prez", $user_data->president);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateUser($user_data)
    {
        try
        {
            // $new_password = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $this->db_conn->prepare("UPDATE users
            SET email = :ue, username = :un, password = :up, fname = :uf, lname = :ul, birthdate = :ub, dept_id = :ud
            WHERE id=$user_data->uid;");

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

    public function userLogin($user_data)
    {
        try
        {
            $stmt = $this->db_conn->prepare("SELECT id, password FROM users WHERE username=:un");

            $stmt->bindparam(":un", $user_data->uname);
            $stmt->execute();

            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() == 1) {
                if ($userRow['password'] == $user_data->pass) { /* password_verify($upass, $userRow['password']) */
                    $_SESSION['user'] = $this->getUserData($userRow['id']);
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function getUserData($user_id)
    {
        try
        {
            $stmt = $this->db_conn->prepare("SELECT id, username, fname, lname, birthdate, dept_id, email, has_president_rights
            FROM users WHERE id=:uid");

            $stmt->bindparam(":uid", $user_id);
            $stmt->execute();

            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $user_data = new User;

            $user_data->uid = $userRow["id"];
            $user_data->uname = $userRow["username"];
            $user_data->fname = $userRow["fname"];
            $user_data->lname = $userRow["lname"];
            $user_data->pass = null;
            $user_data->birth = $userRow["birthdate"];
            $user_data->dept = $userRow["dept_id"];
            $user_data->email = $userRow["email"];
            $user_data->president = $userRow["has_president_rights"];

            return $user_data;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function proposeActivity($activity_data)
    {
        try
        {
            $stmt = $this->db_conn->prepare("INSERT INTO activities(activity_title, activity_info,
            activity_type, proposal_time, proposed_by) VALUES(:tt, :text, :type, :time, :by)");

            $stmt->bindparam(":tt", $activity_data->activity_title);
            $stmt->bindparam(":text", $activity_data->activity_info);
            $stmt->bindparam(":time", $activity_data->proposal_time);
            $stmt->bindparam(":by", $activity_data->proposed_by);
            $stmt->bindparam(":type", $activity_data->activity_type);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function voteActivity($vote_data)
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

    public function getActivityTypes()
    {
        try {
            $stmt = $this->db_conn->prepare("SELECT type_id, type_name FROM activity_types");
            $stmt->execute();

            $types = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $types;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getActType($actid)
    {
        try {
            $stmt = $this->db_conn->prepare("SELECT type_name FROM activity_types WHERE type_id=$actid");
            $stmt->execute();

            $types = $stmt->fetch(PDO::FETCH_ASSOC);

            $type = $types["type_name"];

            return $type;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getDeptName($deptid)
    {
        try {
            $stmt = $this->db_conn->prepare("SELECT dept_name FROM departments WHERE dept_id=$deptid");
            $stmt->execute();

            $types = $stmt->fetch(PDO::FETCH_ASSOC);

            $type = $types["dept_name"];

            return $type;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getActivitiesInOrder()
    {
        try {
            $stmt = $this->db_conn->prepare("SELECT activity_id, activity_title, activity_info, activity_type, proposal_time, proposed_by, vote_count
            FROM activities ORDER BY proposal_time DESC");
            $stmt->execute();

            $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $activities;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getActivityByID($act_id)
    {
        try {
            $stmt = $this->db_conn->prepare("SELECT activity_id, activity_title, activity_info, activity_type, proposal_time, proposed_by, vote_count
            FROM activities WHERE activity_id=$act_id");
            $stmt->execute();

            $act = $stmt->fetch(PDO::FETCH_ASSOC);

            return $act;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

$db = new DB_Middleman();
