CREATE TABLE IF NOT EXISTS `users` (
  id int(11) NOT NULL AUTO_INCREMENT,
  fname VARCHAR(255) not null,
  lname VARCHAR(255) not null,
  login varchar(255) not null,
  password VARCHAR(32) not null,
  email varchar(255) not null,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;