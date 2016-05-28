<?php

include 'config.php';

db_connect();

mysql_query("CREATE TABLE `wpisy` (
  `tytul` varchar(50)  NOT NULL ,
  `tresc` varchar(255) NOT NULL,
  `id_autora` int(4) NOT NULL,
  `status_wpisu` varchar(50) NOT NULL,
  `wpis_regdate` int(10) unsigned NOT NULL,
    PRIMARY KEY (`tytul`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

db_close();

?>