<?php

require_once "../enums/Barangay.php";
require_once "../util/Misc.php";

$ms = new Misc;
$barangays = Barangay::all();

echo $ms->json_response($barangays, "All Mountain Barangays");