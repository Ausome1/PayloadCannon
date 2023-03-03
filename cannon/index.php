<?php
ob_start();
$header = 'HTTP/1.1 404 Not Found';
echo '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
  <html><head>
  <title>404 Not Found</title>
  </head><body>
  <h1>Not Found</h1>
  <p>The requested URL was not found on this server.</p>
  </body></html>';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $db = '../cannon.db';
        $lines = file($db);
        $search = '/^' . htmlentities($_GET['id']) . ':/';
        foreach ($lines as $line) {
                if (preg_match($search, $line)) {
                        ob_clean();
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
header('Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Pragma: no-cache');
header('Expires: Fri, 01 Jan 1990 00:00:00 GMT');
ob_end_flush();
