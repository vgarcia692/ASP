<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <h4 class="errorlabel"><?php if (isset($_SESSION['deleteMessage'])) {echo $_SESSION['deleteMessage'];} ?></h4>
        <h4 class="errorlabel"><?php if (isset($_SESSION['labEditMessage'])) {echo $_SESSION['labEditMessage'];} ?></h4>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Lab</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Non-Student User Type</th>
                        <th>Non-Student Name</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   <?php $i = $page + 1; ?>
                    <?php foreach ($logs as $value) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $value['labName']; ?></td>
                            <td><?php echo $value['studNo']; ?></td>
                            <td><?php echo $value['studentName']; ?></td>
                            <td><?php echo $value['userType']; ?></td>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo date_format(date_create($value['checkIn']), 'M d, Y H:i'); ?></td>
                            <td>
                                <?php if(isset($value['checkOut']) && $value['checkOut']!=='0000-00-00 00:00:00') {
                                    echo date_format(date_create($value['checkOut']), 'M d, Y H:i');
                                } else {
                                    echo "";
                                } ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" onclick="edit('<?php echo $value['id']; ?>','<?php echo $page; ?>')">Edit</button>
                                <button id="btnDelete<?php echo $value['id']; ?>" type="button" class="btn btn-danger" dataId="<?php echo $value['id']; ?>">Delete</button>
                                    <script type="text/javascript">
                                        $('#btnDelete<?php echo $value['id']; ?>').click(function() {
                                            var id = $(this).attr('dataId');
                                            var lab = '<?php echo $lab; ?>'
                                            var url = "<?php echo base_url('logs/proccessDeleteLog/'); ?>"+"/"+id+"/"+lab;
                                            var deletConfirm = confirm("Are you sure you want to delete this Log?");
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
            <!-- Pagination Links -->
            <?php print_r($pagnation_links); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    function edit(logId,page) {
        console.log(page);
        var url = "<?php echo base_url('logs/editLog').'/'; ?>";
        window.location= url+logId+'/'+page;
    }
</script>