<?php

require_once "../enums/DeliveryCondition.php";
require_once "../util/Misc.php";

$ms = new Misc;

$delivery_conditions = DeliveryCondition::all();

echo $ms->json_response($delivery_conditions, "Delivery Conditions");