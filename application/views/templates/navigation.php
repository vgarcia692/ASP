<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><span><img src="<?php echo base_url("assets/images/cmiSeal.png")?>" width="35px" height="35" style="margin-right:10px;padding-bottom:5;">CMI ASP</span></a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <?php if(isset($_SESSION['userType'])) { ?>
                <li><a href="<?php echo base_url('auth/logout'); ?>">Logout</a><li>
                <li><a href="<?php echo base_url('user/dashboard'); ?>">Dashboard</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>