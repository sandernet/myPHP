<?php
class checkuser {
//    Права сотрудников
    
    private $permission = array(   
        //руководители
                        'supplier' => array(
                                'user' => false,
                                'location' => false,
                                'addorder' => false
                                ),
        // менеджеры
                        'manager' => array(
                                'user' => true, 
                                'location' => true,
                                'addorder' => true
                                ),
//        // продавцы
                        'saler' => array(
                                'user' => false,
                                'location' => false,
                                'addorder' => false
                                )
        );

    


    public function checkpin($pin, $action) {
        $user = $this->outuser($pin);

        if ($this->permission[$user['status']][$action]){
            return $chpin = [true,'Действие разрешено!!'];
        }
        else {
            return $chpin = [false,'Действие НЕ разрешено!!'];
        }
    }
   
//    поиск сотрудника в базе по пин коду
  
    private function outuser($pin) {
        $db = $this->db();
        $sql = "SELECT `id`, `name`, `pin`, `status`, `active`, `createdAt`, `updatedAt` FROM `users` WHERE pin = $pin";
        $q = $db->query($sql);
        $query = $q->fetch();
        return $query;        
    }
    
    
    private function db(){
        try {
            $db = new PDO('mysql:host=localhost;dbname=sander5p_crm', 'sander5p_crm','ad901m');
            return $db;
        } 
        catch (PDOException $e) {
            print "Ошибка подключени к базе данных: " . $e->getMessage();
        }
    }
    
}
