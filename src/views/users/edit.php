<?php 
    use app\core\form\Form;
    $form = new Form;
    $this->title = 'Update';
?>
<div class="container">
    <?php $form = Form::begin('',"post");?>
        <div class="row">
            <div class="col">        
                <?php echo $form->field($model,'firstname')?>
            </div>
            <div class="col">
                <?php echo $form->field($model,'lastname')?>
            </div>
        </div>
        <?php echo $form->field($model,'DOB')?>
        <?php echo $form->field($model,'gender')?>
        <button class="btn btn-primary d-block mt-4" type="submit">Update</button>
    <?php Form::end();?>
<p class="mt-5 mb-3 text-muted">© 2021</p>
</div>