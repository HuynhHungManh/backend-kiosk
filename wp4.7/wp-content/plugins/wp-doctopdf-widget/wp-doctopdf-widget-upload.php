<?php
set_time_limit(0);
ini_set('default_socket_timeout',480);
echo json_encode(Wpdoctopdfw::process_upload($args));
?>