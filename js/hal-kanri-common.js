/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//親パス
var a_dir = window.location.href.split("/");
var m_parentURL = a_dir[2];
//alert(m_parentURL);
//windows
var m_parentURL = "//" + m_parentURL + "/hal-kanri/";
//linux
//var m_parentURL = "//" + m_parentURL + "/";

//処理中表示
var m_ProgressMsg = function (text) {
    $.blockUI({
        message: text,
        fadeIn: 200,
        fadeOut: 0,
        overlayCSS: {
            backgroundColor: '#aaa',
            opacity: 0.6,
            cursor: 'wait'
        },
        css: {
            position: 'absolute',
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            padding: '0 0 0 0',
            margin: 'auto',
            height: '60px',
            width: '340px',
            border: '2px solid #aaa'
        }
    });
};

//アラート表示
function show_Alert(h_obj, h_msg) {
    alert(h_msg);
    $(h_obj).css("background-color","#ffff00");
    $(h_obj).focus();
}

//必須入力チェック
function check_IsRequired(h_obj,h_msg) {
    if ($(h_obj).val() == '') {
        show_Alert(h_obj,h_msg);
        return false;
    }
    return true;
}

function check_IsRequired_opt(h_obj,h_msg) {
    if ($('[name=' + h_obj + '] option:selected').text() == '') {
        show_Alert(h_obj,h_msg);
        return false;
    }
    return true;
}

//数値チェック
function check_IsNumeric(h_obj, h_msg) {
    if ($(h_obj).val() != '') {
        if (jQuery.isNumeric($(h_obj).val()) == false) {
            show_Alert(h_obj, h_msg);
            return false;
        }
    }
    return true;
}

//テーブルリサイズ
function resize_tbl_list(){
   //out.print("alert($('#tbl_edit_warn_list').width());");
    //if (($(window).width()<1200) && ($('#tbl_list').width() < $('#hpb-container').width())){
    //alert($('#tbl_list').width());
    //alert($('#hpb-container').width());
    if ($('#tbl_list').width() > $('#hpb-container').width()){
        //alert('chappy1');
        $('#hpb-container').width($('#tbl_list').width()+100);
        $('#hpb-container').css('margin-left','4px');
        $('#hpb-container').css('padding-right','8px');
    }else{
        //alert($('#hpb-container').width());
        //alert($('#hpb-nav').width());
        if ($('#hpb-nav').width() < $('#hpb-container').width()){
            $('#hpb-container').css('width','99%');
        }else{
            $('#hpb-container').width($('#hpb-nav').width());
        }
    }
}

//divリサイズ
function resize_div(dname, lwidth){
    //alert(dname + "," + lwidth);
    $('#' + dname).width($('#main').width() - lwidth);
}

//divリサイズ
function resize_div2(h_leftColumn, h_right_title, h_right_record, h_width){
    //alert(dname + "," + lwidth);
    $('#' + h_right_record).width($('#main').width() - h_width);
    $('#' + h_right_title).width($('#main').width() - h_width - 17);
    var a_h = window.innerHeight ? window.innerHeight: $(window).height();
    var a_rn = $('#my-recnum').offset().top;
    $('#' + h_right_record).height(a_h - a_rn - 184);
    $('#' + h_leftColumn).height(a_h - a_rn - 184 - 17);
}

//ログイン認証
function exec_login(){
    //alert('chk_auto');
    //alert($('#pass').val());
    if ($('#pass').val() == null){
        show_Alert('#pass','パスワードを指定して下さい。');
        return false;
    }
    if ($('#pass').val() == ''){
        show_Alert('#pass','パスワードを指定して下さい。');
        return false;
    }
    
    //alert($('#remember').prop('checked'));
    
    $.ajax({
        url: m_parentURL + "exec_login.php",
        type: 'POST',
        dataType: "html",
        async: false,
        data:{
            'pass': $('#pass').val(),
            'remember': $('#remember').prop('checked')
        },
        success: function(data, dataType){
            //alert(data);
            if (data == 'OK'){
                chk_auth();
            }else{
                $("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $("#my-result").empty().append(errorThrown.message);
            //alert(errorThrown.message);
        },
       complete: function (data) {
       }
   });
}

//認証チェック
function chk_auth(){
    //alert('chk_auth');
    location.href = './index.php';
/*    
    $.ajax({
        url: m_parentURL + "index.php",
        type: 'POST',
        dataType: "html",
        async: false,
        data:{
        },
        success: function(data, dataType){
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
       }
   });
*/
}

//------------------------------------------------------------------------------
//契約管理全体
//------------------------------------------------------------------------------
//Excelへ給与台帳出力
function excel_out_10200(){
    location.href = m_parentURL + "excel_out_10200.php";
    return false;
}
//Excelへ検収台帳出力
function excel_out_10300(){
    location.href = m_parentURL + "excel_out_10300.php";
    return false;
}
//Excelへ注文書台帳出力
function excel_out_10400(){
    location.href = m_parentURL + "excel_out_10400.php";
    return false;
}
//Excelへ注文書出力
function excel_out_10402(){
    location.href = m_parentURL + "excel_out_10402.php";
    return false;
}
//Excelへ注文請書出力
function excel_out_10403(){
    location.href = m_parentURL + "excel_out_10403.php";
    return false;
}
//Excelへ契約書台帳出力
function excel_out_10500(){
    location.href = m_parentURL + "excel_out_10500.php";
    return false;
}
//Excelへ労働契約書出力
function excel_out_10502(){
    location.href = m_parentURL + "excel_out_10502.php";
    return false;
}
//Excelへ労働契約書（再発行）出力
function excel_out_10503(){
    location.href = m_parentURL + "excel_out_10503.php";
    return false;
}
//Excelへ就業条件書出力
function excel_out_10504(){
    location.href = m_parentURL + "excel_out_10504.php";
    return false;
}
//Excelへ派遣元台帳出力
function excel_out_10600(){
    location.href = m_parentURL + "excel_out_10600.php";
    return false;
}

//------------------------------------------------------------------------------
//ポップアップ
//------------------------------------------------------------------------------
function show_popup()
{
    var $popup = $("#my-popup");
    // ポップアップの幅と高さからmarginを計算する
    var mT = ($popup.outerHeight() / 2) * (-1) + 'px';
    var mL = ($popup.outerWidth() / 2) * (-1) + 'px';
    // marginを設定して表示
    $('.popup').hide();
    $popup.css({
            'margin-top': mT,
            'margin-left': mL
    }).show();
    $('#overlay').show();
    return false;
}

function hide_popup()
{
    $('.popup, #overlay').hide();
}

var g_input_click = false;

//focus
function after_focus(h_field, h_id)
{
    $("#i_" + h_field + h_id).focus();
}

//reset input 
function reset_input(h_field, h_id)
{
    //alert(h_field + "," + h_id );
    var a_val = $("#i_" + h_field + h_id).val();
    $("#" + h_field + h_id).empty().append(a_val);

    g_input_click = false;
}
//入力フィールド作成
function make_input_text(h_cr_id, h_field, h_id)
{
    //alert(h_cr_id + "," + h_field + "," + h_id );
    
    if (g_input_click == true) {
        //alert('ccc');
        return;
    }
    
    var a_str = '<input type="text"';
    
    a_str += ' id="i_' + h_field + h_id + '"';
    a_str += ' value="';

    var a_val = $("#" + h_field + h_id).text();
    //alert(a_val);
    if (a_val != null) {
        a_str += a_val;
    }
    a_str += '" style="width: 96%;"';
    a_str += ' onKeyPress="check_input_key_enter(window.event.keyCode, \'' + h_cr_id + '\',\'' + h_field + '\',\'' + h_id + '\',1);"';
    a_str += ' onblur="reset_input(\'' + h_field + '\',\'' + h_id + '\');"';
    a_str += '>';
    //alert(a_str);
    $("#" + h_field + h_id).empty().append(a_str);
    $("#" + h_field + h_id).focus();
    //alert($("#" + h_field + h_id).text());
     
    g_input_click = true;
}
