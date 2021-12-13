<?php 
    use app\core\form\Form;
    $form = new Form;
?>
<div class="col-4 m-auto pt-5">
    <?php $form = Form::begin('',"post");?>
    <?php echo $form->field($model,'email')?>
    <?php echo $form->field($model,'password')->passwordField()?>
    <button class="btn btn-success col-12">Submit</button>
    <?php Form::end();?>
    <p class="mt-5 mb-3 text-muted">© 2021</p>
</div>