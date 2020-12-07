@extends('layouts.mainLayout')
@section('content')

<div class="themes">
    <h1 class="themes__title">Базы данных</h1>
    <div class="theme">
        <p class="theme__text">
            Laravel поддерживает четыре системы баз данных, с которыми можно работать с помощью сырого SQL, гибкого построителя запросов или Eloquent ORM: <br>
            MySQL 5.6+<br>
            PostgreSQL 9.4+<br>
            SQLite 3.8.8+<br>
            SQL Server 2017+<br>
        </p>
        <h3 class="theme__subtitle">
            Настройка
        </h3>
        <p class="theme__text">
            Настройки работы с БД хранятся в файле config/database.php. Здесь вы можете указать все используемые вами соединения к БД, а также задать соединение по умолчанию. <br>
            Примеры настройки большинства поддерживаемых видов подключений находятся в этом же файле.
        </p>
        <h4 class="theme_subtitlex2">
            Настройка SQLite
        </h4>
        <p class="theme__text">
            После создания новой базы данных SQLite при помощи команды touch database/database.sqlite, вы можете легко настроить переменные вашей среды для этой новой базы данных, используя её абсолютный путь:
        </p>
<code>
<pre>
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
</pre>
</code>
        <p class="theme__text">
            Чтобы включить ограничения внешнего ключа для соединений SQLite, вы должны установить для переменной среды DB_FOREIGN_KEYS значение true:
        </p>
<code>
<pre>
DB_FOREIGN_KEYS=true
</pre>
</code>
        <h4 class="theme_subtitlex2">
            Настройка с использованеим ссылок
        </h4>
        <p class="theme__text">
            Обычно соединения с базой данных настраиваются с использованием нескольких значений конфигурации, таких как host, database, username, password и так далее. Каждое из этих значений конфигурации имеет собственную соответствующую переменную среды. Это означает, что при настройке информации о подключении к базе данных на производственном сервере вам необходимо управлять несколькими переменными среды.
            <br><br>
            Некоторые поставщики управляемых баз данных, такие как Heroku, предоставляют единый «URL» базы данных, который содержит всю информацию о подключении к базе данных в одной строке. Пример URL-адреса базы данных может выглядеть примерно так:
<code>
<pre>
mysql://корень:пароль@127.0.0.1/forge?charset=UTF-8
</pre>
</code>
        </p>
        <p class="theme__text">
            Эти URL-адреса обычно следуют стандартному соглашению о схеме:
        </p>
<code>
<pre>
драйвер://имя_пользователя:пароль@хост:порт/база_данных?параметры
</pre>
</code>
        <p class="theme__text">
            Для удобства Laravel поддерживает эти URL-адреса в качестве альтернативы настройке базы данных с несколькими параметрами конфигурации. Если присутствует параметр конфигурации url (или соответствующей переменной среды DATABASE_URL), он будет использоваться для извлечения информации о подключении к базе данных и учетных данных.
        </p>
        <h3 class="theme__subtitle">
            Соединения для чтения и записи
        </h3>
        <p class="theme__text">
            Иногда вам может понадобиться использовать разные подключения к базе данных: одно для запросов SELECT, а другое для запросов INSERT, UPDATE и DELETE. В Laravel это делается очень просто, и всегда будет использоваться соответствующее соединение, используете ли вы сырые запросы, построитель запросов или Eloquent ORM.
            <br><br>
            Чтобы увидеть, как должны быть настроены соединения чтения/записи, давайте посмотрим на этот пример:
        </p>
        <code>
        <pre>
'mysql' => [
    'read' => [
        'host' => [
            '192.168.1.1',
            '196.168.1.2',
        ],
    ],
    'write' => [
        'host' => [
            '196.168.1.3',
        ],
    ],
    'sticky' => true,
    'driver' => 'mysql',
    'database' => 'database',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
],
        </pre>
        </code>
        <p class="theme__text">
            Обратите внимание, что в массив настроек были добавлены три элемента: read, write and sticky. Элементы read и write представляют собой массив с одним элементом host. Остальные параметры БД для подключений чтения/записи будут заимствованы из основного массива 'mysql'.
            <br><br>
            Вам стоит размещать элементы в массивах read и write, только если вы хотите переопределить их значения из основного массива. Таким образом, в этом случае, 192.168.1.1 и 192.168.1.2 будут использоваться как хосты для подключения «чтения», а 192.168.1.3 — для подключения «записи». Учётные данные для БД, префикс, набор символов, и все другие параметры основного массива 'mysql' будут использованы для обоих подключений.
        </p>
        <h4 class="theme_subtitlex2">
            Опция sticky
        </h4>
        <p class="theme__text">
            Параметр sticky - это необязательное значение, которое можно использовать для немедленного чтения записей, которые были записаны в базу данных во время текущего цикла запроса. Если опция sticky включена и операция «записи» была выполнена в отношении базы данных в течение текущего цикла запроса, любые дальнейшие операции «чтения» будут использовать соединение «запись». Это гарантирует, что любые данные, записанные во время цикла запроса, могут быть немедленно прочитаны из базы данных во время того же запроса. Вам решать, является ли это желаемым поведением для вашего приложения.
        </p>
        <h2 class="theme__title">
            Использование нескольких соединений с БД
        </h2>
        <p class="theme__text">
            При использовании нескольких соединений с БД вы можете получить доступ к каждому из них через метод connection() фасада DB. Передаваемое в этот метод имя name должно соответствовать одному из перечисленных в файле config/database.php соединений:
        </p>
<code>
<pre>
$users = DB::connection('foo')->select(...);
</pre>
</code>
        <p class="theme__text">
            Вы также можете получить низкоуровневый объект PDO для этого подключения методом getPdo():
        </p>
<code>
<pre>
$pdo = DB::connection()->getPdo();
</pre>
</code>
<h3 class="theme__subtitle">
    Выполнение сырых SQL-запросов
</h3>
<p class="theme__text">
    Когда вы настроили соединение с базой данных, вы можете выполнять запросы, используя фасад DB. Этот фасад имеет методы для каждого типа запроса: select, update, insert, delete и statement.
</p>
<h4 class="theme_subtitlex2">
    Выполнение запроса SELECT
</h4>
<p class="theme__text">
    Чтобы выполнить базовый запрос, можно использовать метод select() фасада DB:
</p>
<code>
<pre>
< ?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::select('select * from users where active = ?', [1]);
        return view('user.index', ['users' => $users]);
    }
}
</pre>
</code>
<p class="theme__text">
    Первый аргумент метода select() — сырой SQL-запрос, второй — любые связки параметров для прикрепления к запросу. Обычно это значения ограничений условия where. Привязка параметров обеспечивает защиту от SQL-инъекций.
    <br><br>
    Метод select() всегда возвращает массив результатов. Каждый результат в массиве — объект PHP StdClass, что позволяет вам обращаться к значениям результатов:
</p>
<code>
<pre>
foreach ($users as $user) {
    echo $user->name;
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Использование привязки имён
</h4>
<p class="theme__text">
    Вместо использования знака вопроса ? для обозначения привязки параметров, вы можете выполнить запрос, используя привязку по имени:
</p>
<code>
<pre>
$results = DB::select('select * from users where id = :id', ['id' => 1]);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Выполнение запроса INSERT
</h4>
<p class="theme__text">
    Чтобы выполнить запрос insert, можно использовать метод insert() фасада DB. Как и select(), данный метод принимает сырой SQL-запрос первым аргументом, а вторым — привязки:
</p>
<code>
<pre>
DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Выполнение запроса UPDATE
</h4>
<p class="theme__text">
    Для обновления существующих записей в БД используется метод update(), который возвращает количество изменённых записей:
</p>
<code>
<pre>
$affected = DB::update('update users set votes = 100 where name = ?', ['John']);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Выполнение запроса DELETE
</h4>
<p class="theme__text">
    Для удаления записей из БД используется метод delete(), который возвращает количество изменённых записей:
</p>
<code>
<pre>
$deleted = DB::delete('delete from users');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Выполнение запроса общего типа
</h4>
<p class="theme__text">
    Некоторые запросы к БД не возвращают никаких значений. Для операций такого типа можно использовать метод statement() фасада DB:
</p>
<code>
<pre>
DB::statement('drop table users');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Запуск неподготовленного запроса
</h4>
<p class="theme__text">
    Иногда вам может потребоваться выполнить инструкцию SQL без привязки каких-либо значений. Для этого вы можете использовать неподготовленный метод фасада БД:
</p>
<code>
<pre>
DB::unprepared('update users set votes = 100 where name = "Dries"');
</pre>
</code>
<p class="theme__text">
    Никогда не используйте этот метод со значениями, контролируемые пользователем.
</p>
<h4 class="theme_subtitlex2">
    Implicit Commits
</h4>
<p class="theme__text">
    При использовании statement фасада DB и unprepared методов в транзакциях вы должны быть осторожны, чтобы избегать операторов, вызывающих implicit commits. Эти операторы заставят ядро базы данных косвенно зафиксировать всю транзакцию, в результате чего Laravel не будет знать об уровне транзакции базы данных. Примером такого оператора является создание таблицы базы данных:
</p>
<code>
<pre>
DB::unprepared('create table a (col varchar(1) null)');
</pre>
</code>
<p class="theme__text">
    Пожалуйста, обратитесь к руководству MySQL за списком всех операторов, которые запускают implicit commits.
</p>
<h3 class="theme__subtitle">Прослушивание событий запросов</h3>
<p class="theme__text">
    Если вы хотите получать каждый выполненный вашим приложением SQL-запрос, используйте метод listen(). Этот метод полезен для журналирования запросов и отладки. Вы можете зарегистрировать свой слушатель запросов в сервис-провайдере:
</p>
<code>
<pre>
< ?php
namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }
    public function boot()
    {
        DB::listen(function ($query) {
            // $query->sql
            // $query->bindings
            // $query->time
        });
    }
}
</pre>
</code>
<h3 class="theme__subtitle">Транзакции</h3>
<p class="theme__text">
    Для выполнения набора запросов внутри одной транзакции вы можете использовать метод transaction() фасада DB. Если в замыкании транзакции произойдёт исключение, она автоматически откатится. А если замыкание выполнится успешно, транзакция автоматически применится к БД. Вам не стоит переживать об этом при использовании метода transaction():
</p>
<code>
<pre>
DB::transaction(function () {
    DB::table('users')->update(['votes' => 1]);

    DB::table('posts')->delete();
});
</pre>
</code>
<h4 class="theme_subtitlex2">Обработка взаимных блокировок</h4>
<p class="theme__text">
    Метод transaction() принимает второй необязательный аргумент, с помощью которого задаётся число повторных попыток транзакции при возникновении взаимной блокировки (англ. deadlock). После истечения этих попыток будет выброшено исключение:
</p>
<code>
<pre>
DB::transaction(function () {
    DB::table('users')->update(['votes' => 1]);

    DB::table('posts')->delete();
}, 5);
</pre>
</code>
<h4 class="theme_subtitlex2">Ручное использование транзакций</h4>
<p class="theme__text">
    Если вы хотите запустить транзакцию вручную и иметь полный контроль над её откатом и применением, используйте метод beginTransaction() фасада DB:
</p>
<code>
<pre>
    DB::beginTransaction();
</pre>
</code>
<p class="theme__text">
    Вы можете откатить транзакцию методом rollback():
</p>
<code>
<pre>
    DB::rollback();
</pre>
</code>
<p class="theme__text">
    Наконец, вы можете применить транзакцию методом commit():
</p>
<code>
<pre>
    DB::commit();
</pre>
</code>
<p class="theme__text">Методы фасада DB для транзакций также контролируют транзакции построителя запросов и Eloquent ORM.</p>
<p class="theme__text">
    Транзакция — особое состояние БД, в котором выполняемые запросы либо все вместе успешно завершаются, либо (в случае ошибки) все их изменения откатываются. Это позволяет поддерживать целостность внутренней структуры данных. К примеру, если вы вставляете запись о заказе, а затем в отдельную таблицу добавляете товары, то при неуспешном выполнении скрипта (в том числе падения веб-сервера, ошибки в запросе и пр.) СУБД автоматически удалит запись о заказе и все товары, которые вы успели добавить — прим. пер.
</p>
<h3 class="theme__subtitle">Подключение к консоли базы данных</h3>
<p class="theme__text">
    Чтобы подключиться к консоли базы данных, вы можете использовать Artisan команду:
</p>
<code>
<pre>
php artisan db
</pre>
</code>
<code>
<pre>
php artisan db mysql
</pre>
</code>
    </div>
    <div class="theme">
        <h2 class="theme__title">
            Конструктор запросов
        </h2>
        <p class="theme__text">
            Конструктор запросов Laravel предоставляет удобный, выразительный интерфейс для создания и выполнения запросов к базе данных. Он может использоваться для выполнения большинства типов операций и работает со всеми поддерживаемыми СУБД.
            <br><br>
            Конструктор запросов Laravel использует привязку параметров к запросам средствами PDO для защиты вашего приложения от SQL-инъекций. Нет необходимости экранировать строки перед их передачей в запрос.
            <br><br>
            PDO не поддерживает имена столбцов привязки. Следовательно, вы никогда не должны позволять пользовательскому вводу диктовать имена столбцов, на которые ссылаются ваши запросы, включая столбцы «порядок по» и т. Д. Если вы должны разрешить пользователю выбирать определенные столбцы для запроса, всегда проверяйте имена столбцов по белому - список разрешенных столбцов.
        </p>
        <h3 class="theme__subtitle">Получение результатов</h3>
        <h4 class="theme_subtitlex2">Получение всех записей таблицы</h4>
        <p class="theme__text">
            Используйте метод table() фасада DB для создания запроса. Метод table() возвращает экземпляр конструктора запросов для данной таблицы, позволяя вам «прицепить» к запросу дополнительные условия и в итоге получить результат методом get():
        </p>
<code>
<pre>
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();

        return view('user.index', ['users' => $users]);
    }
}
</pre>
</code>
<p class="theme__text">
    Метод get() возвращает объект Illuminate\Support\Collection c результатами, в котором каждый результат — это экземпляр PHP-объекта StdClass. Вы можете получить значение каждого столбца, обращаясь к столбцу как к свойству объекта:
</p>
<code>
<pre>
foreach ($users as $user) {
    echo $user->name;
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Получение одной строки/столбца из таблицы
</h4>
<p class="theme__text">
    Если вам необходимо получить только одну строку из таблицы БД, используйте метод first(). Этот метод вернёт один объект StdClass:
</p>
<code>
<pre>
$user = DB::table('users')->where('name', 'John')->first();
</pre>
</code>
<p class="theme__text">
    Если вам не нужна вся строка, вы можете извлечь одно значение из записи методом value(). Этот метод вернёт значение конкретного столбца:
</p>
<code>
<pre>
$email = DB::table('users')->where('name', 'John')->value('email');
</pre>
</code>
<p class="theme__text">
    Чтобы получить одну строку по ее значению столбца id, используйте метод find:
</p>
<code>
<pre>
$user = DB::table('users')->find(3);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Получение списка всех значений одного столбца
</h4>
<p class="theme__text">
    Если вы хотите получить массив значений одного столбца, используйте метод pluck(). В этом примере мы получим коллекцию названий ролей:
</p>
<code>
<pre>
$titles = DB::table('roles')->pluck('title');

foreach ($titles as $title) {
  echo $title;
}
</pre>
</code>
<p class="theme__text">
    Вы можете указать произвольный ключ для возвращаемой коллекции:
</p>
<code>
<pre>
$roles = DB::table('roles')->pluck('title', 'name');

foreach ($roles as $name => $title) {
  echo $title;
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Получение результатов из таблицы «по кускам»
</h4>
<p class="theme__text">
    Если вам необходимо обработать тысячи записей БД, попробуйте использовать метод chunk(). Этот метод получает небольшой «кусок» результатов за раз и отправляет его в замыкание для обработки. Этот метод очень полезен для написания Artisan-команд, которые обрабатывают тысячи записей. Например, давайте обработаем всю таблицу users «кусками» по 100 записей:
</p>
<code>
<pre>
DB::table('users')->orderBy('id')->chunk(100, function ($users) {
    foreach ($users as $user) {
        //
    }
});
</pre>
</code>
<p class="theme__text">
    Вы можете остановить обработку последующих «кусков» вернув false из замыкания:
</p>
<code>
<pre>
DB::table('users')->orderBy('id')->chunk(100, function ($users) {
    // Обработка записей...

    return false;
});
</pre>
</code>
<p class="theme__text">
    Если вы обновляете записи базы данных во время фрагментирования результатов, результаты ваших фрагментов могут измениться неожиданным образом. Таким образом, при обновлении записей при фрагментировании всегда лучше использовать метод chunkById. Этот метод автоматически разбивает результаты на страницы на основе первичного ключа записи:
</p>
<code>
<pre>
DB::table('users')->where('active', false)
->chunkById(100, function ($users) {
    foreach ($users as $user) {
        DB::table('users')
            ->where('id', $user->id)
            ->update(['active' => true]);
    }
});
</pre>
</code>
<p class="theme__text">
    При обновлении или удалении записей внутри обратного вызова фрагмента любые изменения первичного ключа или внешних ключей могут повлиять на запрос фрагмента. Это может потенциально привести к тому, что записи не будут включены в результаты по фрагментам.
</p>
<h4 class="theme_subtitlex2">
    Агрегатные функции
</h4>
<p class="theme__text">
    Конструктор запросов содержит множество агрегатных методов, таких как count, max, min, avg и sum. Вы можете вызывать их после создания своего запроса:
</p>
<code>
<pre>
$users = DB::table('users')->count();
$price = DB::table('orders')->max('price');
</pre>
</code>
<p class="theme__text">
    Разумеется, вы можете комбинировать эти методы с другими условиями:
</p>
<code>
<pre>
$price = DB::table('orders')
            ->where('finalized', 1)
            ->avg('price');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Определение наличия записей
</h4>
<p class="theme__text">
    Вместо использования метода count, чтобы определить, существуют ли какие-либо записи, соответствующие ограничениям вашего запроса, вы можете использовать методы exists и doesntExist:
</p>
<code>
<pre>
return DB::table('orders')->where('finalized', 1)->exists();
return DB::table('orders')->where('finalized', 1)->doesntExist();
</pre>
</code>
<h3 class="theme__subtitle">
    Выборка (SELECT)
</h3>
<h4 class="theme_subtitlex2">
    Указание столбцов для выборки
</h4>
<p class="theme__text">
    Само собой, не всегда вам необходимо выбрать все столбцы из таблицы БД. Используя метод select() вы можете указать необходимые столбцы для запроса:
</p>
<code>
<pre>
$users = DB::table('users')->select('name', 'email as user_email')->get();
</pre>
</code>
<p class="theme__text">
    Метод distinct() позволяет вернуть только отличающиеся результаты:
</p>
<code>
<pre>
$users = DB::table('users')->distinct()->get();
</pre>
</code>
<p class="theme__text">
    Если у вас уже есть экземпляр конструктора запросов и вы хотите добавить столбец к существующему набору для выборки, используйте метод addSelect():
</p>
<code>
<pre>
$query = DB::table('users')->select('name');
$users = $query->addSelect('age')->get();
</pre>
</code>
<h3 class="theme__subtitle">
    Сырые выражения
</h3>
<p class="theme__text">
    Иногда вам может понадобиться использовать уже готовое SQL-выражение в вашем запросе. Такие выражения вставляются в запрос напрямую в виде строк, поэтому будьте внимательны и не допускайте возможностей для SQL-инъекций! Для создания сырого выражения используйте метод DB::raw():
</p>
<code>
<pre>
$users = DB::table('users')
                    ->select(DB::raw('count(*) as user_count, status'))
                    ->where('status', '<>', 1)
                    ->groupBy('status')
                    ->get();
</pre>
</code>
<p class="theme__text">
    Необработанные операторы будут вводиться в запрос в виде строк, поэтому следует быть предельно осторожным, чтобы не создать уязвимости SQL-инъекций.
</p>
<h4 class="theme_subtitlex2">
    Необработанные методы
</h4>
<p class="theme__text">
    Вместо использования DB :: raw вы также можете использовать следующие методы для вставки необработанного выражения в различные части вашего запроса.
    <br><br>
    selectRaw <br>
    Метод selectRaw можно использовать вместо addSelect (DB :: raw (...)). Этот метод принимает необязательный массив привязок в качестве второго аргумента:
</p>
<code>
<pre>
$orders = DB::table('orders')
            ->selectRaw('price * ? as price_with_tax', [1.0825])
            ->get();
</pre>
</code>
<p class="theme__text">
    whereRaw / orWhereRaw <br>
    Методы whereRaw и orWhereRaw можно использовать для вставки необработанного предложения where в ваш запрос. Эти методы принимают необязательный массив привязок в качестве второго аргумента:
</p>
<code>
<pre>
$orders = DB::table('orders')
            ->whereRaw('price > IF(state = "TX", ?, 100)', [200])
            ->get();
</pre>
</code>
<p class="theme__text">
    havingRaw / orHavingRaw <br>
    Методы hasRaw и orHavingRaw могут использоваться для установки необработанной строки в качестве значения предложения Have. Эти методы принимают необязательный массив привязок в качестве второго аргумента:
</p>
<code>
<pre>
$orders = DB::table('orders')
            ->select('department', DB::raw('SUM(price) as total_sales'))
            ->groupBy('department')
            ->havingRaw('SUM(price) > ?', [2500])
            ->get();
</pre>
</code>
<p class="theme__text">
    orderByRaw <br>
    Метод orderByRaw может использоваться для установки необработанной строки в качестве значения предложения order by:
</p>
<code>
<pre>
$orders = DB::table('orders')
            ->orderByRaw('updated_at - created_at DESC')
            ->get();
</pre>
</code>
<p class="theme__text">
    groupByRaw <br>
    Метод groupByRaw может использоваться для установки необработанной строки в качестве значения предложения group by:
</p>
<code>
<pre>
$orders = DB::table('orders')
            ->select('city', 'state')
            ->groupByRaw('city, state')
            ->get();
</pre>
</code>
<h3 class="theme__subtitle">Объединения (JOIN)</h3>
<h4 class="theme_subtitlex2">Объединение INNER JOIN</h4>
<p class="theme__text">
    Конструктор запросов может быть использован для объединения данных из нескольких таблиц через JOIN. Для выполнения обычного объединения «inner join», используйте метод join() на экземпляре конструктора запросов. Первый аргумент метода join() — имя таблицы, к которой необходимо присоединить другие, а остальные аргументы указывают условия для присоединения столбцов. Как видите, вы можете объединять несколько таблиц одним запросом:
</p>
<code>
<pre>
$users = DB::table('users')
        ->join('contacts', 'users.id', '=', 'contacts.user_id')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->select('users.*', 'contacts.phone', 'orders.price')
        ->get();
</pre>
</code>
<h4 class="theme_subtitlex2">
    Объединение LEFT JOIN/Right JOIN
</h4>
<p class="theme__text">
    Для выполнения объединения «left join» или right join» вместо «inner join», используйте метод leftJoin()/rightJoin(). Этот метод имеет ту же сигнатуру, что и метод join():
</p>
<code>
<pre>
$users = DB::table('users')
        ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
        ->get();

$users = DB::table('users')
            ->rightJoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();
</pre>
</code>
<h4 class="theme_subtitlex2">
    Объединение CROSS JOIN
</h4>
<p class="theme__text">
    Для выполнения объединения CROSS JOIN используйте метод crossJoin() с именем таблицы, с которой нужно произвести объединение. CROSS JOIN формирует таблицу перекрестным соединением (декартовым произведением) двух таблиц:
</p>
<code>
<pre>
$users = DB::table('sizes')
        ->crossJoin('colours')
        ->get();
</pre>
</code>
<h4 class="theme_subtitlex2">
    Сложные условия объединения
</h4>
<p class="theme__text">
    Вы можете указать более сложные условия для объединения. Для начала передайте замыкание вторым аргументом метода join(). Замыкание будет получать объект JoinClause, позволяя вам указать условия для объединения:
</p>
<code>
<pre>
DB::table('users')->join('contacts', function ($join) {
    $join->on('users.id', '=', 'contacts.user_id')->orOn(...);
})->get();
</pre>
</code>
<p class="theme__text">
    Если вы хотите использовать стиль «where» для ваших объединений, то можете использовать для этого методы where() и orWhere(). Вместо сравнения двух столбцов эти методы будут сравнивать столбец и значение:
</p>
<code>
<pre>
DB::table('users')->join('contacts', function ($join) {
        $join->on('users.id', '=', 'contacts.user_id')
             ->where('contacts.user_id', '>', 5);
})->get();
</pre>
</code>
<h4 class="theme_subtitlex2">
    Подзапрос объединения
</h4>
<p class="theme__text">
    Вы можете использовать методы joinSub, leftJoinSub и rightJoinSub для присоединения запроса к подзапросу. Каждый из этих методов получает три аргумента: подзапрос, псевдоним таблицы и закрытие, определяющее связанные столбцы:
</p>
<code>
<pre>
$latestPosts = DB::table('posts')
                   ->select('user_id', DB::raw('MAX(created_at) as last_post_created_at'))
                   ->where('is_published', true)
                   ->groupBy('user_id');

$users = DB::table('users')
        ->joinSub($latestPosts, 'latest_posts', function ($join) {
            $join->on('users.id', '=', 'latest_posts.user_id');
        })->get();
</pre>
</code>
<h3 class="theme__subtitle">
    Слияние (UNION)
</h3>
<p class="theme__text">
    Конструктор запросов позволяет создавать слияния двух запросов вместе. Например, вы можете создать начальный запрос и с помощью метода union() слить его со вторым запросом:
</p>
<code>
<pre>
$first = DB::table('users')
            ->whereNull('first_name');

$users = DB::table('users')
            ->whereNull('last_name')
            ->union($first)
            ->get();
</pre>
</code>
<p class="theme__text">
    Также существует метод unionAll() с аналогичными параметрами.
    <br><br>
    method signuture - это параметры метода
    Например the same method signature as - с такими же параметрами как
</p>
<h3 class="theme__subtitle">
    Условия WHERE
</h3>
<h4 class="theme_subtitlex2">
    Простые условия WHERE
</h4>
<p class="theme__text">
    Для добавления в запрос условий where используйте метод where() на экземпляре конструктора запросов. Самый простой вызов where() требует три аргумента. Первый — имя столбца. Второй — оператор (любой из поддерживаемых базой данных). Третий — значение для сравнения со столбцом.
    <br><br>
    Например, вот запрос, проверяющий равенство значения столбца «votes» и 100:
</p>
<code>
<pre>
$users = DB::table('users')->where('votes', '=', 100)->get();
</pre>
</code>
<p class="theme__text">
    Для удобства, если вам необходимо просто проверить равенство значения столбца и данного значения, вы можете передать значение сразу вторым аргументом метода where():
</p>
<code>
<pre>
$users = DB::table('users')->where('votes', 100)->get();
</pre>
</code>
<p class="theme__text">
    Разумеется, вы можете использовать различные другие операторы при написании условия where:
</p>
<code>
<pre>
$users = DB::table('users')
                ->where('votes', '>=', 100)
                ->get();

$users = DB::table('users')
                ->where('votes', '<>', 100)
                ->get();

$users = DB::table('users')
                ->where('name', 'like', 'T%')
                ->get();
</pre>
</code>
<p class="theme__text">
    В функцию where() также можно передать массив условий:
</p>
<code>
<pre>
$users = DB::table('users')->where([
  ['status', '=', '1'],
  ['subscribed', '<>', '1'],
])->get();
</pre>
</code>
<h4 class="theme_subtitlex2">
    Условия ИЛИ
</h4>
<p class="theme__text">
    Вы можете сцепить вместе условия where, а также условия or в запросе. Метод orWhere() принимает те же аргументы, что и метод where():
</p>
<code>
<pre>
$users = DB::table('users')
                ->where('votes', '>', 100)
                ->orWhere('name', 'John')
                ->get();
</pre>
</code>
<p class="theme__text">
    Если вам нужно сгруппировать условие «или» в круглых скобках, вы можете передать Closure в качестве первого аргумента методу orWhere:
</p>
<code>
<pre>
$users = DB::table('users')
        ->where('votes', '>', 100)
        ->orWhere(function($query) {
            $query->where('name', 'Abigail')
                    ->where('votes', '>', 50);
        })
        ->get();

// SQL: select * from users where votes > 100 or (name = 'Abigail' and votes > 50)
</pre>
</code>
<h4 class="theme_subtitlex2">
    Дополнительные условия WHERE
</h4>
<p class="theme__text">
    В интервале (whereBetween / orWhereBetween) <br>
    Метод whereBetween() проверяет, что значения столбца находится в указанном интервале:
</p>
<code>
<pre>
$users = DB::table('users')
    ->whereBetween('votes', [1, 100])
    ->get();
</pre>
</code>
<p class="theme__text">
    Вне интервала (whereNotBetween / orWhereNotBetween)<br>
    Метод whereNotBetween() проверяет, что значения столбца находится вне указанного интервала:
</p>
<code>
<pre>
$users = DB::table('users')
                ->whereNotBetween('votes', [1, 100])
                ->get();
</pre>
</code>
<p class="theme__text">
    Фильтрация по совпадению с массивом значений (whereIn / whereNotIn / orWhereIn / orWhereNotIn)<br>
    Метод whereIn() проверяет, что значения столбца содержатся в данном массиве:
</p>
<code>
<pre>
$users = DB::table('users')
                ->whereIn('id', [1, 2, 3])
                ->get();
</pre>
</code>
<p class="theme__text">
    Метод whereNotIn() проверяет, что значения столбца не содержатся в данном массиве:
</p>
<code>
<pre>
$users = DB::table('users')
                ->whereNotIn('id', [1, 2, 3])
                ->get();
</pre>
</code>
<p class="theme__text">
    Если вы добавляете в свой запрос огромный массив целочисленных привязок, методы whereIntegerInRaw или whereIntegerNotInRaw могут использоваться для значительного сокращения использования памяти. <br><br>
    Поиск неустановленных значений (NULL) (whereNull / whereNotNull / orWhereNull / orWhereNotNull) <br>
    Метод whereNull() проверяет, что значения столбца равны NULL:
</p>
<code>
<pre>
$users = DB::table('users')
                ->whereNull('updated_at')
                ->get();
</pre>
</code>
<p class="theme__text">
    Метод whereNotNull() проверяет, что значения столбца не равны NULL:
</p>
<code>
<pre>
$users = DB::table('users')
                ->whereNotNull('updated_at')
                ->get();
</pre>
</code>
<p class="theme__text">
    Дата (whereDate / whereMonth / whereDay / whereYear / whereTime)<br>
    Метод whereDate() служит для сравнения значения столбца с датой:
</p>
<code>
<pre>
$users = DB::table('users')
    ->whereDate('created_at', '2016-12-31')
    ->get();
</pre>
</code>
<p class="theme__text">
    Метод whereMonth() служит для сравнения значения столбца с месяцем в году:
</p>
<code>
<pre>
$users = DB::table('users')
    ->whereMonth('created_at', '12')
    ->get();
</pre>
</code>
<p class="theme__text">
    Метод whereDay() служит для сравнения значения столбца с днём месяца:
</p>
<code>
<pre>
$users = DB::table('users')
    ->whereDay('created_at', '31')
    ->get();
</pre>
</code>
<p class="theme__text">
    Метод whereYear() служит для сравнения значения столбца с указанным годом:
</p>
<code>
<pre>
$users = DB::table('users')
    ->whereYear('created_at', '2016')
    ->get();
</pre>
</code>
<p class="theme__text">
    Метод whereTime может использоваться для сравнения значения столбца с определенным временем:
</p>
<code>
<pre>
$users = DB::table('users')
            ->whereTime('created_at', '=', '11:20:45')
            ->get();
</pre>
</code>
<p class="theme__text">
    Сравнение столбцов (whereColumn / orWhereColumn) <br>
    Для проверки на совпадение двух столбцов можно использовать метод whereColumn():
</p>
<code>
<pre>
$users = DB::table('users')
            ->whereColumn('first_name', 'last_name')
            ->get();
</pre>
</code>
<p class="theme__text">
    В метод также можно передать оператор сравнения:
</p>
<code>
<pre>
$users = DB::table('users')
            ->whereColumn('updated_at', '>', 'created_at')
            ->get();
</pre>
</code>
<p class="theme__text">
    В метод whereColumn() также можно передать массив с несколькими условиями. Эти условия будут объединены оператором AND:
</p>
<code>
<pre>
$users = DB::table('users')
            ->whereColumn([
                ['first_name', '=', 'last_name'],
                ['updated_at', '>', 'created_at']
            ])->get();
</pre>
</code>
<h3 class="theme__subtitle">
    Группировка условий
</h3>
<p class="theme__text">
    Иногда вам нужно сделать выборку по более сложным параметрам, таким как «существует ли» или вложенная группировка условий. Конструктор запросов Laravel справится и с такими запросами. Для начала посмотрим на пример группировки условий в скобках:
</p>
<code>
<pre>
DB::table('users')
        ->where('name', '=', 'John')
        ->orWhere(function ($query) {
            $query->where('votes', '>', 100)
                    ->where('title', '<>', 'Admin');
        })
        ->get();
</pre>
</code>
<p class="theme__text">
    Как видите, передав замыкание в метод orWhere(), мы дали конструктору запросов команду, начать группировку условий. Замыкание получит экземпляр конструктора запросов, который вы можете использовать для задания условий, поместив их в скобки. Приведённый пример выполнит такой SQL-запрос:
</p>
<code>
<pre>
select * from users where name = 'John' or (votes > 100 and title <> 'Admin')
</pre>
</code>
<p class="theme__text">Вы всегда должны группировать вызовы orWhere, чтобы избежать неожиданного поведения при применении глобальных областей.</p>
<h3 class="theme__subtitle">
    Проверка на существование
</h3>
<p class="theme__text">
    Метод whereExists() позволяет написать SQL-условие where exists. Метод whereExists() принимает в качестве аргумента замыкание, которое получит экземпляр конструктора запросов, позволяя вам определить запрос для помещения в условие «exists»:
</p>
<code>
<pre>
DB::table('users')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                    ->from('orders')
                    ->whereRaw('orders.user_id = users.id');
        })
        ->get();
</pre>
</code>
<p class="theme__text">
    Этот пример выполнит такой SQL-запрос:
</p>
<code>
<pre>
select * from users
where exists (
  select 1 from orders where orders.user_id = users.id
)
</pre>
</code>
<h3 class="theme__subtitle">
    Подзапрос Where Clauses
</h3>
<p class="theme__text">
    Иногда вам может потребоваться создать предложение where, которое сравнивает результаты подзапроса с заданным значением. Вы можете сделать это, передав Closure и значение методу where. Например, следующий запрос будет извлекать всех пользователей, которые недавно имели «членство» данного типа;
</p>
<code>
<pre>
use App\Models\User;

$users = User::where(function ($query) {
    $query->select('type')
        ->from('membership')
        ->whereColumn('user_id', 'users.id')
        ->orderByDesc('start_date')
        ->limit(1);
}, 'Pro')->get();
</pre>
</code>
<h3 class="theme__subtitle">
    JSON фильтрация (WHERE)
</h3>
<p class="theme__text">
    Laravel также поддерживает запросы для столбцов типа JSON в тех БД, которые поддерживают тип столбцов JSON. На данный момент это MySQL 5.7, PostgreSQL, SQL Server 2016, and SQLite 3.9.0 (с расширением JSON1 exstension). Для запроса JSON столбца используйте оператор -> :
</p>
<code>
<pre>
$users = DB::table('users')
            ->where('options->language', 'en')
            ->get();

$users = DB::table('users')
                ->where('preferences->dining->meal', 'salad')
                ->get();
</pre>
</code>
<p class="theme__text">
    Вы можете использовать whereJsonContains для запроса массивов JSON (не поддерживается в SQLite):
</p>
<code>
<pre>
$users = DB::table('users')
            ->whereJsonContains('options->languages', 'en')
            ->get();
</pre>
</code>
<p class="theme__text">
    MySQL и PostgreSQL поддерживают whereJsonContains с несколькими значениями:
</p>
<code>
<pre>
$users = DB::table('users')
            ->whereJsonContains('options->languages', ['en', 'de'])
            ->get();
</pre>
</code>
<p class="theme__text">
    Вы можете использовать whereJsonLength для запроса массивов JSON по их длине:
</p>
<code>
<pre>
$users = DB::table('users')
            ->whereJsonLength('options->languages', 0)
            ->get();

$users = DB::table('users')
                ->whereJsonLength('options->languages', '>', 1)
                ->get();
</pre>
</code>
<h3 class="theme__subtitle">
    Упорядочивание, группировка, предел и смещение
</h3>
<h4 class="theme_subtitlex2">
    orderBy
</h4>
<p class="theme__text">
    Метод orderBy() позволяет вам отсортировать результат запроса по заданному столбцу. Первый аргумент метода orderBy() — столбец для сортировки по нему, а второй — задаёт направление сортировки и может быть либо asc, либо desc:
</p>
<code>
<pre>
$users = DB::table('users')
    ->orderBy('name', 'desc')
    ->get();
</pre>
</code>
<p class="theme__text">
    Если вам нужно отсортировать по нескольким столбцам, вы можете вызывать orderBy столько раз, сколько необходимо:
</p>
<code>
<pre>
$users = DB::table('users')
            ->orderBy('name', 'desc')
            ->orderBy('email', 'asc')
            ->get();
</pre>
</code>
<h4 class="theme_subtitlex2">latest / oldest</h4>
<p class="theme__text">
    Методы latest() и oldest() позволяют легко отсортировать результаты по дате. По умолчанию выполняется сортировка по столбцу created_at. Или вы можете передать имя столбца для сортировки по нему:
</p>
<code>
<pre>
$user = DB::table('users')
            ->latest()
            ->first();
</pre>
</code>
<h4 class="theme_subtitlex2">
    inRandomOrder
</h4>
<p class="theme__text">
    Для сортировки результатов запроса в случайном порядке можно использовать метод inRandomOrder(). Например, вы можете использовать этот метод для выбора случайного пользователя:
</p>
<code>
<pre>
$randomUser = DB::table('users')
            ->inRandomOrder()
            ->first();
</pre>
</code>
<h4 class="theme_subtitlex2">reorder</h4>
<p class="theme__text">
    Метод reorder позволяет удалить все существующие заказы и, при необходимости, применить новый заказ. Например, вы можете удалить все существующие заказы:
</p>
<code>
<pre>
$query = DB::table('users')->orderBy('name');
$unorderedUsers = $query->reorder()->get();
</pre>
</code>
<p class="theme__text">
    Чтобы удалить все существующие заказы и применить новый порядок, укажите столбец и направление в качестве аргументов метода:
</p>
<code>
<pre>
$query = DB::table('users')->orderBy('name');
$usersOrderedByEmail = $query->reorder('email', 'desc')->get();
</pre>
</code>
<h4 class="theme_subtitlex2">groupBy / having</h4>
<p class="theme__text">
    Методы groupBy() и having() используются для группировки результатов запроса. Сигнатура метода having() аналогична методу where():
</p>
<code>
<pre>
$users = DB::table('users')
            ->groupBy('account_id')
            ->having('account_id', '>', 100)
            ->get();
</pre>
</code>
<p class="theme__text">
    Вы можете передать несколько аргументов методу groupBy для группировки по нескольким столбцам:
</p>
<code>
<pre>
$users = DB::table('users')
            ->groupBy('first_name', 'status')
            ->having('account_id', '>', 100)
            ->get();
</pre>
</code>
<p class="theme__text">
    Метод havingRaw() используется для передачи сырой строки в условие having. Например, мы можем найти все филиалы с объёмом продаж выше $2,500:
</p>
<code>
<pre>
$users = DB::table('orders')
            ->select('department', DB::raw('SUM(price) as total_sales'))
            ->groupBy('department')
            ->havingRaw('SUM(price) > 2500')
            ->get();
</pre>
</code>
<h4 class="theme_subtitlex2">skip / take</h4>
<p class="theme__text">
    Для ограничения числа возвращаемых результатов из запроса или для пропуска заданного числа результатов в запросе используются методы skip() и take():
</p>
<code>
<pre>
$users = DB::table('users')->skip(10)->take(5)->get();
</pre>
</code>
<p class="theme__text">
    Или вы можете использовать методы limit() и offset():
</p>
<code>
<pre>
$users = DB::table('users')
                    ->offset(10)
                    ->limit(5)
                    ->get();
</pre>
</code>
<h3 class="theme__subtitle">Условное применение условий</h3>
<p class="theme__text">
    Иногда необходимо применять условие к запросу, только если выполняется какое-то другое условие. Например, выполнять оператор where, только если нужное значение есть во входящем запросе. Это можно сделать с помощью метода when():
</p>
<code>
<pre>
$role = $request->input('role');

$users = DB::table('users')
                ->when($role, function ($query) use ($role) {
                  return $query->where('role_id', $role);
                })
                ->get();
</pre>
</code>
<p class="theme__text">
    Метод when() выполняет данное замыкание, только когда первый параметр равен true. Если первый параметр равен false, то замыкание не будет выполнено.
    <br><br>
    Вы можете передать ещё одно замыкание третьим параметром метода when(). Это замыкание будет выполнено, если первый параметр будет иметь значение false. Для демонстрации работы этой функции мы используем её для настройки сортировки по умолчанию для запроса:
</p>
<code>
<pre>
$sortBy = null;

$users = DB::table('users')
                ->when($sortBy, function ($query) use ($sortBy) {
                  return $query->orderBy($sortBy);
                }, function ($query) {
                  return $query->orderBy('name');
                })
                ->get();
</pre>
</code>
<h3 class="theme__subtitle">Вставка (INSERT)</h3>
<p class="theme__text">
    Конструктор запросов предоставляет метод insert() для вставки записей в таблицу БД. Метод insert() принимает массив имён столбцов и значений:
</p>
<code>
<pre>
DB::table('users')->insert(
  ['email' => 'john@example.com', 'votes' => 0]
);
</pre>
</code>
<p class="theme__text">
    Вы можете вставить в таблицу сразу несколько записей одним вызовом insert(), передав ему массив массивов, каждый из которых — строка для вставки в таблицу:
</p>
<code>
<pre>
DB::table('users')->insert([
  ['email' => 'taylor@example.com', 'votes' => 0],
  ['email' => 'dayle@example.com', 'votes' => 0]
]);
</pre>
</code>
<p class="theme__text">
    Метод insertOrIgnore будет игнорировать ошибки повторяющихся записей при вставке записей в базу данных:
</p>
<code>
<pre>
DB::table('users')->insertOrIgnore([
    ['id' => 1, 'email' => 'taylor@example.com'],
    ['id' => 2, 'email' => 'dayle@example.com'],
]);
</pre>
</code>
<p class="theme__text">
    Метод upsert вставит несуществующие строки и обновит существующие строки новыми значениями. Первый аргумент метода состоит из значений для вставки или обновления, а второй аргумент перечисляет столбцы, которые однозначно идентифицируют записи в связанной таблице. Третий и последний аргумент метода - это массив столбцов, который следует обновить, если соответствующая запись уже существует в базе данных:
</p>
<code>
<pre>
DB::table('flights')->upsert([
    ['departure' => 'Oakland', 'destination' => 'San Diego', 'price' => 99],
    ['departure' => 'Chicago', 'destination' => 'New York', 'price' => 150]
], ['departure', 'destination'], ['price']);
</pre>
</code>
<p class="theme__text">
    Все базы данных, кроме SQL Server, требуют, чтобы столбцы во втором аргументе метода upsert имели «первичный» или «уникальный» индекс.
</p>
<h4 class="theme_subtitlex2">
    Автоинкрементные ID
</h4>
<p class="theme__text">
    Если в таблице есть автоинкрементный ID, используйте метод insertGetId() для вставки записи и получения её ID:
</p>
<code>
<pre>
$id = DB::table('users')->insertGetId(
    ['email' => 'john@example.com', 'votes' => 0]
);
</pre>
</code>
<p class="theme__text">
    При использовании метода insertGetId() для PostgreSQL автоинкрементное поле должно иметь имя id. Если вы хотите получить ID из другого поля таблицы, вы можете передать его имя вторым аргументом.
</p>
<h3 class="theme__subtitle">Обновление (UPDATE)</h3>
<p class="theme__text">
    Разумеется, кроме вставки записей в БД конструктор запросов может и изменять существующие строки с помощью метода update(). Метод update(), как и метод insert(), принимает массив столбцов и пар значений, содержащих столбцы для обновления. Вы можете ограничить запрос update() условием where():
</p>
<code>
<pre>
DB::table('users')
    ->where('id', 1)
    ->update(['votes' => 1]);
</pre>
</code>
<h4 class="theme_subtitlex2">Обновление JSON-столбцов</h4>
<p class="theme__text">
    При обновлении JSON-столбцов используйте синтаксис -> для обращения к нужному ключу в JSON-объекте. Эта операция поддерживается только в БД, поддерживающих JSON-столбцы (MySQL 5.7+ and PostgreSQL 9.5+):
</p>
<code>
<pre>
$affected = DB::table('users')
    ->where('id', 1)
    ->update(['options->enabled' => true]);
</pre>
</code>
<h4 class="theme_subtitlex2">Update Or Insert</h4>
<p class="theme__text">
    Иногда вам может потребоваться обновить существующую запись в базе данных или создать ее, если соответствующей записи не существует. В этом сценарии может использоваться метод updateOrInsert. Метод updateOrInsert принимает два аргумента: массив условий, по которым нужно найти запись, и массив пар столбцов и значений, содержащих столбцы, которые необходимо обновить.
    <br><br>
    Метод updateOrInsert сначала попытается найти соответствующую запись в базе данных, используя пары столбец и значение первого аргумента. Если запись существует, она будет обновлена значениями во втором аргументе. Если запись не может быть найдена, будет вставлена новая запись с объединенными атрибутами обоих аргументов:
</p>
<code>
<pre>
DB::table('users')
    ->updateOrInsert(
        ['email' => 'john@example.com', 'name' => 'John'],
        ['votes' => '2']
    );
</pre>
</code>
<h4 class="theme_subtitlex2">Increment и Decrement</h4>
<p class="theme__text">
    Конструктор запросов предоставляет удобные методы для увеличения и уменьшения значений заданных столбцов. Это просто более выразительный и краткий способ по сравнению с написанием оператора update вручную.
    <br><br>
    Оба метода принимают один обязательный аргумент — столбец для изменения. Второй аргумент может быть передан для указания, на какую величину необходимо изменить значение столбца:
</p>
<code>
<pre>
DB::table('users')->increment('votes');

DB::table('users')->increment('votes', 5);

DB::table('users')->decrement('votes');

DB::table('users')->decrement('votes', 5);
</pre>
</code>
<p class="theme__text">
    Вы также можете указать дополнительные поля для изменения:
</p>
<code>
<pre>
DB::table('users')->increment('votes', 1, ['name' => 'John']);
</pre>
</code>
<p class="theme__text">
    События модели не запускаются при использовании методов increment и decrement
</p>
<h3 class="theme__subtitle">
    Удаление (DELETE)
</h3>
<p class="theme__text">
    Конструктор запросов предоставляет метод delete() для удаления записей из таблиц. Вы можете ограничить оператор delete(), добавив условие where() перед его вызовом:
</p>
<code>
<pre>
DB::table('users')->delete();

DB::table('users')->where('votes', '>', 100)->delete();
</pre>
</code>
<p class="theme__text">
    Если вы хотите очистить таблицу (усечение), удалив все строки и обнулив счётчик ID, используйте метод truncate():
</p>
<code>
<pre>
DB::table('users')->truncate();
</pre>
</code>
<p class="theme__text">
    Усечение таблицы аналогично удалению всех её записей, а также сбросом счётчика autoincrement-полей. — прим. пер.
</p>
<h4 class="theme_subtitlex2">
    Усечение таблицы и PostgreSQL
</h4>
<p class="theme__text">
    При усечении базы данных PostgreSQL будет применяться поведение CASCADE. Это означает, что все связанные с внешним ключом записи в других таблицах также будут удалены.
</p>
<h3 class="theme__subtitle">
    Пессимистическая блокировка
</h3>
<p class="theme__text">
    В конструкторе запросов есть несколько функций, которые помогают делать «пессимистическую блокировку» (pessimistic locking) для ваших операторов SELECT. Для запуска оператора SELECT с «разделяемой блокировкой» вы можете использовать в запросе метод sharedLock(). Разделяемая блокировка предотвращает изменение выбранных строк до конца транзакции:
</p>
<code>
<pre>
DB::table('users')->where('votes', '>', 100)->sharedLock()->get();
</pre>
</code>
<p class="theme__text">
    Или вы можете использовать метод lockForUpdate(). Блокировка «для изменения» предотвращает изменение строк и их выбор другими разделяемыми блокировками:
</p>
<code>
<pre>
DB::table('users')->where('votes', '>', 100)->lockForUpdate()->get();
</pre>
</code>
<h3 class="theme__subtitle">
    Отладка
</h3>
<p class="theme__text">
    Вы можете использовать методы dd или dump при построении запроса для сброса привязок запроса и SQL. Метод dd отобразит отладочную информацию, а затем прекратит выполнение запроса. Метод dump отобразит отладочную информацию, но позволит продолжить выполнение запроса:
</p>
<code>
<pre>
DB::table('users')->where('votes', '>', 100)->dd();

DB::table('users')->where('votes', '>', 100)->dump();
</pre>
</code>
    </div>
    <div class="theme">
        <h2 class="theme__title">Пагинация</h2>
        <p class="theme__text">
            Пагинация - нумерация страниц. <br><br>
            В некоторых фреймворках страничный вывод может быть большой проблемой. Страничный вывод в Laravel интегрирован с построителем запросов и Eloquent ORM и обеспечивает удобный, простой в использовании вывод результатов БД. По-умолчанию, генерируемый HTML-код совместим с Tailwind CSS, однако также доступны представления CSS-фреймворка Bootstrap.
        </p>
<h3 class="theme__subtitle">
    Основы использования
</h3>
<h4 class="theme_subtitlex2">
    Страничный вывод с использование построителя запросов
</h4>
<p class="theme__text">
    Есть несколько способов разделения данных на страницы. Самый простой — используя метод paginate() на объекте-конструкторе запросов или на запросе Eloquent. Метод paginate() автоматически позаботится о задании правильных пределов и промежутков на основе текущей просматриваемой пользователем страницы. По умолчанию текущая страница определяется по значению аргумента ?page в HTTP-запросе. Само собой, Laravel автоматически определяет это значение, и так же автоматически вставляет его в ссылки, генерируемые для страничного вывода.
    <br><br>
    В этом примере единственный аргумент метода paginate() — число элементов на одной странице. Давайте укажем, что мы хотим выводить по 15 элементов на страницу:
</p>
<code>
<pre>
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->paginate(15);

        return view('user.index', ['users' => $users]);
    }
}
</pre>
</code>
<p class="theme__text">
    На данный момент операции страничного вывода, которые используют оператор groupBy, не могут эффективно выполняться в Laravel. Если вам необходимо использовать groupBy для постраничного набора результатов, рекомендуется делать запрос в БД и создавать экземпляр страничного вывода вручную.
</p>
<h4 class="theme_subtitlex2">
    «Простой страничный вывод»
</h4>
<p class="theme__text">
    Если вам необходимо вывести для страничного представления только ссылки «Далее» и «Назад», вы можете использовать метод simplePaginate() для более эффективных запросов. Для больших наборов данных очень полезно, когда вам не надо отображать номер каждой страницы в вашем представлении:
</p>
<code>
<pre>
</pre>
$users = DB::table('users')->simplePaginate(15);
</code>
<h4 class="theme_subtitlex2">
    Страничный вывод с использованием Eloquent
</h4>
<p class="theme__text">
    Можно также делать постраничный вывод запросов Eloquent. В этом примере мы разобьём на страницы модель User по 15 элементов на странице. Как видите, синтаксис практически совпадает со страничным выводом выборки из БД:
</p>
<code>
<pre>
$users = App\User::paginate(15);
</pre>
</code>
<p class="theme__text">
    Разумеется, вы можете вызвать paginate() после задания других условий запроса, таких как where:
</p>
<code>
<pre>
$users = User::where('votes', '>', 100)->paginate(15);
</pre>
</code>
<p class="theme__text">
    Также вы можете использовать метод simplePaginate() моделей Eloquent:
</p>
<code>
<pre>
$users = User::where('votes', '>', 100)->simplePaginate(15);
</pre>
</code>
<h3 class="theme__subtitle">
    Ручное создание экземпляра страничного вывода
</h3>
<p class="theme__text">
    Иногда необходимо создать экземпляр страничного вывода вручную, передав ему массив данных. Это можно сделать создав либо экземпляр Illuminate\Pagination\Paginator, либо экземпляр Illuminate\Pagination\LengthAwarePaginator, в зависимости от ситуации.
    <br><br>
    Классу Paginator не надо знать общее количество элементов в конечном наборе, и поэтому класс не должен иметь методы для получения индекса последней страницы. LengthAwarePaginator принимает почти те же аргументы, что и Paginator, но ему требуется общее количество элементов в конечном наборе.
    <br><br>
    Другими словами, Paginator соответствует методу simplePaginate() на конструкторе запросов и Eloquent, а LengthAwarePaginator соответствует методу paginate().
    <br><br>
    При ручном создании экземпляра страничного вывода вы должны вручную «поделить» передаваемый в него массив результатов. Если вы не знаете, как это сделать, используйте PHP-функцию array_slice.
</p>
<h3 class="theme__subtitle">
    Отображение результатов страничного вывода
</h3>
<p class="theme__text">
    При вызове методов paginate() и simplePaginate() на конструкторе запросов или запросе Eloquent вы получите экземпляр страничного вывода. Для метода paginate() это будет экземпляр Illuminate\Pagination\LengthAwarePaginator. А для метода simplePaginate() это будет экземпляр Illuminate\Pagination\Paginator. Эти объекты предоставляют несколько методов для вывода конечного набора. В дополнение к этим вспомогательным методам экземпляры страничного вывода — итераторы, к ним можно обращаться как к массивам. Итак, когда вы получили результаты, вы можете вывести их и создать ссылки на страницы с помощью Blade:
</p>
<code>
<pre>
< div class="container">
    @@foreach ($users as $user)
        @{{ $ user->name }}
    @@endforeach
< /div>
@{{ $users->links() }}
</pre>
</code>
<p class="theme__text">
    Метод links() выведет ссылки на остальные страницы в конечном наборе. Каждая из этих ссылок уже будет содержать правильную переменную строки запроса page. Помните, что HTML-код, созданный методом ссылок, совместим со структурой Tailwind CSS и CSS-фреймворком Bootstrap.
</p>
<h4 class="theme_subtitlex2">
    Настройка URI для вывода ссылок
</h4>
<p class="theme__text">
    Метод withPath позволяет настраивать URI, используемый пагинатором при создании ссылок. Например, если вы хотите, чтобы пагинатор генерировал ссылки типа http://example.com/custom/url?page=N, вы должны передать custom/url методу withPath:
</p>
<code>
<pre>
Route::get('users', function () {
    $users = App\Models\User::paginate(15);

    $users->withPath('custom/url');

    //
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Параметры в ссылках
</h4>
<p class="theme__text">
    Вы можете добавить параметры запросов к ссылкам страниц с помощью метода appends(). Например, чтобы добавить &sort=votes к каждой страничной ссылке, вам надо вызвать appends() вот так:
</p>
<code>
<pre>
@{{ $users->appends(['sort' => 'votes'])->links() }}
// http://example.com/something?page=2&sort=votes
</pre>
</code>
<p class="theme__text">
    Если вы хотите добавить все текущие значения строки запроса к ссылкам пагинации, вы можете использовать метод withQueryString:
</p>
<code>
<pre>
@{{$ users-> withQueryString () -> links ()}}
</pre>
</code>
<p class="theme__text">
    Если вы хотите добавить «хэш-фрагмент» в URL-адреса страничного вывода, вы можете использовать метод fragment(). Например, чтобы добавить #foo к каждой страничной ссылке, вам надо вызвать fragment() вот так:
</p>
<code>
<pre>
{{ $users->fragment('foo')->links() }}
// http://example.com/something?page=2#foo
</pre>
</code>
<h4 class="theme_subtitlex2">
    Настройка окна ссылки на страницы
</h4>
<p class="theme__text">
    Вы можете контролировать, сколько дополнительных ссылок будет отображаться с каждой стороны «окна» URL-адреса пагинатора. По умолчанию, по три ссылки отображаются с каждой стороны от ссылок основного пагинатора. Однако вы можете контролировать это число с помощью метода onEachSide:
</p>
<code>
<pre>
@{{ $users->onEachSide(5)->links() }}
</pre>
</code>
<h3 class="theme__subtitle">
    Преобразование в JSON
</h3>
<p class="theme__text">
    Классы страничного вывода Laravel реализуют контракт интерфейса Illuminate\Contracts\Support\Jsonable и предоставляют метод toJson(), поэтому можно очень легко конвертировать ваш страничный вывод в JSON. Вы также можете преобразовать экземпляр страничного вывода в JSON, просто вернув его из маршрута или действия контроллера.
</p>
<code>
<pre>
Route::get('users', function () {
    return App\User::paginate();
});
</pre>
</code>
<p class="theme__text">
    JSON-форма экземпляра будет включать некоторые «мета-данные», такие как total, current_page, last_page и другие. Данные экземпляра будут доступны через ключ data в массиве JSON. Вот пример JSON, созданного при помощи возврата экземпляра страничного вывода из маршрута:
</p>
<code>
<pre>
{
    "total": 50,
    "per_page": 15,
    "current_page": 1,
    "last_page": 4,
    "first_page_url": "http://laravel.app?page=1",
    "last_page_url": "http://laravel.app?page=4",
    "next_page_url": "http://laravel.app?page=2",
    "prev_page_url": null,
    "path": "http://laravel.app",
    "from": 1,
    "to": 15,
    "data":[
            {
                // Объект вывода
            },
            {
                // Объект вывода
            }
    ]
}
</pre>
</code>
<h3 class="theme__subtitle">
    Настройка представления страничного вывода
</h3>
<p class="theme__text">
    По умолчанию отрисованные представления для отображения ссылок страничного вывода совместимы с Tailwind CSS framework и CSS-фреймворком Bootstrap. Но если вы не используете ни то, ни другое, вы можете определить свои собственные представления для отрисовки этих ссылок. При вызове метода links() на экземпляре страничного вывода передайте первым аргументом имя представления:
</p>
<code>
<pre>
@{{ $paginator->links('view.name') }}
@{{ $paginator->links('view.name', ['foo' => 'bar']) }}
</pre>
</code>
<p class="theme__text">
    Но самый простой способ изменить представления страничного вывода — экспортировать их в ваш каталог resources/views/vendor с помощью команды vendor:publish:
</p>
<code>
<pre>
php artisan vendor:publish --tag=laravel-pagination
</pre>
</code>
<p class="theme__text">
    Эта команда поместит представления в папку resources/views/vendor/pagination. Файл default.blade.php в этой папке является стандартным представлением страничного вывода. Просто отредактируйте этот файл, чтобы изменить HTML страничного вывода.
    <br>
    <br>
    Если вы хотите назначить другой файл в качестве представления разбивки на страницы по умолчанию, вы можете использовать методы defaultView и defaultSimpleView пагинатора в вашем AppServiceProvider:
</p>
<code>
<pre>
use Illuminate\Pagination\Paginator;

public function boot()
{
    Paginator::defaultView('view-name');

    Paginator::defaultSimpleView('view-name');
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Использование Bootstrap
</h4>
<p class="theme__text">
    Laravel включает представления с разбивкой на страницы, построенные с использованием Bootstrap CSS. Чтобы использовать эти представления вместо представлений Tailwind по умолчанию, вы можете вызвать метод useBootstrap пагинатора в вашем AppServiceProvider:
</p>
<code>
<pre>
use Illuminate\Pagination\Paginator;

public function boot()
{
    Paginator::useBootstrap();
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Методы экземпляра страничного вывода
</h4>
<p class="theme__text">
    Каждый экземпляр страничного вывода предоставляет дополнительную информацию с помощью этих методов:
</p>
<table>
    <tr>
        <td>
            Метод
        </td>
        <td>
            Описание
        </td>
    </tr>
    <tr>
        <td>
            $paginator->count()
        </td>
        <td>
            Получите количество элементов для текущей страницы.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->currentPage()
        </td>
        <td>
            Получить номер текущей страницы.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->firstItem()
        </td>
        <td>
            Получите номер результата первого элемента в результатах.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->getOptions()
        </td>
        <td>
            Получите параметры пагинатора.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->getUrlRange($start, $end)
        </td>
        <td>
            Создайте диапазон URL-адресов для пагинации.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->hasPages()
        </td>
        <td>
            Определите, достаточно ли элементов для разделения на несколько страниц.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->hasMorePages()
        </td>
        <td>
            Определите, есть ли еще элементы в хранилище данных.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->items()
        </td>
        <td>
            Получить элементы для текущей страницы.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->lastItem()
        </td>
        <td>
            Получить номер результата последнего элемента в результатах.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->lastPage()
        </td>
        <td>
            Получите номер последней доступной страницы. (Недоступно при использовании simplePaginate)
        </td>
    </tr>
    <tr>
        <td>
            $paginator->nextPageUrl()
        </td>
        <td>
            Получите URL-адрес следующей страницы.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->onFirstPage()
        </td>
        <td>
            Определите, находится ли пагинатор на первой странице.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->perPage()
        </td>
        <td>
            Количество элементов, отображаемых на странице.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->previousPageUrl()
        </td>
        <td>
            Получите URL-адрес предыдущей страницы.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->total()
        </td>
        <td>
            Определите общее количество совпадающих элементов в хранилище данных. (Недоступно при использовании simplePaginate).
        </td>
    </tr>
    <tr>
        <td>
            $paginator->url($page)
        </td>
        <td>
            Получите URL-адрес для заданного номера страницы.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->getPageName()
        </td>
        <td>
            Получите переменную строки запроса, используемую для хранения страницы.
        </td>
    </tr>
    <tr>
        <td>
            $paginator->setPageName($name)
        </td>
        <td>
            Установите переменную строки запроса, используемую для хранения страницы.
        </td>
    </tr>
</table>
    </div>
    <div class="theme">
        <h2 class="theme__title">Миграции</h2>
        <p class="theme__text">
            Миграции — что-то вроде системы контроля версий для вашей базы данных. Они позволяют вашей команде изменять структуру БД, в то же время оставаясь в курсе изменений других участников. Миграции обычно идут рука об руку с построителем структур для более простого обращения с архитектурой вашей базы данных. Если вы когда-нибудь просили коллегу вручную добавить столбец в его локальную БД, значит вы сталкивались с проблемой, которую решают миграции БД.
            <br><br>
            Фасад Laravel Schema обеспечивает поддержку создания и изменения таблиц в независимости от используемой СУБД из числа тех, что поддерживаются в Laravel.
        </p>
<h3 class="theme__subtitle">
    Создание миграций
</h3>
<p class="theme__text">
    Для создания новой миграции используйте Artisan-команду make:migration:
</p>
<code>
<pre>
php artisan make:migration create_users_table
</pre>
</code>
<p class="theme__text">
    Миграция будет помещена в папку database/migrations и будет содержать метку времени, которая позволяет фреймворку определять порядок применения миграций.
    <br><br>
    Можно также использовать параметры --table и --create для указания имени таблицы и того факта, что миграция будет создавать новую таблицу (а не изменять существующую — прим. пер.). Эти параметры просто заранее создают указанную таблицу в создаваемом файле-заглушке миграции:
</p>
<code>
<pre>
php artisan make:migration create_users_table --create=users

php artisan make:migration add_votes_to_users_table --table=users
</pre>
</code>
<p class="theme__text">
    Если вы хотите указать свой путь для сохранения создаваемых миграций, используйте параметр --path при запуске команды make:migration. Этот путь должен быть указан относительно базового пути вашего приложения.
</p>
<h4 class="theme_subtitlex2">
    Подавление миграции
</h4>
<p class="theme__text">
    По мере создания приложения вы можете со временем накапливать все больше и больше миграций. Это может привести к тому, что ваш каталог миграции станет раздутым из-за потенциально сотен миграции. Если хотите, можете «сжать» свои миграции в один файл SQL. Для начала выполните команду schema: dump:
</p>
<code>
<pre>
php artisan schema:dump

// Dump the current database schema and prune all existing migrations...
php artisan schema:dump --prune
</pre>
</code>
<p class="theme__text">
    Когда вы выполните эту команду, Laravel запишет файл «схемы» в вашу базу данных / каталог схемы. Теперь, когда вы пытаетесь перенести свою базу данных, и никакие другие миграции не выполнялись, Laravel сначала выполнит SQL файла схемы. После выполнения команд файла схемы Laravel выполнит все оставшиеся миграции, которые не были частью дампа схемы.
    <br><br>
    Вы должны передать файл схемы базы данных в систему управления версиями, чтобы другие новые разработчики в вашей команде могли быстро создать начальную структуру базы данных вашего приложения.
    <br><br>
    Сдавление миграции доступно только для баз данных MySQL, PostgreSQL и SQLite. Однако дампы базы данных не могут быть восстановлены в базах данных SQLite в памяти.
</p>
<h3 class="theme__subtitle">
    Структура миграций
</h3>
<p class="theme__text">
    Класс миграций содержит два метода: up() и down(). Метод up() используется для добавления новых таблиц, столбцов или индексов в вашу БД, а метод down() просто отменяет операции, выполненные методом up().
    <br><br>
    В обоих методах вы можете использовать построитель структур Laravel для удобного создания и изменения таблиц. О всех доступных методах построителя структур читайте в его документации (ссылка ниже на тему: "создание таблиц"). Например, эта миграция создаёт таблицу flights:
</p>
<code>
<pre>
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{

    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('airline');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('flights');
    }
}
</pre>
</code>
<h3 class="theme__subtitle">
    Выполнение миграций
</h3>
<p class="theme__text">
    Для запуска всех необходимых вам миграций используйте Artisan-команду migrate.
</p>
<code>
<pre>
php artisan migrate
</pre>
</code>
<h3 class="theme__subtitle">
    Принудительные миграции в продакшне
</h3>
<p class="theme__text">
    Некоторые операции миграций разрушительны, значит они могут привести к потере ваших данных. Для предотвращения случайного запуска этих команд на вашей боевой БД перед их выполнением запрашивается подтверждение. Для принудительного запуска команд без подтверждения используйте ключ --force:
</p>
<code>
<pre>
php artisan migrate --force
</pre>
</code>
<h3 class="theme__subtitle">
    Откат миграций
</h3>
<p class="theme__text">
    Для отмены изменений, сделанных последней миграцией, используйте команду rollback. Эта команда отменит результат последней «партии» миграций, которая может включать несколько файлов миграций:
</p>
<code>
<pre>
php artisan migrate:rollback
</pre>
</code>
<p class="theme__text">
    Вы можете сделать откат определённого числа миграций, указав параметр step для команды rollback. Например, эта команда откатит последние пять миграций:
</p>
<code>
<pre>
php artisan migrate:rollback --step=5
</pre>
</code>
<p class="theme__text">
    Команда migrate:reset отменит изменения всех миграций вашего приложения:
</p>
<code>
<pre>
php artisan migrate:reset
</pre>
</code>
<h3 class="theme__subtitle">
    Откат всех миграций и их повторное применение одной командой
</h3>
<p class="theme__text">
    Команда migrate:refresh отменит изменения всех ваших миграций, а затем выполнит команду migrate. Эта команда эффективно создаёт заново всю вашу БД:
</p>
<code>
<pre>
php artisan migrate:refresh

// Обновить БД и запустить заполнение БД начальными данными...
php artisan migrate:refresh --seed
</pre>
</code>
<p class="theme__text">
    Вы можете откатить и повторно применить определённое число миграций, указав параметр step для команды refresh. Например, эта команда откатит и повторно применит последние пять миграций:
</p>
<code>
<pre>
php artisan migrate:refresh --step=5
</pre>
</code>
<h4 class="theme_subtitlex2">
    Удалить все таблицы и выполнить миграцию
</h4>
<p class="theme__text">
    Команда migrate: fresh удалит все таблицы из базы данных, а затем выполнит команду migrate:
</p>
<code>
<pre>
    php artisan migrate:fresh

php artisan migrate:fresh --seed
</pre>
</code>
<p class="theme__text">
    Команда migrate: fresh удалит все таблицы базы данных независимо от их префикса. Эту команду следует использовать с осторожностью при разработке в базе данных, которая используется совместно с другими приложениями.
</p>
<h3 class="theme__subtitle">
    Таблицы
</h3>
<h4 class="theme_subtitlex2">
    Создание таблиц
</h4>
<p class="theme__text">
    Для создания новой таблицы БД используйте метод create() фасада Schema. Метод create() принимает два аргумента. Первый — имя таблицы, второй — замыкание, которое получает объект Blueprint, который можно использовать для определения новой таблицы:
</p>
<code>
<pre>
Schema::create('users', function (Blueprint $table) {
    $table->id();
});
</pre>
</code>
<p class="theme__text">
    Само собой, при создании таблицы вы можете использовать любые методы для работы со столбцами построителя структур. (ссылка снизу это)
</p>
<h4 class="theme_subtitlex2">
    Проверка существования таблицы/столбца
</h4>
<p class="theme__text">
    Вы можете легко проверить существование таблицы или столбца при помощи методов hasTable() и hasColumn():
</p>
<code>
<pre>
if (Schema::hasTable('users')) {
    //
}

    if (Schema::hasColumn('users', 'email')) {
    //
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Проверка существования таблицы/столбца
</h4>
<p class="theme__text">
    Если вы хотите выполнить операции над структурой через подключение к БД, которое не является вашим основным подключением, используйте метод connection():
</p>
<code>
<pre>
Schema::connection('foo')->create('users', function (Blueprint $table) {
    $table->id();
});
</pre>
</code>
<p class="theme__text">
    Вы можете использовать следующие команды в построителе схемы для определения параметров таблицы:
</p>
<table>
    <tr>
        <td>
            Описание
        </td>
        <td>
            Команды
        </td>
    </tr>
    <tr>
        <td>
            $table->engine = 'InnoDB';
        </td>
        <td>
            Укажите механизм хранения таблиц. Используйте свойство engine построителя структур, чтобы задать подсистему хранения данных для таблицы (MySQL).
        </td>
    </tr>
    <tr>
        <td>
            $table->charset = 'utf8mb4';
        </td>
        <td>
            Укажите набор символов по умолчанию для таблицы (MySQL).
        </td>
    </tr>
    <tr>
        <td>
            $table->collation = 'utf8mb4_unicode_ci';
        </td>
        <td>
            Укажите параметры сортировки по умолчанию для таблицы (MySQL).
        </td>
    </tr>
    <tr>
        <td>
            $table->temporary();
        </td>
        <td>
            Create a temporary table (except SQL Server).
        </td>
    </tr>
</table>
<h3 class="theme__subtitle">
    Переименование/удаление таблиц
</h3>
<p class="theme__text">
    Для переименования существующей таблицы используйте метод rename():
</p>
<code>
<pre>
Schema::rename($from, $to);
</pre>
</code>
<p class="theme__text">
    Для удаления существующей таблицы используйте методы drop() и dropIfExists():
</p>
<code>
<pre>
Schema::drop('users');

Schema::dropIfExists('users');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Переименование таблиц с внешними ключами
</h4>
<p class="theme__text">
    Перед переименованием таблицы вы должны проверить, что для всех ограничений внешних ключей таблицы есть явные имена в файлах вашей миграции, чтобы избежать автоматического назначения имён на основе принятого соглашения. Иначе имя ограничения внешнего ключа будет ссылаться на имя старой таблицы.
</p>
<h3 class="theme__subtitle">
    Столбцы
</h3>
<h4 class="theme_subtitlex2">
    Создание столбцов
</h4>
<p class="theme__text">
    Для изменения существующей таблицы мы будем использовать метод table() фасада Schema. Как и метод create(), метод table() принимает два аргумента: имя таблицы и замыкание, которое получает экземпляр Blueprint, который можно использовать для добавления столбцов в таблицу:
</p>
<code>
<pre>
Schema::table('users', function (Blueprint $table) {
    $table->string('email');
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Доступные типы столбцов
</h4>
<p class="theme__text">
    Разумеется, построитель структур содержит различные типы столбцов, которые вы можете указывать при построении ваших таблиц:
</p>
<table>
    <tr>
        <td>
            Команда
        </td>
        <td>
            Описание
        </td>
    </tr>
    <tr>
        <td>
            $table->id();
        </td>
        <td>
            Псевдоним $table->bigIncrements('id').
        </td>
    </tr>
    <tr>
        <td>
            $table->foreignId('user_id');
        </td>
        <td>
            Alias of $table->unsignedBigInteger('user_id')
        </td>
    </tr>
    <tr>
        <td>
            $table->bigIncrements('id');
        </td>
        <td>
            Автоматически увеличивающийся эквивалентный столбец UNSIGNED BIGINT (первичный ключ).
        </td>
    </tr>
    <tr>
        <td>
            $table->bigInteger('votes');
        </td>
        <td>
            Эквивалентный столбец BIGINT.
        </td>
    </tr>
    <tr>
        <td>
            $table->binary('data');
        </td>
        <td>
            Эквивалентный столбец BLOB.
        </td>
    </tr>
    <tr>
        <td>
            $table->boolean('confirmed');
        </td>
        <td>
            Столбец эквивалента BOOLEAN.
        </td>
    </tr>
    <tr>
        <td>
            $table->char('name', 100);
        </td>
        <td>
            Столбец эквивалента CHAR с длиной.
        </td>
    </tr>
    <tr>
        <td>
            $table->date('created_at');
        </td>
        <td>
            Эквивалентный столбец DATE.
        </td>
    </tr>
    <tr>
        <td>
            $table->dateTime('created_at', 0);
        </td>
        <td>
            Эквивалентный столбец DATETIME с точностью (общее количество цифр).
        </td>
    </tr>
    <tr>
        <td>
            $table->dateTimeTz('created_at', 0);
        </td>
        <td>
            Эквивалентный столбец DATETIME (с часовым поясом) с точностью (общее количество цифр).
        </td>
    </tr>
    <tr>
        <td>
            $table->decimal('amount', 8, 2);
        </td>
        <td>
            Эквивалентный столбец DECIMAL с точностью (общее количество цифр) и масштабом (десятичные цифры)
        </td>
    </tr>
    <tr>
        <td>
            $table->double('amount', 8, 2);
        </td>
        <td>
            DOUBLE эквивалентный столбец с точностью (общее количество цифр) и масштабом (десятичные цифры).
        </td>
    </tr>
    <tr>
        <td>
            $table->enum('level', ['easy', 'hard']);
        </td>
        <td>
            Эквивалентный столбец ENUM.
        </td>
    </tr>
    <tr>
        <td>
            $table->float('amount', 8, 2);
        </td>
        <td>
            Эквивалентный столбец FLOAT с точностью (общее количество цифр) и масштабом (десятичные цифры).
        </td>
    </tr>
    <tr>
        <td>
            $table->geometry('positions');
        </td>
        <td>
            Эквивалентный столбец GEOMETRY.
        </td>
    </tr>
    <tr>
        <td>
            $table->geometryCollection('positions');
        </td>
        <td>
            Эквивалентный столбец GEOMETRYCOLLECTION.
        </td>
    </tr>
    <tr>
        <td>
            $table->increments('id');
        </td>
        <td>
            Автоматически увеличивающийся эквивалентный столбец UNSIGNED INTEGER (первичный ключ).
        </td>
    </tr>
    <tr>
        <td>
            $table->integer('votes');
        </td>
        <td>
            INTEGER equivalent column.
        </td>
    </tr>
    <tr>
        <td>
            $table->ipAddress('visitor');
        </td>
        <td>
            Столбец эквивалента IP-адреса.
        </td>
    </tr>
    <tr>
        <td>
            $table->json('options');
        </td>
        <td>
            JSON equivalent column.
        </td>
    </tr>
    <tr>
        <td>
            $table->jsonb('options');
        </td>
        <td>
            Эквивалентный столбец JSONB.
        </td>
    </tr>
    <tr>
        <td>
            $table->lineString('positions');
        </td>
        <td>
            Эквивалентный столбец LINESTRING.
        </td>
    </tr>
    <tr>
        <td>
            $table->longText('description');
        </td>
        <td>
            Эквивалентный столбец LONGTEXT.
        </td>
    </tr>
    <tr>
        <td>
            $table->macAddress('device');
        </td>
        <td>
            Столбец эквивалента MAC-адреса.
        </td>
    </tr>
    <tr>
        <td>
            $table->mediumIncrements('id');
        </td>
        <td>
            Автоматически увеличивающийся эквивалентный столбец UNSIGNED MEDIUMINT (первичный ключ).
        </td>
    </tr>
    <tr>
        <td>
            $table->mediumInteger('votes');
        </td>
        <td>
            Эквивалентный столбец MEDIUMINT.
        </td>
    </tr>
    <tr>
        <td>
            $table->mediumText('description');
        </td>
        <td>
            Эквивалентный столбец MEDIUMTEXT.
        </td>
    </tr>
    <tr>
        <td>
            $table->morphs('taggable');
        </td>
        <td>
            Добавляет эквивалентные столбцы taggable_id UNSIGNED BIGINT и taggable_type VARCHAR.
        </td>
    </tr>
    <tr>
        <td>
            $table->uuidMorphs('taggable');
        </td>
        <td>
            Добавляет taggable_id CHAR (36) и taggable_type VARCHAR (255) эквивалентные столбцы UUID.
        </td>
    </tr>
    <tr>
        <td>
            $table->multiLineString('positions');
        </td>
        <td>
            Эквивалентный столбец MULTILINESTRING.
        </td>
    </tr>
    <tr>
        <td>
            $table->multiPoint('positions');
        </td>
        <td>
            Эквивалентный столбец MULTIPOINT.
        </td>
    </tr>
    <tr>
        <td>
            $table->multiPolygon('positions');
        </td>
        <td>
            Эквивалентный столбец MULTIPOLYGON.
        </td>
    </tr>
    <tr>
        <td>
            $table->nullableMorphs('taggable');
        </td>
        <td>
            Добавляет версии столбцов morphs (), допускающие значение NULL.
        </td>
    </tr>
    <tr>
        <td>
            $table->nullableUuidMorphs('taggable');
        </td>
        <td>
            Добавляет версии столбцов uuidMorphs (), допускающие значение NULL.
        </td>
    </tr>
    <tr>
        <td>
            $table->nullableTimestamps(0);
        </td>
        <td>
            Alias of timestamps() method.
        </td>
    </tr>
    <tr>
        <td>
            $table->point('position');
        </td>
        <td>
            POINT equivalent column.
        </td>
    </tr>
    <tr>
        <td>
            $table->polygon('positions');
        </td>
        <td>
            Эквивалентный столбец POLYGON.
        </td>
    </tr>
    <tr>
        <td>
            $table->rememberToken();
        </td>
        <td>
            Добавляет столбец, эквивалентный VARCHAR (100) с возможностью NULL.
        </td>
    </tr>
    <tr>
        <td>
            $table->set('flavors', ['strawberry', 'vanilla']);
        </td>
        <td>
            SET эквивалентный столбец
        </td>
    </tr>
    <tr>
        <td>
            $table->smallIncrements('id');
        </td>
        <td>
            Автоматически увеличивающийся эквивалентный столбец UNSIGNED SMALLINT (первичный ключ).
        </td>
    </tr>
    <tr>
        <td>
            $table->smallInteger('votes');
        </td>
        <td>
            Эквивалентный столбец SMALLINT.
        </td>
    </tr>
    <tr>
        <td>
            $table->softDeletes('deleted_at', 0);
        </td>
        <td>
            Добавляет обнуляемый эквивалентный столбец TIMESTAMP deleted_at для точного мягкого удаления (общее количество цифр).
        </td>
    </tr>
    <tr>
        <td>
            $table->softDeletesTz('deleted_at', 0);
        </td>
        <td>
            Добавляет обнуляемый столбец, эквивалентный TIMESTAMP (с часовым поясом) deleted_at для мягких удалений с точностью (общее количество цифр).
        </td>
    </tr>
    <tr>
        <td>
            $table->string('name', 100);
        </td>
        <td>
            Эквивалентный столбец VARCHAR с длиной.
        </td>
    </tr>
    <tr>
        <td>
            $table->text('description');
        </td>
        <td>
            Эквивалентный столбец TEXT.
        </td>
    </tr>
    <tr>
        <td>
            $table->time('sunrise', 0);
        </td>
        <td>
            Столбец эквивалента TIME с точностью (общее количество цифр).
        </td>
    </tr>
    <tr>
        <td>
            $table->timeTz('sunrise', 0);
        </td>
        <td>
            Эквивалентный столбец TIME (с часовым поясом) с точностью (общее количество цифр).
        </td>
    </tr>
    <tr>
        <td>
            $table->timestamp('added_on', 0);
        </td>
        <td>
            Эквивалентный столбец TIMESTAMP с точностью (общее количество цифр).
        </td>
    </tr>
    <tr>
        <td>
            $table->timestampTz('added_on', 0);
        </td>
        <td>
            Эквивалентный столбец TIMESTAMP (с часовым поясом) с точностью (общее количество цифр).
        </td>
    </tr>
    <tr>
        <td>
            $table->timestamps(0);
        </td>
        <td>
            Добавляет обнуляемые столбцы created_at и updated_at, эквивалентные TIMESTAMP с точностью (общее количество цифр).
        </td>
    </tr>
    <tr>
        <td>
            $table->timestampsTz(0);
        </td>
        <td>
            Добавляет обнуляемые столбцы created_at и updated_at TIMESTAMP (с часовым поясом) с точностью (общее количество цифр).
        </td>
    </tr>
    <tr>
        <td>
            $table->tinyIncrements('id');
        </td>
        <td>
            Автоинкрементный эквивалентный столбец UNSIGNED TINYINT (первичный ключ).
        </td>
    </tr>
    <tr>
        <td>
            $table->tinyInteger('votes');
        </td>
        <td>
            Эквивалентный столбец TINYINT.
        </td>
    </tr>
    <tr>
        <td>
            $table->unsignedBigInteger('votes');
        </td>
        <td>
            UNSIGNED BIGINT эквивалентный столбец.
        </td>
    </tr>
    <tr>
        <td>
            $table->unsignedDecimal('amount', 8, 2);
        </td>
        <td>
            UNSIGNED DECIMAL эквивалентный столбец с точностью (общее количество цифр) и масштабом (десятичные цифры).
        </td>
    </tr>
    <tr>
        <td>
            $table->unsignedInteger('votes');
        </td>
        <td>
            Эквивалентный столбец UNSIGNED INTEGER.
        </td>
    </tr>
    <tr>
        <td>
            $table->unsignedMediumInteger('votes');
        </td>
        <td>
            Эквивалентный столбец UNSIGNED MEDIUMINT.
        </td>
    </tr>
    <tr>
        <td>
            $table->unsignedSmallInteger('votes');
        </td>
        <td>
            UNSIGNED SMALLINT equivalent column.
        </td>
    </tr>
    <tr>
        <td>
            $table->unsignedTinyInteger('votes');
        </td>
        <td>
            эквивалентный столбец UNSIGNED TINYINT.
        </td>
    </tr>
    <tr>
        <td>
            $table->uuid('id');
        </td>
        <td>
            Эквивалентный столбец UUID.
        </td>
    </tr>
    <tr>
        <td>
            $table->year('birth_year');
        </td>
        <td>
            Эквивалентный столбец YEAR.
        </td>
    </tr>
</table>
<h4 class="theme_subtitlex2">
    Модификаторы столбцов
</h4>
<p class="theme__text">
    Вдобавок к перечисленным типам столбцов существует несколько «модификаторов» столбцов, которые вы можете использовать при добавлении столбцов в таблицу. Например, чтобы сделать столбец «обнуляемым», используйте метод nullable():
</p>
<code>
<pre>
Schema::table('users', function (Blueprint $table) {
    $table->string('email')->nullable();
});
</pre>
</code>
<p class="theme__text">
    Ниже перечислены все доступные модификаторы столбцов. В этом списке отсутствуют модификаторы индексов (создание индексов тема):
</p>
<table>
    <tr>
        <td>
            Модификатор
        </td>
        <td>
            Описание
        </td>
    </tr>
    <tr>
        <td>
            ->after('column')
        </td>
        <td>
            Поместите столбец "после" другого столбца (MySQL)
        </td>
    </tr>
    <tr>
        <td>
            ->autoIncrement()
        </td>
        <td>
            Установить столбцы INTEGER как автоинкремент (первичный ключ)
        </td>
    </tr>
    <tr>
        <td>
            ->charset('utf8mb4')
        </td>
        <td>
            Укажите набор символов для столбца (MySQL)
        </td>
    </tr>
    <tr>
        <td>
            ->collation('utf8mb4_unicode_ci')
        </td>
        <td>
            Укажите сопоставление для столбца (MySQL / PostgreSQL / SQL Server)
        </td>
    </tr>
    <tr>
        <td>
            ->comment('my comment')
        </td>
        <td>
            Добавить комментарий в столбец (MySQL / PostgreSQL)
        </td>
    </tr>
    <tr>
        <td>
            ->default($value)
        </td>
        <td>
            Укажите значение "по умолчанию" для столбца.
        </td>
    </tr>
    <tr>
        <td>
            ->first()
        </td>
        <td>
            Поместите столбец «первый» в таблицу (MySQL)
        </td>
    </tr>
    <tr>
        <td>
            ->from($integer)
        </td>
        <td>
            Установите начальное значение автоматически увеличивающегося поля (MySQL / PostgreSQL)
        </td>
    </tr>

    <tr>
        <td>
            ->nullable($value = true)
        </td>
        <td>
            Позволяет (по умолчанию) вставлять значения NULL в столбец
        </td>
    </tr>
    <tr>
        <td>
            ->storedAs($expression)
        </td>
        <td>
            Создать сохраненный сгенерированный столбец (MySQL)
        </td>
    </tr>
    <tr>
        <td>
            ->unsigned()
        </td>
        <td>
            Установить столбцы INTEGER как UNSIGNED (MySQL)
        </td>
    </tr>
    <tr>
        <td>
            ->useCurrent()
        </td>
        <td>
            Установите столбцы TIMESTAMP, чтобы использовать CURRENT_TIMESTAMP в качестве значения по умолчанию
        </td>
    </tr>
    <tr>
        <td>
            ->useCurrentOnUpdate()
        </td>
        <td>
            Установите столбцы TIMESTAMP для использования CURRENT_TIMESTAMP при обновлении записи
        </td>
    </tr>
    <tr>
        <td>
            ->virtualAs($expression)
        </td>
        <td>
            Создать виртуальный сгенерированный столбец (MySQL)
        </td>
    </tr>
    <tr>
        <td>
            ->generatedAs($expression)
        </td>
        <td>
            Создать столбец идентификаторов с указанными параметрами последовательности (PostgreSQL)
        </td>
    </tr>
    <tr>
        <td>
            ->always()
        </td>
        <td>
            Определяет приоритет значений последовательности над вводом для столбца идентификации (PostgreSQL)
        </td>
    </tr>
</table>
<h4 class="theme_subtitlex2">
    Выражения по умолчанию
</h4>
<p class="theme__text">
    Модификатор default принимает значение или экземпляр \ Illuminate \ Database \ Query \ Expression. Использование экземпляра Expression предотвратит заключение значения в кавычки и позволит вам использовать функции, специфичные для базы данных. Одна из ситуаций, когда это особенно полезно, - это когда вам нужно назначить значения по умолчанию для столбцов JSON:
</p>
<code>
<pre>
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Migrations\Migration;

class CreateFlightsTable extends Migration
{
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->json('movies')->default(new Expression('(JSON_ARRAY())'));
            $table->timestamps();
        });
    }
}
</pre>
</code>
<p class="theme__text">
    Поддержка выражений по умолчанию зависит от вашего драйвера базы данных, версии базы данных и типа поля. Пожалуйста, обратитесь к соответствующей документации для совместимости. Также обратите внимание, что использование специальных функций базы данных может тесно связать вас с конкретным драйвером.
</p>
<h3 class="theme__subtitle">
    Изменение столбцов
</h3>
<h4 class="theme_subtitlex2">
    Требования
</h4>
<p class="theme__text">
    Перед изменением столбцов добавьте зависимость doctrine/dbal в свой файл composer.json. Библиотека Doctrine DBAL используется для определения текущего состояния столбца и создания SQL-запросов, необходимых для выполнения указанных преобразований столбца:
</p>
<code>
<pre>
composer require doctrine/dbal
</pre>
</code>
<h4 class="theme_subtitlex2">
    Изменение атрибутов столбца
</h4>
<p class="theme__text">
    Метод change() позволяет изменить тип существующего столбца или изменить его атрибуты. Например, если вы захотите увеличить размер строкового столбца name с 25 до 50:
</p>
<code>
<pre>
Schema::table('users', function (Blueprint $table) {
    $table->string('name', 50)->change();
});
</pre>
</code>
<p class="theme__text">
    Также мы можем изменить столбец, чтобы он стал «обнуляемым»:
</p>
<code>
<pre>
Schema::table('users', function (Blueprint $table) {
    $table->string('name', 50)->nullable()->change();
});
</pre>
</code>
<p class="theme__text">
    Столбы следующих типов нельзя «изменить»: bigInteger, binary, boolean, date, dateTime, dateTimeTz, decimal, integer, json, longText, mediumText, smallInteger, string, text, time, unsignedBigInteger, unsignedInteger, unsignedSmallInteger and uuid.
</p>
<h4 class="theme_subtitlex2">
    Переименование столбцов
</h4>
<p class="theme__text">
    Для переименования столбца используйте метод renameColumn() на построителе структур. Перед переименованием столбца добавьте зависимость doctrine/dbal в свой файл composer.json:
</p>
<code>
<pre>
Schema::table('users', function (Blueprint $table) {
    $table->renameColumn('from', 'to');
});
</pre>
</code>
<p class="theme__text">
    Переименование столбца enum в настоящее время не поддерживается.
</p>
<h4 class="theme_subtitlex2">
    Удаление столбцов
</h4>
<p class="theme__text">
    Для удаления столбца используйте метод dropColumn() на построителе структур. Перед удалением столбцов из базы данных SQLite вам необходимо добавить зависимость doctrine/dbal в ваш файл composer.json и выполнить команду composer update для установки библиотеки:
</p>
<code>
<pre>
Schema::table('users', function (Blueprint $table) {
    $table->dropColumn('votes');
});
</pre>
</code>
<p class="theme__text">
    Вы можете удалить несколько столбцов таблицы, передав массив их имён в метод dropColumn():
</p>
<code>
<pre>
Schema::table('users', function (Blueprint $table) {
    $table->dropColumn(['votes', 'avatar', 'location']);
});
</pre>
</code>
<p class="theme__text">
    Удаление и изменение нескольких столбцов одной миграцией не поддерживается для базы данных SQLite.
    <br><br>
    Доступные псевдонимы команд
</p>
<table>
    <tr>
        <td>
            Команда
        </td>
        <td>
            Описание
        </td>
    </tr>
    <tr>
        <td>
            $table->dropMorphs('morphable');
        </td>
        <td>
            Отбросьте столбцы morphable_id и morphable_type.
        </td>
    </tr>
    <tr>
        <td>
            $table->dropRememberToken();
        </td>
        <td>
            Отбросьте столбец Remember_token.
        </td>
    </tr>
    <tr>
        <td>
            $table->dropSoftDeletes();
        </td>
        <td>
            Отбросьте столбец deleted_at.
        </td>
    </tr>
    <tr>
        <td>
            $table->dropSoftDeletesTz();
        </td>
        <td>
            Псевдоним метода dropSoftDeletes ().
        </td>
    </tr>
    <tr>
        <td>
            $table->dropTimestamps();
        </td>
        <td>
            Отбросьте столбцы created_at и updated_at.
        </td>
    </tr>
    <tr>
        <td>
            $table->dropTimestampsTz();
        </td>
        <td>
            Псевдоним метода dropTimestamps ().
        </td>
    </tr>
</table>
<h3 class="theme__subtitle">Индексы</h3>
<h4 class="theme_subtitlex2">Создание индексов</h4>
<p class="theme__text">
    Построитель структур поддерживает несколько типов индексов. Сначала давайте посмотрим на пример, в котором задаётся, что значения столбца должны быть уникальными. Для создания индекса мы можем просто сцепить метод unique() с определением столбца:
</p>
<code>
<pre>
$table->string('email')->unique();
</pre>
</code>
<p class="theme__text">
    Другой вариант — создать индекс после определения столбца. Например:
</p>
<code>
<pre>
$table->unique('email');
</pre>
</code>
<p class="theme__text">
    Вы можете даже передать массив столбцов в метод index() для создания сложного индекса:
</p>
<code>
<pre>
$table->index(['account_id', 'created_at']);
</pre>
</code>
<p class="theme__text">
    Laravel автоматически генерирует подходящее имя индекса, но вы можете передать своё значение вторым аргументом метода:
</p>
<code>
<pre>
$table->index('email', 'my_index_name');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Доступные типы индексов
</h4>
<p class="theme__text">
    Каждый метод индекса принимает необязательный второй аргумент для указания имени индекса. Если опущено, имя будет производным от имен таблицы и столбцов, используемых для индекса, а также типа индекса.
</p>
<table>
    <tr>
        <td>
            Команда
        </td>
        <td>
            Описание
        </td>
    </tr>
    <tr>
        <td>
            $table->primary('id');
        </td>
        <td>
            Добавление первичного ключа
        </td>
    </tr>
    <tr>
        <td>
            $table->primary(['id', 'parent_id']);
        </td>
        <td>
            Добавление составных ключей
        </td>
    </tr>
    <tr>
        <td>
            $table->unique('email');
        </td>
        <td>
            обавление уникального индекса
        </td>
    </tr>
    <tr>
        <td>
            $table->index('state');
        </td>
        <td>
            Добавление базового индекса
        </td>
    </tr>
    <tr>
        <td>
            $table->spatialIndex('location');
        </td>
        <td>
            Добавляет пространственный индекс. (кроме SQLite)
        </td>
    </tr>
</table>
<h4 class="theme_subtitlex2">
    Длина индекса и MySQL / MariaDB
</h4>
<p class="theme__text">
    Laravel по умолчанию использует набор символов utf8mb4, который включает поддержку хранения «эмодзи» в базе данных. Если вы используете версию MySQL старше версии 5.7.7 или MariaDB старше версии 10.2.2, вам может потребоваться вручную настроить длину строки по умолчанию, генерируемую миграциями, чтобы MySQL мог создавать для них индексы. Вы можете настроить это, вызвав метод Schema :: defaultStringLength в вашем AppServiceProvider:
</p>
<code>
<pre>
use Illuminate\Support\Facades\Schema;

public function boot()
{
    Schema::defaultStringLength(191);
}
</pre>
</code>
<p class="theme__text">
    В качестве альтернативы вы можете включить опцию innodb_large_prefix для своей базы данных. Обратитесь к документации вашей базы данных для получения инструкций о том, как правильно включить эту опцию.
</p>
<h4 class="theme_subtitlex2">
    Переименование индексов
</h4>
<p class="theme__text">
    Чтобы переименовать индекс, вы можете использовать метод renameIndex. Этот метод принимает текущее имя индекса в качестве первого аргумента и желаемое новое имя в качестве второго аргумента:
</p>
<code>
<pre>
$table->renameIndex('from', 'to')
</pre>
</code>
<h4 class="theme_subtitlex2">
    Удаление индексов
</h4>
<p class="theme__text">
    Для удаления индекса необходимо указать его имя. По умолчанию Laravel автоматически назначает имена индексам. Просто соедините имя таблицы, имя столбца-индекса и тип индекса. Вот несколько примеров:
</p>
<table>
    <tr>
        <td>
            Команда
        </td>
        <td>
            Описание
        </td>
    </tr>
    <tr>
        <td>
            $table->dropPrimary('users_id_primary');
        </td>
        <td>
            Удаление первичного ключа из таблицы "users"
        </td>
    </tr>
    <tr>
        <td>
            $table->dropUnique('users_email_unique');
        </td>
        <td>
            Удаление уникального индекса из таблицы "users"
        </td>
    </tr>
    <tr>
        <td>
            $table->dropIndex('geo_state_index');
        </td>
        <td>
            Удаление базового индекса из таблицы "geo"
        </td>
    </tr>
    <tr>
        <td>
            $table->dropSpatialIndex('geo_location_spatialindex');
        </td>
        <td>
            Удалите пространственный индекс из таблицы "geo" (кроме SQLite).
        </td>
    </tr>
</table>
<p class="theme__text">
    Если вы передадите массив столбцов в метод для удаления индексов, будет сгенерировано стандартное имя индекса на основе имени таблицы, столбца и типа ключа:
</p>
<code>
<pre>
Schema::table('geo', function (Blueprint $table) {
    $table->dropIndex(['state']); // Удаление индекса 'geo_state_index'
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Ограничения внешнего ключа
</h4>
<p class="theme__text">
    Laravel также поддерживает создание ограничений для внешнего ключа, которые используются для обеспечения ссылочной целостности на уровне базы данных. Например, давайте определим столбец user_id в таблице posts, который ссылается на столбец id в таблице users:
</p>
<code>
<pre>
Schema::table('posts', function (Blueprint $table) {
    $table->unsignedBigInteger('user_id');

    $table->foreign('user_id')->references('id')->on('users');
});
</pre>
</code>
<p class="theme__text">
    Поскольку этот синтаксис довольно подробный, Laravel предоставляет дополнительные, более сжатые методы, которые используют соглашения, чтобы обеспечить лучший опыт разработчика. Пример выше можно записать так:
</p>
<code>
<pre>
Schema::table('posts', function (Blueprint $table) {
    $table->foreignId('user_id')->constrained();
});
</pre>
</code>
<p class="theme__text">
    Метод foreignId является псевдонимом для unsignedBigInteger, в то время как constrained метод будет использовать соглашение для определения имени таблицы и столбца, на которые ссылаются. Если имя вашей таблицы не соответствует соглашению, вы можете указать имя таблицы, передав его в качестве аргумента constrained методу:
</p>
<code>
<pre>
Schema::table('posts', function (Blueprint $table) {
    $table->foreignId('user_id')->constrained('users');
});
</pre>
</code>
<p class="theme__text">
    Вы также можете указать требуемое действие для свойств "on delete" и "on update" ограничений:
</p>
<code>
<pre>
$table->foreignId('user_id')
    ->constrained()
    ->onUpdate('cascade')
    ->onDelete('cascade');
</pre>
</code>
<p class="theme__text">
    Любые дополнительные модификаторы столбца должны быть вызваны до ограничения:
</p>
<code>
<pre>
$table->foreignId('user_id')
      ->nullable()
      ->constrained();
</pre>
</code>
<p class="theme__text">
    Для удаления внешнего ключа используйте метод dropForeign(). Ограничения внешнего ключа используют те же принципы именования, что и индексы. Итак, мы соединим имя таблицы и столбцов из ограничения, а затем добавим суффикс "_foreign":
</p>
<code>
<pre>
$table->dropForeign('posts_user_id_foreign');
</pre>
</code>
<p class="theme__text">
    Либо вы можете передать значение массива, при этом для удаления будет автоматически использовано стандартное имя ограничения:
</p>
<code>
<pre>
$table->dropForeign(['user_id']);
</pre>
</code>
<p class="theme__text">
    Вы можете включить или выключить ограничения внешнего ключа в своих миграциях с помощью следующих методов:
</p>
<code>
<pre>
Schema::enableForeignKeyConstraints();

Schema::disableForeignKeyConstraints();
</pre>
</code>
<p class="theme__text">
    SQLite по умолчанию отключает ограничения внешнего ключа. При использовании SQLite обязательно включите поддержку внешних ключей в конфигурации вашей базы данных, прежде чем пытаться создать их в своих миграциях. Кроме того, SQLite поддерживает внешние ключи только при создании таблицы, а не при изменении таблиц.
</p>
    </div>
    <div class="theme">
<h3 class="theme__subtitle">
    Загрузка начальных данных в БД
</h3>
<p class="theme__text">
    У Laravel есть простой механизм наполнения вашей БД начальными данными (seeding) с помощью специальных классов. Все такие классы хранятся в каталоге database/seeds. Они могут иметь любое имя, но вам, вероятно, следует придерживаться какой-то логики в их именовании — например, UserTableSeeder и т.д. По умолчанию для вас уже определён класс DatabaseSeeder. Из этого класса вы можете вызывать метод call() для подключения других классов с данными, что позволит вам контролировать порядок их выполнения.
</p>
<h3 class="theme__subtitle">
    Создание начальных данных
</h3>
<p class="theme__text">
    Для добавления данных в БД используйте Artisan-команду make:seeder. Все начальные данные, сгенерированные фреймворком, будут помещены в папке database/seeders:
</p>
<code>
<pre>
php artisan make:seeder UsersTableSeeder
</pre>
</code>
<p class="theme__text">
    Класс начальных данных содержит в себе только один метод по умолчанию — run(). Этот метод вызывается, когда выполняется Artisan-команда db:seed. В методе run() вы можете вставить любые данные в БД. Вы можете использовать конструктор запросов, чтобы вручную вставить данные. Также можно воспользоваться фабриками Eloquent моделей.
    <br><br>
    Защита массового назначения автоматически отключается во время заполнения базы данных.
    <br><br>
    В качестве примера давайте модифицируем стандартный класс DatabaseSeeder и добавим оператор вставки в БД в метод run():
</p>
<code>
<pre>
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
</pre>
</code>
<p class="theme__text">
    Вы можете указать любые необходимые зависимости в сигнатуре метода запуска. Они будут автоматически разрешены через сервисный контейнер Laravel.
</p>
<h3 class="theme__subtitle">
    Использование фабрик моделей
</h3>
<p class="theme__text">
    Конечно, ручное определение признаков для каждой модели начальных данных затруднительно. Вместо этого вы можете использовать фабрики моделей для быстрой генерации больших объёмов данных. Во-первых, пересмотрите документацию по фабрике моделей (db testing link), чтобы изучить, как определяются фабрики. Как только вы определите свои фабрики, вы можете использовать вспомогательную функцию factory(), чтобы вставлять записи в вашу базу данных.
    <br><br>
    Например, давайте создадим 50 пользователей и привяжем отношения к каждому из них:
</p>
<code>
<pre>
use App\Models\User;

public function run()
{
    User::factory()
            ->times(50)
            ->hasPosts(1)
            ->create();
}
</pre>
</code>
<h3 class="theme__subtitle">
    Вызов дополнительной загрузки начальных данных
</h3>
<p class="theme__text">
    В классе DatabaseSeeder вы можете использовать метод call(), чтобы запустить дополнительные классы загрузки. Использование метода call() позволяет вам разбить свою загрузку начальных данных на несколько файлов, чтобы ни один отдельный класс загрузки не разрастался. Просто передайте название класса загрузки, который вы хотите выполнить:
</p>
<code>
<pre>
public function run()
{
    $this->call([
        UserSeeder::class,
        PostSeeder::class,
        CommentSeeder::class,
    ]);
}
</pre>
</code>
<h3 class="theme__subtitle">
    Запуск загрузки начальных данных
</h3>
<p class="theme__text">
    Как только вы написали свои классы загрузки, вы можете использовать Artisan-команду db:seed для запуска загрузки. По умолчанию команда db:seed вызывает класс DatabaseSeeder, который может быть использован для вызова других классов, заполняющих БД данными. Однако, вы можете использовать параметр --class для указания конкретного класса для вызова:
</p>
<code>
<pre>
php artisan db:seed

php artisan db:seed --class=UserSeeder
</pre>
</code>
<p class="theme__text">
    Вы также можете использовать для заполнения БД данными команду migrate:refresh, которая также откатит и заново применит все ваши миграции:
</p>
<code>
<pre>
php artisan migrate:fresh --seed
</pre>
</code>
<h4 class="theme_subtitlex2">
    Запуск загрузки начальных данных в продакшане
</h4>
<p class="theme__text">
    Некоторые операции по заполнению могут привести к изменению или потере данных. Чтобы защитить вас от запуска команд раздачи для вашей производственной базы данных, вам будет предложено подтвердить перед запуском сидеров. Чтобы заставить сеялки работать без подсказки, используйте флаг --force:
</p>
<code>
<pre>
php artisan db:seed --force
</pre>
</code>
    </div>
    <div class="theme">
        <h2 class="theme__title">
            Redis
        </h2>
<p class="theme__text">
    Redis — открытое продвинутое хранилище пар ключ/значение. Его часто называют сервисом структур данных, так как ключи могут содержать строки, хэши, списки, наборы и сортированные наборы.
    <br><br>
    Чтобы начать использовать Redis с Laravel, необходимо либо установить пакет predis/predis с помощью Composer:
</p>
<code>
<pre>
composer require predis/predis
</pre>
</code>
<p class="theme__text">
    Либо, вы можете установить расширение для PHP PhpRedis через PECL. Расширение сложнее установить, но оно даёт большую производительность для приложений, которые активно используют Redis.
</p>
<h3 class="theme__subtitle">Настройка</h3>
<p class="theme__text">
    Настройки вашего подключения к Redis хранятся в файле config/database.php. В нём вы найдёте массив redis, содержащий список серверов, используемых приложением:
</p>
<code>
<pre>
'redis' => [

    'client' => env('REDIS_CLIENT', 'phpredis'),

    'default' => [
        'host' => env('REDIS_HOST', '127.0.0.1'),
        'password' => env('REDIS_PASSWORD', null),
        'port' => env('REDIS_PORT', 6379),
        'database' => env('REDIS_DB', 0),
    ],

    'cache' => [
        'host' => env('REDIS_HOST', '127.0.0.1'),
        'password' => env('REDIS_PASSWORD', null),
        'port' => env('REDIS_PORT', 6379),
        'database' => env('REDIS_CACHE_DB', 1),
    ],

],
</pre>
</code>
<p class="theme__text">
    Значения по умолчанию должны подойти для разработки. Однако вы свободно можете изменять этот массив в зависимости от своего окружения. У каждого сервера Redis, определённого в файле конфигурации, должны быть имя, хост и порт, если вы не определите единственный URL-адрес для представления соединения Redis:
</p>
<code>
<pre>
'redis' => [

    'client' => env('REDIS_CLIENT', 'phpredis'),

    'default' => [
        'url' => 'tcp://127.0.0.1:6379?database=0',
    ],

    'cache' => [
        'url' => 'tls://user:password@127.0.0.1:6380?database=1',
    ],

],
</pre>
</code>
<h4 class="theme_subtitlex2">
    Настройка схемы подключения
</h4>
<p class="theme__text">
    По умолчанию клиенты Redis будут использовать схему tcp при подключении к вашим серверам Redis; однако вы можете использовать шифрование TLS / SSL, указав параметр конфигурации scheme в конфигурации сервера Redis:
</p>
<code>
<pre>
'redis' => [

    'client' => env('REDIS_CLIENT', 'phpredis'),

    'default' => [
        'scheme' => 'tls',
        'host' => env('REDIS_HOST', '127.0.0.1'),
        'password' => env('REDIS_PASSWORD', null),
        'port' => env('REDIS_PORT', 6379),
        'database' => env('REDIS_DB', 0),
    ],

],
</pre>
</code>
<h4 class="theme_subtitlex2">
    Настройка кластеров
</h4>
<p class="theme__text">
    Если ваше приложение использует кластер серверов Redis, вы должны определить эти кластеры в ключе clusters вашей конфигурации Redis:
</p>
<code>
<pre>
'redis' => [

    'client' => env('REDIS_CLIENT', 'phpredis'),

    'clusters' => [
        'default' => [
            [
                'host' => env('REDIS_HOST', 'localhost'),
                'password' => env('REDIS_PASSWORD', null),
                'port' => env('REDIS_PORT', 6379),
                'database' => 0,
            ],
        ],
    ],

],
</pre>
</code>
<p class="theme__text">
    По умолчанию кластеры будут выполнять сегментирование ваших узлов на стороне клиента, что позволяет объединять узлы в пул и создавать большой объем доступной оперативной памяти. Однако обратите внимание, что сегментирование на стороне клиента не обрабатывает отработку отказа; поэтому он в первую очередь подходит для кэшированных данных, доступных из другого первичного хранилища данных. Если вы хотите использовать собственную кластеризацию Redis, вы должны указать это в ключе options вашей конфигурации Redis:
</p>
<code>
<pre>
'redis' => [

    'client' => env('REDIS_CLIENT', 'phpredis'),

    'options' => [
        'cluster' => env('REDIS_CLUSTER', 'redis'),
    ],

    'clusters' => [
        // ...
    ],

],
</pre>
</code>
<p class="theme__text">
    Параметр cluster сообщает клиенту Redis Laravel, что нужно выполнить фрагментацию узлов Redis (client-side sharding), что позволит вам обращаться к ним и увеличить доступную RAM. Однако заметьте, что фрагментация не справляется с падениями, поэтому она в основном используется для кэшированных данных, которые доступны из основного источника.
</p>
<h3 class="theme__subtitle">
    Predis
</h3>
<p class="theme__text">
    Чтобы использовать расширение Predis, вы должны изменить переменную среды REDIS_CLIENT с phpredis на predis:
</p>
<code>
<pre>
'redis' => [

    'client' => env('REDIS_CLIENT', 'predis'),

    // Rest of Redis configuration...
],
</pre>
</code>
<p class="theme__text">
    Помимо стандартных опций настройки сервера host, port, database и password Predis поддерживает дополнительные параметры подключения, которые можно определить для каждого из ваших серверов Redis. Чтобы использовать эти дополнительные опции, просто добавьте их в конфигурацию вашего сервера Redis в файле config/database.php:
</p>
<code>
<pre>
'default' => [
    'host' => env('REDIS_HOST', 'localhost'),
    'password' => env('REDIS_PASSWORD', null),
    'port' => env('REDIS_PORT', 6379),
    'database' => 0,
    'read_write_timeout' => 60,
],
</pre>
</code>
<h3 class="theme__subtitle">
    PhpRedis
</h3>
<p class="theme__text">
    Расширение PhpRedis настроено по умолчанию в REDIS_CLIENT env и в вашем config / database.php:
</p>
<code>
<pre>
'redis' => [

    'client' => env('REDIS_CLIENT', 'phpredis'),

    // Rest of Redis configuration...
],
</pre>
</code>
<p class="theme__text">
    Если вы планируете использовать расширение PhpRedis вместе с псевдонимом Redis Facade, вам следует переименовать его во что-нибудь другое, например RedisManager, чтобы избежать столкновения с классом Redis. Вы можете сделать это в разделе псевдонимов вашего конфигурационного файла app.php.
</p>
<code>
<pre>
'RedisManager' => Illuminate\Support\Facades\Redis::class,
</pre>
</code>
<p class="theme__text">
    В дополнение к параметрам конфигурации сервера по умолчанию, host, port, database, and password, PhpRedis поддерживает следующие дополнительные параметры подключения: persistent, prefix, read_timeout, retry_interval, timeout, and context. Вы можете добавить любую из этих опций в конфигурацию вашего сервера Redis в файле конфигурации config / database.php:
</p>
<code>
<pre>
'default' => [
    'host' => env('REDIS_HOST', 'localhost'),
    'password' => env('REDIS_PASSWORD', null),
    'port' => env('REDIS_PORT', 6379),
    'database' => 0,
    'read_timeout' => 60,
    'context' => [
        // 'auth' => ['username', 'secret'],
        // 'stream' => ['verify_peer' => false],
    ],
],
</pre>
</code>
<h4 class="theme_subtitlex2">The Redis Facade</h4>
<p class="theme__text">
    Чтобы избежать конфликтов именования классов с самим расширением Redis PHP, вам необходимо удалить или переименовать псевдоним фасада Illuminate \ Support \ Facades \ Redis из массива псевдонимов файла конфигурации app. Как правило, вы должны полностью удалить этот псевдоним и ссылаться на фасад только по его полному имени класса при использовании расширения Redis PHP.
</p>
<h3 class="theme__subtitle">Взаимодействие с Redis</h3>
<p class="theme__text">
    Вы можете взаимодействовать с Redis, вызывая различные методы фасада Redis. Фасад Redis поддерживает динамические методы, а значит вы можете вызвать любую Redis-команду на фасаде, и команда будет передана прямо в Redis. В этом примере мы вызовем Redis-команду GET с помощью вызова метода get() фасада Redis:
</p>
<code>
<pre>
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function showProfile($id)
    {
        $user = Redis::get('user:profile:'.$id);

        return view('user.profile', ['user' => $user]);
    }
}
</pre>
</code>
<p class="theme__text">
    Как уже было сказано, вы можете вызывать любые Redis-команды фасада Redis. Laravel использует магические методы PHP для передачи команд на сервер Redis, поэтому просто передайте необходимые аргументы Redis-команде:
</p>
<code>
<pre>
Redis::set('name', 'Taylor');

$values = Redis::lrange('names', 5, 10);
</pre>
</code>
<p class="theme__text">
    В качестве альтернативы вы можете передавать команды на сервер методом command(), который принимает первым аргументом имя команды, а вторым — массив значений:
</p>
<code>
<pre>
$values = Redis::command('lrange', ['name', 5, 10]);
</pre>
</code>
<h4 class="theme_subtitlex2">Использование нескольких подключений Redis</h4>
<p class="theme__text">
    Вы можете получить экземпляр Redis методом Redis::connection():
</p>
<code>
<pre>
$redis = Redis::connection();
</pre>
</code>
<p class="theme__text">
    Это даст вам экземпляр сервера Redis по умолчанию. Вы также можете передать имя подключения или кластера методу connection, чтобы получить конкретный сервер или кластер, как определено в вашей конфигурации Redis:
</p>
<code>
<pre>
$redis = Redis::connection('my-connection');
</pre>
</code>
<h3 class="theme__subtitle">Конвейер команд</h3>
<p class="theme__text">
    Конвейер должен использоваться, когда вы отправляете много команд на сервер за одну операцию. Метод pipeline() принимает один аргумент — замыкание, которое получает экземпляр Redis. Вы можете выполнить все ваши команды на этом экземпляре Redis, и все они будут выполнены в рамках одной операции:
</p>
<code>
<pre>
Redis::pipeline(function ($pipe) {
    for ($i = 0; $i < 1000; $i++) {
        $pipe->set("key:$i", $i);
    }
});
</pre>
</code>
<h3 class="theme__subtitle">
    Издатель/подписчик (Pub/Sub)
</h3>
<p class="theme__text">
    Laravel предоставляет удобный интерфейс к Redis-командам publish и subscribe. Эти команды позволяют прослушивать сообщения на заданном «канале». Вы можете публиковать сообщения в канал из другого приложения или даже при помощи другого языка программирования, что обеспечивает простую связь между приложениями и процессами.
    <br><br>
    Сначала давайте настроим слушатель канала с помощью метода subscribe(). Мы поместим вызов этого метода в Artisan-команду, так как вызов метода subscribe() запускает длительный процесс:
</p>
<code>
<pre>
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisSubscribe extends Command
{
    protected $signature = 'redis:subscribe';

    protected $description = 'Subscribe to a Redis channel';

    public function handle()
    {
        Redis::subscribe(['test-channel'], function ($message) {
            echo $message;
        });
    }
}
</pre>
</code>
<p class="theme__text">
    Теперь мы можем публиковать сообщения в канал методом publish():
</p>
<code>
<pre>
Route::get('publish', function () {
    // Route logic...

    Redis::publish('test-channel', json_encode(['foo' => 'bar']));
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Подписка по маске
</h4>
<p class="theme__text">
    С помощью метода psubscribe() вы можете подписаться на канал по маске, это может быть полезно для отлова всех сообщений на всех каналах. Название канала $channel будет передано вторым аргументом в предоставляемый обратный вызов замыкания:
</p>
<code>
<pre>
Redis::psubscribe(['*'], function ($message, $channel) {
    echo $message;
});

    Redis::psubscribe(['users.*'], function ($message, $channel) {
    echo $message;
});
</pre>
</code>
    </div>
</div>
@endsection







