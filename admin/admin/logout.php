<?php
session_start();
include("../../includes/koneksi.php");
$_SESSION['login'] == "";
session_unset();
session_destroy();

?>
<script language="javascript">
    document.location = "../../login/login.php";
</script>