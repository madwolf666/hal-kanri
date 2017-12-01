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
function choice_covering_letter_method(h_no)
{
    //alert(h_no);
    /**/
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');
    
    $.ajax({
        url: m_parentURL + "choice_covering_letter_method.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'entry_no': h_no
        },
        success: function(data, dataType){
            $("#my-covering_letter").empty().append(data);
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
