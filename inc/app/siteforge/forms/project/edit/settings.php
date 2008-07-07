; <?php /*

[Form]

error_mode = all

[proj_id]

type = hidden

;[id]

;type = text
;alt = "ID (Alphanumeric)"
;rule 1 = not empty, You must enter a project ID.
;rule 2 = "regex `^[a-zA-Z0-9_-]+$`, Your project ID contains invalid characters."

[name]

type = text
alt = Name
rule 1 = not empty, You must enter a project name.

[ext_url]

type = text
alt = External Website
setDefault = "http://"
extra = "size=`40`"

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

[status]

type = select
alt = Status
setValues = "eval: db_pairs ('select * from siteforge_status where id = 2 or id > 3 order by id asc')"

[description]

type = textarea
labelPosition = left
alt = Description
cols = 40
rows = 8

[features_info]

type = template
template = "<tr><td colspan=`2`><p><strong>{intl External Pages}</strong><br />{intl The fields below allow you to override the features of this site and use your existing project website.}</p></td></tr>"

[ext_bugs]

type = text
alt = External Bugs
setDefault = "http://"
extra = "size=`40`"

[ext_docs]

type = text
alt = External Docs
setDefault = "http://"
extra = "size=`40`"

[ext_forum]

type = text
alt = External Forum
setDefault = "http://"
extra = "size=`40`"

[donations_info]

type = template
template = "<tr><td colspan=`2`><p><strong>{intl Donations}</strong><br />{intl The fields below allow you to display a donation request page when users download your project.}</p></td></tr>"

[donation_paypal_id]

type = text
alt = "Your Paypal ID"

[donation_default_amt]

type = hidden
alt = "Requested Amount"

[instructions]

type = template
template = "<tr><td colspan=`2` align=`right`><a href=`{site/prefix}/index/siteforge-doc-instructions-action` target=`_blank`>{intl Wiki Formatting Rules}</a></td></tr>"

[donation_message]

type = textarea
labelPosition = left
alt = "Custom Message (Optional)"
cols = 50
rows = 20

[submit_button]

type = submit
setValues = Submit

; */ ?>
