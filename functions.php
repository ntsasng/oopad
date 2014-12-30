<?php
function __autoload ($url) {
	require "$url.php";
}