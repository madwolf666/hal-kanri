/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// File APIに対応していない場合はエリアを隠す
if (!window.File){
    document.getElementById("image_upload_section").style.display = "none";
}

// ブラウザ上でファイルを展開する挙動を抑止
function onDragOver(event) {
    event.preventDefault();
}

// Drop領域にドロップした際のファイルのプロパティ情報読み取り処理
function onDrop(event) {
    // ブラウザ上でファイルを展開する挙動を抑止
    event.preventDefault();

    // ドロップされたファイルのfilesプロパティを参照
    var files = event.dataTransfer.files;
    for (var i=0; i<files.length; i++) {
        // 一件ずつアップロード
        imageFileUpload(files[i]);
    }
}

// ファイルアップロード
function imageFileUpload(f) {
    var formData = new FormData();
    formData.append('image', f);
    $.ajax({
        type: 'POST',
        contentType: false,
        processData: false,
        url: 'http://example.com/image/upload',
        data: formData,
        dataType: 'json',
        success: function(data) {
            // メッセージ出したり、DOM構築したり。
        }
    });
}
