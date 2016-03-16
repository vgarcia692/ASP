<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 well">
        <?php echo validation_errors(); ?>
            <?php echo form_open('settomgs/processEdit') ?>
            <h3><label class="label label-info"><?php if (isset($_SESSION['labEditMessage'])) {
                echo $_SESSION['labEditMessage'];
            } ?></label></h3>
                <legend>Edit <?php echo ucfirst($type); ?></legend>
                <?php $i = 1; ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo ucfirst($type).'s'; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key => $value) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td>
                                    <?php if ($type == 'student') { ?>
                                        <a href="<?php echo base_url('settings/edit/'.$type.'/'.$value['id']);?>"><?php echo $value['name'].' - '.$value['studNo']; ?></a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url('settings/edit/'.$type.'/'.$value['id']);?>"><?php echo $value['name']; ?></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>    
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
