<?php

# No direct access
$secureSrcClassName  = 'WCFE\Modules\Editor\Model\EmergencyRestore';
( class_exists( $secureSrcClassName ) && ( get_class( $this ) == $secureSrcClassName ) ) or die( 'Access Denied' );

$data = array();

$data[ 'secureKey' ] 	= 'a869aa80bb150a98dc2270a909406fc0';
$data[ 'backupFileHash' ] 	= '2991099b10cc1486a6b3783cde506834';

$data[ 'absPath' ] 	= '/var/www/html';
$data[ 'contentDir' ] 	= '/var/www/html/wp-content/wcfe-f7fce79592132bc0704022e79baa2910';

$data[ 'timeCreated' ] 	= 1507796072;

$data[ 'privateKey' ] = '3@;E.H8_`RmB*}1rUT=h5~_ggkfV&MfR-C(Pi:{zXo}joFHz&;$YmSv3Vy9;B=@B-pbz=E;4w1pSu,gXkp.pLz5K~?{YA6:5!^RR$cnWlx v[&Ts R{%DS?8[b86537nrR8ChzWcG[J-7O&x7 5 qGkQR0YH}uqKT38 -V3,m}fb5]i)FS?uSv!2NGc@{H|uU{V{>(%XnZB<BGq?L0ra0/.USv4HlmJH8Iap9G@P+;Q/Vcq%Dr&ycfXGe<OkGlh&:!qtwR@~oZHL!|!xyB||lNf5nEms/{&?yNezCpgDk# 1=-</z-P6Lg/N!$uKwzeEgP]V{a/(N*%) ZN98SBS$+~~PM>Z#E0en+HlWl8!EQ=,qBQS&b<QTsoO*LXE?,awXSrb_JtkjBZo.Z3aUe!q}/ks6Z&t@Tk,>NbbZ{yij`-9l7jcDt5+N>svgNM{wy}dkM}i8 Be1xBL(e`Xs^vv;@2KpT{pDp8jBPb53&sDPwk[?UC}i[hFgv.`&`|-KfdH';

return $data;