<!DOCTYPE html>
<html>
<?php
	$score = 0;
	$score = $score + $_GET["q1"];
	$score = $score + $_GET["q2"];
	$score = $score + $_GET["q3"];
	$score = $score + $_GET["q4"];
	$score = $score + $_GET["q5"];
	
	if ($score == 8) {
		echo "You got Roy Lee. Not sure how, but yeah. You're Roy Lee.";
	} else if ($score < 8) {
		echo "You will live long enough to see yourself become a Brown.";
	} else {
		echo "You will die a Kramer.";
	}
?>
</html>