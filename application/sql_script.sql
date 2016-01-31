CREATE DATABASE if not EXISTS wtfami CHARACTER SET utf8 COLLATE utf8_general_ci;

#################################################################

CREATE TABLE IF NOT EXISTS `users` (
  id int(11) NOT NULL AUTO_INCREMENT,
  fname VARCHAR(255) not null,
  lname VARCHAR(255) not null,
  login varchar(255) not null,
  password VARCHAR(32) not null,
  email varchar(255) not null,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

insert INTO users (fname, lname, login, password, email)
values('gabriel', 'desilets', 'gab', md5('gd'), 'gabdesilets@gmail.com');

######################################################################

Create table if not EXISTS routes (
  id int(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) not null,
  description TEXT default '',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

insert into routes (name, description)
    values('gabs routes', 'this is my sassy route son.');

######################################################################

create table if NOT EXISTS users_routes(
  user_id int(11) not null,
  route_id int(11) not null,
  PRIMARY KEY (user_id, route_id)
);

ALTER TABLE users_routes
ADD CONSTRAINT `fk_users_routes_user_user_id` FOREIGN KEY (user_id) REFERENCES users (id);

ALTER TABLE users_routes
ADD CONSTRAINT `fk_users_routes_routes_route_id` FOREIGN KEY (route_id) REFERENCES routes (id);

insert into users_routes
    VALUEs(1, 1);

######################################################################

create table if NOT EXISTS routes_markers(
  id int(11) not null AUTO_INCREMENT,
  route_id int(11) not null,
  marker_lat FLOAT(10, 6),
  marker_long FLOAT(10, 6),
  PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE routes_markers
ADD CONSTRAINT `fk_routes_markers_routes_route_id` FOREIGN KEY (route_id) REFERENCES routes (id);

INSERT into routes_markers(route_id, marker_lat, marker_long)
    VALUES(1, 46.5407283, -72.7487867);
#####################################################################

create TABLE if NOT EXISTS route_marker_descriptions(
  id int(11) not null AUTO_INCREMENT,
  route_id int(11) not null,
  marker_lat FLOAT(10, 6),
  marker_long FLOAT(10, 6),
  name VARCHAR(255) not null,
  description TEXT default '',
  PRIMARY KEY (id)
)DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE route_marker_descriptions
ADD CONSTRAINT `fk_route_marker_descriptionsroutes_route_id` FOREIGN KEY (route_id) REFERENCES routes (id);

INSERT INTO route_marker_descriptions (route_id, marker_lat, marker_long, name, description)
  VALUES (1, 46.5407283, -72.7487867, 'this is a nice info about this route', 'bla bla bla bla bla bla blaq');