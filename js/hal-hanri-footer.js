/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//トップボタン制御
$(function(){
    var topBtn=$('#pagetop');
    topBtn.hide();
 
    //◇ボタンの表示設定
    $(window).scroll(function(){
        if($(this).scrollTop()>80){
            //---- 画面を80pxスクロールしたら、ボタンを表示する
            topBtn.fadeIn();
        }else{
            //---- 画面が80pxより上なら、ボタンを表示しない
            topBtn.fadeOut();
        } 
    });
});

