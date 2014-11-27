/*
everything: created, modified, active, deleted etc. add later
*/

/* add meta to templates */
/* maybe make an "assets" table??*/
drop table  templates;
create table templates(
	id int not null auto_increment,
	primary key(id),
	name varchar(255),
	created datetime,
	modified datetime,
	active tinyint(1),
	meta_title varchar(70),
	meta_desc varchar(400), 
	nextid int,
	previd int,
	code int
);

drop table assets;
create table assets(
	id int not null auto_increment,
	primary key(id),
	name varchar(255),
	asset_value text, -- this could be an image link, block of text, etc.
	template_id int, -- maybe this should be a HABTM, but I think this will make it simpler and is fine
	sortorder int,
	created datetime,
	modified datetime
);


drop table  beacons;
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
	museum varchar(10),
	-- relationships
	template_id int
);

-- for global settings just proof-of-concept I guess, name could be "top_logo" and value would be "something.jpg"
drop table preferences;
create table preferences(
	id int not null auto_increment,
	primary key(id),
	name varchar(255),
	name_value varchar(255)
);
