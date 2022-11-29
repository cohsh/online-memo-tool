<?php

$fileDate = date('Y-m');
define( 'FILENAME', 'log/'.$fileDate.'.dat' );

date_default_timezone_set('Asia/Tokyo');

$current_date = null;
$data = null;
$file_handle = null;
$split_data = null;
$message = array();
$message_array = array();

if ( $file_handle = fopen( FILENAME, 'r' )) {
  while ( $data = fgets($file_handle) ){
    $split_data = preg_split('/\'/', $data);

    $message = array(
      'message' => $split_data[1],
      'post_date' => $split_data[3]
    );
    array_unshift( $message_array, $message );
  }
  fclose( $file_handle );
}

?>
<!DOCTYPE html>
<html>
    <head lang="ja">
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Log</title>
    </head>
    <body>
        <h1>Log</h1>
        <h2><?php echo date("F, Y");?></h2>
        <br>
        <section>
            <?php if( !empty($message_array) ): ?>
            <?php foreach( $message_array as $value ): ?>
        <article>
            <div>
                <p>
                    <time>Day <?php echo date('j, H:i:s', strtotime($value['post_date'])); ?></time>
                </p>
                <p><?php echo $value['message']; ?></p>
            </div>
        </article>
        <?php endforeach; ?>
        <?php endif; ?>
        </section>
    </body>
</html>
