## Note:
#### If without special intruduce, master branch's charset is for utf-8. 
## HowTo:
#### Keep your php environment version is not high than 5.3.29 ,and the http application is best to be apache.
#### git clone this repo to ~/.mozilla/firefox/${hash}.default/scrapbook dir.
#### set ~/.mozilla/firefox/${hash}.default/scrapbook dir as your via website root directory.
#### run the php file to refresh the index.html to generate atags with. "~/.mozilla/firefox/aagiok5y.default/scrapbook/data/${art_id}/index.html".
#### Access index.html redirect in repo root dir to view bookmarks.
#### To show the directory your access such as data directory, you maybe need to set the "Options Index" in you vhosts.conf. <a href="./howto/showDirInApache/index.html">How to set the "Options Index" in you vhosts.conf?</a> May be I will write some php code show the directory in /data directory, but maye not. Maybe I will write all this demo in javascript. 
## Note:
#### If the article contains angle-qoute,  the atag would not generate will. Maybe it will be fixed later.
#### The php index.php generator will generate index.htm at first, if index.htm has been generated, one will copy to index.html. Maybe this is unnecessary, but it's sure that it's safe, the index.html will exist all the time. And I think file_put_contents is slowwer than copy to do this.
