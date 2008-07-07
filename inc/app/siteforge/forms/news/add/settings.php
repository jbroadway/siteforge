; <?php /*

[Form]

error_mode = all

[proj]

type = hidden

[headline]

type = text
alt = Headline

[instructions]

type = template
template = "<tr><td colspan=`2` align=`right`><a href=`{site/prefix}/index/siteforge-doc-instructions-action` target=`_blank`>{intl Wiki Formatting Rules}</a></td></tr>"

[body]

type = textarea
alt = Body
labelPosition = left
cols = 40
rows = 8

[submit_button]

type = msubmit
button 1 = Submit
button 2 = "Preview, onclick=`return siteforge_preview (this.form)`"

; */ ?>