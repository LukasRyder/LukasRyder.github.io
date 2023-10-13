composer.lock: composer.json
	composer2 update

vendor/autoload.php: composer.lock
	composer2 install

index.md: notes/*.md attachments/* vendor/autoload.php bin/render
	bin/render notes/*.md > $@.tmp
	mv -f $@.tmp $@

public: notes/*.md attachments/* vendor/autoload.php index.md
	mkdir $@
	cp -r notes $@/notes
	cp -r attachments $@/attachments
	cp index.md $@/index.md
	cp CNAME $@/CNAME
	cp _config.yml $@/_config.yml

clean:
	rm -rf public index.md
