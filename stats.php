<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>APIFB Statistics</title>
</head>
<body>
<h1>APIFB Statistics</h1>
<h4>(c) <?php echo date("Y"); ?> &lt;ON&gt;TECH</h4>
<h4>Glory to 🇺🇦</h4>
<h4>Current time on server: <?php echo exec("date"); ?></h4>
<?php
$lead       = file_get_contents("lead_facebook_log.txt");
$sale       = file_get_contents("sale_facebook_log.txt");
$action     = file_get_contents("action_facebook_log.txt");
$separator  = "-------------------------------";
$success    = '"events_received":1';

echo "<hr/><h2><a href='lead_facebook_log.txt'>Leads</a> (<a href='clear.php?log=lead'>Clear</a>)</h2>";
echo "<p>Total events: " . substr_count($lead,$separator) . "</p>";
echo "<p>Successful events: " . substr_count($lead,$success) . "</p>";
echo "<p>" . explode("\n", $lead)[0] . "</p>";

echo "<hr/><h2><a href='sale_facebook_log.txt'>Sales</a> (<a href='clear.php?log=sale'>Clear</a>)</h2>";
echo "<p>Total events: " . substr_count($sale,$separator) . "</p>";
echo "<p>Successful events: " . substr_count($sale,$success) . "</p>";
echo "<p>" . explode("\n", $sale)[0] . "</p>";

echo "<hr/><h2><a href='action_facebook_log.txt'>Custom actions</a> (<a href='clear.php?log=action'>Clear</a>)</h2>";
echo "<p>Total events: " . substr_count($action,$separator) . "</p>";
echo "<p>Successful events: " . substr_count($action,$success) . "</p>";
echo "<p>" . explode("\n", $action)[0] . "</p>";
?>
</body>
</html>
