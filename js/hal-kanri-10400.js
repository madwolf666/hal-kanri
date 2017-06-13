/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    $('#publication').datepicker({});
});

function make_purchase_order_ledger_list(h_pageNo)
{
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "make_purchase_order_ledger_list.php",
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
            resize_div2('leftColumn', 'right_title', 'right_record', 450, 220); 
       }
   });
}

//注文書機能選択
function choice_purchase_order_ledger_method(h_no)
{
    //alert(h_no);
    /**/
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');
    
    $.ajax({
        url: m_parentURL + "choice_purchase_order_ledger_method.php",
        type: 'POST',
        dataType: "html",
        async: false,
        data:{
            'cr_id': h_no
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

//注文書
function regist_purchase_order_10402(h_act, h_no)
{
    var a_idx = "";
    var a_sKind = "";
    if (h_act == 'n'){
        a_sKind = '登録';
    }else{
        a_sKind = '更新';
    }

    if (check_IsRequired('#po_no', '注文書Noが入力されていません！') == false) return;
    if (check_IsRequired('#publication', '発行日が入力されていません！') == false) return;

    if (!confirm("注文書を" + a_sKind + "します。よろしいですか？")) return;
    /*
    alert(h_act);
    alert(h_no);
    alert($('#po_no').val());
    alert($('#publication').val());
    alert($('#remarks1').val());
    alert($('#remarks2').val());
    alert($('#remarks3').val());
    alert($('#remarks4').val());
    */
    m_ProgressMsg('処理中です...<br><img src="./images/upload.gif" /> ');
    //alert($('#inp_engineer_no').val());
    $.ajax({
        url: m_parentURL + "regist_purchase_order_10402.php",
        type: 'POST',
        dataType: "html",
        async: false,
        data:{
            'act': h_act,
            'no': h_no,
            'po_no': $('#po_no').val(),
            'publication': $('#publication').val(),
            'remarks1': $('#remarks1').val(),
            'remarks2': $('#remarks2').val(),
            'remarks3': $('#remarks3').val(),
            'remarks4': $('#remarks4').val(),
        },
        success: function(data, dataType){
            if (data == 'OK'){
                alert(a_sKind + "しました。");
                //$.unblockUI();
                //document.location.href = "./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>";
                location.href = "./index.php?mnu=10400";
            }else{
                $("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
       }
   });

}

//注文請書
function regist_purchase_order_10403(h_act, h_no)
{
    var a_idx = "";
    var a_sKind = "";
    if (h_act == 'n'){
        a_sKind = '登録';
    }else{
        a_sKind = '更新';
    }

    if (check_IsRequired('#po_no', '注文書Noが入力されていません！') == false) return;
    if (check_IsRequired('#publication', '発行日が入力されていません！') == false) return;

    if (!confirm("注文書請書を" + a_sKind + "します。よろしいですか？")) return;
    /*
    alert(h_act);
    alert(h_no);
    alert($('#po_no').val());
    alert($('#publication').val());
    alert($('#remarks1').val());
    alert($('#remarks2').val());
    alert($('#remarks3').val());
    alert($('#remarks4').val());
    */
    m_ProgressMsg('処理中です...<br><img src="./images/upload.gif" /> ');
    //alert($('#inp_engineer_no').val());
    $.ajax({
        url: m_parentURL + "regist_purchase_order_10403.php",
        type: 'POST',
        dataType: "html",
        async: false,
        data:{
            'act': h_act,
            'no': h_no,
            'po_no': $('#po_no').val(),
            'publication': $('#publication').val(),
            'remarks1': $('#remarks1').val(),
            'remarks2': $('#remarks2').val(),
            'remarks3': $('#remarks3').val(),
            'remarks4': $('#remarks4').val(),
        },
        success: function(data, dataType){
            if (data == 'OK'){
                alert(a_sKind + "しました。");
                //$.unblockUI();
                //document.location.href = "./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>";
                location.href = "./index.php?mnu=10400";
            }else{
                $("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
       }
   });

}

//Excelへ注文書台帳出力
function excel_out_10400(){
    location.href = m_parentURL + "excel_out_10400.php";
    return false;
}

//Excelへ注文書出力
function excel_out_10402(h_no){
    location.href = m_parentURL + "excel_out_10402.php?NO=" + h_no;
    return false;
}

//Excelへ注文請書出力
function excel_out_10403(h_no){
    location.href = m_parentURL + "excel_out_10403.php?NO=" + h_no;
    return false;
}

//Enterキー押下時の処理
function check_input_key_enter(h_key, h_cr_id, h_field, h_id, h_kind)
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
            url: m_parentURL + "update_value_10402.php",
            type: 'POST',
            dataType: "html",
            async: false,
            data:{
                'cr_id': h_cr_id,
                'kind': h_kind,
                'field': h_field,
                'val': a_val,
            },
            success: function(data, dataType){
                //alert(data);
                if (data == 'OK') {
                    g_input_completed = true;
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
