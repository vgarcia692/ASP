<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <h3><label class="label label-info"><?php if (isset($_SESSION['signUpMessage'])) { echo $_SESSION['signUpMessage']; } ?></label></h3>
        <p><?php echo validation_errors(); ?></p>
            <?php echo form_open('auth/processSignup'); ?>
                <legend>Sign Up a New User</legend>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" type="text" class="form-control" id="username" placeholder="Enter Username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter Password">
                </div>

                <div class="form-group">
                    <label for="passConfirm">Password Confirm</label>
                    <input name="passwordConfirm" type="password" class="form-control" id="passConfirm" placeholder="Enter Password Confirmation">
                </div>

                

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>