<?php
class checkuser {

    public function checkpin($user) {
        
        
        
    }
    
    private function outuser($pin) {
        $db = database();
        $sql = "SELECT `id`, `name`, `pin`, `status`, `active`, `createdAt`, `updatedAt` FROM `users` WHERE pin = ?";
        $q = $db->prepare($sql);
        $q = $q->execute($pin)->fetch();
        return $q;        
    }
}
