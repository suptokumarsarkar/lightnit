<?php

$url_name = "https://lightnit.com/demo/view/api/run-zap";

  $ch_session = curl_init();

curl_setopt($ch_session, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch_session, CURLOPT_URL, $url);

  $result_url = curl_exec($ch_session);

  echo $result_url;

  ?> 