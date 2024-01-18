1. Clone the repository `git clone git@github.com:kazmin89/testTask.git`
2. Run `composer install`
3. Run application `php run.php`
4. Run phpunit test `vendor/phpunit/phpunit/phpunit test/
   `

Пояснения к коду:

Класс `FootballScoreBoard` представляет собой интерактивную доску и реализовивает методи: 

- `startGame` - Добавляет на доску матч и виводит об єтом информацию ( в консоль) 
- `updateScore` - Обновляет счет матча
- `printSummaryTable` - Виводит таблицу текущих матчей с учетом сортировки
- `finishGame` - Убирает матч с доски

Пример результата
<pre>
$ php run.php

Game started: Mexico 0-0 Canada
Score updated: Mexico 0-5 Canada
Game started: Spain 0-0 Brazil
Score updated: Spain 10-2 Brazil
Game started: Germany 0-0 France
Score updated: Germany 2-2 France
Game started: Uruguay 0-0 Italy
Score updated: Uruguay 6-6 Italy
Game started: Argentina 0-0 Australia
Score updated: Argentina 3-1 Australia

Summary table
1. Spain 10-2 Brazil 
2. Uruguay 6-6 Italy 
3. Mexico 0-5 Canada 
4. Germany 2-2 France 
5. Argentina 3-1 Australia 

Game finished: Mexico 0-5 Canada
Game finished: Spain 10-2 Brazil
Game finished: Germany 2-2 France
Game finished: Uruguay 6-6 Italy
Game finished: Argentina 3-1 Australia

</pre>