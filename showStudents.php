
<?php
include('config/db.php');
$search = $_GET['q'];
$option = $_GET['option'];

if ($option != 5){
$sql= "SELECT DISTINCT  id, last_name en_name, first_name ar_name, "
        . "admission_no, familyid FROM students WHERE ";
if($option == 1) {
        $sql = $sql .  "admission_no LIKE '$search%' "
        . "OR familyid LIKE '$search%' "
        . "OR first_name LIKE N'$search%' OR middle_name LIKE N'%$search%' "
        . "OR last_name LIKE N'$search%' OR phone1 LIKE N'$search%' OR phone2 LIKE N'$search%' "
        . " ORDER BY en_name, ar_name , admission_no ASC ";
            }
else if($option == 2) {
    $sql = $sql .  "admission_no LIKE '$search%' 
                    ORDER BY admission_no ASC ";
}
else if($option == 3) {
    $sql = $sql .  "familyid LIKE '$search%' 
                    ORDER BY familyid ASC ";
        }
else if($option == 4) {
    $sql = $sql .  "first_name LIKE N'$search%' OR middle_name LIKE N'%$search%' "
        . " OR last_name LIKE N'$search%' "
        . " ORDER BY en_name, ar_name ASC ";
}

if($option == 6) {
    $sql = $sql .  "phone1 LIKE N'$search%' OR phone2 LIKE N'$search%' "
        . " ORDER BY en_name, ar_name , admission_no ASC ";
}
//echo $sql;
$ExecQuery = MySQLi_query($conn, $sql);
if ($ExecQuery->num_rows > 0) {
    $si =0;
     echo " <table class='table table-bordered ' style='text-align:center'> <thead class=thead-dark ><tr>
                                            <th>SI No. <br> رقم</th>
                                            <th>Name </th>
                                            <th style='font-size:20px'>اسم</th>
                                            <th>Admission Number <br> رقم القبول</th>
                                            <th>Family ID <br> رقم العائلة</th>
                                            <th>Action <br> عمل</th>
                                        </tr>
                                    </thead>";
     while ($row = $ExecQuery->fetch_assoc()) {
         echo"<tr><td>".++$si."</td>".
                 "<td style='text-align:left'>".$row['en_name']."</td>".
                 "<td style='text-align:right'>".$row['ar_name']."</td>".
                 "<td>".$row['admission_no']."<br>". engtoarabic($row['admission_no'])."</td>".
                 "<td>".$row['familyid']."<br>". engtoarabic($row['familyid'])."</td>"
                 ."<td><a class='btn btn-sm btn-primary' href='https://alsanawbar.school/student/profile/".$row['id']."'>View Profile</a></td></tr>";
     }
     
     echo "</table>";
}
else echo "<table style='height:300px; width:100%' class=table-bordered><tr><td style='padding:50px'> <div class='alert alert-danger' role='alert'><strong>No students found!</strong> Please search again.</div></td></tr></table>";

}
else if ($option == 5) {
    $sql = "SELECT id, first_name,  familyid, mobile_phone, CONCAT(office_phone1,' ',office_phone2) office "
        . " FROM guardians WHERE first_name LIKE '$search%' OR user_id LIKE '$search%' OR mobile_phone LIKE '$search%'"
        . " OR office_phone1 LIKE '$search%' OR office_phone2 LIKE '$search%' ORDER BY first_name ASC ";
//    echo $sql;

    $ExecQuery = MySQLi_query($conn, $sql);
    if ($ExecQuery->num_rows > 0) {
        $si = 0;
        echo " <table class='table table-bordered ' style='text-align:center'> <thead class=thead-dark ><tr>
                                            <th>SI No. <br> رقم</th>
                                            <th>Name </th>
                                            <th>Family ID <br> رقم العائلة</th>
                                            <th>Mobile Number <br> رقم الهاتف </th>
                                            <th>Office Number <br> رقم المكتب </th>
                                            <th>Student <br> عمل</th>
                                        </tr>
                                    </thead>";
        while ($row = $ExecQuery->fetch_assoc()) {
            $sql2 = "SELECT id, admission_no FROM students WHERE familyid = '$row[familyid]'";
            $ExecQuery2 = MySQLi_query($conn, $sql2);

            echo "<tr><td>" . ++$si . "</td>" .
                "<td style='text-align:left'>" . $row['first_name'] . "</td>" .
                "<td>" . $row['familyid'] . "<br>" . engtoarabic($row['familyid']) . "</td>" .
                "<td>" . $row['mobile_phone'] . "<br>" . engtoarabic($row['mobile_phone']) . "</td>" .
                "<td>" . $row['office'] . "<br>" . engtoarabic($row['office']) . "</td><td>";
            if ($ExecQuery2->num_rows > 0) {
                while ($row2 = $ExecQuery2->fetch_assoc()) {
                    echo "<a href='https://alsanawbar.school/student/profile/".$row2['id']."'>". $row2['admission_no']."</a>" . "<br>";
                }
             "</td></tr>";
            }
            else echo " No Students</td></tr>";
        }
        echo "</table>";




    }
    else echo "<table style='height:300px; width:100%' class=table-bordered><tr><td style='padding:50px'> <div class='alert alert-danger' role='alert'><strong>No students found!</strong> Please search again.</div></td></tr></table>";

}




function engtoarabic($str){
  $western_arabic = array('0','1','2','3','4','5','6','7','8','9');
$eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');

$str = str_replace($western_arabic, $eastern_arabic, $str);
return $str;
}

