<html>
 <body>

<?php echo $_GET["check"]; 
	$link = pg_Connect("host=ec2-23-23-216-40.compute-1.amazonaws.com port=5432 dbname=deko3n85j4ri1q user=fiaknamxlunoil password=d100670ed9d12fe4e7607538cdc26be62bb487aa71db488d59bc045a3169e9b1");
  $result = pg_query($link, "SELECT status from public.check_ok where check_result = 'OPT';");
  $numrows = pg_numrows($result);
  while ($row = pg_fetch_row($result)) {
	echo "value1: $row[0]  value2: $row[1]";
	echo "<br />\n";
}

?><br>

 </body>
 </html> 