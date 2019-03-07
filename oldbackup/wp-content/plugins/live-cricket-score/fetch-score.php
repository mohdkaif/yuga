<?php

include "lib/simple_html_dom.php";

$html = file_get_html('http://synd.cricbuzz.com/j2me/1.0/livematches.xml');

if($html) {

	echo "<div id='cricket-score-container'>";

	foreach($html->find("match") as $match) {

		echo  "<div class='match_head'>".$match->attr["mchdesc"]."</div>";

		echo "<div class='match_body'>";

		echo $batting= (isset($match->find("btTm",0)->attr['sname']))?$match->find("btTm",0)->attr['sname']:'';

		if(isset($match->find("Inngs ",0)->attr["r"])){

			echo "<div id='cricket-score-score'>";

			echo $match->find("Inngs ",0)->attr["r"]."/";

			echo $match->find("Inngs ",0)->attr["wkts"]."<br>";

			echo "</div>";

			echo "Overs: ".$match->find("Inngs ",0)->attr["ovrs"]."<br>";


		}

		echo $match->find("state ",0)->attr["status"]."<br>";

		echo "</div>";

		$match = "";
	} //foreach

	echo "</div>";

}
else{

	//there is an issue

}



?>