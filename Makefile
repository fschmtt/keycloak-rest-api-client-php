php = docker compose run --rm --no-deps php

.PHONY: test
test:
	$(php) vendor/bin/phpunit

.PHONY: analyze
analyze:
	$(php) vendor/bin/phpstan analyze src tests
	$(php) vendor/bin/psalm src

.PHONY: sniff
sniff:
	$(php) vendor/bin/phpcs --standard=PSR12 src tests

.PHONY: fix-cs
fix-cs:
	$(php) vendor/bin/phpcbf --standard=PSR12 src tests