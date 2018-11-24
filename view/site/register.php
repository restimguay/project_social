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
	<h1>Welcome to <?=Web::app()->name;?></h1>
    <div><small class="text-muted">Provide your basic details below including your desired password</small></div>	
    <!-- Main Form -->
	<div class="login-form-1">
		<form id="login-form" class="text-left" method="post"  action="<?=Web::url('site/register');?>">
                <?=$form->name();?>
                <?=$form->hidden('_token',$form->_token);?>
                <?=$form->hidden('hash_password',$form->_hash_password);?>
                <?=$form->hidden('hash_password1',$form->_hash_password);?>
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="<?=$form->getName();?>_email" class="sr-only">Email</label>
                        <?=$form->text('email',$form->email,['placeholder'=>'email']);?>
					</div>
					<div class="form-group">
						<label for="<?=$form->getName();?>first_name" class="sr-only">First Name</label>
                        <?=$form->text('first_name',$form->password,['placeholder'=>'first name']);?>
					</div>
					<div class="form-group">
						<label for="<?=$form->getName();?>surname" class="sr-only">Surname</label>
                        <?=$form->text('surname',$form->password,['placeholder'=>'surname']);?>
					</div>
					<div class="form-group">
						<label for="<?=$form->getName();?>password1" class="sr-only">Password</label>
                        <?=$form->password('password1',$form->password,['placeholder'=>'password']);?>
					</div>
					<div class="form-group">
						<label for="<?=$form->getName();?>password2" class="sr-only">Password</label>
                        <?=$form->password('password2',$form->password,['placeholder'=>'re-enter password']);?>
					</div>
				</div>
				<button type="submit" class="login-button"  onClick="return hash('#<?=$form->getControlId('password1');?>','#<?=$form->getControlId('hash_password');?>') && hash('#<?=$form->getControlId('password2');?>','#<?=$form->getControlId('hash_password1');?>')"><i class="fa fa-chevron-right"></i></button>
			</div>
			<div class="etc-login-form">
				<p>already have account? <a href="<?=Web::url('site/login');?>">login</a></p>
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
        