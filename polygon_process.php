<style type="text/css">
 <!--
.tab { margin-left: 40px; }
 -->
.button {
  background: #0055b8;
  background-image: -webkit-linear-gradient(top, #0055b8, #0055b8);
  background-image: -moz-linear-gradient(top, #0055b8, #0055b8);
  background-image: -ms-linear-gradient(top, #0055b8, #0055b8);
  background-image: -o-linear-gradient(top, #0055b8, #0055b8);
  background-image: linear-gradient(to bottom, #0055b8, #0055b8);
  -webkit-border-radius: 1;
  -moz-border-radius: 1;
  border-radius: 1px;
  font-family: Arial;
  color: #ffffff;
  font-size: 10px;
  padding: 5px 5px 5px 5px;
  text-decoration: none;
}

.button:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}

 </style>


<html><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252"></head>
<body>

<?php   
$conn = pg_connect("host=172.31.29.34 port=5433 dbname=pge user=postgres password=Msimonpass!");

# TODO: replace "SELECT *" with the columns you want, and don't select from 
# parcels, select from whatever table you're actually interested in 
# querying
$sql = "
    SELECT *
    FROM public.impactsandmitigation 
    WHERE ST_Intersects(
        ST_Transform(
            ST_GeomFromEWKT($1),
            4326
        ),
        geom    );
";

# $_GET['poly'] is a string that looks something like:
#   'POLYGON((123.123 456.456,223.223 456.456,323.323 456.456))'
# 
# PostGIS's ST_GeomFromEWKT() function takes almost that exact string, but needs 
# the SRID too, so the resulting format looks like:
#
#   'SRID=900913;POLYGON((...))'
#
# So this constructs the actual string we send to ST_GeomFromEWKT().
$poly_string_with_srid = 'SRID=900913;' . $_GET['poly'];

$result = pg_query_params(
    $conn,
    $sql,
    array($poly_string_with_srid)
);

if (!$result) {
	echo "A query error occured.\n";
	exit;
}

date_default_timezone_set('UTC');

$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo ' ';
} else {
    echo 'Script timezone and ini-set timezone match.';
}
?><center>Date/Time:
<?php
$date = date_create();
echo date_format($date, 'Y-m-d H:i:s') . "\n";?></center><br>
<?php

while ($row = pg_fetch_array($result)) {

?>
<b><p style="font-size:12px"> <?=$row['project_na']?>  </b> <br>
				Type:   <?= $row['type'] ?><br>	</p>
				
	
<?php
if ($row['type'] == ('Impact'))  {?>Impact:<?= $row['ss_impact'] ?></td>


</tr><?php }?>
<?php
if ($row['type'] == ('Mitigation'))  {?>Mitigation:<?= $row['ss_mitig'] ?></td>


</tr><?php }?>

<br><br>


</body>
</html>
<?php  }?>
