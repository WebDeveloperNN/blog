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
Для записи файла на диск служит метод put(). Также вы можете передать в метод put() PHP-resource, чтобы использовать низкоуровневую поддержку потоков Flysystem. Очень рекомендуем использовать потоки при работе с большими файлами:

use Illuminate\Support\Facades\Storage;

Storage::put('file.jpg', $contents);

Storage::put('file.jpg', $resource);

+ 5.3

добавлено в 5.3 (28.01.2017)

Автоматическая работа с потоками

Если вы хотите, чтобы Laravel автоматически использовал потоки для записи файла в хранилище, используйте методы putFile() или putFileAs(). Эти методы принимают объект Illuminate\Http\File или Illuminate\Http\UploadedFile, и автоматически используют потоки для размещения файла в необходимом месте:

use Illuminate\Http\File;

// Автоматическое генерирование UUID для имени файла...
Storage::putFile('photos', new File('/path/to/photo'));

// Ручное указание имени файла...
Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');

У метода putFile() есть несколько важных нюансов. Заметьте, мы указали только название каталога без имени файла. По умолчанию метод putFile() генерирует UUID в качестве имени файла. Метод вернёт путь к файлу, поэтому вы можете сохранить в БД весь путь, включая сгенерированное имя.

Методы putFile() и putFileAs() принимают также аргумент «видимости» сохраняемого файла. Это полезно в основном при хранении файлов в облачном хранилище, таком как S3, когда необходим общий доступ к файлам:

Storage::putFile('photos', new File('/path/to/photo'), 'public');

Добавление контента в начало / конец файла

Для вставки контента в начало или конец файла служат методы prepend() и append():

Storage::prepend('file.log', 'Prepended Text');

Storage::append('file.log', 'Appended Text');

Копирование и перемещение файлов

Метод copy() используется для копирования существующего файла в новое расположение на диске, а метод move() — для переименования или перемещения существующего файла в новое расположение:

Storage::copy('old/file1.jpg', 'new/file1.jpg');

Storage::move('old/file1.jpg', 'new/file1.jpg');



Загрузка файлов
Загрузка файлов в веб-приложениях — это чаще всего загрузка пользовательских файлов, таких как аватар, фотографии и документы. В Laravel очень просто сохранять загружаемые файлы методом store() на экземпляре загружаемого файла. Просто вызовите метод store(), указав путь для сохранения загружаемого файла:
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAvatarController extends Controller
{
    /**
     * Update the avatar for the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $path = $request->file('avatar')->store('avatars');

        return $path;
    }
}
В этом примере есть несколько важных моментов. Заметьте, мы указали только название каталога без имени файла. По умолчанию метод store() генерирует UUID в качестве имени файла. Метод вернёт путь к файлу, поэтому вы можете сохранить в БД весь путь, включая сгенерированное имя.

Также вы можете вызвать метод putFile() фасада Storage для выполнения этой же операции над файлом, как показано в примере:

$path = Storage::putFile('avatars', $request->file('avatar'));

Указание имени файла

Если вы не хотите, чтобы файлу автоматически было назначено имя, можете использовать метод storeAs(), который принимает в виде аргументов путь, имя файла, и (необязательно) диск:

$path = $request->file('avatar')->storeAs(
  'avatars', $request->user()->id
);

Конечно, вы также можете использовать метод putFileAs() фасада Storage, который выполняет такую же операцию:

$path = Storage::putFileAs(
  'avatars', $request->file('avatar'), $request->user()->id
);
Непечатаемые и недопустимые символы Unicode будут автоматически удалены из путей к файлам. Следовательно, вы можете очистить пути к файлам перед их передачей в методы хранения файлов Laravel. Пути к файлам нормализуются с помощью метода League \ Flysystem \ Util :: normalizePath.



Указание диска
Указание диска

По умолчанию этот метод использует диск по умолчанию. Если необходимо указать другой диск, передайте имя диска в качестве второго аргумента в метод store():
PHP

$path = $request->file('avatar')->store(
  'avatars/'.$request->user()->id, 's3'
);
Если вы используете метод storeAs, вы можете передать имя диска в качестве третьего аргумента метода:
path = $request->file('avatar')->storeAs(
    'avatars',
    $request->user()->id,
    's3'
);
Другая информация о файле

Если вы хотите получить оригинальное имя загруженного файла, вы можете сделать это с помощью метода getClientOriginalName:
$name = $request->file('avatar')->getClientOriginalName();
Метод extension может использоваться для получения расширения загруженного файла:
$extension = $request->file('avatar')->extension();

Видимость файлов

В интеграции Flysystem в Laravel «видимость» — это абстракция разрешений на файлы для использования на нескольких платформах. Файлы могут быть обозначены как public или private. Если файл отмечен как public, значит он должен быть доступен остальным. Например, при использовании драйвера S3 вы можете получить URL для public-файлов.

Вы можете задать видимость при размещении файла методом put():

use Illuminate\Support\Facades\Storage;

Storage::put('file.jpg', $contents, 'public');

Если файл уже был сохранён, то получить и задать его видимость можно методами getVisibility() и setVisibility():

$visibility = Storage::getVisibility('file.jpg');

Storage::setVisibility('file.jpg', 'public')
При взаимодействии с загруженными файлами вы можете использовать методы storePublicly и storePubliclyAs для сохранения загруженного файла в открытом доступе:
$path = $request->file('avatar')->storePublicly('avatars', 's3');

$path = $request->file('avatar')->storePubliclyAs(
    'avatars',
    $request->user()->id,
    's3'
);
Удаление файлов

Метод delete() принимает имя одного файла или массив файлов для удаления с диска:

use Illuminate\Support\Facades\Storage;

Storage::delete('file.jpg');

Storage::delete(['file1.jpg', 'file2.jpg']);


При необходимости вы можете указать диск, с которого следует удалить файл:
use Illuminate\Support\Facades\Storage;

Storage::disk('s3')->delete('folder_path/file_name.jpg');

Папки

Получение всех файлов из папки

Метод files() возвращает массив всех файлов из указанной папки. Если вы хотите получить массив всех файлов папки и её подпапок, используйте метод allFiles():

use Illuminate\Support\Facades\Storage;

$files = Storage::files($directory);

$files = Storage::allFiles($directory);

Получение всех подпапок

Метод directories() возвращает массив всех папок из указанной папки. Вдобавок, вы можете использовать метод allDirectories() для получения списка всех папок в данной папке и во всех её подпапках:

$directories = Storage::directories($directory);

// рекурсивно...
$directories = Storage::allDirectories($directory);

Создание папки

Метод makeDirectory() создаёт указанную папку, включая необходимые подпапки:

Storage::makeDirectory($directory);

Удаление директории

И наконец, метод deleteDirectory() удаляет папку и все её файлы с диска:

Storage::deleteDirectory($directory);

Пользовательские файловые системы
Laravel Flysystem предоставляет драйверы для нескольких «drivers» из коробки. Однако, Flysystem не ограничен ими и содержит в себе адаптеры для многих других систем хранения. Вы можете создать свой драйвер, если хотите использовать один из этих дополнительных адаптеров в вашем приложении Laravel.
Для настройки собственной файловой системы вам понадобится адаптер Flysystem. Давайте добавим в наш проект адаптер Dropbox, поддерживаемый сообществом:
composer require spatie/flysystem-dropbox

Затем вы должны создать  service provide, например DropboxServiceProvider. В методе boot поставщика вы можете использовать метод extend фасада Storage для определения настраиваемого драйвера:
namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;

class DropboxServiceProvider extends ServiceProvider
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
        Storage::extend('dropbox', function ($app, $config) {
            $client = new DropboxClient(
                $config['authorization_token']
            );

            return new Filesystem(new DropboxAdapter($client));
        });
    }
}
Первый аргумент метода extend() — имя драйвера, второй — замыкание, которое получает переменные $app и $config. Замыкание должно возвратить экземпляр League\Flysystem\Filesystem. Переменная $config содержит значения, определенные в config/filesystems.php для указанного диска.

Затем зарегистрируйте поставщика услуг в файле конфигурации config / app.php:
'providers' => [
    // ...
    App\Providers\DropboxServiceProvider::class,
];

Когда вы создали сервис-провайдер для регистрации расширения, вы можете использовать драйвер dropbox в своём файле с настройками config/filesystems.php.
    </div>
    <div class="theme">
<h2 class="theme__title">
    Помошники
</h2>
Laravel включает множество глобальных «вспомогательных» функций PHP. Многие из этих функций используются самим фреймворком; однако вы можете использовать их в своих собственных приложениях, если сочтете их удобными.


Список методов
Массивы и объекты
Arr::accessible()
Метод Arr :: available проверяет, доступно ли данное значение массиву:
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

$isAccessible = Arr::accessible(['a' => 1, 'b' => 2]);

// true

$isAccessible = Arr::accessible(new Collection);

// true

$isAccessible = Arr::accessible('abc');

// false

$isAccessible = Arr::accessible(new stdClass);

// false

Arr::add()
Добавить указанную пару ключ/значение в массив, если она там ещё не существует или установить значение null.
use Illuminate\Support\Arr;

$array = Arr::add(['name' => 'Desk'], 'price', 100);

// ['name' => 'Desk', 'price' => 100]

$array = Arr::add(['name' => 'Desk', 'price' => null], 'price', 100);

// ['name' => 'Desk', 'price' => 100]

Arr::collapse()
Функция array_collapse() (Laravel 5.1+) собирает массив массивов в единый массив:
use Illuminate\Support\Arr;
$array = Arr::collapse([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);
// [1, 2, 3, 4, 5, 6, 7, 8, 9]

Arr::crossJoin()
Метод Arr :: crossJoin cross объединяет указанные массивы, возвращая декартово произведение со всеми возможными перестановками:
use Illuminate\Support\Arr;

$matrix = Arr::crossJoin([1, 2], ['a', 'b']);

/*
    [
        [1, 'a'],
        [1, 'b'],
        [2, 'a'],
        [2, 'b'],
    ]
*/

$matrix = Arr::crossJoin([1, 2], ['a', 'b'], ['I', 'II']);

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

Arr::divide()
Вернуть два массива — один с ключами, другой со значениями оригинального массива.
use Illuminate\Support\Arr;

[$keys, $values] = Arr::divide(['name' => 'Desk']);

// $keys: ['name']

// $values: ['Desk']

Arr::dot()
Сделать многоуровневый массив плоским, объединяя вложенные массивы с помощью точки в именах.
use Illuminate\Support\Arr;

$array = ['products' => ['desk' => ['price' => 100]]];

$flattened = Arr::dot($array);

// ['products.desk.price' => 100]

Arr::except()
Удалить указанную пару ключ/значение из массива.
use Illuminate\Support\Arr;
$array = ['name' => 'Desk', 'price' => 100];
$filtered = Arr::except($array, ['price']);
// ['name' => 'Desk']

Arr::exists()
Метод Arr :: exists проверяет, существует ли данный ключ в предоставленном массиве:
use Illuminate\Support\Arr;
$array = ['name' => 'John Doe', 'age' => 17];
$exists = Arr::exists($array, 'name');
// true
$exists = Arr::exists($array, 'salary');
// false

Arr::first()
Вернуть первый элемент массива, удовлетворяющий требуемому условию.
use Illuminate\Support\Arr;
$array = [100, 200, 300];
$first = Arr::first($array, function ($value, $key) {
    return $value >= 150;
});
// 200
Третьим параметром можно передать значение по умолчанию на случай, если ни одно значение не пройдёт условие:
use Illuminate\Support\Arr;
$first = Arr::first($array, $callback, $default);

Arr::flatten()
Сделать многоуровневый массив плоским.
use Illuminate\Support\Arr;

$array = ['name' => 'Joe', 'languages' => ['PHP', 'Ruby']];

$flattened = Arr::flatten($array);

// ['Joe', 'PHP', 'Ruby']


Arr::forget()
Удалить указанную пару ключ/значение из многоуровневого массива, используя синтаксис имени с точкой.
use Illuminate\Support\Arr;

$array = ['products' => ['desk' => ['price' => 100]]];

Arr::forget($array, 'products.desk');

// ['products' => []]


Arr::get()
Вернуть значение из многоуровневого массива, используя синтаксис имени с точкой.
use Illuminate\Support\Arr;
$array = ['products' => ['desk' => ['price' => 100]]];
$price = Arr::get($array, 'products.desk.price');
// 100
Также третьим аргументом можно передать значение по умолчанию на случай, если указанный ключ не будет найден:
use Illuminate\Support\Arr;
$discount = Arr::get($array, 'products.desk.discount', 0);
// 0

Arr::has()
Функция array_has() проверяет существование данного элемента или элементов в массиве с помощью «точечной» записи:
use Illuminate\Support\Arr;
$array = ['product' => ['name' => 'Desk', 'price' => 100]];
$contains = Arr::has($array, 'product.name');
// true
$contains = Arr::has($array, ['product.price', 'product.discount']);
// false

Arr::hasAny()
Метод Arr :: hasAny проверяет, существует ли какой-либо элемент в данном наборе в массиве, используя "точечную" нотацию:
use Illuminate\Support\Arr;

$array = ['product' => ['name' => 'Desk', 'price' => 100]];

$contains = Arr::hasAny($array, 'product.name');

// true

$contains = Arr::hasAny($array, ['product.name', 'product.discount']);

// true

$contains = Arr::hasAny($array, ['category', 'product.discount']);

// false

Arr::isAssoc()
176 / 5000
Результаты перевода
Arr :: isAssoc возвращает true, если данный массив является ассоциативным массивом. Массив считается ассоциативным, если в нем нет последовательных цифровых ключей, начинающихся с нуля:
use Illuminate\Support\Arr;

$isAssoc = Arr::isAssoc(['product' => ['name' => 'Desk', 'price' => 100]]);

// true

$isAssoc = Arr::isAssoc([1, 2, 3]);

// false

Arr::last()
Функция array_last() возвращает последний элемент массива, удовлетворяющий требуемому условию:
use Illuminate\Support\Arr;
$array = [100, 200, 300, 110];
$last = Arr::last($array, function ($value, $key) {
    return $value >= 150;
});
// 300
Третьим параметром можно передать значение по умолчанию. Это значение будет возвращено если никакое значение не пройдет тест на правду.
use Illuminate\Support\Arr;
$last = Arr::last($array, $callback, $default);

Arr::only()
Вернуть из массива только указанные пары ключ/значения.
use Illuminate\Support\Arr;

$array = ['name' => 'Desk', 'price' => 100, 'orders' => 10];

$slice = Arr::only($array, ['name', 'price']);

// ['name' => 'Desk', 'price' => 100]

Arr::pluck()
Извлечь значения из многоуровневого массива, соответствующие переданному ключу.
use Illuminate\Support\Arr;
$array = [
    ['developer' => ['id' => 1, 'name' => 'Taylor']],
    ['developer' => ['id' => 2, 'name' => 'Abigail']],
];

$names = Arr::pluck($array, 'developer.name');
// ['Taylor', 'Abigail']
Также вы можете указать ключ для полученного списка:
use Illuminate\Support\Arr;
$names = Arr::pluck($array, 'developer.name', 'developer.id');
// [1 => 'Taylor', 2 => 'Abigail']

Arr::prepend()
Поместить элемент в начало массива:
use Illuminate\Support\Arr;
$array = ['one', 'two', 'three', 'four'];
$array = Arr::prepend($array, 'zero');
// ['zero', 'one', 'two', 'three', 'four']
При необходимости вы можете указать ключ, который следует использовать для значения:
use Illuminate\Support\Arr;
$array = ['price' => 100];
$array = Arr::prepend($array, 'Desk', 'name');
// ['name' => 'Desk', 'price' => 100]

Arr::pull()
Метод Arr :: pull возвращает и удаляет пару ключ / значение из массива:
use Illuminate\Support\Arr;

$array = ['name' => 'Desk', 'price' => 100];

$name = Arr::pull($array, 'name');

// $name: Desk

// $array: ['price' => 100]
В качестве третьего аргумента метода может быть передано значение по умолчанию. Это значение будет возвращено, если ключ не существует:
use Illuminate\Support\Arr;

$value = Arr::pull($array, $key, $default);

Arr::query()
Метод Arr :: query преобразует массив в строку запроса:
use Illuminate\Support\Arr;

$array = ['name' => 'Taylor', 'order' => ['column' => 'created_at', 'direction' => 'desc']];

Arr::query($array);

// name=Taylor&order[column]=created_at&order[direction]=desc

Arr::random()
Метод Arr :: random возвращает случайное значение из массива:
use Illuminate\Support\Arr;

$array = [1, 2, 3, 4, 5];

$random = Arr::random($array);

// 4 - (retrieved randomly)
Вы также можете указать количество возвращаемых элементов в качестве необязательного второго аргумента. Обратите внимание, что предоставление этого аргумента вернет массив, даже если требуется только один элемент:
use Illuminate\Support\Arr;

$items = Arr::random($array, 2);

// [2, 5] - (retrieved randomly)

Arr::set()
Установить значение в многоуровневом массиве, используя синтаксис имени с точкой.
use Illuminate\Support\Arr;

$array = ['products' => ['desk' => ['price' => 100]]];

Arr::set($array, 'products.desk.price', 200);

// ['products' => ['desk' => ['price' => 200]]]

Arr::shuffle()
Метод Arr :: shuffle случайным образом перемешивает элементы в массиве:
use Illuminate\Support\Arr;

$array = Arr::shuffle([1, 2, 3, 4, 5]);

// [3, 2, 5, 1, 4] - (generated randomly)

Arr::sort()
Метод Arr :: sort сортирует массив по его значениям:
use Illuminate\Support\Arr;

$array = ['Desk', 'Table', 'Chair'];

$sorted = Arr::sort($array);

// ['Chair', 'Desk', 'Table']

Отсортировать массив по результатам вызовов переданной функции-замыкания.
use Illuminate\Support\Arr;

$array = [
    ['name' => 'Desk'],
    ['name' => 'Table'],
    ['name' => 'Chair'],
];

$sorted = array_values(Arr::sort($array, function ($value) {
    return $value['name'];
}));

/*
    [
        ['name' => 'Chair'],
        ['name' => 'Desk'],
        ['name' => 'Table'],
    ]
*/

Arr::sortRecursive()
Метод Arr :: sortRecursive рекурсивно сортирует массив, используя функцию sort для числовых подмассивов и ksort для ассоциативных подмассивов:
use Illuminate\Support\Arr;

$array = [
    ['Roman', 'Taylor', 'Li'],
    ['PHP', 'Ruby', 'JavaScript'],
    ['one' => 1, 'two' => 2, 'three' => 3],
];

$sorted = Arr::sortRecursive($array);

/*
    [
        ['JavaScript', 'PHP', 'Ruby'],
        ['one' => 1, 'three' => 3, 'two' => 2],
        ['Li', 'Roman', 'Taylor'],
    ]
*/

Arr::where()
Фильтровать массив с помощью переданной функции-замыкания.
use Illuminate\Support\Arr;

$array = [100, '200', 300, '400', 500];

$filtered = Arr::where($array, function ($value, $key) {
    return is_string($value);
});

// [1 => '200', 3 => '400']

Arr::wrap()
Метод Arr :: wrap заключает данное значение в массив. Если данное значение уже является массивом, оно не будет изменено:
use Illuminate\Support\Arr;

$string = 'Laravel';

$array = Arr::wrap($string);

// ['Laravel']
Если заданное значение равно нулю, будет возвращен пустой массив:
use Illuminate\Support\Arr;

$nothing = null;

$array = Arr::wrap($nothing);

// []

data_fill()
Функция data_fill устанавливает пропущенное значение во вложенном массиве или объекте, используя "точечную" нотацию:
$data = ['products' => ['desk' => ['price' => 100]]];

data_fill($data, 'products.desk.price', 200);

// ['products' => ['desk' => ['price' => 100]]]

data_fill($data, 'products.desk.discount', 10);

// ['products' => ['desk' => ['price' => 100, 'discount' => 10]]]
Эта функция также принимает звездочки в качестве подстановочных знаков и соответствующим образом заполняет цель:
$data = [
    'products' => [
        ['name' => 'Desk 1', 'price' => 100],
        ['name' => 'Desk 2'],
    ],
];

data_fill($data, 'products.*.price', 200);

/*
    [
        'products' => [
            ['name' => 'Desk 1', 'price' => 100],
            ['name' => 'Desk 2', 'price' => 200],
        ],
    ]
*/

data_get()
Функция data_get извлекает значение из вложенного массива или объекта, используя "точечную" нотацию:
$data = ['products' => ['desk' => ['price' => 100]]];

$price = data_get($data, 'products.desk.price');

// 100
Функция data_get также принимает значение по умолчанию, которое будет возвращено, если указанный ключ не найден:
$discount = data_get($data, 'products.desk.discount', 0);

// 0

Функция также принимает подстановочные знаки с использованием звездочек, которые могут указывать на любой ключ массива или объекта:
wildcards

$data = [
    'product-one' => ['name' => 'Desk 1', 'price' => 100],
    'product-two' => ['name' => 'Desk 2', 'price' => 150],
];

data_get($data, '*.name');

// ['Desk 1', 'Desk 2'];

data_set()
Функция data_set устанавливает значение во вложенном массиве или объекте, используя "точечную" нотацию:
$data = ['products' => ['desk' => ['price' => 100]]];

data_set($data, 'products.desk.price', 200);

// ['products' => ['desk' => ['price' => 200]]]
Эта функция также принимает подстановочные знаки и соответственно устанавливает значения для цели:
$data = [
    'products' => [
        ['name' => 'Desk 1', 'price' => 100],
        ['name' => 'Desk 2', 'price' => 150],
    ],
];

data_set($data, 'products.*.price', 200);

/*
    [
        'products' => [
            ['name' => 'Desk 1', 'price' => 200],
            ['name' => 'Desk 2', 'price' => 200],
        ],
    ]
*/
По умолчанию все существующие значения перезаписываются. Если вы хотите установить значение, только если оно не существует, вы можете передать false в качестве четвертого аргумента:
$data = ['products' => ['desk' => ['price' => 100]]];

data_set($data, 'products.desk.price', 200, false);

// ['products' => ['desk' => ['price' => 100]]]

head()
Функция head возвращает первый элемент в данном массиве:
$array = [100, 200, 300];

$first = head($array);

// 100

last()
Последняя функция возвращает последний элемент в данном массиве:
$array = [100, 200, 300];

$last = last($array);

// 300




Пути
app_path()
Получить полный путь к папке app. Также вы можете использовать функцию app_path() для получения полного пути к указанному файлу относительно каталога приложения:

$path = app_path();

$path = app_path('Http/Controllers/Controller.php');


base_path()
Получить полный путь к корневой папке приложения. Также вы можете использовать функцию base_path() для получения полного пути к указанному файлу относительно корня проекта:

$path = base_path();

$path = base_path('vendor/bin');

config_path

Получить полный путь к папке config:
PHP

$path = config_path();
$path = config_path('app.php');


database_path

Функция database_path() возвращает полный путь к папке базы данных приложения. Вы также можете использовать функцию database_path для создания полного пути к заданному файлу в каталоге базы данных:
$path = database_path();
$path = database_path('factories/UserFactory.php');

mix()

Функция mix возвращает путь к файлу Mix с версией:
$path = mix('css/app.css');

public_path()
Функция public_path возвращает полный путь к public каталогу. Вы также можете использовать функцию public_path для создания полного пути к заданному файлу в общедоступном каталоге:
$path = public_path();

$path = public_path('css/app.css');

resource_path()
resource_path

Получить полный путь к папке resources. Эту функцию можно использовать, чтобы сгенерировать полный путь к файлу относительно папки хранилища:

$path = resource_path();

$path = resource_path('assets/sass/app.scss');

storage_path

Получить полный путь к папке storage. Также вы можете использовать функцию storage_path() для получения полного пути к указанному файлу относительно каталога storage:
PHP

$path = storage_path();

$path = storage_path('app/file.txt');


Строки
__()
Функция __() переводит заданную строку перевода или ключ перевода, используя ваши файлы локализации:
echo __('Welcome to our application');

echo __('messages.welcome');
Если указанная строка перевода или ключ не существует, функция __ вернет заданное значение. Итак, используя приведенный выше пример, функция __ вернет messages.welcome, если этот ключ перевода не существует.



Может войдёшь?
Черновики Написать статью Профиль
Функции

Helper Functions → Community Community +1 015
20 июня 2015

перевод документация 5.х

    1. Введение
    2. Массивы
        2.1. array_add
        2.2. array_collapse
        2.3. array_divide
        2.4. array_dot
        2.5. array_except
        2.6. array_first
        2.7. array_flatten
        2.8. array_forget
        2.9. array_fetch
        2.10. array_get
        2.11. array_has
        2.12. array_last
        2.13. array_only
        2.14. array_pluck
        2.15. array_prepend
        2.16. array_pull
        2.17. array_set
        2.18. array_sort
        2.19. array_sort_recursive
        2.20. array_where
        2.21. head
        2.22. last
    3. Пути
        3.1. app_path
        3.2. base_path
        3.3. config_path
        3.4. database_path
        3.5. elixir
        3.6. public_path
        3.7. resource_path
        3.8. storage_path
    4. Маршруты
        4.1. get
        4.2. post
        4.3. put
        4.4. patch
        4.5. delete
        4.6. resource
    5. Строки
        5.1. camel_case
        5.2. class_basename
        5.3. e
        5.4. ends_with
        5.5. snake_case
        5.6. str_limit
        5.7. starts_with
        5.8. str_contains
        5.9. str_finish
        5.10. str_is
        5.11. str_plural
        5.12. str_random
        5.13. str_singular
        5.14. str_slug
        5.15. studly_case
        5.16. title_case
        5.17. trans
        5.18. trans_choice
    6. URL-адреса
        6.1. action
        6.2. asset
        6.3. secure_asset
        6.4. route
        6.5. secure_url
        6.6. url
    7. Прочее
        7.1. abort
        7.2. abort_if
        7.3. abort_unless
        7.4. auth
        7.5. back
        7.6. bcrypt
        7.7. collect
        7.8. config
        7.9. csrf_field
        7.10. cache
        7.11. csrf_token
        7.12. dd
        7.13. dispatch
        7.14. env
        7.15. event
        7.16. info
        7.17. logger
        7.18. factory
        7.19. method_field
        7.20. old
        7.21. redirect
        7.22. request
        7.23. response
        7.24. session
        7.25. value
        7.26. view
        7.27. with

Этот перевод актуален для англоязычной документации на 08.12.2016 (ветка 5.2) , 19.06.2016 (ветка 5.1) и 31.07.2015 (ветка 5.0). Опечатка? Выдели и нажми Ctrl+Enter.
Введение

Laravel содержит множество глобальных «вспомогательных» PHP-функций. Многие из них используются самим фреймворком, но вы также можете использовать их в своих приложениях, если они вам понадобятся.
Массивы
array_add

Добавить указанную пару ключ/значение в массив, если она там ещё не существует.

$array = array_add(['name' => 'Desk'], 'price', 100);

// ['name' => 'Desk', 'price' => 100]

array_collapse

Функция array_collapse() (Laravel 5.1+) собирает массив массивов в единый массив:

$array = array_collapse([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);

// [1, 2, 3, 4, 5, 6, 7, 8, 9]

array_divide

Вернуть два массива — один с ключами, другой со значениями оригинального массива.

list($keys, $values) = array_divide(['name' => 'Desk']);

// $keys: ['name']

// $values: ['Desk']

array_dot

Сделать многоуровневый массив плоским, объединяя вложенные массивы с помощью точки в именах.

$array = array_dot(['foo' => ['bar' => 'baz']]);

// ['foo.bar' => 'baz'];

array_except

Удалить указанную пару ключ/значение из массива.

$array = ['name' => 'Desk', 'price' => 100];

$array = array_except($array, ['price']);

// ['name' => 'Desk']

array_first

Вернуть первый элемент массива, удовлетворяющий требуемому условию.

$array = [100, 200, 300];

$value = array_first($array, function ($value, $key) {
  return $value >= 150;
});

// 200

Третьим параметром можно передать значение по умолчанию на случай, если ни одно значение не пройдёт условие:

$value = array_first($array, $callback, $default);

array_flatten

Сделать многоуровневый массив плоским.

$array = ['name' => 'Joe', 'languages' => ['PHP', 'Ruby']];

$array = array_flatten($array);

// ['Joe', 'PHP', 'Ruby'];

array_forget

Удалить указанную пару ключ/значение из многоуровневого массива, используя синтаксис имени с точкой.

$array = ['products' => ['desk' => ['price' => 100]]];

array_forget($array, 'products.desk');

// ['products' => []]

+ 5.0

добавлено в 5.0 (08.02.2016)
array_fetch

Функция array_fetch() возвращает одноуровневый массив с выбранными элементами по переданному пути.

$array = [
  ['developer' => ['name' => 'Taylor']],
  ['developer' => ['name' => 'Dayle']]
];

$array = array_fetch($array, 'developer.name');

// ['Taylor', 'Dayle'];

array_get

Вернуть значение из многоуровневого массива, используя синтаксис имени с точкой.

$array = ['products' => ['desk' => ['price' => 100]]];

$value = array_get($array, 'products.desk');

// ['price' => 100]

Также третьим аргументом можно передать значение по умолчанию на случай, если указанный ключ не будет найден:

$value = array_get($array, 'names.john', 'default');

Если вам нужно что-то похожее на array_get(), но только для объектов, используйте object_get().
+ 5.3 5.2 5.1

добавлено в 5.3 (28.01.2017) 5.2 (08.12.2016) 5.1 (01.04.2016)
array_has

Функция array_has() проверяет существование данного элемента или элементов в массиве с помощью «точечной» записи:

$array = ['product' => ['name' => 'desk', 'price' => 100]];

$hasItem = array_has($array, 'product.name');

// true

$hasItems = array_has($array, ['product.price', 'product.discount']);

// false

+ 5.3 5.0

добавлено в 5.3 (28.01.2017) 5.0 (08.02.2016)
array_last

Функция array_last() возвращает последний элемент массива, удовлетворяющий требуемому условию:

$array = [100, 200, 300, 110];

$value = array_last($array, function ($value, $key) {
  return $value >= 150;
});

// 300

+ 5.0

добавлено в 5.0 (08.02.2016)

Третьим параметром можно передать значение по умолчанию:

$value = array_last($array, $callback, $default);

array_only

Вернуть из массива только указанные пары ключ/значения.

$array = ['name' => 'Desk', 'price' => 100, 'orders' => 10];

$array = array_only($array, ['name', 'price']);

// ['name' => 'Desk', 'price' => 100]

array_pluck

Извлечь значения из многоуровневого массива, соответствующие переданному ключу.

$array = [
  ['developer' => ['id' => 1, 'name' => 'Taylor']],
  ['developer' => ['id' => 2, 'name' => 'Abigail']],
];

$array = array_pluck($array, 'developer.name');

// ['Taylor', 'Abigail'];

Также вы можете указать ключ для полученного списка:

$array = array_pluck($array, 'developer.name', 'developer.id');

// [1 => 'Taylor', 2 => 'Abigail'];

+ 5.2

добавлено в 5.2 (08.12.2016)
array_prepend

Поместить элемент в начало массива:

$array = ['one', 'two', 'three', 'four'];

$array = array_prepend($array, 'zero');

// $array: ['zero', 'one', 'two', 'three', 'four']

array_pull

Извлечь значения из многоуровневого массива, соответствующие переданному ключу, и удалить их.

$array = ['name' => 'Desk', 'price' => 100];

$name = array_pull($array, 'name');

// $name: Desk

// $array: ['price' => 100]

array_set

Установить значение в многоуровневом массиве, используя синтаксис имени с точкой.

$array = ['products' => ['desk' => ['price' => 100]]];

array_set($array, 'products.desk.price', 200);

// ['products' => ['desk' => ['price' => 200]]]

array_sort

Отсортировать массив по результатам вызовов переданной функции-замыкания.

$array = [
  ['name' => 'Desk'],
  ['name' => 'Chair'],
];

$array = array_values(array_sort($array, function ($value) {
  return $value['name'];
}));

/*
  [
    ['name' => 'Chair'],
    ['name' => 'Desk'],
  ]
*/

+ 5.1

добавлено в 5.1 (01.04.2016)
array_sort_recursive

Функция array_sort_recursive() рекурсивно сортирует массив с помощью функции sort():

$array = [
  [
    'Roman',
    'Taylor',
    'Li',
  ],
  [
    'PHP',
    'Ruby',
    'JavaScript',
  ],
];

$array = array_sort_recursive($array);

/*
  [
    [
      'Li',
      'Roman',
      'Taylor',
    ],
    [
      'JavaScript',
      'PHP',
      'Ruby',
    ]
  ];
*/

array_where

Фильтровать массив с помощью переданной функции-замыкания.

$array = [100, '200', 300, '400', 500];

$array = array_where($array, function ($value, $key) {
  return is_string($value);
});

// [1 => 200, 3 => 400]

head

Вернуть первый элемент массива.

$array = [100, 200, 300];

$first = head($array);

// 100

last

Вернуть последний элемент массива.

$array = [100, 200, 300];

$last = last($array);

// 300

Пути
app_path

Получить полный путь к папке app. Также вы можете использовать функцию app_path() для получения полного пути к указанному файлу относительно каталога приложения:

$path = app_path();

$path = app_path('Http/Controllers/Controller.php');

base_path

Получить полный путь к корневой папке приложения. Также вы можете использовать функцию base_path() для получения полного пути к указанному файлу относительно корня проекта:

$path = base_path();

$path = base_path('vendor/bin');

config_path

Получить полный путь к папке config:

$path = config_path();

+ 5.1

добавлено в 5.1 (01.04.2016)
database_path

Функция database_path() возвращает полный путь к папке базы данных приложения:

$path = database_path();

elixir

Функция elixir() получает путь к файлу Elixir в системе контроля версий:

elixir($file);

public_path

Получить полный путь к папке public:

$path = public_path();

+ 5.3 5.2

добавлено в 5.3 (28.01.2017) 5.2 (08.12.2016)
resource_path

Получить полный путь к папке resources. Эту функцию можно использовать, чтобы сгенерировать полный путь к файлу относительно папки хранилища:

$path = resource_path();

$path = resource_path('assets/sass/app.scss');

storage_path

Получить полный путь к папке storage. Также вы можете использовать функцию storage_path() для получения полного пути к указанному файлу относительно каталога storage:

$path = storage_path();

$path = storage_path('app/file.txt');

+ 5.0

добавлено в 5.0 (08.02.2016)
Маршруты
get

Зарегистрировать новый маршрут GET.

get('/', function() { return 'Hello World'; });

post

Зарегистрировать новый маршрут POST.

post('foo/bar', 'FooController@action');

put

Зарегистрировать новый маршрут PUT.

put('foo/bar', 'FooController@action');

patch

Зарегистрировать новый маршрут PATCH.

patch('foo/bar', 'FooController@action');

delete

Зарегистрировать новый маршрут DELETE.

delete('foo/bar', 'FooController@action');

resource

Зарегистрировать новый маршрут ресурса RESTful.

resource('foo', 'FooController');

Строки
camel_case

Преобразовать строку в camelCase.

$camel = camel_case('foo_bar');

// fooBar

class_basename

Получить имя переданного класса без пространства имён.

$class = class_basename('Foo\Bar\Baz');

// Baz

e
Функция e запускает функцию PHP htmlspecialchars с параметром double_encode, установленным по умолчанию в значение true:
echo e('< html>foo< /html>');
// &lt;html&gt;foo&lt;/html&gt;

preg_replace_array()
Функция preg_replace_array последовательно заменяет заданный шаблон в строке, используя массив:
$string = 'The event will take place between :start and :end';
$replaced = preg_replace_array('/:[a-z_]+/', ['8:30', '9:00'], $string);
// The event will take place between 8:30 and 9:00

Str::after()
Метод Str :: after возвращает все, что находится после заданного значения в строке. Вся строка будет возвращена, если значение не существует в строке:
use Illuminate\Support\Str;

$slice = Str::after('This is my name', 'This is');

// ' my name'

Str::afterLast()
Метод Str :: afterLast возвращает все, что находится после последнего вхождения данного значения в строку. Вся строка будет возвращена, если значение не существует в строке:
use Illuminate\Support\Str;

$slice = Str::afterLast('App\Http\Controllers\Controller', '\\');

// 'Controller'

Str::ascii()
Метод Str :: ascii попытается транслитерировать строку в значение ASCII:
use Illuminate\Support\Str;

$slice = Str::ascii('û');

// 'u'

Str::before()
Метод Str :: before возвращает все, что находится перед заданным значением в строке:
use Illuminate\Support\Str;

$slice = Str::before('This is my name', 'my name');

// 'This is '

Str::beforeLast()
Метод Str :: beforeLast возвращает все, что было до последнего появления данного значения в строке:
use Illuminate\Support\Str;

$slice = Str::beforeLast('This is my name', 'is');

// 'This '

Str::between()
Метод Str :: between возвращает часть строки между двумя значениями:
use Illuminate\Support\Str;

$slice = Str::between('This is my name', 'This', 'name');

// ' is my '

Str::camel()
Метод Str :: camel преобразует заданную строку в camelCase:
use Illuminate\Support\Str;

$converted = Str::camel('foo_bar');

// fooBar

Str::contains()
Определить, содержит ли строка переданную подстроку.
use Illuminate\Support\Str;
$contains = Str::contains('This is my name', 'my');
// true
Также вы можете передать массив значений, чтобы определить, содержит ли строка любое из них:
use Illuminate\Support\Str;

$contains = Str::contains('This is my name', ['my', 'foo']);

// true

Str::containsAll()
Метод Str :: containsAll определяет, содержит ли данная строка все значения массива:
use Illuminate\Support\Str;

$containsAll = Str::containsAll('This is my name', ['my', 'name']);

// true

Str::endsWith()
Метод Str ::ndsWith определяет, заканчивается ли данная строка заданным значением:
use Illuminate\Support\Str;

$result = Str::endsWith('This is my name', 'name');

// true
Вы также можете передать массив значений, чтобы определить, заканчивается ли данная строка любым из указанных значений:

use Illuminate\Support\Str;

$result = Str::endsWith('This is my name', ['name', 'foo']);

// true

$result = Str::endsWith('This is my name', ['this', 'foo']);

// false

Str::finish()
Добавить одно вхождение подстроки в конец переданной строки.
Метод Str :: finish добавляет один экземпляр данного значения к строке, если она еще не заканчивается значением:
use Illuminate\Support\Str;

$adjusted = Str::finish('this/string', '/');

// this/string/

$adjusted = Str::finish('this/string/', '/');

// this/string/

Str::is()
Метод Str :: is определяет, соответствует ли данная строка заданному шаблону. Звездочки могут использоваться для обозначения подстановочных знаков:
use Illuminate\Support\Str;

$matches = Str::is('foo*', 'foobar');

// true

$matches = Str::is('baz*', 'foobar');

// false

Str::isAscii()
Метод Str :: isAscii определяет, является ли данная строка 7-битным ASCII:
use Illuminate\Support\Str;

$isAscii = Str::isAscii('Taylor');

// true

$isAscii = Str::isAscii('ü');

// false

Str::isUuid()
Метод Str :: isUuid определяет, является ли данная строка допустимым UUID:
use Illuminate\Support\Str;

$isUuid = Str::isUuid('a0a2a2d2-0b87-4a18-83f2-2529882be2de');

// true

$isUuid = Str::isUuid('laravel');

// false

Str::kebab()
Метод Str :: kebab преобразует заданную строку в kebab-case:
use Illuminate\Support\Str;

$converted = Str::kebab('fooBar');

// foo-bar

Str::length()
Метод Str :: length возвращает длину заданной строки:
use Illuminate\Support\Str;

$length = Str::length('Laravel');

// 7

Str::limit()
Метод Str :: limit обрезает данную строку до указанной длины:
use Illuminate\Support\Str;

$truncated = Str::limit('The quick brown fox jumps over the lazy dog', 20);

// The quick brown fox...
Вы также можете передать третий аргумент, чтобы изменить строку, которая будет добавлена в конец:
use Illuminate\Support\Str;

$truncated = Str::limit('The quick brown fox jumps over the lazy dog', 20, ' (...)');

// The quick brown fox (...)

Str::lower()
Метод Str :: lower преобразует данную строку в нижний регистр:
use Illuminate\Support\Str;

$converted = Str::lower('LARAVEL');

// laravel

Str::orderedUuid()
Метод Str :: ordersUuid генерирует UUID "сначала временная метка", который можно эффективно сохранить в индексированном столбце базы данных:
use Illuminate\Support\Str;

return (string) Str::orderedUuid();

Str::padBoth()
Метод Str :: padBoth оборачивает функцию PHP str_pad, дополняя обе стороны строки другим:
use Illuminate\Support\Str;

$padded = Str::padBoth('James', 10, '_');

// '__James___'

$padded = Str::padBoth('James', 10);

// '  James   '

Str::padLeft()
Метод String :: padLeft оборачивает функцию PHP str_pad, дополняя левую часть строки другим:
use Illuminate\Support\Str;

$padded = Str::padLeft('James', 10, '-=');

// '-=-=-James'

$padded = Str::padLeft('James', 10);

// '     James'

Str::padRight()
Метод String :: padRight оборачивает функцию PHP str_pad, дополняя правую часть строки другим:
use Illuminate\Support\Str;

$padded = Str::padRight('James', 10, '-');

// 'James-----'

$padded = Str::padRight('James', 10);

// 'James     '

Str::plural()
Метод Str :: plural преобразует строку из одного слова во множественное число. Эта функция в настоящее время поддерживает только английский язык:
use Illuminate\Support\Str;

$plural = Str::plural('car');

// cars

$plural = Str::plural('child');

// children
Вы можете указать целое число в качестве второго аргумента функции для получения единственного или множественного числа строки:
use Illuminate\Support\Str;

$plural = Str::plural('child', 2);

// children

$plural = Str::plural('child', 1);

// child

Str::random()
Метод Str :: random генерирует случайную строку указанной длины. Эта функция использует функцию PHP random_bytes:
use Illuminate\Support\Str;

$random = Str::random(40);

Str::replaceArray()

Метод Str :: replaceArray последовательно заменяет заданное значение в строке, используя массив:

use Illuminate\Support\Str;

$string = 'The event will take place between ? and ?';

$replaced = Str::replaceArray('?', ['8:30', '9:00'], $string);

// The event will take place between 8:30 and 9:00

Str::replaceFirst()
Метод Str :: replaceFirst заменяет первое вхождение заданного значения в строке:
use Illuminate\Support\Str;

$replaced = Str::replaceFirst('the', 'a', 'the quick brown fox jumps over the lazy dog');

// a quick brown fox jumps over the lazy dog

Str::replaceLast()
use Illuminate\Support\Str;

$replaced = Str::replaceFirst('the', 'a', 'the quick brown fox jumps over the lazy dog');

// a quick brown fox jumps over the lazy dog

Str::replaceLast()
Метод Str :: replaceLast заменяет последнее вхождение данного значения в строке:
use Illuminate\Support\Str;

$replaced = Str::replaceLast('the', 'a', 'the quick brown fox jumps over the lazy dog');

// the quick brown fox jumps over a lazy dog

Str::singular()
Метод Str :: singular преобразует строку в ее особую форму. Эта функция в настоящее время поддерживает только английский язык:
use Illuminate\Support\Str;

$singular = Str::singular('cars');

// car

$singular = Str::singular('children');

// child

Str::slug()
Метод Str :: slug генерирует дружественный URL-адрес "slug" из заданной строки:
use Illuminate\Support\Str;

$slug = Str::slug('Laravel 5 Framework', '-');

// laravel-5-framework

Str::snake()
Метод Str :: snake преобразует заданную строку в snake_case:
use Illuminate\Support\Str;

$converted = Str::snake('fooBar');

// foo_bar

Str::start()
Метод Str :: start добавляет в строку единственный экземпляр данного значения, если он еще не начинается со значения:
use Illuminate\Support\Str;

$adjusted = Str::start('this/string', '/');

// /this/string

$adjusted = Str::start('/this/string', '/');

// /this/string

Str::startsWith()
Метод Str :: startWith определяет, начинается ли данная строка с заданного значения:
use Illuminate\Support\Str;

$result = Str::startsWith('This is my name', 'This');

// true

Str::studly()
Метод Str :: studly преобразует заданную строку в StudlyCase:
use Illuminate\Support\Str;

$converted = Str::studly('foo_bar');

// FooBar

Str::substr()
Метод Str :: substr возвращает часть строки, указанную параметрами start и length:
use Illuminate\Support\Str;

$converted = Str::substr('The Laravel Framework', 4, 7);

// Laravel

Str::title()
Метод Str :: title преобразует данную строку в Title Case:
use Illuminate\Support\Str;

$converted = Str::title('a nice title uses the correct case');

// A Nice Title Uses The Correct Case

Str::ucfirst()
Метод Str :: ucfirst возвращает заданную строку с первым символом с большой буквы:
use Illuminate\Support\Str;

$string = Str::ucfirst('foo bar');

// Foo bar

Str::upper()
Метод Str :: upper преобразует данную строку в верхний регистр:
use Illuminate\Support\Str;

$string = Str::upper('laravel');

// LARAVEL

Str::uuid()
Метод Str :: uuid генерирует UUID (версия 4):
use Illuminate\Support\Str;

return (string) Str::uuid();

Str::words()
Метод Str :: words ограничивает количество слов в строке:
use Illuminate\Support\Str;

return Str::words('Perfectly balanced, as all things should be.', 3, ' >>>');

// Perfectly balanced, as >>>

trans()
Функция trans переводит указанный ключ перевода, используя ваши файлы локализации:
echo trans('messages.welcome');
Если указанный ключ перевода не существует, функция trans вернет заданный ключ. Итак, используя приведенный выше пример, функция trans вернет messages.welcome, если ключ перевода не существует.

trans_choice()
Функция trans_choice переводит заданный ключ перевода с перегибом:
echo trans_choice('messages.notifications', $unreadCount);
Если указанный ключ трансляции не существует, функция trans_choice вернет данный ключ. Итак, используя приведенный выше пример, функция trans_choice вернет messages.notifications, если ключ перевода не существует.





Свободные строки
Свободные строки обеспечивают более гибкий объектно-ориентированный интерфейс для работы со строковыми значениями, позволяя объединять несколько строковых операций вместе с использованием более удобочитаемого синтаксиса по сравнению с традиционными строковыми операциями.

after
Метод after возвращает все, что находится после заданного значения в строке. Вся строка будет возвращена, если значение не существует в строке:
use Illuminate\Support\Str;

$slice = Str::of('This is my name')->after('This is');

// ' my name'

afterLast
Метод afterLast возвращает все, что находится после последнего появления данного значения в строке. Вся строка будет возвращена, если значение не существует в строке:
use Illuminate\Support\Str;

$slice = Str::of('App\Http\Controllers\Controller')->afterLast('\\');

// 'Controller'

append
Метод append добавляет заданные значения в строку:
use Illuminate\Support\Str;

$string = Str::of('Taylor')->append(' Otwell');

// 'Taylor Otwell'

ascii
Метод ascii попытается транслитерировать строку в значение ASCII:
use Illuminate\Support\Str;

$string = Str::of('ü')->ascii();

// 'u'

basename
Метод basename вернет завершающий компонент имени данной строки:
use Illuminate\Support\Str;

$string = Str::of('/foo/bar/baz')->basename();

// 'baz'
При необходимости вы можете предоставить «расширение», которое будет удалено из конечного компонента:
use Illuminate\Support\Str;

$string = Str::of('/foo/bar/baz.jpg')->basename('.jpg');

// 'baz'

before
Метод before возвращает все, что находится перед заданным значением в строке:
use Illuminate\Support\Str;

$slice = Str::of('This is my name')->before('my name');

// 'This is '

beforeLast
Метод beforeLast возвращает все, что было до последнего появления данного значения в строке:
use Illuminate\Support\Str;

$slice = Str::of('This is my name')->beforeLast('is');

// 'This '

camel
Метод camel преобразует данную строку в camelCase:
use Illuminate\Support\Str;

$converted = Str::of('foo_bar')->camel();

// fooBar

contains
Метод contains определяет, содержит ли данная строка данное значение (с учетом регистра):
use Illuminate\Support\Str;

$contains = Str::of('This is my name')->contains('my');

// true
Вы также можете передать массив значений, чтобы определить, содержит ли данная строка какое-либо из значений:
use Illuminate\Support\Str;

$contains = Str::of('This is my name')->contains(['my', 'foo']);

// true

containsAll
Метод containsAll определяет, содержит ли данная строка все значения массива:
use Illuminate\Support\Str;

$containsAll = Str::of('This is my name')->containsAll(['my', 'name']);

// true

dirname
Метод dirname возвращает часть родительского каталога данной строки:
use Illuminate\Support\Str;

$string = Str::of('/foo/bar/baz')->dirname();

// '/foo/bar'
При желании вы можете указать, сколько уровней каталогов вы хотите удалить из строки:
use Illuminate\Support\Str;

$string = Str::of('/foo/bar/baz')->dirname(2);

// '/foo'

endsWith
Метод endWith определяет, заканчивается ли данная строка заданным значением:
use Illuminate\Support\Str;

$result = Str::of('This is my name')->endsWith('name');

// true
Вы также можете передать массив значений, чтобы определить, заканчивается ли данная строка любым из указанных значений:
use Illuminate\Support\Str;

$result = Str::of('This is my name')->endsWith(['name', 'foo']);

// true

$result = Str::of('This is my name')->endsWith(['this', 'foo']);

// false

exactly
exactly метод определяет, является ли данная строка точным совпадением с другой строкой:
use Illuminate\Support\Str;

$result = Str::of('Laravel')->exactly('Laravel');

// true

explode
Метод explode разбивает строку по заданному разделителю и возвращает коллекцию, содержащую каждый раздел разбитой строки:
use Illuminate\Support\Str;

$collection = Str::of('foo bar baz')->explode(' ');

// collect(['foo', 'bar', 'baz'])

finish
Метод finish добавляет один экземпляр заданного значения в строку, если она еще не заканчивается значением:
use Illuminate\Support\Str;

$adjusted = Str::of('this/string')->finish('/');

// this/string/

$adjusted = Str::of('this/string/')->finish('/');

// this/string/

is
Метод is определяет, соответствует ли данная строка заданному шаблону. Звездочки могут использоваться для обозначения подстановочных знаков:
use Illuminate\Support\Str;

$matches = Str::of('foobar')->is('foo*');

// true

$matches = Str::of('foobar')->is('baz*');

// false

isAscii
Метод isAscii определяет, является ли данная строка строкой ASCII:
use Illuminate\Support\Str;

$result = Str::of('Taylor')->isAscii();

// true

$result = Str::of('ü')->isAscii();

// false

isEmpty
Метод isEmpty определяет, является ли данная строка пустой:
use Illuminate\Support\Str;

$result = Str::of('  ')->trim()->isEmpty();

// true

$result = Str::of('Laravel')->trim()->isEmpty();

// false

isNotEmpty
Метод isNotEmpty определяет, не пуста ли данная строка:
use Illuminate\Support\Str;

$result = Str::of('  ')->trim()->isNotEmpty();

// false

$result = Str::of('Laravel')->trim()->isNotEmpty();

// true

kebab
Метод kebab преобразует данную строку в kebab-case:
use Illuminate\Support\Str;

$converted = Str::of('fooBar')->kebab();

// foo-bar

length
Метод length возвращает длину данной строки:
use Illuminate\Support\Str;

$length = Str::of('Laravel')->length();

// 7

limit
Метод limit обрезает данную строку до указанной длины:
use Illuminate\Support\Str;

$truncated = Str::of('The quick brown fox jumps over the lazy dog')->limit(20);

// The quick brown fox...
Вы также можете передать второй аргумент, чтобы изменить строку, которая будет добавлена в конец:
use Illuminate\Support\Str;

$truncated = Str::of('The quick brown fox jumps over the lazy dog')->limit(20, ' (...)');

// The quick brown fox (...)

lower
lower метод преобразует данную строку в нижний регистр:
use Illuminate\Support\Str;

$result = Str::of('LARAVEL')->lower();

// 'laravel'

ltrim
Метод ltrim left обрезает данную строку:
use Illuminate\Support\Str;

$string = Str::of('  Laravel  ')->ltrim();

// 'Laravel  '

$string = Str::of('/Laravel/')->ltrim('/');

// 'Laravel/'

match
Метод match вернет часть строки, которая соответствует заданному шаблону регулярного выражения:
use Illuminate\Support\Str;

$result = Str::of('foo bar')->match('/bar/');

// 'bar'

$result = Str::of('foo bar')->match('/foo (.*)/');

// 'bar'

matchAll
Метод matchAll вернет коллекцию, содержащую части строки, соответствующие заданному шаблону регулярного выражения:
use Illuminate\Support\Str;

$result = Str::of('bar foo bar')->matchAll('/bar/');

// collect(['bar', 'bar'])
Если вы укажете соответствующую группу в выражении, Laravel вернет коллекцию совпадений этой группы:
use Illuminate\Support\Str;

$result = Str::of('bar fun bar fly')->matchAll('/f(\w*)/');

// collect(['un', 'ly']);
Если совпадений не найдено, будет возвращена пустая коллекция.


padBoth
Метод padBoth оборачивает функцию PHP str_pad, дополняя обе стороны строки другим:
use Illuminate\Support\Str;

$padded = Str::of('James')->padBoth(10, '_');

// '__James___'

$padded = Str::of('James')->padBoth(10);

// '  James   '

padLeft
Метод padLeft оборачивает функцию PHP str_pad, дополняя левую часть строки другим:
use Illuminate\Support\Str;

$padded = Str::of('James')->padLeft(10, '-=');

// '-=-=-James'

$padded = Str::of('James')->padLeft(10);

// '     James'

padRight
Метод padRight оборачивает функцию PHP str_pad, дополняя правую часть строки другим:
use Illuminate\Support\Str;

$padded = Str::of('James')->padRight(10, '-');

// 'James-----'

$padded = Str::of('James')->padRight(10);

// 'James     '

plural
Метод plural преобразует строку из одного слова во множественное число. Эта функция в настоящее время поддерживает только английский язык:
use Illuminate\Support\Str;

$plural = Str::of('car')->plural();

// cars

$plural = Str::of('child')->plural();

// children

Вы можете указать целое число в качестве второго аргумента функции для получения единственного или множественного числа строки:
use Illuminate\Support\Str;

$plural = Str::of('child')->plural(2);

// children

$plural = Str::of('child')->plural(1);

// child

prepend
Метод prepend добавляет данные значения к строке:
use Illuminate\Support\Str;

$string = Str::of('Framework')->prepend('Laravel ');

// Laravel Framework

replace
Метод replace заменяет заданную строку внутри строки:
use Illuminate\Support\Str;

$replaced = Str::of('Laravel 6.x')->replace('6.x', '7.x');

// Laravel 7.x

replaceArray
Метод replaceArray последовательно заменяет заданное значение в строке, используя массив:
use Illuminate\Support\Str;

$string = 'The event will take place between ? and ?';

$replaced = Str::of($string)->replaceArray('?', ['8:30', '9:00']);

// The event will take place between 8:30 and 9:00

replaceFirst
Метод replaceFirst заменяет первое вхождение данного значения в строке:
use Illuminate\Support\Str;

$replaced = Str::of('the quick brown fox jumps over the lazy dog')->replaceFirst('the', 'a');

// a quick brown fox jumps over the lazy dog

replaceLast
Метод replaceLast заменяет последнее вхождение данного значения в строке:
use Illuminate\Support\Str;

$replaced = Str::of('the quick brown fox jumps over the lazy dog')->replaceLast('the', 'a');

// the quick brown fox jumps over a lazy dog

replaceMatches
Метод replaceMatches заменяет все части строки, соответствующие заданному шаблону, заданной заменяющей строкой:
use Illuminate\Support\Str;

$replaced = Str::of('(+1) 501-555-1000')->replaceMatches('/[^A-Za-z0-9]++/', '')

// '15015551000'
Метод replaceMatches также принимает Closure, который будет вызываться с каждой частью строки, соответствующей данной стороне, что позволяет вам выполнить логику замены в Closure и вернуть замененное значение:

use Illuminate\Support\Str;

$replaced = Str::of('123')->replaceMatches('/\d/', function ($match) {
    return '['.$match[0].']';
});

// '[1][2][3]'

rtrim
Метод rtrim обрезает данную строку справа:
use Illuminate\Support\Str;

$string = Str::of('  Laravel  ')->rtrim();

// '  Laravel'

$string = Str::of('/Laravel/')->rtrim('/');

// '/Laravel'

singular
singular метод преобразует строку в ее особую форму. Эта функция в настоящее время поддерживает только английский язык:
use Illuminate\Support\Str;

$singular = Str::of('cars')->singular();

// car

$singular = Str::of('children')->singular();

// child

slug
Метод slug генерирует дружественный URL-адрес "slug" из заданной строки:
use Illuminate\Support\Str;

$slug = Str::of('Laravel Framework')->slug('-');

// laravel-framework

snake
Метод snake преобразует данную строку в snake_case:
use Illuminate\Support\Str;

$converted = Str::of('fooBar')->snake();

// foo_bar

split
Метод split разбивает строку на коллекцию с помощью регулярного выражения:
use Illuminate\Support\Str;

$segments = Str::of('one, two, three')->split('/[\s,]+/');

// collect(["one", "two", "three"])

start
Метод start добавляет один экземпляр заданного значения в строку, если она еще не начинается со значения:
use Illuminate\Support\Str;

$adjusted = Str::of('this/string')->start('/');

// /this/string

$adjusted = Str::of('/this/string')->start('/');

// /this/string

startsWith
Метод startWith определяет, начинается ли данная строка с заданного значения:
use Illuminate\Support\Str;

$result = Str::of('This is my name')->startsWith('This');

// true

studly
Метод studly преобразует данную строку в StudlyCase:
use Illuminate\Support\Str;

$converted = Str::of('foo_bar')->studly();

// FooBar

substr
Метод substr возвращает часть строки, указанную заданными параметрами start и length:
use Illuminate\Support\Str;

$string = Str::of('Laravel Framework')->substr(8);

// Framework

$string = Str::of('Laravel Framework')->substr(8, 5);

// Frame

title
Метод title преобразует данную строку в Title Case:

use Illuminate\Support\Str;

$converted = Str::of('a nice title uses the correct case')->title();

// A Nice Title Uses The Correct Case

trim
Метод trim обрезает данную строку:
use Illuminate\Support\Str;

$string = Str::of('  Laravel  ')->trim();

// 'Laravel'

$string = Str::of('/Laravel/')->trim('/');

// 'Laravel'

ucfirst
Метод ucfirst возвращает заданную строку с заглавными буквами:
use Illuminate\Support\Str;

$string = Str::of('foo bar')->ucfirst();

// Foo bar

upper
upper метод преобразует данную строку в верхний регистр:
use Illuminate\Support\Str;

$adjusted = Str::of('laravel')->upper();

// LARAVEL

when
Метод when вызывает заданное замыкание, если заданное условие истинно. Closure получит свободный экземпляр строки:
use Illuminate\Support\Str;

$string = Str::of('Taylor')
                ->when(true, function ($string) {
                    return $string->append(' Otwell');
                });

// 'Taylor Otwell'
При необходимости вы можете передать другое Closure в качестве третьего параметра метода when. Это закрытие будет выполнено, если параметр условия оценивается как ложь.


whenEmpty
Метод whenEmpty вызывает данное закрытие, если строка пуста. Если Closure возвращает значение, это значение также будет возвращено методом whenEmpty. Если Closure не возвращает значение, будет возвращен свободный экземпляр строки:
use Illuminate\Support\Str;

$string = Str::of('  ')->whenEmpty(function ($string) {
    return $string->trim()->prepend('Laravel');
});

// 'Laravel'

words
Метод words ограничивает количество слов в строке:
use Illuminate\Support\Str;

$string = Str::of('Perfectly balanced, as all things should be.')->words(3, ' >>>');

// Perfectly balanced, as >>>



URL-адреса
action

Сгенерировать URL для заданного действия контроллера.
$url = action([HomeController::class, 'index']);
Если метод принимает параметры маршрута, вы можете передать их вторым аргументом:
$url = action([UserController::class, 'profile'], ['id' => 1]);

asset()
asset

Сгенерировать URL к ресурсу (изображению и пр.) на основе текущей схемы запроса (HTTP или HTTPS):

$url = asset('img/photo.jpg');
Вы можете настроить хост URL ресурса, установив переменную ASSET_URL в вашем файле .env. Это может быть полезно, если вы размещаете свои активы на внешнем сервисе, таком как Amazon S3:
// ASSET_URL=http://example.com/assets

$url = asset('img/photo.jpg'); // http://example.com/assets/img/photo.jpg

route()
Функция route генерирует URL-адрес для заданного именованного маршрута:
$url = route('routeName');
Если маршрут принимает параметры, вы можете передать их в качестве второго аргумента метода:
$url = route('routeName', ['id' => 1]);
По умолчанию функция route генерирует абсолютный URL. Если вы хотите сгенерировать относительный URL-адрес, вы можете передать false в качестве третьего аргумента
$url = route('routeName', ['id' => 1], false);

secure_asset()
Функция secure_asset генерирует URL-адрес ресурса с использованием HTTPS:
$url = secure_asset('img/photo.jpg');

secure_url()
Функция secure_url генерирует полный URL-адрес HTTPS для указанного пути:
$url = secure_url('user/profile');

$url = secure_url('user/profile', [1]);

url()
Функция url генерирует полный URL-адрес по заданному пути:
$url = url('user/profile');

$url = url('user/profile', [1]);
Если путь не указан, возвращается экземпляр Illuminate \ Routing \ UrlGenerator:
$current = url()->current();

$full = url()->full();

$previous = url()->previous();

Прочее
+ 5.3

добавлено в 5.3 (28.01.2017)
abort

Выбросить HTTP-исключение, которое будет отображено обработчиком исключений:

abort(401);

Вы можете передать текст для вывода при ответе с этим исключением:
abort(403, 'Unauthorized.', $headers);

abort_if()
Выбросить HTTP-исключение, если заданное логическое выражение равно true:

abort_if(! Auth::user()->isAdmin(), 403);
Как и в случае с методом abort, вы также можете предоставить текст ответа исключения в качестве третьего аргумента и массив настраиваемых заголовков ответа в качестве четвертого аргумента.

abort_unless()
Выбросить HTTP-исключение, если заданное логическое выражение равно false:

abort_unless(Auth::user()->isAdmin(), 403);

159 / 5000
Результаты перевода
Как и в случае с методом прерывания, вы также можете предоставить текст ответа исключения в качестве третьего аргумента и массив настраиваемых заголовков ответа в качестве четвертого аргумента.

app()
Функция app возвращает экземпляр контейнера службы:
$container = app();
Вы можете передать имя класса или интерфейса, чтобы разрешить его из контейнера:
$api = app('HelpSpot\API');

auth()
Функция auth() возвращает экземпляр аутентификатора. Вы можете использовать её вместо фасада Auth для удобства:
PHP

$user = auth()->user();

При необходимости вы можете указать, к какому экземпляру защиты вы хотите получить доступ:
$user = auth('admin')->user();

back()
Функция back() создаёт отклик-переадресацию на предыдущую страницу:
return back($status = 302, $headers = [], $fallback = false);
return back();

bcrypt()
bcrypt

Функция bcrypt() хеширует переданное значение с помощью Bcrypt. Вы можете использовать её вместо фасада Hash:
PHP

$password = bcrypt('my-secret-password');


blank()
blank функция возвращает, является ли данное значение «пустым»:
blank('');
blank('   ');
blank(null);
blank(collect());

// true

blank(0);
blank(true);
blank(false);

// false
For the inverse of blank, see the filled method.


broadcast()
Функция broadcast транслирует данное событие своим слушателям:
broadcast(new UserRegistered($user));

cache()
Функция cache может использоваться для получения значений из кеша. Если данный ключ не существует в кеше, будет возвращено необязательное значение по умолчанию:
$value = cache('key');

$value = cache('key', 'default');
Вы можете добавлять элементы в кеш, передавая в функцию массив пар ключ / значение. Вы также должны передать количество секунд или продолжительность, в течение которых кешируемое значение должно считаться действительным:
cache(['key' => 'value'], 300);

cache(['key' => 'value'], now()->addSeconds(10));

class_uses_recursive()
Функция class_uses_recursive возвращает все признаки, используемые классом, включая признаки, используемые всеми его родительскими классами:
$traits = class_uses_recursive(App\Models\User::class);

collect()
collect

Функция collect() создаёт экземпляр коллекции из переданного массива:

$collection = collect(['taylor', 'abigail']);

config

Функция config() получает значение переменной из конфигурации. К значениям конфигурации можно обращаться с помощью «точечного» синтаксиса, в котором указывается имя файла и необходимый параметр. Можно указать значение по умолчанию, которое будет возвращено, если параметра не существует:

$value = config('app.timezone');

$value = config('app.timezone', $default);

Функцию config() можно использовать для задания переменных конфигурации во время выполнения, передав массив пар ключ/значение:
PHP

config(['app.debug' => true]);


cookie()
Функция cookie создает новый экземпляр cookie:
$cookie = cookie('name', 'value', $minutes);

csrf_field()
Функция csrf_field() создаёт скрытое поле ввода HTML, содержащее значение CSRF-последовательности. Например, используя синтаксис Blade:
{{ csrf_field() }}

csrf_token()
Функция csrf_token извлекает значение текущего токена CSRF: Получить текущее значение CSRF-последовательности.
$token = csrf_token();

dd()
dd

Вывести дамп переменных и завершить выполнение скрипта.

dd($value);

dd($value1, $value2, $value3, ...);

+ 5.2

добавлено в 5.2 (08.12.2016)

Если вы не хотите останавливать выполнение скрипта, используйте функцию dump():

dump($value);

dispatch

Поместить новую задачу в очередь задач Laravel:

dispatch(new App\Jobs\SendEmails);


dispatch_now()
Функция dispatch_now немедленно запускает данное задание и возвращает значение из своего метода handle:
$result = dispatch_now(new App\Jobs\SendEmails);

dump()
Функция dump сбрасывает заданные переменные:
dump($value);

dump($value1, $value2, $value3, ...);
Если вы хотите остановить выполнение сценария после сброса переменных, используйте вместо этого функцию dd.


env

Получить значение переменной среды или вернуть значение по умолчанию.
PHP

$env = env('APP_ENV');

// Возврат значения по умолчанию, если переменная не существует...
$env = env('APP_ENV', 'production');
Если вы выполняете команду config: cache во время процесса развертывания, вы должны быть уверены, что вызываете функцию env только из ваших файлов конфигурации. После кэширования конфигурации файл .env не будет загружен, и все вызовы функции env вернут значение null.


event
Отправить указанное событие его слушателям:
event(new UserRegistered($user));


filled()
filled функция возвращает, не является ли данное значение «пустым»:
filled(0);
filled(true);
filled(false);

// true

filled('');
filled('   ');
filled(null);
filled(collect());

// false
For the inverse of filled, see the blank method.

info
Записать информацию в журнал (log):
info('Некая полезная информация!');
В функцию можно передать массив контекстных данных:
info('Неудачная попытка входа пользователя.', ['id' => $user->id]);

logger

Записать в журнал сообщение уровня «debug»:

logger('Отладочное сообщение');

В функцию можно передать массив контекстных данных:

logger('Вход пользователя.', ['id' => $user->id]);

Если в функцию не переданы значения, будет возвращён экземпляр логгера:

logger()->error('Вам сюда нельзя.');


method_field

Функция method_field() создаёт скрытое поле ввода HTML, содержащее подменённое значение HTTP-типа формы. Например, используя синтаксис Blade:
<form method="POST">
    {{ method_field('DELETE') }}
</form>

now()
Функция now создает новый экземпляр Illuminate \ Support \ Carbon для текущего времени:
$now = now();

old()
Функция old() получает значение «старого» ввода, переданного в сессию:

$value = old('value');

$value = old('value', 'default');


optional()
optional функция принимает любой аргумент и позволяет вам получать доступ к свойствам или вызывать методы этого объекта. Если данный объект имеет значение null, свойства и методы будут возвращать значение null вместо того, чтобы вызывать ошибку:
return optional($user->address)->street;
{!! old('name', optional($user)->name) !!}
optional функция также принимает закрытие в качестве второго аргумента. Закрытие будет вызвано, если значение, указанное в качестве первого аргумента, не равно нулю:
return optional(User::find($id), function ($user) {
    return $user->name;
});

policy()
Метод policy извлекает экземпляр политики для данного класса:

redirect()
Функция redirect() возвращает HTTP-отклик переадресации, или экземпляр переадресатора, если вызывается без аргументов:
return redirect($to = null, $status = 302, $headers = [], $secure = null);

return redirect('/home');

return redirect()->route('route.name');

report()
Функция report сообщит об исключении, используя ваш обработчик исключений:
report($e);

request()
Функция request() возвращает экземпляр текущего запроса или получает элемент ввода:
$request = request();

$value = request('key', $default);

rescue()
Функция rescue выполняет данное Замыкание и перехватывает любые исключения, возникающие во время его выполнения. Все перехваченные исключения будут отправлены вашему обработчику исключений; однако запрос продолжит обработку:
return rescue(function () {
    return $this->method();
});
Вы также можете передать второй аргумент функции rescue. Этот аргумент будет значением "по умолчанию", которое должно быть возвращено, если во время выполнения Closure возникает исключение:
return rescue(function () {
    return $this->method();
}, false);

return rescue(function () {
    return $this->method();
}, function () {
    return $this->failure();
});

resolve()
Функция resolve разрешает данный класс или имя интерфейса в его экземпляр, используя контейнер службы:
$api = resolve('HelpSpot\API');

response
Функция response() создаёт экземпляр отклика или получает экземпляр фабрики откликов:
return response('Hello World', 200, $headers);
return response()->json(['foo' => 'bar'], 200, $headers);

retry()
Функция retry пытается выполнить данный обратный вызов, пока не будет достигнут заданный максимальный порог попытки. Если обратный вызов не вызывает исключения, возвращается его возвращаемое значение. Если обратный вызов вызывает исключение, он будет автоматически повторен. Если максимальное количество попыток превышено, будет выдано исключение:
return retry(5, function () {
    // Attempt 5 times while resting 100ms in between attempts...
}, 100);

session()
Функция session() используется для получения или задания значений сессии:

$value = session('key');

Вы можете задать значения, передав массив пар ключ/значение в функцию:

session(['chairs' => 7, 'instruments' => 3]);

Если в функцию не было передано значение, то она вернёт значения сессии:

$value = session()->get('key');

session()->put('key', $value);


tap()
Функция tap принимает два аргумента: произвольное значение $ и закрытие. Значение $ будет передано в Closure, а затем будет возвращено функцией tap. Возвращаемое значение Closure не имеет значения:
$user = tap(User::first(), function ($user) {
    $user->name = 'taylor';

    $user->save();
});
Если в функцию tap не передается закрытие, вы можете вызвать любой метод для данного значения $. Возвращаемое значение метода, который вы вызываете, всегда будет $ value, независимо от того, что метод фактически возвращает в своем определении. Например, метод update Eloquent обычно возвращает целое число. Однако мы можем заставить метод вернуть саму модель, связав вызов метода update через функцию tap:
$user = tap($user)->update([
    'name' => $name,
    'email' => $email,
]);
Чтобы добавить в класс метод tap, вы можете добавить в класс черту Illuminate \ Support \ Traits \ Tappable. Метод tap этой черты принимает закрытие как единственный аргумент. Сам экземпляр объекта будет передан Closure, а затем будет возвращен методом tap:

return $user->tap(function ($user) {
    //
});

throw_if()
Функция throw_if генерирует данное исключение, если данное логическое выражение имеет значение true:
throw_if(! Auth::user()->isAdmin(), AuthorizationException::class);

throw_if(
    ! Auth::user()->isAdmin(),
    AuthorizationException::class,
    'You are not allowed to access this page'
);

throw_unless()
Функция throw_unless генерирует данное исключение, если данное логическое выражение оценивается как false:
throw_unless(Auth::user()->isAdmin(), AuthorizationException::class);

throw_unless(
    Auth::user()->isAdmin(),
    AuthorizationException::class,
    'You are not allowed to access this page'
);

today()
Функция today создает новый экземпляр Illuminate \ Support \ Carbon для текущей даты:
$today = today();

trait_uses_recursive()
Функция trait_uses_recursive возвращает все признаки, используемые признаком:
$traits = trait_uses_recursive(\Illuminate\Notifications\Notifiable::class);

transform()
Функция transform выполняет Closure для данного значения, если значение не пустое, и возвращает результат Closure:
$callback = function ($value) {
    return $value * 2;
};

$result = transform(5, $callback);

// 10
Значение по умолчанию или Closure также можно передать в качестве третьего параметра метода. Это значение будет возвращено, если заданное значение пустое:
$result = transform(null, $callback, 'The value is blank');

// The value is blank

validator()
Функция validator создает новый экземпляр валидатора с заданными аргументами. Вы можете использовать его вместо фасада Validator для удобства:
$validator = validator($data, $rules, $messages);

value()
value

Если переданное значение — функция-замыкание, то вызвать её и вернуть результат. В противном случае вернуть само значение.
$result = value(true);

// true

$result = value(function () {
    return false;
});

// false

view()
view

Получить экземпляр представления:

return view('auth.login');


with
Функция with возвращает заданное значение. Если Closure передается в качестве второго аргумента функции, Closure будет выполнено, и его результат будет возвращен:
$callback = function ($value) {
    return (is_numeric($value)) ? $value * 2 : 0;
};

$result = with(5, $callback);

// 10

$result = with(null, $callback);

// 0

$result = with(5, null);

// 5
    </div>
    <div class="theme">
        <h2 class="theme__title">
            HTTP Client
        </h2>

Laravel предоставляет выразительный минимальный API-интерфейс для HTTP-клиента Guzzle, позволяющий быстро выполнять исходящие HTTP-запросы для связи с другими веб-приложениями. Обертка Laravel вокруг Guzzle сосредоточена на наиболее распространенных вариантах использования и дает прекрасные возможности для разработчиков.

Прежде чем начать, вы должны убедиться, что вы установили пакет Guzzle как зависимость вашего приложения. По умолчанию Laravel автоматически включает эту зависимость:
composer require guzzlehttp/guzzle


Делаем запросы
Чтобы делать запросы, вы можете использовать методы get, post, put, patch и delete. Во-первых, давайте рассмотрим, как сделать базовый запрос GET:
use Illuminate\Support\Facades\Http;

$response = Http::get('http://example.com');
Метод get возвращает экземпляр Illuminate \ Http \ Client \ Response, который предоставляет различные методы, которые можно использовать для проверки ответа:
$response->body() : string;
$response->json() : array|mixed;
$response->status() : int;
$response->ok() : bool;
$response->successful() : bool;
$response->failed() : bool;
$response->serverError() : bool;
$response->clientError() : bool;
$response->header($header) : string;
$response->headers() : array;
Объект Illuminate \ Http \ Client \ Response также реализует интерфейс PHP ArrayAccess, позволяя вам получать доступ к данным ответа JSON непосредственно в ответе:
return Http::get('http://example.com/users/1')['name'];

Данные запроса
Конечно, при использовании POST, PUT и PATCH обычно отправляются дополнительные данные с вашим запросом. Итак, эти методы принимают массив данных в качестве второго аргумента. По умолчанию данные будут отправляться с использованием типа содержимого application / json:
$response = Http::post('http://example.com/users', [
    'name' => 'Steve',
    'role' => 'Network Administrator',
]);


Параметры запроса GET-запроса
При выполнении запросов GET вы можете либо напрямую добавить строку запроса к URL-адресу, либо передать массив пар ключ / значение в качестве второго аргумента метода get:
$response = Http::get('http://example.com/users', [
    'name' => 'Taylor',
    'page' => 1,
]);

Отправка запросов с закодированными URL-адресами
Если вы хотите отправлять данные с использованием типа содержимого application / x-www-form-urlencoded, перед отправкой запроса следует вызвать метод asForm:
$response = Http::asForm()->post('http://example.com/users', [
    'name' => 'Sara',
    'role' => 'Privacy Consultant',
]);

Отправка необработанного тела запроса
Вы можете использовать метод withBody, если хотите предоставить необработанное тело запроса при его выполнении:
$response = Http::withBody(
    base64_encode($photo), 'image/jpeg'
)->post('http://example.com/photo');


Многостраничные запросы
Если вы хотите отправлять файлы в виде запросов, состоящих из нескольких частей, перед отправкой запроса следует вызвать метод attach. Этот метод принимает имя файла и его содержимое. При желании вы можете указать третий аргумент, который будет считаться именем файла:
$response = Http::attach(
    'attachment', file_get_contents('photo.jpg'), 'photo.jpg'
)->post('http://example.com/attachments');
Вместо передачи необработанного содержимого файла вы также можете передать ресурс потока:
$photo = fopen('photo.jpg', 'r');

$response = Http::attach(
    'attachment', $photo, 'photo.jpg'
)->post('http://example.com/attachments');


Заголовки
Заголовки могут быть добавлены к запросам с помощью метода withHeaders. Этот метод withHeaders принимает массив пар ключ / значение:
$response = Http::withHeaders([
    'X-First' => 'foo',
    'X-Second' => 'bar'
])->post('http://example.com/users', [
    'name' => 'Taylor',
]);


Аутентификация
Вы можете указать учетные данные базовой и дайджест-аутентификации с помощью методов withBasicAuth и withDigestAuth соответственно:
// Basic authentication...
$response = Http::withBasicAuth('taylor@laravel.com', 'secret')->post(...);

// Digest authentication...
$response = Http::withDigestAuth('taylor@laravel.com', 'secret')->post(...);


Жетоны на предъявителя
Если вы хотите добавить в запрос Authorization bearer token header, вы можете использовать метод withToken:
$response = Http::withToken('token')->post(...);


Тайм-аут
Метод timeout может использоваться для указания максимального количества секунд ожидания ответа:
$response = Http::timeout(3)->get(...);
Если заданный таймаут превышен, будет брошен экземпляр Illuminate \ Http \ Client \ ConnectionException.


Повторные попытки
Если вы хотите, чтобы HTTP-клиент автоматически повторял запрос при возникновении ошибки клиента или сервера, вы можете использовать метод retry. Метод retry принимает два аргумента: количество попыток выполнения запроса и количество миллисекунд, которые Laravel должен ждать между попытками:
$response = Http::retry(3, 100)->post(...);
Если все запросы терпят неудачу, будет брошен экземпляр Illuminate \ Http \ Client \ RequestException.


Обработка ошибок
В отличие от поведения Guzzle по умолчанию, клиентская оболочка HTTP Laravel не генерирует исключения при ошибках клиента или сервера (ответы серверов уровня 400 и 500). Вы можете определить, была ли возвращена одна из этих ошибок, используя successful, clientError, or serverError methods:
// Determine if the status code was >= 200 and < 300...
$response->successful();

// Determine if the status code was >= 400...
$response->failed();

// Determine if the response has a 400 level status code...
$response->clientError();

// Determine if the response has a 500 level status code...
$response->serverError();


Выбрасывание исключений
Если у вас есть экземпляр ответа и вы хотите выбросить экземпляр Illuminate \ Http \ Client \ RequestException, если ответ является ошибкой клиента или сервера, вы можете использовать метод throw:
$response = Http::post(...);

// Throw an exception if a client or server error occurred...
$response->throw();

return $response['user']['id'];
Экземпляр Illuminate \ Http \ Client \ RequestException имеет общедоступное свойство $ response, которое позволит вам проверить возвращенный ответ.

Метод throw возвращает экземпляр ответа, если ошибок не произошло, что позволяет связать другие операции с методом throw:
return Http::post(...)->throw()->json();
Если вы хотите выполнить некоторую дополнительную логику до создания исключения, вы можете передать Closure методу throw. Исключение будет сгенерировано автоматически после вызова Closure, поэтому вам не нужно повторно генерировать исключение из Closure:
return Http::post(...)->throw(function ($response, $e) {
    //
})->json();

Guzzle Options
Вы можете указать дополнительные параметры запроса Guzzle с помощью метода withOptions. Метод withOptions принимает массив пар ключ / значение:
$response = Http::withOptions([
    'debug' => true,
])->get('http://example.com/users');

Тестирование

Многие сервисы Laravel предоставляют функциональные возможности, которые помогут вам легко и выразительно писать тесты, и HTTP-оболочка Laravel не является исключением. Поддельный метод фасада Http позволяет указать HTTP-клиенту возвращать заглушенные / фиктивные ответы при выполнении запросов.

Поддельные ответы

Например, чтобы указать HTTP-клиенту возвращать пустые 200 ответов с кодом состояния для каждого запроса, вы можете вызвать fake метод без аргументов:
use Illuminate\Support\Facades\Http;

Http::fake();

$response = Http::post(...);

При подделке запросов промежуточное ПО HTTP-клиента не выполняется. Вы должны определить ожидания для ложных ответов, как если бы это промежуточное программное обеспечение работало правильно.


Подделка определенных URL-адресов
В качестве альтернативы вы можете передать массив fake методу. Ключи массива должны представлять шаблоны URL, которые вы хотите подделать, и связанные с ними ответы. Символ * может использоваться как подстановочный знак. Любые запросы к URL-адресам, которые не были подделаны, будут выполнены. Вы можете использовать метод response для создания тупиковых / поддельных ответов для этих конечных точек:
Http::fake([
    // Stub a JSON response for GitHub endpoints...
    'github.com/*' => Http::response(['foo' => 'bar'], 200, ['Headers']),

    // Stub a string response for Google endpoints...
    'google.com/*' => Http::response('Hello World', 200, ['Headers']),
]);
Если вы хотите указать шаблон резервного URL-адреса, который заглушит все несовпадающие URL-адреса, вы можете использовать один символ *:
Http::fake([
    // Stub a JSON response for GitHub endpoints...
    'github.com/*' => Http::response(['foo' => 'bar'], 200, ['Headers']),

    // Stub a string response for all other endpoints...
    '*' => Http::response('Hello World', 200, ['Headers']),
]);

Поддельные последовательности ответов
Иногда вам может потребоваться указать, что один URL-адрес должен возвращать серию поддельных ответов в определенном порядке. Вы можете сделать это, используя метод Http :: sequence для построения ответов:
Http::fake([
    // Stub a series of responses for GitHub endpoints...
    'github.com/*' => Http::sequence()
                            ->push('Hello World', 200)
                            ->push(['foo' => 'bar'], 200)
                            ->pushStatus(404),
]);
Когда все ответы в последовательности ответов будут использованы, любые дальнейшие запросы приведут к тому, что последовательность ответов вызовет исключение. Если вы хотите указать ответ по умолчанию, который должен возвращаться, когда последовательность пуста, вы можете использовать метод whenEmpty:
Http::fake([
    // Stub a series of responses for GitHub endpoints...
    'github.com/*' => Http::sequence()
                            ->push('Hello World', 200)
                            ->push(['foo' => 'bar'], 200)
                            ->whenEmpty(Http::response()),
]);
Если вы хотите подделать последовательность ответов, но не должны указывать конкретный шаблон URL, который следует подделать, вы можете использовать метод Http :: fakeSequence:
Http::fakeSequence()
        ->push('Hello World', 200)
        ->whenEmpty(Http::response());

Поддельный обратный звонок
Если вам требуется более сложная логика, чтобы определить, какие ответы возвращать для определенных конечных точек, вы можете передать обратный вызов fake методу. Этот обратный вызов получит экземпляр Illuminate \ Http \ Client \ Request и должен вернуть экземпляр ответа:
Http::fake(function ($request) {
    return Http::response('Hello World', 200);
});

Проверка запросов

При подделке ответов вы можете иногда захотеть проверить запросы, которые получает клиент, чтобы убедиться, что ваше приложение отправляет правильные данные или заголовки. Это можно сделать, вызвав метод Http :: assertSent после вызова Http :: fake.

Метод assertSent принимает обратный вызов, которому будет предоставлен экземпляр Illuminate \ Http \ Client \ Request, и он должен вернуть логическое значение, указывающее, соответствует ли запрос вашим ожиданиям. Для успешного прохождения теста должен быть выдан хотя бы один запрос, соответствующий заданным ожиданиям:
Http::fake();

Http::withHeaders([
    'X-First' => 'foo',
])->post('http://example.com/users', [
    'name' => 'Taylor',
    'role' => 'Developer',
]);

Http::assertSent(function ($request) {
    return $request->hasHeader('X-First', 'foo') &&
           $request->url() == 'http://example.com/users' &&
           $request['name'] == 'Taylor' &&
           $request['role'] == 'Developer';
});
При необходимости вы можете утверждать, что конкретный запрос не был отправлен с помощью метода assertNotSent:
Http::fake();

Http::post('http://example.com/users', [
    'name' => 'Taylor',
    'role' => 'Developer',
]);

Http::assertNotSent(function (Request $request) {
    return $request->url() === 'http://example.com/posts';
});
Или, если вы хотите подтвердить, что запросы не были отправлены, вы можете использовать метод assertNothingSent:
Http::fake();

Http::assertNothingSent();
    </div>
    <div class="theme">
        <h2 class="theme__title">
            Работа с e-mail
        </h2>
Laravel предоставляет простой API к популярной библиотеке SwiftMailer с драйверами для SMTP, Mailgun, SparkPost, Amazon SES, PHP-функций mail и sendmail, поэтому вы можете быстро приступить к рассылке почты с помощью локального или облачного сервиса на ваш выбор.

Настройка
Почтовые службы Laravel можно настроить с помощью файла конфигурации mail. Каждая почтовая программа, настроенная в этом файле, может иметь свои собственные параметры и даже свой собственный уникальный «транспорт», что позволяет вашему приложению использовать различные почтовые службы для отправки определенных электронных сообщений. Например, ваше приложение может использовать Postmark для отправки транзакционной почты, а Amazon SES - для массовых рассылок.


Требования для драйверов

Основанные на API драйвера, такие как Mailgun и Postmark, часто гораздо проще и быстрее, чем SMTP-серверы. Вам следует использовать один из таких драйверов, если это возможно. Для работы таких драйверов необходимо, чтобы в вашем приложении была установлена HTTP-библиотека Guzzle, которую можно установить через менеджер пакетов Composer:

composer require guzzlehttp/guzzle

Драйвер Mailgun

Для использования драйвера Mailgun установите Guzzle и задайте для параметра driver в конфиге config/mail.php значение mailgun. Затем проверьте, что в конфиге config/services.php содержатся следующие параметры:
'mailgun' => [
    'domain' => env('MAILGUN_DOMAIN'),
    'secret' => env('MAILGUN_SECRET'),
],
Если вы не используете регион Mailgun «США», вы можете определить конечную точку своего региона в файле конфигурации services:
'mailgun' => [
    'domain' => env('MAILGUN_DOMAIN'),
    'secret' => env('MAILGUN_SECRET'),
    'endpoint' => env('MAILGUN_ENDPOINT', 'api.eu.mailgun.net'),
],
Postmark Driver
Чтобы использовать драйвер Postmark, установите транспорт Postmark SwiftMailer через Composer:
composer require wildbit/swiftmailer-postmark
Затем установите Guzzle и установите параметр default в конфигурационном файле config / mail.php на postmark. Наконец, убедитесь, что ваш файл конфигурации config / services.php содержит следующие параметры:
'postmark' => [
    'token' => env('POSTMARK_TOKEN'),
],
Драйвер SES

Чтобы использовать драйвер Amazon SES, установите Amazon AWS SDK для PHP. Вы можете установить эту библиотеку, добавив следующую строку в раздел require файла composer.json и выполнив команду composer update:

"aws/aws-sdk-php": "~3.0"

Затем задайте для параметра driver в конфиге config/mail.php значение ses и проверьте, что в файле config/services.php содержатся следующие параметры:
'ses' => [
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
],
Если вам нужно включить дополнительные параметры при выполнении запроса SES SendRawEmail, вы можете определить массив options в своей конфигурации ses:

'ses' => [
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    'options' => [
        'ConfigurationSetName' => 'MyConfigurationSet',
        'Tags' => [
            [
                'Name' => 'foo',
                'Value' => 'bar',
            ],
        ],
    ],
],

Генерация Mailables

В Laravel каждый тип email-сообщений, отправляемых вашим приложением, представлен классом "mailable". Эти классы хранятся в директории app/Mail. Не волнуйтесь, если не видите этту директорию в своем приложении, так как она будет сгенерирована когда вы создадите первый подобный класс, используя командуmake:mail:

php artisan make:mail OrderShipped

Написание Mailables

Настройка класса mailable выполняется в методе build. В рамках этого метода можно вызвать различные методы, такие как from, subject, view и attach для настройки самого электронного письма и его доставки.
Настройка отправителя
Использование метода from

Сначала давайте рассмотрим настройку отправителя электронных писем. Или, другими словами, кто будет указан в поле отправителя - "from". Есть два способа настройки отправителя. Во-первых, можно использовать метод from внутри вашего метода mailable-класса build:

/**
 * Построение сообщения.
 *
 * @return $this
 */
public function build()
{
    return $this->from('example@example.com')
                ->view('emails.orders.shipped');
}

Использование глобального адреса from

Однако, если ваше приложение использует один и тот же адрес "from" во всех своих письмах, будет довольно утомительно вызывать метод from в каждом генерируемом классе mailable. Вместо этого можно указать глобальный адрес "from" в конфиге config/mail.php. Этот адрес будет использоваться, если больше не указан ни один адрес "from" в классе mailable:

'from' => ['address' => 'example@example.com', 'name' => 'App Name'],
Кроме того, вы можете определить глобальный адрес «reply_to» в файле конфигурации config / mail.php:
'reply_to' => ['address' => 'example@example.com', 'name' => 'App Name'],

Настройка шаблона

В методе build mailable-класса можно использовать метод view, чтобы указать какой шаблон следует использовать при визуальном представлении содержимого этого email-сообщения. Как как каждый email обычно использует шаблон Blade для представления своего содержимого, в вашем распоряжении будет вся мощь и удобство движка обработки шаблонов Blade при построении HTML вашего электронного сообщения:

/**
 * Построение сообщения.
 *
 * @return $this
 */
public function build()
{
    return $this->view('emails.orders.shipped');
}

    Возможно, вы захотите создать директорию resources/views/emails, чтобы разместить все свои email-шаблоны; тем не менее, вы можете размещать их где угодно внутри своей директории resources/views.

Email-сообщения без форматирования

Если вы хотите определить версию своего email без форматирования, то можно использовать метод text. Как и метод view, метод text принимает имя шаблона, который будет использоваться для визуального представления содержимого письма. Вы свободно можете определить и HTML-версию и версию без форматирования своего сообщения:

/**
 * Build the message.
 *
 * @return $this
 */
public function build()
{
    return $this->view('emails.orders.shipped')
                ->text('emails.orders.shipped_plain');
}

Данные шаблона
Через общедоступные свойства

Как правило, вы захотите передать некоторые данные своему шаблону, которые можно использовать при визуальном отображении электронного сообщения в виде HTML. Существует два способа, благодаря которым можно сделать данные доступными для вашего шаблона. Первый: любое общедоступное свойство, определенное в вашем классе mailable, можно автоматически сделать доступным для шаблона. Поэтому, к примеру, вы можете передать данные своему конструктору класса mailable и изменить данные на общедоступные свойства, определенные в классе:


namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    public $order;

    /**
     * Создать новый экземпляр сообщения.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Построить сообщение.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.shipped');
    }
}

Как только данные были заменены на общедоступные свойства, они станут автоматически доступными для вашего шаблона - вы сможете получать к ним доступ так же, как и к любым другим данным в ваших шаблонах Blade:

<div>
    Price: {{ $order->price }}
</div>

Через метод with:

Если вы хотите изменить формат данных своего e-mail сообщения, прежде чем они будут отправлены шаблону, вы можете вручную передать данные шаблону через метод with. Как правило, вы все еще будете передавать данные через контруктор класса mailable; однако, вы должны задать свойства данных protected или private, чтобыд данные не были автоматически доступны шаблону. Тогда во время вызова метода with нужно передать массив данных, которые вы хотите сделать доступным для шаблона:


namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $order;

    /**
     * Создать новый экземпляр сообщения.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.shipped')
                    ->with([
                        'orderName' => $this->order->name,
                        'orderPrice' => $this->order->price,
                    ]);
    }
}

Как только данные были переданы методу with, они автоматически будут доступны в вашем шаблоне - вы сможете получить к ним доступ точно так же, как и к любым другим данным в своих шаблонах Blade:

<div>
    Price: {{ $orderPrice }}
</div>

Вложения

Чтобы добавить вложение к электронному сообщению, используйте метод attach в методе mailable-класса build. В качестве первого аргумента метод attach принимает полный путь к файлу:

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.shipped')
                    ->attach('/path/to/file');
    }

Во время присоединения файлов к сообщению, вы также можете указать отображаемое имя и / или MIME-тип, передав array в качестве второго аргумента методу attach:

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.shipped')
                    ->attach('/path/to/file', [
                        'as' => 'name.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }

Прикрепление файлов с диска

Если вы сохранили файл на одном из дисков файловой системы, вы можете прикрепить его к электронному письму с помощью метода attachFromStorage:
/**
 * Build the message.
 *
 * @return $this
 */
public function build()
{
   return $this->view('emails.orders.shipped')
               ->attachFromStorage('/path/to/file');
}
При необходимости вы можете указать имя вложения файла и дополнительные параметры, используя второй и третий аргументы метода attachFromStorage:
/**
 * Build the message.
 *
 * @return $this
 */
public function build()
{
   return $this->view('emails.orders.shipped')
               ->attachFromStorage('/path/to/file', 'name.pdf', [
                   'mime' => 'application/pdf'
               ]);
}
Метод attachFromStorageDisk можно использовать, если вам нужно указать диск хранения, отличный от диска по умолчанию:
/**
 * Build the message.
 *
 * @return $this
 */
public function build()
{
   return $this->view('emails.orders.shipped')
               ->attachFromStorageDisk('s3', '/path/to/file');
}

Вложения с сырыми данными

Метод attachData можно использовать для присоединения сырой строки байтов в качестве вложения. Например, вы можете использовать этот метод, если сгенерировали PDF в памяти и хотите присоединить его к электронному письму без записи на диск. Метод attachData принимает байты сырых данных в качестве первого аргумента, имя файла - в качестве второго аргумента, а массив опций - в качестве третьего:

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.shipped')
                    ->attachData($this->pdf, 'name.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }

Встроенные вложения

Обычно добавление встроенных вложений — утомительное занятие, однако Laravel делает его проще, позволяя вам добавлять изображения и получать соответствующие CID. Для вставки встроенного изображения используйте метод embed на переменной $message в вашем email-шаблоне. Laravel автоматически делает переменную $message доступной для всех ваших email-шаблонов, так что вам не нужно волноваться о том, чтобы передать ее вручную:

<body>
    Вот изображение:

    <img src="{{ $message->embed($pathToFile) }}">
</body>

    Переменная $message недоступна в markdown-сообщениях.

Встроенные вложения с сырыми данными

Если у вас уже есть строка с сырыми данными, которую вы хотите встроить в шаблон электронного сообщения, можно использовать метод embedData на переменной $message:

<body>
    Вот изображение из сырых данных:

    <img src="{{ $message->embedData($data, $name) }}">
</body>

Настройка сообщения SwiftMailer

Метод withSwiftMessage базового класса Mailable позволяет вам зарегистрировать анонимную функцию, которая будет вызываться экземпляром сообщения SwiftMailer перед отправкой сообщения. Это дает вам возможность кастомизировать сообщение перед тем как оно будет доставлено:

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->view('emails.orders.shipped');

        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()
                    ->addTextHeader('Custom-Header', 'HeaderValue');
        });
    }

Markdown Mailables

Mailable-сообщения в формате Markdown позволяют вам воспользоваться предварительно собранными шаблонами и компонентами почтовых уведомлений в ваших mailables. Так как сообщения написаны в формате Markdown, Laravel способен отображать красивые, отзывчивые HTML-шаблоны сообщений, в то же время генерируя идентичную копию без форматирования (только текст).
Генерация Markdown Mailables

Чтобы сгенерировать mailable с соответствующим Markdown можно использовать опцию --markdown Artisan-команды make:mail:

php artisan make:mail OrderShipped --markdown=emails.orders.shipped

Тогда при настройке mailable в своем методе build, вызовите метод markdown вместо метода view. Метод markdown принимает имя Markdown-шаблона в качестве необязательного массива данных, который затем делает доступным для шаблона:

/**
 * Build the message.
 *
 * @return $this
 */
public function build()
{
    return $this->from('example@example.com')
                ->markdown('emails.orders.shipped');
}

Написание Markdown-сообщений

Markdown mailable-сообщения используют комбинацию Blade-компонентов и синтаксиса Markdown, что позволяет вам довольно просто конструировать почтовые сообщения, используя заранее созданные компоненты Laravel:

@component('mail::message')
# Заказ отправлен

Ваш заказ был отправлен!

@component('mail::button', ['url' => $url])
Просмотреть заказ
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent

    Не используйте чрезмерное количество отступов во время написания Markdown-сообщений. Markdown парсеры выполнят содержимое с отступом в виде блоков кода.

Компонент Button (кнопка)

Компонент кнопки отображает отцентрованную ссылку-кнопку. Этот компонент принимает два аргумента: url и необязательный color. Поддерживаются цвета: blue (синий), green (зеленый) и red (красный). Вы можете добавить сколько угодно компонентов-кнопок в свое сообщение:

@component('mail::button', ['url' => $url, 'color' => 'green'])
Просмотреть заказ
@endcomponent

Компонент Panel (область)

Компонент panel отображает заданный блок текста в области с цветом фона, слегка отличающимся от заднего фона самого сообщения. Это позволяет привлечь внимание к данной области текста:

@component('mail::panel')
This is the panel content.
@endcomponent

Компонента Table (таблица)

Компонент table позволяет трансформировать Markdown-таблицу в HTML-таблицу. Этот компонент принимает Markdown-таблицу в качестве содержимого. Поддерживается выравнивание столбцов с использованием синтаксиса выравнивания в Markdown таблицах по умолчанию:

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      |      $10 |
| Col 3 is      | Right-Aligned |      $20 |
@endcomponent

Настройка компонентов

Вы можете экспортировать все Markdown-компоненты почты в собственное приложение, чтобы настроить их. Чтобы экспортировать: используйте Artisan-команду vendor:publish, чтобы опубликовать ассет-тэг laravel-mail:

php artisan vendor:publish --tag=laravel-mail

Эта команда опубликует Markdown-компоненты почты в директорию resources/views/vendor/mail. Директория mail будет содержать директорию html и markdown, каждая из которых содержит соответсвующие представления каждого доступного компонента. Вы можете свободно настраивать эти компоненты по собственному усмотрению.
Настройка CSS

После экспорта компонентов в директории resources/views/vendor/mail/html/themes будет содержаться файл default.css. Вы можете настроить CSS в этом файле, и ваши стили будут автоматически приведены в соответствие с HTML-представлениями ваших Markdown-сообщений.

Если вы хотите собрать полностью новую тему для Markdown-кмпонентов, просто напишите новый CSS-файл в директории html/themes и измените параметр theme в конфиге mail.

Если вы хотите создать совершенно новую тему для компонентов Laravel Markdown, вы можете поместить файл CSS в каталог html / themes. После присвоения имени и сохранения файла CSS обновите параметр темы в файле конфигурации почты, чтобы он соответствовал имени вашей новой темы.

Чтобы настроить тему для отдельного почтового сообщения, вы можете установить для свойства $ theme класса mailable имя темы, которое следует использовать при отправке этого почтового сообщения.

Отправка почты

Используйте метод to фасада Mail, чтобы отправить сообщение. Метод to принимает адрес email, экземпляр пользователя или коллекцию пользователей. Если вы передаете объект или коллекцию объектов, почтовая программа будет автоматически использовать их свойства email и name при настройке получателей электронного сообщения, поэтому убедитесь, что у ваших объектов есть эти атрибуты. Как только вы указали получателей, вы можете передать экземпляр своего класса mailable методу send:



namespace App\Http\Controllers;

use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Отправить заданный заказ.
     *
     * @param  Request  $request
     * @param  int  $orderId
     * @return Response
     */
    public function ship(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Отправить заказ...

        Mail::to($request->user())->send(new OrderShipped($order));
    }
}

Конечно, вы не ограничены исключительно указанием получателей в поле "to" при отправке сообщения. Также можно указать и получателей "to", "cc" и "bcc" - всех в одном связанном вызове метода:

Mail::to($request->user())
    ->cc($moreUsers)
    ->bcc($evenMoreUsers)
    ->send(new OrderShipped($order));

Цикл по получателям

Иногда вам может потребоваться отправить почтовое сообщение списку получателей, перебирая массив получателей / адресов электронной почты. Поскольку метод to добавляет адреса электронной почты в список получателей почтового сообщения, вы всегда должны повторно создавать экземпляр почтового сообщения для каждого получателя:
foreach (['taylor@example.com', 'dries@example.com'] as $recipient) {
    Mail::to($recipient)->send(new OrderShipped($order));
}

Отправка почты через определенный почтовый ящик
По умолчанию Laravel будет использовать почтовую программу, настроенную как default mailer в вашем файле конфигурации mail. Однако вы можете использовать метод mailer для отправки сообщения с использованием определенной конфигурации почтовой программы:
Mail::mailer('postmark')
        ->to($request->user())
        ->send(new OrderShipped($order));

        Очереди отправки
        Помещение сообщения в очередь отправки

Из-за того, что отправка сообщений может сильно повлиять на время обработки запроса, многие разработчики помещают их в очередь на фоновую отправку. Laravel позволяет легко делать это, используя единое API очередей. Для помещения сообщения в очередь просто используйте метод queue фасада Mail после указания получателей сообщения:

Mail::to($request->user())
    ->cc($moreUsers)
    ->bcc($evenMoreUsers)
    ->queue(new OrderShipped($order));

Этот метод автоматически позаботится о помещении в очередь задачи для фоновой отправки почтового сообщения. Конечно, вам нужно будет настроить механизм очередей перед использованием данной возможности.
Задержка отправки сообщения

Вы можете задержать отправку сообщения методом later. В качестве своего первого аргумента метод later принимает экземпляр DateTime, указывая когда следует отправить сообщение:

$when = Carbon\Carbon::now()->addMinutes(10);

Mail::to($request->user())
    ->cc($moreUsers)
    ->bcc($evenMoreUsers)
    ->later($when, new OrderShipped($order));

Помещение сообщения в определённую очередь

Так как все mailable-классы генерируемые с использованием команды make:mail используют трейт Illuminate\Bus\Queueable, вы можете вызвать методы onQueue и onConnection в любом экземпляре класса mailable, что позволит указать имя очереди и подключение для сообщения:

$message = (new OrderShipped($order))
                ->onConnection('sqs')
                ->onQueue('emails');

Mail::to($request->user())
    ->cc($moreUsers)
    ->bcc($evenMoreUsers)
    ->queue($message);

Помещение в очередь по умолчанию

Если у вас есть mailable-классы, которые всегда должны быть в очереди, вы можете реализовать на классе контракт ShouldQueue. Теперь даже если вы вызовете метод send при отправке почты, mailable все еще будет находится в очереди, так как он реализует контракт:

use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable implements ShouldQueue
{
    //
}

Обработка почтовых сообщений

Иногда вам может потребоваться захватить HTML-содержимое почтового сообщения, не отправляя его. Для этого вы можете вызвать метод render почтового сообщения. Этот метод вернет оцененное содержимое почтового сообщения в виде строки:
$invoice = App\Models\Invoice::find(1);
return (new App\Mail\InvoicePaid($invoice))->render();

Предварительный просмотр почтовых сообщений в браузере

При разработке шаблона почтового сообщения удобно быстро просмотреть визуализированное почтовое сообщение в браузере, как типичный шаблон Blade. По этой причине Laravel позволяет вам возвращать любое почтовое сообщение непосредственно из замыкания маршрута или контроллера. Когда почтовое сообщение возвращается, оно будет обработано и отображено в браузере, что позволит вам быстро просмотреть его дизайн без необходимости отправлять его на реальный адрес электронной почты:
Route::get('mailable', function () {
    $invoice = App\Models\Invoice::find(1);

    return new App\Mail\InvoicePaid($invoice);
});

Встроенные вложения не будут отображаться при предварительном просмотре почтового сообщения в вашем браузере. Чтобы просмотреть эти рассылки, вам следует отправить их в приложение для тестирования электронной почты, такое как MailHog или HELO.


Локализация почтовых отправлений

Laravel позволяет отправлять почтовые сообщения в локали, отличной от текущего языка, и даже будет помнить этот языковой стандарт, если почта находится в очереди.

Для этого фасад Mail предлагает метод locale для установки желаемого языка. Приложение изменится на этот языковой стандарт при форматировании почтового сообщения, а затем вернется к предыдущему языку после завершения форматирования:
Mail::to($request->user())->locale('es')->send(
    new OrderShipped($order)
);

Предпочитаемые пользователем регионы

Иногда приложения хранят предпочтительный языковой стандарт каждого пользователя. Реализуя контракт HasLocalePreference на одной или нескольких ваших моделях, вы можете указать Laravel использовать этот сохраненный языковой стандарт при отправке почты:
use Illuminate\Contracts\Translation\HasLocalePreference;

class User extends Model implements HasLocalePreference
{
    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale()
    {
        return $this->locale;
    }
}
После того, как вы внедрили интерфейс, Laravel будет автоматически использовать предпочтительный языковой стандарт при отправке почтовых сообщений и уведомлений в модель. Следовательно, при использовании этого интерфейса нет необходимости вызывать метод locale:
Mail::to($request->user())->send(new OrderShipped($order));

Почта и локальная разработка

При разработке приложения обычно предпочтительно отключить доставку отправляемых сообщений. В Laravel есть несколько способов "отключить" реальную отправку почтовых сообщений
Драйвер Log

Вместо отправки ваших электронных сообщений, драйвер log будет записывать все email-сообщения в ваши логи для анализа. Это полезно в первую очередь для быстрой, локальной отладки и проверки данных. Подробнее о настройке различных окружений для приложения читайте в документации по настройке.
Универсальный получатель

Другой вариант — задать универсального получателя для всех сообщений от фреймворка. при этом все сообщения, генерируемые вашим приложением, будут отсылаться на заданный адрес, вместо адреса, указанного при отправке сообщения. Это можно сделать с помощью параметра to в конфиге config/mail.php:

'to' => [
    'address' => 'example@example.com',
    'name' => 'Example'
],

Mailtrap

И, наконец, вы можете использовать сервис Mailtrap и драйвер smtp для отправки ваших почтовых сообщений на фиктивный почтовый ящик, где вы сможете посмотреть их при помощи настоящего почтового клиента. Преимущество этого вариант в том, что вы можете проверить то, как в итоге будут выглядеть ваши почтовые сообщения, при помощи средства для просмотра сообщений Mailtrap.


События
Laravel запускает два события в процессе отправки почтовых сообщений. Событие MessageSending запускается до отправки сообщения, а событие MessageSent запускается после отправки сообщения. Помните, что эти события запускаются, когда почта отправляется, а не когда она стоит в очереди. Вы можете зарегистрировать прослушиватель событий для этого события в своем EventServiceProvider:

/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    'Illuminate\Mail\Events\MessageSending' => [
        'App\Listeners\LogSendingMessage',
    ],
    'Illuminate\Mail\Events\MessageSent' => [
        'App\Listeners\LogSentMessage',
    ],
];

    </div>
    <div class="theme">
        <h2 class="theme__title">
            Уведомления
        </h2>
        Дополнительно к поддержке отправки email-сообщений, Laravel также поддерживает и отправку уведомлений по различным каналам доставки, включая почту, SMS (через Nexmo) и Slack. Уведомления также можно хранить в БД, поэтому их можно отображать в вашем интерфейсе.

        Как правило, уведомления должны быть короткими, информативными сообщениями, которые уведомляют пользователей о каком-либо событий, произошедшем в вашем приложении. Например, если вы пишете биллинг-приложение, то можете отправлять своим пользователям уведомление об оплаченном счете через каналы email и SMS.
        Создание уведомлений

        В Laravel каждое уведомление представлено единым классом (обычно хранится в директории app/Notifications). Не волнуйтесь, если не видите эту директорию в своем приложении, т.к. она будет создана, когда вы запустите Artisan-команду make:notification:

        php artisan make:notification InvoicePaid

        Эта команда поместит свежий класс уведомлений в вашу директорию app/Notifications. Каждый класс уведомления содержит метод via и переменный номер методов построения сообщений (например, toMail или toDatabase), которые конвертируют уведомление в сообщение, оптимизированное для конкретного канала.
        Отправка уведомлений
        Использование трейта Notifiable

        Уведомления можно отправлять двумя способами: используя метод notify трейта Notifiable или используя фасад Notification. Сначала давайте рассмотрим использование трейта:



        namespace App;

        use Illuminate\Notifications\Notifiable;
        use Illuminate\Foundation\Auth\User as Authenticatable;

        class User extends Authenticatable
        {
            use Notifiable;
        }

        Этот трейт используется моделью App\User по умолчанию и содержит один метод, который можно использовать для отправки уведомлений: notify. Метод notify ожидает получить экземпляр уведомления:

        use App\Notifications\InvoicePaid;

        $user->notify(new InvoicePaid($invoice));

            Помните, что можете использовать трейт Illuminate\Notifications\Notifiable на любой своей модели. Вы не ограничены включением его только в вашу модель User.

        Использование фасада Notification

        Другой способ отправки уведомлений - через фасад Notification. Это полезно, прежде всего, когда вам нужно отправить уведомление нескольким уведомляемым объектам, таким как коллекция пользователей. Чтобы отправлять уведомления с использованием фасада, передайте все уведомляемые объекты и экземпляр уведомления методу send:

        Notification::send($users, new InvoicePaid($invoice));

        Указание каналов доставки

        У каждого класса уведомлений есть метод via, который определяет по каким каналам будет доставляться это уведомление. Изначально уведомления можно отправлять на каналы mail, database, broadcast, nexmo и slack.

            Если вы бы хотели использовать другие каналы доставки, такие как Telegram или Pusher, ознакомьтесь с управляемым сообществом вебсайтом о каналах уведомлений Laravel.

        Метод via получает экземпляр $notifiable, который будет экземпляром класса, которому отправляется уведомление. Можно использовать $notifiable, чтобы определить по каким каналам следует доставлять уведомление:

        /**
         * Получить каналы доставки уведомления.
         *
         * @param  mixed  $notifiable
         * @return array
         */
        public function via($notifiable)
        {
            return $notifiable->prefers_sms ? ['nexmo'] : ['mail', 'database'];
        }

        Формирование очередей уведомлений

            Перед формированием очередей уведомлений вам следует настроить свою очередь и запустить воркер.

Отправка уведомлений может занять время, особенно если каналу требуется вызывать внешний API с целью доставки этих уведомлений. Чтобы ускорить время ответа вашего приложения, позвольте своим уведомлениям формировать очереди, добавив интерфейс ShouldQueue и трейт Queueable к своему классу. Этот интерфейс и трейт уже испортированы для всех уведомлений, сгенерированных с использованием make:notification, так что вы можете сразу же добавить их к свой класс уведомлений:


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;

    // ...
}

Как только к вашему уведомлению был добавлен интерфейс ShouldQueue, вы можете отправлять уведомления как обычно. Laravel определит интерфейс ShouldQueue в классе и автоматически поставит доставку уведомления в очередь:

$user->notify(new InvoicePaid($invoice));

Если вы бы хотели отложить доставку уведомления, то можно привязать метод delay к экземпляру вашего уведомления:

$when = Carbon::now()->addMinutes(10);

$user->notify((new InvoicePaid($invoice))->delay($delay));
Вы можете передать массив в метод delay, чтобы указать величину задержки для определенных каналов:
$user->notify((new InvoicePaid($invoice))->delay([
    'mail' => now()->addMinutes(5),
    'sms' => now()->addMinutes(10),
]));
При постановке уведомлений в очередь для каждого получателя и комбинации каналов создается задание в очереди. Например, в очередь будет отправлено шесть заданий, если у вашего уведомления три получателя и два канала.


Настройка очередей каналов уведомлений

Если вы хотите указать конкретную очередь, которая должна использоваться для каждого канала уведомления, поддерживаемого уведомлением, вы можете определить метод viaQueues в своем уведомлении. Этот метод должен возвращать массив пар имя канала / имя очереди:
**
 * Determine which queues should be used for each notification channel.
 *
 * @return array
 */
public function viaQueues()
{
    return [
        'mail' => 'mail-queue',
        'slack' => 'slack-queue',
    ];
}

Уведомления по запросу

Иногда вам может потребоваться отправить уведомление кому-то, кто не хранится как «пользователь» вашего приложения. Используя метод фасада Notification :: route, вы можете указать информацию о маршрутизации специального уведомления перед отправкой уведомления:
Notification::route('mail', 'taylor@example.com')
            ->route('nexmo', '5555555555')
            ->route('slack', 'https://hooks.slack.com/services/...')
            ->notify(new InvoicePaid($invoice));

            Mail-уведомления
            Форматирование Mail-сообщений

            Если уведомление поддерживает только отправку в виде электронного сообщения, вы должны задать класс toMail в классе уведомления. Этот метод получит сущность $notifiable и должен возвратить экземпляр Illuminate\Notifications\Messages\MailMessage. Mail-сообщения могут содержать строки текста, а также "призыв к действию". Давайте взглянем на пример метода toMail:

            /**
             * Получить представление уведомления в виде письма.
             *
             * @param  mixed  $notifiable
             * @return \Illuminate\Notifications\Messages\MailMessage
             */
            public function toMail($notifiable)
            {
                $url = url('/invoice/'.$this->invoice->id);

                return (new MailMessage)
                            ->greeting('Hello!')
                            ->line('One of your invoices has been paid!')
                            ->action('View Invoice', $url)
                            ->line('Thank you for using our application!');
            }

                Обратите внимание, что мы используем $this->invoice->id в нашем методе message. В конструктор уведомления можно передавать любые данные, которые требуются уведомлению для генерирования своего сообщения.

            В этом примере мы зарегистрируем приветствие, строку текста, призыв к действию, а затем еще одну строку текста. Эти методы, предоставляемые объектом MailMessage, делают форматирование небольших email-сообщений простым и быстрым. Почтовый канал затем будет преобразовывать компоненты сообщения в симпатичный, отзывчивый HTML email-шаблон с копией только с простым текстом. Вот пример электронного сообщения, генерируемого каналом mail:
            https://laravel.com/assets/img/notification-example.png

            {tip} При отправке уведомлений по почте не забудьте установить значение name в вашем конфиге config/app.php. Это значение будет использоваться в заголовке и подвале ваших сообщений-уведомлений по почте.
            Другие опции форматирования уведомления

            Вместо рпделения "строк" текста в классе уведомления, можно использовать методview, чтобы указать пользовательский шаблон, который следует использовать для визуализации email-уведомления:

            /**
             * Получить представление уведомления в виде письма.
             *
             * @param  mixed  $notifiable
             * @return \Illuminate\Notifications\Messages\MailMessage
             */
            public function toMail($notifiable)
            {
                return (new MailMessage)->view(
                    'emails.name', ['invoice' => $this->invoice]
                );
            }

            Дополнительно, можно возвращать mailable-объект из метода toMail:

            use App\Mail\InvoicePaid as Mailable;

            /**
             * Получить представление уведомления в виде письма.
             *
             * @param  mixed  $notifiable
             * @return Mailable
             */
            public function toMail($notifiable)
            {
                return (new Mailable($this->invoice))->to($this->user->email);
            }

            Сообщения об ошибке

            Некоторые уведомления оповещают пользователей об ошибках, например, об ошибке при оплате счета. Можно указать, что это почтовое сообщение об ошибке, вызвав метод error при построении вашего сообщения. При использовании метода error в Mail-сообщении кнопка призыва к действию будет красной, а не синей:

            /**
             * Получить представление уведомления в виде письма.
             *
             * @param  mixed  $notifiable
             * @return \Illuminate\Notifications\Message
             */
            public function toMail($notifiable)
            {
                return (new MailMessage)
                            ->error()
                            ->subject('Notification Subject')
                            ->line('...');
            }
Настройка отправителя

По умолчанию адрес отправителя / отправителя электронного письма определяется в файле конфигурации config / mail.php. Однако вы можете указать адрес отправителя для конкретного уведомления с помощью метода from:
/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    return (new MailMessage)
                ->from('test@example.com', 'Example')
                ->line('...');
}
Настройка получателя

При отправке уведомлений по mail каналу система уведомлений автоматически ищет свойство email в вашем уведомляемом объекте. Вы можете настроить, какой адрес электронной почты будет использоваться для доставки уведомления, определив метод routeNotificationForMail для объекта:
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return array|string
     */
    public function routeNotificationForMail($notification)
    {
        // Return email address only...
        return $this->email_address;

        // Return name and email address...
        return [$this->email_address => $this->name];
    }
}
Настройка темы

По умолчанию тема сообщения - название класса уведомления, форматированное в виде капитализации начальных букв всех слов в предложении ("title case"). Таким образом, если класс вашего уведомления носит название InvoicePaid, то тема этого email-сообщения будет Invoice Paid (счет оплачен). Если вы хотите указать явно заданную тему собщения, то можно вызвать метод subject при построении вашего сообщения:

/**
 * Получить представление уведомления в виде письма.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    return (new MailMessage)
                ->subject('Notification Subject')
                ->line('...');
}

Настройка почтовой программы

По умолчанию уведомление по электронной почте будет отправлено с использованием драйвера по умолчанию, определенного в файле конфигурации config / mail.php. Однако вы можете указать другую почтовую программу во время выполнения, вызвав метод mailer при создании сообщения:
/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    return (new MailMessage)
                ->mailer('postmark')
                ->line('...');
}

Настройка шаблонов

Вы можете изменить HTML-шаблон и шаблон только с текстом, используемые уведомлениями по почте, опубликовав ресурсы пакета уведомлений. После запуска этой команды шаблоны уведомлений будут располагаться в директории resources/views/vendor/notifications:

php artisan vendor:publish --tag=laravel-notifications

Вложения

Чтобы добавить вложения к уведомлению по электронной почте, используйте метод attach при создании сообщения. Метод attach принимает полный (абсолютный) путь к файлу в качестве своего первого аргумента:
/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    return (new MailMessage)
                ->greeting('Hello!')
                ->attach('/path/to/file');
}
При прикреплении файлов к сообщению вы также можете указать отображаемое имя и / или MIME-тип, передав array в качестве второго аргумента методу attach:
/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    return (new MailMessage)
                ->greeting('Hello!')
                ->attach('/path/to/file', [
                    'as' => 'name.pdf',
                    'mime' => 'application/pdf',
                ]);
}
В отличие от прикрепления файлов к объектам, подлежащим отправке по почте, вы не можете прикреплять файл непосредственно с диска хранения с помощью attachFromStorage. Лучше использовать метод attach с абсолютным путем к файлу на диске хранения. В качестве альтернативы вы можете вернуть почтовое сообщение из метода toMail.


Вложения сырых данных

Метод attachData может использоваться для прикрепления необработанной строки байтов в качестве вложения:
* Get the mail representation of the notification.
*
* @param  mixed  $notifiable
* @return \Illuminate\Notifications\Messages\MailMessage
*/
public function toMail($notifiable)
{
   return (new MailMessage)
               ->greeting('Hello!')
               ->attachData($this->pdf, 'name.pdf', [
                   'mime' => 'application/pdf',
               ]);
}
Предварительный просмотр почтовых уведомлений
При разработке шаблона почтового уведомления удобно быстро предварительно просмотреть обработанное почтовое сообщение в браузере, как в типичном шаблоне Blade. По этой причине Laravel позволяет вам возвращать любое почтовое сообщение, сгенерированное почтовым уведомлением, непосредственно из замыкания маршрута или контроллера. Когда MailMessage возвращается, оно будет обработано и отображено в браузере, что позволит вам быстро просмотреть его дизайн без необходимости отправлять его на реальный адрес электронной почты:
oute::get('mail', function () {
    $invoice = App\Invoice::find(1);

    return (new App\Notifications\InvoicePaid($invoice))
                ->toMail($invoice->user);
});

Markdown Mail-уведомления

Почтовые уведомления в формате markdown позволяют воспользоваться заранее построенными шаблонами почтовых уведомлений, в то же время давая вам свободу в написании более длинных, настроенные по вашему вкусу сообщений. Так как сообщения пишутся в формате markdown, Laravel может отображать красивые, отзывчивые HTML шаблоны для сообщений, в то же время генерируя их копию исключительно в виде текста.
Генерирование сообщения

Чтобы сгенерировать уведомление с соответствующим Markdown-шаблоном можно использовать опцию --markdown Artisan-команды make:notification:

php artisan make:notification InvoicePaid --markdown=mail.invoice.paid

Как и все другие почтовые уведомления, уведомления с Markdown-шаблонами должны определять метод toMail в классе уведомления. Однако, вместо использования методов line и action для конструирования уведомления, используйте метод markdown для указания названия Markdown-шаблона, который следует использовать:

/**
 * Получить представление уведомления в виде письма.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    $url = url('/invoice/'.$this->invoice->id);

    return (new MailMessage)
                ->subject('Invoice Paid')
                ->markdown('mail.invoice.paid', ['url' => $url]);
}

Написание сообщения

Почтовые уведомления в формате markdown используют комбинацию компонентов Blade и синтаксиса Markdown, что позволяет вам запросто конструировать уведомления, пользуясь предварительно созданными компонентами уведомлений Laravel:

@component('mail::message')
# Счет оплачен

Ваш счет был оплачен!

@component('mail::button', ['url' => $url])
Просмотреть счет
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent

Компонент Button

Компонент кнопки отображает выравненную по центру ссылку-кнопку. Этот компонент принимает два аргумента: url и необязательный color. Поддерживаются цвета: синий blue, зеленый green и красный red. К уведомлению можно добавлять сколько угодно компонентов-кнопок:

@component('mail::button', ['url' => $url, 'color' => 'green'])
Просмотреть счет
@endcomponent

Компонент Panel

Этот компонент отображает заданный блок текста на области, у которой цвет заднего фона для заданной области текста слегка отличается от фона остальной части уведомления. Это позволяет привлечь внимание к заданному блоку текста:

@component('mail::panel')
This is the panel content.
@endcomponent

Компонент Table

Компонент таблиц позволяет вам трансформировать Markdown-таблица в HTML-таблицу. Этот компонент принимает Markdown-таблицу и ее содержимое. Поддерживается выравнивание столбцов благодаря Markdown синтаксису выравнивания таблиц по умолчанию:

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

Настройка компонентов

Вы можете экспортировать все Markdown-компоненты уведомления в собственное приложение с целью настройки. Чтобы экспортировать компоненты используйте Artisan-команду vendor:publish для публикации тега ассетов laravel-mail:

php artisan vendor:publish --tag=laravel-mail

Эта команда опубликует почтовые компоненты Markdown в директорию resources/views/vendor/mail. В директории mail будут содержаться директории html иmarkdown, в каждой из которых содержится соответствующее представление каждого доступного компонента. Вы можете свободно изменять эти компоненты по собственному желанию.
Настройка CSS

После экспортирования компонентов директория resources/views/vendor/mail/html/themes будет содержать файлdefault.css. Вы можете настроить CSS в этом файле и ваши стили будут автоматически приведены в соответствие с HTML-представлениями ваших Markdown-уведомлений.

    Если вы бы хотели построить полностью новую тему для Markdown-компонентов, просто создайте новый файл CSS в директории html/themes и измените параметр theme конфига mail.

    Чтобы настроить тему для отдельного уведомления, вы можете вызвать метод theme при создании почтового сообщения уведомления. Метод theme принимает имя темы, которое следует использовать при отправке уведомления:

    /**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    return (new MailMessage)
                ->theme('invoice')
                ->subject('Invoice Paid')
                ->markdown('mail.invoice.paid', ['url' => $url]);
}


БД-уведомления
Требования

Канал уведомлений database хранит информацию уведомления в таблице базы данных. Эта таблица будет содержать такую информацию как тип уведомления, а также пользовательские данные JSON, которые описывают уведомление.

Вы можете запросить, чтобы таблица отображала уведомления в пользовательском интерфейсе вашего приложения. Но, прежде чем вы сможете это сделать, вам потребуется создать таблицу БД, которая будет содержать ваши уведомления. Можно использовать команду notifications:table для генерирования миграции с подходящей схемой таблицы:

php artisan notifications:table

php artisan migrate

Форматирование БД-уведомлений

Если уведомление можно хранить в таблице БД, вам следует задать метод toDatabase или toArray в классе уведомления. Этот метод получит сущность $notifiable и должен вернуть простой PHP массив. Возвращенный массив будет кодирован как JSON и будет храниться в столбце data вашей таблицы notifications. Давайте взглянем на метод-пример toArray:

/**
 * Получить представление уведомления в виде массива.
 *
 * @param  mixed  $notifiable
 * @return array
 */
public function toArray($notifiable)
{
    return [
        'invoice_id' => $this->invoice->id,
        'amount' => $this->invoice->amount,
    ];
}

toDatabase против toArray

Метод toArray также используется каналом broadcast, чтобы определить какие данные вещать вашему JavaScript-клиенту. Если вы хотите, чтобы у вас было два разных представления массива для каналов database и broadcast, вам следует задать метод toDatabase вместо метода toArray.
Доступ к уведомлениям

Если уведомления хранятся в БД, то вам потребуется удобный способ получить к ним доступ из уведомляемых (notifiable) сущностей. Трейт Illuminate\Notifications\Notifiable, который включен в модель Laravel App\User по умолчанию, включает Eloquent-отношение notifications, которое возвращает уведомления для сущности. В целях выборки уведомлений можно получить доступ к данному методу как и к любому другому Eloquent-отношению. По умолчанию уведомления будут отсортированы по метке created_at:

$user = App\User::find(1);

foreach ($user->notifications as $notification) {
    echo $notification->type;
}

Если вы хотите получить только "непрочитанные" уведомления, можно использовать отношение unreadNotifications. Опять же, эти уведомления будут отсортированы по метке created_at:

$user = App\User::find(1);

foreach ($user->unreadNotifications as $notification) {
    echo $notification->type;
}

    Для доступа к уведомлениям из вашего JavaScript-клиента вам следует задать контроллер уведомлений для своего приложения, который будет возвращать уведомления для уведомляемой сущности, такой как текущий пользователь. Затем вы можете выполнить HTTP-запрос к URI этого контроллера из своего JavaScript-клиента.

Пометить уведомления как прочитанные

Как правило, нужно будет помечать уведомления "прочитанными" после того, как пользователь просмотрит эти уведомления. Трейт Illuminate\Notifications\Notifiable предоставляет метод markAsRead, который обновляет столбец read_at в записи уведомления в БД:

$user = App\User::find(1);

foreach ($user->unreadNotifications as $notification) {
    $notification->markAsRead();
}

Однако, вмето прохождения в цикле по каждому уведомлению можно использовать метод markAsRead напрямую на коллекции уведомлений:

$user->unreadNotifications->markAsRead();

Вы также можете использовать запрос массового обновления, чтобы пометить все уведомления прочитанными без получения их из базы данных:

$user = App\User::find(1);

$user->unreadNotifications()->update(['read_at' => Carbon::now()]);

Конечно, можно удалить (delete) уведомления, чтобы полностью убрать их из таблицы:

$user->notifications()->delete();

Бродкаст-уведомления
Требования

Перед вещанием уведомлений вам следует настроить и ознакомиться с сервисами бродкаста событий Laravel. Вещание событий предоставляет способ реагировать на выбрасываемые со стороны сервера события Laravel от вашего JavaScript-клиента.
Форматирование уведомлений вещания

Уведомления вещания канала broadcast, использующие сервисы вещания событий Laravel, позволяют вашему JavaScript-клиенту ловить уведомления в режиме реального времени. Если уведомление поддерживает бродкаст, нужно задать метод toBroadcast в классе уведомления. Этот метод получит сущность $notifiable и должен вернуть экземпляр BroadcastMessage. Возвращаемые данные будут кодированы как JSON и будут отправлены по вебсокет-совдинению вашему JavaScript-клиенту. Рассмотрим пример метода toBroadcast:

use Illuminate\Notifications\Messages\BroadcastMessage;

/**
 * Получить вещаемое представление уведомления.
 *
 * @param  mixed  $notifiable
 * @return BroadcastMessage
 */
public function toBroadcast($notifiable)
{
    return new BroadcastMessage([
        'invoice_id' => $this->invoice->id,
        'amount' => $this->invoice->amount,
    ]);
}

Настройка очереди вещания

Все уведомления вещания становятся в очередь на вещание. Если вам нужно настроить подключение очереди или имя очереди, можно использовать методы onConnection и onQueue в BroadcastMessage:

return (new BroadcastMessage($data))
                ->onConnection('sqs')
                ->onQueue('broadcasts');

    Дополнительно к указываемым данным, уведомления вещания также будут содержать поле type, содержащее имя класса уведомления.

    Настройка типа уведомления

    В дополнение к указанным вами данным все широковещательные уведомления также имеют поле type, содержащее полное имя класса уведомления. Если вы хотите настроить type уведомления, который предоставляется клиенту JavaScript, вы можете определить метод broadcastType в классе уведомлений:
    use Illuminate\Notifications\Messages\BroadcastMessage;

    /**
     * Get the type of the notification being broadcast.
     *
     * @return string
     */
    public function broadcastType()
    {
        return 'broadcast.message';
    }

    Слушать уведомления

    Уведомления будут вещаться на приватном канале, форматированном по конвенции {notifiable}.{id}. Поэтому если вы отправляете уведомление экземпляру App\User с ID равным 1, уведомление будет вещаться только на приватном канале App.User.1. При использовании Laravel Echo можно легко слушать уведомления на канале, используя метод-хелпер notification:

    Echo.private('App.User.' + userId)
        .notification((notification) => {
            console.log(notification.type);
        });

    Настройка канала уведомлений

    Можно задать метод receivesBroadcastNotificationsOn в уведомляемой сущности, если вы хотите настроить по каким каналам уведомляемая сущность будет получать свои уведомления:


namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
        * The channels the user receives notification broadcasts on.
        *
        * @return string
        */
    public function receivesBroadcastNotificationsOn()
    {
        return 'users.'.$this->id;
    }
}

SMS-уведомления
Требования
Отправка SMS-уведомлений в Laravel обеспечивается Nexmo. Прежде чем вы сможете отправлять уведомления через Nexmo, вам необходимо установить пакет Composer laravel / nexmo-notification-channel:
composer require laravel/nexmo-notification-channel
Это также установит пакет nexmo / laravel. Этот пакет включает собственный файл конфигурации. Вы можете использовать переменные среды NEXMO_KEY и NEXMO_SECRET, чтобы установить свой открытый и секретный ключ Nexmo.

Затем вам нужно будет добавить параметр конфигурации в файл конфигурации config / services.php. Вы можете скопировать пример конфигурации ниже, чтобы начать:
'nexmo' => [
    'sms_from' => '15556666666',
],
Параметр sms_from - это номер телефона, с которого будут отправляться ваши SMS-сообщения. Вы должны сгенерировать номер телефона для своего приложения в панели управления Nexmo.

Форматирование SMS-уведомлений

Если уведомление поддерживает отправку через SMS, нужно задать метод toNexmo в классе уведомления. Данный метод получит сущность $notifiable и должен вернуть экземпляр Illuminate\Notifications\Messages\NexmoMessage:

/**
 * Get the Nexmo / SMS representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return NexmoMessage
 */
public function toNexmo($notifiable)
{
    return (new NexmoMessage)
                ->content('Your SMS message content');
}


Форматирование уведомлений о шорткодах
Laravel также поддерживает отправку уведомлений с короткими кодами, которые представляют собой предварительно определенные шаблоны сообщений в вашей учетной записи Nexmo. Вы можете указать тип уведомления (alert, 2fa, or marketing), а также пользовательские значения, которые будут заполнять шаблон:
/**
 * Get the Nexmo / Shortcode representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return array
 */
public function toShortcode($notifiable)
{
    return [
        'type' => 'alert',
        'custom' => [
            'code' => 'ABC123',
        ];
    ];
}
Как и при маршрутизации SMS-уведомлений, вы должны реализовать метод routeNotificationForShortcode в своей модели, подлежащей уведомлению.
Юникод-контент

Если ваше SMS-сообщение будет содержать символы в кодировке юникод, нужно вызвать метод unicode во время конструирования экземпляра NexmoMessage:

/**
 * Get the Nexmo / SMS representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return NexmoMessage
 */
public function toNexmo($notifiable)
{
    return (new NexmoMessage)
                ->content('Your unicode message')
                ->unicode();
}

Настройка номера "From"

Если вам нужно отправить некоторые уведомления с номера, отличающегося от телефонного номера, указанного в файле config/services.php, можно использовать метод from на экземпляре NexmoMessage:

/**
 * Get the Nexmo / SMS representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return NexmoMessage
 */
public function toNexmo($notifiable)
{
    return (new NexmoMessage)
                ->content('Your SMS message content')
                ->from('15554443333');
}

Роутинг SMS-уведомлений
Чтобы перенаправить уведомления Nexmo на правильный номер телефона, определите метод routeNotificationForNexmo для вашего уведомляемого объекта:
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForNexmo($notification)
    {
        return $this->phone_number;
    }
}

Slack-уведомления
Требования

Прежде чем начать отправлять уведомления через Slack, вам необходимо установить HTTP библиотеку Guzzle через Composer:

composer require guzzlehttp/guzzle

Вам также нужно будет настроить интеграцию "Входящего Веб-хука" ("Incoming Webhook") для своей команды Slack. Эта интеграция предоставит URL, который можно использовать при роутинге Slack-уведомлений.
Форматирование Slack-уведомлений

Если уведомление поддерживает отправку в виде Slack-сообщения, то вам нужно задать метод toSlack классу уведомления. Этот метод получит сущность $notifiable и должен возвратить экземпляр Illuminate\Notifications\Messages\SlackMessage. Slack-сообщения могут содержать как текст, так и "вложение", которое форматирует дополнительный текст или массив полей. Рассмотрим базовый пример toSlack пример:

/**
 * Получить Slack-представление уведомления.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */
public function toSlack($notifiable)
{
    return (new SlackMessage)
                ->content('One of your invoices has been paid!');
}

В этом примере мы просто отправляем одну строку текста Slack, что создаст сообщение, которое выглядит следующим образом:
https://laravel.com/assets/img/basic-slack-notification.png

Настройка отправителя и получателя

Можно использовать методы from и to для настройки отправителя и получателя. Метод from принимает в качестве идентификатора имя пользователя и эмоджи, в то время как метод to принимает канал или имя пользователя:

/**
 * Получить Slack-представление уведомления.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */
public function toSlack($notifiable)
{
    return (new SlackMessage)
                ->from('Ghost', ':ghost:')
                ->to('#other')
                ->content('This will be sent to #other');
}

Также в качестве логотипа можно использовать изображение вместо эмоджи:

/**
 * Получить Slack-представление уведомления.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */
public function toSlack($notifiable)
{
    return (new SlackMessage)
                ->from('Laravel')
                ->image('https://laravel.com/favicon.png')
                ->content('This will display the Laravel logo next to the message');
}

Slack-вложения

Вы также можете добавлять "вложения" к сообщениям Slack. Вложения обеспечивают более богатые возможности форматирования, чем простые текстовые сообщения. В этом примере мы отправим уведомление об исключении, которое произошло в приложении, включая ссылку для просмотра более подробной информации об исключении:

/**
 * Получить Slack-представление уведомления.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */
public function toSlack($notifiable)
{
    $url = url('/exceptions/'.$this->exception->id);

    return (new SlackMessage)
                ->error()
                ->content('Whoops! Something went wrong.')
                ->attachment(function ($attachment) use ($url) {
                    $attachment->title('Exception: File Not Found', $url)
                               ->content('File [background.jpg] was not found.');
                });
}

Пример выше сгенерирует Slack-сообщение, которое выглядит следующим образом:
https://laravel.com/assets/img/basic-slack-attachment.png
Вложения также позволяют указывать массив данных, которые нужно презентовать пользователю. Эти данные будут представлены в виде таблицы для упрощения чтения:

/**
 * Получить Slack-представление уведомления.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */
public function toSlack($notifiable)
{
    $url = url('/invoices/'.$this->invoice->id);

    return (new SlackMessage)
                ->success()
                ->content('One of your invoices has been paid!')
                ->attachment(function ($attachment) use ($url) {
                    $attachment->title('Invoice 1322', $url)
                               ->fields([
                                    'Title' => 'Server Expenses',
                                    'Amount' => '$1,234',
                                    'Via' => 'American Express',
                                    'Was Overdue' => ':-1:',
                                ]);
                });
}

Пример выше создаст Slack-сообщение, которое выглядит так:
https://laravel.com/assets/img/slack-fields-attachment.png

Markdown содержимое вложения

Если некоторые из полей вашего вложения содержат разметку Markdown, можно использовать метод markdown, чтобы сообщить Slack анализировать и отображать заданные поля вложения как форматированный Markdown-текст:

/**
 * Получить Slack-представление уведомления.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */
public function toSlack($notifiable)
{
    $url = url('/exceptions/'.$this->exception->id);

    return (new SlackMessage)
                ->error()
                ->content('Whoops! Something went wrong.')
                ->attachment(function ($attachment) use ($url) {
                    $attachment->title('Exception: File Not Found', $url)
                               ->content('File [background.jpg] was *not found*.')
                               ->markdown(['title', 'text']);
                });
}

Роутинг Slack-уведомлений

Чтобы направить Slack-уведомления в подходящее местоположение, задайте метод routeNotificationForSlack вашей уведомляемой сущности. Это должно вернуть URL веб-хука, которому нужно доставить данное уведомление. URL веб-хуков можно генерировать добавляя сервис "Incoming Webhook" своей команде Slack:
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/...';
    }
}

Локализация уведомлений

Laravel позволяет отправлять уведомления на языке, отличном от текущего, и даже запоминает этот языковой стандарт, если уведомление находится в очереди.

Для этого класс Illuminate \ Notifications \ Notification предлагает метод locale для установки желаемого языка. Приложение изменится на этот языковой стандарт при форматировании уведомления, а затем вернется к предыдущему языку после завершения форматирования:
$user->notify((new InvoicePaid($invoice))->locale('es'));
Локализация нескольких подлежащих уведомлению записей также может быть достигнута через Notification фасад:
Notification::locale('es')->send($users, new InvoicePaid($invoice));

Предпочитаемые пользователем регионы

Иногда приложения хранят предпочтительный языковой стандарт каждого пользователя. Реализуя контракт HasLocalePreference в вашей уведомляемой модели, вы можете указать Laravel использовать этот сохраненный языковой стандарт при отправке уведомления:
use Illuminate\Contracts\Translation\HasLocalePreference;

class User extends Model implements HasLocalePreference
{
    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale()
    {
        return $this->locale;
    }
}
После того, как вы реализовали интерфейс, Laravel будет автоматически использовать предпочтительный языковой стандарт при отправке уведомлений и почтовых сообщений в модель. Следовательно, при использовании этого интерфейса нет необходимости вызывать метод locale:
$user->notify(new InvoicePaid($invoice));
События уведомлений

Когда уведомление уже отправлено, системой уведомления выбрасывается событие Illuminate\Notifications\Events\NotificationSent. Оно содержит сущность "notifiable" и сам экземпляр уведомления. Вы можете зарегистрировать слушателей для этого события в своем EventServiceProvider:

/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    'Illuminate\Notifications\Events\NotificationSent' => [
        'App\Listeners\LogNotification',
    ],
];

    После регистрирования слушателей в вашем EventServiceProvider, используйте Artisan-команду event:generate для быстрого генерирования классов слушателей.

В слушателе событий можно получить доступ к свойствам события notifiable, notification и channel, чтобы узнать больше о получателе уведомления или о самом уведомлении:

/**
 * Обработка события.
 *
 * @param  NotificationSent  $event
 * @return void
 */
public function handle(NotificationSent $event)
{
    // $event->channel
    // $event->notifiable
    // $event->notification
}

Пользовательские каналы

Laravel поставляется с несколькими каналами уведомлений, но вы можете захотеть написать свои собственные драйверы для доставки уведомлений по другим каналам. В Laravel это чрезвычайно просто. Для начала определите класс, который содержит метод send. Этот метод должен получать два аргумента: $notifiable и $notification:


namespace App\Channels;

use Illuminate\Notifications\Notification;

class VoiceChannel
{
    /**
     * Отправка заданного уведомления.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toVoice($notifiable);

        // Отправка уведомления экземпляру $notifiable...
    }
}

Как только был определен класс вашего канала уведомлений, вы можете просто вернуть название класса из метода via любого из ваших уведомлений:


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Channels\VoiceChannel;
use App\Channels\Messages\VoiceMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoicePaid extends Notification
{
    use Queueable;

    /**
     * Получить каналы уведомления.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return [VoiceChannel::class];
    }

    /**
     * Получить голосовое представление уведомления.
     *
     * @param  mixed  $notifiable
     * @return VoiceMessage
     */
    public function toVoice($notifiable)
    {
        // ...
    }
}
    </div>
    <div class="theme">
        <h2 class="theme__title">
            Разработка пакетов
        </h2>










    </div>
    <div class="theme">
    </div>
    <div class="theme">
    </div>
</div>






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
