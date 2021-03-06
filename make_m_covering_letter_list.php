<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once('./global.php');

//POSTデータを取得
$a_PageNo = $_POST['PageNo'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //①件数を取得する。
    $a_sql = "SELECT COUNT(entry_no) AS total_num FROM ".$GLOBALS['g_DB_m_covering_letter']." ORDER BY entry_no;";
    $a_stmt = $a_conn->prepare($a_sql);
    //$a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
    $a_stmt->execute();
    $a_result = $a_stmt->fetch(PDO::FETCH_ASSOC);
    $a_total_num = $a_result['total_num'];
    
    $a_start_idx = (($a_PageNo-1)*$GLOBALS['g_MAX_LINE_PAGE']) + 1;
    $a_end_idx = ($a_PageNo*$GLOBALS['g_MAX_LINE_PAGE']);

    //②ページ対象のSELECT
    $a_conn->exec("SET @rownum=0");
    $a_sql = "SELECT t2.* FROM (";
    $a_sql .= " SELECT  t1.*, @rownum:=@rownum+1 AS ROW_NUM FROM";
    $a_sql .= " (SELECT * FROM ".$GLOBALS['g_DB_m_covering_letter']." ORDER BY entry_no) t1";
    $a_sql .= ") t2 WHERE (t2.ROW_NUM BETWEEN ".$a_start_idx." AND ".$a_end_idx.");";
    #$a_sql = "SELECT * FROM ".$GLOBALS['g_DB_m_covering_letter']." ORDER BY entry_no;";
    #echo $a_sql;
    $a_stmt = $a_conn->prepare($a_sql);
    //$a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
    $a_stmt->execute();

    $a_rec = 0;

    $a_sRet = "<table class='tbl_list' style='width: 100%'>";
    //$a_sRet = "<table class='tbl_list' width='98%'>";

    //ヘッダ部
    $a_sRet .= "    <tr class='tr_title'>";
    
    //固定列部分
    $a_sRet .= "        <td style='width: 200px; padding:0 0;'>";
    $a_sRet .= "            <table class='tbl_list' width='100%'>";
    $a_sRet .= "                <tr class='tr_title2'>";
    $a_sRet .= "                    <td class='td_title2' style='width: 100px;' nowrap>個人</td>";
    $a_sRet .= "                    <td class='td_title2' style='width: 100px;' nowrap>氏名</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "            </table>";
    $a_sRet .= "        </td>";
    
    //可変部分
    $a_sRet .= "        <td style='width: 440px; padding:0 0'>";
    $a_sRet .= "            <div id='right_title' style='overflow:hidden; width: 700px; padding:0 0'>";
    $a_sRet .= "                <table class='tbl_list' style='width: 1200px;'>";
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>生年月日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 300px;' nowrap>メール</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>電話番号</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>携帯電話</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>郵便番号</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 300px;' nowrap>住所</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>最寄駅</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>退職日</td>";
    $a_sRet .= "                    </tr>";
    $a_sRet .= "                </table>";
    $a_sRet .= "            </div>";
    $a_sRet .= "        </td>";
    $a_sRet .= "    </tr>";
    $a_sRet .= "    <tr>";

    $a_sRet_L = "       <td valign='top'>";
    $a_sRet_L .= "           <div id='leftColumn' style='overflow:hidden;height:300px;'>";
    $a_sRet_L .= "               <table class='tbl_list' style='padding: 0 0;'>";
    
    $a_sRet_R = "       <td valign='top'>";
    $a_sRet_R .= "          <div id='right_record' style='overflow:scroll;width:700px;height:450px;' onscroll='document.all.right_title.scrollLeft=this.scrollLeft;document.all.leftColumn.scrollTop=this.scrollTop;'>";
    $a_sRet_R .= "              <table class='tbl_list' style='width: 1200px'>";

/**/
    //while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
    while($a_result = $a_stmt->fetch(PDO::FETCH_NUM)){
        $a_rec++;

        if (($a_rec % 2)==0){
            $a_sRet_L .= "<tr class='linee' style='background-color: #fffff0;'>";
            $a_sRet_R .= "<tr class='linee' style='background-color: #fffff0;'>";
        }else{
            $a_sRet_L .= "<tr class='lineo'>";
            $a_sRet_R .= "<tr class='lineo'>";
        }

        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>";
        $a_sRet_L .= $a_result[0];
        #$a_sRet_L .= "<a href='#' onclick='choice_covering_letter_method(\"".$a_result[0]."\");'>".$a_result[0]."</a>";
        $a_sRet_L .= "</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result[1]."</td>";
        $a_sRet_L .= "</tr>";

        for ($a_idx = 0; $a_idx < 10; $a_idx++) {
            if (($a_idx != 0) && ($a_idx != 1)) {
                switch ($a_idx) {
                    case 3:
                          $a_width = "300";
                    case 7:
                          $a_width = "300";
                      break;
                    default:
                          $a_width = "100";
                        break;
                }
                //tableのwidth：(116*100)+(20*6)+(80*3)+(120)+(60)+(40)+(180*2)
                //11600+120+240+220+360
                //128540
                $a_sRet_R .= "<td class='td_line2' style='width: ".$a_width."px;'><div class='myover'>".$a_result[$a_idx]."</td>";
            }
        }
        $a_sRet_R .= "</tr>";
    }
    
    $a_sRet_L .= "               </table>";
    $a_sRet_L .= "           </div>";
    $a_sRet_L .= "       </td>";
    
    $a_sRet_R .= "               </table>";
    $a_sRet_R .= "           </div>";
    $a_sRet_R .= "       </td>";

    if ($a_rec > 0){
        $a_sRet .= $a_sRet_L.$a_sRet_R;
        $a_sRet .= "    </tr>";
        $a_sRet .= "</table>";
        $a_sRet = "<div id='my-recnum'>". com_make_pager("make_m_covering_letter_list", $a_total_num, $a_PageNo, $GLOBALS['g_MAX_LINE_PAGE'])."</div>".$a_sRet;
    }else{
        $a_sRet = "登録データはありません。";
    }
/**/
} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
}
$a_conn = null;

echo $a_sRet;

?>
