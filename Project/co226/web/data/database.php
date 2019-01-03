<?php
require_once '../config.php';

class database
{
    private $mysqli;

    function __construct()
    {
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    function __destruct()
    {
        $this->mysqli->close();
    }

    function get_SiteData($key)
    {
        $sql = "SELECT * FROM `site_data` WHERE `dataKey` LIKE '$key'";

        $result = $this->mysqli->query($sql);
        $row = $result->fetch_assoc();
        return $row['dataVal'];

    }

    function set_SiteData($key, $val)
    {

        $sql = "UPDATE `site_data` SET `dataVal` = '$val' WHERE `dataKey` = $key;";
        if ($result = $this->mysqli->query($sql)) {
            return 1;
        } else {
            return 0;
        }

    }


    function newUser($firstName, $lastName, $salutation, $email, $password, $role, $lastAccess)
    {
        $firstName = $this->sqlSafe($firstName);
        $lastName = $this->sqlSafe($lastName);
        $email = $this->sqlSafe($email);

        $sql = "INSERT INTO `users` (`firstName`, `lastName`, `salutation`, `email`, `password`, `role`, `lastAccess`)
              VALUES ( '$firstName', '$lastName', '$salutation','$email', '$password', '$role', '$lastAccess');";
        return $this->mysqli->query($sql);
    }

    function newCourse($courseTitle, $year, $semester, $lecId, $instId, $contactHours, $labHours)
    {


        $instId = !empty($instId) ? $instId : "null";
        $labHours = !empty($labHours) ? $labHours : "null";


        $sql = "INSERT INTO `co226`.`courses` (courseTitle, year, semester, lecId, instId, contactHours, labHours)
              VALUES ( '$courseTitle', '$year','$semester' ,'$lecId', $instId, '$contactHours', $labHours);";

        return $this->mysqli->query($sql);
    }
    function newClass($courseId, $classType, $classDate, $classTime, $duration, $conductedBy)
    {

        $classType = !empty($classType) ? $classType : "null";

        $sql = "INSERT INTO `class` (courseId, classType, classDate, classTime, duration, conductedBy)
              VALUES ( $courseId, '$classType','$classDate' ,'$classTime', $duration, $conductedBy);";

        return $this->mysqli->query($sql);
    }

    function newStudent($id, $eNum, $dept)
    {
        $eNum = $this->sqlSafe($eNum);
        $dept = $this->sqlSafe($dept);

        $sql = "INSERT INTO `co226`.`userstudent` (`eNum`, `id`, `dept`)
                VALUES ('$eNum', '$id', '$dept');";
        return $this->mysqli->query($sql);
    }

    function getUserId_byEmail($email)
    {
        $sql = "SELECT `id` FROM `users` WHERE `email` LIKE '$email'";
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_assoc();
        $res = $row['id'];
        return $res;
    }

    function getUserData($userId, $field)
    {
        $sql = "SELECT * FROM `users` WHERE `id` LIKE $userId";
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_assoc();
        $res = $row[$field];
        return $res;
    }

    function getUserName($userId)
    {

        if ($userId == '' || $userId == 'not-assigned') {
            return 'not assigned';
        }
        $sql = "SELECT * FROM `users` WHERE `id` LIKE $userId";
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_assoc();
        $res = $row['firstName'] . ' ' . $row['lastName'];
        return $res;
    }

    function getStudentData($userId, $field)
    {
        $sql = "SELECT * FROM `userstudent` WHERE `id` LIKE $userId";
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_assoc();
        $res = $row[$field];
        return $res;
    }


    function setUserData($userId, $field, $value)
    {
        $sql = "UPDATE `users` SET `$field` = '$value' WHERE `id` = '$userId';";
        return $this->mysqli->query($sql);
    }

    function setCourseData($courseId, $data)
    {
        $courseTitle = $data['courseTitle'];
        $year = $data['year'];
        $semester = $data['semester'];
        $lecId = $data['lecId'];
        $instId = !empty($data['instId']) ? $data['instId']:"null" ;
        $contactHours = $data['contactHours'];
        $labHours = !empty($data['labHours']) ? $data['labHours']:"null" ;


        $sql = "UPDATE `courses` SET `courseTitle` = '$courseTitle' , `year`='$year' , `semester`=$semester , `lecId`=$lecId ,
`instId`=$instId,`contactHours`=$contactHours , `labHours`=$labHours WHERE `courseId` = '$courseId';";
        return $this->mysqli->query($sql);
    }
    function setClassData($id, $data)
    {
        $courseID = $data['courseId'];
        $classTime = $data['classTime'];
        $classDate = $data['classDate'];
        $conductedBy = $data['conductedBy'];
        $classType = $data['classType'];
        $duration = $data['duration'];

        $sql = "UPDATE `class` SET `courseId` = '$courseID' , `classTime`='$classTime' , `classDate`='$classDate' , `classType`='$classType' ,
                `duration`='$duration', `conductedBy`=$conductedBy WHERE `id` = '$id';";
        return $this->mysqli->query($sql);
    }
    function deleteCourseData($courseId)
    {

       $sql= "DELETE FROM `courses` WHERE `courseId`=$courseId;";
        return $this->mysqli->query($sql);
    }
    function deleteClassData($id)
    {
       $sql= "DELETE FROM `class` WHERE `id`=$id;";
        return $this->mysqli->query($sql);
    }

    function setStudentData($userId, $field, $value)
    {
        $sql = "UPDATE `userstudent` SET `$field` = '$value' WHERE `id` = '$userId';";
        return $this->mysqli->query($sql);
    }

    function existsEmail($email)
    {
        $email = mysqli_real_escape_string($this->mysqli, $email);

        $sql = "SELECT * FROM `users` WHERE `email` LIKE '$email'";

        if ($result = $this->mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function existsCourseTitle($title, $year)
    {
        $sql = "SELECT * FROM `courses` WHERE `courseTitle` LIKE '$title' AND `year` LIKE $year";

        if ($result = $this->mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function existsUser($email, $password)
    {
        $email = mysqli_real_escape_string($this->mysqli, $email);
        //$email = str_replace("<", " ", $email);
        $pwdmd5 = md5($password);

        $sql = "SELECT * FROM `users` WHERE `email` LIKE '$email' AND `password` LIKE '$pwdmd5';";

        if ($result = $this->mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function existStudent($id)
    {
        $sql = "SELECT * FROM `userstudent` WHERE `id` = $id";

        if ($result = $this->mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function existsUserId($userId)
    {
        $userId = mysqli_real_escape_string($this->mysqli, $userId);

        $sql = "SELECT * FROM `users` WHERE `id` LIKE '$userId';";

        if ($result = $this->mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function existsCourseId($courseId)
    {
        $courseId = mysqli_real_escape_string($this->mysqli, $courseId);

        $sql = "SELECT * FROM `courses` WHERE `courseId` LIKE '$courseId';";

        if ($result = $this->mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function getCourse($courseId)
    {
        $courseId = mysqli_real_escape_string($this->mysqli, $courseId);

        $sql = "SELECT * FROM `courses` WHERE `courseId` LIKE '$courseId';";

        if ($result = $this->mysqli->query($sql)) {
            $j = 0;
            $arAdd = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $arAdd['courseId'] = $row['courseId'];
                $arAdd['courseTitle'] = $row['courseTitle'];
                $arAdd['year'] = $row['year'];
                $arAdd['semester'] = $row['semester'];
                $arAdd['lecId'] = $row['lecId'];
                $arAdd['instId'] = $row['instId'];
                $arAdd['contactHours'] = $row['contactHours'];
                $arAdd['labHours'] = $row['labHours'];
            }
            return $arAdd;
        } else {
            return 0;
        }
    }
function getClass($id)
    {
        $id = mysqli_real_escape_string($this->mysqli, $id);

        $sql = "SELECT * FROM `class` WHERE `id` LIKE '$id';";

        if ($result = $this->mysqli->query($sql)) {
            $arAdd = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $arAdd['courseId'] = $row['courseId'];
                $arAdd['classType'] = $row['classType'];
                $arAdd['classTime'] = $row['classTime'];
                $arAdd['classDate'] = $row['classDate'];
                $arAdd['duration'] = $row['duration'];
                $arAdd['conductedBy'] = $row['conductedBy'];
            }
            return $arAdd;
        } else {
            return 0;
        }
    }

    function listUsers($field)
    {
        // , $from, $count
        $sql = "SELECT * FROM `users` WHERE 1";

        if ($result = $this->mysqli->query($sql)) {
            $j = 0;
            $arAdd = array();

            while ($row = mysqli_fetch_array($result)) {
                $arAdd[$j] = $row[$field];
                $j++;
            }
            return $arAdd;
        } else {
            return 0;
        }
    }

    function listUsersByName()
    {
        // , $from, $count
        $sql = "SELECT id,firstName,lastName FROM `users` WHERE 1";

        if ($result = $this->mysqli->query($sql)) {
            $j = 0;
            $arAdd = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $arAdd[$j]['name'] = $row['firstName'] . ' ' . $row['lastName'];
                $arAdd[$j]['id'] = $row['id'];
                $j++;
            }
            return $arAdd;
        } else {
            return 0;
        }
    }

    function listCourses()
    {
        // , $from, $count
        $sql = "SELECT * FROM `courses` WHERE 1";

        if ($result = $this->mysqli->query($sql)) {
            $j = 0;
            $arAdd = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $arAdd[$j]['courseId'] = $row['courseId'];
                $arAdd[$j]['courseTitle'] = $row['courseTitle'];
                $arAdd[$j]['year'] = $row['year'];
                $arAdd[$j]['semester'] = $row['semester'];
                $arAdd[$j]['lecId'] = $row['lecId'];
                $arAdd[$j]['instId'] = $row['instId'] != null ? $row['instId'] : 'not-assigned';
                $arAdd[$j]['contactHours'] = $row['contactHours'];
                $arAdd[$j]['labHours'] = $row['labHours'] != null ? $row['labHours'] : '----';
                $j++;
            }
            return $arAdd;
        } else {
            return 0;
        }
    }
    function listClasses()
    {
        // , $from, $count
        $sql = "SELECT * FROM `class` WHERE 1";

        if ($result = $this->mysqli->query($sql)) {
            $j = 0;
            $arAdd = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $arAdd[$j]['id'] = $row['id'];
                $arAdd[$j]['courseId'] = $row['courseId'];
                $arAdd[$j]['classType'] = $row['classType'] != null ? $row['classType'] : 'not-assigned';
                $arAdd[$j]['classDate'] = $row['classDate'];
                $arAdd[$j]['classTime'] = $row['classTime'];
                $arAdd[$j]['duration'] = $row['duration'];
                $arAdd[$j]['conductedBy'] = $row['conductedBy'];
                $j++;
            }
            return $arAdd;
        } else {
            return 0;
        }
    }

    function deleteUser($userId)
    {
        $sql = "DELETE FROM `users` WHERE `id` LIKE '$userId';";
        if ($this->mysqli->query($sql) == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function deleteStudent($userId)
    {
        $sql = "DELETE FROM `userstudent` WHERE `id` LIKE '$userId';";
        if ($this->mysqli->query($sql) == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    private function sqlSafe($text)
    {
        $text = str_replace("'", "\"", $text);
        $text = str_replace("`", "\"", $text);

        return $text;
    }

    //**** Super Class Functions ***********************************************

    function q_Update($table, $key, $value, $field, $new)
    {
        $sql = "UPDATE `$table` SET `$field` = '$new' WHERE `$key` = '$value';";
        if ($this->mysqli->query($sql) == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function q_Select($table, $key, $value, $field)
    {
        $sql = "SELECT * FROM `$table` WHERE `$key`.`id` = '$value';";
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_assoc();

        $res = $row[$field];
        return $res;
    }

    function q_Delete($table, $field, $value)
    {
        $sql = "DELETE FROM `$table` WHERE `$field` = '$value';";
        if ($this->mysqli->query($sql) == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function q_Exist($table, $field, $value)
    {
        $sql = "SELECT * FROM `$table` WHERE `$field` LIKE '$value';";

        if ($result = $this->mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function q_List($table, $field, $option)
    {

        $sql = "SELECT * FROM `$table` WHERE $option";
        if ($result = $this->mysqli->query($sql)) {
            $j = 0;
            $arAdd = array();

            while ($row = mysqli_fetch_array($result)) {
                $arAdd[$j] = $row[$field];
                $j++;
            }
            return $arAdd;
        } else {
            return 0;
        }
    }

}
