<?php

use helper\Web;
Web::register_script('asset/js/crypt.js');
/**
 * @var form/LoginForm $form
 */
?>
    <div class="col-3">        
        <form class="form" method="post" action="?site/login" name="<?=$form->getName();?>">
            <?=$form->name();?>
            <?=$form->hidden('_token',$form->_token);?>
            <?=$form->hidden('hash_password',$form->_hash_password);?>
            <div class="form-group">
                <?=$form->text('email',$form->email);?>
            </div>
            <div class="form-group">            
                <?=$form->password('password');?>
            </div>
            <div class="form-group">            
                <div class="form-check">
                    <label class="form-check-label">
                    <?=$form->checkbox('remember',['value'=>'remember']);?>
                    Remember Me
                    </label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right" onClick="return hash('#<?=$form->getControlId('password');?>','#<?=$form->getControlId('hash_password');?>')">Login</button>
            </div>
        </form>
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