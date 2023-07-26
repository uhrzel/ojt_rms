<?php

require_once('../config/Database.class.php');


class Task extends Database{
    //STUDENT TASK
    public function getAllTasksByStudent($student_id){
        $sql = "SELECT * FROM tbl_student_task WHERE student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id]);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function getStudentTask($task_id){
        $sql = "SELECT * FROM tbl_student_task INNER JOIN tbl_student ON tbl_student_task.student_id = tbl_student.student_id WHERE task_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$task_id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getStudentTaskByOrganization($organization_id){
        $sql = "SELECT * FROM tbl_student INNER JOIN tbl_student_task ON tbl_student.student_id = tbl_student_task.student_id WHERE tbl_student.organization_id = ? ORDER BY task_id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$organization_id]);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function updateStudentTaskStatus($task_id, $status) {
        $sql = "UPDATE tbl_student_task SET task_status = ? WHERE task_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$status, $task_id]);
        $_SESSION['success'] = 'Task status updated successfully';
        header('Location: tasks.php');
    }

    public function deleteStudentTask($student_id, $task_id) {
        $sql = "DELETE FROM tbl_student_task WHERE student_id = ? AND task_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id, $task_id]);
        $_SESSION['success'] = 'Task deleted successfully';
        header('Location: tasks.php');
    }

    //COORDINATOR TASK
    public function getAllTasksByCoordinator($coordinator_id){
        $sql = "SELECT * FROM tbl_coordinator_task INNER JOIN tbl_coordinator ON tbl_coordinator_task.coordinator_id = tbl_coordinator.coordinator_id WHERE tbl_coordinator_task.coordinator_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$coordinator_id]);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function getCoordinatorTask($task_id){
        $sql = "SELECT * FROM tbl_coordinator_task INNER JOIN tbl_coordinator ON tbl_coordinator_task.coordinator_id = tbl_coordinator.coordinator_id WHERE tbl_coordinator_task.task_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$task_id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function createTask($coordinator_id, $organization_id, $task_name, $task_description) {
        $sql = "INSERT INTO tbl_coordinator_task (coordinator_id, organization_id, task_name, task_description) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$coordinator_id, $organization_id, $task_name, $task_description]);
        $_SESSION['success'] = 'Task created successfully';
        header('Location: index.php');
    }

    public function updateCoordinatorTask($task_id, $task_name, $task_description) {
        $sql = "UPDATE tbl_coordinator_task SET task_name = ?, task_description = ? WHERE task_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$task_name, $task_description, $task_id]);
        $_SESSION['success'] = 'Task updated successfully';
        header('Location: task.php?task_id='.$task_id);
    }

    public function deleteCoordinatorTask($task_id) {
        $sql = "DELETE FROM tbl_coordinator_task WHERE task_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$task_id]);
        $_SESSION['success'] = 'Task deleted successfully';
        header('Location: index.php');
    }
}