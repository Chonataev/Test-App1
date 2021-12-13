<?php $this->title = '403';?>
<div class="text-center mt-5">
    <h4>
        Sorry, this page isn't available.
    </h4>
    <p><?php echo $exception->getCode() ?> - 
        <?php echo $exception->getMessage() ?>
        <a href="/">Go back to HomePage.</a></p>
    
</div>