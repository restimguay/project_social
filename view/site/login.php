<?php

use helper\Web;
Web::register_script('asset/js/crypt.js');
Web::register_style('asset/css/account.css');
/**
 * @var form/LoginForm $form
 */
?>     
        <!-- LOGIN FORM -->
    <div class="text-center shadow rounded col-sm-5 col-md-7 col-lg-5 p-5" style="margin:auto">
        <h3>Welcome back to <?=Web::app()->name;?></h3>
        <div><small class="text-muted">Login to access your account</small></div>	
        <!-- Main Form -->
        <div>
            <img src="asset/img/blank-profile.png" class="img-rounded" alt="Cinque Terre" width="100px">
        </div>
        <div class="row">
            <form id="<?=$form->getName();?>" style="margin:auto;position:relative" class="text-left" method="post"  action="<?=Web::url('site/login');?>">
                <?=$form->name();?>
                <?=$form->hidden('_token',$form->_token);?>
                <?=$form->hidden('hash_password',$form->_hash_password);?>
                <div class="form-group">
                    <?=$form->text('email',$form->email,['placeholder'=>'email','class'=>'shadow-sm']);?>
                </div>
                <div class="form-group">
                    <?=$form->password('password',$form->password,['placeholder'=>'password','class'=>'shadow-sm']);?>
                </div>
                <div class="form-group">
                    <?=$form->checkbox('remember',['value'=>'remember']);?>
                    <label for="<?=$form->getName();?>_remember">Remember</label>
                    <div><small>Check this only on a non-public device</small></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success rounded-0 shadow-sm"  onClick="return hash('#<?=$form->getControlId('password');?>','#<?=$form->getControlId('hash_password');?>')">Login</button>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
        <div class="col-sm-5 col-md-7 col-lg-5 p-2" style="margin:auto">
            <div class="border-top pt-2">
               <div> <a href="<?=Web::url('site/resetpassword');?>" class="">Reset Password</a></div>
               <div>  <a href="<?=Web::url('site/register');?>" class="">Create New Account</a></div>
               <div>  <a href="<?=Web::url('site/validate');?>" class="">Validate Email</a></div>
            </div>
        </div>
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
        