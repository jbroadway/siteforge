; <?php /*

[Form]

error_mode = all

[proj]

type = hidden

[id]

type = text
alt = "Doc ID (Alphanumeric)"
rule 1 = not empty, You must enter an ID for your doc.
rule 2 = "regex '^[a-zA-Z0-9_-]+$', Your ID contains invalid characters."

[title]

type = text
alt = Title
rule 1 = not empty, You must enter a title for your doc.

[sort_weight]

type = text
alt = Sorting Weight
setDefault = "0"

[instructions]

type = template
template = "<tr><td colspan=`2` align=`right`><a href=`{site/prefix}/index/siteforge-doc-instructions-action` target=`_blank`>{intl Wiki Formatting Rules}</a></td></tr>"

[body]

type = textarea
alt = Contents
rule 1 = not empty, You must enter some contents for your doc.
labelPosition = left
cols = 50
rows = 20

[submit_button]

type = msubmit
button 1 = Save
button 2 = "Preview, onclick=`return siteforge_preview (this.form)`"

; */ ?>