/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function check_keydown()
{
    if(window.event.keyCode == 13){
        //alert('check_keydown');
        exec_login(true);
    }
}

