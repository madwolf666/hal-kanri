/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    
    //条件検索
    $('#f_date_entering_10200').datepicker({});
    $('#f_date_retire_10200').datepicker({});
    //$('#f_payment_settlement_paymentday_10200').datepicker({});
    $('#f_date_modify_salary_10200').datepicker({});
    $('#f_date_first_salary_10200').datepicker({});
    $('#f_labor_contact_date_10200').datepicker({});
    //[2018.01.30]課題解決管理表No.87
    $('#f_date_entering_10200_del').datepicker({});
    $('#f_date_retire_10200_del').datepicker({});
    //$('#f_payment_settlement_paymentday_10200_del').datepicker({});
    $('#f_date_modify_salary_10200_del').datepicker({});
    $('#f_date_first_salary_10200_del').datepicker({});
    $('#f_labor_contact_date_10200_del').datepicker({});
});

function make_payroll_list(h_pageNo)
{
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "make_payroll_list.php",
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
            resize_div2('leftColumn', 'right_title', 'right_record', 460, 184); 
       }
   });
}

//Excelへ給与台帳出力
function excel_out_10200(){
    location.href = m_parentURL + "excel_out_10200.php";
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
            url: m_parentURL + "update_value_10202.php",
            type: 'POST',
            dataType: "html",
            async: true,
            data:{
                'cr_id': h_cr_id,
                'pr_id': h_sub_id,
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

//給与台帳機能選択⇒[2017.07.20]課題解決表No.72
function choice_payroll_method(h_no, h_sub_no)
{
    //alert(h_no);
    /**/
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');
    
    $.ajax({
        url: m_parentURL + "choice_payroll_method.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'cr_id': h_no,
            'pr_id': h_sub_no
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
