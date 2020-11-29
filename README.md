# dbb
dbb is a distributed forum type thing similar to netnews, but its over http and push based.

## threads and catagories
dbb is organized in thread names, with the format `<catagory>.<thread number>`, eg `biking.1274`

## trying it out

you can try posting something on one of the [public servers](https://github.com/xfnw/dbb/wiki/known-servers)
using form.html, or with curl:

```
curl https://xfnw.ttm.sh/dbb/submit.php -F "thread=test.12" -F "nickname=mr test" -F "content=hello this is a post!"
```

most servers allow their archives to be viewed by replacing `submit.php` with `data/threads`, eg https://xfnw.ttm.sh/dbb/data/threads


## host your own
stick it into somewhere that hosts php stuff, and then run `sh setup.sh` to setup the data directory.
if theres no shell access, just make a data dir, a threads dir inside of it, and received.txt in the data dir,
and change the permissions to allow php to edit them.

copy `config.php.example` to `config.php` and stick some servers from
[this list](https://github.com/xfnw/dbb/wiki/known-servers) into the $peers
part. put the ones with the lowest ping and most reliable at the top

then go add your server to that list if you want, and go bap someone else who runs a server to add you to their $peers
so you will not miss new posts

