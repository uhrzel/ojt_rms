<?php

require_once('../config/Database.class.php');


class Coordinator extends Database{
    public function getCoordinators($organization_id){
        $sql = "SELECT * FROM tbl_coordinator WHERE organization_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$organization_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}