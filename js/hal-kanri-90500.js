/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//請求・支払計算結果一覧
function make_charge_calc_list(h_pageNo){
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "make_charge_calc_list.php",
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
            resize_div2('leftColumn', 'right_title', 'right_record', 300, 184); 
       }
   });
}

//Excelファイルアップロード
function upload_time_table_file()
{
    var a_file = $('input[name="excel_file"]').val();
    
    if (a_file == '') {
        alert('ファイルが選択されていません！');
        return false;
    }

    m_ProgressMsg('アップロード中です......<br><img src="./images/upload.gif" /> ');

    //$('#my-executing').css('display', 'block'); 
    //$('#my-executing').show(); 
        
    var a_fd = new FormData();
    a_fd.append('file', $('input[name="excel_file"]').prop('files')[0]);
    a_fd.append('consumption_tax', m_consumption_tax);   //[2017.12.01]消費税率
    //a_fd.append("dir", $('#excel_file').val());
    //return true;
    
    $.ajax({
        url: m_parentURL + "upload_time_table_file.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data: a_fd,
        processData : false,
        contentType : false,
        success: function(data, dataType){
            //alert(data);
            //if (data.match(/Error:/)){
                $("#my-result").empty().append(data);
            //}
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //$("#my-result").empty().append(errorThrown.message);
            //alert(errorThrown.message);
        },
       complete: function (data) {
            //$('#my-executing').css('display', 'none');
            //$('#my-executing').hide();
            $.unblockUI();
       }
   });

}

//送付状機能選択
function choice_charge_calc_method(h_no)
{
    /**/
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');
    
    $.ajax({
        url: m_parentURL + "choice_charge_calc_method.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'cc_id': h_no
        },
        success: function(data, dataType){
            $("#my-charge-calc").empty().append(data);
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

function unregist_charge_calc(h_no, h_eno, h_sd, h_ed)
{
    //alert(h_no + "," + h_eno + "," + h_sd + "," + h_ed);
    var a_idx = "";
    a_sKind = '削除';

    if (!confirm("現在行を" + a_sKind + "します。よろしいですか？")) return;
    m_ProgressMsg('処理中です...<br><img src="./images/upload.gif" /> ');
    //alert($('#inp_engineer_no').val());
    $.ajax({
        url: m_parentURL + "unregist_charge_calc.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'no': h_no,
            'eno': h_eno,
            'sd': h_sd,
            'ed': h_ed,
        },
        success: function(data, dataType){
            if (data == 'OK'){
                alert(a_sKind + "しました。");
                //$.unblockUI();
                //document.location.href = "./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>";
                location.href = "./index.php?mnu=90500";
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