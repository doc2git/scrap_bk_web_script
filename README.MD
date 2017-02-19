## Note:
#### This is gb2312 version. 
##### the get_content.php will get the contents of the index.html in ${data_dir}./${id}./ , and use iconv()  function to convert the charset which are generate by default by ScrapBook extension of firefox, from utf-8 to gb2312.
##### Also, the field '<script charset="utf-8"' will be replace as '<script charset="gb2312"', and the 'pt charset="UTF-8"' will be replace as '<script charset="utf-8"'.
## HowTo:
#### git clone this repo to ~/.mozilla/firefox/${hash}.default/scrapbook dir.
#### run the php file to refresh the index.html to generate atags with "~/.mozilla/firefox/aagiok5y.default/scrapbook/data/${art_id}/index.html".
#### Access index.html redirect in repo root dir to view bookmarks.
## Note:
#### If the article contains angle-qoute,  the atag would not generate will. Maybe it will be fixed later.
#### The php index.php generator will generate index.htm at first, if index.htm has been generated, one will copy to index.html. Maybe this is unnecessary, but it's sure that it's safe, the index.html will exist all the time. And I think file_put_contents is slowwer than copy to do this.
