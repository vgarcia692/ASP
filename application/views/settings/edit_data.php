<div class="content">
    <div class="row">
        <div class="col-md-5 col-md-offset-3 panel-default">
        <h3><label class="label label-info"><?php if(isset($_SESSION['updateMessage'])) {echo $_SESSION['updateMessage'];} ?></label></h3>
        <label class="errorlabel"><?php echo validation_errors(); ?></label>
        <legend><?php echo ucfirst($type).' Edit'; ?></legend>
        <?php echo form_open('settings/proccessEdit/'.$type); ?>
            <input type="hidden" id="type" name="type" value="<?php echo $type; ?>">
            <input type="hidden" id="id" name="id" value="<?php echo $data['id']; ?>">

            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" id="name" name="name" value="<?php echo $data['name']; ?>">
            </div>

            <?php if ($type=='student') { ?>
                <div class="form-group">
                    <label for="studNo">Student Number</label>
                    <input class="form-control" type="text" id="studNo" name="studNo" value="<?php echo $data['studNo']; ?>"></input>
                </div>
            <?php } ?>

            <input class="btn btn-default" type="submit" name="submit" id="submit" value="Save"/>
        </form>
        </div>
        
    </div>
</div>