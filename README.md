# Тестовое задание PHP+MySQL+Ajax
## Программа - "Телефонная книга".
### Задача:
Организовать телефонную книгу для пользователей. Любой желающий может зарегистрироваться и создать себе телефонную книгу.
Организовать авторизацию; загрузку файлов jpg, png; редактирование и отображение информации.

### Страницы:

1.	Страница авторизации
2.	Страница регистрации (Требования к логину: только латинские буквы и цифры. Проверка почты на правильность. Требование к паролю: должен содержать и цифры, и буквы.) 
3.	Страница работы с книгой (все операции без перезагрузки страницы, с помощью ajax)
Таблицы:
1.	Таблица пользователей, поля: логин, пароль и т.д.
2.	Таблица с записями книги: данные записей (Имя, Фамилия, телефон, email, фото-записи и т.д….)

### Функции:

1.	Авторизация
2.	Добавление новой записи и загрузка к ней картинки
3.	Редактирование существующих записей
4.	Отображение, как общего списка, так и отдельных записей, сортировка списка
5. создать функцию, которая переводила бы цифровое обозначение цифр в буквенное до числа 999 999999999, например, 21125 => 'двадцать одна тысяча сто двадцать пять'. Применить ее к отображению телефонного номера в отдельных записях 
6.	Выход

### Условия:

1.	Версия PHP 5.5.38
2.	Не использовать фреймворки и библиотеки PHP
3.	Использовать 
a.	JQuery
b.	Создать простой класс Db (singleton) с использованием PDO для обращений к базе MySQL
c.	MVC-подход (разделение как минимум на контроллер и представление)
d.	Для форм авторизации и регистрации проверка Captcha
e.	В качестве основы для оформления использовать Bootstrap http://getbootstrap.com/
4.	обязательная проверка полей со стороны клиента и сервера
5.	Файл картинки не более 2Mb, только jpg, png
Результат задания:
1.	Файл db-structure.sql
2.	PHP файлы
3.	Сколько времени было потрачено на выполнение задания?


# Комментарии к решению

0. Попытался использовать подход DDD в работе с объектами "реального мира", но т.к. на практике я никогда не работал в чистой
    парадигме DDD, то получилось не очень - мне не нравится. Созданный ORM очень тупой)). Также получилась кривая валидация 
    моделей - эксепшены кидаются на отдельное поле, а не на все поля сразу. 
    
    В коде не хватает защиты от "дурака", т.е. отдавать такой код на поддержку другому человеку нельзя.
    
1. В списке осознанно возвращаются все записи без пагинации - это плохо... Но в контексте тестовой задачи это не важно.

2. Сортировка в списке сделана в php, по той причине, что нет пагинации.
  
3. Сортировка списка сделана не через ajax, а по классике. Т.к. даже при ajax нужно менять параметры в строке адреса
 для удобства пользователя, а т.к. в текущем случае это в целом для пользователя без разницы, то по классике проще.
 
4. После успешного сохранения номера нужно обновлять список номеров. Но здесь всплывают такие нюансы как:
    - обновить просто всю страницу или отдельную запись. Если отдельную запись, то как быть с сортировкой...
    - для простоты обновления списка нужно переделать ответ сервера на ajax с html на json, но есть ли смысл тратить на это время?
    
5. На фронте валидации формы сделана только на странице регистрации.

6. Капча сделана в виде "решения примера", тратить время на что-то более серьезное просто бессмысленно, т.к. в опенсорсе готовых решений в избытке.