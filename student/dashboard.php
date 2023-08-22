<?php

if ($result == 'Success') {
    $userDetails = $student->getUserDetailsByEmail($email);
    echo json_encode($userDetails);
} else {
    echo $result;
}
