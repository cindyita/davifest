<?php
require 'model.php';

class PageController {

    public static function header(){
        require_once "./views/layout/header.php";
    }

    public static function footer(){
        require_once "./views/layout/footer.php";
    }

    public static function home(){
        require_once "./views/home.php";
    }

    public static function admin() {
        $error = '';

        if (isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated'] === true) {
            self::header();
            require_once "./views/admin.php";
            self::footer();
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_password'])) {
            $password = $_POST['admin_password'];
            if (ADMIN_PASSWORD != '' && $password === ADMIN_PASSWORD) {
                $_SESSION['admin_authenticated'] = true;
                header("Location: admin");
                exit;
            } else {
                $error = "Clave de acceso incorrecta.";
            }
        }
        self::header();
        echo '<div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded-xl">
            <h2 class="text-xl font-semibold mb-4 text-center">Acceso al administrador</h2>
            <form method="POST" action="admin">
                <div class="w-full flex gap-3 mb-3">
                    <input type="password" name="admin_password" class="input border border-pink-300 rounded-full focus:outline-none focus:ring-4 focus:ring-pink-300 px-4 py-2 transition w-full" placeholder="Clave de acceso" required>

                    <button type="submit" class="button text-white rounded-full px-6 transition flex items-center gap-2 py-2">Entrar</button>
                </div>
                
                <div class="text-red-600 mt-2 text-sm text-center">'.$error.'</div>
            </form>
        </div>';
        self::footer();
    }

    public static function logout() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header("Location: admin");
        exit;
    }

}