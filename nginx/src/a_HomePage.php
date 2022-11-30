<?php
/////////////////////////
// --- HOME PAGE ---  //
///////////////////////

$auth_version=2; // app Version (1 or 2)
$auth_icon="data:image/png;base64,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"; // Image (only available with version 2)
$auth_message="Welcome Thundercat Team"; // Text in the Landing page
$internal_usage=""; // Put here anything you want
?>
