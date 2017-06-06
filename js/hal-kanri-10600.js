/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function make_dispatching_management_ledger_list(h_pageNo)
{
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "make_dispatching_management_ledger_list.php",
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

//Excelへ派遣元台帳出力
function excel_out_10600(){
    location.href = m_parentURL + "excel_out_10600.php";
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
            url: m_parentURL + "update_value_10602.php",
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
