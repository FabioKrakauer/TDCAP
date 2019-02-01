<?php
    ob_start(); // Initiate the output buffer
    date_default_timezone_set('America/Sao_Paulo');
?>
<?php
    $dir = realpath(__DIR__ . '/..');
    require_once $dir.'/config/config.php';
    require_once APP_ROOT . '/classes/APIDB.class.php';
    require_once APP_ROOT . "/classes/User.class.php";
    if(!isset($_SESSION)){
        session_start();
    }
    
    class Auth{
        public static function isLogged($redirect = false, $nextUrl = "index.php"){
            if(isset($_COOKIE["auth"]) && $_COOKIE["auth"] != "abc"){
                if(!isset($_SESSION["auth"])){
                    $_SESSION["auth"] = $_COOKIE["auth"];
                }
                $jdecode = json_decode($_COOKIE["auth"], true);
                $name = utf8_decode($jdecode["name"]);
                $password = utf8_decode($jdecode["password"]);
                $result = Auth::validate($name, $password);
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
        public static function validate($username, $password){
            $db = new APIDB();
            $id = -1;
            $select = $db->query("SELECT `id` FROM `admin` WHERE `name` = '$username' AND `password`='$password'");
            if($row = $select->fetch()){
                $arr = [
                    "name" => utf8_encode($username),
                    "password" => utf8_encode($password)
                ];
                
                $json = json_encode($arr);
                setcookie("auth", $json, time()+60*60*24*30, "/");
                return $row["id"];
            }
            return $id;
        }
        public static function user(){
            $arr = json_decode($_SESSION["auth"], true);
            $name = utf8_decode($arr["name"]);
            $password = utf8_decode($arr["password"]);
            return new User(Auth::validate($name, $password));
        }
        public static function logout(){
            setcookie('auth', '', time()-3600, '/');
            $_SESSION["auth"] = null;
            $_COOKIE["auth"] = null;
        }
        public static function log($message){
            $db = new APIDB();
            $day = date("Y-m-d H:i:s", time());
            $id = Auth::user()->getID();
            $query = "INSERT INTO `admin_log` (`id`, `user_id`, `action`, `datestamp`) VALUES (NULL, '$id', '$message', '$day')";
            $db = new APIDB();
            $db->query($query);
        }
    }
    ob_end_flush();