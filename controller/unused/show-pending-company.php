<?php
include_once("../model/company.php");

return (new Company())->showPendingCompanies();

?>