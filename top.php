<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

?>

<section id="new">
<h2 id="newinfo_hdr" class="close">更新情報・お知らせ</h2>

<div id="my-list" style="z-index:100; width: auto; padding-bottom: 10px;"></div>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-top.js"></script>
<script type="text/javascript">
    make_top_information_list(1);
    resize_div('right_title', 360+17); 
    resize_div('right_record', 360); 
    $(window).resize(function(){
        resize_div('right_title', 360+17); 
        resize_div('right_record', 360); 
    });
</script>
