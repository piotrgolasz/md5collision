<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<style>
			tbody { 
				height:80em;  
				overflow: scroll;
			}
		</style>
	</head>
	<body>
		<?php
		date_default_timezone_set('Europe/Warsaw');
		error_reporting(~E_ALL);

		$time_start = microtime(true);
		list($usec, $sec) = explode(' ', $time_start);
		$usec = str_replace("0.", ".", $usec);
		
		$text1 = "\xA6\x64\xEA\xB8\x89\x04\xC2\xAC\x48\x43\x41\x0E\x0A\x63\x42\x54\x16\x60\x6C\x81\x44\x2D\xD6\x8D\x40\x04\x58\x3E\xB8\xFB\x7F\x89\x55\xAD\x34\x06\x09\xF4\xB3\x02\x83\xE4\x88\x83\x25\x71\x41\x5A\x08\x51\x25\xE8\xF7\xCD\xC9\x9F\xD9\x1D\xBD\xF2\x80\x37\x3C\x5B\x97\x9E\xBD\xB4\x0E\x2A\x6E\x17\xA6\x23\x57\x24\xD1\xDF\x41\xB4\x46\x73\xF9\x96\xF1\x62\x4A\xDD\x10\x29\x31\x67\xD0\x09\xB1\x8F\x75\xA7\x7F\x79\x30\xD9\x5C\xEB\x02\xE8\xAD\xBA\x7A\xC8\x55\x5C\xED\x74\xCA\xDD\x5F\xC9\x93\x6D\xB1\x9B\x4A\xD8\x35\xCC\x67\xE3";
		$text2 = "\xA6\x64\xEA\xB8\x89\x04\xC2\xAC\x48\x43\x41\x0E\x0A\x63\x42\x54\x16\x60\x6C\x01\x44\x2D\xD6\x8D\x40\x04\x58\x3E\xB8\xFB\x7F\x89\x55\xAD\x34\x06\x09\xF4\xB3\x02\x83\xE4\x88\x83\x25\xF1\x41\x5A\x08\x51\x25\xE8\xF7\xCD\xC9\x9F\xD9\x1D\xBD\x72\x80\x37\x3C\x5B\x97\x9E\xBD\xB4\x0E\x2A\x6E\x17\xA6\x23\x57\x24\xD1\xDF\x41\xB4\x46\x73\xF9\x16\xF1\x62\x4A\xDD\x10\x29\x31\x67\xD0\x09\xB1\x8F\x75\xA7\x7F\x79\x30\xD9\x5C\xEB\x02\xE8\xAD\xBA\x7A\x48\x55\x5C\xED\x74\xCA\xDD\x5F\xC9\x93\x6D\xB1\x9B\x4A\x58\x35\xCC\x67\xE3";
		
		$array = Array(
			$text1,
			$text2
		);
		?>
		<p>
			<?php echo date('H:i:s', $sec) . $usec;?>
		</p>
		<table border=1 id="qandatbl" align="center">
			<thead>
				<tr>
					<th class="col1">String</th>
						<?php
						foreach ($array as $key => $string)
						{
							echo '<td class="col' . ($key + 1) . '">' . $string . '</td>';
						}
						?>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>md5</td>
					<?php
					foreach ($array as $string)
					{
						echo '<td>' . md5($string) . '</td>';
					}
					?>
				</tr>
				<tr>
					<td>sha1</td>
					<?php
					foreach ($array as $string)
					{
						echo '<td>' . sha1($string) . '</td>';
					}
					?>
				</tr>
				<tr>
					<td>sha2</td>
					<?php
					foreach ($array as $string)
					{
						echo '<td>' . hash('sha256',$string) . '</td>';
					}
					?>
				</tr>
				<tr>
					<td>bcrypt</td>
					<?php
					$cost = 10;
					foreach ($array as $string)
					{
						$hash = password_hash($string,PASSWORD_BCRYPT, array(
							'cost' => $cost
						));
						echo '<td>'.'<font style="color:blue;">'.substr($hash,0,7).'</font>'.'<font color="green">'.substr($hash,8,30).'</font>'.'<font color="red">'.substr($hash,31).'</font>'.'</td>';
					}
					?>
				</tr>
			</tbody>
		</table>
		<p>
			bcrypt - 2y (code), <?php echo $cost;?> (cost), 22 characters (salt), 31 characters (password)
		</p>
		<p>
			<?php
				echo 'time completed: '.(microtime(true) - $time_start)
			?>
		</p>
	</body>
</html>