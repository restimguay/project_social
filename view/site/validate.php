<?php

use helper\Web;
Web::register_script('asset/js/crypt.js');
Web::register_style('asset/css/account.css');
/**
 * @var form/LoginForm $form
 */
?>      
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <?=Web::render_styles();?>
  </head>
  <body>
        <!-- LOGIN FORM -->
        <div class="text-center shadow rounded" style="width:600px; padding:50px 0;margin:auto">
	<h1>Pending Email Validate</h1>
    <div><small class="text-muted">Enter email validation details below</small></div>	
    <!-- Main Form -->
	<div class="login-form-1">
		<form id="login-form" class="text-left" method="post"  action="<?=Web::url('site/login');?>">
                <?=$form->name();?>
                <?=$form->hidden('_token',$form->_token);?>
                <?=$form->hidden('hash_password',$form->_hash_password);?>
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="<?=$form->getName();?>_email" class="sr-only">Email</label>
                        <?=$form->text('email',$form->email,['placeholder'=>'email']);?>
					</div>
					<div class="form-group">
						<label for="<?=$form->getName();?>_password" class="sr-only">Password</label>
                        <?=$form->text('code',$form->password,['placeholder'=>'enter 6 alpha-numeric code']);?>
					</div>
				</div>
				<button type="submit" class="login-button" ><i class="fa fa-chevron-right"></i></button>
			</div>
			<div class="etc-login-form">
				<p>forgot your password? <a href="#">click here</a></p>
				<p>new user? <a href="<?=Web::url('site/register');?>">create new account</a></p>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
</div>
        <script>
            function hash(source,target){
                var pwd = $(source).val();
                var masked = '';
                for (var i = 0; i < pwd.length; i++) {
                    masked+='*';
                }
                $(source).val(masked);    
                var hash =  $.md5(pwd);
                $(target).val(hash);                
                return true;
            }
        </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <?=Web::render_scripts();?>
  </body>
</html>
        