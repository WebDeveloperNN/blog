@extends('layouts.mainLayout')
@section('content')

<div class="themes">
    <h1 class="themes__title">Глубокое изучение</h1>
    <div class="theme">
<h2 class="theme__title">
    Artisan консоль
</h2>
<p class="theme__text">
    Artisan — интерфейс командной строки, который поставляется с Laravel. Он содержит набор полезных команд, помогающих вам при разработке приложения. Для просмотра списка доступных команд используйте команду list:
</p>
<code>
<pre>
php artisan list
</pre>
</code>
<p class="theme__text">
    Каждая команда имеет описание, в котором указаны её доступные аргументы и ключи. Для просмотра описания просто добавьте перед командой слово help:
</p>
<code>
<pre>
php artisan help migrate
</pre>
</code>
<h3 class="theme__subtitle">
    Tinker (REPL)
</h3>
<p class="theme__text">
    Laravel Tinker - это мощный REPL для фреймворка Laravel, работающий на базе пакета PsySH.
</p>
<h4 class="theme_subtitlex2">
    Установка
</h4>
<p class="theme__text">
    Все приложения Laravel по умолчанию включают Tinker. Однако при необходимости вы можете установить его вручную с помощью Composer:
</p>
<code>
<pre>
composer require laravel/tinker
</pre>
</code>
<p class="theme__text">
    Ищете графический интерфейс для взаимодействия с вашим приложением Laravel? Зацени Tinkerwell!!
</p>
<h4 class="theme_subtitlex2">
    Использование
</h4>
<p class="theme__text">
    Tinker позволяет вам взаимодействовать со всем вашим приложением Laravel в командной строке, включая Eloquent ORM, задания, события и многое другое. Чтобы войти в среду Tinker, выполните Artisan-команду tinker:
</p>
<code>
<pre>
php artisan tinker
</pre>
</code>
<p class="theme__text">
    Вы можете опубликовать файл конфигурации Tinker с помощью команды vendor: publish:
</p>
<code>
<pre>
php artisan vendor:publish --provider="Laravel\Tinker\TinkerServiceProvider"
</pre>
</code>
<p class="theme__text">
    Вспомогательная функция dispatch и метод dispatch в классе Dispatchable зависят от сборки мусора для помещения задания в очередь. Следовательно, при использовании tinker вы должны использовать Bus :: dispatch или Queue :: push для отправки заданий.
</p>
<h4 class="theme_subtitlex2">Белый список команд</h4>
<p class="theme__text">
    Tinker использует белый список, чтобы определить, какие команды Artisan разрешено запускать в его оболочке. По умолчанию вы можете запускать команды clear-compiled, down, env, inspire, migrate, optimize и up. Если вы хотите внести в белый список больше команд, вы можете добавить их в массив commands в файле конфигурации tinker.php:
</p>
<code>
<pre>
'commands' => [
    // App\Console\Commands\ExampleCommand::class,
],
</pre>
</code>
<h4 class="theme_subtitlex2">
    Классы, которые не должны иметь псевдонимов
</h4>
<p class="theme__text">
    Обычно Tinker автоматически присваивает классам псевдонимы, если они вам нужны в Tinker. Однако вы можете никогда не использовать псевдонимы для некоторых классов. Вы можете сделать это, перечислив классы в массиве dont_alias вашего файла конфигурации tinker.php:
</p>
<code>
<pre>
'dont_alias' => [
    App\Models\User::class,
],
</pre>
</code>
<h3 class="theme__subtitle">Создание команд</h3>
<p class="theme__text">
    В дополнение к стандартным командам Artisan вы можете также создавать свои собственные команды. Обычно команды хранятся в папке app/Console/Commands, но вы можете поместить их в любое другое место, в котором их сможет найти и загрузить Composer.
</p>
<h4 class="theme_subtitlex2">Генерирование команд</h4>
<p class="theme__text">
    Для создания новой команды используйте Artisan-команду make:command. Эта команда создаст новый класс команды в папке app/Console/Commands. Если этой папке не существует, она будет создана при первом запуске команды make:command. Сгенерированная команда будет содержать стандартный набор свойств и методов, присущих всем командам:
</p>
<code>
<pre>
php artisan make:command SendEmails
</pre>
</code>
<h4 class="theme_subtitlex2">
    Структура команды
</h4>
<p class="theme__text">
    После генерирования команды, вам нужно заполнить свойства signature и description в её классе, которые используются при отображении вашей команды в списке команд (list). При вызове вашей команды будет вызван метод handle(). В него вы можете поместить необходимую вам логику.
    <br><br>
    Для улучшения кода, с точки зрения его повторного использования, полезно сохранять ваши консольные команды простыми и использовать в них сервисы самого приложения для выполнения их задач. Обратите внимание, что в приведённом примере мы внедряем класс сервиса для выполнения «трудоёмкой» задачи отправки писем.
    <br><br>
    Давайте посмотрим на пример команды. Мы можем внедрить любые необходимые зависимости в конструкторе команды. Сервис-контейнер Laravel автоматически внедрит все указанные в конструкторе зависимости:
</p>
<code>
<pre>
namespace App\Console\Commands;

use App\Models\User;
use App\Support\DripEmailer;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    protected $signature = 'email:send {user}';
    protected $description = 'Send drip e-mails to a user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(DripEmailer $drip)
    {
        $drip->send(User::find($this->argument('user')));
    }
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Команды замыкания
</h4>
<p class="theme__text">
    Команды на основе замыканий являются альтернативой определению консольных команд в виде классов, подобно тому, как замыкания маршрутов являются альтернативой контроллерам. В методе commands() файла app/Console/Kernel.php Laravel загружает файл routes/console.php:
</p>
<code>
<pre>
/**
 * Регистрация команд на основе замыканий для приложения.
 *
 * @return void
 */
protected function commands()
{
  require base_path('routes/console.php');
}
</pre>
</code>
<p class="theme__text">
    Не смотря на то, что этот файл не определяет HTTP-маршруты, он определяет консольные входные точки (маршруты) в ваше приложение. В этом файле вы можете определить все свои маршруты на основе замыканий с помощью метода Artisan::command(). Метод command() принимает два аргумента: сигнатуру команды и замыкание, которое получает аргументы и ключи команды:
</p>
<code>
<pre>
Artisan::command('build {project}', function ($project) {
    $this->info("Building {$project}!");
});
</pre>
</code>
<p class="theme__text">
    Замыкание привязано к лежащему в основе экземпляру команды, поэтому у вас есть полный доступ ко всем вспомогательным методам, которые обычно доступны вам в полном классе команды.
</p>
<h4 class="theme_subtitlex2">Указание типов зависимостей</h4>
<p class="theme__text">
    Помимо получения аргументов и ключей вашей команды в замыканиях команд можно указывать типы дополнительных зависимостей, которые вам необходимо получить из сервис-контейнера:
</p>
<code>
<pre>
use App\User;
use App\DripEmailer;

Artisan::command('email:send {user}', function (DripEmailer $drip, $user) {
  $drip->send(User::find($user));
});
</pre>
</code>
<h4 class="theme_subtitlex2">Описание команд замыканий</h4>
<p class="theme__text">
    При определении команд на основе замыканий вы можете использовать метод describe() для добавления описания команды. Это описание будет выводится при выполнении команд php artisan list или php artisan help:
</p>
<code>
<pre>
Artisan::command('build {project}', function ($project) {
    $this->info("Building {$project}!");
})->describe('Build the project');
</pre>
</code>
<h3 class="theme__subtitle">Определение ожиданий ввода</h3>
<p class="theme__text">
    При создании консольных команд часто необходимо получать ввод от пользователя через аргументы или ключи. В Laravel очень удобно определить ожидаемый от пользователя ввод, используя свойство signature вашей команды. Это свойство позволяет задать имя, аргументы и ключи для команды в едином, выразительном, маршруто-подобном синтаксисе.
</p>
<h4 class="theme_subtitlex2">Аргументы</h4>
<p class="theme__text">Все вводимые пользователем аргументы и ключи заключаются в фигурные скобки. В следующем примере команда определяет один требуемый аргумент user:</p>
<code>
<pre>
/**
 * Имя и аргументы консольной команды.
 *
 * @var string
 */
protected $signature = 'email:send {user}';
</pre>
</code>
<p class="theme__text">Вы можете сделать аргумент необязательным и определить значения по умолчанию для аргументов:</p>
<code>
<pre>
// Необязательный аргумент...
email:send {user?}

// Необязательный аргумент со значением по умолчанию...
email:send {user=foo}
</pre>
</code>
<h4 class="theme_subtitlex2">Ключи</h4>
<p class="theme__text">
    Ключи, как и аргументы, являются формой пользовательского ввода. Они обозначаются префиксом из двух дефисов (—). Существует два типа ключей: принимающие значение и не принимающие. Ключи, которые не принимают значение, служат логическими «переключателями». Давайте посмотрим на такой тип ключей:
</p>
<code>
<pre>
/**
 * Имя и аргументы консольной команды.
 *
 * @var string
 */
protected $signature = 'email:send {user} {--queue}';
</pre>
</code>
<p class="theme__text">
    В этом примере при вызове Artisan-команды может быть указан ключ --queue. Если будет передан ключ --queue, то его значение будет true, иначе false:
</p>
<code>
<pre>
php artisan email:send 1 --queue
</pre>
</code>
<h4 class="theme_subtitlex2">
    Ключи со значениями
</h4>
<p class="theme__text">
    Теперь посмотрим на ключи, которые ожидают значения. Необходимость ввода значения для ключа задаётся при помощи знака равно (=):
</p>
<code>
<pre>
/**
 * Имя и аргументы консольной команды.
 *
 * @var string
 */
protected $signature = 'email:send {user} {--queue=}';
</pre>
</code>
<p class="theme__text">
    В этом примере пользователь может передать значение для ключа вот так:
</p>
<code>
<pre>
php artisan email:send 1 --queue=default
</pre>
</code>
<p class="theme__text">
    Для ключей можно задать значение по умолчанию, указав его после имени ключа. Это значение будет использовано, если пользователь не укажет значение ключа:
</p>
<code>
<pre>
email:send {user} {--queue=default}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Сокращение ключа
</h4>
<p class="theme__text">
    Чтобы задать сокращение при определении ключа, вы можете указать его перед именем ключа и отделить его символом вертикальной черты (|):
</p>
<code>
<pre>
email:send {user} {--Q|queue}
</pre>
</code>
<h4 class="theme_subtitlex2">Ввод массивов</h4>
<p class="theme__text">
    Если вы хотите указать, что аргументы или ключи будут принимать на вход массивы, используйте символ *. Сначала посмотрим на пример указания аргумента массива:
</p>
<code>
<pre>
email:send {user*}
</pre>
</code>
<p class="theme__text">
    При вызове этой команды в командную строку можно передать аргументы user по порядку. Например, следующая команда установит значение user равное ['foo', 'bar']:
</p>
<code>
<pre>
php artisan email:send foo bar
</pre>
</code>
<p class="theme__text">
    При определении ключа, который будет принимать на вход массив, каждое передаваемое в команду значение ключа должно иметь префикс в виде имени ключа:
</p>
<code>
<pre>
email:send {user} {--id=*}

php artisan email:send --id=1 --id=2
</pre>
</code>
<h4 class="theme_subtitlex2">Описание ввода</h4>
<p class="theme__text">
    Вы можете задать описание для аргументов и ключей, отделив их двоеточием. Если вам необходимо немного больше места для определения вашей команды, вы можете разделить описание на несколько строк:
</p>
<code>
<pre>
/**
 * Имя и аргументы консольной команды.
 *
 * @var string
 */
protected $signature = 'email:send
                        {user : ID пользователя}
                        {--queue= : Ставить ли задачу в очередь}';
</pre>
</code>
<h3 class="theme__subtitle">
    Ввод/вывод команд
</h3>
<h4 class="theme_subtitlex2">
    Чтение ввода
</h4>
<p class="theme__text">
    Во время выполнения команды вам, конечно, потребуется доступ к аргументам и ключам, которые были переданы ей на вход. Для этого вы можете использовать методы argument() и option().
    <br><br>
    Для чтения значения аргумента используйте метод argument():
</p>
<code>
<pre>
/**
* Выполнение консольной команды.
*
* @return mixed
*/
public function handle()
{
    $userId = $this->argument('user');

    //
}
</pre>
</code>
<p class="theme__text">
    Если вам необходимо прочитать все аргументы в виде массива, вызовите метод arguments() (для версии 5.2 и ранее — метод argument() без аргументов):
</p>
<code>
<pre>
$arguments = $this->arguments();
</pre>
</code>
<p class="theme__text">
    Ключи можно прочитать так же легко, как аргументы, используя метод option(). Чтобы получить массив всех ключей, вызовите метод options() (для версии 5.2 и ранее — метод option() без аргументов):
</p>
<code>
<pre>
// Чтение конкретного ключа...
$queueName = $this->option('queue');

// Чтение всех ключей...
$options = $this->options();
</pre>
</code>
<p class="theme__text">
    Если аргумента или ключа не существует, будет возвращён null.
</p>
<h4 class="theme_subtitlex2">
    Запрос ввода
</h4>
<p class="theme__text">
    В дополнение к отображению вывода вы можете запросить у пользователя данные во время выполнения команды. Метод ask() выведет запрос, примет введённые данные, а затем вернёт их вашей команде:
</p>
<code>
<pre>
/**
 * Выполнение консольной команды.
 *
 * @return mixed
 */
public function handle()
{
    $name = $this->ask('What is your name?');
}
</pre>
</code>
<p class="theme__text">
    Метод secret() похож на метод ask(), но он не отображает вводимые пользователем данные в консоли. Этот метод полезен при запросе секретной информации, такой как пароль:
</p>
<code>
<pre>
$password = $this->secret('What is the password?');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Запрос подтверждения
</h4>
<p class="theme__text">
    Для получения от пользователя простого подтверждения можно использовать метод confirm(). По умолчанию этот метод возвращает false. Но если пользователь введёт y или yes в ответ на запрос, то метод вернёт true:
</p>
<code>
<pre>
if ($this->confirm('Do you wish to continue?')) {
    //
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Автозаполнение
</h4>
<p class="theme__text">
    Метод anticipate() можно использовать для предоставления пользователю возможных вариантов для выбора. Независимо от наличия этих вариантов пользователь может указать свой вариант.
</p>
<code>
<pre>
$name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
</pre>
</code>
<p class="theme__text">
    В качестве альтернативы вы можете передать Closure в качестве второго аргумента anticipate метода. Замыкание будет вызываться каждый раз, когда пользователь вводит вводимый символ. Замыкание должно принимать строковый параметр, содержащий введенные пользователем данные, и возвращать массив опций для автозаполнения:
</p>
<code>
<pre>
$name = $this->anticipate('What is your name?', function ($input) {
    // Return auto-completion options...
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Вопросы с несколькими вариантами ответов
</h4>
<p class="theme__text">
    Для предоставления пользователю определённого набора вариантов можно использовать метод choice(). Можно задать значение по умолчанию, на случай если вариант не выбран:
</p>
<code>
<pre>
$name = $this->choice('What is your name?', ['Taylor', 'Dayle'], $defaultIndex)
</pre>
</code>
<p class="theme__text">
    Кроме того, метод choice принимает необязательные четвертый и пятый аргументы для определения максимального количества попыток выбора действительного ответа и того, разрешен ли множественный выбор:
</p>
<code>
<pre>
$name = $this->choice(
    'What is your name?',
    ['Taylor', 'Dayle'],
    $defaultIndex,
    $maxAttempts = null,
    $allowMultipleSelections = false
);
</pre>
</code>
<h4 class="theme_subtitlex2">Вывод</h4>
<p class="theme__text">
    Для вывода вы можете использовать методы line(), info(), comment(), question() и error(). Каждый из них будет использовать подходящие по смыслу цвета ANSI для отображении текста. Давайте для примера выведем информационное сообщение для пользователя. Обычно метод info() выводит в консоль текст зелёного цвета:
</p>
<code>
<pre>
/**
 * Выполнение консольной команды.
 *
 * @return mixed
 */
public function handle()
{
    $this->info('Вывести это на экран');
}
</pre>
</code>
<p class="theme__text">
    Для вывода сообщения об ошибке используйте метод error(). Он выводит в консоль текст красного цвета:
</p>
<code>
<pre>
$this->error('Что-то пошло не так!');
</pre>
</code>
<p class="theme__text">
    Для простого вывода текста в консоль без использования специальных цветов используйте метод line():
</p>
<code>
<pre>
$this->line('Вывести это на экран');
</pre>
</code>
<p class="theme__text">
    Вы можете использовать метод newLine для отображения пустой строки:
</p>
<code>
<pre>
$this->newLine();

// Write three blank lines...
$this->newLine(3);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Табличный вывод
</h4>
<p class="theme__text">
    Метод table() позволяет легко форматировать несколько строк/столбцов данных. Просто передайте в него заголовки и строки. Ширина и высота будет динамически определена на основе переданных данных:
</p>
<code>
<pre>
$headers = ['Name', 'Email'];

$users = App\User::all(['name', 'email'])->toArray();

$this->table($headers, $users);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Индикаторы процесса
</h4>
<p class="theme__text">
    Для продолжительных задач бывает полезно вывести индикатор процесса. Используя объект вывода мы можем запустить, передвинуть и остановить индикатор. Сначала определите общее число шагов, по которым будет идти процесс. Затем передвигайте индикатор после выполнения каждого шага:
</p>
<code>
<pre>
$users = App\User::all();

$bar = $this->output->createProgressBar(count($users));

foreach ($users as $user) {
  $this->performTask($user);

  $bar->advance();
}

$bar->finish();
</pre>
</code>
<p class="theme__text">
    Более подробная информация указана в документации по индикаторам процесса Symfony.
</p>
<h3 class="theme__subtitle">
    Регистрация команд
</h3>
<p class="theme__text">
    Из-за вызова метода load в методе команд ядра консоли все команды в каталоге app / Console / Commands будут автоматически зарегистрированы в Artisan. Фактически, вы можете делать дополнительные вызовы метода load для сканирования других каталогов на предмет команд Artisan:
</p>
<code>
<pre>
/**
 * Register the commands for the application.
 *
 * @return void
 */
protected function commands()
{
    $this->load(__DIR__.'/Commands');
    $this->load(__DIR__.'/MoreCommands');

    // ...
}
</pre>
</code>
<p class="theme__text">
    Вы также можете вручную зарегистрировать команды, добавив его имя класса в свойство $ commands вашего файла app / Console / Kernel.php. Чтобы зарегистрировать свою команду, просто добавьте имя класса команды в этот список. Когда Artisan загружается, все перечисленные в этом свойстве команды будут включены в сервис-контейнер и зарегистрированы в Artisan:
</p>
<code>
<pre>
protected $commands = [
    Commands\SendEmails::class
];
</pre>
</code>
<h3 class="theme__subtitle">
    Программное выполнение команд
</h3>
<p class="theme__text">
    Иногда необходимо выполнить команду извне командной строки. Например, когда вы хотите запустить команду из маршрута или контроллера. Для этого можно использовать метод call() фасада Artisan. Этот метод принимает первым аргументом имя команды, а вторым — массив аргументов команды. Будет возвращён код выхода:
</p>
<code>
<pre>
Route::get('/foo', function () {
    $exitCode = Artisan::call('email:send', [
        'user' => 1, '--queue' => 'default'
    ]);

    //
});
</pre>
</code>
<p class="theme__text">
    В качестве альтернативы вы можете передать всю команду Artisan методу call в виде строки:
</p>
<code>
<pre>
Artisan::call('email:send 1 --queue=default');
</pre>
</code>
<p class="theme__text">
    С помощью метода queue() можно даже поставить команды в очередь, тогда они будут обработаны в фоне с помощью ваших обработчиков очереди. Прежде чем использовать этот метод, убедитесь в том, что вы настроили вашу очередь, и что слушатель очереди запущен:
</p>
<code>
<pre>
Route::get('/foo', function () {
    Artisan::queue('email:send', [
        'user' => 1, '--queue' => 'default'
    ]);

    //
});
</pre>
</code>
<p class="theme__text">
    Вы также можете указать соединение или очередь, в которую должна быть отправлена команда Artisan:
</p>
<code>
<pre>
Artisan::queue('email:send', [
    'user' => 1, '--queue' => 'default'
])->onConnection('redis')->onQueue('commands');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Передача значений массива
</h4>
<p class="theme__text">
    Если ваша команда определяет параметр, который принимает массив, вы можете передать в этот параметр массив значений:
</p>
<code>
<pre>
Route::get('/foo', function () {
    $exitCode = Artisan::call('email:send', [
        'user' => 1, '--id' => [5, 13]
    ]);
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Передача логических значений
</h4>
<p class="theme__text">
    Когда нужно указать значение ключа, который не принимает строковое значение, например, флаг --force команды migrate:refresh, вы можете передать значение true или false:
</p>
<code>
<pre>
$exitCode = Artisan::call('migrate:refresh', [
    '--force' => true,
]);
</pre>
</code>
<h3 class="theme__subtitle">
    Вызов команд из других команд
</h3>
<p class="theme__text">
    Иногда необходимо вызвать другую команду из своей. Для этого используйте метод call(). Он принимает имя команды и массив её аргументов:
</p>
<code>
<pre>
/**
 * Выполнение консольной команды.
 *
 * @return mixed
 */
public function handle()
{
  $this->call('email:send', [
    'user' => 1, '--queue' => 'default'
  ]);

  //
}
</pre>
</code>
<p class="theme__text">
    Если вы хотите вызвать другую команду и запретить её вывод в консоль, используйте метод callSilent(). Этот метод принимает те же аргументы, что и метод call():
</p>
<code>
<pre>
$this->callSilent('email:send', [
  'user' => 1, '--queue' => 'default'
]);
</pre>
</code>
<h3 class="theme__subtitle">
    Настройка заглушки
</h3>
<p class="theme__text">
    Команды make консоли Artisan используются для создания различных классов, таких как контроллеры, задания, миграции и тесты. Эти классы создаются с использованием файлов-заглушек, которые заполняются значениями на основе ваших входных данных. Однако иногда вы можете захотеть внести небольшие изменения в файлы, созданные Artisan. Для этого вы можете использовать команду stub: publish для публикации наиболее распространенных заглушек для настройки:
</p>
<code>
<pre>
php artisan stub:publish
</pre>
</code>
<p class="theme__text">
    Опубликованные заглушки будут расположены в каталоге заглушек в корне вашего приложения. Любые изменения, внесенные вами в эти заглушки, будут отражены при создании соответствующих классов с помощью команд Artisan make.
</p>
<h3 class="theme__subtitle">
    События
</h3>
<p class="theme__text">
    Artisan отправляет три события при выполнении команд: <br>
    Illuminate\Console\Events\ArtisanStarting, <br>
    Illuminate\Console\Events\CommandStarting, <br>
    Illuminate\Console\Events\CommandFinished. <br>
    Событие ArtisanStarting отправляется сразу после запуска Artisan. Затем событие CommandStarting отправляется непосредственно перед запуском команды. Наконец, событие CommandFinished отправляется после завершения выполнения команды.
</p>
<code>
<pre>
</pre>
</code>
    </div>
    <div class="theme">
<h2 class="theme__title">
    Вещание событий
</h2>
<p class="theme__text">
    Во многих современных веб-приложениях для реализации обновляющегося на лету пользовательского интерфейса, работающего в режиме реального времени, используются WebSockets. Когда какая-либо информация изменяется на сервере, обычно посылается сообщение через WebSocket-подключение для обработки на клиенте. Это обеспечивает более надёжную и эффективную альтернативу постоянному опросу вашего приложения о наличии изменений.
    <br><br>
    Для помощи в создании таких приложений Laravel обеспечивает простую настройку «вещания» ваших событий через WebSocket-подключение. Вещание ваших Laravel-событий позволяет использовать одинаковые названия событий в коде на стороне клиента и в клиентском JavaScript-приложении.
    <br><br>
    Перед погружением в вещание событий не забудьте ознакомиться с документацией по событиям и слушателям.
</p>
<h3 class="theme__subtitle">
    Настройка
</h3>
<p class="theme__text">
    Все настройки вещания событий вашего приложения хранятся в файле config/broadcasting.php. Laravel изначально поддерживает несколько драйверов вещания: Pusher, Redis и драйвер log для локальной разработки и отладки. Вдобавок, есть драйвер null, позволяющий полностью отключить вещание. Для каждого из них есть пример настройки в файле config/broadcasting.php.
</p>
<h4 class="theme_subtitlex2">
    Сервис-провайдер вещания
</h4>
<p class="theme__text">
    Перед вещанием событий вам сначала надо зарегистрировать App\Providers\BroadcastServiceProvider. В свежем Laravel-приложении вам достаточно раскомментировать этот провайдер в массиве providers в файле config/app.php. Этот провайдер позволит вам зарегистрировать маршруты и обратные вызовы авторизации вещания.
</p>
<h4 class="theme_subtitlex2">
    CSRF-токен
</h4>
<p class="theme__text">
    Для Laravel Echo будет необходим доступ к CSRF-токену текущей сессии. Echo получит токен из JavaScript-объекта Laravel.csrfToken, если он доступен. Этот объект определён в макете resources/views/layouts/app.blade.php, который создаётся при выполнении Artisan-команды make:auth. Если вы не используете этот шаблон, вы можете определить тег meta в HTML-элементе head вашего приложения:
</p>
<code>
<pre>
< meta name="csrf-token" content="@{{ csrf_token() }}">
</pre>
</code>
<h3 class="theme__subtitle">
    Требования драйверов
</h3>
<h4 class="theme_subtitlex2">
    Pusher
</h4>
<p class="theme__text">
    Если вы вещаете события через Pusher, вам надо установить Pusher PHP SDK через менеджер пакетов Composer:
</p>
<code>
<pre>
composer require pusher/pusher-php-server
</pre>
</code>
<p class="theme__text">
    Затем вам надо настроить ваши учётные данные Pusher в файле config/broadcasting.php. В этом файле есть пример настройки Pusher, поэтому вы можете быстро указать свой ключ Pusher, секрет и ID приложения. Настройка pusher в файле config/broadcasting.php также позволяет вам указать дополнительные options, поддерживаемые Pusher, такие как кластер:
</p>
<code>
<pre>
'options' => [
  'cluster' => 'eu',
  'encrypted' => true
],
</pre>
</code>
<p class="theme__text">
    При использовании Pusher и Laravel Echo вам надо указать pusher в качестве желаемого вещателя при создании экземпляра Echo в вашем файле resources/assets/js/bootstrap.js:
</p>
<code>
<pre>
jsimport Echo from "laravel-echo"

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: 'your-pusher-key'
});
</pre>
</code>
<p class="theme__text">
    Наконец, вам нужно будет изменить драйвер вещания на pusher в файле .env:
</p>
<code>
<pre>
BROADCAST_DRIVER=pusher
</pre>
</code>
<h4 class="theme_subtitlex2">
    Веб-сокеты Laravel, совместимые с Pusher
</h4>
<p class="theme__text">
    Laravel-websockets - это чистый PHP, совместимый с Pusher пакет веб-сокетов для Laravel. Этот пакет позволяет вам использовать всю мощь вещания Laravel без внешнего провайдера веб-сокетов или Node. Для получения дополнительной информации об установке и использовании этого пакета обратитесь к его официальной документации.
</p>
<h4 class="theme_subtitlex2">
    Redis
</h4>
<p class="theme__text">
    Если вы используете вещатель Redis, вам надо установить библиотеку Predis:
</p>
<code>
<pre>
composer require predis/predis
</pre>
</code>
<p class="theme__text">
    Затем вы должны обновить драйвер вещания до Redis в файле .env:
</p>
<code>
<pre>
BROADCAST_DRIVER=redis
</pre>
</code>
<p class="theme__text">
    Вещатель Redis будет вещать сообщения с помощью функции Redis издатель-подписчик, но вам надо дополнить его WebSocket-сервером, который сможет получать сообщения от Redis и вещать их в ваши WebSocket-каналы.
    <br><br>
    Когда вещатель Redis публикует событие, оно публикуется на имена каналов в зависимости от события, а его содержимое — закодированная JSON-строка с именем события, данными data и пользователем, который сгенерировал ID сокета события (при наличии).
</p>
<h4 class="theme_subtitlex2">
    Socket.IO
</h4>
<p class="theme__text">
    Если вы собираетесь соединить вещательную станцию Redis с сервером Socket.IO, вам нужно будет включить клиентскую библиотеку Socket.IO JavaScript в свое приложение. Вы можете установить его через менеджер пакетов NPM:
</p>
<code>
<pre>
npm install --save-dev socket.io-client@2
</pre>
</code>
<p class="theme__text">
    Затем вам нужно будет создать экземпляр Echo с коннектором socket.io и host.
</p>
<code>
<pre>
import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});
</pre>
</code>
<p class="theme__text">
    Наконец, вам нужно будет запустить совместимый сервер Socket.IO. Laravel не включает реализацию сервера Socket.IO; однако управляемый сообществом сервер Socket.IO в настоящее время поддерживается в репозитории tlaverdure / laravel-echo-server на GitHub.
</p>
<h4 class="theme_subtitlex2">
    Требования очереди
</h4>
<p class="theme__text">
    Перед вещанием событий вам также необходимо настроить и запустить слушатель очереди. Всё вещание событий происходит через задачи очереди, поэтому оно незначительно влияет на время отклика вашего приложения.
</p>
<h3 class="theme__subtitle">
    Обзор концепции
</h3>
<p class="theme__text">
    Вещание событий Laravel позволяет вам вещать ваши Laravel-события со стороны сервера вашему клиентскому JavaScript-приложению используя подход к WebSockets на основе драйверов. Сейчас Laravel поставляется с драйверами Pusher и Redis. События можно легко получать на стороне клиента, используя JavaScript-пакет Laravel Echo.
    <br><br>
    События вещаются на «каналы», которые могут быть публичными или приватными. Любой посетитель вашего приложения может подписаться на публичный канал без какой-либо аутентификации и авторизации, но чтобы подписаться на приватный канал, пользователь должен быть аутентифицирован и авторизован на прослушивание этого канала.
    <br><br>
    Если вы хотите использовать PHP-альтернативу Pusher с открытым исходным кодом, ознакомьтесь с пакетом laravel-websockets.
</p>
<h4 class="theme_subtitlex2">
    Использование примера приложения
</h4>
<p class="theme__text">
    Перед погружением во все компоненты вещания событий давайте сделаем поверхностный осмотр интернет-магазина в качестве примера. Мы пока не будем обсуждать детали настройки Pusher и Laravel Echo, поскольку они будут рассмотрены в других разделах этой статьи.
    <br><br>
    Предположим, в нашем приложении есть страница, позволяющая пользователям просматривать статус доставки их заказов. И предположим, что при обработке приложением обновления статуса доставки возникает событие ShippingStatusUpdated:
</p>
<code>
<pre>
event(new ShippingStatusUpdated($update));
</pre>
</code>
<h4 class="theme_subtitlex2"></h4>
<p class="theme__text"></p>
<code>
<pre>
</pre>
</code>
<h4 class="theme_subtitlex2">
    Интерфейс ShouldBroadcast
</h4>
<p class="theme__text">
    Когда пользователь просматривает один из своих заказов, надо показывать ему обновления статуса, не требуя обновлять страницу. Вместо этого будем вещать обновления в приложение по мере их создания. Итак, нам надо отметить событие ShippingStatusUpdated интерфейсом ShouldBroadcast. Таким образом Laravel поймёт, что надо вещать это событие при его возникновении:
</p>
<code>
<pre>
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ShippingStatusUpdated implements ShouldBroadcast
{
    /**
     * Information about the shipping status update.
     *
     * @var string
     */
    public $update;
}
</pre>
</code>
<p class="theme__text">
    Интерфейс ShouldBroadcast требует, чтобы в событии был определён метод broadcastOn(). Этот метод отвечает за возврат каналов, на которые надо вещать событие. В генерируемых классах событий уже определена пустая заготовка этого метода, нам остаётся только заполнить её. Нам надо, чтобы у создателя заказа была возможность просмотреть обновления статуса, поэтому мы будем вещать событие на приватный канал, привязанный к заказу:
</p>
<code>
<pre>
/**
 * Получить каналы, на которые надо вещать событие.
 *
 * @return array
 */
public function broadcastOn()
{
  return new PrivateChannel('order.'.$this->update->order_id);
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Авторизация каналов
</h4>
<p class="theme__text">
    Запомните, пользователи должны быть авторизованы для прослушивания приватных каналов. Мы можем определить наши правила авторизации каналов в файле routes / channels.php В данном примере нам надо проверить, что пользователь, пытающийся слушать приватный канал order.1, является создателем заказа:
</p>
<code>
<pre>
Broadcast::channel('order.{orderId}', function ($user, $orderId) {
    return $user->id === Order::findOrNew($orderId)->user_id;
});
</pre>
</code>
<p class="theme__text">
    Метод channel() принимает два аргумента: название канала и функцию обратного вызова, которая возвращает true или false, в зависимости от того, авторизован пользователь слушать канал или нет.
    <br>
    Все авторизационные функции обратного вызова получают первым аргументом текущего аутентифицированного пользователя, а последующими аргументами — все дополнительные подстановочные параметры. В данном примере мы используем символ {orderId} для указания, что часть ID в имени канала является подстановочной.
</p>
<h4 class="theme_subtitlex2">
    Прослушивание вещания событий
</h4>
<p class="theme__text">
    Затем, всё что нам остаётся — это слушать события в нашем JavaScript-приложении. Это можно делать с помощью Laravel Echo. Сначала мы используем метод private(), чтобы подписаться на приватный канал. Затем мы можем использовать метод listen(), чтобы слушать событие ShippingStatusUpdated. По умолчанию все общедоступные (public) свойства события будут включены в вещание события:
</p>
<code>
<pre>
Echo.private(`order.${orderId}`)
  .listen('ShippingStatusUpdated', (e) => {
    console.log(e.update);
});
</pre>
</code>
<h3 class="theme__subtitle">
    Определение событий для вещания
</h3>
<p class="theme__text">
    Чтобы сообщить Laravel, что данное событие должно вещаться, реализуйте интерфейс Illuminate\Contracts\Broadcasting\ShouldBroadcast на классе события. Этот интерфейс уже импортирован во все классы событий, генерируемые фреймворком, поэтому вы легко можете добавить его в любое ваше событие.
    <br><br>
    Интерфейс ShouldBroadcast требует от вас реализовать единственный метод broadcastOn(). Этот метод должен возвращать канал или массив каналов, на которые должно вещаться событие. Каналы должны быть экземплярами Channel, PrivateChannel или PresenceChannel. Экземпляры Channel представляют публичные каналы, на которые может подписаться любой пользователь, а PrivateChannel и PresenceChannel представляют приватные каналы, которые требуют авторизации каналов:
</p>
<code>
<pre>
    namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ServerCreated implements ShouldBroadcast
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->user->id);
    }
}
</pre>
</code>
<p class="theme__text">
    Затем вам надо только создать событие как обычно. После этого задача в очереди автоматически проведёт вещание события через ваши драйверы вещания.
</p>
<h4 class="theme_subtitlex2">
    Название вещания
</h4>
<p class="theme__text">
    По умолчанию Laravel вещает событие, используя имя класса события. Но вы можете изменить название вещания, определив метод broadcastAs() на событии:
</p>
<code>
<pre>
/**
 * Название вещания события.
 *
 * @return string
 */
public function broadcastAs()
{
  return 'server.created';
}
</pre>
</code>
<p class="theme__text">
    Если вы настраиваете имя трансляции с помощью метода broadcastAs, вы должны обязательно зарегистрировать слушателя с ведущим. персонаж. Это проинструктирует Echo не добавлять пространство имен приложения к событию:
</p>
<code>
<pre>
.listen('.server.created', function (e) {
    ....
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Данные вещания
</h4>
<p class="theme__text">
    При вещании события все его public свойства автоматически сериализуются и вещаются в качестве содержимого события, позволяя вам обращаться к любым общедоступным данным события из вашего JavaScript-приложения. Так например, если у вашего события есть единственное общедоступное свойство $user, которое содержит модель Eloquent, при вещании содержимым события будет:
</p>
<code>
<pre>
{
    "user": {
        "id": 1,
        "name": "Patrick Stewart"
        ...
    }
}
</pre>
</code>
<p class="theme__text">
    Но если вы хотите иметь более точный контроль над содержимым вещания, вы можете добавить метод broadcastWith() в ваше событие. Этот метод должен возвращать массив данных, которые вы хотите вещать в качестве содержимого события:
</p>
<code>
<pre>
/**
* Получить данные для вещания.
*
* @return array
*/
public function broadcastWith()
{
    return ['id' => $this->user->id];
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Очередь вещания
</h4>
<p class="theme__text">
    По умолчанию каждое событие для вещания помещается в очередь по умолчанию на подключении по умолчанию, указанном в вашем файле настроек queue.php. Вы можете изменить используемую вещателем очередь, определив свойство broadcastQueue в классе вашего события. Это свойство должно указывать название очереди для вещания:
</p>
<code>
<pre>
/**
 * Название очереди для размещения события.
 *
 * @var string
 */
public $broadcastQueue = 'your-queue-name';
</pre>
</code>
<p class="theme__text">
    Если вы хотите транслировать свое событие с использованием sync очереди  вместо драйвера очереди по умолчанию, вы можете реализовать интерфейс ShouldBroadcastNow вместо ShouldBroadcast:
</p>
<code>
<pre>
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class ShippingStatusUpdated implements ShouldBroadcastNow
{
    //
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Условия трансляции
</h4>
<p class="theme__text">
    Иногда вы хотите транслировать свое мероприятие только в том случае, если выполняется определенное условие. Вы можете определить эти условия, добавив метод broadcastWhen в свой класс события:
</p>
<code>
<pre>
/**
 * Determine if this event should broadcast.
 *
 * @return bool
 */
public function broadcastWhen()
{
    return $this->value > 100;
}
</pre>
</code>
<h3 class="theme__subtitle">
    Авторизация каналов
</h3>
<p class="theme__text">
    Приватные каналы требуют авторизации того, что текущий аутентифицированный пользователь действительно может слушать канал. Это достигается HTTP-запросом в ваше Laravel-приложение с названием канала, а приложение должно определить, может ли пользователь слушать этот канал. При использовании Laravel Echo HTTP-запрос для авторизации подписки на приватные каналы делается автоматически, но вам надо определить необходимые маршруты, чтобы отвечать на эти запросы.
</p>
<h4 class="theme_subtitlex2">
    Определение маршрутов авторизации
</h4>
<p class="theme__text">
    К счастью, Laravel позволяет легко определить маршруты для ответа на запросы авторизации каналов. В BroadcastServiceProvider, включённом в ваше Laravel-приложение, вы увидите вызов метода Broadcast::routes(). Этот метод зарегистрирует маршрут /broadcasting/auth для обработки запросов авторизации:
</p>
<code>
<pre>
Broadcast::routes();
</pre>
</code>
<p class="theme__text">
    Метод Broadcast::routes() автоматически поместит свои маршруты в группу посредников web, но вы можете передать в метод массив атрибутов маршрута, если хотите изменить назначенные атрибуты:
</p>
<code>
<pre>
Broadcast::routes($attributes);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Настройка конечной точки авторизации
</h4>
<p class="theme__text">
    По умолчанию Echo будет использовать конечную точку / broadcasting / auth для авторизации доступа к каналу. Однако вы можете указать собственную конечную точку авторизации, передав параметр конфигурации authEndpoint вашему экземпляру Echo:
</p>
<code>
<pre>
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'your-pusher-channels-key',
    authEndpoint: '/custom/endpoint/auth'
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Определение функций обратного вызова для авторизации
</h4>
<p class="theme__text">
    Далее нам нужно определить логику, которая фактически будет выполнять авторизацию канала. Это делается в файле routes / channels.php, который включен в ваше приложение. В этом файле вы можете использовать метод Broadcast :: channel для регистрации обратных вызовов авторизации канала:
</p>
<code>
<pre>
Broadcast::channel('order.{orderId}', function ($user, $orderId) {
    return $user->id === Order::findOrNew($orderId)->user_id;
});
</pre>
</code>
<p class="theme__text">
    Метод channel() принимает два аргумента: название канала и функцию обратного вызова, которая возвращает true или false, в зависимости о того, авторизован пользователь на прослушивание канала или нет.
    <br><br>
    Все авторизационные функции обратного вызова получают первым аргументом текущего аутентифицированного пользователя, а последующими аргументами — все дополнительные подстановочные параметры. В данном примере мы используем {orderId} для указания, что часть ID в имени канала является подстановочной.
</p>
<h4 class="theme_subtitlex2">
    Привязка модели обратного вызова авторизации
</h4>
<p class="theme__text">
    Как и маршруты HTTP, маршруты каналов могут также использовать преимущества неявной и явной привязки модели маршрута. Например, вместо получения строкового или числового идентификатора заказа вы можете запросить фактический экземпляр модели Order:
</p>
<code>
<pre>
use App\Models\Order;

Broadcast::channel('order.{order}', function ($user, Order $order) {
    return $user->id === $order->user_id;
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Авторизация Callback Authentication
</h4>
<p class="theme__text">
    Частные каналы и широковещательные каналы присутствия аутентифицируют текущего пользователя через стандартную защиту аутентификации вашего приложения. Если пользователь не аутентифицирован, авторизация канала автоматически отклоняется, и обратный вызов авторизации никогда не выполняется. Однако вы можете назначить несколько настраиваемых средств защиты, которые должны при необходимости аутентифицировать входящий запрос:
</p>
<code>
<pre>
Broadcast::channel('channel', function () {
    // ...
}, ['guards' => ['web', 'admin']]);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Определение классов каналов
</h4>
<p class="theme__text">
    Если ваше приложение использует много разных каналов, ваш файл routes / channels.php может стать громоздким. Таким образом, вместо использования замыканий для авторизации каналов вы можете использовать классы каналов. Чтобы сгенерировать класс канала, используйте Artisan-команду make: channel. Эта команда поместит новый класс канала в каталог App / Broadcasting.
</p>
<code>
<pre>
php artisan make:channel OrderChannel
</pre>
</code>
<p class="theme__text">
    Затем зарегистрируйте свой канал в файле routes / channels.php:
</p>
<code>
<pre>
use App\Broadcasting\OrderChannel;

Broadcast::channel('order.{order}', OrderChannel::class);
</pre>
</code>
<p class="theme__text">
    Наконец, вы можете поместить логику авторизации для вашего канала в метод join класса канала. Этот метод join будет содержать ту же логику, которую вы обычно использовали бы при закрытии авторизации канала. Вы также можете воспользоваться преимуществами привязки модели канала:
</p>
<code>
<pre>
namespace App\Broadcasting;

use App\Models\Order;
use App\Models\User;

class OrderChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return array|bool
     */
    public function join(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }
}
</pre>
</code>
<p class="theme__text">
    Как и многие другие классы в Laravel, классы каналов автоматически разрешаются контейнером службы. Итак, вы можете указать любые зависимости, требуемые для вашего канала, в его конструкторе.
</p>
<h3 class="theme__subtitle">
    Вещание событий
</h3>
<p class="theme__text">
    Когда вы определили событие и отметили его интерфейсом ShouldBroadcast, вам остаётся только создать событие функцией event(). Диспетчер события обнаружит, что оно отмечено интерфейсом ShouldBroadcast, и поместит его в очередь для вещания:
</p>
<code>
<pre>
event(new ShippingStatusUpdated($update));
</pre>
</code>
<h4 class="theme_subtitlex2">
    Только другим
</h4>
<p class="theme__text">
    При создании приложения с использованием вещания событий вы можете заменить функцию event() функцией broadcast(). Как и функция event(), функция broadcast() отправляет событие вашим слушателям на стороне сервера:
</p>
<code>
<pre>
broadcast(new ShippingStatusUpdated($update));
</pre>
</code>
<p class="theme__text">
    Но функция broadcast() также предоставляет метод toOthers(), который позволяет вам исключить текущего пользователя из списка получателей вещания:
</p>
<code>
<pre>
broadcast(new ShippingStatusUpdated($update))->toOthers();
</pre>
</code>
<p class="theme__text">
    Для лучшего понимания того, когда вам может пригодиться метод toOthers(), давайте представим приложение со списком задач, в котором пользователь может создать новую задачу, указав её имя. Чтобы создать задачу, ваше приложение должно сделать запрос к конечной точке /task, которая произведёт вещание создания задачи и вернёт JSON-представление новой задачи. Когда ваше JavaScript-приложение получит отклик от конечной точки, оно сможет вставить новую задачу прямо в список задач:
</p>
<code>
<pre>
axios.post('/task', task)
    .then((response) => {
        this.tasks.push(response.data);
});
</pre>
</code>
<p class="theme__text">
    Но помните, что мы также вещаем создание события. Если ваше JavaScript-приложение слушает это событие, чтобы добавить задачу в список задач, мы получим дублирование задачи в списке: одна из конечной точки, а другая из вещания.
    <br>
    Этого можно избежать с помощью метода toOthers(), который укажет вещателю, что событие не надо вещать текущему пользователю.
    <br><br>
    Ваше событие должно использовать trait Illuminate \ Broadcasting \ InteractsWithSockets для вызова метода toOthers.
</p>
<h4 class="theme_subtitlex2">
    Настройка
</h4>
<p class="theme__text">
    Когда вы инициализируете экземпляр Laravel Echo, на подключение назначается ID сокета. Если вы используете Vue и Axios,, ID сокета будет автоматически прикреплён к каждому исходящему запросу в виде заголовка X-Socket-ID. Затем, когда вы вызываете метод toOthers(), Laravel извлечёт ID сокета из заголовка и даст вещателю команду — не вещать на любые подключения с этим ID сокета.
    <br>
    Если вы не используете Vue и Axios, вам надо вручную настроить ваше JavaScript-приложение, чтобы оно посылало заголовок X-Socket-ID. Вы можете получить ID сокета методом Echo.socketId():
</p>
<code>
<pre>
var socketId = Echo.socketId();
</pre>
</code>
<h3 class="theme__subtitle">
    Получение вещания
</h3>
<h4 class="theme_subtitlex2">
    Установка Laravel Echo
</h4>
<p class="theme__text">
    Laravel Echo — JavaScript-библиотека, которая позволяет без труда подписываться на каналы и слушать вещание событий Laravel. Вы можете установить Echo через менеджер пакетов NPM. В данном примере мы также установим пакет pusher-js, поскольку будем использовать вещатель Pusher:
</p>
<code>
<pre>
npm install --save laravel-echo pusher-js
</pre>
</code>
<p class="theme__text">
    После установки Echo вы можете создать свежий экземпляр Echo в JavaScript своего приложения. Отличное место для этого — конец файла resources/assets/js/bootstrap.js, который включён в фреймворк Laravel:
</p>
<code>
<pre>
import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'your-pusher-channels-key'
});
</pre>
</code>
<p class="theme__text">
    При создании экземпляра Echo, который использует соединитель pusher, вы также можете указать cluster, а также указать, должно ли соединение выполняться через TLS (по умолчанию, когда forceTLS имеет значение false, соединение без TLS будет выполнено, если страница была загружена через HTTP или в качестве запасного варианта, если соединение TLS не удается):
</p>
<code>
<pre>
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'your-pusher-channels-key',
    cluster: 'eu',
    forceTLS: true
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Использование существующего экземпляра клиента
</h4>
<p class="theme__text">
    Если у вас уже есть клиентский экземпляр Pusher Channels или Socket.io, который вы хотели бы использовать в Echo, вы можете передать его Echo с помощью параметра конфигурации client:
</p>
<code>
<pre>
const client = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'your-pusher-channels-key',
    client: client
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Прослушивание событий
</h4>
<p class="theme__text">
    Когда вы установили и создали экземпляр Echo, вы можете начать слушать вещание событий. Сначала используйте метод channel() для получения экземпляра канала, а затем вызовите метод listen() для прослушивания указанного события:
</p>
<code>
<pre>
Echo.channel('orders')
  .listen('OrderShipped', (e) => {
    console.log(e.order.name);
  });
</pre>
</code>
<p class="theme__text">
    Если вы хотите слушать события на приватном канале, тогда используйте метод private(). Вы можете продолжить прицеплять вызовы метода listen(), чтобы слушать несколько событий на одном канале:
</p>
<code>
<pre>
Echo.private('orders')
  .listen(...)
  .listen(...)
  .listen(...);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Выход из канала
</h4>
<p class="theme__text">
    Чтобы покинуть канал, вы можете вызвать метод leaveChannel в своем экземпляре Echo:
</p>
<code>
<pre>
Echo.leaveChannel('orders');
</pre>
</code>
<p class="theme__text">
    Если вы хотите покинуть канал, а также связанные с ним частные каналы и каналы присутствия, вы можете вызвать метод leave:
</p>
<code>
<pre>
Echo.leave('orders');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Пространства имён
</h4>
<p class="theme__text">
    В этих примерах вы могли заметить, что мы не указываем полное пространство имён для классов событий. Это потому, что Echo автоматически считает, что события расположены в пространстве имён App\Events. Но вы может настроить корневое пространство имён при создании экземпляра Echo, передав параметр namespace:
</p>
<code>
<pre>
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'your-pusher-channels-key',
    namespace: 'App.Other.Namespace'
});
</pre>
</code>
<p class="theme__text">
    В качестве альтернативы вы можете добавлять к классам событий префикс ., когда подписываетесь на них с помощью Echo. Это позволит вам всегда указывать полное имя класса:
</p>
<code>
<pre>
Echo.channel('orders')
.listen('.Namespace\\Event\\Class', (e) => {
    //
});
</pre>
</code>
<h3 class="theme__subtitle">
    Каналы присутствия
</h3>
<p class="theme__text">
    Каналы присутствия построены на безопасности приватных каналов, при этом они предоставляют дополнительные возможности по осведомлённости о тех, кто подписан на канал. Это позволяет легко создавать мощные функции приложения для совместной работы, такие как уведомление пользователей, когда другой пользователь просматривает ту же страницу.
</p>
<h4 class="theme_subtitlex2">
    Авторизация каналов присутствия
</h4>
<p class="theme__text">
    Все каналы присутствия также являются приватными каналами, поэтому пользователи должны быть авторизованы для доступа к ним. Но при определении функций обратного вызова для каналов присутствия вам не надо возвращать true, если пользователь авторизован на подключение к каналу. Вместо этого вы должны вернуть массив данных о пользователе.
    <br>
    Данные, возвращённые функцией обратного вызова для авторизации, станут доступны для слушателей событий канала присутствия в вашем JavaScript-приложении. Если пользователь не авторизован на подключение к каналу, вы должны вернуть false или null:
</p>
<code>
<pre>
Broadcast::channel('chat.{roomId}', function ($user, $roomId) {
    if ($user->canJoinRoom($roomId)) {
        return ['id' => $user->id, 'name' => $user->name];
    }
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Подключение к каналам присутствия
</h4>
<p class="theme__text">
    Для подключения к каналу присутствия вы можете использовать метод Echo join(). Метод join() вернёт реализацию PresenceChannel, которая помимо предоставления метода listen() позволит вам подписаться на события here, joining и leaving.
</p>
<code>
<pre>
Echo.join(`chat.${roomId}`)
  .here((users) => {
    //
  })
  .joining((user) => {
    console.log(user.name);
  })
  .leaving((user) => {
    console.log(user.name);
  });
</pre>
</code>
<p class="theme__text">
    Обратный вызов here() будет выполнен немедленно после успешного подключения к каналу и получит массив с информацией о пользователе для всех остальных пользователей, подключенных к каналу в данный момент. Метод joining() будет выполнен, когда новый пользователь подключится к каналу, а метод leaving() будет выполнен, когда пользователь покинет канал.
</p>
<h4 class="theme_subtitlex2">Вещание в канал присутствия</h4>
<p class="theme__text">
    Канал присутствия может получать события так же, как публичный и приватный каналы. Используя пример с чатом, нам может понадобиться вещание событий NewMessage в канал присутствия чата. Для этого мы будем возвращать экземпляр PresenceChannel из метода события broadcastOn():
</p>
<code>
<pre>
/**
 * Получить каналы, на которые необходимо вещать событие.
 *
 * @return Channel|array
 */
public function broadcastOn()
{
  return new PresenceChannel('room.'.$this->message->room_id);
}
</pre>
</code>
<p class="theme__text">
    Подобно публичным и приватным событиям, события канала присутствия можно вещать с помощью функции broadcast(). Как и с другими событиями вы можете использовать метод toOthers(), чтобы исключить текущего пользователя из списка получателей вещания:
</p>
<code>
<pre>
broadcast(new NewMessage($message));

broadcast(new NewMessage($message))->toOthers();
</pre>
</code>
<p class="theme__text">
    Вы можете слушать событие подключения методом Echo listen():
</p>
<code>
<pre>
Echo.join(`chat.${roomId}`)
  .here(...)
  .joining(...)
  .leaving(...)
  .listen('NewMessage', (e) => {
    //
  });
</pre>
</code>
<h3 class="theme__subtitle">
    Клиентские события
</h3>
<p class="theme__text">
    При использовании каналов толкателя необходимо включить параметр «События клиента» в разделе «Настройки приложения» на панели инструментов приложения, чтобы отправлять события клиента.
    <br>
    Иногда вы можете захотеть транслировать событие другим подключенным клиентам, вообще не затрагивая ваше приложение Laravel. Это может быть особенно полезно для таких вещей, как «ввод» уведомлений, когда вы хотите предупредить пользователей вашего приложения о том, что другой пользователь печатает сообщение на заданном экране.
    <br>
    Для трансляции клиентских событий вы можете использовать Echo's  метод whisper :
</p>
<code>
<pre>
Echo.private('chat')
    .whisper('typing', {
        name: this.user.name
    });
</pre>
</code>
<p class="theme__text">
    Чтобы прослушивать клиентские события, вы можете использовать метод listenForWhisper:
</p>
<code>
<pre>
Echo.private('chat')
.listenForWhisper('typing', (e) => {
    console.log(e.name);
});
</pre>
</code>
<h3 class="theme__subtitle">
  Уведомления
</h3>
<p class="theme__text">
    Дополнив вещание событий уведомлениями, вы позволите вашему JavaScript-приложению получать новые уведомления при их возникновении без необходимости обновлять страницу. Сначала прочитайте документацию по использованию канала вещания уведомлений.
    <br>
    Когда вы настроите уведомления на использование канала вещания, вы сможете слушать события вещания с помощью метода Echo notification(). Запомните, название канала должно совпадать с именем класса той сущности, которая получает уведомления:
</p>
<code>
<pre>
Echo.private(`App.Models.User.${userId}`)
    .notification((notification) => {
        console.log(notification.type);
    });
</pre>
</code>
<p class="theme__text">
    В этом примере все уведомления, посылаемые экземплярам App\User через канал broadcast, будут получены функцией обратного вызова. Функция обратного вызова для авторизации канала App.Models.User.{id} включена в стандартный BroadcastServiceProvider, который поставляется с фреймворком Laravel.
</p>
    </div>
    <div class="theme">
<h2 class="theme__title">
    Кеш
</h2>
<h3 class="theme__subtitle">
    Настройка
</h3>
<p class="theme__text">
    Laravel предоставляет выразительный, универсальный API для различных систем кэширования. Настройки кэша находятся в файле config/cache.php. Здесь вы можете указать драйвер, используемый по умолчанию в вашем приложении. Laravel изначально поддерживает многие популярные системы, такие как  Memcached, Redis, and DynamoDB из коробки.Laravel также поддерживает драйверы APC, Array, Database, File, and null cache driver.
    <br>
    Этот файл также содержит множество других настроек, которые в нём же документированы, поэтому обязательно ознакомьтесь с ними. По умолчанию, Laravel настроен для использования драйвера file, который хранит сериализованные объекты кэша в файловой системе. Для больших приложений рекомендуется использование более надёжных драйверов, таких как Memcached или Redis. Вы можете настроить даже несколько конфигураций кэширования для одного драйвера.
</p>
<h3 class="theme__subtitle">
    Необходимые условия для драйверов
</h3>
<h4 class="theme_subtitlex2">
    База данных
</h4>
<p class="theme__text">
    Перед использованием драйвера database вам нужно создать таблицу для хранения элементов кэша. Ниже приведён пример объявления структуры Schema:
</p>
<code>
<pre>
Schema::create('cache', function ($table) {
    $table->string('key')->unique();
    $table->text('value');
    $table->integer('expiration');
});
</pre>
</code>
<p class="theme__text">
    Также вы можете использовать Artisan-команду php artisan cache:table для генерации миграции с правильной схемой.
</p>
<h4 class="theme_subtitlex2">
    Система Memcached
</h4>
<p class="theme__text">
    Для использования системы кэширования Memcached необходим установленный пакет Memcached PECL. Вы можете перечислить все свои сервера Memcached в файле настроек config/cache.php:
</p>
<code>
<pre>
'memcached' => [
  [
    'host' => '127.0.0.1',
    'port' => 11211,
    'weight' => 100
  ],
],
</pre>
</code>
<p class="theme__text">
    Вы также можете задать параметр host для пути UNIX-сокета. В этом случае в параметр port следует записать значение 0:
</p>
<code>
<pre>
'memcached' => [
  [
    'host' => '/var/run/memcached/memcached.sock',
    'port' => 0,
    'weight' => 100
  ],
],
</pre>
</code>
<h4 class="theme_subtitlex2">
    Система Redis
</h4>
<p class="theme__text">
    Перед тем, как использовать систему Redis необходимо установить пакет predis/predis (~1.0) с помощью Composer. Загляните в раздел по настройке Redis
</p>
<h3 class="theme__subtitle">
    Использование кэша
</h3>
<h4 class="theme_subtitlex2">
    Получение экземпляра кэша
</h4>
<p class="theme__text">
    Контракты Illuminate\Contracts\Cache\Factory и Illuminate\Contracts\Cache\Repository предоставляют доступ к службам кэша Laravel. Контракт Factory предоставляет доступ ко всем драйверам кэша, определённым для вашего приложения. А контракт Repository обычно является реализацией драйвера кэша по умолчанию для вашего приложения, который задан в файле настроек cache.
    <br>
    А также вы можете использовать фасад Cache, который мы будем использовать в данной статье. Фасад Cache обеспечивает удобный и лаконичный способ доступа к лежащим в его основе реализациям контрактов кэша Laravel:
</p>
<code>
<pre>
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * Show a list of all users of the application.
     *
     * @return Response
     */
    public function index()
    {
        $value = Cache::get('key');

        //
    }
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Доступ к нескольким хранилищам кэша
</h4>
<p class="theme__text">
    Используя фасад Cache можно обращаться к разным хранилищам кэша с помощью метода store(). Передаваемый в метод ключ должен соответствовать одному из хранилищ, перечисленных в массиве stores в вашем файле настроек cache:
</p>
<code>
<pre>
$value = Cache::store('file')->get('foo');

Cache::store('redis')->put('bar', 'baz', 600); // 10 Minutes
</pre>
</code>
<h4 class="theme_subtitlex2">
    Получение элементов из кэша
</h4>
<p class="theme__text">
    Для получения элементов из кэша используется метод get() фасада Cache. Если элемента в кэше не существует, будет возвращён null. При желании вы можете указать другое возвращаемое значение, передав его вторым аргументом метода get():
</p>
<code>
<pre>
$value = Cache::get('key');

$value = Cache::get('key', 'default');
</pre>
</code>
<p class="theme__text">
    А также вы можете передать замыкание в качестве значения по умолчанию. Тогда, если элемента не существует, будет возвращён результат замыкания. С помощью замыкания вы можете настроить получение значений по умолчанию из базы данных или внешнего сервиса:
</p>
<code>
<pre>
$value = Cache::get('key', function () {
    return DB::table(...)->get();
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Проверка существования элемента
</h4>
<p class="theme__text">
    Для определения существования элемента в кэше используется метод has(). Он вернёт false, если значение равно null:
</p>
<code>
<pre>
if (Cache::has('key')) {
    //
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Увеличение/уменьшение значений
</h4>
<p class="theme__text">
    Для изменения числовых элементов кэша используются методы increment() и decrement(). Оба они могут принимать второй необязательный аргумент, определяющий значение, на которое нужно изменить значение элемента:
</p>
<code>
<pre>
Cache::increment('key');
Cache::increment('key', $amount);
Cache::decrement('key');
Cache::decrement('key', $amount);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Получить или сохранить
</h4>
<p class="theme__text">
    Иногда необходимо получить элемент из кэша и при этом сохранить значение по умолчанию, если запрашиваемый элемент не существует. Например, когда необходимо получить всех пользователей из кэша, а если они не существуют, получить их из базы данных и добавить в кэш. Это можно сделать с помощью метода Cache::remember():
</p>
<code>
<pre>
$value = Cache::remember('users', $minutes, function () {
    return DB::table('users')->get();
});
</pre>
</code>
<p class="theme__text">
    Если элемента нет в кэше, будет выполнено переданное в метод remember() замыкание, а его результат будет помещён в кэш.
    <br><br>
    Также можно комбинировать методы remember() и forever():
</p>
<code>
<pre>
$value = Cache::rememberForever('users', function() {
    return DB::table('users')->get();
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Получить и удалить
</h4>
<p class="theme__text">
    При необходимости получить элемент и удалить его из кэша используется метод pull(). Как и метод get(), данный метод вернёт null, если элемента не существует:
</p>
<code>
<pre>
$value = Cache::pull('key');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Сохранение элементов в кэш
</h4>
<p class="theme__text">
    Для помещения элементов в кэш используется метод put() фасада Cache. При помещении элемента в кэш необходимо указать, сколько минут его необходимо хранить:
</p>
<code>
<pre>
Cache::put('key', 'value', $seconds);
</pre>
</code>
<p class="theme__text">
    Если время хранения не передается методу put, элемент будет храниться бесконечно:
</p>
<code>
<pre>
Cache::put('key', 'value');
</pre>
</code>
<p class="theme__text">
    Вместо указания количества секунд, можно передать экземпляр PHP-типа DateTime, для указания времени истечения срока хранения:
</p>
<code>
<pre>
Cache::put('key', 'value', now()->addMinutes(10));
</pre>
</code>
<h4 class="theme_subtitlex2">
    Сохранить, если такого нет
</h4>
<p class="theme__text">
    Метод add() просто добавит элемент в кэш, если его там ещё нет. Метод вернёт true, если элемент действительно будет
</p>
<code>
<pre>
Cache::add('key', 'value', $seconds);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Сохранить навсегда
</h4>
<p class="theme__text">
    Для бесконечного хранения элемента кэша используется метод forever(). Поскольку срок хранения таких элементов не истечёт никогда, они должны удаляться из кэша вручную с помощью метода forget():
</p>
<code>
<pre>
Cache::forever('key', 'value');
</pre>
</code>
<p class="theme__text">
    При использовании драйвера Memcached элементы, сохранённые «навсегда», могут быть удалены, когда размер кэша достигнет своего лимита.
</p>
<h4 class="theme_subtitlex2">
    Удаление элементов из кэша
</h4>
<p class="theme__text">
    Можно удалить элементы из кэша с помощью метода forget():
</p>
<code>
<pre>
Cache::forget('key');
</pre>
</code>
<p class="theme__text">
    Вы также можете удалить элементы, указав нулевой или отрицательный TTL:
</p>
<code>
<pre>
Cache::put('key', 'value', 0);

Cache::put('key', 'value', -5);
</pre>
</code>
<p class="theme__text">
    Вы можете очистить весь кэш методом flush():
</p>
<code>
<pre>
Cache::flush();
</pre>
</code>
<p class="theme__text">
    Очистка не поддерживает префикс кэша и удаляет из него все элементы. Учитывайте это при очистке кэша, которым пользуются другие приложения.
</p>
<h4 class="theme_subtitlex2">
    Вспомогательная функция Cache()
</h4>
<p class="theme__text">
    Помимо использования фасада Cache или контракта кэша, вы также можете использовать глобальную функцию cache() для получения данных из кэша и помещения данных в него. При вызове функции cache() с одним строковым аргументом она вернёт значение данного ключа:
</p>
<code>
<pre>
$value = cache('key');
</pre>
</code>
<p class="theme__text">
    Если вы передадите в функцию массив пар ключ/значение и время хранения, она сохранит значения в кэше на указанное время:
</p>
<code>
<pre>
cache(['key' => 'value'], $seconds);

cache(['key' => 'value'], now()->addMinutes(10));
</pre>
</code>
<p class="theme__text">
Когда функция cache вызывается без каких-либо аргументов, она возвращает экземпляр реализации Illuminate \ Contracts \ Cache \ Factory, позволяя вызывать другие методы кэширования:
</p>
<code>
<pre>
cache()->remember('users', $seconds, function () {
    return DB::table('users')->get();
});
</pre>
</code>
<p class="theme__text">
    При тестировании вызова глобальной функции cache() вы можете использовать метод Cache::shouldReceive(), как при тестировании фасада.
</p>
<h2 class="theme__title">
    Теги кэша
</h2>
<p class="theme__text">
    Теги кэша не поддерживаются драйверами file, dynamodb, or database cache drivers. Кроме того, при использовании нескольких тегов для кэшей, хранящихся «вечно», лучшая производительность будет достигнута при использовании такого драйвера как memcached, который автоматически зачищает устаревшие записи.
</p>
<h4 class="theme_subtitlex2">
    Сохранение элементов с тегами
</h4>
<p class="theme__text">
    Теги кэша позволяют отмечать связанные элементы в кэше, и затем сбрасывать все элементы, которые были отмеченны одним тегом. Вы можете обращаться к кэшу с тегами, передавая упорядоченный массив имён тегов. Например, давайте обратимся к кэшу с тегами и поместим в него значение методом put():
</p>
<code>
<pre>
Cache::tags(['people', 'artists'])->put('John', $john, $seconds);

Cache::tags(['people', 'authors'])->put('Anne', $anne, $seconds);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Обращение к элементам кэша с тегами
</h4>
<p class="theme__text">
    Для получения элемента с тегом передайте тот же упорядоченный список тегов в метод tags(), а затем вызовите метод get() с тем ключом, который необходимо получить:
</p>
<code>
<pre>
$john = Cache::tags(['people', 'artists'])->get('John');

$anne = Cache::tags(['people', 'authors'])->get('Anne');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Удаление элементов кэша с тегами
</h4>
<p class="theme__text">
    Вы можете очистить все элементы с заданным тегом или списком тегов. Например, следующий код удалит все элементы, отмеченные либо тегом people, либо authors, либо и тем и другим. Поэтому и Anne и John будут удалены из кэша:
</p>
<code>
<pre>
Cache::tags(['people', 'authors'])->flush();
</pre>
</code>
<p class="theme__text">
    В отличие от предыдущего, следующий код удалит только те элементы, которые отмечены тегом authors, поэтому Anne будет удалён, а John — нет:
</p>
<code>
<pre>
Cache::tags('authors')->flush();
</pre>
</code>
<h2 class="theme__title">
    Atomic Locks
</h2>
<p class="theme__text">
    Чтобы использовать эту функцию, ваше приложение должно использовать драйвер кэша memcached, redis, dynamodb, database, file, or array в качестве драйвера кеша по умолчанию для вашего приложения. Кроме того, все серверы должны взаимодействовать с одним и тем же сервером центрального кеша.
</p>
<h4 class="theme_subtitlex2">
    Необходимые драйверы
</h4>
<h4 class="theme_subtitlex2">
    База данных
</h4>
<p class="theme__text">
    При использовании драйвера кэша database вам необходимо настроить таблицу, в которой будут храниться блокировки кеша. Вы найдете пример объявления Schema в таблице ниже:
</p>
<code>
<pre>
Schema::create('cache_locks', function ($table) {
    $table->string('key')->primary();
    $table->string('owner');
    $table->integer('expiration');
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Управление замками
</h4>
<p class="theme__text">
    Атомарные блокировки позволяют манипулировать распределенными блокировками, не беспокоясь об условиях гонки. Например, Laravel Forge использует атомарные блокировки, чтобы гарантировать, что на сервере одновременно выполняется только одна удаленная задача. Вы можете создавать блокировки и управлять ими с помощью метода Cache :: lock:
</p>
<code>
<pre>
use Illuminate\Support\Facades\Cache;

$lock = Cache::lock('foo', 10);

if ($lock->get()) {
    // Lock acquired for 10 seconds...

    $lock->release();
}
</pre>
</code>
<p class="theme__text">
    Метод get также принимает Closure. После выполнения закрытия Laravel автоматически снимет блокировку:
</p>
<code>
<pre>
Cache::lock('foo')->get(function () {
    // Lock acquired indefinitely and automatically released...
});
</pre>
</code>
<p class="theme__text">
    Если блокировка недоступна в тот момент, когда вы ее запрашиваете, вы можете указать Laravel подождать определенное количество секунд. Если блокировка не может быть получена в течение указанного срока, будет выброшено исключение Illuminate \ Contracts \ Cache \ LockTimeoutException:
</p>
<code>
<pre>
use Illuminate\Contracts\Cache\LockTimeoutException;

$lock = Cache::lock('foo', 10);

try {
    $lock->block(5);

    // Lock acquired after waiting maximum of 5 seconds...
} catch (LockTimeoutException $e) {
    // Unable to acquire lock...
} finally {
    optional($lock)->release();
}

Cache::lock('foo', 10)->block(5, function () {
    // Lock acquired after waiting maximum of 5 seconds...
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Управление блокировками между процессами
</h4>
<p class="theme__text">
    Иногда вы можете захотеть установить блокировку в одном процессе и снять ее в другом процессе. Например, вы можете получить блокировку во время веб-запроса и захотеть снять блокировку в конце задания в очереди, которое запускается этим запросом. В этом сценарии вы должны передать "токен владельца" области действия блокировки заданию в очереди, чтобы задание могло повторно создать экземпляр блокировки, используя данный токен:
</p>
<code>
<pre>
// Within Controller...
$podcast = Podcast::find($id);

$lock = Cache::lock('foo', 120);

if ($result = $lock->get()) {
    ProcessPodcast::dispatch($podcast, $lock->owner());
}

// Within ProcessPodcast Job...
Cache::restoreLock('foo', $this->owner)->release();
</pre>
</code>
<p class="theme__text">
    Если вы хотите снять блокировку, не уважая ее текущего владельца, вы можете использовать метод forceRelease:
</p>
<code>
<pre>
Cache::lock('foo')->forceRelease();
</pre>
</code>
<h2 class="theme__title">
    Добавление своих драйверов кэша
</h2>
<h4 class="theme_subtitlex2">
    Написание драйвера
</h4>
<p class="theme__text">
    Чтобы создать свой драйвер кэша, нам надо сначала реализовать контракт Illuminate\Contracts\Cache\Store. Итак, наша реализация кэша MongoDB будет выглядеть примерно так:
</p>
<code>
<pre>
namespace App\Extensions;

use Illuminate\Contracts\Cache\Store;

class MongoStore implements Store
{
    public function get($key) {}
    public function many(array $keys) {}
    public function put($key, $value, $seconds) {}
    public function putMany(array $values, $seconds) {}
    public function increment($key, $value = 1) {}
    public function decrement($key, $value = 1) {}
    public function forever($key, $value) {}
    public function forget($key) {}
    public function flush() {}
    public function getPrefix() {}
}
</pre>
</code>
<p class="theme__text">
    Нам просто надо реализовать каждый из этих методов, используя соединение MongoDB. Примеры реализации каждого из этих методов можно найти в Illuminate\Cache\MemcachedStore в исходном коде фреймворка. Когда наша реализация готова, мы можем завершить регистрацию нашего драйвера:
</p>
<code>
<pre>
Cache::extend('mongo', function ($app) {
    return Cache::repository(new MongoStore);
});
</pre>
</code>
<p class="theme__text">
    Если вы задумались о том, где разместить код вашего драйвера, то можете создать пространство имён Extensions в папке app. Но не забывайте, в Laravel нет жёсткой структуры приложения, и вы можете организовать его как пожелаете.
</p>
<h4 class="theme_subtitlex2">
    Регистрация драйвера
</h4>
<p class="theme__text">
    Чтобы зарегистрировать свой драйвер кэша в Laravel, мы будем использовать метод extend() фасада Cache. Вызов Cache::extend() можно делать из метода boot() сервис-провайдера по умолчанию App\Providers\AppServiceProvider, который есть в каждом Laravel-приложении. Или вы можете создать свой сервис-провайдер для размещения расширения — только не забудьте зарегистрировать его в массиве провайдеров config/app.php:
</p>
<code>
<pre>
namespace App\Providers;

use App\Extensions\MongoStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
        * Register any application services.
        *
        * @return void
        */
    public function register()
    {
        //
    }

    /**
        * Bootstrap any application services.
        *
        * @return void
        */
    public function boot()
    {
        Cache::extend('mongo', function ($app) {
            return Cache::repository(new MongoStore);
        });
    }
}
</pre>
</code>
<p class="theme__text">
    Первый аргумент метода extend() — имя драйвера. Оно будет соответствовать параметру driver в вашем файле настроек config/cache.php. Второй аргумент — замыкание, которое должно возвращать экземпляр Illuminate\Cache\Repository. В замыкание будет передан экземпляр $app, который является экземпляром сервис-контейнера.
    <br>
    Когда ваше расширение зарегистрировано, просто укажите его имя в качестве значения параметра driver в файле настроек config/cache.php.
</p>
<h3 class="theme__subtitle">
    События кэша
</h3>
<p class="theme__text">
    Для выполнения какого-либо кода при каждой операции с кэшем вы можете прослушивать события, инициируемые кэшем. Обычно вам необходимо поместить эти слушатели событий в ваш EventServiceProvider:
</p>
<code>
<pre>
/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    'Illuminate\Cache\Events\CacheHit' => [
        'App\Listeners\LogCacheHit',
    ],

    'Illuminate\Cache\Events\CacheMissed' => [
        'App\Listeners\LogCacheMissed',
    ],

    'Illuminate\Cache\Events\KeyForgotten' => [
        'App\Listeners\LogKeyForgotten',
    ],

    'Illuminate\Cache\Events\KeyWritten' => [
        'App\Listeners\LogKeyWritten',
    ],
];
</pre>
</code>
    </div>
    <div class="theme">
<h2 class="theme__title">
    Коллекции
</h2>
<p class="theme__text">

</p>

Класс Illuminate\Support\Collection предоставляет гибкую и удобную обёртку для работы с массивами данных. Например, посмотрите на следующий код. Мы будем использовать вспомогательную функцию collect(), чтобы создать новый экземпляр коллекции из массива, выполним функцию strtoupper() для каждого элемента, а затем удалим все пустые элементы:

$collection = collect(['taylor', 'abigail', null])->map(function ($name) {
    return strtoupper($name);
})
->reject(function ($name) {
    return empty($name);
});

Как видите, класс Collection позволяет использовать свои методы в связке для гибкого отображения и уменьшения исходного массива. В общем, коллекции «неизменны», то есть каждый метод класса Collection возвращает совершенно новый экземпляр Collection.

Создание коллекций

Как упоминалось выше, вспомогательная функция collect() возвращает новый экземпляр класса Illuminate\Support\Collection для заданного массива. Поэтому создать коллекцию очень просто:

$collection = collect([1, 2, 3]);

Результаты запросов Eloquent всегда возвращаются в виде экземпляров класса Collection.

Расширение коллекций

Коллекции являются «макросами», что позволяет добавлять дополнительные методы в класс Collection во время выполнения. Например, следующий код добавляет метод toUpper к классу Collection:
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

Collection::macro('toUpper', function () {
    return $this->map(function ($value) {
        return Str::upper($value);
    });
});

$collection = collect(['first', 'second']);

$upper = $collection->toUpper();

// ['FIRST', 'SECOND']

Как правило, вы должны объявлять макросы сбора у поставщика услуг.

Список доступных методов
В оставшейся части этой документации мы обсудим каждый метод, доступный в классе Collection. Помните, что все эти методы могут быть объединены в цепочку для беспрепятственного управления базовым массивом. Кроме того, почти каждый метод возвращает новый экземпляр коллекции, что позволяет при необходимости сохранить исходную копию коллекции:

all()
Метод all() возвращает заданный массив, представленный коллекцией:
collect([1, 2, 3])->all();
// [1, 2, 3]

average()

Alias for the avg method.

avg()
Метод avg() возвращает среднее значение всех элементов в коллекции:
collect([1, 2, 3, 4, 5])->avg();

// 3
$average = collect([1, 1, 2, 4])->avg();

// 2
Если коллекция содержит вложенные массивы или объекты, то вы должны передать ключ, чтобы определить, среднее значение каких значений необходимо вычислить:
PHP

$collection = collect([
  ['name' => 'JavaScript: The Good Parts', 'pages' => 176],
  ['name' => 'JavaScript: The Definitive Guide', 'pages' => 1096],
]);

$collection->avg('pages');

// 636

$average = collect([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->avg('foo');

// 20

Метод chunk() разбивает коллекцию на множество мелких коллекций заданного размера:

$collection = collect([1, 2, 3, 4, 5, 6, 7]);

$chunks = $collection->chunk(4);

$chunks->toArray();

// [[1, 2, 3, 4], [5, 6, 7]]

Этот метод особенно полезен в представлениях при работе с системой сеток, такой как Bootstrap. Представьте, что у вас есть коллекция моделей Eloquent, которую вы хотите отобразить в сетке:
PHP

@foreach ($products->chunk(3) as $chunk)
  <div class="row">
    @foreach ($chunk as $product)
      <div class="col-xs-4">{{ $product->name }}</div>
    @endforeach
  </div>
@endforeach


chunkWhile()
Метод chunkWhile разбивает коллекцию на несколько меньших по размеру коллекций на основе оценки данного обратного вызова:
$collection = collect(str_split('AABBCCCD'));

$chunks = $collection->chunkWhile(function ($current, $key, $chunk) {
    return $current === $chunk->last();
});

$chunks->all();

// [['A', 'A'], ['B', 'B'], ['C', 'C', 'C'], ['D']]


collapse()

Метод collapse() сворачивает коллекцию массивов в одну одномерную коллекцию:

$collection = collect([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);

$collapsed = $collection->collapse();

$collapsed->all();

// [1, 2, 3, 4, 5, 6, 7, 8, 9]

+ 5.2

добавлено в 5.2 (08.12.2016)

combine()

Метод combine() комбинирует ключи коллекции со значениями другого массива или коллекции:
PHP

$collection = collect(['name', 'age']);

$combined = $collection->combine(['George', 29]);

$combined->all();

// ['name' => 'George', 'age' => 29]

collect()
Метод collect возвращает новый экземпляр Collection с элементами, которые в настоящее время находятся в коллекции:
$collectionA = collect([1, 2, 3]);

$collectionB = $collectionA->collect();

$collectionB->all();

// [1, 2, 3]
Метод collect в первую очередь полезен для преобразования  lazy collections  в стандартные экземпляры Collection:
$lazyCollection = LazyCollection::make(function () {
    yield 1;
    yield 2;
    yield 3;
});

$collection = $lazyCollection->collect();

get_class($collection);

// 'Illuminate\Support\Collection'

$collection->all();

// [1, 2, 3]
Метод collect особенно полезен, когда у вас есть экземпляр Enumerable и вам нужен не ленивый экземпляр коллекции. Поскольку collect () является частью контракта Enumerable, вы можете безопасно использовать его для получения экземпляра Collection.


concat()
Метод concat добавляет значения данного массива или коллекции в конец коллекции:
$collection = collect(['John Doe']);

$concatenated = $collection->concat(['Jane Doe'])->concat(['name' => 'Johnny Doe']);

$concatenated->all();

// ['John Doe', 'Jane Doe', 'Johnny Doe']

contains()

Метод contains() определяет, содержит ли коллекция заданное значение:

$collection = collect(['name' => 'Desk', 'price' => 100]);

$collection->contains('Desk');

// true

$collection->contains('New York');

// false

Также вы можете передать пару ключ/значение в метод contains(), определяющий, существует ли заданная пара в коллекции:

$collection = collect([
  ['product' => 'Desk', 'price' => 200],
  ['product' => 'Chair', 'price' => 100],
]);

$collection->contains('product', 'Bookcase');

// false

Напоследок, вы можете передать функцию обратного вызова в метод contains() для выполнения своих собственных условий:
PHP

$collection = collect([1, 2, 3, 4, 5]);

$collection->contains(function ($value, $key) {
  return $value > 5;
});

// false

Метод contains использует «свободные» сравнения при проверке значений элементов, то есть строка с целым значением будет считаться равной целому числу того же значения. Используйте метод containsStrict для фильтрации с использованием «строгих» сравнений.

containsStrict ()
Этот метод имеет ту же сигнатуру, что и метод contains; однако все значения сравниваются с использованием «строгих» сравнений.
Поведение этого метода изменяется при использовании Eloquent Collections.

count()

Метод count() возвращает общее количество элементов в коллекции:
PHP

$collection = collect([1, 2, 3, 4]);

$collection->count();

// 4

countBy()
Метод countBy подсчитывает вхождения значений в коллекцию. По умолчанию метод подсчитывает вхождения каждого элемента:
$collection = collect([1, 2, 2, 2, 3]);

$counted = $collection->countBy();

$counted->all();

// [1 => 1, 2 => 3, 3 => 1]
Однако вы передаете обратный вызов методу countBy для подсчета всех элементов по настраиваемому значению:
$collection = collect(['alice@gmail.com', 'bob@yahoo.com', 'carlos@gmail.com']);

$counted = $collection->countBy(function ($email) {
    return substr(strrchr($email, "@"), 1);
});

$counted->all();

// ['gmail.com' => 2, 'yahoo.com' => 1]

crossJoin()
Метод crossJoin cross объединяет значения коллекции среди заданных массивов или коллекций, возвращая декартово произведение со всеми возможными перестановками:
$collection = collect([1, 2]);

$matrix = $collection->crossJoin(['a', 'b']);

$matrix->all();

/*
    [
        [1, 'a'],
        [1, 'b'],
        [2, 'a'],
        [2, 'b'],
    ]
*/

$collection = collect([1, 2]);

$matrix = $collection->crossJoin(['a', 'b'], ['I', 'II']);

$matrix->all();

/*
    [
        [1, 'a', 'I'],
        [1, 'a', 'II'],
        [1, 'b', 'I'],
        [1, 'b', 'II'],
        [2, 'a', 'I'],
        [2, 'a', 'II'],
        [2, 'b', 'I'],
        [2, 'b', 'II'],
    ]
*/

dd()
Метод dd выгружает элементы коллекции и завершает выполнение скрипта:
$collection = collect(['John Doe', 'Jane Doe']);

$collection->dd();

/*
    Collection {
        #items: array:2 [
            0 => "John Doe"
            1 => "Jane Doe"
        ]
    }
*/
Если вы не хотите останавливать выполнение сценария, используйте вместо этого метод dump .

diff()

Метод diff() сравнивает одну коллекцию с другой коллекцией или с простым PHP array на основе их значений. Этот метод вернёт те значения исходной коллекции, которых нет в переданной для сравнения коллекции:
PHP

$collection = collect([1, 2, 3, 4, 5]);

$diff = $collection->diff([2, 4, 6, 8]);

$diff->all();

// [1, 3, 5]

Поведение этого метода изменяется при использовании Eloquent Collections.

diffAssoc()
Метод diffAssoc сравнивает коллекцию с другой коллекцией или простым массивом PHP на основе его ключей и значений. Этот метод вернет пары ключ / значение в исходной коллекции, которых нет в данной коллекции:
$collection = collect([
    'color' => 'orange',
    'type' => 'fruit',
    'remain' => 6,
]);

$diff = $collection->diffAssoc([
    'color' => 'yellow',
    'type' => 'fruit',
    'remain' => 3,
    'used' => 6,
]);

$diff->all();

// ['color' => 'orange', 'remain' => 6]

diffKeys()
Метод diffKeys() сравнивает одну коллекцию с другой коллекцией или с простым PHP array на основе их ключей. Этот метод вернёт те пары ключ/значение из исходной коллекции, которых нет в переданной для сравнения коллекции:

$collection = collect([
  'one' => 10,
  'two' => 20,
  'three' => 30,
  'four' => 40,
  'five' => 50,
]);

$diff = $collection->diffKeys([
  'two' => 2,
  'four' => 4,
  'six' => 6,
  'eight' => 8,
]);

$diff->all();

// ['one' => 10, 'three' => 30, 'five' => 50]


dump()
Метод dump выгружает элементы коллекции:
$collection = collect(['John Doe', 'Jane Doe']);

$collection->dump();

/*
    Collection {
        #items: array:2 [
            0 => "John Doe"
            1 => "Jane Doe"
        ]
    }
*/
Если вы хотите остановить выполнение сценария после сброса коллекции, используйте вместо этого метод dd.


duplicates()
Метод duplicates извлекает и возвращает повторяющиеся значения из коллекции:
$collection = collect(['a', 'b', 'a', 'c', 'b']);

$collection->duplicates();

// [2 => 'a', 4 => 'b']
Если коллекция содержит массивы или объекты, вы можете передать ключ атрибутов, которые вы хотите проверить на наличие повторяющихся значений:
$employees = collect([
    ['email' => 'abigail@example.com', 'position' => 'Developer'],
    ['email' => 'james@example.com', 'position' => 'Designer'],
    ['email' => 'victoria@example.com', 'position' => 'Developer'],
])

$employees->duplicates('position');

// [2 => 'Developer']

duplicatesStrict()
Этот метод имеет ту же сигнатуру, что и метод duplicates; однако все значения сравниваются с использованием «строгих» сравнений.

each()

Метод each() перебирает элементы в коллекции и передает каждый элемент в функцию обратного вызова:

$collection = $collection->each(function ($item, $key) {
  //
});

Верните false из функции обратного вызова, чтобы выйти из цикла:
PHP

$collection = $collection->each(function ($item, $key) {
  if (/* ваше условие */) {
    return false;
  }
});


eachSpread()
Метод eachSpread выполняет итерацию по элементам коллекции, передавая значение каждого вложенного элемента в заданный обратный вызов:
$collection = collect([['John Doe', 35], ['Jane Doe', 33]]);

$collection->eachSpread(function ($name, $age) {
    //
});
Вы можете прекратить итерацию по элементам, вернув false из обратного вызова:
$collection->eachSpread(function ($name, $age) {
    return false;
});

every()
every метод может использоваться для проверки того, что все элементы коллекции проходят заданный тест истинности:
collect([1, 2, 3, 4])->every(function ($value, $key) {
    return $value > 2;
});

// false
Если коллекция пуста, every вернет true:
$collection = collect([]);

$collection->every(function ($value, $key) {
    return $value > 2;
});

// true
except()

Метод except() возвращает все элементы в коллекции, кроме тех, чьи ключи указаны в передаваемом массиве:

$collection = collect(['product_id' => 1, 'price' => 100, 'discount' => false]);

$filtered = $collection->except(['price', 'discount']);

$filtered->all();

// ['product_id' => 1]

Метод only — инверсный методу except.
Поведение этого метода изменяется при использовании Eloquent Collections.

filter()

Метод filter() фильтрует коллекцию с помощью переданной функции обратного вызова, оставляя только те элементы, которые соответствуют заданному условию:
+ 5.2

добавлено в 5.2 (08.12.2016)
PHP

$collection = collect([1, 2, 3, 4]);

$filtered = $collection->filter(function ($value, $key) {
  return $value > 2;
});

$filtered->all();

// [3, 4]
Если обратный вызов не предоставлен, все записи коллекции, эквивалентные false, будут удалены:
$collection = collect([1, 2, 3, null, false, '', 0, []]);

$collection->filter()->all();

// [1, 2, 3]
Метод reject() — инверсный методу filter().

first()
first()

Метод first() возвращает первый элемент в коллекции, который подходит под заданное условие:

collect([1, 2, 3, 4])->first(function ($value, $key) {
  return $value > 2;
});

// 3

Также вы можете вызвать метод first() без параметров, чтобы получить первый элемент в коллекции. Если коллекция пуста, то вернётся null:
PHP

collect([1, 2, 3, 4])->first();

// 1

firstWhere()
Метод firstWhere возвращает первый элемент в коллекции с заданной парой ключ / значение:
collection = collect([
    ['name' => 'Regena', 'age' => null],
    ['name' => 'Linda', 'age' => 14],
    ['name' => 'Diego', 'age' => 23],
    ['name' => 'Linda', 'age' => 84],
]);

$collection->firstWhere('name', 'Linda');

// ['name' => 'Linda', 'age' => 14]
Вы также можете вызвать метод firstWhere с помощью оператора:
$collection->firstWhere('age', '>=', 18);

// ['name' => 'Diego', 'age' => 23]
Как и метод where, вы можете передать один аргумент методу firstWhere. В этом сценарии метод firstWhere вернет первый элемент, для которого значение ключа данного элемента является «истинным»:
$collection->firstWhere('age');

// ['name' => 'Linda', 'age' => 14]

flatMap()
flatMap()

Метод flatMap() проходит по коллекции и передаёт каждое значение в заданную функцию обратного вызова. Эта функция может изменить элемент и вернуть его, формируя таким образом новую коллекцию модифицированных элементов. Затем массив «сплющивается» в одномерный:

$collection = collect([
  ['name' => 'Sally'],
  ['school' => 'Arkansas'],
  ['age' => 28]
]);

$flattened = $collection->flatMap(function ($values) {
  return array_map('strtoupper', $values);
});

$flattened->all();

// ['name' => 'SALLY', 'school' => 'ARKANSAS', 'age' => '28'];

flatten()

Метод flatten() преобразует многомерную коллекцию в одномерную:

$collection = collect(['name' => 'taylor', 'languages' => ['php', 'javascript']]);

$flattened = $collection->flatten();

$flattened->all();

// ['taylor', 'php', 'javascript'];

+ 5.2

добавлено в 5.2 (08.12.2016)

При необходимости вы можете передать в метод аргумент «глубины»:

$collection = collect([
  'Apple' => [
    ['name' => 'iPhone 6S', 'brand' => 'Apple'],
  ],
  'Samsung' => [
    ['name' => 'Galaxy S7', 'brand' => 'Samsung']
  ],
]);

$products = $collection->flatten(1);

$products->values()->all();

/*
  [
    ['name' => 'iPhone 6S', 'brand' => 'Apple'],
    ['name' => 'Galaxy S7', 'brand' => 'Samsung'],
  ]
*/

Если вызвать flatten() без указания глубины, то вложенные массивы тоже «расплющатся», и получим ['iPhone 6S', 'Apple', 'Galaxy S7', 'Samsung']. Глубина задаёт уровень вложенности массивов, ниже которого «расплющивать» не нужно.

flip()

Метод flip() меняет местами ключи и значения в коллекции:

$collection = collect(['name' => 'taylor', 'framework' => 'laravel']);

$flipped = $collection->flip();

$flipped->all();

// ['taylor' => 'name', 'laravel' => 'framework']

forget()

Метод forget() удаляет элемент из коллекции по его ключу:

$collection = collect(['name' => 'taylor', 'framework' => 'laravel']);

$collection->forget('name');

$collection->all();

// ['framework' => 'laravel']

В отличие от большинства других методов коллекции, forget() не возвращает новую модифицированную коллекцию. Он изменяет коллекцию при вызове.

forPage()

Метод forPage() возвращает новую коллекцию, содержащую элементы, которые будут присутствовать на странице с заданным номером. Первый аргумент метода — номер страницы, второй аргумент — число элементов для вывода на странице:

$collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9]);

$chunk = $collection->forPage(2, 3);

$chunk->all();

// [4, 5, 6]

get()

Метод get() возвращает нужный элемент по заданному ключу. Если ключ не существует, то возвращается null:

$collection = collect(['name' => 'taylor', 'framework' => 'laravel']);

$value = $collection->get('name');

// taylor

Вторым параметром вы можете передать значение по умолчанию:

$collection = collect(['name' => 'taylor', 'framework' => 'laravel']);

$value = $collection->get('foo', 'default-value');

// default-value

Вы даже можете передать функцию обратного вызова в качестве значения по умолчанию. Результат функции обратного вызова будет возвращён, если указанный ключ не существует:

$collection->get('email', function () {
  return 'default-value';
});

// default-value

groupBy()

Метод groupBy() группирует элементы коллекции по заданному ключу:

$collection = collect([
  ['account_id' => 'account-x10', 'product' => 'Chair'],
  ['account_id' => 'account-x10', 'product' => 'Bookcase'],
  ['account_id' => 'account-x11', 'product' => 'Desk'],
]);

$grouped = $collection->groupBy('account_id');

$grouped->toArray();

/*
  [
    'account-x10' => [
      ['account_id' => 'account-x10', 'product' => 'Chair'],
      ['account_id' => 'account-x10', 'product' => 'Bookcase'],
    ],
    'account-x11' => [
      ['account_id' => 'account-x11', 'product' => 'Desk'],
    ],
  ]
*/

В дополнение к передаваемой строке key, вы можете также передать функцию обратного вызова. Она должна возвращать значение, по которому вы хотите группировать:
PHP

$grouped = $collection->groupBy(function ($item, $key) {
  return substr($item['account_id'], -3);
});

$grouped->toArray();

/*
  [
    'x10' => [
      ['account_id' => 'account-x10', 'product' => 'Chair'],
      ['account_id' => 'account-x10', 'product' => 'Bookcase'],
    ],
    'x11' => [
      ['account_id' => 'account-x11', 'product' => 'Desk'],
    ],
  ]
*/

В виде массива можно передать несколько критериев группировки. Каждый элемент массива будет применен к соответствующему уровню в многомерном массиве:
$data = new Collection([
    10 => ['user' => 1, 'skill' => 1, 'roles' => ['Role_1', 'Role_3']],
    20 => ['user' => 2, 'skill' => 1, 'roles' => ['Role_1', 'Role_2']],
    30 => ['user' => 3, 'skill' => 2, 'roles' => ['Role_1']],
    40 => ['user' => 4, 'skill' => 2, 'roles' => ['Role_2']],
]);

$result = $data->groupBy([
    'skill',
    function ($item) {
        return $item['roles'];
    },
], $preserveKeys = true);

/*
[
    1 => [
        'Role_1' => [
            10 => ['user' => 1, 'skill' => 1, 'roles' => ['Role_1', 'Role_3']],
            20 => ['user' => 2, 'skill' => 1, 'roles' => ['Role_1', 'Role_2']],
        ],
        'Role_2' => [
            20 => ['user' => 2, 'skill' => 1, 'roles' => ['Role_1', 'Role_2']],
        ],
        'Role_3' => [
            10 => ['user' => 1, 'skill' => 1, 'roles' => ['Role_1', 'Role_3']],
        ],
    ],
    2 => [
        'Role_1' => [
            30 => ['user' => 3, 'skill' => 2, 'roles' => ['Role_1']],
        ],
        'Role_2' => [
            40 => ['user' => 4, 'skill' => 2, 'roles' => ['Role_2']],
        ],
    ],
];
*/
has()

Метод has() определяет, существует ли заданный ключ в коллекции:
$collection = collect(['account_id' => 1, 'product' => 'Desk', 'amount' => 5]);

$collection->has('product');

// true

$collection->has(['product', 'amount']);

// true

$collection->has(['amount', 'price']);

// false

implode()
implode()

Метод implode() соединяет элементы в коллекции. Его параметры зависят от типа элементов в коллекции. Если коллекция содержит массивы или объекты, вы должны передать ключ атрибутов, значения которых вы хотите соединить, и «промежуточную» строку, которую вы хотите поместить между значениями:

$collection = collect([
  ['account_id' => 1, 'product' => 'Desk'],
  ['account_id' => 2, 'product' => 'Chair'],
]);

$collection->implode('product', ', ');

// Desk, Chair

Если коллекция содержит простые строки или числовые значения, просто передайте только «промежуточный» параметр в метод:

collect([1, 2, 3, 4, 5])->implode('-');

// '1-2-3-4-5

intersect()

Метод Intersect() удаляет любые значения из исходной коллекции, которых нет в переданном массиве или коллекции. Результирующая коллекция сохранит ключи оригинальной коллекции:
PHP

$collection = collect(['Desk', 'Sofa', 'Chair']);

$intersect = $collection->intersect(['Desk', 'Chair', 'Bookcase']);

$intersect->all();

// [0 => 'Desk', 2 => 'Chair']
Поведение этого метода изменяется при использовании Eloquent Collections.


intersectByKeys()
Метод IntercctByKeys удаляет все ключи из исходной коллекции, которых нет в данном массиве или коллекции:
$collection = collect([
    'serial' => 'UX301', 'type' => 'screen', 'year' => 2009,
]);

$intersect = $collection->intersectByKeys([
    'reference' => 'UX404', 'type' => 'tab', 'year' => 2011,
]);

$intersect->all();

// ['type' => 'screen', 'year' => 2009]

isEmpty()

Метод isEmpty() возвращает true, если коллекция пуста. В противном случае вернётся false:

collect([])->isEmpty();

// true


isNotEmpty()
Метод isNotEmpty возвращает значение true, если коллекция не пуста; в противном случае возвращается false:
collect([])->isNotEmpty();

// false

join()
Метод join объединяет значения коллекции с помощью строки:
collect(['a', 'b', 'c'])->join(', '); // 'a, b, c'
collect(['a', 'b', 'c'])->join(', ', ', and '); // 'a, b, and c'
collect(['a', 'b'])->join(', ', ' and '); // 'a and b'
collect(['a'])->join(', ', ' and '); // 'a'
collect([])->join(', ', ' and '); // ''

keyBy()

Метод keyBy() возвращает коллекцию по указанному ключу. Если несколько элементов имеют одинаковый ключ, в результирующей коллекции появится только последний их них:

$collection = collect([
  ['product_id' => 'prod-100', 'name' => 'desk'],
  ['product_id' => 'prod-200', 'name' => 'chair'],
]);

$keyed = $collection->keyBy('product_id');

$keyed->all();

/*
  [
    'prod-100' => ['product_id' => 'prod-100', 'name' => 'Desk'],
    'prod-200' => ['product_id' => 'prod-200', 'name' => 'Chair'],
  ]
*/

Также вы можете передать в метод функцию обратного вызова, которая должна возвращать значение ключа коллекции для этого метода:

$keyed = $collection->keyBy(function ($item) {
  return strtoupper($item['product_id']);
});

$keyed->all();

/*
  [
    'PROD-100' => ['product_id' => 'prod-100', 'name' => 'Desk'],
    'PROD-200' => ['product_id' => 'prod-200', 'name' => 'Chair'],
  ]
*/

keys()
Метод keys() возвращает все ключи коллекции:

$collection = collect([
  'prod-100' => ['product_id' => 'prod-100', 'name' => 'Desk'],
  'prod-200' => ['product_id' => 'prod-200', 'name' => 'Chair'],
]);

$keys = $collection->keys();

$keys->all();

// ['prod-100', 'prod-200']

last()

Метод last() возвращает последний элемент в коллекции, для которого выполняется заданное условие:

collect([1, 2, 3, 4])->last(function ($value, $key) {
  return $value < 3;
});

// 2

Также вы можете вызвать метод last() без параметров, чтобы получить последний элемент в коллекции. Если коллекция пуста, то вернётся null:
PHP

collect([1, 2, 3, 4])->last();

// 4

macro ()

Статический macro метод позволяет добавлять методы в класс Collection во время выполнения. Обратитесь к документации по расширению коллекций для получения дополнительной информации.
make()
Статический метод make создает новый экземпляр коллекции. См. Раздел Создание коллекций.

map()

Метод map() перебирает коллекцию и передаёт каждое значению в функцию обратного вызова. Функция обратного вызова может свободно изменять элемент и возвращать его, формируя тем самым новую коллекцию измененных элементов:

$collection = collect([1, 2, 3, 4, 5]);

$multiplied = $collection->map(function ($item, $key) {
  return $item * 2;
});

$multiplied->all();

// [2, 4, 6, 8, 10]

Как и большинство других методов коллекции, метод map() возвращает новый экземпляр коллекции. Он не изменяет коллекцию при вызове. Если вы хотите преобразовать оригинальную коллекцию, используйте метод transform().

mapInto()
Метод mapInto () выполняет итерацию по коллекции, создавая новый экземпляр данного класса, передавая значение в конструктор:
class Currency
{
    /**
     * Create a new currency instance.
     *
     * @param  string  $code
     * @return void
     */
    function __construct(string $code)
    {
        $this->code = $code;
    }
}

$collection = collect(['USD', 'EUR', 'GBP']);

$currencies = $collection->mapInto(Currency::class);

$currencies->all();

// [Currency('USD'), Currency('EUR'), Currency('GBP')]


mapSpread()
Метод mapSpread выполняет итерацию по элементам коллекции, передавая значение каждого вложенного элемента в заданный обратный вызов. Обратный вызов может изменять элемент и возвращать его, тем самым формируя новую коллекцию измененных элементов:
$collection = collect([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);

$chunks = $collection->chunk(2);

$sequence = $chunks->mapSpread(function ($even, $odd) {
    return $even + $odd;
});

$sequence->all();

// [1, 5, 9, 13, 17]

mapToGroups()
Метод mapToGroups группирует элементы коллекции по заданному обратному вызову. Обратный вызов должен возвращать ассоциативный массив, содержащий одну пару ключ / значение, таким образом формируя новую коллекцию сгруппированных значений:
$collection = collect([
    [
        'name' => 'John Doe',
        'department' => 'Sales',
    ],
    [
        'name' => 'Jane Doe',
        'department' => 'Sales',
    ],
    [
        'name' => 'Johnny Doe',
        'department' => 'Marketing',
    ]
]);

$grouped = $collection->mapToGroups(function ($item, $key) {
    return [$item['department'] => $item['name']];
});

$grouped->all();

/*
    [
        'Sales' => ['John Doe', 'Jane Doe'],
        'Marketing' => ['Johnny Doe'],
    ]
*/

$grouped->get('Sales')->all();

// ['John Doe', 'Jane Doe']

mapWithKeys()
mapWithKeys()

Метод mapWithKeys() проходит по элементам коллекции и передаёт каждое значение в функцию обратного вызова, которая должна вернуть ассоциативный массив, содержащий одну пару ключ/значение:

$collection = collect([
  [
    'name' => 'John',
    'department' => 'Sales',
    'email' => 'john@example.com'
  ],
  [
    'name' => 'Jane',
    'department' => 'Marketing',
    'email' => 'jane@example.com'
  ]
]);

$keyed = $collection->mapWithKeys(function ($item) {
  return [$item['email'] => $item['name']];
});

$keyed->all();

/*
  [
    'john@example.com' => 'John',
    'jane@example.com' => 'Jane',
  ]
*/

max()

Метод max() возвращает максимальное значение по заданному ключу:
PHP

$max = collect([['foo' => 10], ['foo' => 20]])->max('foo');

// 20

$max = collect([1, 2, 3, 4, 5])->max();

// 5


median()
Метод median возвращает медианное значение данного ключа:
$median = collect([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->median('foo');

// 15

$median = collect([1, 1, 2, 4])->median();

// 1.5

merge()

Метод merge() добавляет указанный массив в исходную коллекцию. Значения исходной коллекции, имеющие тот же строковый ключ, что и значение в массиве, будут перезаписаны:

$collection = collect(['product_id' => 1, 'price' => 100]);

$merged = $collection->merge(['price' => 200, 'discount' => false]);

$merged->all();

// ['product_id' => 1, 'price' => 200, 'discount' => false]

Если заданные ключи в массиве числовые, то значения будут добавляться в конец коллекции:

$collection = collect(['Desk', 'Chair']);

$merged = $collection->merge(['Bookcase', 'Door']);

$merged->all();

// ['Desk', 'Chair', 'Bookcase', 'Door']

mergeRecursive()
Метод mergeRecursive рекурсивно объединяет данный массив или коллекцию с исходной коллекцией. Если строковый ключ в данных элементах совпадает со строковым ключом в исходной коллекции, то значения этих ключей объединяются в массив, и это делается рекурсивно:
$collection = collect(['product_id' => 1, 'price' => 100]);

$merged = $collection->mergeRecursive(['product_id' => 2, 'price' => 200, 'discount' => false]);

$merged->all();

// ['product_id' => [1, 2], 'price' => [100, 200], 'discount' => false]

min()

Метод min() возвращает минимальное значение по заданному ключу:
PHP

$min = collect([['foo' => 10], ['foo' => 20]])->min('foo');

// 10

$min = collect([1, 2, 3, 4, 5])->min();

// 1


mode()
Метод mode возвращает значение режима данного ключа:
$mode = collect([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->mode('foo');

// [10]

$mode = collect([1, 1, 2, 4])->mode();

// [1]

nth()
nth метод создает новую коллекцию, состоящую из каждого n-го элемента:
$collection = collect(['a', 'b', 'c', 'd', 'e', 'f']);

$collection->nth(4);

// ['a', 'e']
При желании вы можете передать смещение в качестве второго аргумента:
$collection->nth(4, 1);

// ['b', 'f']

only()

Метод only() возвращает элементы коллекции с заданными ключами:

$collection = collect(['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);

$filtered = $collection->only(['product_id', 'name']);

$filtered->all();

// ['product_id' => 1, 'name' => 'Desk']

Метод except() — инверсный для метода only().
Поведение этого метода изменяется при использовании Eloquent Collections.

pad()
Метод pad будет заполнять массив заданным значением до тех пор, пока массив не достигнет указанного размера. Этот метод ведет себя как функция PHP array_pad.

Для прокладки влево следует указать отрицательный размер. Если абсолютное значение заданного размера меньше или равно длине массива, заполнение не произойдет:
$collection = collect(['A', 'B', 'C']);

$filtered = $collection->pad(5, 0);

$filtered->all();

// ['A', 'B', 'C', 0, 0]

$filtered = $collection->pad(-5, 0);

$filtered->all();

// [0, 0, 'A', 'B', 'C']

partition()
Метод partition может быть объединен с функцией PHP list, чтобы отделить элементы, прошедшие данную проверку истинности, от тех, которые ее не прошли:
$collection = collect([1, 2, 3, 4, 5, 6]);

list($underThree, $equalOrAboveThree) = $collection->partition(function ($i) {
    return $i < 3;
});

$underThree->all();

// [1, 2]

$equalOrAboveThree->all();

// [3, 4, 5, 6]

pipe()

Метод pipe() передаёт коллекцию в функцию замыкание и возвращает результат:
PHP

$collection = collect([1, 2, 3]);

$piped = $collection->pipe(function ($collection) {
  return $collection->sum();
});

// 6


pipeInto()
Метод pipeInto создает новый экземпляр данного класса и передает коллекцию в конструктор:
class ResourceCollection
{
    /**
     * The Collection instance.
     */
    public $collection;

    /**
     * Create a new ResourceCollection instance.
     *
     * @param  Collection  $resource
     * @return void
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }
}

$collection = collect([1, 2, 3]);

$resource = $collection->pipeInto(ResourceCollection::class);

$resource->collection->all();

// [1, 2, 3]

pluck()

Метод pluck() извлекает все значения по заданному ключу:

 $collection = collect([
  ['product_id' => 'prod-100', 'name' => 'Desk'],
  ['product_id' => 'prod-200', 'name' => 'Chair'],
]);

$plucked = $collection->pluck('name');

$plucked->all();

// ['Desk', 'Chair']

Также вы можете указать, с каким ключом вы хотите получить коллекцию:

$plucked = $collection->pluck('name', 'product_id');

$plucked->all();

// ['prod-100' => 'Desk', 'prod-200' => 'Chair']

Метод pluck также поддерживает получение вложенных значений с использованием "точечной" нотации:
$collection = collect([
    [
        'speakers' => [
            'first_day' => ['Rosa', 'Judith'],
            'second_day' => ['Angela', 'Kathleen'],
        ],
    ],
]);

$plucked = $collection->pluck('speakers.first_day');

$plucked->all();

// ['Rosa', 'Judith']
Если существуют повторяющиеся ключи, последний соответствующий элемент будет вставлен в извлеченную коллекцию:
$collection = collect([
    ['brand' => 'Tesla',  'color' => 'red'],
    ['brand' => 'Pagani', 'color' => 'white'],
    ['brand' => 'Tesla',  'color' => 'black'],
    ['brand' => 'Pagani', 'color' => 'orange'],
]);

$plucked = $collection->pluck('color', 'brand');

$plucked->all();

// ['Tesla' => 'black', 'Pagani' => 'orange']

pop()
pop()

Метод pop() удаляет и возвращает последний элемент из коллекции:

$collection = collect([1, 2, 3, 4, 5]);

$collection->pop();

// 5

$collection->all();

// [1, 2, 3, 4]

prepend()

Метод prepend() добавляет элемент в начало коллекции:

$collection = collect([1, 2, 3, 4, 5]);

$collection->prepend(0);

$collection->all();

// [0, 1, 2, 3, 4, 5]

Вторым аргументом вы можете передать ключ добавляемого элемента

$collection = collect(['one' => 1, 'two', => 2]);

$collection->prepend(0, 'zero');

$collection->all();

// ['zero' => 0, 'one' => 1, 'two', => 2]

pull()

Метод pull() удаляет и возвращает элемент из коллекции по его ключу:

$collection = collect(['product_id' => 'prod-100', 'name' => 'Desk']);

$collection->pull('name');

// 'Desk'

$collection->all();

// ['product_id' => 'prod-100']

push()

Метод push() добавляет элемент в конец коллекции:

$collection = collect([1, 2, 3, 4]);

$collection->push(5);

$collection->all();

// [1, 2, 3, 4, 5]

put()

Метод put() устанавливает заданный ключ и значение в коллекцию:

$collection = collect(['product_id' => 1, 'name' => 'Desk']);

$collection->put('price', 100);

$collection->all();

// ['product_id' => 1, 'name' => 'Desk', 'price' => 100]

random()

Метод random() возвращает случайный элемент из коллекции:

$collection = collect([1, 2, 3, 4, 5]);

$collection->random();

// 4 - (получен в случайном порядке)

Также вы можете передать целое число в random(), чтобы указать, сколько случайных элементов необходимо получить. Если это число больше, чем 1, то возвращается коллекция элементов:
PHP

$random = $collection->random(3);

$random->all();

// [2, 4, 5] - (получены в случайном порядке)
Если в коллекции меньше элементов, чем запрошено, метод выдаст исключение InvalidArgumentException.


reduce()

Метод reduce() уменьшает коллекцию до одного значения, передавая результат каждой итерации в последующую итерацию:

$collection = collect([1, 2, 3]);

$total = $collection->reduce(function ($carry, $item) {
  return $carry + $item;
});

// 6

Значение для $carry в первой итерации — null. Тем не менее, вы можете указать его начальное значение во втором параметре метода reduce():

$collection->reduce(function ($carry, $item) {
  return $carry + $item;
}, 4);

// 10

reject()

Метод reject() фильтрует коллекцию, используя заданную функцию обратного вызова. Функция обратного вызова должна возвращать true для элементов, которые необходимо удалить из результирующей коллекции:
$collection = collect([1, 2, 3, 4]);

$filtered = $collection->reject(function ($value, $key) {
    return $value > 2;
});

$filtered->all();

// [1, 2]
Метод filter() — инверсный для метода reject().

replace()
Метод replace ведет себя аналогично merge; однако, помимо перезаписи совпадающих элементов строковыми ключами, метод replace также перезапишет элементы в коллекции, у которых есть совпадающие числовые ключи:
$collection = collect(['Taylor', 'Abigail', 'James']);

$replaced = $collection->replace([1 => 'Victoria', 3 => 'Finn']);

$replaced->all();

// ['Taylor', 'Victoria', 'James', 'Finn']

replaceRecursive()
Этот метод работает как replace, но он будет повторяться в массивах и применять тот же процесс замены к внутренним значениям:
$collection = collect(['Taylor', 'Abigail', ['James', 'Victoria', 'Finn']]);

$replaced = $collection->replaceRecursive(['Charlie', 2 => [1 => 'King']]);

$replaced->all();

// ['Charlie', 'Abigail', ['James', 'King', 'Finn']]

reverse()
reverse метод меняет порядок элементов коллекции на обратный, сохраняя исходные ключи:
$collection = collect(['a', 'b', 'c', 'd', 'e']);

$reversed = $collection->reverse();

$reversed->all();

/*
    [
        4 => 'e',
        3 => 'd',
        2 => 'c',
        1 => 'b',
        0 => 'a',
    ]
*/

search()

search()

Метод search() ищет в коллекции заданное значение и возвращает его ключ при успешном поиске. Если элемент не найден, то возвращается false.

$collection = collect([2, 4, 6, 8]);

$collection->search(4);

// 1

Поиск проводится с помощью «неточного» сравнения, то есть строка с числовым значением будет считаться равной числу с таким же значением. Чтобы использовать строгое сравнение, передайте true вторым параметром метода:

$collection->search('4', true);

// false

В качестве альтернативы, вы можете передать свою собственную функцию обратного вызова для поиска первого элемента, для которого выполняется ваше условие:

$collection->search(function ($item, $key) {
  return $item > 5;
});

// 2

shift()

Метод shift() удаляет и возвращает первый элемент из коллекции:
PHP

$collection = collect([1, 2, 3, 4, 5]);

$collection->shift();

// 1

$collection->all();

// [2, 3, 4, 5]

skip()

Метод skip возвращает новую коллекцию без первого заданного количества элементов:
collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$collection = $collection->skip(4);

$collection->all();

// [5, 6, 7, 8, 9, 10]

skipUntil()
Метод skipUntil пропускает элементы до тех пор, пока данный обратный вызов не вернет true, а затем вернет оставшиеся элементы в коллекции:
$collection = collect([1, 2, 3, 4]);

$subset = $collection->skipUntil(function ($item) {
    return $item >= 3;
});

$subset->all();

// [3, 4]
Вы также можете передать простое значение методу skipUntil, чтобы пропустить все элементы, пока не будет найдено заданное значение:
$collection = collect([1, 2, 3, 4]);

$subset = $collection->skipUntil(3);

$subset->all();

// [3, 4]
Если заданное значение не найдено или обратный вызов никогда не возвращает true, метод skipUntil вернет пустую коллекцию.

skipWhile()
Метод skipWhile пропускает элементы, пока данный обратный вызов возвращает true, а затем возвращает оставшиеся элементы в коллекции:
$collection = collect([1, 2, 3, 4]);

$subset = $collection->skipWhile(function ($item) {
    return $item <= 3;
});

$subset->all();

// [4]
Если обратный вызов никогда не возвращает истину, метод skipWhile вернет пустую коллекцию.

slice()

Метод slice() возвращает часть коллекции, начиная с заданного индекса:

$collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$slice = $collection->slice(4);

$slice->all();

// [5, 6, 7, 8, 9, 10]

Если вы хотите ограничить размер получаемой части коллекции, передайте желаемый размер вторым параметром в метод:

$slice = $collection->slice(4, 2);

$slice->all();

// [5, 6]

Возвращенный фрагмент по умолчанию сохраняет ключи. Если вы не хотите сохранять исходные ключи, вы можете использовать метод  values , чтобы переиндексировать их.

some()

Alias for the contains method.

sort()

Метод sort() сортирует коллекцию. Отсортированная коллекция сохраняет оригинальные ключи массива, поэтому в этом примере мы используем метод values() для сброса ключей и последовательной нумерации индексов:
PHP

$collection = collect([5, 3, 1, 2, 4]);

$sorted = $collection->sort();

$sorted->values()->all();

// [1, 2, 3, 4, 5]

Если ваши потребности в сортировке более сложные, вы можете передать обратный вызов для sort с помощью вашего собственного алгоритма. Обратитесь к документации PHP по uasort, который вызывает скрытый метод sort коллекции.

Для сортировки коллекции вложенных массивов или объектов, смотрите методы sortBy() и sortByDesc().

sortBy()

Метод sortBy() сортирует коллекцию по заданному ключу. Отсортированная коллекция сохраняет оригинальные ключи массива, поэтому в этом примере мы используем метод values() для сброса ключей и последовательной нумерации индексов:

$collection = collect([
  ['name' => 'Desk', 'price' => 200],
  ['name' => 'Chair', 'price' => 100],
  ['name' => 'Bookcase', 'price' => 150],
]);

$sorted = $collection->sortBy('price');

$sorted->values()->all();

/*
  [
    ['name' => 'Chair', 'price' => 100],
    ['name' => 'Bookcase', 'price' => 150],
    ['name' => 'Desk', 'price' => 200],
  ]
*/


Этот метод принимает флаги сортировки в качестве второго аргумента:
$collection = collect([
    ['title' => 'Item 1'],
    ['title' => 'Item 12'],
    ['title' => 'Item 3'],
]);

$sorted = $collection->sortBy('title', SORT_NATURAL);

$sorted->values()->all();

/*
    [
        ['title' => 'Item 1'],
        ['title' => 'Item 3'],
        ['title' => 'Item 12'],
    ]
*/
Также вы можете передать свою собственную функцию обратного вызова, чтобы определить, как сортировать значения коллекции:

$collection = collect([
  ['name' => 'Desk', 'colors' => ['Black', 'Mahogany']],
  ['name' => 'Chair', 'colors' => ['Black']],
  ['name' => 'Bookcase', 'colors' => ['Red', 'Beige', 'Brown']],
]);

$sorted = $collection->sortBy(function ($product, $key) {
  return count($product['colors']);
});

$sorted->values()->all();

/*
  [
    ['name' => 'Chair', 'colors' => ['Black']],
    ['name' => 'Desk', 'colors' => ['Black', 'Mahogany']],
    ['name' => 'Bookcase', 'colors' => ['Red', 'Beige', 'Brown']],
  ]
*/

sortByDesc()

Этот метод использует такую же сигнатуру, что и sortBy(), но будет сортировать коллекцию в обратном порядке.

sortDesc()
Этот метод сортирует коллекцию в порядке, обратном методу sort :
$collection = collect([5, 3, 1, 2, 4]);

$sorted = $collection->sortDesc();

$sorted->values()->all();

// [5, 4, 3, 2, 1]
В отличие от sort, вы не можете передавать обратный вызов sortDesc. Если вы хотите использовать обратный вызов, вы должны использовать sort и инвертировать сравнение.

sortKeys()
Метод sortKeys сортирует коллекцию по ключам базового ассоциативного массива:
$collection = collect([
    'id' => 22345,
    'first' => 'John',
    'last' => 'Doe',
]);

$sorted = $collection->sortKeys();

$sorted->all();

/*
    [
        'first' => 'John',
        'id' => 22345,
        'last' => 'Doe',
    ]
*/

sortKeysDesc()
Этот метод имеет ту же сигнатуру, что и метод sortKeys, но сортирует коллекцию в обратном порядке.


splice()

Метод splice() удаляет и возвращает часть элементов, начиная с заданного индекса:

$collection = collect([1, 2, 3, 4, 5]);

$chunk = $collection->splice(2);

$chunk->all();

// [3, 4, 5]

$collection->all();

// [1, 2]

Вы можете передать второй параметр в метод для ограничения размера возвращаемой части коллекции:

$collection = collect([1, 2, 3, 4, 5]);

$chunk = $collection->splice(2, 1);

$chunk->all();

// [3]

$collection->all();

// [1, 2, 4, 5]

Также вы можете передать в метод третий параметр, содержащий новые элементы, чтобы заменить элементы, которые будут удалены из коллекции:

$collection = collect([1, 2, 3, 4, 5]);

$chunk = $collection->splice(2, 1, [10, 11]);

$chunk->all();

// [3]

$collection->all();

// [1, 2, 10, 11, 4, 5]

+ 5.3

добавлено в 5.3 (28.01.2017)

split()

Метод split() разбивает коллекцию на заданное число групп:

$collection = collect([1, 2, 3, 4, 5]);

$groups = $collection->split(3);

$groups->toArray();

// [[1, 2], [3, 4], [5]]


splitIn()
Метод splitIn разбивает коллекцию на заданное количество групп, полностью заполняя нетерминальные группы перед выделением остатка последней группе:
$collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$groups = $collection->splitIn(3);

$groups->all();

// [[1, 2, 3, 4], [5, 6, 7, 8], [9, 10]]

sum()
sum()

Метод sum() возвращает сумму всех элементов в коллекции:

collect([1, 2, 3, 4, 5])->sum();

// 15

Если коллекция содержит вложенные массивы или объекты, вам нужно передать ключ для определения значений, которые нужно суммировать:

$collection = collect([
  ['name' => 'JavaScript: The Good Parts', 'pages' => 176],
  ['name' => 'JavaScript: The Definitive Guide', 'pages' => 1096],
]);

$collection->sum('pages');

// 1272

Также вы можете передать свою собственную функцию обратного вызова, чтобы определить, какие значения коллекции суммировать:

$collection = collect([
  ['name' => 'Chair', 'colors' => ['Black']],
  ['name' => 'Desk', 'colors' => ['Black', 'Mahogany']],
  ['name' => 'Bookcase', 'colors' => ['Red', 'Beige', 'Brown']],
]);

$collection->sum(function ($product) {
  return count($product['colors']);
});

// 6

take()

Метод take() возвращает новую коллекцию с заданным числом элементов:

$collection = collect([0, 1, 2, 3, 4, 5]);

$chunk = $collection->take(3);

chunk->all();

// [0, 1, 2]

Также вы можете передать отрицательное целое число, чтобы получить определенное количество элементов с конца коллекции:

$collection = collect([0, 1, 2, 3, 4, 5]);

$chunk = $collection->take(-2);

$chunk->all();

// [4, 5]


takeUntil()
Метод takeUntil возвращает элементы в коллекции до тех пор, пока данный обратный вызов не вернет true:
$collection = collect([1, 2, 3, 4]);

$subset = $collection->takeUntil(function ($item) {
    return $item >= 3;
});

$subset->all();

// [1, 2]
Вы также можете передать простое значение методу takeUntil, чтобы получать элементы, пока не будет найдено заданное значение:
$collection = collect([1, 2, 3, 4]);

$subset = $collection->takeUntil(3);

$subset->all();

// [1, 2]
Если данное значение не найдено или обратный вызов никогда не возвращает true, метод takeUntil вернет все элементы в коллекции.

takeWhile()
Метод takeWhile возвращает элементы в коллекции до тех пор, пока данный обратный вызов не вернет false:
$collection = collect([1, 2, 3, 4]);

$subset = $collection->takeWhile(function ($item) {
    return $item < 3;
});

$subset->all();

// [1, 2]
Если обратный вызов никогда не возвращает false, метод takeWhile вернет все элементы в коллекции.

tap()
Метод tap передает коллекцию заданному обратному вызову, позволяя вам «коснуться» коллекции в определенной точке и сделать что-то с элементами, не затрагивая саму коллекцию:
collect([2, 4, 3, 1, 5])
    ->sort()
    ->tap(function ($collection) {
        Log::debug('Values after sorting', $collection->values()->all());
    })
    ->shift();

// 1

times()
Метод static times создает новую коллекцию, вызывая обратный вызов заданное количество раз:
$collection = Collection::times(10, function ($number) {
    return $number * 9;
});

$collection->all();

// [9, 18, 27, 36, 45, 54, 63, 72, 81, 90]
This method can be useful when combined with factories to create Eloquent models:
$categories = Collection::times(3, function ($number) {
    return Category::factory()->create(['name' => "Category No. $number"]);
});

$categories->all();

/*
    [
        ['id' => 1, 'name' => 'Category No. 1'],
        ['id' => 2, 'name' => 'Category No. 2'],
        ['id' => 3, 'name' => 'Category No. 3'],
    ]
*/

toArray()

Метод toArray() преобразует коллекцию в простой PHP array. Если значения коллекции являются моделями Eloquent, то модели также будут преобразованы в массивы:

$collection = collect(['name' => 'Desk', 'price' => 200]);

$collection->toArray();

/*
  [
    ['name' => 'Desk', 'price' => 200],
  ]
*/

Метод toArray() также преобразует все вложенные объекты коллекции в массив. Если вы хотите получить базовый массив, используйте вместо этого метод all().

toJson()

Метод toJson() преобразует коллекцию в JSON:

$collection = collect(['name' => 'Desk', 'price' => 200]);

$collection->toJson();

// '{"name":"Desk", "price":200}'

transform()

Метод transform() перебирает коллекцию и вызывает заданную функцию обратного вызова для каждого элемента коллекции. Элементы коллекции будут заменены на значения, полученный из функции обратного вызова:

$collection = collect([1, 2, 3, 4, 5]);

$collection->transform(function ($item, $key) {
  return $item * 2;
});

$collection->all();

// [2, 4, 6, 8, 10]

В отличие от большинства других методов коллекции, transform() изменяет саму коллекцию. Если вместо этого вы хотите создать новую коллекцию, используйте метод map().
+ 5.3 5.2

добавлено в 5.3 (28.01.2017) 5.2 (08.12.2016)

union()

Метод union() добавляет данный массив в коллекцию. Если массив содержит ключи, которые уже есть в исходной коллекции, то будут оставлены значения исходной коллекции:

$collection = collect([1 => ['a'], 2 => ['b']]);

$union = $collection->union([3 => ['c'], 1 => ['b']]);

$union->all();

// [1 => ['a'], 2 => ['b'], [3 => ['c']]

unique()

Метод unique() возвращает все уникальные элементы в коллекции. Полученная коллекция сохраняет оригинальные ключи массива, поэтому в этом примере мы используем метод values() для сброса ключей и последовательной нумерации индексов:

$collection = collect([1, 1, 2, 2, 3, 4, 2]);

$unique = $collection->unique();

$unique->values()->all();

// [1, 2, 3, 4]

Имея дело со вложенными массивами или объектами, вы можете задать ключ, используемый для определения уникальности:

$collection = collect([
  ['name' => 'iPhone 6', 'brand' => 'Apple', 'type' => 'phone'],
  ['name' => 'iPhone 5', 'brand' => 'Apple', 'type' => 'phone'],
  ['name' => 'Apple Watch', 'brand' => 'Apple', 'type' => 'watch'],
  ['name' => 'Galaxy S6', 'brand' => 'Samsung', 'type' => 'phone'],
  ['name' => 'Galaxy Gear', 'brand' => 'Samsung', 'type' => 'watch'],
]);

$unique = $collection->unique('brand');

$unique->values()->all();

/*
  [
    ['name' => 'iPhone 6', 'brand' => 'Apple', 'type' => 'phone'],
    ['name' => 'Galaxy S6', 'brand' => 'Samsung', 'type' => 'phone'],
  ]
*/

Также вы можете передать свою собственную функцию обратного вызова, чтобы определять уникальность элементов:
PHP

$unique = $collection->unique(function ($item) {
  return $item['brand'].$item['type'];
});

$unique->values()->all();

/*
  [
    ['name' => 'iPhone 6', 'brand' => 'Apple', 'type' => 'phone'],
    ['name' => 'Apple Watch', 'brand' => 'Apple', 'type' => 'watch'],
    ['name' => 'Galaxy S6', 'brand' => 'Samsung', 'type' => 'phone'],
    ['name' => 'Galaxy Gear', 'brand' => 'Samsung', 'type' => 'watch'],
  ]
*/

unique метод использует "свободные" сравнения при проверке значений элементов, то есть строка с целым значением будет считаться равной целому числу того же значения. Используйте метод uniqueStrict для фильтрации с использованием «строгих» сравнений.

Поведение этого метода изменяется при использовании Eloquent Collections.

uniqueStrict()
Этот метод имеет ту же сигнатуру, что и unique метод; однако все значения сравниваются с использованием «строгих» сравнений.

если ()

Метод unless выполняет заданный обратный вызов, если первый аргумент, переданный методу, не имеет значения true:
$collection = collect([1, 2, 3]);

$collection->unless(true, function ($collection) {
    return $collection->push(4);
});

$collection->unless(false, function ($collection) {
    return $collection->push(5);
});

$collection->all();

// [1, 2, 3, 5]
when - оьратный метод.
unlessEmpty()
Alias for the whenNotEmpty method.

unlessNotEmpty()

Alias for the whenEmpty method.

unwrap()
Статический метод unwrap возвращает базовые элементы коллекции из заданного значения, когда это применимо:
Collection::unwrap(collect('John Doe'));

// ['John Doe']

Collection::unwrap(['John Doe']);

// ['John Doe']

Collection::unwrap('John Doe');

// 'John Doe'

values()
values()

Метод values() возвращает новую коллекцию со сброшенными ключами и последовательно пронумерованными индексами:
PHP

$collection = collect([
  10 => ['product' => 'Desk', 'price' => 200],
  11 => ['product' => 'Desk', 'price' => 200]
]);

$values = $collection->values();

$values->all();

/*
  [
    0 => ['product' => 'Desk', 'price' => 200],
    1 => ['product' => 'Desk', 'price' => 200],
  ]
*/


when()
Метод when выполнит заданный обратный вызов, когда первый аргумент, переданный методу, будет иметь значение true:
$collection = collect([1, 2, 3]);

$collection->when(true, function ($collection) {
    return $collection->push(4);
});

$collection->when(false, function ($collection) {
    return $collection->push(5);
});

$collection->all();

// [1, 2, 3, 4]
unless - обратны метод


whenEmpty()
Метод whenEmpty выполнит указанный обратный вызов, когда коллекция пуста:
$collection = collect(['michael', 'tom']);

$collection->whenEmpty(function ($collection) {
    return $collection->push('adam');
});

$collection->all();

// ['michael', 'tom']

$collection = collect();

$collection->whenEmpty(function ($collection) {
    return $collection->push('adam');
});

$collection->all();

// ['adam']

$collection = collect(['michael', 'tom']);

$collection->whenEmpty(function ($collection) {
    return $collection->push('adam');
}, function ($collection) {
    return $collection->push('taylor');
});

$collection->all();

// ['michael', 'tom', 'taylor']

For the inverse of whenEmpty, see the whenNotEmpty method.

whenNotEmpty()
Метод whenNotEmpty выполнит данный обратный вызов, если коллекция не пуста:
$collection = collect(['michael', 'tom']);

$collection->whenNotEmpty(function ($collection) {
    return $collection->push('adam');
});

$collection->all();

// ['michael', 'tom', 'adam']

$collection = collect();

$collection->whenNotEmpty(function ($collection) {
    return $collection->push('adam');
});

$collection->all();

// []

$collection = collect();

$collection->whenNotEmpty(function ($collection) {
    return $collection->push('adam');
}, function ($collection) {
    return $collection->push('taylor');
});

$collection->all();

// ['taylor']

For the inverse of whenNotEmpty, see the whenEmpty method.

where()
where()

Метод where() фильтрует коллекцию по заданной паре ключ/значение:

$collection = collect([
  ['product' => 'Desk', 'price' => 200],
  ['product' => 'Chair', 'price' => 100],
  ['product' => 'Bookcase', 'price' => 150],
  ['product' => 'Door', 'price' => 100],
]);

$filtered = $collection->where('price', 100);

$filtered->all();

/*
[
  ['product' => 'Chair', 'price' => 100],
  ['product' => 'Door', 'price' => 100],
]
*/

+ 5.3

добавлено в 5.3 (28.01.2017)

Метод where() использует «неточное» сравнение при проверке значений элементов. Используйте метод whereStrict() для фильтрации с использованием строгого сравнения.


При желании вы можете передать оператор сравнения в качестве второго параметра.
$collection = collect([
    ['name' => 'Jim', 'deleted_at' => '2019-01-01 00:00:00'],
    ['name' => 'Sally', 'deleted_at' => '2019-01-02 00:00:00'],
    ['name' => 'Sue', 'deleted_at' => null],
]);

$filtered = $collection->where('deleted_at', '!=', null);

$filtered->all();

/*
    [
        ['name' => 'Jim', 'deleted_at' => '2019-01-01 00:00:00'],
        ['name' => 'Sally', 'deleted_at' => '2019-01-02 00:00:00'],
    ]
*/

whereStrict()
Этот метод имеет такую же сигнатуру, что и метод where(). Однако, все значения сравниваются с использованием строгого сравнения.
whereBetween()
Метод whereBetween фильтрует коллекцию в заданном диапазоне:
$collection = collect([
    ['product' => 'Desk', 'price' => 200],
    ['product' => 'Chair', 'price' => 80],
    ['product' => 'Bookcase', 'price' => 150],
    ['product' => 'Pencil', 'price' => 30],
    ['product' => 'Door', 'price' => 100],
]);

$filtered = $collection->whereBetween('price', [100, 200]);

$filtered->all();

/*
    [
        ['product' => 'Desk', 'price' => 200],
        ['product' => 'Bookcase', 'price' => 150],
        ['product' => 'Door', 'price' => 100],
    ]
*/

whereIn()

Метод whereIn() фильтрует коллекцию по заданным ключу/значению, содержащимся в данном массиве.

$collection = collect([
  ['product' => 'Desk', 'price' => 200],
  ['product' => 'Chair', 'price' => 100],
  ['product' => 'Bookcase', 'price' => 150],
  ['product' => 'Door', 'price' => 100],
]);

$filtered = $collection->whereIn('price', [150, 200]);

$filtered->all();

/*
[
  ['product' => 'Bookcase', 'price' => 150],
  ['product' => 'Desk', 'price' => 200],
]
*/

+ 5.3

добавлено в 5.3 (28.01.2017)

Метод whereIn() использует «неточное» сравнение при проверке значений элементов. Используйте метод whereInStrict() для фильтрации с использованием строгого сравнения.

whereInStrict()

Этот метод имеет такую же сигнатуру, что и метод whereIn(). Однако, все значения сравниваются с использованием строгого сравнения.

whereInstanceOf()
Метод whereInstanceOf фильтрует коллекцию по заданному типу класса:
use App\Models\User;
use App\Models\Post;

$collection = collect([
    new User,
    new User,
    new Post,
]);

$filtered = $collection->whereInstanceOf(User::class);

$filtered->all();

// [App\Models\User, App\Models\User]

whereNotBetween()
Метод whereNotBetween фильтрует коллекцию в заданном диапазоне:
$collection = collect([
    ['product' => 'Desk', 'price' => 200],
    ['product' => 'Chair', 'price' => 80],
    ['product' => 'Bookcase', 'price' => 150],
    ['product' => 'Pencil', 'price' => 30],
    ['product' => 'Door', 'price' => 100],
]);

$filtered = $collection->whereNotBetween('price', [100, 200]);

$filtered->all();

/*
    [
        ['product' => 'Chair', 'price' => 80],
        ['product' => 'Pencil', 'price' => 30],
    ]
*/

whereNotIn()
Метод whereNotIn фильтрует коллекцию по заданному ключу / значению, не содержащемуся в данном массиве
$collection = collect([
    ['product' => 'Desk', 'price' => 200],
    ['product' => 'Chair', 'price' => 100],
    ['product' => 'Bookcase', 'price' => 150],
    ['product' => 'Door', 'price' => 100],
]);

$filtered = $collection->whereNotIn('price', [150, 200]);

$filtered->all();

/*
    [
        ['product' => 'Chair', 'price' => 100],
        ['product' => 'Door', 'price' => 100],
    ]
*/
Метод whereNotIn использует «свободные» сравнения при проверке значений элементов, то есть строка с целым значением будет считаться равной целому числу того же значения. Используйте метод whereNotInStrict для фильтрации с использованием «строгих» сравнений.

whereNotInStrict() ()

Этот метод имеет ту же сигнатуру, что и метод whereNotIn; однако все значения сравниваются с использованием «строгих» сравнений.

whereNotNull()
Метод whereNotNull фильтрует элементы, для которых заданный ключ не равен нулю:
collection = collect([
    ['name' => 'Desk'],
    ['name' => null],
    ['name' => 'Bookcase'],
]);

$filtered = $collection->whereNotNull('name');

$filtered->all();

/*
    [
        ['name' => 'Desk'],
        ['name' => 'Bookcase'],
    ]
*/

whereNull()
Метод whereNull фильтрует элементы, для которых заданный ключ равен нулю:
$collection = collect([
    ['name' => 'Desk'],
    ['name' => null],
    ['name' => 'Bookcase'],
]);

$filtered = $collection->whereNull('name');

$filtered->all();

/*
    [
        ['name' => null],
    ]
*/

wrap()
Статический метод wrap обертывает данное значение в коллекцию, когда это применимо:
$collection = Collection::wrap('John Doe');

$collection->all();

// ['John Doe']

$collection = Collection::wrap(['John Doe']);

$collection->all();

// ['John Doe']

$collection = Collection::wrap(collect('John Doe'));

$collection->all();

// ['John Doe']

zip()

Метод zip() объединяет все значения заданного массива со значениями исходной коллекции на соответствующем индексе:
PHP

$collection = collect(['Chair', 'Desk']);

$zipped = $collection->zip([100, 200]);

$zipped->all();

// [['Chair', 100], ['Desk', 200]]



Сообщения высшего порядка
Коллекции также обеспечивают поддержку «сообщений более высокого порядка», которые являются сокращениями для выполнения общих действий с коллекциями. Методы сбора, которые предоставляют сообщения более высокого порядка, следующие: average, avg, contains, each, every, filter, first, flatMap, groupBy, keyBy, map, max, min, partition, reject, skipUntil, skipWhile, some, sortBy, sortByDesc, sum, takeUntil, takeWhile и уникальный.

К каждому сообщению более высокого порядка можно получить доступ как к динамическому свойству экземпляра коллекции. Например, давайте использовать each сообщение более высокого порядка для вызова метода для каждого объекта в коллекции:
$users = User::where('votes', '>', 500)->get();

$users->each->markAsVip();
Точно так же мы можем использовать сообщение высшего порядка sum, чтобы собрать общее количество «голосов» для набора пользователей:
$users = User::where('group', 'Development')->get();

return $users->sum->votes;

Ленивые коллекции

Введение
Прежде чем узнать больше о ленивых коллекциях Laravel, найдите время, чтобы познакомиться с генераторами PHP.

Чтобы дополнить и без того мощный класс Collection, класс LazyCollection использует генераторы PHP, чтобы вы могли работать с очень большими наборами данных, сохраняя при этом низкий уровень использования памяти.

Например, представьте, что ваше приложение должно обрабатывать файл журнала размером в несколько гигабайт, используя при этом методы сбора данных Laravel для анализа журналов. Вместо того, чтобы читать весь файл в память сразу, можно использовать ленивые коллекции, чтобы сохранить в памяти только небольшую часть файла в данный момент:

use App\Models\LogEntry;
use Illuminate\Support\LazyCollection;

LazyCollection::make(function () {
    $handle = fopen('log.txt', 'r');

    while (($line = fgets($handle)) !== false) {
        yield $line;
    }
})->chunk(4)->map(function ($lines) {
    return LogEntry::fromLines($lines);
})->each(function (LogEntry $logEntry) {
    // Process the log entry...
});
Или представьте, что вам нужно перебрать 10 000 моделей Eloquent. При использовании традиционных коллекций Laravel все 10 000 моделей Eloquent должны быть загружены в память одновременно:
$users = App\Models\User::all()->filter(function ($user) {
    return $user->id > 500;
});
Однако метод cursor построителя запросов возвращает экземпляр LazyCollection. Это позволяет вам по-прежнему выполнять только один запрос к базе данных, но при этом одновременно загружать в память только одну модель Eloquent. В этом примере обратный вызов filter не выполняется до тех пор, пока мы фактически не перебираем каждого пользователя индивидуально, что позволяет резко сократить использование памяти:
$users = App\Models\User::cursor()->filter(function ($user) {
    return $user->id > 500;
});

foreach ($users as $user) {
    echo $user->id;
}

Создание ленивых коллекций

Чтобы создать экземпляр ленивой коллекции, вы должны передать функцию генератора PHP методу make коллекции:
use Illuminate\Support\LazyCollection;

LazyCollection::make(function () {
    $handle = fopen('log.txt', 'r');

    while (($line = fgets($handle)) !== false) {
        yield $line;
    }
});

Перечислимый договор
Почти все методы, доступные в классе Collection, также доступны в классе LazyCollection. Оба этих класса реализуют контракт Illuminate \ Support \ Enumerable, который определяет методы выше, которые я писал.

Методы, которые изменяют коллекцию (такие как shift, pop, prepend и т. Д.), Недоступны в классе LazyCollection.


Методы ленивой коллекции
Помимо методов, определенных в контракте Enumerable, класс LazyCollection содержит следующие методы:

tapEach()
В то время как each метод вызывает данный обратный вызов для каждого элемента в коллекции сразу же, метод tapEach вызывает только данный обратный вызов, поскольку элементы извлекаются из списка один за другим:
$lazyCollection = LazyCollection::times(INF)->tapEach(function ($value) {
    dump($value);
});

// Nothing has been dumped so far...

$array = $lazyCollection->take(3)->all();

// 1
// 2
// 3

remember()
Метод Remember возвращает новую ленивую коллекцию, которая запоминает любые значения, которые уже были перечислены, и не будет извлекать их снова при повторном перечислении коллекции:
$users = User::cursor()->remember();

// No query has been executed yet...

$users->take(5)->all();

// The query has been executed and the first 5 users have been hydrated from the database...

$users->take(20)->all();

// First 5 users come from the collection's cache... The rest are hydrated from the database...





<h4 class="theme_subtitlex2"></h4>
<p class="theme__text"></p>
<code>
<pre>
</pre>
</code>
<p class="theme__text"></p>
<code>
<pre>
</pre>
</code>
<p class="theme__text"></p>
<code>
<pre>
</pre>
</code>
<p class="theme__text"></p>
<code>
<pre>
</pre>
</code>
    </div>
    <div class="theme">
        <h2 class="theme__title">
            События
        </h2>
События в Laravel представлены реализацией паттерна Observer, что позволяет вам подписываться и прослушивать различные события, возникающие в вашем приложения. Как правило, классы событий находятся в папке app/Events, а классы обработчиков событий — в app/Listeners. Если у вас нет этих папок, не переживайте, они будут созданы при создании событий и слушателей с помощью Artisan-команд.

События — отличный способ для разделения различных аспектов вашего приложения, поскольку одно событие может иметь несколько слушателей, независящих друг от друга. Например, вы можете отправлять пользователю Slack-уведомление каждый раз, когда заказ доставлен. Вместо привязки кода обработки заказа к коду Slack-уведомления вы можете просто создать событие OrderShipped, которое сможет получить слушатель и преобразовать в Slack-уведомление.

Регистрация событий и слушателей
Сервис-провайдер EventServiceProvider, включённый в ваше Laravel приложение, предоставляет удобное место для регистрации всех слушателей событий. Свойство listen содержит массив всех событий (ключей) и их слушателей (значения). Конечно, вы можете добавить столько событий в этот массив, сколько требуется вашему приложению. Например, давайте добавим событие OrderShipped:

/**
 * Слушатель события в вашем приложении.
 *
 * @var array
 */
protected $listen = [
  'App\Events\OrderShipped' => [
    'App\Listeners\SendShipmentNotification',
  ],
];

Генерация классов событий и слушателей

Конечно, вручную создавать файлы для каждого события и слушателя затруднительно. Вместо этого добавьте слушателей и события в ваш EventServiceProvider и используйте команду event:generate. Эта команда сгенерирует все события и слушателей, которые перечислены в вашем EventServiceProvider.
Конечно, уже существующие события и слушатели останутся нетронутыми:

php artisan event:generate

Регистрация событий вручную
Как правило, события должны регистрироваться через массив $listen в EventServiceProvider.
Однако, также вы можете вручную регистрировать события на основе замыканий в методе boot() вашего EventServiceProvider:
use App\Events\PodcastProcessed;

/**
 * Register any other events for your application.
 *
 * @return void
 */
public function boot()
{
    Event::listen(function (PodcastProcessed $event) {
        //
    });
}

Слушатели анонимных событий в очереди
При регистрации слушателей событий вручную вы можете заключить закрытие слушателя в функцию Illuminate \ Events \ queueable, чтобы дать Laravel команду выполнить слушателя с использованием очереди:
use App\Events\PodcastProcessed;
use function Illuminate\Events\queueable;
use Illuminate\Support\Facades\Event;

/**
 * Register any other events for your application.
 *
 * @return void
 */
public function boot()
{
    Event::listen(queueable(function (PodcastProcessed $event) {
        //
    }));
}
Как и задания в очереди, вы можете использовать методы onConnection, onQueue и delay для настройки выполнения прослушивателя в очереди:
Event::listen(queueable(function (PodcastProcessed $event) {
    //
})->onConnection('redis')->onQueue('podcasts')->delay(now()->addSeconds(10)));
Если вы хотите обрабатывать сбои анонимного прослушивателя в очереди, вы можете предоставить Closure для метода catch при определении ожидающего в очереди прослушивателя (queueable listener):
use App\Events\PodcastProcessed;
use function Illuminate\Events\queueable;
use Illuminate\Support\Facades\Event;
use Throwable;

Event::listen(queueable(function (PodcastProcessed $event) {
    //
})->catch(function (PodcastProcessed $event, Throwable $e) {
    // The queued listener failed...
}));

Слушатели событий по маске

Вы даже можете регистрировать слушателей, используя символ * как маску, что позволит вам поймать несколько событий для одного слушателя. Такой метод вернёт весь массив данных событий одним параметром:
Вы даже можете зарегистрировать слушателей, используя * в качестве подстановочного параметра, что позволит вам перехватывать несколько событий на одном слушателе. Слушатели подстановочных знаков получают имя события в качестве своего первого аргумента и весь массив данных события в качестве второго аргумента:
Event::listen('event.*', function ($eventName, array $data) {
    //
});

Обнаружение событий
Вместо того, чтобы вручную регистрировать события и прослушиватели в массиве $ listen объекта EventServiceProvider, вы можете включить автоматическое обнаружение событий. Когда обнаружение событий включено, Laravel автоматически найдет и зарегистрирует ваши события и слушателей, сканируя каталог Listeners вашего приложения. Кроме того, любые явно определенные события, перечисленные в EventServiceProvider, по-прежнему будут регистрироваться.

Laravel находит слушателей событий, сканируя классы слушателей с помощью отражения. Когда Laravel находит какой-либо метод класса слушателя, который начинается с handle, Laravel зарегистрирует эти методы как слушатели событий для события, тип которого указан в сигнатуре метода:
use App\Events\PodcastProcessed;

class SendPodcastProcessedNotification
{
    /**
     * Handle the given event.
     *
     * @param  \App\Events\PodcastProcessed
     * @return void
     */
    public function handle(PodcastProcessed $event)
    {
        //
    }
}
Обнаружение событий по умолчанию отключено, но вы можете включить его, переопределив метод shouldDiscoverEvents объекта EventServiceProvider вашего приложения:
/**
 * Determine if events and listeners should be automatically discovered.
 *
 * @return bool
 */
public function shouldDiscoverEvents()
{
    return true;
}
По умолчанию все слушатели в каталоге Listeners вашего приложения будут сканироваться. Если вы хотите определить дополнительные каталоги для сканирования, вы можете переопределить метод discoverEventsWithin в своем EventServiceProvider:
/**
 * Get the listener directories that should be used to discover events.
 *
 * @return array
 */
protected function discoverEventsWithin()
{
    return [
        $this->app->path('Listeners'),
    ];
}
В производственной среде вы, вероятно, не хотите, чтобы фреймворк сканировал всех ваших слушателей при каждом запросе. Следовательно, в процессе развертывания вы должны запустить Artisan-команду event: cache, чтобы кэшировать манифест всех событий и слушателей вашего приложения. Этот манифест будет использоваться платформой для ускорения процесса регистрации события. Команда event: clear может использоваться для уничтожения кеша.

Команду event: list можно использовать для отображения списка всех событий и слушателей, зарегистрированных вашим приложением.

Определение событий

Класс события — это просто контейнер данных, содержащий информацию, которая относится к событию.
+ 5.3

добавлено в 5.3 (28.01.2017)

Например, предположим, что наше сгенерированное событие OrderShipped принимает объект Eloquent ORM:
namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderShipped
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
Как видите, этот класс события не содержит никакой логики. Это просто контейнер для объекта Order. Типаж SerializesModels, используемый событием, корректно сериализирует любые Eloquent модели, если объект события будет сериализирован php-функцией serialize().


Определение слушателей
Теперь давайте взглянем на слушателя для нашего примера события. Слушатели событий принимают экземпляр события в свой метод handle(). Команда event:generate автоматически импортирует класс события и указывает тип события в метод handle(). В методе handle() вы можете выполнять любые действия, необходимые для ответа на событие.
namespace App\Listeners;

use App\Events\OrderShipped;

class SendShipmentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        // Access the order using $event->order...
    }
}
Ваши слушатели события могут также указывать тип любых зависимостей, которые необходимы для их конструкторов. Все слушатели события доступны через сервис-контейнер Laravel, поэтому зависимости будут инъецированы автоматически.
Остановка распространения события

Иногда, вам необходимо остановить распространение события для других слушателей. Вы можете сделать это, возвратив false из метода handle() вашего слушателя.


Слушатели события в очереди
Слушатели события в очереди

Поместить слушателя в очередь может быть полезно, если ваш слушатель будет выполнять медленную задачу, например, отправку e-mail или выполнение HTTP-запроса. Прежде чем помещать слушателей в очередь, не забудьте настроить вашу очередь и запустить слушателя очереди на вашем сервере или в локальной среде разработки.

Чтобы указать, что слушатель должен быть поставлен в очередь, добавьте интерфейс ShouldQueue в класс слушателя. В слушателях, сгенерированных Artisan-командой event:generate, уже импортирован этот интерфейс в текущее пространство имен. Так что вы можете сразу использовать его:



namespace App\Listeners;

use App\Events\OrderShipped;
// для версии 5.1 и ранее:
// use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendShipmentNotification implements ShouldQueue
{
  //
}

Вот и всё! Теперь, когда этого слушателя вызывают для события, он будет автоматически поставлен в очередь диспетчером события, использующим систему очереди Laravel. Если никакие исключения не будут выброшены, когда слушатель выполняется из очереди, то задача в очереди будет автоматически удалена после завершения её выполнения.

Настройка подключения к очереди и имени очереди
Если вы хотите настроить соединение очереди, имя очереди или время задержки очереди прослушивателя событий, вы можете определить свойства $ connection, $ queue или $ delay в своем классе прослушивателя:
namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendShipmentNotification implements ShouldQueue
{
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'sqs';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'listeners';

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 60;
}
Если вы хотите определить очередь слушателя во время выполнения, вы можете определить метод viaQueue в слушателе:
/**
 * Get the name of the listener's queue.
 *
 * @return string
 */
public function viaQueue()
{
    return 'listeners';
}
Условно стоящие в очереди слушатели

Иногда вам может потребоваться определить, следует ли ставить слушателя в очередь на основе некоторых данных, доступных только во время выполнения. Для этого к слушателю может быть добавлен метод shouldQueue, чтобы определить, следует ли поставить слушателя в очередь. Если метод shouldQueue возвращает false, слушатель не будет выполнен:
namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;

class RewardGiftCard implements ShouldQueue
{
    /**
     * Reward a gift card to the customer.
     *
     * @param  \App\Events\OrderPlaced  $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        //
    }

    /**
     * Determine whether the listener should be queued.
     *
     * @param  \App\Events\OrderPlaced  $event
     * @return bool
     */
    public function shouldQueue(OrderPlaced $event)
    {
        return $event->order->subtotal >= 5000;
    }
}

Ручной доступ к очереди

Если вам необходимо вручную получить доступ к базовым методам очереди слушателя delete() и release(), вы можете сделать это с помощью типажа Illuminate\Queue\InteractsWithQueue. Этот типаж по умолчанию импортирован в сгенерированные слушатели и предоставляет доступ к этим методам:
PHP
namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendShipmentNotification implements ShouldQueue
{
  use InteractsWithQueue;

  public function handle(OrderShipped $event)
  {
    if (true) {
      $this->release(30);
    }
  }
}

Обработка невыполненных заданий
Иногда ваши прослушиватели событий в очереди могут дать сбой. Если прослушиватель в очереди превышает максимальное количество попыток, определенное вашим обработчиком очереди, на вашем прослушивателе будет вызван failed метод. failed метод получает экземпляр события и исключение, вызвавшее сбой:
namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendShipmentNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        //
    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\OrderShipped  $event
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(OrderShipped $event, $exception)
    {
        //
    }
}
Запуск событий
+ 5.3

добавлено в 5.3 (28.01.2017)

Чтобы запустить событие, вы можете передать экземпляр события во вспомогательный метод event(). Этот метод распространит событие для всех его зарегистрированных слушателей. Поскольку метод event() доступен глобально, вы можете вызвать его из любого места вашего приложения:
namespace App\Http\Controllers;

use App\Order;
use App\Events\OrderShipped;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
  /**
   * Доставка данного заказа.
   *
   * @param  int  $orderId
   * @return Response
   */
  public function ship($orderId)
  {
    $order = Order::findOrFail($orderId);

    // Логика доставки заказа...

    event(new OrderShipped($order));
  }
}
В качестве альтернативы, если ваше событие использует черту Illuminate \ Foundation \ Events \ Dispatchable, вы можете вызвать статический метод dispatch для события. Любые аргументы, переданные методу dispatch, будут переданы конструктору события:
OrderShipped::dispatch($order);
При тестировании может быть полезным проверка запуска некоторых событий без уведомления их слушателей. в этом вам помогут встроенные вспомогательные функции для тестирования Laravel.


Подписчики событий
Написание подписчиков событий

Подписчики событий — это классы, которые могут подписаться на множество событий из самого класса, что позволяет вам определить несколько обработчиков событий в одном классе. Подписчики должны определить метод subscribe(), в который будет передан экземпляр диспетчера события. Вы можете вызвать метод listen() на данном диспетчере для регистрации слушателей события:
namespace App\Listeners;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleUserLogin($event) {}

    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event) {}

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            [UserEventSubscriber::class, 'handleUserLogin']
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            [UserEventSubscriber::class, 'handleUserLogout']
        );
    }
}
В качестве альтернативы метод subscribe вашего подписчика может возвращать массив событий для сопоставлений обработчиков. В этом случае сопоставления слушателей событий будут зарегистрированы для вас автоматически:
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

/**
 * Register the listeners for the subscriber.
 *
 * @return array
 */
public function subscribe()
{
    return [
        Login::class => [
            [UserEventSubscriber::class, 'handleUserLogin']
        ],

        Logout::class => [
            [UserEventSubscriber::class, 'handleUserLogout']
        ],
    ];
}
Регистрация подписчика события

После написания подписчика, вы можете зарегистрировать его в диспетчере события. Вы можете зарегистрировать подписчиков, используя свойство $subscribe в EventServiceProvider. Например, давайте добавим UserEventSubscriber.
PHP

namespace App\Providers;

//для версии 5.2 и ранее:
//use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
  /**
   * Привязки слушателя события для приложения.
   *
   * @var array
   */
  protected $listen = [
    //
  ];

  /**
   * Классы подписчиков для регистрации.
   *
   * @var array
   */
  protected $subscribe = [
    'App\Listeners\UserEventSubscriber',
  ];
}
    </div>
    <div class="theme">
        <h2 class="theme__title">Файловая система </h2>
Laravel предоставляет мощную абстракцию для работы с файловой системой благодаря восхитительному PHP-пакету Flysystem от Франка де Жонге. Laravel Flysystem содержит простые в использовании драйвера для работы с локальными файловыми системами, Amazon S3 и Rackspace Cloud Storage. Более того, можно очень просто переключаться между этими вариантами хранения файлов, поскольку у всех одинаковый API.
Настройка

Настройки файловой системы находятся в файле config/filesystems.php. В нём вы можете настроить все свои «disks». Каждый диск представляет определенный драйвер и место хранения. В конфигурационном файле имеются примеры для каждого поддерживаемого драйвера. Поэтому вы можете просто немного изменить конфигурацию под ваши нужды!

Конечно, вы можете сконфигурировать столько дисков, сколько вам будет угодно, и даже можете иметь несколько дисков, которые используют один драйвер.
+ 5.3 5.2

добавлено в 5.3 (28.01.2017) 5.2 (08.12.2016)
Общий диск

Диск public предназначен для общего доступа к файлам. По умолчанию диск public использует драйвер local и хранит файлы в storage/app/public. Чтобы сделать их доступными через веб, вам надо создать символьную ссылку из public/storage на storage/app/public. При этом ваши общедоступные файлы будут храниться в одной папке, которую легко можно использовать в разных развёртываниях при использовании систем обновления на лету, таких как Envoyer.

Для создания символьной ссылки используйте Artisan-команду storage:link:

php artisan storage:link

Само собой, когда файл сохранён и создана символьная ссылка, вы можете создать URL к файлу с помощью вспомогательной функции asset():
PHP

echo asset('storage/file.txt');

Вы можете настроить дополнительные символические ссылки в файле конфигурации filesystems. Каждая из настроенных ссылок будет создана при запуске команды storage: link:
'links' => [
    public_path('storage') => storage_path('app/public'),
    public_path('images') => storage_path('app/images'),
],

Драйвер local

При использовании драйвера local все файловые операции выполняются относительно каталога root, определенного в вашем конфигурационном файле. По умолчанию это каталог storage/app. Поэтому следующий метод сохранит файл в storage/app/file.txt:

Storage::disk('local')->put('file.txt', 'Contents');
Разрешения
public видимость переводится в 0755 для каталогов и 0644 для файлов. Вы можете изменить сопоставление разрешений в файле конфигурации filesystems:

'local' => [
    'driver' => 'local',
    'root' => storage_path('app'),
    'permissions' => [
        'file' => [
            'public' => 0664,
            'private' => 0600,
        ],
        'dir' => [
            'public' => 0775,
            'private' => 0700,
        ],
    ],
],

Требования к драйверам

Пакеты Composer
Перед использованием драйверов SFTP или S3 вам необходимо установить соответствующий пакет через Composer:

SFTP: league/flysystem-sftp ~1.0
Amazon S3: league/flysystem-aws-s3-v3 ~1.0

Абсолютной необходимостью для повышения производительности является использование кэшированного адаптера. Для этого вам понадобится дополнительный пакет:
CachedAdapter: league/flysystem-cached-adapter ~1.0

Конфигурация драйвера S3
Информация о конфигурации драйвера S3 находится в вашем файле конфигурации config / filesystems.php. Этот файл содержит пример массива конфигурации для драйвера S3. Вы можете изменить этот массив своей собственной конфигурацией S3 и учетными данными. Для удобства эти переменные среды соответствуют соглашению об именах, используемому в интерфейсе командной строки AWS.

Конфигурация драйвера FTP
Интеграция Laravel's Flysystem отлично работает с FTP; однако образец конфигурации не включен в файл конфигурации по умолчанию filesystems.php фреймворка. Если вам нужно настроить файловую систему FTP, вы можете использовать пример конфигурации ниже:
'ftp' => [
    'driver' => 'ftp',
    'host' => 'ftp.example.com',
    'username' => 'your-username',
    'password' => 'your-password',

    // Optional FTP Settings...
    // 'port' => 21,
    // 'root' => '',
    // 'passive' => true,
    // 'ssl' => true,
    // 'timeout' => 30,
],

Конфигурация драйвера SFTP
Интеграция Laravel's Flysystem отлично работает с SFTP; однако образец конфигурации не включен в файл конфигурации по умолчанию filesystems.php фреймворка. Если вам нужно настроить файловую систему SFTP, вы можете использовать пример конфигурации ниже:
'sftp' => [
    'driver' => 'sftp',
    'host' => 'example.com',
    'username' => 'your-username',
    'password' => 'your-password',

    // Settings for SSH key based authentication...
    // 'privateKey' => '/path/to/privateKey',
    // 'password' => 'encryption-password',

    // Optional SFTP Settings...
    // 'port' => 22,
    // 'root' => '',
    // 'timeout' => 30,
],

Кеширование

Чтобы включить кеширование для данного диска, вы можете добавить директиву cache в параметры конфигурации диска. Параметр cache должен быть массивом параметров кеширования, содержащим имя disk, expire в секундах и prefix кеша:
's3' => [
    'driver' => 's3',

    // Other Disk Options...

    'cache' => [
        'store' => 'memcached',
        'expire' => 600,
        'prefix' => 'cache-prefix',
    ],
],


Получение экземпляров дисков

Для взаимодействия с любым из ваших сконфигурированных дисков можно использовать фасад Storage. Например, вы можете использовать метод этого фасада put(), чтобы сохранить аватар на диск по умолчанию. Если вы вызовите метод фасада Storage без предварительного вызова метода disk(), то вызов метода будет автоматически передан диску по умолчанию:
+ 5.3

добавлено в 5.3 (28.01.2017)
PHP

use Illuminate\Support\Facades\Storage;

Storage::put('avatars/1', $fileContents);

При использовании нескольких дисков вы можете обращаться к нужному диску с помощью метода disk() фасада Storage:

Storage::disk('s3')->put('avatars/1', $fileContents);

Чтение файлов

Методом get() можно получать содержимое файла. Он возвращает сырую строку содержимого файла. Не забывайте, все пути файлов необходимо указывать относительно настроенного для диска «корня»:

$contents = Storage::get('file.jpg');

+ 5.3 5.2 5.0

добавлено в 5.3 (28.01.2017) 5.2 (08.12.2016) 5.0 (08.02.2016)

Методом exists() можно определить существование файла на диске:

$exists = Storage::disk('s3')->exists('file.jpg');

Метод missing может использоваться для определения отсутствия файла на диске:
$missing = Storage::disk('s3')->missing('file.jpg');


Скачивание файлов

Метод download может использоваться для генерации ответа, который заставляет браузер пользователя загружать файл по заданному пути. Метод download принимает имя файла в качестве второго аргумента метода, который будет определять имя файла, которое видит пользователь, загружающий файл. Наконец, вы можете передать массив заголовков HTTP в качестве третьего аргумента метода:
return Storage::download('file.jpg');

return Storage::download('file.jpg', $name, $headers);

URL файла

При использовании драйвера local или s3 вы можете использовать метод url() для получения URL для файла. При использовании драйвера local в начало пути к файлу будет просто подставлено /storage, и будет возвращён относительный URL. При использовании драйвера s3 будет возвращён полный удалённый URL:

use Illuminate\Support\Facades\Storage;

$url = Storage::url('file1.jpg');

При использовании драйвера local все файлы, которые должны быть общедоступны, необходимо помещать в каталог storage/app/public. Кроме того, вам надо создать символьную ссылку в public/storage, которая указывает на папку storage/app/public.

При использовании local драйвера возвращаемое значение url не кодируется URL. По этой причине мы рекомендуем всегда хранить ваши файлы, используя имена, которые будут создавать действительные URL-адреса.

Временные URL
Для файлов, хранящихся с использованием s3, вы можете создать временный URL-адрес для данного файла с помощью метода partialUrl. Этот метод принимает путь и экземпляр DateTime, указывающий, когда должен истечь URL:
$url = Storage::temporaryUrl(
    'file.jpg', now()->addMinutes(5)
);
Если вам нужно указать дополнительные параметры запроса S3, вы можете передать массив параметров запроса в качестве третьего аргумента методу timeUrl:
$url = Storage::temporaryUrl(
    'file.jpg',
    now()->addMinutes(5),
    [
        'ResponseContentType' => 'application/octet-stream',
        'ResponseContentDisposition' => 'attachment; filename=file2.jpg',
    ]
);


Настройка хоста URL
Если вы хотите заранее определить хост для URL-адресов файлов, сгенерированных с помощью фасада Storage, вы можете добавить параметр url в массив конфигурации диска:
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'public',
],


Пути к файлам

Вы можете использовать метод path, чтобы получить путь к заданному файлу. Если вы используете local драйвер, он вернет абсолютный путь к файлу. Если вы используете драйвер s3, этот метод вернет относительный путь к файлу в корзине S3:
use Illuminate\Support\Facades\Storage;

$path = Storage::path('file.jpg');

Метаданные файла

Помимо чтения и записи файлов Laravel может предоставить информацию о самих файлах. Например, для получения размера файла в байтах служит метод size():

use Illuminate\Support\Facades\Storage;

$size = Storage::size('file1.jpg');

Для получения времени последней модификации файла (отметка времени UNIX) служит метод lastModified():
PHP

$time = Storage::lastModified('file1.jpg');



Запись файлов








    </div>
    <div class="theme">
    </div>
    <div class="theme">
    </div>
    <div class="theme">
    </div>
    <div class="theme">
    </div>
    <div class="theme">
    </div>
    <div class="theme">
    </div>
    <div class="theme">
    </div>
</div>




https://laravel.ru/docs/v5/broadcasting


{{--
<h2 class="theme__title"></h2>
<h3 class="theme__subtitle"></h3>
<h4 class="theme_subtitlex2"></h4>
<p class="theme__text"></p>
<code>
<pre>
</pre>
</code>
--}}

@endsection
