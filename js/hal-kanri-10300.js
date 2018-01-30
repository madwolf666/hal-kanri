/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    
    //条件検索
    $('#f_accounts_bai_previous_day_10300').datepicker({});
    $('#f_payment_acceptance_date_10300').datepicker({});
    //[2018.01.30]課題解決管理表No.87
    $('#f_accounts_bai_previous_day_10300_del').datepicker({});
    $('#f_payment_acceptance_date_10300_del').datepicker({});
});

function make_acceptance_ledger_list(h_pageNo)
{
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "make_acceptance_ledger_list.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'PageNo': h_pageNo
        },
        success: function(data, dataType){
            //make_pager(2,h_pageNo);
            $("#my-list").empty().append(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
            resize_div2('leftColumn', 'right_title', 'right_record', 310, 184); 
       }
   });
}

//検収台帳機能選択
function choice_acceptance_ledger_method(h_no, h_sub_no)
{
    //alert(h_no);
    /**/
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');
    
    $.ajax({
        url: m_parentURL + "choice_acceptance_ledger_method.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'cr_id': h_no,
            'al_id': h_sub_no
        },
        success: function(data, dataType){
            $("#my-method").empty().append(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
       }
    });
    /**/
    show_popup();
}

//Excelへ検収台帳出力
function excel_out_10300(){
    location.href = m_parentURL + "excel_out_10300.php";
    return false;
}

//Enterキー押下時の処理
function check_input_key_enter(h_key, h_cr_id, h_sub_id, h_field, h_id, h_kind)
{
    //alert(h_cr_id + "," + h_field + "," + h_id);

    if(h_key == 13){
        //alert("ENTERが押されました");
        //alert($("#i_" + h_field + h_id).val());
        var a_val = $("#i_" + h_field + h_id).val();
        
        //alert(h_cr_id + "," + h_kind + "," + h_field + "," + a_val);
        //DBに登録する
        // h_kind   1:文字、2:日付、3：時間
        $.ajax({
            url: m_parentURL + "update_value_10302.php",
            type: 'POST',
            dataType: "html",
            async: true,
            data:{
                'cr_id': h_cr_id,
                'al_id': h_sub_id,
                'kind': h_kind,
                'field': h_field,
                'val': a_val,
            },
            success: function(data, dataType){
                //alert(data);
                if (data == 'OK') {
                    g_input_completed = true;
                    //$(h_name).css("background-color","#ffffff");
                    //[2017.07.19]課題解決表No.70
                    calc_input_data(h_key, h_cr_id, h_sub_id, h_field, h_id, h_kind);
                } else if ((data == 'NG')) {
                    //$(h_name).css("background-color","#ffccff");
                }else{
                    alert(data);
                    //$("#my-result").empty().append(data);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown.message);
            },
           complete: function (data) {
                $("#" + h_field + h_id).empty().append(a_val);
                g_input_click = false;
                $.unblockUI();
           }
        });
        //g_input_click = false;

        //alert(g_input_completed);
    }else{
        //alert("ENTER以外が押されました");
    }    
}

//[2017.07.19]課題解決表No.70
function calc_input_data(h_key, h_cr_id, h_sub_id, h_field, h_id, h_kind)
{
    //alert('calc_input_data⇒' + h_field);
    var a_jisseki = 0;
    var a_keihi = 0;
    var a_zeinuki = 0;
    var a_zeikomi = 0;
    var a_click = null;
    var a_consumption_tax = 0;
    
    //消費税算出
    var a_date = $("#accounts_bai_previous_day" + h_id).text(); //売上日
    var a_time1 = Date.parse(a_date + " 00:00:00");
    var a_time2 = 0;
    var a_cnt = 0;
    if (a_date != ''){
        for (a_cnt = m_consumption_tax.length - 1; a_cnt >= 0; a_cnt--){
            a_time2 = Date.parse(m_consumption_tax[a_cnt][0] + " 00:00:00");
            if (a_time1 >= a_time2){
                a_consumption_tax = m_consumption_tax[a_cnt][1];
                a_consumption_tax += 1.00;
                break;
            }
        }
    }
    
    if ((h_field == 'accounts_actual_amount_money') || (h_field == 'accounts_expenses')){
        //実績時間もしくは諸経費を入力した場合
        if (h_field == 'accounts_actual_amount_money'){
            a_jisseki = $("#i_accounts_actual_amount_money" + h_id).val();
        }else{
            a_jisseki = $("#accounts_actual_amount_money" + h_id).text();
        }
        //alert(a_jisseki);
        if ((a_jisseki == '') || (isFinite(a_jisseki) == false)){
            a_jisseki = 0;
        }
        if (h_field == 'accounts_expenses'){
            a_keihi = $("#i_accounts_expenses" + h_id).val();
        //alert(a_keihi);
        }else{
            a_keihi = $("#accounts_expenses" + h_id).text();
        //alert(a_keihi);
        }
        //alert(a_keihi);
        if ((a_keihi == '') || (isFinite(a_keihi) == false)){
            a_keihi = 0;
        }
        a_zeinuki = parseInt(a_jisseki) + parseInt(a_keihi);
        //端数切り捨て
        a_zeikomi = Math.floor(parseInt(a_jisseki)*a_consumption_tax + parseInt(a_keihi));
        //alert(a_zeinuki);
        //alert(a_zeikomi);
        //alert(document.getElementById("accounts_tax_meter_noinclude" + h_id));
        //a_click = document.getElementById("accounts_tax_meter_noinclude" + h_id);
        //a_click.onclick = function(){alert('');};
        //a_click.click();
        $("#accounts_tax_meter_noinclude" + h_id).empty().append(a_zeinuki);
        $("#accounts_tax_meter_include" + h_id).empty().append(a_zeikomi);
        entry_calc_data(h_key, h_cr_id, h_sub_id, 'accounts_tax_meter_noinclude', h_id, h_kind, a_zeinuki);
        entry_calc_data(h_key, h_cr_id, h_sub_id, 'accounts_tax_meter_include', h_id, h_kind, a_zeikomi);
    }
    if ((h_field == 'payment_actual_amount_money') || (h_field == 'payment_commuting_expenses')){
        //実績時間もしくは交通費を入力した場合
        if (h_field == 'payment_actual_amount_money'){
            a_jisseki = $("#i_payment_actual_amount_money" + h_id).val();
        }else{
            a_jisseki = $("#payment_actual_amount_money" + h_id).text();
        }
        if ((a_jisseki == '') || (isFinite(a_jisseki) == false)){
            a_jisseki = 0;
        }
        if (h_field == 'payment_commuting_expenses'){
            a_keihi = $("#i_payment_commuting_expenses" + h_id).val();
        }else{
            a_keihi = $("#payment_commuting_expenses" + h_id).text();
        }
        if ((a_keihi == '') || (isFinite(a_keihi) == false)){
            a_keihi = 0;
        }
        a_zeinuki = parseInt(a_jisseki) + parseInt(a_keihi);
        //端数切り捨て
        a_zeikomi = Math.floor(parseInt(a_jisseki)*a_consumption_tax + parseInt(a_keihi));
        $("#payment_tax_meter_noinclude" + h_id).empty().append(a_zeinuki);
        $("#payment_tax_meter_include" + h_id).empty().append(a_zeikomi);
        entry_calc_data(h_key, h_cr_id, h_sub_id, 'payment_tax_meter_noinclude', h_id, h_kind, a_zeinuki);
        entry_calc_data(h_key, h_cr_id, h_sub_id, 'payment_tax_meter_include', h_id, h_kind, a_zeikomi);
    }
}

//[2017.07.19]課題解決表No.70
function entry_calc_data(h_key, h_cr_id, h_sub_id, h_field, h_id, h_kind, h_val)
{
    //alert(h_cr_id + "," + h_kind + "," + h_field + "," + a_val);
    //DBに登録する
    // h_kind   1:文字、2:日付、3：時間
    $.ajax({
        url: m_parentURL + "update_value_10302.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'cr_id': h_cr_id,
            'al_id': h_sub_id,
            'kind': h_kind,
            'field': h_field,
            'val': h_val,
        },
        success: function(data, dataType){
            //alert(data);
            if (data == 'OK') {
                //$(h_name).css("background-color","#ffffff");
            } else if ((data == 'NG')) {
                //$(h_name).css("background-color","#ffccff");
            }else{
                alert(data);
                //$("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
       }
    });
}

//Excelへ請求書帳出力
function excel_out_10301(h_cname, h_date){
    //alert(h_cname + "," + h_date);
    location.href = m_parentURL + "excel_out_10301.php?CN=" + h_cname + "&DT=" + h_date;
    return false;
}

