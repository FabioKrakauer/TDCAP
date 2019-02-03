<?php
    ob_start(); // Initiate the output buffer
    date_default_timezone_set('America/Sao_Paulo');
?>
<?php
    $dir = realpath(__DIR__ . '/..');
    require_once $dir.'/config.inc.php';
    require_once 'User.class.php';
    if(!isset($_SESSION)){
        session_start();
    }
    
    class Auth{
        public static function isLogged($redirect = false){
            if(isset($_COOKIE["auth"]) && $_COOKIE["auth"] != "abc"){
                if(!isset($_SESSION["auth"])){
                    $_SESSION["auth"] = $_COOKIE["auth"];
                }
                $jdecode = json_decode($_COOKIE["auth"], true);
                $email = utf8_decode($jdecode["email"]);
                $password = utf8_decode($jdecode["password"]);
                $result = Auth::validate($email, $password);
                if($result == -1){
                    if($redirect == true){
                        //HEADER EXCEPTION
                        echo "<script>window.location='/estoque/pages/login.php'</script>";
                        return false;
                    }else{
                        return false;
                    }
                }else{
                    return true;
                }
            }else{
                if($redirect == true){
                    //HEADER EXCEPTION
                    echo "<script>window.location='/estoque/pages/login.php'</script>";
                    return false;
                }else{
                    return false;
                }    
            }
        
    }
        public static function validate($email, $password){
            global $database;
            $id = -1;
            $select = $database->query("SELECT `id`, `email`, `password`, `admin` FROM `user` WHERE `email`='$email' AND `password`='$password'");
            if($row = $select->fetch()){
                $arr = [
                    "email" => utf8_encode($row["email"]),
                    "password" => utf8_encode($row["password"]),
                    "admin" => utf8_encode($row["admin"])
                ];
                
                $json = json_encode($arr);
                setcookie("auth", $json, time()+60*60*24*30, "/");
                return $row["id"];
            }
            return $id;
        }
        public static function user(){
            $arr = json_decode($_SESSION["auth"], true);
            $email = utf8_decode($arr["email"]);
            $password = utf8_decode($arr["password"]);
            return new User(Auth::validate($email, $password));
        }
        public static function logout(){
            setcookie('auth', '', time()-3600, '/');
            $_SESSION["auth"] = null;
            $_COOKIE["auth"] = null;
        }
        public static function log($message){
            global $database;
            $db = $database;
            $day = date("Y-m-d H:i:s", time());
            $id = Auth::user()->getID();
            $query = "INSERT INTO `admin_log` (`id`, `admin_id`, `action`, `datestamp`) VALUES (NULL, '$id', '$message', '$day')";
            $db->query($query);
        }
    }
    ob_end_flush();