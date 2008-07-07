; <?php /*

[Form]

error_mode = all

[topic]

type = hidden

[post]

type = hidden

[subject]

type = text
alt = Subject
extra = "size=`40`"

[instructions]

type = template
template = "<tr><td colspan=`2` align=`right`><a href=`{site/prefix}/index/siteforge-doc-instructions-action` target=`_blank`>{intl Wiki Formatting Rules}</a></td></tr>"

[body]

type = textarea
alt = Message
labelPosition = left
rows = 16
cols = 60

[submit_button]

type = msubmit
button 1 = Post
button 2 = "Preview, onclick=`return siteforge_preview (this.form)`"

; */ ?>