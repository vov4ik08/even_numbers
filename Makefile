# Starts the project and runs composer install
up:
	docker compose up --build -d app
	docker compose exec app composer install
	docker compose exec app chown -R www-data:www-data /var/www/html/runtime
	docker compose exec app chown -R www-data:www-data /var/www/html/web/assets
	docker compose exec app chmod -R 755 /var/www/html/runtime
	docker compose exec app chmod -R 755 /var/www/html/web/assets

# Stops the project
down:
	docker compose down

# Runs tests in a separate container, then stops the container
test:
	# Start the test container and run composer install
	docker compose up -d --build --no-deps test-container
	docker compose exec test-container composer install

	# Run the tests inside the container
	docker compose exec test-container vendor/bin/codecept run --group evenNumbersGroup

	# Stop the test container after tests are completed
	docker compose stop test-container
