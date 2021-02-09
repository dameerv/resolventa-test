# resolventa-test
Test task for ResolventaGroup

1) `cd laradock`
2) `[sudo] docker-compose up -d nginx postgres`
3) `[sudo] docker-compose exec workspace bash` 
3) `composer install`
4) `bin/console doctrine:databasse:create`
5) `bin/console doctrine:migrations:migrate`
6) `bin/console doctrine:fixtures:load`

Пример ответа:
GET http://localhost/employee-schedule?startDate=2021-01-01&endDate=2021-01-12&employeeId=1