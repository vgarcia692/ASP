<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <h4 class="errorlabel"><?php if (isset($_SESSION['error'])) {echo $_SESSION['error'];} ?></h4>
            <!-- <form action="" method="POST" class="form-inline" role="form">
                <div class="form-group">
                    <label for="lab">Lab</label>
                    <select id="lab" name="lab">
                        <?php foreach ($labs as $value) { ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>  

                <div class="form-group">
                    <label for="studentId">Student ID</label>
                    <input class="form-control" type="text" id="studentId" name="studentId">
                </div>

                <button type="submit" name="submitLogReviewCriteria" class="btn btn-primary">Submit</button>
            </form> -->
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
                            <td><button type="button" class="btn btn-primary" onclick="edit('<?php echo $value['id']; ?>')">Edit</button>
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
    function edit(logId) {
        var url = "<?php echo base_url('logs/editLog').'/'; ?>";
        window.location= url+logId;
    }
</script>