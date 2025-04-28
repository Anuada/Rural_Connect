<?php
require_once "../util/Misc.php";
require "../vendor/autoload.php";

$ms = new Misc();

if (!isset($_GET['word']) || empty(trim($_GET['word']))) {
    echo $ms->json_response(null, "word is required", 422);
    exit();
}

$word = $_GET['word'];

$plural_form = $ms->pluralize($word);

echo $ms->json_response($plural_form, "Plural form of $word");