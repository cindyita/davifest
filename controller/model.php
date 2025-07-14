<?php

require_once __DIR__ . '/../data.php';

class DBModel {
    private static $pdo;

    public static function connect() {
        if (!self::$pdo) {
            try {
                self::$pdo = new PDO('sqlite:' . DB_PATH);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->exec("PRAGMA foreign_keys = ON;");

                // TABLAS
                self::$pdo->exec("CREATE TABLE IF NOT EXISTS congrats (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name TEXT,
                    confirm TEXT,
                    congrats TEXT,
                    date_confirm DATETIME DEFAULT CURRENT_TIMESTAMP
                )");
            } catch (Exception $e) {
                die("Error de base de datos: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }

    public static function disconnect() {
        if (self::$pdo) {
            self::$pdo = null;
        }
    }

    public static function saveCongrats($name, $confirm, $congrats) {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare("
                INSERT INTO congrats (name, confirm, congrats, date_confirm)
                VALUES (:name, :confirm, :congrats, :date_confirm)
            ");
            $datetime = (new DateTime('now', new DateTimeZone('America/Mexico_City')))->format('Y-m-d H:i:s');
            $stmt->execute([
                ':name' => $name,
                ':confirm' => $confirm,
                ':congrats' => $congrats,
                ':date_confirm' => $datetime
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("DB ERROR: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            return false;
        }
    }

    public static function getAllCongrats() {
        $pdo = self::connect();
        $stmt = $pdo->query("SELECT 
                id, name, confirm, congrats
            FROM congrats
            ORDER BY id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getStats() {
        $pdo = self::connect();
        $stmt = $pdo->query("SELECT
            COUNT(DISTINCT name) AS total,
            SUM(CASE WHEN confirm = 'Si' THEN 1 ELSE 0 END) AS total_si,
            SUM(CASE 
                    WHEN confirm = 'Si' THEN 1 
                    WHEN confirm = 'Si +1' THEN 2 
                    ELSE 0 
                END) AS total_guests,
            SUM(CASE WHEN confirm = 'Tal vez' THEN 1 ELSE 0 END) AS total_talvez,
            SUM(CASE WHEN confirm = 'No' THEN 1 ELSE 0 END) AS total_no
        FROM congrats");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getName($name) {
        $pdo = DBModel::connect();
        $stmt = $pdo->prepare("SELECT name FROM congrats WHERE name = :name");
        $stmt->execute([':name' => $name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteCongrats($id){
        $pdo = DBModel::connect();
        $stmt = $pdo->prepare("DELETE FROM congrats WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public static function lastId(){
        $pdo = self::connect();
        return $pdo->lastInsertId();
    }

}
