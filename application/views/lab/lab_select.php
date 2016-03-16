<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <h3><label class="label label-info"><?php if (isset($_SESSION['signUpMessage'])) { echo $_SESSION['signUpMessage']; } ?></label></h3>
        <p><?php echo validation_errors(); ?></p>
            <?php echo form_open('labs/processLabSelect'); ?>
                <legend>Select a Lab</legend>

                <div class="form-group">
                    <label for="lab">Lab</label>
                    <select id="lab" name="lab">
                        <?php foreach ($labs as $value) { ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>                

                <button type="submit" name="submit" class="btn btn-primary">Select</button>
            </form>
        </div>
    </div>
</div>