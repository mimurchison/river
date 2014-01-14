River
====

Demo: http://www.dhariri.com/feed

**Thanks:**
- [James Mallison](https://github.com/J7mbo) for ['twitter-api-php'](https://github.com/J7mbo/twitter-api-php)
- [Hakim El Hattab](https://github.com/hakimel) for ['stroll.js'](https://github.com/hakimel/stroll.js)
- [Ivan Drinchev](https://github.com/drinchev) for ['monosocialiconsfont'](https://github.com/drinchev/monosocialiconsfont)
- [Daniel Bruce](http://danielbruce.se/) for ['Entypo'](http://www.entypo.com/)
- [Nicolas Gallagher](https://github.com/necolas) for ['normalize.css'](https://github.com/necolas/normalize.css)


Feed is an open-source social network feed agregation thing. In its current form its basically just a tiwtter feed with instagram, github and dribbble support.

**To make your own you'll need:**
- A fork of this repo
- A Server running a recent version of Apache, PHP and MySQL
- A Database
- A Table (call this **tbl_posts**) *(structure: id, service_id, datetime, category, service, data, attachment, permalink)*
- A Twitter Developer account with Auth (If you want Twitter access)
- An Instagram Developer access token (If you want instagram access)

To edit the CSS without LESS, just delete the **styles.less** file and edit the **styles.css** file

**Use Notes:**

- Access tokens, keys, passwords, etc... All go in the **pass.php** file.
- In the **/data/fetch.php** file you'll see the four modules I've created so far. These modules are specific to each API and can be commented/deleted out. If you have suggestions of a better way to handle this (separate files and an options inclusion?) please let me know by opening an enhancement issue.
- I will try to provide as much support as possible to those trying to create their own, but of course it will be difficult given there's a lot of back end stuff going on.

Send me a tweet [@davehariri](https://twitter.com/davehariri) if you succesfully make your own!
