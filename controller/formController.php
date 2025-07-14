<?php 
require_once 'model.php';

class FormController {
    public static function saveCongrats() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !isset($data['name'])) {
            echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
            exit;
        }

        $success = DBModel::saveCongrats(
            $data['name'],
            $data['confirm'],
            $data['congrats']
        );

        echo json_encode(['success' => $success]);
    }

    public static function getCongrats(){
        $congrats = DBModel::getAllCongrats();
        echo json_encode($congrats);
    }

    public static function getStats(){
        $get = DBModel::getStats();
        echo json_encode($get);
    }

    public static function getName(){
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'] ?? '';
        $get = DBModel::getName($name);
        echo json_encode($get);
    }

    public static function deleteCongrats($id){
        $success = DBModel::deleteCongrats($id);
        if($success){
            $id = DBModel::lastId();
            echo json_encode(['success' => $success, 'id' => $id]);
        }else{
            echo json_encode(['success' => false, 'error' => 'Error No se pudo eliminar']);
            exit;
        }
    }

}
