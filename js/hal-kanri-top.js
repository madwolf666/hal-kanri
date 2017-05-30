/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//お知らせ一覧
function make_top_information_list(h_pageNo){
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "make_top_information_list.php",
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

