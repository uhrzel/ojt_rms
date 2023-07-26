<?php

require_once('../config/Database.class.php');


class User extends Database{
    public function getAdminUser($id){
        $sql = "SELECT * FROM tbl_user WHERE user_id = ? AND user_role = 'Admin'";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }
}