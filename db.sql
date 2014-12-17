/*
everything: created, modified, active, deleted etc. add later
*/

/* add meta to templates */
/* maybe make an "assets" table??*/

drop table if exists users;
create table users(
	id int not null auto_increment,
	primary key(id),
	name varchar(255),
	created datetime,
	modified datetime,
	last_login datetime,
	active tinyint(1),
	ip varchar(20),
	provider varchar(100),
	provider_uid varchar(200),
	username varchar(255)
);

drop table if exists comments;
create table comments(
	id int not null auto_increment,
	primary key(id),
	thoughts text, -- because the word 'comment' is reserved
	rating int,
	created datetime,
	modified datetime,
	user_id int,
	hidden tinyint(1),
	flagged int -- this is a number so we can count number of flags, maybe shut it down after so many
);

drop table if exists templates;
create table templates(
	id int not null auto_increment,
	primary key(id),
	name varchar(255),
	created datetime,
	modified datetime,
	active tinyint(1),
	meta_title varchar(70),
	meta_desc varchar(400), 
	location varchar(100),
	creator varchar(255), -- simple way to keep track, and eventually could be used for Auth
	nextid int,
	previd int,
	code int,
	ip varchar(20)
);

drop table if exists assets;
create table assets(
	id char(36) not null,
	primary key(id),
	name varchar(255),
	asset_text text,
	filename varchar(255),
	filesize int(11),
	filemime varchar(45),
	template_id int, -- maybe this could be a HABTM, but I think this will make it simpler and is fine
	sortorder int,
	created datetime,
	modified datetime
);


drop table if exists beacons;
create table beacons(
	id int not null auto_increment,
	primary key(id),
	name varchar(255),
	created datetime,
	modified datetime,
	active tinyint(1),
	uuid varchar(60),
	major int,
	minor int,
	strength int,
	-- relationships
	template_id int
);

-- for global settings just proof-of-concept I guess, name could be "top_logo" and value would be "something.jpg"
drop table  if exists preferences;
create table preferences(
	id int not null auto_increment,
	primary key(id),
	name varchar(255),
	name_value varchar(255)
);