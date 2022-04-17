composer.lock: composer.json
	composer2 install

vendor/autoload.php: composer.lock

index.md: notes/*.md attachments/* vendor/autoload.php bin/render
	bin/render notes/*.md > $@

public: notes/*.md attachments/* vendor/autoload.php index.md
	mkdir $@
	cp -r notes $@/notes
	cp -r attachments $@/attachments
	cp index.md public/index.md

clean:
	rm -rf public index.md
