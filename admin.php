<?php
//PHP file to log in administrators
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'dbconnect.php';
//print_r($_SESSION);
if(sizeof($_POST) > 0)
{
	$check_email = $conn->query("SELECT Email FROM managers WHERE Email='{$_POST['email']}'");
    //print_r( $_POST);
	if ($check_email->num_rows > 0)
    {
		$pass = $conn->query("SELECT Password FROM managers WHERE Email='{$_POST['email']}'");
		$pass = $pass->fetch_assoc();
		$pass = $pass['password'];
		$pass1 = password_hash($_POST['password'], PASSWORD_DEFAULT);
		//$pass1 = $_POST['password'];
		//echo $pass; 
		//echo "|";
		//echo $pass1;
		if ($pass == $pass)
		{
			$_POST['log'] = "in";
			//session_start();
			//$_SESSION['userSession'] = "1";
		}
		if (isset($_POST['log']))
{
    header("Location: manager.php");
}
	}
    
	/* echo"<pre>";
	print_r($_POST);
	$x = 21;
	echo"Your age is: $x\n";
	echo $_POST['email']."\n";
	echo"</pre>";
	 
	$_POST['password'] = md5($_POST['password']);
	unset($_POST['password_confirmation']);
	
	file_put_contents('user.txt',json_encode($_POST)."\n",FILE_APPEND); */
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" media="screen" href="css/master.css" />
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style>
		/* Credit to bootsnipp.com for the css for the color graph */
		.colorgraph {
		  height: 5px;
		  border-top: 0;
		  background: #c4e17f;
		  border-radius: 5px;
		  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
		  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
		  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
		  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
		}
	</style>
</head>
<body>
<?php
include 'navbar.php';
?>
<div class="container">

<div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form" action="admin.php" method="POST">
			<fieldset>
				<h2>Manager Login</h2>
				<hr class="colorgraph">
				<div class="form-group">
                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address">
				</div>
				<div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
				</div>
				<span class="button-checkbox">
					<button type="button" class="btn" data-color="info">Remember Me</button>
                    <input type="checkbox" name="remember_me" id="remember_me" checked="checked" class="hidden">
					<a href="" class="btn btn-link pull-right">Forgot Password?</a>
				</span>
				<hr class="colorgraph">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<a href="register.php" class="btn btn-lg btn-primary btn-block">Register</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

</div>
<script>
$(function(){
    $('.button-checkbox').each(function(){
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                    on: {
                        icon: 'glyphicon glyphicon-check'
                    },
                    off: {
                        icon: 'glyphicon glyphicon-unchecked'
                    }
            };
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');
            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");
            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);
            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else
            {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }
        function init() {
            updateDisplay();
            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});
</script>
</body>
</html>