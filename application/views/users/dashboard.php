<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-3">
                <a href="<?php echo base_url('labs/labSelect') ?>"><img class="dashboardIcon" src="<?php echo base_url('assets/images/black.svg'); ?>"></a>
                <h3 class="dashboardText">Log In Users</h3>
            </div>
            <div class="col-md-3">
                <a href="<?php echo base_url('upload/uploadForm'); ?>"><img class="dashboardIcon" src="<?php echo base_url('assets/images/interface.svg'); ?>"></a>
                <h3 class="dashboardText">Upload</h3>
            </div>
            <?php if ($_SESSION['userType']=='admin') { ?>
                <div class="col-md-3">
                    <a href="<?php echo base_url('settings/settingsSelect'); ?>"><img class="dashboardIcon" src="<?php echo base_url('assets/images/editing.svg'); ?>"></a>
                    <h3 class="dashboardText">Lab Settings</h3>
                </div>
            <?php } ?>
            <?php if ($_SESSION['userType']=='admin') { ?>
                <div class="col-md-3">
                    <a href="<?php echo base_url('auth/signup'); ?>"><img class="dashboardIcon" src="<?php echo base_url('assets/images/settings-gears.svg'); ?>"></a>
                    <h3 class="dashboardText">Register New User</h3>
                </div>
            <?php } ?>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-3">
                <a href="<?php echo base_url('logs/logLabs') ?>"><img class="dashboardIcon" src="<?php echo base_url('assets/images/crowd-of-users.svg'); ?>"></a>
                <h3 class="dashboardText">Review Logs</h3>
            </div>
            <?php if ($_SESSION['userType']=='admin') { ?>
                <div class="col-md-3">
                    <a href="<?php echo base_url('reports/totalVisits'); ?>"><img class="dashboardIcon" src="<?php echo base_url('assets/images/check.svg'); ?>"></a>
                    <h3 class="dashboardText">Reports</h3>
                </div>
            <?php } ?>
        </div>
        
    </div>
</div>