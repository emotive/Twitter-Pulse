<style>
body {font-family: Verdana; font-size: 10px;}
.pulse_container {width:150px;float:left; text-align: center; margin: 10px; padding:10px; background-color: #f8f8f8; font-family: Verdana; font-size:12px; 
     -moz-border-radius: 10px; /* FF1+ */
  -webkit-border-radius: 10px; /* Saf3-4 */
          border-radius: 10px; /* Opera 10.5, IE 9, Saf5, Chrome */

}
.pulse_positive {background-color: #73b68b;}
.pulse_neutral {background-color: #e1e0a8;}
.pulse_negative {background-color: #e68d8d;}
.pulse_container td {font-size: 9px; text-align: center;}
</style>
<h1>Twitter Pulse</h1>

<title>Twitter Pulse</title>

<p><strong>Legend:</strong> <span class="pulse_positive">&nbsp;&middot;&nbsp;</span> Positive  <span class="pulse_neutral">&nbsp;&middot;&nbsp;</span> Neutral  <span class="pulse_negative">&nbsp;&middot;&nbsp;</span> Negative </p>

<p>Search (Seperate terms with commas): 
	<form action="index.php" method="get">
		<input type="text" name="terms" size="60">
		<input type="submit" value="Go">
	</form>	
</p>

<?php 

function getratings($term) {
	$json = file_get_contents('http://data.tweetsentiments.com:8080/api/search.json?topic='.urlencode($term));
	$data = json_decode($json);

	echo "<div class='pulse_container'>";
		echo "<strong>".$term."</strong> (".$data->sentiment_index."%)<br>";
		echo "<table width='100%' cellpadding='5' cellspacing='0'><tr>";
			echo "<td width='".$data->positive."%' class='pulse_positive'>".$data->positive."</td>";
			echo "<td width='".$data->neutral."%' class='pulse_neutral'>".$data->neutral."</td>";
			echo "<td width='".$data->negative."%' class='pulse_negative'>".$data->negative."</td>";
		echo "</tr></table>";
	echo "</div>";
}

$terms = $_GET['terms'];

if ($terms == "" ) {
	$search_terms = "Kasich, Haslam, Boehner, Portman, Obamacare, Tax Cuts"; }
else {
	$search_terms = $terms;
}

$arr_terms = explode(",",$search_terms);
foreach($arr_terms as $v){
  getratings($v);
}


?>

