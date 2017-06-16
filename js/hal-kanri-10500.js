/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    $('#person_birthday').datepicker({});
    $('#contact_date_org').datepicker({});
    $('#publication').datepicker({});
});

function make_agreement_ledger_list(h_pageNo)
{
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "make_agreement_ledger_list.php",
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
            resize_div2('leftColumn', 'right_title', 'right_record', 410, 184); 
       }
   });
}

//契約書機能選択
function choice_agreement_ledger_method(h_no)
{
    //alert(h_no);
    /**/
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');
    
    $.ajax({
        url: m_parentURL + "choice_agreement_ledger_method.php",
        type: 'POST',
        dataType: "html",
        async: true,
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

//労働契約書
function regist_agreement_10502(h_act, h_no)
{
    var a_idx = "";
    var a_sKind = "";
    if (h_act == 'n'){
        a_sKind = '登録';
    }else{
        a_sKind = '更新';
    }

    if (check_IsRequired('#po_no', '労働契約書Noが入力されていません！') == false) return;

    if (!confirm("労働契約書を" + a_sKind + "します。よろしいですか？")) return;

    m_ProgressMsg('処理中です...<br><img src="./images/upload.gif" /> ');
    //alert($('#inp_engineer_no').val());
    $.ajax({
        url: m_parentURL + "regist_agreement_10502.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'act': h_act,
            'no': h_no,
            'ag_no': $('#ag_no').val(),
            'person_birthday': $('#person_birthday').val(),
            'person_post_no': $('#person_post_no').val(),
            'person_address': $('#person_address').val(),
            'publication': $('#publication').val(),
        },
        success: function(data, dataType){
            if (data == 'OK'){
                alert(a_sKind + "しました。");
                //$.unblockUI();
                //document.location.href = "./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>";
                location.href = "./index.php?mnu=10500";
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

//労働契約書（再発行）
function regist_agreement_10503(h_act, h_no)
{
    var a_idx = "";
    var a_sKind = "";
    if (h_act == 'n'){
        a_sKind = '登録';
    }else{
        a_sKind = '更新';
    }

    if (check_IsRequired('#po_no', '労働契約書Noが入力されていません！') == false) return;

    if (!confirm("労働契約書（再発行）を" + a_sKind + "します。よろしいですか？")) return;
    /*
    alert('ag_no:', $('#ag_no').val());
    alert('person_birthday:', $('#person_birthday').val());
    alert('person_post_no:', $('#person_post_no').val());
    alert('person_address:', $('#person_address').val());
    alert('contact_date_org:', $('#contact_date_org').val());
    alert('dd_office:', $('#dd_office').val());
    alert('organization:', $('#organization').val());
    alert('dd_address:', $('#dd_address').val());
    alert('dd_tel:', $('#dd_tel').val());
    alert('ip_position:', $('#ip_position').val());
    alert('ip_name:', $('#ip_name').val());
    alert('dm_responsible_position:', $('#dm_responsible_position').val());
    alert('dm_responsible_name:', $('#dm_responsible_name').val());
    alert('dd_responsible_position:', $('#dd_responsible_position').val());
    alert('dd_responsible_name:', $('#dd_responsible_name').val());
    alert('chs_position1:', $('#chs_position1').val());
    alert('chs_name1:', $('#chs_name1').val());
    alert('chs_position2:', $('#chs_position2').val());
    alert('chs_name2:', $('#chs_name2').val());
    alert('publication:', $('#publication').val());
    */
    m_ProgressMsg('処理中です...<br><img src="./images/upload.gif" /> ');
    //alert($('#inp_engineer_no').val());
    $.ajax({
        url: m_parentURL + "regist_agreement_10503.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'act': h_act,
            'no': h_no,
            'ag_no': $('#ag_no').val(),
            'person_birthday': $('#person_birthday').val(),
            'person_post_no': $('#person_post_no').val(),
            'person_address': $('#person_address').val(),
            'contact_date_org': $('#contact_date_org').val(),
            'dd_office': $('#dd_office').val(),
            'organization': $('#organization').val(),
            'dd_address': $('#dd_address').val(),
            'dd_tel': $('#dd_tel').val(),
            'ip_position': $('#ip_position').val(),
            'ip_name': $('#ip_name').val(),
            'dm_responsible_position': $('#dm_responsible_position').val(),
            'dm_responsible_name': $('#dm_responsible_name').val(),
            'dd_responsible_position': $('#dd_responsible_position').val(),
            'dd_responsible_name': $('#dd_responsible_name').val(),
            'chs_position1': $('#chs_position1').val(),
            'chs_name1': $('#chs_name1').val(),
            'chs_position2': $('#chs_position2').val(),
            'chs_name2': $('#chs_name2').val(),
            'publication': $('#publication').val(),
        },
        success: function(data, dataType){
            if (data == 'OK'){
                alert(a_sKind + "しました。");
                //$.unblockUI();
                //document.location.href = "./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>";
                location.href = "./index.php?mnu=10500";
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

//就業条件明示書
function regist_agreement_10504(h_act, h_no)
{
    var a_idx = "";
    var a_sKind = "";
    if (h_act == 'n'){
        a_sKind = '登録';
    }else{
        a_sKind = '更新';
    }

    //if (check_IsRequired('#po_no', '注文書Noが入力されていません！') == false) return;

    if (!confirm("就業条件明示書を" + a_sKind + "します。よろしいですか？")) return;
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
        url: m_parentURL + "regist_agreement_10504.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'act': h_act,
            'no': h_no,
            'dd_office': $('#dd_office').val(),
            'dd_address': $('#dd_address').val(),
            'dd_tel': $('#dd_tel').val(),
            'organization': $('organization').val(),
            'ip_position': $('#ip_position').val(),
            'ip_name': $('#ip_name').val(),
            'contact_date_org': $('#contact_date_org').val(),
            'dm_responsible_position': $('#dm_responsible_position').val(),
            'dm_responsible_name': $('#dm_responsible_name').val(),
            'dd_responsible_position': $('#dd_responsible_position').val(),
            'dd_responsible_name': $('#dd_responsible_name').val(),
            'chs_position1': $('#chs_position1').val(),
            'chs_name1': $('#chs_name1').val(),
            'chs_position2': $('#chs_position2').val(),
            'chs_name2': $('#chs_name2').val(),
        },
        success: function(data, dataType){
            if (data == 'OK'){
                alert(a_sKind + "しました。");
                //$.unblockUI();
                //document.location.href = "./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>";
                location.href = "./index.php?mnu=10500";
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

//Excelへ契約書台帳出力
function excel_out_10500(){
    location.href = m_parentURL + "excel_out_10500.php";
    return false;
}
//Excelへ労働契約書出力
function excel_out_10502(h_no){
    location.href = m_parentURL + "excel_out_10502.php?NO=" + h_no;
    return false;
}
//Excelへ労働契約書（再発行）出力
function excel_out_10503(h_no){
    location.href = m_parentURL + "excel_out_10503.php?NO=" + h_no;
    return false;
}
//Excelへ就業条件書出力
function excel_out_10504(h_no){
    location.href = m_parentURL + "excel_out_10504.php?NO=" + h_no;
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
            url: m_parentURL + "update_value_10502.php",
            type: 'POST',
            dataType: "html",
            async: true,
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
