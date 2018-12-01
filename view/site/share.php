<?php

use helper\Web;

/**
 * @var form/BaseForm $form
 */
Web::register_style('asset/css/dropzone.css');
Web::register_script('asset/js/dropzone.js');
Web::register_script('asset/js/share_dropzone.js');
?>
<form action="?site/share" method="post" class="dropzone">
    <?=$form->name();?>
    <?=$form->hidden('_token',$form->_token);?>
    <div class="row">
        <div class="col-2">        
            <img src="asset/img/blank-profile.png" alt="blank-profile" class="img-fluid" style="margin:auto">
        </div>
        <div class="col-10 border rounded">
            <?=$form->textarea('message',$form->message,['placeholder'=>'what\'s on your mind?','class'=>'font-weight-light border-0 no-glow']);?>
            <div id="dropzone"></div>           
        </div>
    </div>
</form>