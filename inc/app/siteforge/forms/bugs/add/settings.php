; <?php /*

[Form]

error_mode = all
uploadFiles = false
extra = "enctype=`multipart/form-data`"

[proj]

type = hidden

[subject]

alt = Summary
type = text
extra = "size=`40`"

[instructions]

type = template
template = "<tr><td colspan=`2` align=`right`><a href=`{site/prefix}/index/siteforge-doc-instructions-action` target=`_blank`>{intl Wiki Formatting Rules}</a></td></tr>"

[body]

alt = Details
type = textarea
labelPosition = left
rows = 12
cols = 50

[file]

alt = Attach a File
type = file

[submit_button]

type = msubmit
button 1 = Send
button 2 = "Preview, onclick=`return siteforge_preview (this.form)`"

; */ ?>