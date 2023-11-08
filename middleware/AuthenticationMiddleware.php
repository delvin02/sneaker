<?php 
class AuthenticationMiddleware {
    public function handle ($next)
    {
        if (isset($_SESSION['user_id'])) {
            return $next();
        }
        echo "<script>window.location.replace('auth.php');</script>";
        exit;
    }
}

?>