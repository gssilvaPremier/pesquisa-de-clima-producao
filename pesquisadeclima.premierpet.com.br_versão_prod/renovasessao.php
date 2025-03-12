<?php
@session_cache_expire(30);
@session_start();

$cache_expire = session_cache_expire();
echo $cache_expire;