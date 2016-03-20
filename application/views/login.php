<div class="container">
    <div class="col-sm-6 col-sm-offset-3">
        <h1 style="text-align:center;">Login</h1>
        <?php echo form_open('auth/login'); ?>
            <div style="text-align:center;">
                <?php echo img('assets/images/cmiSeal.png');?>
            </div>
            <h3><label class="label label-danger"><?php if(isset($_SESSION['loginMessage'])) echo $_SESSION['loginMessage']; ?></label></h3>

            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username"/>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password"/>
            </div>


            <button type="submit" class="btn btn-primary btn-lg">Login</button>
    
        </form>
    </div>
</div>
