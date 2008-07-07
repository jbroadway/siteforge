alter table siteforge_bug change column subject subject char(128) not null;
alter table siteforge_project add column ext_bugs char(128) not null;
alter table siteforge_project add column ext_docs char(128) not null;
alter table siteforge_project add column ext_forum char(128) not null;
