php = docker compose run --rm --no-deps php

.PHONY: test
test: test-unit test-integration

.PHONY: test-unit
test-unit:
	$(php) vendor/bin/phpunit --testsuite unit

.PHONY: test-integration
test-integration:
	$(php) vendor/bin/phpunit --testsuite integration

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