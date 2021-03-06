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

//消費税⇒課題解決表No.70
var m_consumption_tax = [
    ['1997/04/01', 0.05],
    ['2014/04/01', 0.08],
];

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

//半角カナチェック[2017.11.07]課題No.73
function check_IsHanKana(h_obj, h_msg) {
    if ($(h_obj).val() != '') {
        var a_reg = new RegExp(/^[ｦ-ﾟ ]*$/);
        if (a_reg.test($(h_obj).val()) == false) {
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
function resize_div2(h_leftColumn, h_right_title, h_right_record, h_width, h_height){
    //alert($(window).width());
    if ($(window).width() <= 480) {
        //alert($(window).width());
        $('#' + h_right_title).css('overflow','visible');
        $('#' + h_right_title).width('auto');
        $('#' + h_right_record).css('overflow','visible');
        $('#' + h_right_record).width('auto');
        $('#my-list').css('overflow-x', 'scroll');

        $('#' + h_right_record).height('auto');
        $('#' + h_leftColumn).height('auto');
    }else{
        $('#' + h_right_title).css('overflow','hidden');
        //$('#right_title').css('width','auto');
        $('#' + h_right_record).css('overflow','scroll');
        $('#my-list').css('overflow-x', 'hidden');
        
        //alert(dname + "," + lwidth);
        $('#' + h_right_record).width($('#main').width() - h_width);
        $('#' + h_right_title).width($('#main').width() - h_width - 17);
        var a_h = window.innerHeight ? window.innerHeight: $(window).height();
        var a_rn = $('#my-recnum').offset().top;
        $('#' + h_right_record).height(a_h - a_rn - h_height);
        $('#' + h_leftColumn).height(a_h - a_rn - h_height - 17);
    }
}

//ログイン認証
function exec_login(h_enter){
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
    
    //m_ProgressMsg('認証中です......<br><img src="./images/upload.gif" /> ');
    //alert($('#remember').prop('checked'));
    //alert(m_parentURL);
    
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
                if (h_enter == false){
                    chk_auth();
                }else{
                    chk_auth_enter();
                }
            }else{
                $("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $("#my-result").empty().append(errorThrown.message);
            //alert(errorThrown.message);
        },
       complete: function (data) {
            //$.unblockUI();
       }
   });
}

//認証チェック
function chk_auth(){
    document.location.href = './index.php';
}

//認証チェック
function chk_auth_enter(){
    documtn.frm_login.submit();
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
var g_input_completed = false;
var g_select_completed = true;

//focus
function after_focus(h_field, h_id)
{
    $("#i_" + h_field + h_id).focus();
}

//set input 
function set_input(h_field, h_id, h_kind)
{
    //alert('set_input(h_kind):' + h_kind);
    if (h_kind == 2){
       //alert('chappy');
        $(function() {
            alert($('#i_' + h_field + h_id).val());
            $('#i_' + h_field + h_id).datepicker({});
            $('#i_' + h_field + h_id).datepicker();
        });
    }
}

//reset input 
function reset_input(h_field, h_id, h_kind, h_val)
{
    //alert(h_field + "," + h_id + "," + h_kind + "," + h_val);
    //var a_val = $("#i_" + h_field + h_id).val();
    //if (h_kind != 2){
    if (g_select_completed == true){
        if (g_input_completed == false){
            $("#" + h_field + h_id).empty().append(h_val);
        }
        g_input_click = false;
    }

    g_input_completed = false;
}

//入力フィールド作成
function make_input_text(h_cr_id, h_field, h_id, h_kind)
{
    //alert(h_cr_id + "," + h_field + "," + h_id );
    
    if (g_input_click == true) {
        //alert('ccc');
        return;
    }
    
    if (h_kind == 2){
        g_select_completed = false;
    }else{
        g_select_completed = true;
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
    a_str += ' onKeyPress="check_input_key_enter(window.event.keyCode, \'' + h_cr_id + '\',\'' + h_field + '\',\'' + h_id + '\',' + h_kind + ');"';
    //a_str += ' onfocus="set_input(\'' + h_field + '\',\'' + h_id + '\',' + h_kind + ');"';
    //if (h_kind != 2){
        a_str += ' onblur="reset_input(\'' + h_field + '\',\'' + h_id + '\',' + h_kind + ',\'' + a_val + '\');"';
    //}
    a_str += '>';
    //alert(a_str);
    $("#" + h_field + h_id).empty().append(a_str);
    $("#" + h_field + h_id).focus();
    //alert($("#" + h_field + h_id).text());
    
    if (h_kind == 2){
        /**/
        $('#i_' + h_field + h_id).datepicker({
            /*
            onSelect:function(dataText){
                //alert(dataText);
                g_select_completed = true;
                $('#i_' + h_field + h_id).focus();
            };
            */
            onClose:function(dataText){
                //alert(dataText);
                g_select_completed = true;
                $('#i_' + h_field + h_id).focus();
            }
        });
        /**/
    }
    
    g_input_click = true;
}

function make_input_text2(h_cr_id, h_sub_id, h_field, h_id, h_kind)
{
    //alert(h_cr_id + "," + h_field + "," + h_id );
    
    if (g_input_click == true) {
        //alert('ccc');
        return;
    }
    
    if (h_kind == 2){
        g_select_completed = false;
    }else{
        g_select_completed = true;
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
    a_str += ' onKeyPress="check_input_key_enter(window.event.keyCode, \'' + h_cr_id + '\',\'' + h_sub_id + '\',\'' + h_field + '\',\'' + h_id + '\',' + h_kind + ');"';
    a_str += ' onblur="reset_input(\'' + h_field + '\',\'' + h_id  + '\',' + h_kind + ',\'' + a_val + '\');"';
    a_str += '>';
    //alert(a_str);
    $("#" + h_field + h_id).empty().append(a_str);
    $("#" + h_field + h_id).focus();
    //alert($("#" + h_field + h_id).text());
     
    if (h_kind == 2){
        //alert($('#i_' + h_field + h_id).val());
        $('#i_' + h_field + h_id).datepicker({
            /*
            onSelect:function(dataText){
                $('#i_' + h_field + h_id).focus();
            }
            */
            onClose:function(dataText){
                //alert(dataText);
                g_select_completed = true;
                $('#i_' + h_field + h_id).focus();
            }
        });
    }

    g_input_click = true;
}

//[2017.11.09]課題No.81
function open_file(h_file){
    //alert(h_file);
    var w = window.innerWidth;
    var h = window.innerHeight;
    //alert(w + "," + h);
    if (w <= 0){
        w = document.documentElement.clientWidth;
    }
    if (h <= 0){
        h = document.documentElement.clientHeight;
    }
    //alert(w + "," + h);
    
    var a_left = 0;
    var a_top = 0;
    var a_w = parseInt(w*0.8);
    var a_h = parseInt(h*0.8);
    window.open(
        h_file,
        "myWindow",
        "left=" + a_left + ",top=" + a_top + ",width=" + a_w + ",height=" + a_h + ",scrollbars=no,resizable=no");
}