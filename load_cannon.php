<?php
$art = <<<ART
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⢠⣄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⣹⣷⣶⣶⣶⣶⣦⣤⣤⣤⣤⣤⣤⣀⣀⣀⣀⣀⣀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⣼⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀
⠀⠀⠀⠀⠀⠀⠀⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀Payload Cannon
⠀⠀⠀⠀⠀⠀⠀⠙⢿⣿⣿⣿⠟⠋⠉⢉⡉⠙⢿⣿⣿⣿⣿⣿⣿⠿⠿⠿⠿⠀
⠀⠀⠀⠀⠀⠀⠀⣴⣿⣿⣿⠇⠀⠺⣦⣾⣇⣀⠀⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⣠⣾⣿⠟⠀⢸⡄⠰⠖⢻⡿⣿⡉⠀⣿⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⢀⣠⣴⣿⡿⠃⠀⠀⠈⢷⣄⠀⠛⠁⠈⢁⣴⠏⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠸⠿⠿⠿⠟⠀⠀⠀⠀⠀⠀⠙⠛⠷⠶⠿⠛⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
ART;

echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
echo $art;

$dir = 'payloads';
$payloads = array_values(array_diff(scandir($dir), array('.', '..')));
$i = 0;

echo "\nPayloads:\n";
foreach ($payloads as $payload) {
	echo "\t" . $i++ . ') ' .  $payload . "\n";
}

echo "\n";
while (true) {
	$choice = readline('Choose a payload to generate a one time URL: ');
	if ($choice >=0 && $choice < count($payloads)) {
		$id = substr(str_shuffle(str_repeat("0123456789abcdefghitjklmnopqurstuwxyz", 5)), 0, 5);
		$fp = fopen('cannon.db', 'a');
		fwrite($fp, $id . ':' . $payloads[$choice] . "\n");
		fclose($fp);
		echo "\nYour one time URL is: [ip][port]?id=$id\n";
		break;
	} else {
		echo "Invalid Choice!\n";
	}
}
