<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>
<head>
    <title>Example use of EvalMath</title>
</head>

<body>
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
       y(sm) = <input type="text" name="function" value="<?=(isset($_POST['function']) ? htmlspecialchars($_POST['function']) : '')?>">
        <input type="submit">
    </form>
    <?
if (isset($_POST['function']) and $_POST['function']) {
	include('evalmath.class.php');
	$m = new EvalMath;
	$m->suppress_errors = true;
	
	if ($m->evaluate('y(sm) = (sm*0.2)')) {
			print $m->e("y(10)");
	} else {
		print "\t<p>Could not evaluate function: " . $m->last_error . "</p>\n";
	}
}
?>
</body>
</html>
