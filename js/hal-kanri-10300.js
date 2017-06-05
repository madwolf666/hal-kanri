/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    
    //条件検索
    $('#f_accounts_bai_previous_day_10300').datepicker({});
    $('#f_payment_acceptance_date_10300').datepicker({});
});

function make_acceptance_ledger_list(h_pageNo)
{
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "make_acceptance_ledger_list.php",
        type: 'POST',
        dataType: "html",
        async: false,
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
        async: false,
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
            async: false,
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
                $("#" + h_field + h_id).empty().append(a_val);
                g_input_click = false;
                $.unblockUI();
           }
        });

        //g_input_click = false;
    }else{
        //alert("ENTER以外が押されました");
    }    
}
