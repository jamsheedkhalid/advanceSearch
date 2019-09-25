
<!doctype html>
<head>
    <title>Advance Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-7">
            <div class="md-form">
                <input type="text" id="search"  onkeyup="showStudents(this.value,option)" class="form-control">
                <small id="searchHelp" class="form-text text-muted"><b>Enter family ID, student ID, student name, parent name, contact number  </b></small>
                <label for="search">Search Student/Parent</label>
            </div>

                <label for="all" class="radio-inline" style="font-size: 14px"><input type="radio" name="optradio" id="all" onclick="option = 1; searchOption(option);" checked> All  </label>
                <label for="st_id" class="radio-inline" style="padding-left: 5px; font-size: 14px"><input type="radio" name="optradio" id="st_id" onclick="option = 2;searchOption(option)">Student ID  </label>
                <label for="fm_id" class="radio-inline" style="padding-left: 5px; font-size: 14px"><input type="radio" name="optradio" id="fm_id" onclick="option = 3;searchOption(option)"> Family ID  </label>
                <label for="st_name" class="radio-inline" style="padding-left: 5px; font-size: 14px"><input type="radio" name="optradio" id="st_name" onclick="option = 4;searchOption(option)"> Student Name </label>
                <label for="fm_name" class="radio-inline" style="padding-left: 5px; font-size: 14px"><input type="radio" name="optradio" id="fm_name" onclick="option = 5;searchOption(option)"> Family Details </label>
                <label for="number" class="radio-inline " style="padding-left: 5px; font-size: 14px"><input type="radio" name="optradio" id="number" onclick="option = 6;searchOption(option)"> Contact Number</label>



        </div>
        <div class="col-sm">
        </div>
    </div>
    <div class="row">
        <div class="col">

        </div>
        <div class="col-10">
            <div id='tableStudents' style="padding-top: 20px;">

            </div>
        </div>
        <div class="col">
        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>

            </div>
            <div class="modal-body">...</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>




<script>

    // popovers Initialization
    $(function () {
        $('[data-toggle="popover"]').popover()
    });

    option = 1;
    function searchOption(option){
        showStudents(document.getElementById('search').value,option)
    }
    function showStudents(str,option) {
        var xhttp;
        if (str == "") {
            document.getElementById("tableStudents").innerHTML = "<table style='height:300px; width:100%' class=table-bordered><tr><td style='padding:50px'> <div class='alert alert-danger' role='alert'><strong>No students found!</strong> Please search again.</div></td></tr></table>";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tableStudents").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "showStudents.php?q=" + str + "&option=" + option, true);
        xhttp.send();
    }
</script>

</body>



