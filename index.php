<?php
    
    $request = $_SERVER['REQUEST_URI'];
    $isCrawler = 
        isset( $_SERVER['HTTP_USER_AGENT'] ) &&
        preg_match( '/AltaVista|Google.*snippet|Pinterest|Twitterbot|facebookexternalhit\/1[0-9]|googlebot|msnbot|Slurp|yahoo|bingbot|baiduspider/i', $_SERVER['HTTP_USER_AGENT'] );
    
    $title = 'Johnson Banks';
    $description = "Defining and designing brands that make a difference";
    $image = "http://johnsonbanks.webfactional.com/jb-favicon-1024x537.png";
    $url = 'http://'.$_SERVER['HTTP_HOST'].$request;
    $template = '';
    
    if ( $request === '/' ) {
    
        $title = 'Home | Johnson Banks';
    
    } else if ( $request === '/work' ) {
        
        $title = 'Work | Johnson Banks';
        
    } else {
        
        $parts = explode( '?', $request );
        
        $path = $parts[ 0 ];
        $query = isset( $parts[ 1 ] ) ? $parts[ 1 ] : '';
        
        $params = []; parse_str( $query, $params );
        $params = array_merge( $params, ['offset' => 0, 'limit' => 1] );
        
        $dataUrl = 'http://johnsonbanks.webfactional.com/api'.$path.'?'.http_build_query( $params );
        $data = json_decode( file_get_contents( $dataUrl ), true );
        
        if ( $data[ 'articles' ] ) {
            
            if ( $data[ 'articles' ][ 0 ] ) {
                
                $article = $data[ 'articles' ][ 0 ];
                
                $title = $article[ 'shortTitle' ] . ' | Johnson Banks';
                
                if ( $article['title'] && $article['title'] !== $title ) {
                    
                    $description = $article['title'];
                    
                }
                
                $imageUrl = false;
                
                if ( $article[ 'seoImage' ] ) {
                
                    $imageUrl = $article[ 'seoImage' ];
                
                } else if ( $article[ 'thumbnail' ] && count( $article[ 'thumbnail' ] ) ) {
                    
                    $imageUrl = $article[ 'thumbnail' ][ 0 ][ 'url' ];
                    
                }
                
                if ( $imageUrl && substr( $imageUrl, -3 ) !== 'svg' ) {
                    
                    $image = $imageUrl;
                    
                }
                
                if ( $isCrawler ) {
                    
                    if ( $article[ 'template' ] ) {
                        
                        $template = $article[ 'template' ];
                        
                    } else if ( $article[ 'templateUrl' ] ) {
                    
                        $template = file_get_contents( $article[ 'templateUrl' ], true );
                    
                    }
                    
                }
                
            }
            
        }
    
    }
    
?>

<!--
    
     
          '             .           .
       o       '   o  .     '   . O
    '   .   ' .   _____  '    .      .
     .     .   .mMMMMMMMm.  '  o  '   .
   '   .     .MMXXXXXXXXXMM.    .   ' 
  .       . /XX77:::::::77XX\ .   .   .
     o  .  ;X7:::''''''':::7X;   .  '
    '    . |::'.: BONG    '::| .   .  .
       .   ;:.:.            :;. o   .
    '     . \'.:            /.    '   .
       .     `.':.        .'.  '    .
     '   . '  .`-._____.-'   .  . '  .
      ' o   '  .   O   .   '  o    '
       . ' .  ' . '  ' O   . '  '   '
        . .   '    '  .  '   . '  '
         . .'..' . ' ' . . '.  . '
          `.':.'        ':'.'.'
            `\\_  |     _//'
              \(  |\    )/
              //\ |_\  /\\
             (/ /\(" )/\ \)
              \/\ (  ) /\/
                 |(  )|
                 | \( \
                 |  )  \
                 |      \
                 |       \
                 |        `.__,
                 \_________.-'Ojo/gnv
    
          http://bong.international/
    
-->

<!doctype html>
<html lang="en">
    
    <head>
        
        <meta charset="UTF-8">
        
        <title><?= $title ?></title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
        <link rel="stylesheet" href="/style.css" type="text/css" />
        <link rel="icon" type="image/png" href="/jb-favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/jb-favicon-16x16.png" sizes="16x16">
        
    	<meta name="description" content="<?= $description ?>">
    	<meta property="og:type" content="website">
    	<meta property="og:title" content="<?= $title ?>">
    	<meta property="og:image" content="<?= $image ?>">
    	<meta property="og:url" content="<?= $url ?>">
    	<meta property="og:description" content="<?= $description ?>">
    	<meta itemprop="name" content="<?= $title ?>">
    	<meta name="twitter:card" content="summary_large_image">
    	<meta name="twitter:creator" content="@johnsonbanks">
    	<meta name="twitter:site" content="@johnsonbanks">
    	<meta name="twitter:url" content="<?= $url ?>">
    	<meta name="twitter:title" content="<?= $title ?>">
    	<meta name="twitter:descripton" content="<?= $description ?>">
    	<meta name="twitter:image" content="<?= $image ?>">

    </head>
    
    <body>
        
        <?= $template ?>
        
        <script>
        
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            
            ga('create', 'UA-366539-1', 'auto');
            ga('send', 'pageview');
        
        </script>
        
        <script type="text/javascript" src="/bundle.js"></script>
        
    </body>
    
</html>