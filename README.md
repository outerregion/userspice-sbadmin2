This theme was originally based on the SB Admin 2 theme. 
The bulk of the work in converting it was done by Sneakypeet on Discord. 

As the User menu is hard coded in the top right, you do not need them in the side menu. 
To hide the User dropdown and link to the User, create a new permission group. Go into Navigation and Allow only that permission group to see it for the dropdown and the {{username}}.
These will be ID's 2 and 3 in the Navigation. 

Alternatively, you can remove the link and the items in the dropdown. This is not recommended unless as it will break other themes.

There are comments in the code on where to change various options. They will be visable with a view source.