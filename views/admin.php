<?php
include_once "modules/head.php";
?>
<body>
<?php
include_once 
(isset($_SESSION['status']) && $_SESSION['status'] == 2)?"admin_page.php":"404.php";
?>
</body>
</html>