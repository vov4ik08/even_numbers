# Even Numbers

REST API service for processing numerical data.

## Project Structure

- `docker/` — Directory containing Docker build configurations.
- `controllers/` — Controllers with code of  application.
- `services/` — Application services
- `tests/` — Tests for your application.
- `docker-compose.yaml` — File for starting containers.
- `Makefile` — File with commands for project management.

## Requirements

- Docker
- Docker Compose
- PHP 8.3
- PHP-FPM
- NGINX
- Composer (for dependency management)

## Setting Up the Project

### 1. Clone the repository

```bash
git clone https://github.com/vov4ik08/even_numbers.git
cd even_numbers
```

### 2. Run Project

In the home path of the projet run:

```bash
make up
```

### 3. Stop Project

In the home path of the projet run:

```bash
make down
```

### 3. Run test

In the home path of the projet run:

```bash
make test
```

### 3. Api Request for even Numbers


```http
  POST /api/sum-even
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `numbers` | `array` | **Required**. Array of numbers |

| Header | Value     
| :-------- | :------- 
| `Accept` | `application/json` 
