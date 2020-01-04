    <?
	include('evalmath.class.php');
	$m = new EvalMath;
	$m->suppress_errors = true;
	
	if ($m->evaluate('y(sm) = (sm*0.2)')) {
			print $m->e("y(10)");
	} else {
		print "\t<p>Could not evaluate function: " . $m->last_error . "</p>\n";
	}
?>