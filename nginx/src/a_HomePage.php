<?php
/////////////////////////
// --- HOME PAGE ---  //
///////////////////////

$auth_version=2; // app Version (1 or 2)
$auth_icon="data:image/png;base64,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"; // Image (only available with version 2)
$auth_message="Demo for Jesse"; // Text in the Landing page
$internal_usage=""; // Put here anything you want
?>
