<?php

use helper\Web;

Web::register_script('jquery.validate.min.js');
Web::register_script('asset/js/crypt.js');
Web::register_style('asset/css/account.css');
/**
 * @var form/LoginForm $form
 */
?>      
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
						<label for="<?=$form->getName();?>_code" class="sr-only">Validation Code</label>
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
        