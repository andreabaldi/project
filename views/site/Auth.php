
<?php
// Start session

// Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['session_id'])) {
    $session_user = htmlspecialchars($_SESSION['session_user'], ENT_QUOTES, 'UTF-8');
    $session_id = htmlspecialchars($_SESSION['session_id']);
    $session_role = htmlspecialchars($_SESSION['session_role']);
    header("location: AccessoNegato.php");
    exit();
}
?>


