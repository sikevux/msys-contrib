CREATE TABLE IF NOT EXISTS adminusers (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(12) NOT NULL,
  password varchar(64) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY username (username)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
