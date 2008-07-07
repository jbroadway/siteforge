; <?php /*

[Project]

table = siteforge_project
pkey = id
import = siteforge.CustomProject
extends = SiteForge_CustomProject
isAuto = no

[Category]

table = siteforge_category
pkey = id

[Status]

table = siteforge_status
pkey = id

[License]

table = siteforge_license
pkey = id

[Audience]

table = siteforge_audience
pkey = id

[News]

table = siteforge_news
pkey = id

[Doc]

table = siteforge_doc
pkey = id

[Bug]

table = siteforge_bug
pkey = id

[Comment]

table = siteforge_bug_comment
pkey = id

[Stat]

table = siteforge_stat
pkey = id

[rel:Project:Stat]

type = 1x
Stat field = proj_id
cascade = on

[rel:Bug:Comment]

type = 1x
Comment field = bug_id
cascade = on

[rel:Project:Bug]

type = 1x
Bug field = proj_id
cascade = on

[rel:Project:News]

type = 1x
News field = proj_id
cascade = on

[rel:Project:Doc]

type = 1x
Doc field = proj_id
cascade = on

[rel:Category:Project]

type = 1x
Project field = category

[rel:Status:Project]

type = 1x
Project field = status

[rel:License:Project]

type = 1x
Project field = license

[rel:Audience:Project]

type = 1x
Project field = audience

; */ ?>