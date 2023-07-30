<?php 


require_once("../../config.php"); 

if (isset($_GET['id'])) {


    $id = escape_string($_GET['id']);

    query("DELETE FROM reports WHERE report_id =" . escape_string($id));
    redirect("../../../public/admin/index.php?source=reports");
}