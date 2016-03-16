<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 well">
        <legend>Upload Requirements</legend>
        <p>In order to upload logs into the system you must make sure the file meets all requirements:</p>
        <ol>
            <li>File is a CSV File Windows(CSV)/MAC(WINDOWS COMMA SEPERATED)</li>
            <li>If fields are included as the first row it must be in exact order:</li>
            <ol>
                <li>checkIn</li>
                <li>checkOut</li>
                <li>userType</li>
                <li>name</li>
                <li>purposeDetail</li>
                <li>StudentId</li>
                <li>Course</li>
                <li>Purpose</li>
                <li>LabId</li>
            </ol>
            <li>If the fields are included you must checkoff the "CSV Includes Fields?"</li>
            <li>For StudentId,Course,Purpose,LabId: They must match exactly as what is used in the system.</li>
        </ol>
        <p>You may use the this form as a template on how to use a properly formatted csv file for upload(right click->save as). <a href="<?php echo base_url('assets/images/lab_logs_template.csv'); ?>">Template</a></p>

        <?php echo validation_errors(); ?>
            <?php echo form_open_multipart('upload/processUpload') ?>
            <h3><label class="label label-info"><?php if (isset($_SESSION['uploadMessage'])) {
                echo $_SESSION['uploadMessage'];
            } ?></label></h3>
                <legend>Upload Logs</legend>
                
                <div class="form-group">
                    <label for="userfile">CSV File</label>
                    <input type="file" class="form-control" name="userfile"></input>
                </div>

                <div class="form-group">
                    <label for="includesFields">CSV Includes Fields?</label>
                    <input type="checkbox" class="form-control" name="includesFields" value="1"></input>
                </div>  
            
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>