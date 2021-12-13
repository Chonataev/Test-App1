<?php 
    $this->title = 'Update';

?>
<div class="container col-4 mt-5 pt-3">
    <form action="" method = "post">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>firstname</label>
                    <input  type="text" name="firstname" value = "<?php echo $user->firstname?>" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>lastname</label>
                    <input  type="text" name="lastname" value = "<?php echo $user->lastname?>" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>DOB</label>
            <input  type="text" name="DOB" class="form-control" value = "<?php echo $user->DOB?>">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label>gender</label>
            <input  type="text" name="gender" value = "<?php echo $user->gender?>" class="form-control">
            <div class="invalid-feedback"></div>
        </div>
        <button class="btn btn-primary d-block mt-4 col-12" type="submit">Update</button>
    </form>
</div>

        