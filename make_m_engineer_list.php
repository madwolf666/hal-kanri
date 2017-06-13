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
    $a_sql = "SELECT COUNT(entry_no) AS total_num FROM ".$GLOBALS['g_DB_m_engineer']." ORDER BY entry_no;";
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
    $a_sql .= " (SELECT * FROM ".$GLOBALS['g_DB_m_engineer']." ORDER BY entry_no) t1";
    $a_sql .= ") t2 WHERE (t2.ROW_NUM BETWEEN ".$a_start_idx." AND ".$a_end_idx.");";
    #$a_sql = "SELECT * FROM ".$GLOBALS['g_DB_m_engineer']." ORDER BY entry_no;";
    $a_stmt = $a_conn->prepare($a_sql);
    //$a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
    $a_stmt->execute();

    $a_rec = 0;

    $a_sRet = "<table class='tbl_list' style='width: 100%'>";
    //$a_sRet = "<table class='tbl_list' width='98%'>";

    //ヘッダ部
    $a_sRet .= "    <tr class='tr_title'>";
    
    //固定列部分
    $a_sRet .= "        <td style='width: 400px; padding:0 0;'>";
    $a_sRet .= "            <table class='tbl_list' width='100%'>";
    $a_sRet .= "                <tr class='tr_title2'>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>登録NO</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 102px;' nowrap>登録日</td>";
    $a_sRet .= "                    <td colspan='2' class='td_title2' nowrap>氏名</td>";
    //$a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 86px;' nowrap>種別</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "                <tr class='tr_title2'>";
    $a_sRet .= "                    <td class='td_title2' style='width: 100px;' nowrap>姓</td>";
    $a_sRet .= "                    <td class='td_title2' style='width: 100px;' nowrap>名</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "            </table>";
    $a_sRet .= "        </td>";
    
    //可変部分
    $a_sRet .= "        <td style='width: 440px; padding:0 0'>";
    $a_sRet .= "            <div id='right_title' style='overflow:hidden; width: 700px; padding:0 0'>";
    $a_sRet .= "                <table class='tbl_list' style='width: 17000px;'>";
    #$a_sRet .= "                <table class='tbl_list' style='width: 12540px;'>";
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>面談日</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>面談担当者</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>ﾃﾞｰﾀ更新日</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>フリガナ</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>性別</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>生年月日</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>年齢</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>国籍</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>査証種類</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>査証期限</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>日本語力</td>";
    $a_sRet .= "                        <td colspan='8' class='td_title2' style='width: 100px;' nowrap>住所</td>";
    $a_sRet .= "                        <td colspan='4' class='td_title2' style='width: 100px;' nowrap>連絡先</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' style='width: 100px;' nowrap>学歴1</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' style='width: 100px;' nowrap>学歴2</td>";
    $a_sRet .= "                        <td colspan='4' class='td_title2' style='width: 100px;' nowrap>最寄駅1</td>";
    $a_sRet .= "                        <td colspan='4' class='td_title2' style='width: 100px;' nowrap>最寄駅2</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>家族</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>所属会社名</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>保有資格</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 200px;' nowrap>スキル区分</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 598px;' nowrap>OS</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 598px;' nowrap>言語</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 598px;' nowrap>DB</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 598px;' nowrap>ツール</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>フェイズ</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>業種</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>マネジメント</td>";
    $a_sRet .= "                        <td colspan='11' class='td_title2' style='width: 100px;' nowrap>本人希望</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>扶養人数</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>就業可能日</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 120px;' nowrap>面談可能時間帯</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>他社営業状況</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>応募</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>HALコメント</td>";
    $a_sRet .= "                        <td colspan='7' class='td_title2' style='width: 100px;' nowrap>評価</td>";
    $a_sRet .= "                        <td colspan='8' class='td_title2' style='width: 100px;' nowrap>提案文章</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>応募日付</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 120px;' nowrap>お礼メール発送</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>登録</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>選定</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>掘起し対象</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' style='width: 100px;' nowrap>アサイン</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>ｶﾚﾝﾀﾞ登録更新</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>最大乗換回数</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 120px;' nowrap>就業形態-優先1</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 180px;' nowrap>個人事業主時-月額金額</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 220px;' nowrap>個人事業主時-月額最低金額</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 160px;' nowrap>契約社員時-額面金額</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 180px;' nowrap>契約社員時-額面最低金額</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 140px;' nowrap>HAL最低提案金額</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 120px;' nowrap>希望業務、業種</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 280px;' nowrap>提案No,会社,言語,作業,フェーズ,案件等</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>希望案件内容</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>HALコメント</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>HALコメント</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>提案フラグ</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>更新日</td>";
    $a_sRet .= "                    </tr>";
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>姓</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>名</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>郵便番号</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>都道府県</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>市町村</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>住所詳細</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>電話番号</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>FAX番号</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>携帯1</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>携帯2</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 300px;' nowrap>e-mail1</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 300px;' nowrap>e-mail2</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 120px;' nowrap>緊急連絡先氏名</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 120px;' nowrap>緊急連絡先電話</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>学校名1</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>専攻</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>終了区分</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>学校名2</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>専攻</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>終了区分</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>路線</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>最寄駅</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>手段</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>分数</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>路線</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>最寄駅</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>手段</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>分数</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>婚姻区分</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>同居家族</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 200px;' nowrap>ｺﾝﾋﾟｭｰﾀ資格</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 200px;' nowrap>一般資格</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>役割</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>人数</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>希望案件</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>案件期間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>稼働率</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>最大通勤時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>希望勤務ｴﾘｱ</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>通勤拘り</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>その他希望</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>本人最低金額</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>本人希望金額</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>HAL提案金額</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>就業形態</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>他社登録件数</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>他社面談件数</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>応募媒体</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>応募媒体詳細</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>外観</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>会話</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>勤怠</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>人物総合</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>スキル</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>市場性</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>総合</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 300px;' nowrap>提案1行目</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 300px;' nowrap>提案2行目</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 300px;' nowrap>提案3行目</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 300px;' nowrap>提案4行目</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 300px;' nowrap>提案5行目</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 300px;' nowrap>提案6行目</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 300px;' nowrap>提案7行目</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 300px;' nowrap>提案8行目</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>コメント</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>コメント</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>コメント</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 180px;' nowrap>他社決定時の契約ｽﾀｰﾄ日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 280px;' nowrap>登録お断り日、他社決定時契約終了日</td>";
    $a_sRet .= "                    </tr>";
    $a_sRet .= "                </table>";
    $a_sRet .= "            </div>";
    $a_sRet .= "        </td>";
    $a_sRet .= "    </tr>";
    $a_sRet .= "    <tr>";

    $a_sRet_L = "       <td valign='top'>";
    $a_sRet_L .= "           <div id='leftColumn' style='overflow:hidden;height:433px;'>";
    $a_sRet_L .= "               <table class='tbl_list' style='padding: 0 0;'>";
    
    $a_sRet_R = "       <td valign='top'>";
    $a_sRet_R .= "          <div id='right_record' style='overflow:scroll;width:700px;height:450px;' onscroll='document.all.right_title.scrollLeft=this.scrollLeft;document.all.leftColumn.scrollTop=this.scrollTop;'>";
    $a_sRet_R .= "              <table class='tbl_list' style='width: 17000px'>";
    #$a_sRet_R .= "              <table class='tbl_list' style='width: 12540px'>";

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
        $a_sRet_L .= "<a href='#' onclick='choice_engineer_method(\"".$a_result[0]."\");'>".$a_result[0]."</a>";
        $a_sRet_L .= "</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result[1]."</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result[5]."</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result[6]."</td>";
        $a_sRet_L .= "</tr>";

        for ($a_idx = 0; $a_idx < 116; $a_idx++) {
            if (($a_idx != 0) && ($a_idx != 1) && ($a_idx != 5) && ($a_idx != 6)) {
                switch ($a_idx) {
                    case 24:
                    case 25:
                    case 82:
                    case 83:
                    case 84:
                    case 85:
                    case 86:
                    case 87:
                    case 88:
                    case 89:
                        $a_width = "300";
                        break;
                    case 45:
                    case 46:
                    case 47:
                        $a_width = "200";
                        break;
                    case 48:
                    case 49:
                    case 50:
                    case 51:
                        $a_width = "600";
                        break;
                    case 26:
                    case 27:
                    case 69:
                    case 91:
                    case 103:
                    case 109:
                        $a_width = "120";
                        break;
                    case 99:
                    case 104:
                    case 107:
                        $a_width = "180";
                        break;
                    case 105:
                        $a_width = "220";
                        break;
                    case 106:
                        $a_width = "160";
                        break;
                    case 108:
                        $a_width = "140";
                        break;
                    case 100:
                    case 110:
                          $a_width = "280";
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
        $a_sRet = "<div id='my-recnum'>". com_make_pager("make_m_engineer_list", $a_total_num, $a_PageNo, $GLOBALS['g_MAX_LINE_PAGE'])."</div>".$a_sRet;
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
