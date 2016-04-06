<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 well">
        <?php echo validation_errors(); ?>
            <form>
            <h3><label class="label label-info"><?php if (isset($_SESSION['ReportMessage'])) {
                echo $_SESSION['ReportMessage'];
            } ?></label></h3>
                <legend>Total Number of Visits</legend>
                
                <h2 id="visitHeading" style="display: none;">Total Visits: <label class="label label-success" id="visitNumber">0</label></h2>

                <div class="form-group">
                    <label for="lab">Lab</label>
                    <select class="form-control" id="lab" name="lab">
                        <?php foreach ($labs as $value) { ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                        <?php } ?>
                    </select>
                </div> 
            
                <div class="form-group">
                    <label for="startingDate">Starting Date Range</label>
                    <input type="date" class="form-control" id="startingDate" name="startingDate" placeholder="mm/dd/yyyy" />
                </div>

                <div class="form-group">
                    <label for="endingDate">Ending Date Range</label>
                    <input type="date" class="form-control" id="endingDate" name="endingDate" placeholder="mm/dd/yyyy" />
                </div>

                <button id="submitBtn" type="button" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#submitBtn').click(function() {
        var url = "<?php echo base_url('reports/processVisitRange'); ?>"
        
        $.ajax({
            url: url,
            data: $('form').serialize(),
            type: 'POST',
            dataType: 'json',
            success: function(json) {
                if (json!=false) {
                    $('#visitHeading').show();
                    $('#visitNumber').text(json);
                } else {
                    alert('Unable to get the total visits please check your inputs.');
                }
            },
            error: function(a,b,c) {
                console.log(a);
                console.log(b);
                console.log(c);
            }
        });
    });
</script>