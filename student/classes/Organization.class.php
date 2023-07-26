<?php

require_once('../config/Database.class.php');


class Organization extends Database{
    public function getOrganization($id){
        $sql = "SELECT * FROM tbl_organization WHERE organization_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getOrganizations(){
        $sql = "SELECT * FROM tbl_organization ORDER BY organization_id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getOrganizationByOrganizationName($organization_name){
        $sql = "SELECT * FROM tbl_organization WHERE organization_name = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$organization_name]);
        $result = $stmt->fetch();
        return $result;
    }
}