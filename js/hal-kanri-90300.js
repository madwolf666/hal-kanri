/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    $('#publication').datepicker({});
});

//お知らせ一覧
function make_m_information_list(h_pageNo){
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "make_m_information_list.php",
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
       }
   });
}

//お知らせ登録
function check_m_information_input(h_idx){
    var a_idx = -1;
    //alert(a_auth);
    if (h_idx == -1){
        a_sKind = '登録';
        a_idx = -1;
    }else{
        a_sKind = '更新';
        a_idx = h_idx;
    }

    //--------------------------------------------------------------------------
    //必須チェック
    //--------------------------------------------------------------------------
    if (!check_IsRequired("#publication", "日付が入力されていません！"))
        return false;
    if (!check_IsRequired("#information", "お知らせが入力されていません！"))
        return false;
        
    if (!confirm("お知らせ情報を" + a_sKind + "します。よろしいですか？")) return;
    m_ProgressMsg('処理中です...<br><img src="./images/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "entry_m_information.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'idx': a_idx,
            'publication': $('#publication').val(),
            'information': $('#information').val()
        },
        success: function(data, dataType){
            if (data == 'OK'){
                alert(a_sKind + "しました。");
                //$.unblockUI();
                //document.location.href = "./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>";
                location.href = "./index.php?mnu=90300";
            }else{
                $("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
       }
   });	

    return true;
}

//お知らせ削除
function delete_m_information(h_idx){
    var a_idx = h_idx;
    a_sKind = '削除';

    if (!confirm("お知らせ情報を" + a_sKind + "します。よろしいですか？")) return;
//    m_ProgressMsg('ただいま処理中です...<br><img src="./img/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "delete_m_information.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'idx': a_idx
        },
        success: function(data, dataType){
            if (data == 'OK'){
                alert(a_sKind + "しました。");
                //$.unblockUI();
                //document.location.href = "./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>";
                location.href = "./index.php?mnu=90100";
            }else{
                $("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
       }
   });	

    return true;
}

