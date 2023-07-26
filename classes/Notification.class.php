<?php

require_once('Database.class.php');

class Notification extends Database{
    public function getAdminNotifications(){
        $sql = "SELECT * FROM tbl_notification WHERE type = 'admin' ORDER BY notif_id DESC LIMIT 5";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getCoordinatorNotifications(){
        $sql = "SELECT * FROM tbl_notification WHERE type = 'coordinator' ORDER BY notif_id DESC LIMIT 5";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}