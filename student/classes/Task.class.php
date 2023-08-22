<?php

require_once('../config/Database.class.php');


class Task extends Database
{
    public function getStudentTask($student_id)
    {
        $sql = "SELECT * FROM tbl_student_task WHERE student_id = ? ORDER BY task_id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getCoordinatorTask($organization_id)
    {
        $sql = "SELECT * FROM tbl_coordinator_task WHERE organization_id = ? ORDER BY task_id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$organization_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function createStudentTask($student_id, $task_name, $task_description)
    {
        if (empty($task_name) || empty($task_description)) {
            return 'Cannot be empty';
        } else {
            $sql = "INSERT INTO tbl_student_task (student_id, task_name, task_description) VALUES (?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$student_id, $task_name, $task_description]);
            return 'Task created successfully';
        }
    }

    public function deleteStudentTask($task_id)
    {
        $sql = "DELETE FROM tbl_student_task WHERE task_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$task_id]);
        return 'Task deleted successfully';
    }
}
