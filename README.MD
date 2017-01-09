## HowTo:
#### git clone this repo to ~/.mozilla/firefox/${hash}.default/scrapbook dir.
#### run the php file to refresh the index.html to generate atags with "~/.mozilla/firefox/aagiok5y.default/scrapbook/data/${art_id}/index.html".
#### Access index.html redirect in repo root dir to view bookmarks.
## Note:
#### If the article contains angle-qoute,  the atag would not generate will. Maybe it will be fixed later.
#### The php index.php generator will generate index.htm at first, if index.htm has been generated, one will copy to index.html. Maybe this is unnecessary, but it's sure that it's safe, the index.html will exist all the time. And I think file_put_contents is slowwer than copy to do this.
