<?php

$fileDate = date('Y-m');
define( 'FILENAME', 'log/'.$fileDate.'.dat' );

date_default_timezone_set('Asia/Tokyo');

$clean = array();

if ( !empty($_POST['btn_submit']) ) {
    if ( $_POST['pass'] == '<YOUR PASSWORD>'){
        $clean['message'] = htmlspecialchars( $_POST['message'], ENT_QUOTES, 'UTF-8' );
        $clean['message'] = preg_replace( '/\\r\\n|\\n|\\r/', '<br>', $clean['message'] );

        if ( $file_handle = fopen( FILENAME, "a" ) ) {
            $current_date = date('Y-m-d H:i:s');
            $data = "'".$clean['message']."','".$current_date."'\n";
            fwrite( $file_handle, $data );
            fclose( $file_handle );
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head lang="ja">
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Memo</title>
    </head>
    <body>
        <form method="post">
            <h1>Memo</h1>
            <textarea id="message" name="message" rows="20"></textarea>
            Password: <input type="text" name="pass">
            <input type="submit" name="btn_submit" value="Submit">
        </form>
    </body>
</html>
