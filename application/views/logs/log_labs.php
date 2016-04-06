<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <h4 class="errorlabel"><?php if (isset($_SESSION['error'])) {echo $_SESSION['error'];} ?></h4>
        </div>

        <div class="col-md-10 col-md-offset-1">
        <legend>Select a Lab:</legend>
            <ul>
                <?php foreach ($labs as $lab) { ?>
                    <li><a href="<?php echo base_url('logs/allLogs').'/'.$lab['id']; ?>"><?php echo $lab['name']; ?></a></li>
                <?php } ?>  
            </ul>
        </div>
    </div>
</div>