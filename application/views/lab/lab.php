<h1 style="text-align:center;"><?php echo $labInfo['name']; ?> Laboratory Check-in/Check-out</h1>
<br>
<div class="container">
<div class="row">
<h3><label class="label label-default"><?php if(isset($_SESSION['labLogMessage'])) { echo $_SESSION['labLogMessage']; }; ?></label></h3>
    <div class="panel panel-primary col-md-5">
    <label class="errorlabel"><?php echo validation_errors(); ?></label>
        <?php echo form_open('labs/addNewLog'); ?>
            <legend>Check In User:</legend>

            <input type="number" name="labId" hidden value="<?php echo $labInfo['id']; ?>" />
            <input type="text" name="labName" hidden value="<?php echo $labInfo['name']; ?>" />

            <div class="form-group">
                <label for="isNotStudent">Not a Student:</label>
                <input name="isNotStudent" type="checkbox" class="form-control" id="isNotStudent">
            </div>

            <div class="form-group student">
                <label for="stuId">Student ID:</label>
                <input type="text" name="studentId" class="form-control" id="studentId" placeholder="Input Student ID">
            </div>

            <div class="form-group nonStudent">
                <label for="user">User Type:</label>
                <select name="user" id="user" class="form-control">
                    <option>Visitor</option>
                    <option>Faculty</option>
                    <option>Staff</option>
                    <option>GED</option>
                </select>
            </div>

            <div class="form-group nonStudent">
                <label for="userName">User Name:</label>
                <input name="userName" type="text" class="form-control" id="userName" placeholder="Name">
            </div>


            <div class="form-group">
                <label for="purpose">Purpose:</label><br>
                <input type="text" class="form-control twitter-typeahead" name="purpose" id="purpose">
            </div>

            <div class="form-group">
                <label for="purposeDetail">Purpose Detail:</label>
                <textarea class="form-control" name="purposeDetail" id="purposeDetail"></textarea>
            </div>

            <div class="form-group">
                <label for="course">Course:</label>
                <select name="course" id="course" class="form-control">
                        <option value="">Select a Course</option>
                    <?php foreach ($courses as $value) { ?>
                        <option value="<?php echo $value['id']; ?>"><?php echo $value['course']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group" id="checkInEditInput" style="display: none;">
                <label for="checkInEdit">Check In:</label>
                <input class="form-control" type="datetime-local" id="checkInEdit" name="checkInEdit"></input>
            </div>

            <button class="btn btn-primary" id="checkIn">Check In</button>
            <button style="display: none;" type="button" class="btn btn-info" id="saveEdit">Save</button>
            <button style="display: none;" type="button" class="btn btn-danger" id="cancelEdit">Cancel</button>
        </form>
    </div>
    <div class="panel panel-info col-md-offset-1 col-md-6">
    <script type="text/javascript">
        var checkIns = <?php echo $jsonCheckIns; ?>;
        var tr;
        var userEditId = 0;

        $(document).ready(function () {
            for (var i = 0; i < checkIns.length; i++) {
                tr = $('<tr/>');
                tr.attr('id',checkIns[i].id);
                if (checkIns[i].name) {
                    tr.append("<td id='name-"+checkIns[i].id+"'>" + checkIns[i].name + "</td>");
                } else {
                    tr.append("<td id='name-"+checkIns[i].id+"'>" + checkIns[i].nonStudent + "</td>");
                }
                tr.append("<td id='checkin-"+checkIns[i].id+"'>" + checkIns[i].checkIn + "</td>");
                tr.append("<td>" + "<button class='btn btn-primary' onclick='checkout("+ checkIns[i].id +")'>Check Out</button>" + " <button class='btn btn-info' onclick='edit("+ checkIns[i].id +")'>Edit</button></td>");
                $('tbody').append(tr);
            };
        
        });

        function checkout(id) {
            var url = "<?php echo base_url('labs/checkout/'); ?>/" + id;
            
            $.ajax({
                url: url,
                success: function(result) {
                   $("#"+id).remove(); 
               },
               error: function(error) {
                    alert('could not checkout');
               }
            });
            
        };

        function edit(id) {
            $('#saveEdit').show();
            $('#cancelEdit').show();
            var url = "<?php echo base_url('labs/getLog/'); ?>/" + id;
            
            $.ajax({
                url: url,
                dataType: 'json',
                success: function(json) {
                    if (json.notStudent == true) {
                        $('#isNotStudent').prop('checked', true);
                        $('#stuId').val('');
                        $('.nonStudent').show('slide',400);
                        $('.student').hide('slide',400);
                        $('#user').val(json.userType);
                        $('#userName').val(json.name);
                    } else {
                        $('#isNotStudent').prop('checked', false);
                        $('#user').val('');
                        $('#userName').val('');
                        $('.nonStudent').hide('slide',400);
                        $('.student').show('slide',400);
                        $('#studentId').val(json.studNo);
                    }
                    $('#checkInEditInput').show('slide',400);
                    $('#checkInEdit').val(json.checkIn);
                    $('#purpose').val(json.purpose);
                    $('#purposeDetail').val(json.purposeDetail);
                    $('#course').val(json.courseId);
                    userEditId = json.id;
                },
                error: function(a,b,c) {
                    console.log(a);
                    console.log(b);
                    console.log(c);
                }
            });
        };

        $('#saveEdit').click(function() {
           if(userEditId!=0) {
                var url = "<?php echo base_url('labs/editLog'); ?>";
            
            $.ajax({
                url: url,
                type: 'POST',
                data: $('form').serialize() + '&userEditId=' + userEditId, 
                dataType: 'json',
                success: function(json) {
                    if(json!=false) {
                        $('#saveEdit').hide();
                        $('#cancelEdit').hide();
                        alert('Lab Log Successfully Edited.');
                        $('#isNotStudent').prop('checked', false);
                        $('#user').val('');
                        $('#userName').val('');
                        $('.nonStudent').hide('slide',400);
                        $('.student').show('slide',400);
                        $('#studentId').val('');
                        $('#purpose').val('');
                        $('#purposeDetail').val('');
                        $('#course').val('');
                        $('#checkInEdit').val('');
                        $('#checkInEditInput').hide('slide',400);
                        
                        var newName = '';
                        if(json.studNo=='') {
                            newName =  json.name+'-'+json.userType;
                        } else {
                            newName =  json.studentName;
                        }
                        
                        $('#name-'+userEditId).text(newName);
                        $('#checkin-'+userEditId).text(json.checkIn);


                    } else {
                        alert('Unable to Edit LabLog Please Check Form Inputs.');
                    }
                },
                error: function(a,b,c) {
                    console.log(a);
                    console.log(b);
                    console.log(c);
                }
            });
           }
        });

        $('#cancelEdit').click(function() { 
            $('#saveEdit').hide();
            $('#cancelEdit').hide();
            $('#isNotStudent').prop('checked', false);
            $('#user').val('');
            $('#userName').val('');
            $('.nonStudent').hide('slide',400);
            $('.student').show('slide',400);
            $('#studentId').val('');
            $('#purpose').val('');
            $('#purposeDetail').val('');
            $('#course').val('');
            $('#checkInEdit').val('');
            $('#checkInEditInput').hide('slide',400);
        });


    </script>
        <legend>Currently Checked In to <?php echo $labInfo['name']; ?>:</legend>
        <table id="checkedInTable" class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Check In</th>
                </tr>
            </thead>
            <tbody id='checkInTable'>

            </tbody>
        </table>        
    </div>
</div>
</div>
<!-- DATA FROM SERVER TO JS -->
<script type="text/javascript">
    var purposes = <?php echo json_encode($purposes); ?>;
</script>