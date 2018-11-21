<?php

/**
 * @var form/BaseForm[] $forms
 * @var form/BaseForm $form
 **/
    use form\BaseForm;
?>

    <?php foreach($forms as $form):?>
    <?php
        /**
        * @var form/BaseForm $form
         */
    ?>
        <div class="row">
            <div class="col-5 rounded bg-light border border-info">
                <form action="?profile/details&section=address" method="post" id="<?=$form->getName();?>">
                <?=$form->name();?>
                <?=$form->hidden('_token',$form->_token);?>
                <?=$form->hidden('detail_id',$form->detail_id);?>
                <div class="form-group">
                <label for="">Address:</label><i id="edit" class="fas fa-edit float-right" onclick="toggleEdit(this);"></i>
                <?=$form->textarea('description',$form->description,['readonly'=>'readonly','class'=>'form-control-plaintext editor','data-toogle_edit'=>'on']); ?>
                </div>
                <div class="form-group invisible">
                <label for="">Visibility</label>
                <?=$form->select('view_level',$form->visibility,[
                    0=>['value'=>'1','label'=>'Only Me'],
                    1=>['value'=>'2','label'=>'Friends'],
                    2=>['value'=>'3','label'=>'World'],
                ]);?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-danger invisible">Submit</button>
                </div>
                </form>
            </div>
        </div>
    <?php endforeach;?>
<script>
function toggleEdit(element){
    $(".editor").removeClass("form-control-plaintext").addClass('form-control');   
    $(".editor").removeAttr('readonly');
    $(".invisible").removeClass('invisible').addClass('visible');
}

</script>