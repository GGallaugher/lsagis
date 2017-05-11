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
<meta http-equiv="content-type" content="text/html; charset=windows-1252"></head><body><form>



<?php
$conn = pg_connect("host=172.31.29.34 port=5433 dbname=cultural user=postgres password=Msimonpass!");
$sql= "
    SELECT *
    FROM public.parcels_photos
    WHERE parcels_photos.apn = ($1);
";
$result = pg_query_params(
    $conn,
    $sql,
	 array($_GET['apn'])
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
    # For each row returned, put it in $row
    while ($row = pg_fetch_array($result)) {
?>
	
<b><p style="font-size:15px"> Parcel Report</b></p><br>
	<p style="font-size:12px">This is a preliminary (pre-field survey) report. After field survey is conducted, property owner shall refer to the <a href="http://solanohcp.com/documents/HCP_Compliance_Checklist.pdf" target="_blank" align ='center'>HCP Measures</a> document to identify all measures that apply.</b><br><br>
HCP measures apply to both direct and indirect project impacts. As such, measures for adjacent parcels within specified buffer distances may be included.</p></font><br>		
				
				<b><p style="font-size:12px"> <?=$row['full_addre']?> </p></b> <br>
				<p class="tab">&#9679;  Parcel APN:   <?= $row['apn'] ?><br>	
		
				<p class="tab">&#9679;  Acres:   <?= $row['acres'] ?><br>

				
<BR>
<?php if (($row['vpg_des_1'] == ('Yes'))OR ($row['mit_1_3']== ('Yes')) or ($row['mit_1_1'] ==('Yes')) OR ($row['mit_1_2']==('Yes') OR ($row['vpg_des_6']==('Yes')OR ($row['vpg_mit_4']==('Yes')))))   {?>
<table style="height: 50px; width: 680px; border-color: #000000; border-style: solid; border-collapse: collapse; background-color: #F7F6F0; font-size: 10; border-width: 1px;">
<tbody>
<tr style="height: 20px; background-color: #54b7bf; color:#000000; ">
<td style="width: 250px; height: 20px;background-color: #54b7bf;"><b><p style="font-size:12px">Valley Floor Grassland and Vernal Pool Measures</p></b></td>

<?php }?>

<?php
if ($row['vpg_des_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">VPG DES 1: Habitat Avoidance</td>

</tr><?php }?>

<?php
if ($row['vpg_des_2'] == ('Yes'))  {?>
<tr style="height: 20px;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">VPG DES 2: Site Design Standards</td>
</tr></tr><?php }?>

	
<?php
if ($row['vpg_des_3'] == ('Yes'))  {?>
<tr style="height: 20px;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">VPG DES 3: Buffer Criteria for Development Activities</td>
</tr><?php }?>

<?php
if ($row['vpg_des_4'] == ('Yes'))  {?>
<tr style="height: 20px;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">VPG DES 4: Protection and Buffer Zones for Extremely Rare and/or Limited Range Species</td>
</tr><?php }?>


<?php
if ($row['vpg_des_5'] == ('Yes'))  {?>
<tr style="height: 20px;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">VPG DES 5: Design Measures for New Roads</td>
</tr><?php }?>


<?php	
if ($row['vpg_des_6'] == ('Yes'))  {?>
<tr style="height: 20px;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">VPG DES 6: Key Corridors</td>
</tr><?php }?>
	
<?php	
if ($row['vpg_con_7'] == ('Yes'))  {?>
<tr style="height: 20px;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">VPG CON 7: Habitat Avoidance Best Management Practices</td>
</tr><?php }?>

<?php	
if ($row['vpcons_mit'] == ('Yes'))  {?>
<tr style="height: 20px;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">VFG MIT 1-1, 1-2, and 1-3: Habitat Mitigation in all Vernal Conservation Pool Measures must be reviewed</td>
</tr><?php }?>


<?php if ($row['mit_1']<> NULL){?>
<tr style="height: 20px;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;"><?= $row['mit_1'] ?></td>
</tr><?php }?>

<?php	
if ($row['vpg_mit_2'] == ('Yes'))  {?>
<tr style="height: 20px;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">VPG MIT 2: Habitat Mitigation Similarity</td>
</tr><?php }?>
<?php	
if ($row['vpg_mit_3'] == ('Yes'))  {?>
<tr style="height: 20px;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">VPG MIT 3: Mitigation for Impacts to Occupied Contra Costa Goldfield Habitat</td>
</tr><?php }?>
<?php	
if ($row['vpg_mit_4'] == ('Yes'))  {?>
<tr style="height: 20px;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">VPG MIT 4: Mitigation for Impacts to California Tiger Salamander Habitat</td>
</tr><?php }?>


</tbody>
</table>




<table style="height: 50px; width: 680px; border-color: #000000; border-style: solid; border-collapse: collapse; background-color: #F7F6F0; font-size: 10; border-width: 1px;">
<tbody>
<tr style="height: 20px; background-color: #54b7bf; color:#000000;">
<td style="width: 250px; height: 20px;background-color: #54b7bf"><b><p style="font-size:12px">Swainson's Hawk Measures</b></td>


<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SH DES 1: Nest Tree Protection</td>
</tr>

<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SH DES 2: Solano Irrigation District (SID) Annexations</td>

</tr>

<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SH CON 3: Preconstruction Nest Surveys</td>
</tr>


<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SH CON 4: Active Nest Buffers</td>

</tr>


<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SH CON 5: Post-Construction Occupied Nest Avoidance</td>
</tr>

<?php
if ($row['sh_mit_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SH MIT 1: Irrigated Agriculture Foraging Habitat Conservation</td>

</tr><?php }?>

<?php
if ($row['sh_mit_2'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SH MIT 2: Valley Floor Grassland Foraging Habitat Conservation</td>

</tr><?php }?>

<?php
if ($row['sh_mit_3'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SH MIT 3: Inner Coast Range Foraging Habitat Conservation</td>

</tr><?php }?>


<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SH MIT 4: Known Nest Trees</td>
</tr>
<?php
if ($row['sh_mit_5'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SH MIT 5: Preservation of Important Nesting Habitat</td>
</tr><?php }?>
</tbody>
</table>
		

<table style="height: 50px; width: 680px; border-color: #000000; border-style: solid; border-collapse: collapse; background-color: #F7F6F0; font-size: 10; border-width: 1px;">
<tbody>
<tr style="height: 20px; background-color: #54b7bf; color:#000000;">
<td style="width: 250px; height: 20px;background-color: #54b7bf"><b><p style="font-size:12px">Burrowing Owl Measures</b></td>



<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">BO CON 1: Preconstruction Surveys</td>

</tr>

<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">BO CON 2: Vegetation Management</td>

</tr>

<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">BO CON 3: Construction Buffers and Exclusion</td>

</tr>

<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">BO CON 4: Active Relocation</td>

</tr>

<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">BO MIT 1: Mitigation for Direct and Indirect Impacts to Foraging Habitat</td>

</tr>

<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">BO MIT 2: Known Nest Sites</td>

</tr>

<?php
if ($row['bo_mit_3'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">BO MIT 3: Preservation of Important Nesting Habitat</td>

</tr><?php }?>

<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">BO MIT 4: Mitigation for Temporary Impacts</td>

</tr>
</tbody>
</table>

<?php
if (($row['rlf_mit_4']== ('Yes')) OR ($row['rlf_des_1'] == ('Yes')))  {?>
<table style="height: 50px; width: 680px; border-color: #000000; border-style: solid; border-collapse: collapse; background-color: #F7F6F0; font-size: 10; border-width: 1px;">
<tbody>
<tr style="height: 20px; background-color: #54b7bf; color:#000000;">
<td style="width: 250px; height: 20px;background-color: #54b7bf"><b><p style="font-size:12px">California Red-Legged Frog Measures</b></td>

</tr><?php }?>

<?php
if ($row['rlf_des_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RLF DES 1: Habitat Avoidance</td>
</tr><?php }?>

<?php
if ($row['rlf_des_2'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RLF DES 2: Aquatic Habitat Buffers and Corridors</td>
</tr><?php }?>

<?php
if ($row['rlf_des_3'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RLF DES 3: Design Measures for New Roads</td>

</tr><?php }?>

<?php
if ($row['rlf_con_4'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RLF CON 4: Best Management Practices To Be Implemented During O&M And Construction Activities</td>

</tr><?php }?>

<?php
if ($row['rlf_mit_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RLF MIT 1: Mitigation For Direct And Indirect Impacts To Upland Habitat In The California Red-Legged Frog Conservation Area </td>

</tr><?php }?>

<?php
if ($row['rlf_mit_2'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RLF MIT 2: Mitigation For Direct And Indirect Impacts To Riparian, Stream, Pond, And Freshwater Habitats In The California Red-Legged Frog Conservation Area </td>

</tr><?php }?>

<?php
if ($row['rlf_mit_3'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RLF MIT 3: Mitigation For Temporary Impacts To Upland, Marsh, Pond/Aquatic, And Riparian Habitats</td>

</tr><?php }?>

<?php
if ($row['rlf_mit_4'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RLF MIT 4: Mitigation For Impacts To Breeding And Nonbreeding Aquatic Habitat Outside Of The California Redlegged Frog Conservation Area</td>

</tr><?php }?>

<?php
if ($row['rlf_mit_5'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RLF MIT 5: Nonnative Predator Habitat </td>

</tr><?php }?>
</tbody>
</table>


	<?php
if ($row['csb_des_1'] == ('Yes'))  {?>
<table style="height: 50px; width: 680px; border-color: #000000; border-style: solid; border-collapse: collapse; background-color: #F7F6F0; font-size: 10; border-width: 1px;">
<tbody>
<tr style="height: 20px; background-color: #54b7bf; color:#000000;">
<td style="width: 250px; height: 20px;background-color: #54b7bf"><b><p style="font-size:12px">Callippe Silverspot Butterfly Measures</b></td>

</tr><?php }?>

<?php
if ($row['csb_des_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CSB DES 1: Site Design Standards In Core Breeding Habitat</td>

</tr><?php }?>

<?php
if ($row['csb_con_2'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CSB CON 2: Best Management Practices To Be Implemented During O&M And Construction Activities</td>
</tr><?php }?>

<?php
if ($row['csb_mit_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CSB MIT 1: Mitigation For Direct, Indirect, And Temporary Impacts To Non-Breeding Habitat In The Callippe Silverspot Conservation Area</td>
</tr><?php }?>

<?php
if ($row['csb_mit_2'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CSB MIT 2: Mitigation For Direct, Indirect, And Temporary Impacts To Breeding Habitat In The Callippe Silverspot Butterfly Conservation Area</td>
</tr><?php }?>
</tbody>
</table>




<?php if ($row['apn']<> NULL) {?>
<table style="height: 50px; width: 680px; border-color: #000000; border-style: solid; border-collapse: collapse; background-color: #F7F6F0; font-size: 10; border-width: 1px;">
<tbody>
<tr style="height: 20px; background-color: #54b7bf; color:#000000;">
<td style="width: 250px; height: 20px;background-color: #54b7bf"><b><p style="font-size:12px">Riparian, Stream and Freshwater Marsh Measures*</b></td>

</tr><?php }?>

<?php
if ($row['rsm_des_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM DES 1: Habitat Avoidance</td>

</tr><?php }?>

<?php
if ($row['rsm_des_2'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM DES 2: Setbacks and Buffer Zones</td>

</tr><?php }?>


<?php
if ($row['rsm_con_3'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM CON 3: Riparian Tree Protection</td>

</tr><?php }?>

<?php
if ($row['rsm_con_4'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM CON 4: Best Management Practices to be Implemented During O&M and Construction Activities</td>

</tr><?php }?>



<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM CON 5: For Salmonids</td>



<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM CON 6: For Valley Elderberry Longhorn Beetle</td>





<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM CON 7: For Tricolored Blackbird</td>


<?php
if ($row['rsm_mit_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM MIT 1: Mitigation For Direct Impacts To Riparian, Stream, And Freshwater Marsh Habitat</td>

</tr><?php }?>

<?php
if ($row['rsm_mit_2'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM MIT 2: Mitigation For The Loss Or Fill Of Ponds, Freshwater Marsh Habitat, And Channels</td>

</tr><?php }?>

<?php
if ($row['rsm_mit_3'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM MIT 3: Mitigation For The Loss Or Fill Of Seasonal Wetlands In The Inner Coast Range</td>

</tr><?php }?>

<?php
if ($row['rsm_mit_4'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM MIT 4: Mitigation For Temporary Impacts To Riparian, Stream, And Freshwater Marsh Habitat</td>

</tr><?php }?>

<?php
if ($row['rsm_mit_5'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM MIT 5: Base Flow</td>

</tr><?php }?>

<?php
if ($row['rsm_mit_6'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM MIT 6: Development In Watersheds Of Priority Drainages</td>

</tr><?php }?>

<?php
if ($row['rsm_mit_7'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM MIT 7: Restoring Naturalized Channel Processes</td>

</tr><?php }?>

<?php
if ($row['rsm_mit_8'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM MIT 8: Prevent The "Perennialization" Of Ponds And Intermittent Creeks</td>

</tr><?php }?>


<?php
if ($row['sh_mit_5'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM MIT 9: Storm Water Discharge</td>


</tr><?php }?>



<?php
if ($row['rsm_mit_11'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM MIT 11: New Stream Crossings </td>

</tr><?php }?>

<?php
if ($row['rsm_mit_12'] <> NULL)  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM MIT 12: New Stream Crossings </td>
</tr><?php }?>

<?php
if ($row['rsm_mit_13']<> NULL)   {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">RSM MIT 13: Direct Loss Or Conversion Of Tricolored Blackbird Foraging Habitat And Temporary Impacts </td>
</tr><?php }?>
<?php
if (($row['rsm_des_1'] == ('Yes'))OR ($row['sh_mit_5']== ('Yes')) OR ($row['rsm_mit_1']== ('Yes'))OR ($row['rsm_mit_3'] == ('Yes')))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">*Riparian data has been aggregated from various sources and does not represent verified delineated waters or depict all wetlands that may be present on a parcel.</td>

</tr><?php }?>
</tbody>
</table>



<?php
if (($row['ggs_con_1'] == ('Yes')))  {?>
<table style="height: 50px; width: 680px; border-color: #000000; border-style: solid; border-collapse: collapse; background-color: #F7F6F0; font-size: 10; border-width: 1px;">
<tbody>
<tr style="height: 20px; background-color: #54b7bf; color:#000000;">
<td style="width: 250px; height: 20px;background-color: #54b7bf"><b><p style="font-size:12px">Giant Garter Snake Measures</b></td>

</tr><?php }?>

<?php
if ($row['ggs_con_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">GGS CON 1: Timing of Work</td>

</tr><?php }?>


<?php
if ($row['ggs_con_2'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">GGS CON 2: Best Management Practices To Be Implemented During O&M And Construction Activities </td>

</tr><?php }?>

<?php
if ($row['ggs_mit_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">GGS MIT 1: O&M Habitat Mitigation</td>

</tr><?php }?>

<?php
if ($row['ggs_mit_2'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">GGS MIT 2: Mitigation For Direct And Indirect Impacts To Giant Garter Snake Habitat </td>

</tr><?php }?>

</tbody>
</table>



<?php
if ($row['cm_des_1'] == ('Yes'))  {?>
<table style="height: 50px; width: 680px; border-color: #000000; border-style: solid; border-collapse: collapse;background-color: #F7F6F0; font-size: 10; border-width: 1px;">
<tbody>
<tr style="height: 20px; background-color: #54b7bf; color:#000000;">
<td style="width: 250px; height: 20px;background-color: #54b7bf"><b><p style="font-size:12px">Coastal Marsh Natural Community Measures</b></td>

</tr><?php }?>

<?php
if ($row['cm_des_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM DES 1: Habitat Avoidance</td>

</tr><?php }?>

<?php
if ($row['cm_con_3'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM CON 3: Best Management Practices To Be Implemented During O&M And Construction Activities</td>

</tr><?php }?>

<?php
if ($row['cm_con_4'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM CON 4: Use Of Riprap</td>

</tr><?php }?>

<?php
if ($row['cm_con_5'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM CON 5: Soft Bird'S-Beak And Suisun Thistle</td>

</tr><?php }?>

<?php
if ($row['cm_con_6'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM CON 6: Salt Marsh Harvest Mouse</td>


</tr><?php }?>

<?php
if ($row['cm_con_7'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM CON 7: Delta Smelt, Longfin Smelt, North American Green Sturgeon Southern Dps, And Sacramento Splittail</td>

</tr><?php }?>

<?php
if ($row['cm_con_8'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM CON 8: California Clapper Rail, California Black Rail, Suisun Song Sparrow</td>

</tr><?php }?>

<?php
if ($row['cm_mit_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM MIT 1: Mitigation For Direct Impacts To Marsh Habitat</td>

</tr><?php }?>

<?php
if ($row['cm_mit_2'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM MIT 2: Mitigation For Indirect Impacts To Marsh Habitat</td>

</tr><?php }?>

<?php
if ($row['cm_mit_3'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM MIT 3: Mitigation For Direct Impacts To Shallow Water Habitat</td>

</tr><?php }?>

<?php
if ($row['cm_mit_4'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM MIT 4: Mitigation For Temporary Impacts To Marsh Habitat</td>

</tr><?php }?>

<?php
if ($row['cm_mit_5'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM MIT 5: Dry Season Nuisance Flows</td>

</tr><?php }?>


<?php
if ($row['cm_mit_7'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM MIT 7: Covered Plant Species Salvage And Recovery</td>

</tr><?php }?>

<?php
if ($row['cm_mit_8'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">CM MIT 8: Mitigation For Delta Smelt And Sacramento Splittail Habitat</td>

</tr><?php }?>
</tbody>
</table>


<table style="height: 50px; width: 680px; border-color: #000000; border-style: solid; border-collapse: collapse; background-color: #F7F6F0; font-size: 10; border-width: 1px;">
<tbody>
<tr style="height: 20px; background-color: #54b7bf; color:#000000;">
<td style="width: 250px; height: 20px;background-color: #54b7bf"><b><p style="font-size:12px">Special Management Species Measures</b></td>
</tr>




<?php
if ($row['sms_con_1'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SMS CON 1: Preconstruction Surveys</td>

</tr><?php }?>


<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SMS CON 2: Buffer Zones</td>

</tr>

<?php
if ($row['sms_con_3'] == ('Yes'))  {?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SMS CON 3: Avoidance Of "Perennialization" Of Ponds And Intermittent Creeks To Protect Foothill Yellow-Legged Frogs And Western Pond Turtles</td>

</tr><?php }?>
<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">SMS CON 4: Minimize Impacts To Foothill Yellow-Legged Frogs And Western Pond Turtles</td>

</tr>

</tbody>
</table>



<table style="height: 50px; width: 680px; border-color: #000000; border-style: solid; border-collapse: collapse;background-color: #F7F6F0; font-size: 10; border-width: 1px;">
<tbody>
<tr style="height: 20px; background-color: #54b7bf; color:#000000;">
<td style="width: 250px; height: 20px;background-color: #54b7bf"><b><p style="font-size:12px">Invasive Species and Water Quality Management Measures</b></td>

<tr style="height: 20px;background-color: #F7F6F0; font-size: 10;">
<td style="class: border-bottom; width: 250px; height: 20px;background-color: #F7F6F0; font-size: 10; border-color: #767676; border-width: 0.5px;border-style: solid; border-left: none; border-right: none;">VPG MIT 5/RSM MIT 10/GGS MIT 3/CM MIT 6: Invasive Species and Water Quality</td>

</tr>
</tbody>
</table>


<Br><b><center><a href="<?=$row['reportlink']?>" target="_blank" align ='center'>Link to Detailed Measures for this Parcel</a></b></center> <br>
<br><br>

<font-size=14><b>Links to All HCP Measures:</b></font-size><br><br>



 &nbsp;&#8226; &nbsp;<a href="http://www.solanohcp.com/documents/measures/Valley_Floor_Grassland.pdf" target="_blank" align ='center'>Valley Floor Grassland and Vernal Pool</a> <br>



 &nbsp;&#8226; &nbsp;<a href="http://www.solanohcp.com/documents/measures/Swainsons_Hawk.pdf" target="_blank" align ='center'>Swainson's Hawk</a> <br>




 &nbsp;&#8226; &nbsp;<a href="http://www.solanohcp.com/documents/measures/Burrowing_Owl.pdf" target="_blank" align ='center'>Burrowing Owl</a> <br>




 &nbsp;&#8226; &nbsp;<a href="http://www.solanohcp.com/documents/measures/Red-Legged_Frog.pdf" target="_blank" align ='center'>California Red-legged Frog</a> <br>


 &nbsp;&#8226; &nbsp;<a href="http://www.solanohcp.com/documents/measures/Callippe_Silverspot_Butterfly.pdf" target="_blank" align ='center'>Callippe Silverspot Butterfly</a> <br>


 &nbsp;&#8226; &nbsp;<a href="http://www.solanohcp.com/documents/measures/Riparian_Stream_Marsh.pdf" target="_blank" align ='center'>Riparian, Stream, and Freshwater Marsh</a> <br>


 &nbsp;&#8226; &nbsp;<a href="http://www.solanohcp.com/documents/measures/Giant_Garter_Snake.pdf" target="_blank" align ='center'>Giant Garter Snake</a> <br>

 &nbsp;&#8226; &nbsp;<a href="http://www.solanohcp.com/documents/measures/Coastal_Marsh.pdf" target="_blank" align ='center'>Coastal Marsh</a> <br>


 &nbsp;&#8226; &nbsp;<a href="http://www.solanohcp.com/documents/measures/Special_Management_Species.pdf" target="_blank" align ='center'>Special Management Species</a><br>




</body>
</html>
<?php  }?>