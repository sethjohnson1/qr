/*
everything: created, modified, active etc. add later
*/

drop table  templates;
create table templates(
	id int not null auto_increment,
	primary key(id),
	name varchar(255),
	-- and all other standard columns here
	
	next_id int,
	prev_id int,
	
);

drop table  beacons;
create table beacons(
	id int not null auto_increment,
	primary key(id),
	name varchar(255),
	-- and all other standard columns here
	
	uuid varchar(60),
	major int,
	minor int,
	strength int,
	
	-- relationships
	template_id,
	
	
	
	
);
