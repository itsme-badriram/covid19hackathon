<?php

if(isset($_POST['download'])){
    $link = $_POST['name'];
echo $link;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
echo '
<embed src="'.$link.'.pdf" type="application/pdf" width="100%" height="800px" />
';

?>

</body>
</html>