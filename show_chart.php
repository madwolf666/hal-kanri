<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

$a_bak = $_GET['BAK'];
$a_cr_id = $_GET['NO'];
$a_chart_rows = "";

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //一覧出力は何順？
    $a_sql = "SELECT";
    $a_sql .= "
 t1.engineer_name
,t1.redemption_ratio
,t2.accounts_sales_will_amount
,t2.payment_acceptance_date
,t2.payment_schedule_amount
        ";
    $a_sql .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
    $a_sql .= " LEFT JOIN ";
    $a_sql .= $GLOBALS['g_DB_t_acceptance_ledger']." t2";
    $a_sql .= " ON (t1.cr_id=t2.cr_id)";
    $a_sql .= " WHERE (t1.cr_id=:cr_id)";
    $a_sql .= " ORDER BY t2.payment_acceptance_date;";

    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->bindParam(':cr_id', $a_cr_id, PDO::PARAM_STR);
    $a_stmt->execute();
    
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $engineer_name = $a_result['engineer_name'];
        $redemption_ratio = $a_result['redemption_ratio'];
        $accounts_sales_will_amount = $a_result['accounts_sales_will_amount'];
        $payment_acceptance_date = com_replace_toDate($a_result['payment_acceptance_date']);
        $payment_schedule_amount = $a_result['payment_schedule_amount'];
        /*echo $engineer_name.'<br>';
        echo $redemption_ratio.'<br>';
        echo $accounts_sales_will_amount.'<br>';
        echo $payment_acceptance_date.'<br>';
        echo $payment_schedule_amount.'<br>';*/

        if ($payment_acceptance_date != ''){
            $a_date = explode("/", $payment_acceptance_date);
            
            if ($accounts_sales_will_amount == ''){
                $accounts_sales_will_amount = 0;
            }
            if ($payment_schedule_amount == ''){
                $payment_schedule_amount = 0;
            }
            if ($redemption_ratio == ''){
                $redemption_ratio = 0;
            }
            if ($a_chart_rows != ''){
                $a_chart_rows .= ",";
            }
            $a_chart_rows .= "[new Date(".$a_date[0].",".$a_date[1].",".$a_date[2].",0,0,0),".$accounts_sales_will_amount.",".$payment_schedule_amount.",".$redemption_ratio."]";
        }
        
    }
} catch (PDOException $e){
    echo 'Error:'.$e->getMessage();
    //die();
}

?>

<link rel="stylesheet" href="./css/hal-kanri-common.css">

<section>
    
<h2>グラフ表示</h2>

<center>
<div id="chart_div" style="width: auto; height: 480px;"></div>
</center>

<p class="c">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $a_bak; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script type="text/javascript">
//google.load("visualization", "1", {packages:["linechart"]});
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);

function drawChart() {
    var dataTable= new google.visualization.DataTable();
    dataTable.addColumn('date','日付');
    dataTable.addColumn('number','売上予定金額');
    dataTable.addColumn('number','支払予定金額');
    dataTable.addColumn('number','還元率');

    dataTable.addRows([
        <?php echo $a_chart_rows; ?>
    ]);              
    var options = {
        title: '<?php echo $engineer_name; ?>',
        focusTarget: 'category',
        series: {
            0: {targetAxisIndex:0},
            1: {targetAxisIndex:0},
            2: {targetAxisIndex:1, lineDashStyle: [4, 4]},
        },
        vAxes: [
            {
                title: "円"
            },
            {
                title: "%"
            }
        ]
    };
    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(dataTable, options);
}
</script> 
