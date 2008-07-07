; <?php /*

[Collection]

name = siteforge_project
display = Projects
singular = Project

key_field = id
key_field_name = ID

title_field = name
title_field_name = Name

body_field = description

is_versioned = no

sitesearch_url = "siteforge-app/proj.%s"
sitesearch_access = public

[Source]

name = Database

[Store]

name = Blank

[browse:id]

header = ID

[browse:name]

header = Name

[browse:user_id]

header = Owner

[browse:status]

header = Status
filter_import = siteforge.Filters
filter = siteforge_filter_status

[browse:category]

header = Category
filter_import = siteforge.Filters
filter = siteforge_filter_cat

[facet:name]

display = Text
type = text
fields = "id, name, description"

[facet:category]

display = Category
type = select
values = "db_pairs ('select * from siteforge_category order by name asc')"

[facet:status]

display = Status
type = select
values = "db_pairs ('select * from siteforge_status order by id asc')"

[hint:id]

alt = ID

[hint:user_id]

alt = Owner
type = info
;type = select
;setValues = "eval: assocify (db_shift_array ('select username from sitellite_user order by username asc'))"

[hint:name]

extra = "size=`40`"

[hint:category]

type = selector
setValues = "eval: db_pairs ('select * from siteforge_category order by name asc')"
table = siteforge_category
key = id
title = name

[hint:status]

type = select
setValues = "eval: db_pairs ('select * from siteforge_status order by id asc')"

[hint:description]

labelPosition = left

[hint:license]

type = selector
setValues = "eval: db_pairs ('select * from siteforge_license order by name asc')"
table = siteforge_license
key = id
title = name

[hint:audience]

type = selector
setValues = "eval: db_pairs ('select * from siteforge_audience order by name asc')"
table = siteforge_audience
key = id
title = name

[hint:ext_url]

alt = External Website
extra = "size=`40`"

[hint:ts]

alt = Created On
type = info

; */ ?>