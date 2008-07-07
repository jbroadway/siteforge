# Your database schema goes here

create table siteforge_bug (
	id int not null auto_increment primary key,
	proj_id char(24) not null,	
	user_id char(48) not null,
	subject char(128) not null,
	ts datetime not null,
	status enum('new','feature request','verified','invalid','not reproducible','need more info','resolved') not null,
	body text not null,
	extra1 char(48) not null,
	extra2 char(48) not null,
	extra3 char(48) not null,
	extra4 char(48) not null,
	extra5 char(48) not null,
	index (proj_id, user_id, ts, status),
	index (extra1, extra2, extra3, extra4, extra5)
);

create table siteforge_bug_comment (
	id int not null auto_increment primary key,
	bug_id int not null,
	user_id char(48) not null,
	ts datetime not null,
	body text not null,
	index (bug_id, user_id, ts)
);

create table siteforge_bug_subscriber (
	id int not null auto_increment primary key,
	bug_id int not null,
	email char(72) not null,
	index (bug_id, email)
);

create table siteforge_news (
	id int not null auto_increment primary key,
	proj_id char(24) not null,
	headline char(72) not null,
	ts datetime not null,
	body text not null,
	index (proj_id, ts)
);

create table siteforge_doc (
	id char(24) not null,
	proj_id char(24) not null,
	title char(72) not null,
	sort_weight int not null,
	body text not null,
	primary key (id, proj_id),
	index (proj_id, sort_weight, title)
);

create table siteforge_project (
	id char(24) not null primary key,
	user_id char(48) not null,
	name char(48) not null,
	category int not null,
	status int not null,
	description text not null,
	license int not null,
	audience int not null,
	ext_url char(128) not null,
	ts datetime not null,
	ext_bugs char(128) not null,
	ext_docs char(128) not null,
	ext_forum char(128) not null,
	donation_paypal_id char(72) not null,
	donation_default_amt decimal(4,2) not null,
	donation_message text not null,
	index (user_id, category, status, license, audience, ts)
);

create table siteforge_project_member (
	proj_id char(24) not null,
	user_id char(48) not null,
	index (proj_id, user_id)
);

create table siteforge_category (
	id int not null auto_increment primary key,
	name char(48) not null,
	index (name)
);

create table siteforge_status (
	id int not null auto_increment primary key,
	name char(48) not null,
	index (name)
);

create table siteforge_license (
	id int not null auto_increment primary key,
	name char(48) not null,
	index (name)
);

create table siteforge_audience (
	id int not null auto_increment primary key,
	name char(48) not null,
	index (name)
);

create table siteforge_stat (
	id int not null auto_increment primary key,
	proj_id char(24) not null,
	ts datetime not null,
	dl_file char(128) default null,
	ip char(15) not null,
	index (proj_id, ts, dl_file)
);

CREATE TABLE siteforge_forum (
	id int not null auto_increment primary key,
	proj_id char(24) not null,
	name char(48) not null,
	summary char(255) not null,
	index (proj_id)
);

CREATE TABLE siteforge_forum_post (
	id int not null auto_increment primary key,
	forum_id int not null,
	user_id char(48) not null,
	posted datetime not null,
	updated datetime not null,
	post_id int,
	subject char(72) not null,
	body text not null,
	index (forum_id, updated, post_id)
);

insert into siteforge_category values (null, 'Apps - Administration');
insert into siteforge_category values (null, 'Apps - Business');
insert into siteforge_category values (null, 'Apps - Community Services');
insert into siteforge_category values (null, 'Apps - Databases');
insert into siteforge_category values (null, 'Apps - Desktop');
insert into siteforge_category values (null, 'Apps - E-Commerce');
insert into siteforge_category values (null, 'Apps - Games/Entertainment');
insert into siteforge_category values (null, 'Apps - Miscellaneous');
insert into siteforge_category values (null, 'Apps - Multimedia');
insert into siteforge_category values (null, 'Apps - Project Management');
insert into siteforge_category values (null, 'Apps - Web Services');
#insert into siteforge_category values (null, 'Collections (Content Types)');
#insert into siteforge_category values (null, 'Database Drivers');
insert into siteforge_category values (null, 'Documentation');
insert into siteforge_category values (null, 'Internationalization');
#insert into siteforge_category values (null, 'Patches');
#insert into siteforge_category values (null, 'Rex Drivers');
#insert into siteforge_category values (null, 'Session Drivers');
#insert into siteforge_category values (null, 'SiteSearch File Extractors');
insert into siteforge_category values (null, 'Templates');
#insert into siteforge_category values (null, 'Translations');
#insert into siteforge_category values (null, 'Tutorials');
#insert into siteforge_category values (null, 'Workflow');

insert into siteforge_status values (1, 'Pending');
insert into siteforge_status values (2, 'Approved');
insert into siteforge_status values (3, 'Rejected');
insert into siteforge_status values (4, 'Planning');
insert into siteforge_status values (5, 'Pre-Alpha');
insert into siteforge_status values (6, 'Alpha');
insert into siteforge_status values (7, 'Beta');
insert into siteforge_status values (8, 'Production/Stable');
insert into siteforge_status values (9, 'Mature');

insert into siteforge_license values (null, 'Creative Commons License');
insert into siteforge_license values (null, 'OSI Approved - BSD');
insert into siteforge_license values (null, 'OSI Approved - GPL');
insert into siteforge_license values (null, 'OSI Approved - Other');
insert into siteforge_license values (null, 'Proprietary/Commercial');
insert into siteforge_license values (null, 'Public Domain');

insert into siteforge_audience values (null, 'Designers');
insert into siteforge_audience values (null, 'Developers');
insert into siteforge_audience values (null, 'End Users');
insert into siteforge_audience values (null, 'Other Audience');
insert into siteforge_audience values (null, 'System Administrators');

insert into sitellite_sidebar_position values ('siteforge_index_left');
insert into sitellite_sidebar_position values ('siteforge_index_right');

insert into sitellite_sidebar values (
	'siteforge_index_projects',
	'New Projects',
	'siteforge_index_left',
	5,
	'all',
	'siteforge/newprojects',
	'approved',
	'public',
	null,
	null,
	'admin',
	'none',
	''
);
insert into sitellite_sidebar_sv values (
	null,
	'admin',
	'created',
	now(),
	'Document added.',
	'no',
	'yes',
	'siteforge_index_projects',
	'New Projects',
	'siteforge_index_left',
	5,
	'all',
	'siteforge/newprojects',
	'approved',
	'public',
	null,
	null,
	'admin',
	'none',
	''
);


insert into sitellite_sidebar values (
	'siteforge_index_about',
	'About This Site',
	'siteforge_index_left',
	10,
	'all',
	'',
	'approved',
	'public',
	null,
	null,
	'admin',
	'none',
	'<p>This site provides free public hosting and tools for software projects related to the Sitellite Content Management System. Features include project browsing and searching, bug tracking, downloads, a wiki-like document area, CVS access, and usage statistics.</p><p>For more info about the software that powers this site, please visit <a href="http://www.sitelliteforge.com/siteforge">its official project page</a>.</p>'
);
insert into sitellite_sidebar_sv values (
	null,
	'admin',
	'created',
	now(),
	'Document added.',
	'no',
	'yes',
	'siteforge_index_about',
	'About This Site',
	'siteforge_index_left',
	10,
	'all',
	'',
	'approved',
	'public',
	null,
	null,
	'admin',
	'none',
	'<p>This site provides free public hosting and tools for software projects related to the Sitellite Content Management System. Features include project browsing and searching, bug tracking, downloads, a wiki-like document area, CVS access, and usage statistics.</p><p>For more info about the software that powers this site, please visit <a href="http://www.sitelliteforge.com/siteforge">its official project page</a>.</p>'
);

insert into sitellite_sidebar values (
	'siteforge_index_news',
	'Project News',
	'siteforge_index_right',
	5,
	'all',
	'siteforge/news',
	'approved',
	'public',
	null,
	null,
	'admin',
	'none',
	''
);
insert into sitellite_sidebar_sv values (
	null,
	'admin',
	'created',
	now(),
	'Document added.',
	'no',
	'yes',
	'siteforge_index_news',
	'Project News',
	'siteforge_index_right',
	5,
	'all',
	'siteforge/news',
	'approved',
	'public',
	null,
	null,
	'admin',
	'none',
	''
);

insert into sitellite_sidebar values (
	'siteforge_index_stats',
	'Site Statistics',
	'siteforge_index_right',
	10,
	'all',
	'siteforge/stats',
	'approved',
	'public',
	null,
	null,
	'admin',
	'none',
	''
);
insert into sitellite_sidebar_sv values (
	null,
	'admin',
	'created',
	now(),
	'Document added.',
	'no',
	'yes',
	'siteforge_index_stats',
	'Site Statistics',
	'siteforge_index_right',
	10,
	'all',
	'siteforge/stats',
	'approved',
	'public',
	null,
	null,
	'admin',
	'none',
	''
);
