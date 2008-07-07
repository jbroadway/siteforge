; <?php /*

[Form]

error_mode = all

[proj_id]

type = text
alt = "ID (Alphanumeric)"
rule 1 = not empty, You must enter a project ID.
rule 2 = "regex `^[a-zA-Z0-9_-]+$`, Your project ID contains invalid characters."
rule 3 = "regex `^_`, Your project ID cannot begin with an underscore."

[name]

type = text
alt = Name
rule 1 = not empty, You must enter a project name.

[external_url]

type = text
alt = External Website
setDefault = "http://"

[category]

type = select
alt = Category
setValues = "eval: db_pairs ('select * from siteforge_category order by name asc')"

[audience]

type = select
alt = Audience
setValues = "eval: db_pairs ('select * from siteforge_audience order by name asc')"

[license]

type = select
alt = License
setValues = "eval: db_pairs ('select * from siteforge_license order by name asc')"

[description]

type = textarea
labelPosition = left
alt = Description
cols = 40
rows = 8

[submit_button]

type = submit
setValues = Submit

; */ ?>