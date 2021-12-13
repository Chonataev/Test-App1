<?php 
    use app\core\form\Form;
    $form = new Form;
?>
<?php $form = Form::begin('',"post");?>
<div class="container col-4">
    <div class="row">
        <div class="col">
            <?php echo $form->field($model,'firstname')?>
        </div>
        <div class="col">
            <?php echo $form->field($model,'lastname')?>
        </div>
    </div>
    <?php echo $form->field($model,'email')?>
    <?php echo $form->field($model,'password')->passwordField()?>
    <?php echo $form->field($model,'passwordConfirm')->passwordField()?>
    <?php echo $form->field($model,'DOB')?>
    <?php echo $form->field($model,'gender')?>
    <button class="btn btn-success col-12">Submit</button>
</div>
<?php Form::end();?>