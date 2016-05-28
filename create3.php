<?php

include 'config.php';

db_connect();

mysql_query("CREATE TABLE `raporty` (
  `temat` varchar(50)  NOT NULL ,
  `opis` varchar(255) NOT NULL,
  `typ` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_nadawcy` int(4)  NOT NULL,
  `id_przyjmujacego` int(4) NOT NULL,
    PRIMARY KEY (`temat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

db_close();

?>