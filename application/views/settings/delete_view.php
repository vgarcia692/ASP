<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 well">
        <?php echo validation_errors(); ?>
            <?php echo form_open('settomgs/processEdit') ?>
            <h3><label class="label label-info"><?php if (isset($_SESSION['deleteMessage'])) {
                echo $_SESSION['deleteMessage'];
            } ?></label></h3>
                <legend style="color: red;">Delete <?php echo ucfirst($type); ?></legend>
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
                                        <?php echo $value['name'].' - '.$value['studNo']; ?>
                                    <?php } else { ?>
                                        <?php echo $value['name']; ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <button id="btnDelete<?php echo $value['id']; ?>" type="button" class="btn btn-danger" dataId="<?php echo $value['id']; ?>" dataType="<?php echo $type; ?>">Delete</button>
                                    <script type="text/javascript">
                                        $('#btnDelete<?php echo $value['id']; ?>').click(function() {
                                            var id = $(this).attr('dataId');
                                            var type = $(this).attr('dataType');
                                            var url = "<?php echo base_url('settings/proccessDelete/'); ?>"+"/"+type+"/"+id;
                                            var deletConfirm = confirm("Are you sure you want to delete this "+type+" ?");
                                            if (deletConfirm) {
                                                window.location = url;
                                            } else {
                                                return;
                                            }
                                        });
                                    </script>
                                </td>
                            </tr>
                        <?php } ?>    
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

