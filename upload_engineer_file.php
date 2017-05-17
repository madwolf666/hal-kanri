<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel.php");
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel/IOFactory.php");

$a_sRet = "<font color='#0000ff'>アップロードが行われました！</font>";
//$a_sRet = $_FILES["file"]["tmp_name"];

//$dir = $_POST["dir"];
try {
    if ($_FILES["file"]["tmp_name"]) {
        list($file_name,$file_type) = explode(".",$_FILES['file']['name']);
        //ファイル名を日付と時刻にしている。
        $name = date("YmdHis").".".$file_type;
        //$file = "./tmp";
        $file = $GLOBALS['g_EXCEL_TMP_PATH'];
        //読み書きするファイルのパスを設定
        $target_file = $file.$name;
        //$a_sRet = $target_file;
        //ディレクトリを作成してその中にアップロードしている。
        if(!file_exists($file)){
            mkdir($file,0755);
        }
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            chmod($target_file, 0644);
            //var_dump($dir."/".$name);
        }

        try{
            //DBからユーザ情報取得
            $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
            $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $a_conn->beginTransaction();  //トランザクション開始

            $a_sql = "DELETE FROM ".$GLOBALS['g_DB_m_engineer'].";";
            $a_stmt = $a_conn->prepare($a_sql);
            //$a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
            $a_stmt->execute();

            //1. リーダーを作成して既存ファイルを読み込む
            $obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
            $obj_book   = $obj_reader->load($target_file);
            $obj_sheet = $obj_book->getSheetByName("エンジニアリスト");

            //PHPExcelでは、rowは1始まり、colは0始まりのようである。
            $a_row = 3;
            $a_val = $obj_sheet->getCell("A".$a_row)->getValue();
            while ($a_val != '') {
                $a_sql = "INSERT INTO ".$GLOBALS['g_DB_m_engineer']." VALUES(";
                for ($a_col= 0; $a_col < 116; $a_col++) {
                    if ($a_col > 0) {
                        $a_sql .= ",";
                    }
                    switch ($a_col) {
                        case 1:
                        case 2:
                        case 4:
                        case 10:
                        case 68:
                        case 90:
                        case 115:
                            //日付セル
                            $date_val = $obj_sheet->getCellByColumnAndRow($a_col,$a_row)->getFormattedValue();
                            /**/
                            if (preg_match( '/^[0-9]{1,}[\-|\/][0-9]{1,}[\-|\/][0-9]{1,}$/', $date_val )) {
                                //$date_val = "chappy";
                                $date_val = str_replace("/", "-", $date_val);
                                $date_val = DateTime::createFromFormat( 'm-d-Y', $date_val )->format( 'Y/m/d' );
                                //$date_val = DateTime::createFromFormat('m-d-Y', $date_val);
                                //$date_val = DateTime::createFromFormat( 'm/d/y', $date_val )->format( 'Y/m/d' );
                            } else {
                                $date_val = "";
                            }
                            /**/
                           $a_sql .= "'".$date_val."'";
                            break;
                        default:
                            $a_sql .= "'".$obj_sheet->getCellByColumnAndRow($a_col,$a_row)->getValue()."'";
                            break;
                    }
                }
                
                $a_sql .= ");";
                $a_stmt = $a_conn->prepare($a_sql);
                $a_stmt->execute();
                
                $a_row++;
                $a_val = $obj_sheet->getCell("A".$a_row)->getValue();
            }

            if ($a_row > 3){
                $a_conn->commit();    //コミット
            }else{
                $a_conn->rollBack();  //ロールバック
                $a_sRet = "登録データはありません。";
            }
        } catch (PDOException $e){
            if ($a_conn) {
                $a_conn->rollBack();  //ロールバック
            }
            $a_sRet = 'Error:'.$e->getMessage();
            //$a_sRet .= $a_sql;
        }
        $a_conn = null;
        
        unlink($target_file);   //ファイル削除
    }
} catch (Exception $e) {
    if ($a_conn) {
        $a_conn->rollBack();  //ロールバック
    }
    $a_sRet = 'Error:'.$e->getMessage();
}

echo $a_sRet;

?>
