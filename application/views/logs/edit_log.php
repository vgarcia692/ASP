<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 well">
        <?php echo validation_errors(); ?>
            <?php echo form_open('logs/processEdit') ?>
            <h3><label class="label label-info"><?php if (isset($_SESSION['labEditMessage'])) {
                echo $_SESSION['labEditMessage'];
            } ?></label></h3>
                <legend>Edit Log</legend>
                <input type="number" name="id" hidden value="<?php echo $log['id']; ?>"></input>
                
                <div class="form-group">
                    <label for="lab">Lab</label>
                    <select class="form-control" id="lab" name="lab">
                        <?php foreach ($labs as $value) { ?>
                            <option <?php if($log['labName']==$value['name']) {echo "selected";;} ?> value="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></option>
                        <?php } ?>
                    </select>
                </div> 
            
                <div class="form-group">
                    <label for="studNo">Student Number</label>
                    <input type="text" class="form-control" id="studNo" name="studNo" value="<?php echo $log['studNo']; ?>">
                </div>

                <div class="form-group">
                    <label for="studentName">Student Name</label>
                    <input disabled type="text" class="form-control" id="studentName" name="studentName" value="<?php echo $log['studentName']; ?>">
                </div>

                <div class="form-group">
                    <label for="userType">Non-Student User Type:</label>
                    <select name="userType" id="userType" class="form-control">
                        <option <?php if($log['userType']=='Vistor'){echo "selected";}?>>Visitor</option>
                        <option <?php if($log['userType']=='Faculty'){echo "selected";}?>>Faculty</option>
                        <option <?php if($log['userType']=='Staff'){echo "selected";}?>>Staff</option>
                        <option <?php if($log['userType']=='GED'){echo "selected";}?>>GED</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Non-Student Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $log['name']; ?>">
                </div>

                <div class="form-group">
                    <label for="courseId">CourseId:</label>
                    <select name="courseId" id="courseId" class="form-control">
                            <option value="">Select a Course</option>
                        <?php foreach ($courses as $value) { ?>
                            <option <?php if($log['course']==$value['course']) {echo "selected";;} ?> value="<?php echo $value['id']; ?>"><?php echo $value['course']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="purpose">Purpose:</label><br>
                    <input type="text" class="form-control twitter-typeahead" name="purpose" id="purpose" value="<?php echo $log['purpose']; ?>">
                </div>

                <div class="form-group">
                    <label for="purposeDetail">Purpose Detail:</label>
                    <textarea type="text" class="form-control" id="purposeDetail" name="purposeDetail"><?php echo $log['purposeDetail']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="checkIn">Check In</label>
                    <input type="datetime-local" class="form-control" id="checkIn" step="60" name="checkIn" value="<?php echo $log['checkIn']?>">
                </div>

                <div class="form-group">
                    <label for="checkOut">Check Out</label>
                    <input type="datetime-local" class="form-control" id="checkOut" step="60" name="checkOut" value="<?php echo $log['checkOut']; ?>">
                </div>
            
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    // function cancel() {
    //     console.log('<?php echo base_url('logs/allLogs'); ?>');
    // }
</script>
<script type="text/javascript">
    var purposes = <?php echo json_encode($purposes); ?>;
</script>