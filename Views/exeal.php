<?php

    use Art\Core\DB;

    isset($_GET['search']) ? $search = $_GET['search'] : '';

    header( "Content-type: application/vnd.ms-excel; charset=utf-8");
    header( "Content-Disposition: attachment; filename = excel_test.xls" );     //filename = 저장되는 파일명을 설정합니다.
    header( "Content-Description: PHP4 Generated Data" );

    //엑셀 파일로 만들고자 하는 데이터의 테이블을 만듭니다.
    $EXCEL_FILE = "
    <table border='1'>
        <tr>
            <td>고유번호</td>
            <td>유저 아이디</td>
            <td>유저 이름</td>
            <td>유저 학번</td>
            <td>사진여부</td>
        </tr>
    ";
    if(isset($_GET['search'])) {
        $qry = "SELECT * FROM users WHERE ";
    } else {

    }



    $res = DB::fetch($qry);

    // DB 에 저장된 데이터를 테이블 형태로 저장합니다.
    while ($row = $res->fetch_object()) {
    $EXCEL_FILE .= "
        <tr>
            <td>".$row->name."</td>
            <td>".$row->gender."</td>
            <td>".$row->age."</td>
            <td>".$row->phone."</td>
            <td>".$row->file."</td>
        </tr>
    ";
    }

    $EXCEL_FILE .= "</table>";

    // 만든 테이블을 출력해줘야 만들어진 엑셀파일에 데이터가 나타납니다.
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
    echo $EXCEL_FILE;
?>