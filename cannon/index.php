<?php
ob_start();
$header = 'HTTP/1.1 404 Not Found';

if (isset($_GET['id'])) {
	$db = '../cannon.db';
	$lines = file($db);
	$search = '/^' . $_GET['id'] . ':/';
	foreach ($lines as $line) {
		if (preg_match($search, $line)) {
			$file = explode(':', $line);
			$payload = file_get_contents(trim('../payloads/' . $file[1]));
			echo '<pre>' . htmlentities($payload) . '</pre>';
			$db_contents = file_get_contents($db);
			$db_contents = str_replace($line, '', $db_contents);
			file_put_contents($db, $db_contents);
			$header = 'HTTP/1.1 200 OK';
		}
	}
}

header($header);
ob_end_flush();
