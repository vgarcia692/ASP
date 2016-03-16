<div class="content">
    <div class="row">
        <div class="col-md-5 col-md-offset-3 panel-default">
        <h3><label class="label label-info"><?php if(isset($_SESSION['addMessage'])) {echo $_SESSION['addMessage'];} ?></label></h3>
        <label class="errorlabel"><?php echo validation_errors(); ?></label>
        <legend><?php echo 'Add New '.ucfirst($type); ?></legend>
        <?php echo form_open('settings/proccessAdd/'.$type); ?>
            <input type="hidden" id="type" name="type" value="<?php echo $type; ?>">

            <div class="form-group">
                <label for="name"><?php echo ucfirst($type); ?> Name/Title</label>
                <input class="form-control" type="text" id="name" name="name">
            </div>

            <?php if ($type=='student') { ?>
                <div class="form-group">
                    <label for="studNo">Student Number</label>
                    <input class="form-control" type="text" id="studNo" name="studNo" placeholder="LASTNAME, FIRSTNAME" />
                </div>
            <?php } ?>

            <input class="btn btn-default" type="submit" name="submit" id="submit" value="Add"/>
        </form>
        </div>
        
    </div>
</div>