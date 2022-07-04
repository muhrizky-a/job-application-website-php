<?php
function showInfoAndredirectToPage($message, $page)
{
    echo '<script type="text/javascript">';
    echo 'alert("'.$message.'");';
    echo 'document.location.href = "../' . $page . '";';
    echo '</script>';
}
?>