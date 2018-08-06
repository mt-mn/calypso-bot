<html>
 <body>

<?php
  $link = pg_Connect("host=ec2-23-23-216-40.compute-1.amazonaws.com port=5432 dbname=deko3n85j4ri1q user=fiaknamxlunoil password=d100670ed9d12fe4e7607538cdc26be62bb487aa71db488d59bc045a3169e9b1");
  $result = pg_query($link, "SELECT status from public.check_ok where check_result = 'OPT';");
  if ($_GET["check"] = "OK") {
	  $put = pg_query($link, "UPDATE public.check_ok SET status = 'OK' where check_result = 'OPT';");
  }
  if ($_GET["check"] = "FAIL") {
	  $put = pg_query($link, "UPDATE public.check_ok SET status = 'FAIL' where check_result = 'OPT';");
  }
  while ($row = pg_fetch_row($result)) {
	echo "$row[0]";
	echo "<br />\n";
}
	pg_close($link);
?><br>

 </body>
 </html> 