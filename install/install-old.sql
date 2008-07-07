# MySQL dump 8.22
#
# Host: localhost    Database: DBNAME
#-------------------------------------------------------
# Server version	3.23.54-max
#
# Table structure for table 'sitellite_buffer'
#

#
# Table structure for table 'sitellite_cache_file_list'
#

CREATE TABLE sitellite_cache_file_list (
  filename char(255) NOT NULL default '',
  PRIMARY KEY  (filename),
  UNIQUE KEY filename (filename)
) TYPE=MyISAM;

#
# Dumping data for table 'sitellite_cache_file_list'
#

#
# Table structure for table 'sitellite_category'
#

CREATE TABLE sitellite_category (
  id char(48) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_mime_type'
#

CREATE TABLE sitellite_mime_type (
  extension varchar(8) NOT NULL default '',
  type enum('ascii','binary','folder') NOT NULL default 'ascii',
  icon varchar(24) NOT NULL default '',
  description varchar(72) NOT NULL default '',
  PRIMARY KEY  (extension),
  KEY type (type,icon)
) TYPE=MyISAM;

#
# Dumping data for table 'sitellite_mime_type'
#


INSERT INTO sitellite_mime_type VALUES ('folder','folder','pix/icons/folder.gif','File Folder');
INSERT INTO sitellite_mime_type VALUES ('html','ascii','','HTML Web Document');
INSERT INTO sitellite_mime_type VALUES ('htm','ascii','','HTML Web Document');
INSERT INTO sitellite_mime_type VALUES ('php','ascii','pix/icons/document.gif','PHP Web Document');
INSERT INTO sitellite_mime_type VALUES ('jpg','binary','pix/icons/image.gif','JPEG Image File');
INSERT INTO sitellite_mime_type VALUES ('gif','binary','pix/icons/image.gif','GIF Image File');
INSERT INTO sitellite_mime_type VALUES ('png','binary','pix/icons/image.gif','PNG Image File');
INSERT INTO sitellite_mime_type VALUES ('','ascii','pix/icons/unknown.gif','Unknown Document Type');
INSERT INTO sitellite_mime_type VALUES ('sql','ascii','pix/icons/document.gif','SQL Document');
INSERT INTO sitellite_mime_type VALUES ('tpl','ascii','pix/icons/document.gif','Template Document');
INSERT INTO sitellite_mime_type VALUES ('ogg','binary','pix/icons/audio.gif','Ogg Vorbis Audio File');
INSERT INTO sitellite_mime_type VALUES ('mp3','binary','pix/icons/audio.gif','MP3 Audio File');
INSERT INTO sitellite_mime_type VALUES ('csv','ascii','pix/icons/document.gif','Comma-Separated Values');
INSERT INTO sitellite_mime_type VALUES ('txt','ascii','pix/icons/document.gif','Plain Text Document');
INSERT INTO sitellite_mime_type VALUES ('xml','ascii','pix/icons/document.gif','XML Web Document');
INSERT INTO sitellite_mime_type VALUES ('phps','ascii','pix/icons/document.gif','PHP Source Document');
INSERT INTO sitellite_mime_type VALUES ('js','ascii','pix/icons/document.gif','JavaScript Web Document');
INSERT INTO sitellite_mime_type VALUES ('css','ascii','pix/icons/document.gif','Cascading Style Sheet');
INSERT INTO sitellite_mime_type VALUES ('url','ascii','pix/icons/document.gif','Internet Shortcut');
INSERT INTO sitellite_mime_type VALUES ('doc','binary','pix/icons/document.gif','Microsoft Word Document');
INSERT INTO sitellite_mime_type VALUES ('xls','binary','pix/icons/document.gif','Microsoft Excel Spreadsheet');
INSERT INTO sitellite_mime_type VALUES ('rtf','binary','pix/icons/document.gif','Rich Text Document');
INSERT INTO sitellite_mime_type VALUES ('pdf','binary','pix/icons/document.gif','Adobe Acrobat Document');
INSERT INTO sitellite_mime_type VALUES ('psd','binary','pix/icons/image.gif','Adobe Photoshop Image');
INSERT INTO sitellite_mime_type VALUES ('zip','binary','pix/icons/document.gif','Zipped Archive File');
INSERT INTO sitellite_mime_type VALUES ('gz','binary','pix/icons/document.gif','GZIP Archive File');
INSERT INTO sitellite_mime_type VALUES ('tar','binary','pix/icons/document.gif','TAR Archive File');
INSERT INTO sitellite_mime_type VALUES ('gzip','binary','pix/icons/document.gif','GZIP Archive File');
INSERT INTO sitellite_mime_type VALUES ('bz2','binary','pix/icons/document.gif','BZIP Archive File');
INSERT INTO sitellite_mime_type VALUES ('rpm','binary','pix/icons/document.gif','RedHat Package File');
INSERT INTO sitellite_mime_type VALUES ('tmp','ascii','pix/icons/document.gif','Temporary Data File');
INSERT INTO sitellite_mime_type VALUES ('mov','binary','pix/icons/video.gif','Apple QuickTime Video');
INSERT INTO sitellite_mime_type VALUES ('mpg','binary','pix/icons/video.gif','MPG Video File');
INSERT INTO sitellite_mime_type VALUES ('avi','binary','pix/icons/video.gif','AVI Video File');
INSERT INTO sitellite_mime_type VALUES ('cgi','ascii','pix/icons/document.gif','CGI Script');
INSERT INTO sitellite_mime_type VALUES ('shtml','ascii','pix/icons/document.gif','SSI Web Document');
INSERT INTO sitellite_mime_type VALUES ('m3u','ascii','pix/icons/audio.gif','MP3 Playlist');
INSERT INTO sitellite_mime_type VALUES ('exe','binary','pix/icons/document.gif','Executable Application');
INSERT INTO sitellite_mime_type VALUES ('dll','binary','pix/icons/document.gif','Application Extension');
INSERT INTO sitellite_mime_type VALUES ('pl','ascii','pix/icons/document.gif','Perl Script');
INSERT INTO sitellite_mime_type VALUES ('py','ascii','pix/icons/document.gif','Python Script');
INSERT INTO sitellite_mime_type VALUES ('rb','ascii','pix/icons/document.gif','Ruby Script');
INSERT INTO sitellite_mime_type VALUES ('conf','ascii','pix/icons/document.gif','Configuration File');
INSERT INTO sitellite_mime_type VALUES ('log','ascii','pix/icons/document.gif','Log File');
INSERT INTO sitellite_mime_type VALUES ('bat','ascii','pix/icons/document.gif','DOS Batch File');
INSERT INTO sitellite_mime_type VALUES ('tcl','ascii','pix/icons/document.gif','TCL Script');
INSERT INTO sitellite_mime_type VALUES ('htaccess','ascii','pix/icons/document.gif','HTTP Access Control File');
INSERT INTO sitellite_mime_type VALUES ('htpasswd','ascii','pix/icons/document.gif','HTTP Access Password File');
INSERT INTO sitellite_mime_type VALUES ('dtd','ascii','pix/icons/document.gif','XML Document Type Definition');
INSERT INTO sitellite_mime_type VALUES ('xsl','ascii','pix/icons/document.gif','XML Stylesheet');
INSERT INTO sitellite_mime_type VALUES ('swf','binary','pix/icons/image.gif','Shockwave Flash File');
INSERT INTO sitellite_mime_type VALUES ('spt','ascii','pix/icons/document.gif','Simple Template Document');

#
# Table structure for table 'sitellite_page'
#

CREATE TABLE sitellite_page (
  id varchar(72) NOT NULL default '',
  title varchar(128) NOT NULL default '',
  nav_title varchar(128) NOT NULL default '',
  head_title varchar(128) NOT NULL default '',
  below_page varchar(72) NOT NULL default '',
  is_section enum('no','yes') NOT NULL default 'no',
  template varchar(128) NOT NULL default '',
  sitellite_status varchar(32) NOT NULL default '',
  sitellite_access varchar(32) NOT NULL default '',
  sitellite_startdate datetime default NULL,
  sitellite_expirydate datetime default NULL,
  sitellite_owner varchar(48) NOT NULL default '',
  sitellite_team varchar(48) NOT NULL default '',
  external varchar(128) NOT NULL default '',
  include enum('yes','no') NOT NULL default 'yes',
  include_in_search enum('yes','no') NOT NULL default 'yes',
  sort_weight int not null,
  keywords text NOT NULL,
  description text NOT NULL,
  body mediumtext NOT NULL,
  PRIMARY KEY  (id),
  KEY viewed (below_page,sitellite_status,sitellite_access),
  FULLTEXT KEY title (title,keywords,description),
  KEY include (include, sort_weight)
) TYPE=MyISAM;

#
# Dumping data for table 'sitellite_page'
#


INSERT INTO sitellite_page VALUES ('index','Welcome to Sitellite!','Home','','','no','','approved','public',NULL,NULL,'admin','none','','yes','yes',10,'cms,content management,php cms,sitellite','Welcome to your new Sitellite installation.','    <p>\r\n      If you are reading this, it means that you have successfully\r\n      installed the Sitellite Content Management System (CMS), the\r\n      most powerful PHP-based platform for web content management\r\n      and application development. This is the example website that installs with the Sitellite CMS. It is meant to provide an introduction to the system and to help you take the next steps towards getting a real website running with Sitellite.\r\n    </p>\r\n<p>To begin editing your website, enter the username \"admin\" and the password you chose during installation into the box on the left, and the full Sitellite interface will appear. You can also log in by going to \"www.example.com/sitellite\" on your website.<br />\r\n\r\n    </p>\r\n\r\n    <p>\r\n      We hope you enjoy your tour of Sitellite.\r\n    </p>\r\n\r\n    <p>\r\n      -- The Simian Team\r\n    </p>\r\n\r\n');
#INSERT INTO sitellite_page VALUES ('about-sitellite','Benefits','','','','no','','approved','public',NULL,NULL,'admin','none','','yes','yes',0,'','','\r\n  \r\n  <h2>\r\n    User Benefits\r\n    <br />\r\n\r\n  </h2>\r\n\r\n  <ul>\r\n    \r\n    <li>\r\n      Cross-browser, cross-platform \r\n      <strong>\r\n        WYSIWYG\r\n      </strong>\r\nediting enables site owners to make changes on their own, instead of\r\ncalling their service provider for simple HTML edits. </li>\r\n\r\n    <li>\r\n      \r\n      <strong>\r\n        Full Web Page Versioning\r\n      </strong>\r\n      \r\n        : All deleted and changed pages are stored in the database and can be restored with a simple mouse click. \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      Edits can be made from \r\n      <strong>\r\n        any browser, anywhere in the world.\r\n      </strong>\r\n    </li>\r\n\r\n    <li>\r\n      \r\n      <strong>\r\n        Automated navigation\r\n      </strong>\r\n      \r\n         (section menus, site\r\n\r\n      \r\n      \r\n        maps, breadcrumbs, the fastest cross browser compatible drop menus\r\n\r\n      \r\n      \r\n        available) means that sites can be completely maintained by their\r\n\r\n      \r\n      \r\n        owners, even when pages are added or removed. \r\n      \r\n    </li>\r\n\r\n    <li>\r\n      User based Authentication and Workflow with Writers,\r\nEditors, Viewers, and Administrators: Sitellite empowers organizations\r\nto give tailored access to different parts of the website to those who\r\nneed it, making\r\n      <strong>\r\n         web page editing safe and manageable\r\n      </strong>\r\n      \r\n        . \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      Sitellite\'s \r\n      <strong>\r\n        template driven site layouts \r\n      </strong>\r\n      \r\n        ensure\r\n\r\n      \r\n      \r\n        that single changes have global effects, maintaining consistency across\r\n\r\n      \r\n      \r\n        an entire site. Per-section and per-page template overiding even allows\r\n\r\n      \r\n      \r\n        for the creation of mini sites within a single domain. \r\n      \r\n    </li>\r\n\r\n  </ul>\r\n\r\n  <h2>\r\n    Developer Benefits\r\n  </h2>\r\n\r\n  <ul>\r\n    \r\n    <li>\r\n      A \r\n      <strong>\r\n        theme based administrative GUI\r\n      </strong>\r\n      \r\n         allows our partners to easily re-brand the administrative interface and create custom content based web applications. \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      \r\n      <strong>\r\n        Object Oriented application framework\r\n      </strong>\r\n      \r\n         with\r\n\r\n      \r\n      \r\n        over 100 packages, makes most programming tasks a cinch. Based on a\r\n\r\n      \r\n      \r\n        Java like class loading system that abstracts file and directory\r\n\r\n      \r\n      \r\n        locations. \r\n      \r\n    </li>\r\n\r\n    <li>\r\n      \r\n      <strong>\r\n        Built in documentation system\r\n      </strong>\r\n      \r\n         with hundreds of pages of tutorials with examples. Also documents your custom applications and actions. \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      \r\n      <strong>\r\n        Built in testing and benchmarking capabilities\r\n      </strong>\r\n      \r\n         using \r\n      \r\n      <em>\r\n        PHP-Unit\r\n      </em>\r\n      \r\n         and \r\n      \r\n      <em>\r\n        microbench\r\n      </em>\r\n      \r\n         ensures a high level of reliability in your custom application logic. \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      \r\n      <strong>\r\n        App-based administrative GUI \r\n      </strong>\r\n      \r\n        can quickly be extended to add custom components. Additional apps can be installed from \r\n      \r\n      <a href=\"http://www.simian.ca/\">\r\n        simian.ca\r\n      </a>\r\n      \r\n         and \r\n      \r\n      <a href=\"http://sitellite.org\" target=\"_blank\">\r\n        sitellite.org\r\n      </a>\r\n      \r\n        . \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      Advanced box metaphor is used to separate front end code from display and content elements. This promotes \r\n      <strong>\r\n        Model-View-Controller design \r\n      </strong>\r\n      \r\n        methods, and helps to maintain clean and organized code. \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      Form creation, validation, and processing using a widget based system with almost\r\n      <strong>\r\n         40 custom widgets\r\n      </strong>\r\n      \r\n        ! \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      Manuals, tutorials, community interaction, and even promotional opportunities at \r\n      <a href=\"http://www.sitellite.org/\">\r\n        http://www.sitellite.org/\r\n      </a>\r\n      <br />\r\n\r\n    </li>\r\n\r\n    <li>\r\n      Sitellite is \r\n      <a href=\"http://www.sitellite.org/index/license\">\r\n        licensed\r\n      </a>\r\n      \r\n         under the GNU GPL and LGPL, with \r\n      \r\n      <a href=\"http://www.simian.ca/\">\r\n        commercial versions available\r\n      </a>\r\n, providing developers with the freedom and flexibility they need to\r\ncreate next-generation PHP and web-based applications. </li>\r\n\r\n  </ul>\r\n\r\n  <strong>\r\n    Sitellite\r\n  </strong>\r\n  \r\n     is hands down the best PHP and Open Source CMS in existence.\r\n  \r\n  <br />\r\n\r\n');
#INSERT INTO sitellite_page VALUES ('examples','Examples','','','','no','','approved','public',NULL,NULL,'admin','none','','yes','yes',0,'','','  \r\n  <p>\r\n    Here is a list of examples that illustrate some of the many things developers can do with Sitellite. These code samples are intended to show actual running working code that you can inspect to see how different things are done at the code level. For more code examples, please take a look at the <a href=\"http://www.sitellite.org/index/docs\">Sitellite.org documentation</a> area which includes free courses, tutorials, API references, and a 100+ page cookbook.\r\n  </p>\r\n\r\n  <xt-box alt=\"example/list\" title=\"example/list\" name=\"example/list\"></xt-box>\r\n\r\n<p></p>\r\n\r\n');
INSERT INTO sitellite_page VALUES ('sitemap','Site Map','','','','no','','approved','public',NULL,NULL,'admin','none','/index/sitellite-nav-sitemap-action','yes','no',0,'','','<br />\r\n');
INSERT INTO sitellite_page VALUES ('next','What Comes Next?','','','','no','','approved','public',NULL,NULL,'admin','none','','yes','yes',0,'','','\r\n  \r\n  <p>\r\n    Now that you\'ve successfully installed the Sitellite CMS, and had a chance to play with it a little, you\'re probably\r\nwondering: Where do I go from here?\r\n  </p>\r\n\r\n  <p>\r\n    Don\'t worry.  We\'ve prepared a short list for you, which should help you get started as fast as possible.\r\n  </p>\r\n\r\n  <h2>\r\n    \r\n    <a target=\"_blank\" href=\"http://www.sitellite.org/\">\r\n      Visit Sitellite.org\r\n    </a>\r\n  </h2>\r\n\r\n  <p>\r\n    This is the official home of Sitellite, where you can find such resources as:\r\n  </p>\r\n\r\n  <ul>\r\n    \r\n    <li>\r\n      The complete Sitellite User Manual,\r\ncontaining many pages of professional end-user documentation and step-by-step\r\nintroductory examples.\r\n    </li>\r\n\r\n    <li>Tutorials, courses, and more for designers and developers build great websites using Sitellite. Experience levels for tutorials range from beginner to expert.\r\n    </li>\r\n\r\n    <li>\r\n      Product news &amp; announcements, so you\'ll know exactly when new releases and new Sitellite developments happen.\r\n    </li>\r\n\r\n    <li>\r\n      Discussion\r\nforums, where you can join in active conversation with other Sitellite users, to get answers fast or just to share ideas.\r\n    </li>\r\n\r\n    <li>\r\n      User-contributed tools and 3rd-party products that enhance the capabilities of Sitellite in ever-expanding new ways.\r\n    </li>\r\n\r\n  </ul>\r\n\r\n  <h2>\r\n    \r\n    <a target=\"_blank\" href=\"http://www.simian.ca/\">\r\n      Visit Simian Systems\r\n    </a>\r\n  </h2>\r\n\r\n  <p>\r\n    We\'re the company behind Sitellite, here to provide you with a vast\r\narray of services and specialized products and add-ons for Sitellite,\r\nincluding:\r\n  </p>\r\n\r\n  <ul><li>Business-hour or 24x7 support packages.\r\n    </li>\r\n\r\n    <li>\r\n      Training on topics such as Sitellite, Content Management, Linux/Apache/MySQL/PHP, Web Application Security, Web Standards, and more.\r\n    </li>\r\n\r\n    <li>\r\n      Customization and development services -- who better to help you develop your next killer app than the folks who wrote the platform?</li>\r\n<li>\r\n      Commercial\r\nlicenses of the Sitellite Content Manager, as well as an Enterprise\r\nEdition, for resellers and application developers who do not want their\r\ncustom apps and add-ons to be restricted by the GPL licensing terms.</li>\r\n<li>And more.<br />\r\n</li>\r\n</ul>\r\n\r\n');
INSERT INTO sitellite_page VALUES ('getting-started','Getting Started','','','','no','','approved','public',NULL,NULL,'admin','none','','yes','yes',5,'','','Now that you have successfully installed Sitellite, your next step is to log in as an administrator and get acquainted with the software. To log, either enter your administrator\'s username and password into the Members form on the side, or you can access the administrator login by adding \"/sitellite\" to your website address, which will take you there.<br />\r\n\r\n<br />\r\n\r\nWhen you first install Sitellite, the first username is \"admin\" and the password is whatever you had specified during the installation procedure.<br />\r\n\r\n<h2>Web View</h2>\r\n\r\nThe Web View is the first place you\'ll see once you log into Sitellite. This is a view of your website (in this case, the Sitellite example website) with the addition of little buttons in various spots on the page. These buttons are used to edit the contents of a given section of a page, such as the main body or the sidebar text.<br />\r\n\r\n<br />\r\n\r\nIn the order they appear, the buttons are used to:<br />\r\n\r\n<ul><li>Add new content</li>\r\n\r\n<li>Edit this content</li>\r\n\r\n<li>View any previous changes for this content</li>\r\n\r\n<li>Delete this content</li>\r\n\r\n</ul>\r\n\r\nThe Web View makes it as easy as browsing your website to make changes to it, by making the website itself your means of accessing the content you want to change. But sometimes you will need to edit content that is not visible on your website, such as a file that\'s not linked to yet. For this Sitellite offers a secondary view called the Control Panel.<br />\r\n\r\n<h2>Control Panel</h2>\r\n\r\nThe Control Panel provides access to all of the features of Sitellite. Its main components are three menus named Content, Admin, and Tools, an Inbox, and Bookmarks.<br />\r\n\r\n<br />\r\n\r\nThe Content menu allows you to browse and search for content by type. First you select the content type from the list and Sitellite shows you a list of content of that type. From here you can find specific content by using the available search parameters.<br />\r\n\r\n<br />\r\n\r\nThe Admin menu provides access to all of the administrative features of Sitellite, such as managing user accounts and website settings. Note that any item in any of the menus can be restricted from less privileged users, so only the appropriate user account will be able to create new user accounts.<br />\r\n\r\n<br />\r\n\r\nThe Tools menu provides a list of installed modules or add-ons and allows you to access them all at the click of your mouse. These tools could include any of the free or professional edition add-ons.<br />\r\n\r\n<br />\r\n\r\nBelow the menus, the Inbox provides an internal messaging system for sending messages between users of the system. The Inbox can also be made to automatically forward emails to your external email address.<br />\r\n\r\n<br />\r\n\r\nThe Bookmarks are a list of saved searches for content under the Content menu. They allow you to repeat past searches without going through the steps of entering each search term or parameter again each time.<br />\r\n\r\n');
#INSERT INTO sitellite_page VALUES ('user-manual','User Manual (PDF)','','','','no','','approved','public',NULL,NULL,'admin','development','http://www.sitellite.org/inc/app/org/downloads/sitellite-4.2-user-manual.pdf','yes','yes',4,'','','<br />\r\n');

#
# Table structure for table 'sitellite_sidebar'
#

CREATE TABLE sitellite_sidebar (
  id varchar(32) NOT NULL default '',
  title varchar(72) NOT NULL default '',
  position varchar(32) NOT NULL default 'left',
  sorting_weight int(11) NOT NULL default '0',
  show_on_pages tinytext NOT NULL,
  alias varchar(255) NOT NULL,
  sitellite_status varchar(32) NOT NULL default '',
  sitellite_access varchar(32) NOT NULL default '',
  sitellite_startdate datetime default NULL,
  sitellite_expirydate datetime default NULL,
  sitellite_owner varchar(48) NOT NULL default '',
  sitellite_team varchar(48) NOT NULL default '',
  body text NOT NULL,
  PRIMARY KEY  (id),
  KEY side (position,sorting_weight,show_on_pages(255))
) TYPE=MyISAM;

#
# Dumping data for table `sitellite_sidebar`
#

INSERT INTO sitellite_sidebar VALUES ('members','Members','left',1,'all','sitemember/sidebar','approved','public',NULL,NULL,'admin','none','<br />\r\n');
#INSERT INTO sitellite_sidebar VALUES ('main_menu','Main Menu','left',0,'all','sitellite/nav/common','approved','public',NULL,NULL,'admin','none','<br />\r\n');
#INSERT INTO sitellite_sidebar VALUES ('support','Got any questions?','left',0,'','','approved','public',NULL,NULL,'admin','development','Email us at <a href=\"mailto:info@simian.ca\">info@simian.ca</a> or call 1-204-221-6837 between 9am and 5pm CST Mon-Fri<br />\r\n');

#
# Table structure for table 'sitellite_sidebar_position'
#

CREATE TABLE sitellite_sidebar_position (
  id varchar(32) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

#
# Dumping data for table 'sitellite_sidebar_position'
#

INSERT INTO sitellite_sidebar_position VALUES ('left');
INSERT INTO sitellite_sidebar_position VALUES ('right');

#
# Table structure for table 'sitellite_user'
#

CREATE TABLE sitellite_user (
  username varchar(48) NOT NULL default '',
  password varchar(16) NOT NULL default '',
  firstname varchar(32) NOT NULL default '',
  lastname varchar(32) NOT NULL default '',
  email varchar(42) NOT NULL default '',
  role varchar(32) NOT NULL default '',
  team varchar(32) NOT NULL default '',
  disabled enum('no','yes') NOT NULL default 'no',
  tips enum('on','off') NOT NULL default 'on',
  lang varchar(12) NOT NULL default '',
  session_id varchar(32) default NULL,
  expires timestamp(14) NOT NULL,
  company varchar(48) NOT NULL default '',
  position varchar(48) NOT NULL default '',
  website varchar(72) NOT NULL default '',
  jabber_id varchar(48) NOT NULL default '',
  sms_address varchar(72) NOT NULL default '',
  phone varchar(24) NOT NULL default '',
  cell varchar(24) NOT NULL default '',
  home varchar(24) NOT NULL default '',
  fax varchar(24) NOT NULL default '',
  address1 varchar(72) NOT NULL default '',
  address2 varchar(72) NOT NULL default '',
  city varchar(48) NOT NULL default '',
  province varchar(48) NOT NULL default '',
  postal_code varchar(16) NOT NULL default '',
  country varchar(48) NOT NULL default '',
  teams char(255) NOT NULL default '',
  public enum('yes','no') not null default 'no',
  profile text not null,
  sig text not null,
  registered datetime not null,
  modified timestamp not null,
  PRIMARY KEY  (username),
  UNIQUE KEY session_id (session_id),
  KEY lastname (lastname,email,role,team,tips,lang,disabled),
  KEY public (public,registered,modified)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_user_session'
#

CREATE TABLE sitellite_user_session (
  username varchar(48) NOT NULL default '',
  session_id varchar(32) NOT NULL default '',
  expires timestamp(14) NOT NULL,
  PRIMARY KEY  (username, session_id)
);

#
# Dumping data for table 'sitellite_user'
#

INSERT INTO sitellite_user VALUES ('admin','gVCJufyO4/SPs','','','lux@simian.ca','master','development','no','off','en','04c59bba46f041a01cc5ca0e81daff32',20030707123530,'','','','','','','','','','','','','','','', 'a:1:{s:3:"all";s:2:"rw";}', 'no', '', '', now(), now());

#
# Table structure for table 'sitellite_prefs'
#

create table sitellite_prefs (
	id int not null auto_increment primary key,
	username char(32) not null default '',
	pref char(32) not null default '',
	value char(72) not null default '',
	index (username, pref)
);

#
# Table structure for table 'sitellite_page_sv'
#

CREATE TABLE sitellite_page_sv (
  sv_autoid int(11) NOT NULL auto_increment,
  sv_author varchar(48) NOT NULL default '',
  sv_action enum('created','modified','republished','replaced','restored','deleted','updated') NOT NULL default 'created',
  sv_revision datetime NOT NULL,
  sv_changelog text NOT NULL,
  sv_deleted enum('yes','no') NOT NULL default 'no',
  sv_current enum('yes','no') NOT NULL default 'yes',
  id varchar(72) NOT NULL default '',
  title varchar(128) NOT NULL default '',
  nav_title varchar(128) NOT NULL default '',
  head_title varchar(128) NOT NULL default '',
  below_page varchar(72) NOT NULL default '',
  is_section enum('no','yes') NOT NULL default 'no',
  template varchar(128) NOT NULL default '',
  sitellite_status varchar(32) NOT NULL default '',
  sitellite_access varchar(32) NOT NULL default '',
  sitellite_startdate datetime default NULL,
  sitellite_expirydate datetime default NULL,
  sitellite_owner varchar(48) NOT NULL default '',
  sitellite_team varchar(48) NOT NULL default '',
  external varchar(128) NOT NULL default '',
  include enum('yes','no') NOT NULL default 'yes',
  include_in_search enum('yes','no') NOT NULL default 'yes',
  sort_weight int not null,
  keywords text NOT NULL,
  description text NOT NULL,
  body mediumtext NOT NULL,
  PRIMARY KEY  (sv_autoid),
  KEY sv_author (sv_author,sv_action,sv_revision,sv_deleted,sv_current),
  KEY id (id)
) TYPE=MyISAM;

#
# Dumping data for table `sitellite_page_sv`
#

INSERT INTO sitellite_page_sv VALUES (1, 'admin', 'created', now(), '', 'no', 'yes', 'index','Welcome to Sitellite!','Home','','','no','','approved','public',NULL,NULL,'admin','none','','yes','yes',10,'cms,content management,php cms,sitellite','Welcome to your new Sitellite installation.','    <p>\r\n      If you are reading this, it means that you have successfully\r\n      installed the Sitellite Content Management System (CMS), the\r\n      most powerful PHP-based platform for web content management\r\n      and application development. This is the example website that installs with the Sitellite CMS. It is meant to provide an introduction to the system and to help you take the next steps towards getting a real website running with Sitellite.\r\n    </p>\r\n<p>To begin editing your website, enter the username \"admin\" and the password you chose during installation into the box on the left, and the full Sitellite interface will appear. You can also log in by going to \"www.example.com/sitellite\" on your website.<br />\r\n\r\n    </p>\r\n\r\n    <p>\r\n      We hope you enjoy your tour of Sitellite.\r\n    </p>\r\n\r\n    <p>\r\n      -- The Simian Team\r\n    </p>\r\n\r\n');
#INSERT INTO sitellite_page_sv VALUES (2, 'admin', 'created', now(), '', 'no', 'yes', 'about-sitellite','Benefits','','','','no','','approved','public',NULL,NULL,'admin','none','','yes','yes',0,'','','\r\n  \r\n  <h2>\r\n    User Benefits\r\n    <br />\r\n\r\n  </h2>\r\n\r\n  <ul>\r\n    \r\n    <li>\r\n      Cross-browser, cross-platform \r\n      <strong>\r\n        WYSIWYG\r\n      </strong>\r\nediting enables site owners to make changes on their own, instead of\r\ncalling their service provider for simple HTML edits. </li>\r\n\r\n    <li>\r\n      \r\n      <strong>\r\n        Full Web Page Versioning\r\n      </strong>\r\n      \r\n        : All deleted and changed pages are stored in the database and can be restored with a simple mouse click. \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      Edits can be made from \r\n      <strong>\r\n        any browser, anywhere in the world.\r\n      </strong>\r\n    </li>\r\n\r\n    <li>\r\n      \r\n      <strong>\r\n        Automated navigation\r\n      </strong>\r\n      \r\n         (section menus, site\r\n\r\n      \r\n      \r\n        maps, breadcrumbs, the fastest cross browser compatible drop menus\r\n\r\n      \r\n      \r\n        available) means that sites can be completely maintained by their\r\n\r\n      \r\n      \r\n        owners, even when pages are added or removed. \r\n      \r\n    </li>\r\n\r\n    <li>\r\n      User based Authentication and Workflow with Writers,\r\nEditors, Viewers, and Administrators: Sitellite empowers organizations\r\nto give tailored access to different parts of the website to those who\r\nneed it, making\r\n      <strong>\r\n         web page editing safe and manageable\r\n      </strong>\r\n      \r\n        . \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      Sitellite\'s \r\n      <strong>\r\n        template driven site layouts \r\n      </strong>\r\n      \r\n        ensure\r\n\r\n      \r\n      \r\n        that single changes have global effects, maintaining consistency across\r\n\r\n      \r\n      \r\n        an entire site. Per-section and per-page template overiding even allows\r\n\r\n      \r\n      \r\n        for the creation of mini sites within a single domain. \r\n      \r\n    </li>\r\n\r\n  </ul>\r\n\r\n  <h2>\r\n    Developer Benefits\r\n  </h2>\r\n\r\n  <ul>\r\n    \r\n    <li>\r\n      A \r\n      <strong>\r\n        theme based administrative GUI\r\n      </strong>\r\n      \r\n         allows our partners to easily re-brand the administrative interface and create custom content based web applications. \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      \r\n      <strong>\r\n        Object Oriented application framework\r\n      </strong>\r\n      \r\n         with\r\n\r\n      \r\n      \r\n        over 100 packages, makes most programming tasks a cinch. Based on a\r\n\r\n      \r\n      \r\n        Java like class loading system that abstracts file and directory\r\n\r\n      \r\n      \r\n        locations. \r\n      \r\n    </li>\r\n\r\n    <li>\r\n      \r\n      <strong>\r\n        Built in documentation system\r\n      </strong>\r\n      \r\n         with hundreds of pages of tutorials with examples. Also documents your custom applications and actions. \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      \r\n      <strong>\r\n        Built in testing and benchmarking capabilities\r\n      </strong>\r\n      \r\n         using \r\n      \r\n      <em>\r\n        PHP-Unit\r\n      </em>\r\n      \r\n         and \r\n      \r\n      <em>\r\n        microbench\r\n      </em>\r\n      \r\n         ensures a high level of reliability in your custom application logic. \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      \r\n      <strong>\r\n        App-based administrative GUI \r\n      </strong>\r\n      \r\n        can quickly be extended to add custom components. Additional apps can be installed from \r\n      \r\n      <a href=\"http://www.simian.ca/\">\r\n        simian.ca\r\n      </a>\r\n      \r\n         and \r\n      \r\n      <a href=\"http://sitellite.org\" target=\"_blank\">\r\n        sitellite.org\r\n      </a>\r\n      \r\n        . \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      Advanced box metaphor is used to separate front end code from display and content elements. This promotes \r\n      <strong>\r\n        Model-View-Controller design \r\n      </strong>\r\n      \r\n        methods, and helps to maintain clean and organized code. \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      Form creation, validation, and processing using a widget based system with almost\r\n      <strong>\r\n         40 custom widgets\r\n      </strong>\r\n      \r\n        ! \r\n\r\n      \r\n    </li>\r\n\r\n    <li>\r\n      Manuals, tutorials, community interaction, and even promotional opportunities at \r\n      <a href=\"http://www.sitellite.org/\">\r\n        http://www.sitellite.org/\r\n      </a>\r\n      <br />\r\n\r\n    </li>\r\n\r\n    <li>\r\n      Sitellite is \r\n      <a href=\"http://www.sitellite.org/index/license\">\r\n        licensed\r\n      </a>\r\n      \r\n         under the GNU GPL and LGPL, with \r\n      \r\n      <a href=\"http://www.simian.ca/\">\r\n        commercial versions available\r\n      </a>\r\n, providing developers with the freedom and flexibility they need to\r\ncreate next-generation PHP and web-based applications. </li>\r\n\r\n  </ul>\r\n\r\n  <strong>\r\n    Sitellite\r\n  </strong>\r\n  \r\n     is hands down the best PHP and Open Source CMS in existence.\r\n  \r\n  <br />\r\n\r\n');
#INSERT INTO sitellite_page_sv VALUES (3, 'admin', 'created', now(), '', 'no', 'yes', 'examples','Examples','','','','no','','approved','public',NULL,NULL,'admin','none','','yes','yes',0,'','','  \r\n  <p>\r\n    Here is a list of examples that illustrate some of the many things developers can do with Sitellite. These code samples are intended to show actual running working code that you can inspect to see how different things are done at the code level. For more code examples, please take a look at the <a href=\"http://www.sitellite.org/index/docs\">Sitellite.org documentation</a> area which includes free courses, tutorials, API references, and a 100+ page cookbook.\r\n  </p>\r\n\r\n  <xt-box alt=\"example/list\" title=\"example/list\" name=\"example/list\"></xt-box>\r\n\r\n<p></p>\r\n\r\n');
INSERT INTO sitellite_page_sv VALUES (4, 'admin', 'created', now(), '', 'no', 'yes', 'sitemap','Site Map','','','','no','','approved','public',NULL,NULL,'admin','none','/index/sitellite-nav-sitemap-action','yes','no',0,'','','<br />\r\n');
INSERT INTO sitellite_page_sv VALUES (5, 'admin', 'created', now(), '', 'no', 'yes', 'next','What Comes Next?','','','','no','','approved','public',NULL,NULL,'admin','none','','yes','yes',0,'','','\r\n  \r\n  <p>\r\n    Now that you\'ve successfully installed the Sitellite CMS, and had a chance to play with it a little, you\'re probably\r\nwondering: Where do I go from here?\r\n  </p>\r\n\r\n  <p>\r\n    Don\'t worry.  We\'ve prepared a short list for you, which should help you get started as fast as possible.\r\n  </p>\r\n\r\n  <h2>\r\n    \r\n    <a target=\"_blank\" href=\"http://www.sitellite.org/\">\r\n      Visit Sitellite.org\r\n    </a>\r\n  </h2>\r\n\r\n  <p>\r\n    This is the official home of Sitellite, where you can find such resources as:\r\n  </p>\r\n\r\n  <ul>\r\n    \r\n    <li>\r\n      The complete Sitellite User Manual,\r\ncontaining many pages of professional end-user documentation and step-by-step\r\nintroductory examples.\r\n    </li>\r\n\r\n    <li>Tutorials, courses, and more for designers and developers build great websites using Sitellite. Experience levels for tutorials range from beginner to expert.\r\n    </li>\r\n\r\n    <li>\r\n      Product news &amp; announcements, so you\'ll know exactly when new releases and new Sitellite developments happen.\r\n    </li>\r\n\r\n    <li>\r\n      Discussion\r\nforums, where you can join in active conversation with other Sitellite users, to get answers fast or just to share ideas.\r\n    </li>\r\n\r\n    <li>\r\n      User-contributed tools and 3rd-party products that enhance the capabilities of Sitellite in ever-expanding new ways.\r\n    </li>\r\n\r\n  </ul>\r\n\r\n  <h2>\r\n    \r\n    <a target=\"_blank\" href=\"http://www.simian.ca/\">\r\n      Visit Simian Systems\r\n    </a>\r\n  </h2>\r\n\r\n  <p>\r\n    We\'re the company behind Sitellite, here to provide you with a vast\r\narray of services and specialized products and add-ons for Sitellite,\r\nincluding:\r\n  </p>\r\n\r\n  <ul><li>Business-hour or 24x7 support packages.\r\n    </li>\r\n\r\n    <li>\r\n      Training on topics such as Sitellite, Content Management, Linux/Apache/MySQL/PHP, Web Application Security, Web Standards, and more.\r\n    </li>\r\n\r\n    <li>\r\n      Customization and development services -- who better to help you develop your next killer app than the folks who wrote the platform?</li>\r\n<li>\r\n      Commercial\r\nlicenses of the Sitellite Content Manager, as well as an Enterprise\r\nEdition, for resellers and application developers who do not want their\r\ncustom apps and add-ons to be restricted by the GPL licensing terms.</li>\r\n<li>And more.<br />\r\n</li>\r\n</ul>\r\n\r\n');
INSERT INTO sitellite_page_sv VALUES (6, 'admin', 'created', now(), '', 'no', 'yes', 'getting-started','Getting Started','','','','no','','approved','public',NULL,NULL,'admin','none','','yes','yes',5,'','','Now that you have successfully installed Sitellite, your next step is to log in as an administrator and get acquainted with the software. To log, either enter your administrator\'s username and password into the Members form on the side, or you can access the administrator login by adding \"/sitellite\" to your website address, which will take you there.<br />\r\n\r\n<br />\r\n\r\nWhen you first install Sitellite, the first username is \"admin\" and the password is whatever you had specified during the installation procedure.<br />\r\n\r\n<h2>Web View</h2>\r\n\r\nThe Web View is the first place you\'ll see once you log into Sitellite. This is a view of your website (in this case, the Sitellite example website) with the addition of little buttons in various spots on the page. These buttons are used to edit the contents of a given section of a page, such as the main body or the sidebar text.<br />\r\n\r\n<br />\r\n\r\nIn the order they appear, the buttons are used to:<br />\r\n\r\n<ul><li>Add new content</li>\r\n\r\n<li>Edit this content</li>\r\n\r\n<li>View any previous changes for this content</li>\r\n\r\n<li>Delete this content</li>\r\n\r\n</ul>\r\n\r\nThe Web View makes it as easy as browsing your website to make changes to it, by making the website itself your means of accessing the content you want to change. But sometimes you will need to edit content that is not visible on your website, such as a file that\'s not linked to yet. For this Sitellite offers a secondary view called the Control Panel.<br />\r\n\r\n<h2>Control Panel</h2>\r\n\r\nThe Control Panel provides access to all of the features of Sitellite. Its main components are three menus named Content, Admin, and Tools, an Inbox, and Bookmarks.<br />\r\n\r\n<br />\r\n\r\nThe Content menu allows you to browse and search for content by type. First you select the content type from the list and Sitellite shows you a list of content of that type. From here you can find specific content by using the available search parameters.<br />\r\n\r\n<br />\r\n\r\nThe Admin menu provides access to all of the administrative features of Sitellite, such as managing user accounts and website settings. Note that any item in any of the menus can be restricted from less privileged users, so only the appropriate user account will be able to create new user accounts.<br />\r\n\r\n<br />\r\n\r\nThe Tools menu provides a list of installed modules or add-ons and allows you to access them all at the click of your mouse. These tools could include any of the free or professional edition add-ons.<br />\r\n\r\n<br />\r\n\r\nBelow the menus, the Inbox provides an internal messaging system for sending messages between users of the system. The Inbox can also be made to automatically forward emails to your external email address.<br />\r\n\r\n<br />\r\n\r\nThe Bookmarks are a list of saved searches for content under the Content menu. They allow you to repeat past searches without going through the steps of entering each search term or parameter again each time.<br />\r\n\r\n');
#INSERT INTO sitellite_page_sv VALUES (7, 'admin', 'created', now(), '', 'no', 'yes', 'user-manual','User Manual (PDF)','','','','no','','approved','public',NULL,NULL,'admin','development','http://www.sitellite.org/inc/app/org/downloads/sitellite-4.2-user-manual.pdf','yes','yes',4,'','','<br />\r\n');

#
# Table structure for table 'sitellite_sidebar_sv'
#

CREATE TABLE sitellite_sidebar_sv (
  sv_autoid int(11) NOT NULL auto_increment,
  sv_author varchar(32) NOT NULL default '',
  sv_action enum('created','modified','republished','replaced','restored','deleted','updated') NOT NULL default 'created',
  sv_revision datetime NOT NULL,
  sv_changelog text NOT NULL,
  sv_deleted enum('yes','no') NOT NULL default 'no',
  sv_current enum('yes','no') NOT NULL default 'yes',
  id varchar(32) NOT NULL default '',
  title varchar(72) NOT NULL default '',
  position varchar(32) NOT NULL default 'left',
  sorting_weight int(11) NOT NULL default '0',
  show_on_pages tinytext NOT NULL,
  alias varchar(255) NOT NULL,
  sitellite_status varchar(32) NOT NULL default '',
  sitellite_access varchar(32) NOT NULL default '',
  sitellite_startdate datetime default NULL,
  sitellite_expirydate datetime default NULL,
  sitellite_owner varchar(48) NOT NULL default '',
  sitellite_team varchar(48) NOT NULL default '',
  body text NOT NULL,
  PRIMARY KEY  (sv_autoid),
  KEY sv_author (sv_author,sv_action,sv_revision,sv_deleted,sv_current),
  KEY id (id)
) TYPE=MyISAM;

#
# Dumping data for table `sitellite_sidebar_sv`
#

INSERT INTO sitellite_sidebar_sv VALUES (1, 'admin', 'created', now(), '', 'no', 'yes', 'members','Members','left',1,'all','sitemember/sidebar','approved','public',NULL,NULL,'admin','none','<br />\r\n');
#INSERT INTO sitellite_sidebar_sv VALUES (2, 'admin', 'created', now(), '', 'no', 'yes', 'main_menu','Main Menu','left',0,'all','sitellite/nav/common','approved','public',NULL,NULL,'admin','none','<br />\r\n');
#INSERT INTO sitellite_sidebar_sv VALUES (3, 'admin', 'created', now(), '', 'no', 'yes', 'support','Got any questions?','left',0,'','','approved','public',NULL,NULL,'admin','development','Email us at <a href=\"mailto:info@simian.ca\">info@simian.ca</a> or call 1-204-221-6837 between 9am and 5pm CST Mon-Fri<br />\r\n');

#
# Table structure for table 'sitellite_keywords'
#

CREATE TABLE sitellite_keyword (
	word char(72) NOT NULL,
	PRIMARY KEY (word)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_message'
#

CREATE TABLE sitellite_message (
  id int(11) NOT NULL auto_increment,
  subject varchar(128) NOT NULL default '',
  msg_date datetime NOT NULL default '0000-00-00 00:00:00',
  from_user varchar(72) NOT NULL default '',
  priority enum('normal','high','urgent') NOT NULL default 'normal',
  response_id int(11) default NULL,
  body text NOT NULL,
  PRIMARY KEY  (id),
  KEY msg_date (msg_date,from_user,priority,response_id),
  FULLTEXT KEY subject (subject,body)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_msg_queue'
#

CREATE TABLE sitellite_msg_queue (
  id int(11) NOT NULL auto_increment,
  type char(32) NOT NULL default '',
  struct text NOT NULL default '',
  PRIMARY KEY  (id),
  KEY type (type)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_msg_attachment'
#

CREATE TABLE sitellite_msg_attachment (
  id int(11) NOT NULL auto_increment,
  type enum('database','filesystem','link','document','search') NOT NULL default 'database',
  name varchar(255) NOT NULL default '',
  message_id int(11) NOT NULL default '0',
  summary varchar(128) NOT NULL default '',
  body blob NOT NULL,
  mimetype varchar(32) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY name (type,name,message_id)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_msg_category'
#

CREATE TABLE sitellite_msg_category (
  name varchar(72) NOT NULL default '',
  user varchar(32) NOT NULL default '',
  PRIMARY KEY  (name,user)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_msg_forward'
#

CREATE TABLE sitellite_msg_forward (
  id int(11) NOT NULL auto_increment,
  user varchar(32) NOT NULL default '',
  location enum('email','jabber','sms') NOT NULL default 'email',
  info varchar(72) NOT NULL default '',
  priority enum('all','normal','high','urgent') NOT NULL default 'all',
  PRIMARY KEY  (id),
  KEY user (user,priority)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_msg_recipient'
#

CREATE TABLE sitellite_msg_recipient (
  id int(11) NOT NULL auto_increment,
  type enum('user','email') NOT NULL default 'user',
  user varchar(72) NOT NULL default '',
  message_id int(11) NOT NULL default '0',
  category varchar(72) NOT NULL default '',
  status enum('unread','read','trash') NOT NULL default 'unread',
  PRIMARY KEY  (id),
  KEY type (type,user,message_id,category),
  KEY status (status)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_bookmark'
#

CREATE TABLE sitellite_bookmark (
	id int(11) NOT NULL auto_increment,
	user varchar(72) NOT NULL default '',
	link varchar(255) NOT NULL default '',
	name varchar(72) NOT NULL default '',
	PRIMARY KEY  (id),
	KEY user (user,link)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_lock'
#

CREATE TABLE sitellite_lock (
	id int(11) NOT NULL auto_increment,
	user varchar(72) NOT NULL default '',
	resource varchar(72) NOT NULL default '',
	resource_id varchar(72) NOT NULL default '',
	expires datetime NOT NULL,
	created datetime not null,
	modified datetime not null,
	token char(128) not null default '',
	PRIMARY KEY  (id),
	index (user, resource, resource_id, expires)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_undo_sv'
#

CREATE TABLE sitellite_undo_sv (
  sv_autoid int(11) NOT NULL auto_increment,
  sv_author varchar(48) NOT NULL default '',
  sv_action enum('created','modified','republished','replaced','restored','deleted','updated') NOT NULL default 'created',
  sv_revision datetime NOT NULL,
  sv_changelog text NOT NULL,
  sv_deleted enum('yes','no') NOT NULL default 'no',
  sv_current enum('yes','no') NOT NULL default 'yes',
  id varchar(72) NOT NULL default '',
  body text NOT NULL default '',
  PRIMARY KEY  (sv_autoid),
  KEY sv_author (sv_author,sv_action,sv_revision,sv_deleted,sv_current),
  KEY id (id)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_news'
#

create table sitellite_news (
	id int not null auto_increment primary key,
	title char(128) not null,
	date date not null,
	time time not null,
	rank int not null,
	author char(72) not null,
	category char(48) not null,
	summary text not null,
	sitellite_status varchar(32) NOT NULL default '',
	sitellite_access varchar(32) NOT NULL default '',
	sitellite_startdate datetime default NULL,
	sitellite_expirydate datetime default NULL,
	sitellite_owner varchar(48) NOT NULL default '',
	sitellite_team varchar(48) NOT NULL default '',
	body text not null,
	thumb char(128) not null,
	index (date, time, rank, category, sitellite_status, sitellite_access),
	fulltext (title, summary, body)
) TYPE=MyISAM;

#
# Table structure for table 'sitellite_news_category'
#

create table sitellite_news_category (
	name char(48) not null primary key
);

#
# Table structure for table 'sitellite_news_author'
#

create table sitellite_news_author (
	name char(72) not null primary key
);

#
# Table structure for table 'sitellite_news_sv'
#

create table sitellite_news_sv (
	sv_autoid int not null auto_increment primary key,
	sv_author varchar(48) NOT NULL default '',
	sv_action enum('created','modified','republished','replaced','restored','deleted','updated') NOT NULL default 'created',
	sv_revision datetime NOT NULL,
	sv_changelog text NOT NULL,
	sv_deleted enum('yes','no') not null default 'no',
	sv_current enum('yes','no') not null default 'yes',
	id int not null,
	title char(128) not null,
	date date not null,
	time time not null,
	rank int not null,
	author char(72) not null,
	category char(48) not null,
	summary text not null,
	sitellite_status varchar(32) NOT NULL default '',
	sitellite_access varchar(32) NOT NULL default '',
	sitellite_startdate datetime default NULL,
	sitellite_expirydate datetime default NULL,
	sitellite_owner varchar(48) NOT NULL default '',
	sitellite_team varchar(48) NOT NULL default '',
	body text not null,
	thumb char(128) not null,
	index (sv_author, sv_action, sv_revision, sv_deleted, sv_current),
	index (date, time, rank)
);

#
# Table structure for table 'sitellite_news_comment'
#

create table sitellite_news_comment (
	id int not null auto_increment primary key,
	story_id int not null,
	user_id char(48) not null,
	ts datetime not null,
	subject char(128) not null,
	body text not null,
	index (story_id, user_id, ts)
);

#
# Table structure for table `sitellite_filesystem`
#

CREATE TABLE `sitellite_filesystem` (
  `name` varchar(72) NOT NULL default '',
  `path` varchar(176) NOT NULL default '',
  `extension` varchar(12) NOT NULL default '',
  `display_title` varchar(72) NOT NULL default '',
  `sitellite_status` varchar(32) NOT NULL default '',
  `sitellite_access` varchar(32) NOT NULL default '',
  `sitellite_owner` varchar(48) NOT NULL default '',
  `sitellite_team` varchar(48) NOT NULL default '',
  `filesize` int(11) NOT NULL default '0',
  `last_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_created` datetime NOT NULL default '0000-00-00 00:00:00',
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`name`,`path`,`extension`),
  KEY `collection` (`sitellite_status`,`sitellite_access`,`filesize`,`last_modified`,`date_created`)
) TYPE=MyISAM;

#
# Dumping data for table `sitellite_filesystem`
#

# --------------------------------------------------------

#
# Table structure for table `sitellite_filesystem_sv`
#

CREATE TABLE `sitellite_filesystem_sv` (
  `sv_autoid` int(11) NOT NULL auto_increment,
  `sv_author` varchar(32) NOT NULL default '',
  `sv_action` enum('created','modified','republished','replaced','restored','deleted','updated') NOT NULL default 'created',
  `sv_revision` datetime NOT NULL,
  `sv_changelog` text NOT NULL,
  `sv_deleted` enum('yes','no') default 'no',
  `sv_current` enum('yes','no') default 'yes',
  `name` varchar(255) NOT NULL default '',
  `display_title` varchar(72) NOT NULL default '',
  `sitellite_status` varchar(32) NOT NULL default '',
  `sitellite_access` varchar(32) NOT NULL default '',
  `sitellite_owner` varchar(48) NOT NULL default '',
  `sitellite_team` varchar(48) NOT NULL default '',
  `filesize` int(11) NOT NULL default '0',
  `last_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `body` blob NOT NULL,
  `date_created` datetime NOT NULL default '0000-00-00 00:00:00',
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`sv_autoid`),
  KEY `sv_author` (`sv_author`,`sv_action`,`sv_revision`,`sv_deleted`,`sv_current`),
  KEY `name` (`name`)
) TYPE=MyISAM;

#
# Dumping data for table `sitellite_filesystem_sv`
#

create table sitellite_filesystem_download (
	name varchar(255) not null,
	ts datetime not null,
	ip char(15) not null,
	index (name, ts)
);

# --------------------------------------------------------

#
# Table structure for table `sitellite_property_set`
#

CREATE TABLE sitellite_property_set (
	collection CHAR(84) NOT NULL,
	entity CHAR(84) NOT NULL,
	property CHAR(84) NOT NULL,
	data_value TEXT NOT NULL,
	UNIQUE (collection, property, entity),
	UNIQUE (property, entity)
);

#
# Dumping data for table `sitellite_property_set`
#

CREATE TABLE sitellite_log (
	ts datetime not null,
	type char(48) not null,
	user char(48) not null,
	ip char(24) not null,
	request char(255) not null,
	message char(255) not null,
	index (ts, type, user, ip)
);

CREATE TABLE xed_templates (
	id int not null auto_increment primary key,
	name char(32) not null,
	body text not null,
	index (name)
);

CREATE TABLE xed_elements (
	name char(32) not null primary key
);

INSERT INTO xed_elements VALUES ('default');
INSERT INTO xed_elements VALUES ('a');
INSERT INTO xed_elements VALUES ('img');
INSERT INTO xed_elements VALUES ('table');

CREATE TABLE xed_attributes (
	id int not null auto_increment primary key,
	element char(32) not null,
	name char(32) not null,
	typedef text not null,
	index (element, name)
);

INSERT INTO xed_attributes VALUES (null, 'default', 'id', "type=select\nalt=ID");
INSERT INTO xed_attributes VALUES (null, 'default', 'class', "type=select\nalt=Class");
INSERT INTO xed_attributes VALUES (null, 'a', 'href', "type=xed.Widget.Linker\nalt=Link\nextra=\"size='35'\"");
INSERT INTO xed_attributes VALUES (null, 'a', 'target', "type=select\nsetValues=\"eval: array ('' => intl_get ('None'), '_blank' => intl_get ('New Window'), '_top' => intl_get ('Top Frame'))\"");
INSERT INTO xed_attributes VALUES (null, 'img', 'src', "type=imagechooser\nalt=File");
INSERT INTO xed_attributes VALUES (null, 'img', 'alt', "type=text\nalt=Alt/Description");
INSERT INTO xed_attributes VALUES (null, 'img', 'width', "type=text\nalt=Width");
INSERT INTO xed_attributes VALUES (null, 'img', 'height', "type=text\nalt=Height");
INSERT INTO xed_attributes VALUES (null, 'img', 'align', "type=select\nalt=Align\nsetValues=\"eval: array ('' => intl_get ('- SELECT -'), 'left' => intl_get ('Left'), 'right' => intl_get ('Right'))\"");
INSERT INTO xed_attributes VALUES (null, 'img', 'border', "type=text\nalt=Border");
INSERT INTO xed_attributes VALUES (null, 'table', 'width', "type=text");
INSERT INTO xed_attributes VALUES (null, 'table', 'border', "type=text");
INSERT INTO xed_attributes VALUES (null, 'table', 'cellpadding', "type=text\nalt=Cell Padding");
INSERT INTO xed_attributes VALUES (null, 'table', 'cellspacing', "type=text\nalt=Cell Spacing");
INSERT INTO xed_attributes VALUES (null, 'td', 'width', "type=text");
INSERT INTO xed_attributes VALUES (null, 'td', 'valign', "type=select\nalt=Vertical Alignment\nsetValues=\"eval: array ('' => intl_get ('None'), 'top' => intl_get ('Top'), 'middle' => intl_get ('Middle'), 'bottom' => intl_get ('Bottom'))\"");
INSERT INTO xed_attributes VALUES (null, 'td', 'align', "type=select\nalt=Horizontal Alignment\nsetValues=\"eval: array ('' => intl_get ('None'), 'left' => intl_get ('Left'), 'center' => intl_get ('Centre'), 'right' => intl_get ('Right'))\"");

CREATE TABLE xed_speling_suggestions (
	word char(32) not null,
	lang char(7) not null,
	suggestions text not null,
	primary key (word, lang)
);

CREATE TABLE xed_speling_personal (
	id int not null auto_increment primary key,
	username char(48) not null,
	word char(32) not null,
	index (username, word)
);

CREATE TABLE xed_bookmarks (
	id int not null auto_increment primary key,
	name char(48) not null,
	url char(255) not null,
	index (name)
);

CREATE TABLE sitellite_homepage (
        user char(48) NOT NULL primary key,
        title char(128) NOT NULL,
        template char(128) NOT NULL,
        body text NOT NULL,
        index (title)
);

create table sitellite_form_type (
	id int not null auto_increment primary key,
	name char(48) not null
);

insert into sitellite_form_type values (null, 'Contact');

create table sitellite_form_submission (
	id int not null auto_increment primary key,
	form_type char(32),
	ts datetime not null,
	title char(48),
	ip char(16),
	account_number char(72),
	pass_phrase char(72),
	salutation char(12),
	first_name char(72),
	last_name char(72),
	email_address char(72),
	birthday date,
	gender char(12),
	address_line1 char(72),
	address_line2 char(72),
	city char(72),
	state char(72),
	country char(72),
	zip char(24),
	company char(72),
	job_title char(72),
	phone_number char(72),
	daytime_phone char(72),
	evening_phone char(72),
	mobile_phone char(72),
	fax_number char(72),
	preferred_method_of_contact char(12),
	best_time char(12),
	may_we_contact_you char(12),
	comments text,
	index (form_type, ts, ip, birthday, gender, state, country, may_we_contact_you)
);

create table sitellite_upgrade (
	num char(12) not null primary key,
	user char(48) not null,
	ts datetime not null,
	index (ts, user)
);

create table sitellite_form_blacklist (
	ip_address char(16) not null primary key
);

create table sitellite_parallel (
	id int not null auto_increment primary key,
	page char(72) not null,
	goal char(128) not null,
	index (page)
);

create table sitellite_parallel_view (
	parallel_id int not null,
	revision_id int not null,
	ts date not null,
	index (parallel_id, revision_id, ts)
);

create table sitellite_parallel_click (
	parallel_id int not null,
	revision_id int not null,
	ts date not null,
	index (parallel_id, revision_id, ts)
);

create table sitellite_autosave (
  user_id char(48) not null,
  url char(255) not null,
  page_title char(128) not null,
  ts datetime not null,
  vals mediumtext not null,
  index (user_id, ts),
  index (url)
);

create table sitellite_translation (
	id int not null auto_increment primary key,
	collection char(48) not null,
	pkey char(128) not null,
	lang char(12) not null,
	ts datetime not null,
	expired enum('yes','no') not null default 'no',
	sitellite_status varchar(32) NOT NULL default '',
	title char(128) not null,
	data mediumtext not null,
	index (collection, pkey, lang, sitellite_status)
);

create table sitellite_translation_sv (
	sv_autoid int not null auto_increment primary key,
	sv_author varchar(48) NOT NULL default '',
	sv_action enum('created','modified','republished','replaced','restored','deleted','updated') NOT NULL default 'created',
	sv_revision datetime NOT NULL,
	sv_changelog text NOT NULL,
	sv_deleted enum('yes','no') not null default 'no',
	sv_current enum('yes','no') not null default 'yes',
	id int not null,
	collection char(48) not null,
	pkey char(128) not null,
	lang char(12) not null,
	ts datetime not null,
	expired enum('yes','no') not null default 'no',
	sitellite_status varchar(32) NOT NULL default '',
	title char(128) not null,
	data mediumtext not null,
	index (sv_author, sv_action, sv_revision, sv_deleted, sv_current),
	index (id)
);
create table deadlines (
	id int not null auto_increment primary key,
	title char(72) not null,
	project char(32) not null,
	type enum('deadline','beta','report','milestone','meeting') not null,
	ts datetime not null,
	details text not null,
	index (ts,type,project)
);

create table deadlines_project (
	name char(32) not null primary key
);

CREATE TABLE digger_linkstory (
	id INT AUTO_INCREMENT PRIMARY KEY,
	link CHAR(128) NOT NULL,
	user CHAR(48) NOT NULL,
	posted_on DATETIME NOT NULL,
	score INT NOT NULL,
	title CHAR(128) NOT NULL,
	category INT NOT NULL,
	description TEXT NOT NULL,
	status ENUM('enabled','disabled') NOT NULL,
	INDEX (user, posted_on, category, status, score)
);

CREATE TABLE digger_category (
	id INT AUTO_INCREMENT PRIMARY KEY,
	category CHAR(128) NOT NULL,
	INDEX (category)
);

CREATE TABLE digger_comments (
	id INT AUTO_INCREMENT PRIMARY KEY,
	story INT NOT NULL, 
	user CHAR(48) NOT NULL,
	comment_date DATETIME NOT NULL,
	comments TEXT NOT NULL,
	INDEX (story, user, comment_date)
);

CREATE TABLE digger_vote (
	id INT AUTO_INCREMENT PRIMARY KEY,
	story INT NOT NULL,
	score TINYINT NOT NULL,
	user CHAR(48) NOT NULL,
	ip CHAR(15) NOT NULL,
	votetime DATETIME NOT NULL,
	INDEX (story, user)
);
create table petition (
	id int not null auto_increment primary key,
	name char(72) not null,
	ts datetime not null,
	description text not null,
	body text not null,
	sitellite_status varchar(32) NOT NULL default '',
	sitellite_access varchar(32) NOT NULL default '',
	sitellite_owner varchar(48) NOT NULL default '',
	sitellite_team varchar(48) NOT NULL default '',
	index (name, ts, sitellite_status, sitellite_access, sitellite_team)
);

create table petition_signature (
	id int not null auto_increment primary key,
	petition_id int not null,
	firstname char(48) not null,
	lastname char(48) not null,
	email char(72) not null,
	address char(72) not null,
	city char(48) not null,
	province char(48) not null,
	postal_code char(8) not null,
	ts datetime not null,
	index (petition_id, ts)
);
CREATE TABLE shoutbox (
  id int not null auto_increment primary key,
  name char(48) not null,
  url char(128) not null,
  ip_address char(15) not null,
  posted_on datetime not null,
  message char(255) not null,
  index (posted_on)
);
# Your database schema goes here

create table siteblog_category (
    id int not null auto_increment primary key,
    poster_visible enum ('yes', 'no') not null,
    comments enum ('on', 'off') not null,
    display_rss enum ('yes', 'no') not null,
    title char(128) not null,
    status enum ('on', 'off') not null
);

insert into siteblog_category (id, poster_visible, comments, display_rss, title, status) values (1, 'yes', 'on', 'yes', 'Uncategorized', 'on');

create table siteblog_post (
    id int not null auto_increment primary key,
    status enum ('visible', 'not visible'),
    created datetime not null,
    appear datetime not null,
    disappear datetime not null,
    category int not null,
    author char(32) not null, 
    subject char(128) not null,
    body text not null,
    comments enum ('on', 'off'),
    poster_visible enum ('yes', 'no'),
    index (category, author)
);

create table siteblog_post_sv (
    sv_autoid int not null auto_increment primary key,
    sv_author char(48) not null,
    sv_action enum('created','modified','republished','replaced','restored','deleted','updated') not null default 'created',
    sv_revision datetime not null,
    sv_changelog text not null,
    sv_deleted enum('yes','no') default 'no',
    sv_current enum('yes','no') default 'yes',
    id int not null,
    status enum ('visible', 'not visible'),
    created datetime not null,
    appear datetime not null,
    disappear datetime not null,
    category int not null,
    author char(32) not null, 
    subject char(128) not null,
    body text not null,
    comments enum ('on', 'off'),
    poster_visible enum ('yes', 'no'),
    KEY sv_author (sv_author,sv_action,sv_revision,sv_deleted,sv_current),
    KEY id (id)
) TYPE=MyISAM;

create table siteblog_comment (
    id int not null auto_increment primary key,
    date datetime not null,
    author char(32) not null,
    email char(72) not null,
    url char(72) not null,
    ip char(15) not null,
    child_of_post int not null,
    child_of_comment int not null,
    body text not null,
    index (child_of_post, child_of_comment)
);

create table siteblog_banned (
	ip char(15) not null primary key
);

create table siteblog_blogroll (
	id int not null auto_increment primary key,
	title char(72) not null,
	url char(128) not null,
	weight int not null default 0,
	index (title, weight)
);

create table siteblog_akismet (
	id int not null auto_increment primary key,
	post_id int not null,
    ts datetime not null,
    author char(32) not null,
    email char(72) not null,
    website char(72) not null,
    user_ip char(15) not null,
    user_agent char(72) not null,
    body text not null,
    index (ts)
);
# Your database schema goes here

CREATE TABLE siteevent_event (
	id int not null auto_increment primary key,
	title char(128) not null,
	short_title char(32) not null,
	date date not null,
	time time not null,
	until_date date not null,
	until_time time not null,
	`priority` enum('normal','high') not null default 'normal',
	category char(72) not null,
	audience char(32) not null,
	loc_name char(72) not null,
	loc_address char(72) not null,
	loc_city char(48) not null,
	loc_province char(48) not null,
	loc_country char(48) not null,
	loc_map char(128) not null,
	contact char(72) not null,
	contact_email char(72) not null,
	contact_phone char(72) not null,
	contact_url char(128) not null,
	sponsor char(72) not null,
	rsvp char(72) not null,
	public enum('yes','no') not null default 'no',
	media enum('yes','no') not null default 'no',
	details text not null,
	recurring enum('no','daily','weekly','monthly','yearly') not null default 'no',
	sitellite_status char(16) not null,
	sitellite_access char(16) not null,
	sitellite_startdate datetime,
	sitellite_expirydate datetime,
	sitellite_owner char(48) not null,
	sitellite_team char(48) not null,
	index (date, time, until_date, until_time, category, audience, recurring, sitellite_status, sitellite_access, sitellite_owner, sitellite_team)
);

CREATE TABLE siteevent_event_sv (
	sv_autoid int not null auto_increment primary key,
	sv_author char(48) not null,
	sv_action enum('created','modified','republished','replaced','restored','deleted','updated') not null default 'created',
	sv_revision datetime not null,
	sv_changelog text not null,
	sv_deleted enum('yes','no') default 'no',
	sv_current enum('yes','no') default 'yes',
	id int not null,
	title char(128) not null,
	short_title char(32) not null,
	date date not null,
	time time not null,
	until_date date not null,
	until_time time not null,
	`priority` enum('normal','high') not null default 'normal',
	category char(72) not null,
	audience char(32) not null,
	loc_name char(72) not null,
	loc_address char(72) not null,
	loc_city char(48) not null,
	loc_province char(48) not null,
	loc_country char(48) not null,
	loc_map char(128) not null,
	contact char(72) not null,
	contact_email char(72) not null,
	contact_phone char(72) not null,
	contact_url char(128) not null,
	sponsor char(72) not null,
	rsvp char(72) not null,
	public enum('yes','no') not null default 'no',
	media enum('yes','no') not null default 'no',
	details text not null,
	recurring enum('no','daily','weekly','monthly','yearly') not null default 'no',
	sitellite_status char(16) not null,
	sitellite_access char(16) not null,
	sitellite_startdate datetime,
	sitellite_expirydate datetime,
	sitellite_owner char(48) not null,
	sitellite_team char(48) not null,
	index (sv_author, sv_action, sv_revision, sv_deleted, sv_current),
	index (id)
);

CREATE TABLE siteevent_category (
	name char(72) not null primary key
);

CREATE TABLE siteevent_audience (
	id int not null auto_increment primary key,
	name char(72) not null
);

# Your database schema goes here

CREATE TABLE sitefaq_question (
	id int not null auto_increment primary key,
	question char(255) not null,
	category char(48) not null,
	answer text not null,
	index (category)
);

CREATE TABLE sitefaq_category (
	name char(48) not null primary key
);

CREATE TABLE sitefaq_submission (
	id int not null auto_increment primary key,
	question char(255) not null,
	answer text not null,
	ts datetime not null,
	assigned_to char(48) not null,
	email char(72) not null,
	member_id char(48) not null,
	ip char(15) not null,
	name char(72) not null,
	age char(12) not null,
	url char(128) not null,
	sitellite_status char(16) not null,
	sitellite_access char(16) not null,
	sitellite_owner char(48) not null,
	sitellite_team char(48) not null,
	index (ts, assigned_to, member_id, ip, age, sitellite_status, sitellite_access, sitellite_owner, sitellite_team)
);
# Your database schema goes here

create table siteforum_topic (
	id int not null auto_increment primary key,
	name char(128) not null,
	description text not null,
	sitellite_access char(16) not null,
	sitellite_status char(16) not null,
	sitellite_owner char(48) not null,
	sitellite_team char(48) not null,
	index (sitellite_access, sitellite_status, sitellite_owner, sitellite_team)
);

create table siteforum_post (
	id int not null auto_increment primary key,
	topic_id int not null,
	user_id char(48) not null,
	post_id int not null,
	ts datetime not null,
	mtime timestamp not null,
	subject char(128) not null,
	body text not null,
	sig text not null,
	notice enum('no','yes') not null default 'no',
	sitellite_access char(16) not null,
	sitellite_status char(16) not null,
	sitellite_owner char(48) not null,
	sitellite_team char(48) not null,
	index (topic_id, ts, mtime, user_id, post_id, notice, sitellite_access, sitellite_status, sitellite_owner, sitellite_team)
);

create table siteforum_subscribe (
	id int not null auto_increment primary key,
	post_id int not null,
	user_id char(48),
	index (post_id,user_id)
);
# Your database schema goes here

CREATE TABLE siteglossary_term (
  word varchar(48) NOT NULL default '',
  category char(48) not null,
  description varchar(80) NOT NULL default '',
  body text NOT NULL,
  PRIMARY KEY  (word),
  index (category)
) TYPE=MyISAM;

CREATE TABLE siteglossary_category (
	name char(48) not null primary key
);
CREATE TABLE siteinvoice_invoice (
	id int not null auto_increment primary key,
	client_id int not null,
	name char(72) not null,
	sent_on datetime not null,
	status enum('unpaid','paid','cancelled') not null,
	notice int not null,
	subtotal decimal(9,2) not null,
	taxes decimal(9,2) not null,
	total decimal(9,2) not null,
	currency char(3) not null,
	index (client_id, sent_on, status, notice, subtotal, taxes, total)
);

CREATE TABLE siteinvoice_client (
	id int not null auto_increment primary key,
	code char(5) not null,
	name char(72) not null,
	contact_name char(72) not null,
	contact_email char(72) not null,
	contact_phone char(72) not null,
	address text not null,
	index (name)
);
CREATE TABLE sitepoll_poll (
	id int not null auto_increment primary key,
	title char(255) not null,
	option_1 char(255) not null,
	option_2 char(255) not null,
	option_3 char(255) not null,
	option_4 char(255) not null,
	option_5 char(255) not null,
	option_6 char(255) not null,
	option_7 char(255) not null,
	option_8 char(255) not null,
	option_9 char(255) not null,
	option_10 char(255) not null,
	option_11 char(255) not null,
	option_12 char(255) not null,
	sections char(200) not null,
	date_added datetime not null,
	enable_comments enum('yes','no') not null default 'no',
	sitellite_status varchar(16) NOT NULL default '',
	sitellite_access varchar(16) NOT NULL default '',
	sitellite_startdate datetime default NULL,
	sitellite_expirydate datetime default NULL,
	sitellite_owner varchar(48) NOT NULL default '',
	sitellite_team varchar(48) NOT NULL default '',
	index (date_added, sections, sitellite_status, sitellite_access, sitellite_team)
);

CREATE TABLE sitepoll_poll_sv (
	sv_autoid int not null auto_increment primary key,
	sv_author char(48) not null,
	sv_action enum('created','modified','republished','replaced','restored','deleted','updated') not null default 'created',
	sv_revision datetime not null,
	sv_changelog text not null,
	sv_deleted enum('yes','no') default 'no',
	sv_current enum('yes','no') default 'yes',
	id int not null,
	title char(255) not null,
	option_1 char(255) not null,
	option_2 char(255) not null,
	option_3 char(255) not null,
	option_4 char(255) not null,
	option_5 char(255) not null,
	option_6 char(255) not null,
	option_7 char(255) not null,
	option_8 char(255) not null,
	option_9 char(255) not null,
	option_10 char(255) not null,
	option_11 char(255) not null,
	option_12 char(255) not null,
	sections char(200) not null,
	date_added datetime not null,
	enable_comments enum('yes','no') not null default 'no',
	sitellite_status varchar(16) NOT NULL default '',
	sitellite_access varchar(16) NOT NULL default '',
	sitellite_startdate datetime default NULL,
	sitellite_expirydate datetime default NULL,
	sitellite_owner varchar(48) NOT NULL default '',
	sitellite_team varchar(48) NOT NULL default '',
	index (sv_author, sv_action, sv_revision, sv_deleted, sv_current),
	index (id)
);

CREATE TABLE sitepoll_vote (
	id int not null auto_increment primary key,
	poll int not null,
	choice int not null,
	ts datetime not null,
	ua char(128) not null,
	ip char(24) not null,
	index (poll, choice, ts, ua, ip)
);

CREATE TABLE sitepoll_comment (
	id int not null auto_increment primary key,
	poll int not null,
	user_id char(48) not null,
	ts datetime not null,
	ua char(128) not null,
	ip char(24) not null,
	subject char(128) not null,
	body text not null,
	index (poll, user_id, ts)
);
# Your database schema goes here

CREATE TABLE sitepresenter_presentation (
	id int not null auto_increment primary key,
	title char(128) not null,
	ts datetime not null,
	theme char(32) not null,
	category char(32) not null,
	keywords text not null,
	description text not null,
	cover text not null,
	sitellite_status char(16) not null,
	sitellite_access char(16) not null,
	sitellite_startdate datetime,
	sitellite_expirydate datetime,
	sitellite_owner char(48) not null,
	sitellite_team char(48) not null,
	index (ts, category, sitellite_status, sitellite_access, sitellite_owner, sitellite_team)
);

CREATE TABLE sitepresenter_slide (
	id int not null auto_increment primary key,
	title char(128) not null,
	presentation int not null,
	number int not null,
	body text not null,
	index (presentation, number)
);

CREATE TABLE sitepresenter_view (
	presentation int not null,
	ts datetime not null,
	ip char(15) not null,
	index (presentation, ts)
);

CREATE TABLE sitepresenter_category (
	name char(32) not null primary key
);
CREATE TABLE sitequotes_entry (
	id int not null auto_increment primary key,
	person char(72) not null,
	company char(72) not null,
	website char(128) not null,
	quote text not null
);
# database tables for sitesearch usage tracking

create table sitesearch_index (
	id int not null auto_increment primary key,
	mtime int not null,
	duration int not null,
	counts text not null,
	index (mtime, duration)
);

create table sitesearch_log (
	id int not null auto_increment primary key,
	query char(255) not null,
	results int not null,
	ts datetime not null,
	ip char(15) not null,
	ctype char(72) not null,
	domain char(72) not null,
	index (ts, results, query),
	index (ctype, domain)
);
CREATE TABLE sitestudy_item (
	id int not null auto_increment primary key,
	client char(72) not null,
	problem text not null,
	solution text not null,
	sort_weight int not null,
	keywords  text not null,
	description text not null,
	sitellite_status char(16) not null,
	sitellite_access char(16) not null,
	sitellite_startdate datetime,
	sitellite_expirydate datetime,
	sitellite_owner char(48) not null,
	sitellite_team char(48) not null,
	index (sort_weight, client, sitellite_status, sitellite_access, sitellite_owner, sitellite_team)
);

CREATE TABLE sitestudy_item_sv (
	sv_autoid int not null auto_increment primary key,
	sv_author char(48) not null,
	sv_action enum('created','modified','republished','replaced','restored','deleted') not null default 'created',
	sv_revision datetime not null,
	sv_changelog text not null,
	sv_deleted enum('yes','no') default 'no',
	sv_current enum('yes','no') default 'yes',
	id int not null,
	client char(72) not null,
	problem text not null,
	solution text not null,
	sort_weight int not null,
	keywords  text not null,
	description text not null,
	sitellite_status char(16) not null,
	sitellite_access char(16) not null,
	sitellite_startdate datetime,
	sitellite_expirydate datetime,
	sitellite_owner char(48) not null,
	sitellite_team char(48) not null,
	index (sv_author, sv_action, sv_revision, sv_deleted, sv_current),
	index (id, sitellite_status, sitellite_access, sitellite_owner, sitellite_team)
);
# Your database schema goes here

CREATE TABLE sitetemplate_to_be_validated (
   id int not null auto_increment primary key,
   body text not null
);
create table sitewiki_file (
	id int not null auto_increment primary key,
	page_id char(48) not null,
	name char(128) not null,
	ts datetime not null,
	owner char(48) not null,
	index (page_id, name)
);

create table sitewiki_page (
	id char(48) not null primary key,
	created_on datetime not null,
	updated_on datetime not null,
	view_level int not null,
	edit_level int not null,
	owner char(48) not null,
	body mediumtext not null,
	index (view_level, owner, created_on, updated_on)
);

create table sitewiki_page_sv (
	sv_autoid int not null auto_increment primary key,
	sv_author char(48) not null,
	sv_action enum('created','modified','republished','replaced','restored','deleted','updated') not null default 'created',
	sv_revision timestamp,
	sv_changelog text not null,
	sv_deleted enum('yes','no') default 'no',
	sv_current enum('yes','no') default 'yes',
	id char(48) not null,
	created_on datetime not null,
	updated_on datetime not null,
	view_level int not null,
	edit_level int not null,
	owner char(48) not null,
	body mediumtext not null,
	index (sv_author, sv_action, sv_revision, sv_deleted, sv_current),
	index (id, view_level, owner, created_on, updated_on)
);

insert into sitewiki_page
	(id, created_on, updated_on, view_level, edit_level, owner, body)
values
	('HomePage', now(), now(), 0, 0, 'admin', 'Welcome to SiteWiki.

SiteWiki is a Wiki implementation as an add-on for the SitelliteCms.

SiteWiki features content versioning and revision control, page locking to prevent data corruption, read and write permission levels, and a built-in search.  The SiteWiki layout is CSS-controlled, and SiteWiki is fully integrated with the SitelliteCms.

SiteWiki was modeled closely after David Hansson\'s [http://rubyforge.org/projects/instiki/ Instiki], which is a very elegant and intuitive Wiki implementation.  SiteWiki differs primarily from Instiki in three ways:

* Finer-grained access control - control visibility and editability separately, with page-level access restricted to anonymous visitors, members only, admins only, or page owners only.
* Uses Paul Jones\' [http://pear.php.net/package/Text_Wiki Text_Wiki] PEAR package instead of the Textile markup syntax.
* SiteWiki integrates within your complete Sitellite-powered web site, which means that design elements from your global design are inherited by SiteWiki automatically.  This centralization of design control is at the core of any good ContentManagementSystem, like Sitellite.

++ What is a Wiki?

Wiki, also known as a WikiWikiWeb, is an innovative new way of collaborating over the web.  Wiki was invented by Ward Cunningham all the way back in 1995.  Wiki\'s work by making all pages editable by anyone, which encourages contributions by lowering the barrier to participation, and by making internal links incredibly easy to create (simply join two or more capitalized words together to form a link to a new page, called CamelCase because of the "bumps" in the middle of the compound word, suggesting the humps of a camel.  Wiki\'s however (and it should be noted) are //**insecure by design**//, since anyone can edit anything.  However, Wiki\'s deter would-be malicious visitors in two ways:

* By removing the challenge, Wiki removes the appeal of web site vandalism.
* By saving a history of the changes made to each page, Wiki\'s make it easy to undo any malicious changes that //are// made, nullifying the risk of permanent damage.

Wiki\'s are found to be most useful for the following types of web sites:

* Centralized and/or user-driven documentation repositories
* Information sharing within a project
* Planning and brainstorming
* Other tasks like this

However, Wiki\'s are generally found to be unsuitable for:

* Corporate web sites
* Sales-oriented web sites
* Any web site requiring strict control over publication rights
* Any web site requiring workflow approval processes

For these types of web sites, a general web-based ContentManagementSystem, such as the SitelliteCms, is a better solution.
');

insert into sitewiki_page_sv
	(sv_autoid, sv_author, sv_action, sv_revision, sv_changelog, sv_deleted, sv_current, id, created_on, updated_on, view_level, edit_level, owner, body)
values
	(null, 'admin', 'created', now(), 'Page added.', 'no', 'yes', 'HomePage', now(), now(), 0, 0, 'admin', 'Welcome to SiteWiki.

SiteWiki is a Wiki implementation as an add-on for the SitelliteCms.

SiteWiki features content versioning and revision control, page locking to prevent data corruption, read and write permission levels, and a built-in search.  The SiteWiki layout is CSS-controlled, and SiteWiki is fully integrated with the SitelliteCms.

SiteWiki was modeled closely after David Hansson\'s [http://rubyforge.org/projects/instiki/ Instiki], which is a very elegant and intuitive Wiki implementation.  SiteWiki differs primarily from Instiki in three ways:

* Finer-grained access control - control visibility and editability separately, with page-level access restricted to anonymous visitors, members only, admins only, or page owners only.
* Uses Paul Jones\' [http://pear.php.net/package/Text_Wiki Text_Wiki] PEAR package instead of the Textile markup syntax.
* SiteWiki integrates within your complete Sitellite-powered web site, which means that design elements from your global design are inherited by SiteWiki automatically.  This centralization of design control is at the core of any good ContentManagementSystem, like Sitellite.

++ What is a Wiki?

Wiki, also known as a WikiWikiWeb, is an innovative new way of collaborating over the web.  Wiki was invented by Ward Cunningham all the way back in 1995.  Wiki\'s work by making all pages editable by anyone, which encourages contributions by lowering the barrier to participation, and by making internal links incredibly easy to create (simply join two or more capitalized words together to form a link to a new page, called CamelCase because of the "bumps" in the middle of the compound word, suggesting the humps of a camel.  Wiki\'s however (and it should be noted) are //**insecure by design**//, since anyone can edit anything.  However, Wiki\'s deter would-be malicious visitors in two ways:

* By removing the challenge, Wiki removes the appeal of web site vandalism.
* By saving a history of the changes made to each page, Wiki\'s make it easy to undo any malicious changes that //are// made, nullifying the risk of permanent damage.

Wiki\'s are found to be most useful for the following types of web sites:

* Centralized and/or user-driven documentation repositories
* Information sharing within a project
* Planning and brainstorming
* Other tasks like this

However, Wiki\'s are generally found to be unsuitable for:

* Corporate web sites
* Sales-oriented web sites
* Any web site requiring strict control over publication rights
* Any web site requiring workflow approval processes

For these types of web sites, a general web-based ContentManagementSystem, such as the SitelliteCms, is a better solution.
');
# TimeTracker Database Schema

create table timetracker_entry (
	id int not null auto_increment primary key,
	project_id int not null,
	task_description text not null,
	started datetime not null,
	duration decimal(10,2),
	index (project_id, started, duration)
);

create table timetracker_project (
	id int not null auto_increment primary key,
	name char(72) not null,
	description text not null
);

create table timetracker_user_entry (
	id int not null auto_increment primary key,
	user_id char(16) not null,
	entry_id int not null,
	index (user_id, entry_id)
);
CREATE TABLE todo_list (
  id int NOT NULL auto_increment primary key,
  todo char(255) NOT NULL default '',
  priority enum('normal','high','urgent') NOT NULL default 'normal',
  project char(72) NOT NULL default '',
  person char(72) NOT NULL default '',
  done datetime not null,
  index (person, project, priority, done)
);

CREATE TABLE todo_person (
	name char(72) not null primary key
);

CREATE TABLE todo_project (
	name char(72) not null primary key
);
create table webfiles_log (
	id int not null auto_increment primary key,
	line int not null,
	http_status int not null,
	info char(255) not null,
	ts datetime not null,
	index (ts)
);
create table realty_listing (
	id int not null auto_increment primary key,
	headline char(72) not null,
	property_type enum('residential','commercial') not null default 'residential',
	price int not null,
	house_size char(48) not null,
	lot_size char(48) not null,
	gross_taxes char(48) not null,
	net_taxes char(48) not null,
	summary text not null,
	photo1 char(128) not null default '',
	photo2 char(128) not null default '',
	photo3 char(128) not null default '',
	photo4 char(128) not null default '',
	photo5 char(128) not null default '',
	photo6 char(128) not null default '',
	photo7 char(128) not null default '',
	photo8 char(128) not null default '',
	ts date not null,
	status enum('active','sold','archived') not null default 'active',
	description text not null,
	index (ts, price, status)
);
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
