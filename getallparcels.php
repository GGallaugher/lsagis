<style type="text/css">
 <!--
.tab { margin-left: 40px; }
 -->
.button {
  background: #54b7bf;
  background-image: -webkit-linear-gradient(top, #54b7bf, #54b7bf);
  background-image: -moz-linear-gradient(top, #54b7bf, #54b7bf);
  background-image: -ms-linear-gradient(top, #54b7bf, #54b7bf);
  background-image: -o-linear-gradient(top, #54b7bf, #54b7bf);
  background-image: linear-gradient(to bottom, #54b7bf, #54b7bf);
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

# Construct the query.  Input coordinates are SRID 900913, database
# coordinatees are 4326 (WGS_1984). This interprets input coordinates as
# 900913, transforms them to 4326, and finds any parcels whose `geom` contains
# the resulting point.
$sql =  "
    SELECT * FROM public.mitigation_points WHERE
    ST_Contains(
        mitigation_points.geom, 
        ST_Transform(
            ST_SetSRID(
                ST_MakePoint($1, $2), 900913
            ),
            4326
        )
    )ORDER BY gid;
";

$result = pg_query_params(
    $conn,
    $sql,
    # This is the $1 and $2 above.  They correspond with the URL's ?longitude=X&latitude=Y
    array($_GET['longitude'], $_GET['latitude'])
);


    while ($row = pg_fetch_array($result)) {

if (is_null($result)) {?>

<b><p style="font-size:12px"> 
A query error occurred.
 </b></p> <br>
<?php
} else {
?>
				
				<b><p style="font-size:12px"> <?=$row['Project Na']?>  </b> <br>
				Mitigation:   <?= $row['ss_mitig'] ?><br>	</p>
		<br><br>
					

<BR>



</body>
</html>
<?php  }}?>