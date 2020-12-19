<?php require_once  'header.php';?>

<div class="jumbotron text-center">
    <h2>Student result</h2>
    <p><?php strpos($data, 'xml') ? print_r(htmlspecialchars($data, ENT_QUOTES))  : print_r($data)  ?></p>
</div>


<?php require_once  'footer.php';?>
