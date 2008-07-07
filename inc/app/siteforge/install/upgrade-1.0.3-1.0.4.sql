alter table siteforge_project add column donation_paypal_id char(72) not null;
alter table siteforge_project add column donation_default_amt decimal(4,2) not null;
alter table siteforge_project add column donation_message text not null;
