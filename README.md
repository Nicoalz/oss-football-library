# oss-football-library
Football library
## Installation

```bash
composer require oss/football-library
```

## Local development

```bash
composer install
```

```bash
php vendor/bin/phpstan analyse src --level=max
```

## Features

- [x] Get Most popular Competitions using function `getPopularCompetitions()`
- [x] Get Best Winner Teams using function `getBestWinnerTeams(string $competitionId)`