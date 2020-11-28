@extends('layouts.mainLayout')




@section('content')
<div class="themes">
    <h1 class="themes__title">
        Фронтенд
    </h1>
    <div class="theme">
        <h2 class="theme__title">
            Шаблоны Blade
        </h2>
        <p class="theme__text">
            Blade — простой, но мощный шаблонизатор, поставляемый с Laravel. <br>
            Все шаблоны Blade компилируются в чистый PHP-код и кешируются. <br>
            Файлы шаблонов Blade используют расширение .blade.php и обычно хранятся в директории resources/views.
        </p>
        <h3 class="theme__subtitle">
            Наследование шаблонов
        </h3>
        <h4 class="theme_subtitlex2">
            Определение макета
        </h4>
        <p class="theme__text">
            Два основных преимущества использования Blade — наследование шаблонов и секции. <br>
            Для начала давайте рассмотрим простой пример. Многие веб-приложения используют один общий макет для разных страниц, удобно определить этот макет как один шаблон Blade:
        </p>
<code>
<pre>
< html>
< head>
    < title>App Name - @ yield('title')</>
</>
< body>
    @ section('sidebar')
        This is the master sidebar.
    @ show

    < div class="container">
        @ yield('content')
    </>
</>
</>
</pre>
</code>
        <p class="theme__text">
            Директива @ section определяет секцию содержимого.<br>
            Директива @ yield используется для отображения содержимого заданной секции.<br>
            Мы определили макет для нашего приложения, давайте определим дочернюю страницу, которая унаследует макет.
        </p>
        <h4 class="theme_subtitlex2">
            Наследование макета
        </h4>
        <p class="theme__text">
            При определении дочернего шаблона используйте Blade-директиву @extends для указания макета, который должен быть "унаследован" дочерним шаблоном. Шаблоны, которые наследуют макет Blade, могут внедрять содержимое в секции макета с помощью директив @section. Запомните, как видно из приведённого выше примера, содержимое этих секций будет отображено в макете при помощи @yield:
        </p>
<code>
<pre>
    @extends('layouts.app')
@section('title', 'Page Title')
@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection
@section('content')
    <p>This is my body content.</p>
@endsection
</pre>
</code>
<p class="theme__text">
    В этом примере секция sidebar использует директиву @parent для дополнения (а не перезаписи) содержимого к боковой панели макета. Директива @parent будет заменена содержимым макета при отрисовке шаблона.

    В отличие от предыдущего примера, секция sidebar заканчивается на @endsection вместо @show. Директива @endsection будет только определять секцию, в то время как @show будет определять и немедленно вставлять секцию

    Директива @yield также принимает значение по умолчанию в качестве второго параметра. Это значение будет отображено, если получаемый раздел не определен:
</p>
<code>
<pre>
    @yield('content', View::make('view.name'))
@yield('content', view('view.name'))
</pre>
</code>
<p class="theme__text">
    Blade-шаблоны могут быть возвращены из роутов при помощи глобального хелпера view:
</p>
<code>
<pre>
    Route::get('blade', function () {
        return view('child');
    });
</pre>
</code>
<h3 class="theme__subtitle">Отображение данных</h3>
<p class="theme__text">
    Вы можете отображать данные, переданные в ваши Blade-представления, заключив переменную в фигурные скобки. Например, учитывая следующий маршрут:
</p>
<code>
<pre>
    Route::get('greeting', function () {
        return view('welcome', ['name' => 'Samantha']);
    });
</pre>
</code>
<p class="theme__text">
    Альтернативно, вы можете использовать PHP функцию compact, которая создает массив, содержащий названия переменных и их значения.
</p>
<code>
<pre>
    $city  = "San Francisco";
$state = "CA";
$event = "SIGGRAPH";

$location_vars = array("city", "state");

$result = compact("event", $location_vars);
print_r($result);
Результат выполнения данного примера:
Array
(
    [event] => SIGGRAPH
    [city] => San Francisco
    [state] => CA
)

</pre>
</code>
<p class="theme__text">
    Вы можете отобразить содержимое переменной name следующим образом:
</p>
<code>
<pre>
    Hello, {{ $name }}.
Сity, {{ $ city }}.
</pre>
</code>
<p class="theme__text">
    Вы не ограничены отображением содержимого переменных, переданных в представление. Вы также можете повторить результаты любой функции PHP. Фактически, вы можете поместить любой PHP-код в выражение Blade echo:
</p>
<code>
<pre>
The current UNIX timestamp is {{ time() }}.
</pre>
</code>
        <h4 class="theme_subtitlex2">
            Отображение экранированных данных
        </h4>
        <p class="theme__text">
            Операторы Blade {{}} автоматически отправляются через функцию PHP htmlspecialchars для предотвращения атак XSS.
        </p>
        <h4 class="theme_subtitlex2">
            Отображение неэкранированных данных
        </h4>
        <p class="theme__text">
            Если вы не хотите, чтобы ваши данные были неэкранированы, вы можете использовать следующий синтаксис:
        </p>
<code>
<pre>
    Hello, {!! $name !!}.
</pre>
</code>
<p class="theme__text">
    Будьте очень осторожны при повторении содержимого, предоставленного пользователями вашего приложения. Всегда используйте экранированный синтаксис двойной фигурной скобки, чтобы предотвратить атаки XSS при отображении данных, предоставленных пользователем.
</p>
<h4 class="theme_subtitlex2">Рендеринг JSON</h4>
<p class="theme__text">
    Иногда вы можете передать массив вашему представлению с намерением отобразить его как JSON, чтобы инициализировать переменную JavaScript. Например:
</p>
<code>
<pre>
    <>
        var app = <?php echo json_encode($array); ?>;
    </>
</pre>
</code>
<p class="theme__text">
    Однако вместо ручного вызова json_encode вы можете использовать директиву @json Blade. Директива @json принимает те же аргументы, что и функция PHP json_encode:
</p>
<code>
<pre>
    < script>
    var app = @ json($array);

    var app = @ json($array, JSON_PRETTY_PRINT);
    </>
</pre>
</code>
<p class="theme__text">
    Вы должны использовать директиву @ json только для отображения существующих переменных как JSON. Шаблон Blade основан на регулярных выражениях, и попытки передать сложное выражение в директиву могут вызвать неожиданные сбои
    </p>
    <h4 class="theme_subtitlex2">Кодировка HTML-объекта</h4>
<p class="theme__text">
    По умолчанию Blade (и помощник Laravel e) будет дважды кодировать объекты HTML. Если вы хотите отключить двойное кодирование, вызовите метод Blade :: withoutDoubleEncoding из метода загрузки вашего AppServiceProvider:
</p>
<code>
<pre>
    namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::withoutDoubleEncoding();
    }
}
</pre>
</code>
<h4 class="theme_subtitlex2">Blade & JavaScript Frameworks</h4>
<p class="theme__text">
    Поскольку многие JavaScript-фреймворки тоже используют фигурные скобки для обозначения того, что данное выражение должно быть отображено в браузере, то вы можете использовать символ @, чтобы указать механизму отрисовки Blade, что выражение должно остаться нетронутым. Например:
</p>
<code>
<pre>
    <h1>Laravel</h1>

Hello, @{{ name }}.
</pre>
</code>
<p class="theme__text">
    В этом примере Blade удалит символ @, но выражение {{ name }} останется нетронутым, что позволит вашему JavaScript-фреймворку отрисовать его вместо Blade.

Символ @ также может использоваться для выхода из директив Blade:
</p>
<code>
<pre>
    {{-- Blade --}}
@@json()

<!-- HTML output -->
@ json()
</pre>
</code>
<h3 class="theme__subtitle">The @ verbatim Directive</h3>
<p class="theme__text">
    Если вы выводите JavaScript-переменные в большой части вашего шаблона, вы можете обернуть HTML директивой @ verbatim , тогда вам не нужно будет ставить символ @ перед каждым оператором вывода Blade:
</p>
<code>
<pre>
    @ verbatim
    < div class="container">
        Hello, {{ name }}.
    </>
    @ endverbatim
</pre>
</code>
<h3 class="theme__subtitle">Управляющие конструкции</h3>
<p class="theme__text">
    В дополнение к наследованию шаблонов и отображению данных Blade предоставляет удобные сокращения для распространенных управляющих конструкций PHP.
</p>
<h4 class="theme_subtitlex2">
    If Statements
</h4>
<p class="theme__text">
    Вы можете создавать операторы if, используя директивы @ if, @ elseif, @ else и @ endif. Эти директивы работают так же, как и их аналоги в PHP:
</p>
<code>
<pre>
@ if (count($records) === 1)
I have one record!
@ elseif (count($records) > 1)
I have multiple records!
@ else
I don't have any records!
@ endif
</pre>
</code>
<p class="theme__text">
    Для удобства Blade также предоставляет директиву @ unless:
</p>
<code>
<pre>
    @ unless (Auth::check())
    You are not signed in.
    @ endunless
</pre>
</code>
<p class="theme__text">
    В дополнение к уже обсужденным условным директивам директивы @ isset и @ empty могут использоваться как удобные ярлыки для соответствующих функций PHP:
</p>
<code>
<pre>
@ isset($records)
    // $records is defined and is not null...
@ endisset

@ empty($records)
    // $records is "empty"...
@ endempty
</pre>
</code>
<h4 class="theme_subtitlex2">
    Authentication Directives
</h4>
<p class="theme__text">
    Директивы @auth и @guest могут использоваться для быстрого определения, аутентифицирован ли текущий пользователь или является гостем:
</p>
<code>
<pre>
    @auth
    // The user is authenticated...
@endauth

@guest
    // The user is not authenticated...
@endguest
</pre>
</code>
<p class="theme__text">
    При необходимости вы можете указать защиту аутентификации, которую следует проверять при использовании директив @auth и @guest:
</p>
<code>
<pre>
    @auth('admin')
    // The user is authenticated...
@endauth

@guest('admin')
    // The user is not authenticated...
@endguest
</pre>
</code>
<h4 class="theme_subtitlex2"></h4>
<p class="theme__text"></p>
<code>
<pre>
</pre>
</code>
<h4 class="theme_subtitlex2">Section Directives</h4>
<p class="theme__text">
    Вы можете проверить, есть ли в разделе контент, используя директиву @hasSection:
</p>
<code>
<pre>
    @hasSection('navigation')
    <div class="pull-right">
        @yield('navigation')
    </div>

    <div class="clearfix"></div>
@endif
</pre>
</code>
<p class="theme__text">
    Вы можете использовать директиву sectionMissing, чтобы определить, нет ли в разделе содержимого:
</p>
<code>
<pre>
    @sectionMissing('navigation')
    <div class="pull-right">
        @include('default-navigation')
    </div>
@endif
</pre>
</code>
<h4 class="theme_subtitlex2">
    Environment Directives
</h4>
<p class="theme__text">
    Вы можете проверить, работает ли приложение в производственной среде, с помощью директивы @production:
</p>
<code>
<pre>
    @production
    // Production specific content...
@endproduction
</pre>
</code>
<p class="theme__text">
    Или вы можете определить, работает ли приложение в определенной среде, с помощью директивы @env:
</p>
<code>
<pre>
    @env('staging')
    // The application is running in "staging"...
@endenv

@env(['staging', 'production'])
    // The application is running in "staging" or "production"...
@endenv
</pre>
</code>
<h4 class="theme_subtitlex2">
    Switch Statements
</h4>
<p class="theme__text">
    Операторы переключения могут быть созданы с помощью директив @switch, @case, @break, @default и @endswitch:
</p>
<code>
<pre>
    @switch($i)
    @case(1)
        First case...
        @break

    @case(2)
        Second case...
        @break

    @default
        Default case...
@endswitch
</pre>
</code>
<h4 class="theme_subtitlex2">Loops</h4>
<p class="theme__text">
    В дополнение к условным операторам Blade предоставляет простые директивы для работы со структурами циклов PHP. Опять же, каждая из этих директив функционирует идентично своим аналогам PHP:
</p>
<code>
<pre>
    @for ($i = 0; $i < 10; $i++)
    The current value is {{ $i }}
@endfor

@foreach ($users as $user)
    <p>This is user {{ $user->id }}</p>
@endforeach

@forelse ($users as $user)
    <li>{{ $user->name }}</li>
@empty
    <p>No users</p>
@endforelse

@while (true)
    <p>I'm looping forever.</p>
@endwhile
</pre>
</code>
<p class="theme__text">
    При создании цикла вы можете использовать переменную цикла, чтобы получить ценную информацию о цикле, например, находитесь ли вы на первой или последней итерации цикла.
При использовании циклов вы также можете завершить цикл или пропустить текущую итерацию:
</p>
<code>
<pre>
    @foreach ($users as $user)
    @if ($user->type == 1)
        @continue
    @endif

    <li>{{ $user->name }}</li>

    @if ($user->number == 5)
        @break
    @endif
@endforeach
</pre>
</code>
<p class="theme__text">Вы также можете включить условие с объявлением директивы в одну строку:</p>
<code>
<pre>
    @foreach ($users as $user)
    @continue($user->type == 1)

    <li>{{ $user->name }}</li>

    @break($user->number == 5)
@endforeach
</pre>
</code>
<h4 class="theme_subtitlex2">The Loop Variable</h4>
<p class="theme__text">
    При работе с циклами внутри цикла будет доступна переменная $loop. Эта переменная предоставляет доступ к некоторым полезным данным, например, текущий индекс цикла, или находитесь ли вы на первой или последней итерации цикла:
</p>
<code>
<pre>
    @foreach ($users as $user)
    @if ($loop->first)
        This is the first iteration.
    @endif

    @if ($loop->last)
        This is the last iteration.
    @endif

    <p>This is user {{ $user->id }}</p>
@endforeach
</pre>
</code>
<p class="theme__text">
    Если вы находитесь во вложенном цикле, вы можете получить доступ к переменной $ loop родительского цикла через свойство parent:
</p>
<code>
<pre>
    @foreach ($users as $user)
    @foreach ($user->posts as $post)
        @if ($loop->parent->first)
            This is first iteration of the parent loop.
        @endif
    @endforeach
@endforeach
</pre>
</code>
<p class="theme__text">
    Переменная $loop одержит также множество других полезных свойств:
</p>
<table>
    <tr>
        <td>
            Свойство
        </td>
        <td>
            Описание
        </td>
    </tr>
    <tr>
        <td>
            $loop->index
        </td>
        <td>
            Индекс текущей итерации цикла (начинается с 0).
        </td>
    </tr>
    <tr>
        <td>
            $loop->iteration
        </td>
        <td>
            Текущая итерация цикла (начинается с 1).
        </td>
    </tr>
    <tr>
        <td>
            $loop->remaining
        </td>
        <td>
            Число оставшихся итераций цикла.
        </td>
    </tr>

    <tr>
        <td>
            $loop->count
        </td>
        <td>
            Общее число элементов итерируемого массива.
        </td>
    </tr>
    <tr>
        <td>
            $loop->first
        </td>
        <td>
            Первая ли это итерация цикла.
        </td>
    </tr>
    <tr>
        <td>
            $loop->last
        </td>
        <td>
            Последняя ли это итерация цикла.
        </td>
    </tr>
    <tr>
        <td>
            $loop->depth

        </td>
        <td>
            Уровень вложенности текущего цикла.

        </td>
    </tr>
    <tr>
        <td>
            $loop->parent
        </td>
        <td>
            Переменная loop родительского цикла, для вложенного цикла.
        </td>
    </tr>
</table>
<h3 class="theme__subtitle">Комментарии</h3>
<p class="theme__text">
    Blade также позволяет вам определить комментарии в ваших шаблонах. Но в отличие от HTML-комментариев, Blade-комментарии не включаются в HTML-код, возвращаемый вашим приложением:
</p>
<code>
<pre>
    {{-- Этого комментария не будет в итоговом HTML --}}
</pre>
</code>
<h3 class="theme__subtitle">PHP</h3>
<p class="theme__text">
    В некоторых ситуациях полезно встраивать PHP-код в ваши представления. Вы можете использовать директиву Blade @ php для выполнения блока простого PHP в вашем шаблоне:
</p>
<code>
<pre>
@php
    //
@endphp
</pre>
</code>
<p class="theme__text">
    Хотя Blade предоставляет эту функцию, частое ее использование может указывать на то, что в ваш шаблон встроено слишком много логики.
</p>
<h3 class="theme__subtitle">The @ once Directive</h3>
<p class="theme__text">
    Директива @ once позволяет вам определять часть шаблона, которая будет оцениваться только один раз за цикл рендеринга. Это может быть полезно для вставки заданного фрагмента JavaScript в заголовок страницы с помощью стеков. Например, если вы визуализируете данный компонент в цикле, вы можете захотеть вставить JavaScript в заголовок только при первой визуализации компонента:
</p>
<code>
<pre>
    @once
    @push('scripts')
        < script>
            // Your custom JavaScript...
        </>
    @endpush
@endonce
</pre>
</code>
<h3 class="theme__subtitle">Формы</h3>
<h4 class="theme_subtitlex2">CSRF Field</h4>
<p class="theme__text">
    Каждый раз, когда вы определяете HTML-форму в своем приложении, вы должны включать в форму скрытое поле токена CSRF, чтобы посредник CSRF мог проверить запрос. Вы можете использовать директиву @csrf Blade для создания поля токена:
</p>
<code>
<pre>
    < form method="POST" action="/profile">
        @csrf

        ...
    </>
</pre>
</code>
<h4 class="theme_subtitlex2">Method Field</h4>
<p class="theme__text">
    Поскольку HTML-формы не могут выполнять запросы PUT, PATCH или DELETE, вам нужно будет добавить скрытое поле _method для подмены этих HTTP-глаголов. Директива @method Blade может создать для вас это поле:
</p>
<code>
<pre>
    < form action="/foo/bar" method="POST">
        @method('PUT')

        ...
    </>
</pre>
</code>
<h4 class="theme_subtitlex2">Validation Errors</h4>
<p class="theme__text">
    Директива @error может использоваться для быстрой проверки наличия сообщений об ошибках проверки для данного атрибута. В директиве @error вы можете повторить переменную $ message, чтобы отобразить сообщение об ошибке:
</p>
<code>
<pre>
    <!-- /resources/views/post/create.blade.php -->

< label for="title">Post Title</>

< input id="title" type="text" class="@error('title') is-invalid @enderror">

@error('title')
    < div class="alert alert-danger">{{ $message }}</>
@enderror
</pre>
</code>
<p class="theme__text">
    Вы можете передать имя определенного пакета ошибок в качестве второго параметра директиве @error для получения сообщений об ошибках проверки на страницах, содержащих несколько форм:
</p>
<code>
<pre>
    <!-- /resources/views/auth.blade.php -->

< label for="email">Email address</>

< input id="email" type="email" class="@error('email', 'login') is-invalid @enderror">

@error('email', 'login')
    < div class="alert alert-danger">{{ $message }}</>
@enderror
</pre>
</code>
<h3 class="theme__subtitle">Components</h3>
<p class="theme__text">
    Компоненты и слоты предоставляют аналогичные преимущества для секций и макетов; однако, некоторые могут счесть ментальную модель компонентов и слотов более простой в понимании.  Можно использовать компоненты вместо макетов и секций, а можно вместе. Компоненты и слоты — это другой подход для решения той же задачи.
Есть два подхода к написанию компонентов: компоненты на основе классов и анонимные компоненты.

Чтобы создать компонент на основе класса, вы можете использовать Artisan-команду make: component. Чтобы проиллюстрировать, как использовать компоненты, мы создадим простой компонент Alert. Команда make: component поместит компонент в каталог App \ View \ Components:
</p>
<code>
<pre>
    php artisan make:component Alert
</pre>
</code>
<p class="theme__text">
    Команда make: component также создаст шаблон представления для компонента. Представление будет помещено в каталог resources / views / components.
</p>
<h4 class="theme_subtitlex2">
    Ручная регистрация компонентов пакета
</h4>
<p class="theme__text">
    При написании компонентов для вашего собственного приложения компоненты автоматически обнаруживаются в каталоге app / View / Components и resources / views / components.

Однако, если вы создаете пакет, который использует компоненты Blade, вам необходимо вручную зарегистрировать класс компонента и его псевдоним HTML-тега. Обычно вы должны зарегистрировать свои компоненты в методе boot поставщика услуг вашего пакета:
</p>
<code>
<pre>
    use Illuminate\Support\Facades\Blade;

/**
 * Bootstrap your package's services.
 */
public function boot()
{
    Blade::component('package-alert', AlertComponent::class);
}
</pre>
</code>
<p class="theme__text">
    После того, как ваш компонент был зарегистрирован, он может отображаться с использованием псевдонима тега:
</p>
<code>
<pre>
    < x-package-alert/>
</pre>
</code>
<p class="theme__text">
    В качестве альтернативы вы можете использовать метод componentNamespace для автоматической загрузки классов компонентов по соглашению. Например, пакет Nightshade может иметь компоненты Calendar и ColorPicker, которые находятся в пространстве имен Package \ Views \ Components:
</p>
<code>
<pre>
    use Illuminate\Support\Facades\Blade;

/**
 * Bootstrap your package's services.
 */
public function boot()
{
    Blade::componentNamespace('Nightshade\\Views\\Components', 'nightshade');
}
</pre>
</code>
<p class="theme__text">
    Это позволит использовать компоненты пакета в пространстве имен их поставщиков, используя package-name :: синтаксис:
</p>
<code>
<pre>
    < x-nightshade::calendar />
    < x-nightshade::color-picker />
</pre>
</code>
<p class="theme__text">
    Blade автоматически обнаружит класс, связанный с этим компонентом, заключив имя компонента в паскаль. Подкаталоги также поддерживаются с использованием "точечной" нотации.
</p>
<h4 class="theme_subtitlex2">Отображение компонентов</h4>
<p class="theme__text">
    Для отображения компонента вы можете использовать тег компонента Blade в одном из ваших шаблонов Blade. Теги компонентов Blade начинаются со строки x-, за которой следует имя кебаба класса компонента:
</p>
<code>
<pre>
    < x-alert/>
    < x-user-profile/>
</pre>
</code>
<p class="theme__text">
    Если класс компонента вложен глубже в каталог App \ View \ Components, вы можете использовать расширение. символ для обозначения вложенности каталогов. Например, если мы предполагаем, что компонент находится в App \ View \ Components \ Inputs \ Button.php, мы можем отобразить его так:
</p>
<code>
<pre>
    < x-inputs.button/>
</pre>
</code>
<h4 class="theme_subtitlex2">
    Передача данных в компоненты
</h4>
<p class="theme__text">
    Вы можете передавать данные компонентам Blade, используя атрибуты HTML. Жестко запрограммированные примитивные значения могут быть переданы компоненту с помощью простых атрибутов HTML. Выражения и переменные PHP должны передаваться компоненту через атрибуты, которые используют символ: в качестве префикса:
</p>
<code>
<pre>
    < x-alert type="error" :message="$message"/>
</pre>
</code>
<p class="theme__text">
    Вы должны определить необходимые данные компонента в его конструкторе класса. Все общедоступные свойства компонента будут автоматически доступны в представлении компонента. Нет необходимости передавать данные в представление из метода render компонента:
</p>
<code>
<pre>
    namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $type;

    /**
     * The alert message.
     *
     * @var string
     */
    public $message;

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
</pre>
</code>
<p class="theme__text">
    Когда ваш компонент визуализируется, вы можете отображать содержимое общедоступных переменных вашего компонента, повторяя переменные по имени:
</p>
<code>
<pre>
    < div class="alert alert-{{ $type }}">
        {{ $message }}
    </>
</pre>
</code>
<p class="theme__text">
    Мы создали компонент. Далее мы можем его отобразить. Также мы нашему классу компонента может передавать значения, которые впоследствии можно использовать в шаблоне компонента.
Значения можно задавать с помощью html атрибутов, если это какие-то жестко фиксированные значения или через атрибуты, которые используют символ: в качестве префикса — это если мы хотим передать например переменные.
</p>
<h3 class="theme__subtitle">Нотация</h3>
<p class="theme__text">
    Аргументы конструктора компонентов должны быть указаны с использованием camelCase, а kebab-case следует использовать при ссылке на имена аргументов в ваших атрибутах HTML. Например, учитывая следующий конструктор компонента:
</p>
<code>
<pre>
    /**
 * Create the component instance.
 *
 * @param  string  $alertType
 * @return void
 */
public function __construct($alertType)
{
    $this->alertType = $alertType;
}
</pre>
</code>
<p class="theme__text">
    Аргумент $ alertType может быть предоставлен следующим образом:
</p>
<code>
<pre>
    < x-alert alert-type="danger" />
</pre>
</code>
<h3 class="theme__subtitle">Методы компонентов</h3>
<p class="theme__text">
    В дополнение к общедоступным переменным, доступным для вашего шаблона компонента, также могут выполняться любые общедоступные методы компонента. Например, представьте компонент, у которого есть метод isSelected:
</p>
<code>
<pre>
    /**
 * Determine if the given option is the current selected option.
 *
 * @param  string  $option
 * @return bool
 */
public function isSelected($option)
{
    return $option === $this->selected;
}
</pre>
</code>
<p class="theme__text">
    Вы можете выполнить этот метод из своего шаблона компонента, вызвав переменную, соответствующую имени метода:
</p>
<code>
<pre>
    < option {{ $isSelected($value) ? 'selected="selected"' : '' }} value="{{ $value }}">
        {{ $label }}
    </>
</pre>
</code>
<h3 class="theme__subtitle">Использование атрибутов и слотов внутри класса</h3>
<p class="theme__text">
    Компоненты Blade также позволяют получить доступ к имени компонента, атрибутам и слоту внутри метода рендеринга класса. Однако для доступа к этим данным вы должны вернуть Closure из метода render вашего компонента. Closure получит массив $ data в качестве единственного аргумента:
</p>
<code>
<pre>
    /**
 * Get the view / contents that represent the component.
 *
 * @return \Illuminate\View\View|\Closure|string
 */
public function render()
{
    return function (array $data) {
        // $data['componentName'];
        // $data['attributes'];
        // $data['slot'];

        return '<div>Components content</div>';
    };
}
</pre>
</code>
<p class="theme__text">
    ComponentName равно имени, используемому в теге HTML после префикса x-. Таким образом, имя компонента <x-alert /> будет alert. Элемент attributes будет содержать все атрибуты, которые присутствовали в теге HTML. Элемент slot - это экземпляр Illuminate \ Support \ HtmlString с содержимым слота из компонента.

Замыкание должно вернуть строку. Если возвращенная строка соответствует существующему представлению, это представление будет визуализировано; в противном случае возвращенная строка будет оцениваться как встроенное представление Blade.
</p>
<h3 class="theme__subtitle">Дополнительные зависимости</h3>
<p class="theme__text">
    Если вашему компоненту требуются зависимости от сервис-контейнера Laravel, вы можете указать их перед любыми атрибутами данных компонента, и они будут автоматически введены контейнером:
</p>
<code>
<pre>
    use App\Services\AlertCreator

/**
 * Create the component instance.
 *
 * @param  \App\Services\AlertCreator  $creator
 * @param  string  $type
 * @param  string  $message
 * @return void
 */
public function __construct(AlertCreator $creator, $type, $message)
{
    $this->creator = $creator;
    $this->type = $type;
    $this->message = $message;
}
</pre>
</code>
<h3 class="theme__subtitle">
    Управление атрибутами
</h3>
<p class="theme__text">
    Мы уже рассмотрели, как передавать атрибуты данных в компонент; однако иногда может потребоваться указать дополнительные атрибуты HTML, например класс, которые не являются частью данных, необходимых для функционирования компонента. Как правило, вы хотите передать эти дополнительные атрибуты корневому элементу шаблона компонента. Например, представьте, что мы хотим отобразить компонент alert следующим образом:
</p>
<code>
<pre>
    < x-alert type="error" :message="$message" class="mt-4"/>
</pre>
</code>
<p class="theme__text">
    Все атрибуты, которые не являются частью конструктора компонента, будут автоматически добавлены в «мешок атрибутов» компонента. Этот пакет атрибутов автоматически становится доступным для компонента через переменную $ attributes. Все атрибуты могут отображаться в компоненте путем повторения этой переменной:
</p>
<code>
<pre>
    < div {{ $attributes }}>
        <!-- Component Content -->
    </>
</pre>
</code>
<p class="theme__text">
    Использование директив, таких как @env, непосредственно в компоненте в настоящее время не поддерживается.
</p>
<h4 class="theme_subtitlex2">Атрибуты по умолчанию / объединенные атрибуты</h4>
<p class="theme__text">
    Иногда вам может потребоваться указать значения по умолчанию для атрибутов или добавить дополнительные значения в некоторые атрибуты компонента. Для этого вы можете использовать метод merge «мешка атрибутов» компонента:
</p>
<code>
<pre>
    < div {{ $attributes->merge(['class' => 'alert alert-'.$type]) }}>
        {{ $message }}
    </>
</pre>
</code>
<p class="theme__text">
    Если предположить, что этот компонент используется так:
</p>
<code>
<pre>
    < x-alert type="error" :message="$message" class="mb-4"/>
</pre>
</code>
<p class="theme__text">
    Окончательный обработанный HTML-код компонента будет выглядеть следующим образом:
</p>
<code>
<pre>
    < div class="alert alert-error mb-4">
        <!-- Contents of the $message variable -->
    </>
</pre>
</code>
<h4 class="theme_subtitlex2">
    Слияние неклассовых атрибутов
</h4>
<p class="theme__text">
    При слиянии атрибутов, которые не являются атрибутами класса, значения, предоставленные методу merge, будут считаться значениями «по умолчанию» атрибута, которые могут быть перезаписаны потребителем компонента. В отличие от атрибутов класса, атрибуты, не относящиеся к классу, не добавляются друг к другу. Например, компонент button может выглядеть следующим образом:
</p>
<code>
<pre>
    < button {{ $attributes->merge(['type' => 'button']) }}>
        {{ $slot }}
    </>
</pre>
</code>
<p class="theme__text">
    Чтобы отобразить компонент кнопки с настраиваемым type, его можно указать при использовании компонента. Если тип не указан, будет использоваться тип button:
</p>
<code>
<pre>
    < x-button type="submit">
        Submit
    </>
</pre>
</code>
<p class="theme__text">
    Отрендеренный HTML-код компонента button в этом примере будет:
</p>
<code>
<pre>
    < button type="submit">
        Submit
    </>
</pre>
</code>
<p class="theme__text">
    Если вы хотите, чтобы значения атрибута, отличного от класса, были добавлены вместе, вы можете использовать метод prepends:
</p>
<code>
<pre>
    < div {{ $attributes->merge(['data-controller' => $attributes->prepends('profile-controller')]) }}>
        {{ $slot }}
    </>
</pre>
</code>
<h4 class="theme_subtitlex2">Атрибуты фильтрации</h4>
<p class="theme__text">
    Вы можете фильтровать атрибуты, используя метод filter. Этот метод принимает Closure, который должен вернуть true, если вы хотите сохранить атрибут в сумке атрибутов:
</p>
<code>
<pre>
    {{ $attributes->filter(fn ($value, $key) => $key == 'foo') }}
</pre>
</code>
<p class="theme__text">
    Для удобства вы можете использовать метод whereStartsWith для получения всех атрибутов, ключи которых начинаются с заданной строки:
</p>
<code>
<pre>
    {{ $attributes->whereStartsWith('wire:model') }}
</pre>
</code>
<p class="theme__text">
    Используя first метод, вы можете отобразить первый атрибут в заданном пакете атрибутов:
</p>
<code>
<pre>
    {{ $attributes->whereStartsWith('wire:model')->first() }}
</pre>
</code>
<h3 class="theme__subtitle">
    Слоты
</h3>
<p class="theme__text">
    Часто вам нужно будет передать дополнительный контент вашему компоненту через «слоты». Представим, что созданный нами компонент alert имеет следующую разметку:
</p>
<code>
<pre>
    <!-- /resources/views/components/alert.blade.php -->
    < div class="alert alert-danger">
        {{ $slot }}
    </>
</pre>
</code>
<p class="theme__text">
    Мы можем передавать контент в slot, вставляя контент в компонент:
</p>
<code>
<pre>
    < x-alert>
        <strong>Whoops!</strong> Something went wrong!
    </>
</pre>
</code>
<p class="theme__text">
    Иногда компоненту может потребоваться отобразить несколько разных слотов в разных местах внутри компонента. Давайте изменим наш компонент предупреждений, чтобы учесть добавление «заголовка»:
</p>
<code>
<pre>
    <!-- /resources/views/components/alert.blade.php -->

< span class="alert-title">{{ $title }}</>

< div class="alert alert-danger">
    {{ $slot }}
</>

</pre>
</code>
<p class="theme__text">
    Вы можете определить содержимое названного слота, используя тег x-slot. Любой контент, не входящий в тег x-slot, будет передан компоненту в переменной $ slot:
</p>
<code>
<pre>
    < x-alert>
        <x-slot name="title">
            Server Error
        </x-slot>

        <strong>Whoops!</strong> Something went wrong!
    </>
</pre>
</code>
<p class="theme__text">
    Я понял так, что если мы используем x-slot это аналогия, как будто мы создаем переменную в классе и иницилизируем ее с помощью конструктора.
Возможно компоненты будут для вас удобнее, попробуйте!
</p>
<h4 class="theme_subtitlex2">Слоты с ограниченным доступом</h4>
<p class="theme__text">
    Если вы использовали платформу JavaScript, такую как Vue, вы, возможно, знакомы с «слотами с заданной областью», которые позволяют получать доступ к данным или методам из компонента в вашем слоте. Вы можете добиться аналогичного поведения в Laravel, определив общедоступные методы или свойства в вашем компоненте и получив доступ к компоненту в вашем слоте через переменную $ component:
</p>
<code>
<pre>
    < x-alert>
        <x-slot name="title">
            {{ $component->formatAlert('Server Error') }}
        </x-slot>

        <strong>Whoops!</strong> Something went wrong!
    </>
</pre>
</code>
<h3 class="theme__subtitle">Встроенные представления компонентов</h3>
<p class="theme__text">
    Для очень маленьких компонентов может показаться обременительным управлять как классом компонента, так и шаблоном представления компонента. По этой причине вы можете вернуть разметку компонента непосредственно из метода render:
</p>
<code>
<pre>
    /**
 * Get the view / contents that represent the component.
 *
 * @return \Illuminate\View\View|\Closure|string
 */
public function render()
{
    return <<<'blade'
        < div class="alert alert-danger">
            {{ $slot }}
        </>
    blade;
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Создание компонентов встроенного представления
</h4>
<p class="theme__text">
    Чтобы создать компонент, который отображает встроенное представление, вы можете использовать параметр inline при выполнении команды make: component:
</p>
<code>
<pre>
    php artisan make:component Alert --inline
</pre>
</code>
<h3 class="theme__subtitle">Анонимные компоненты</h3>
<p class="theme__text">
    Подобно встроенным компонентам, анонимные компоненты предоставляют механизм для управления компонентом через один файл. Однако анонимные компоненты используют один файл представления и не имеют связанного класса. Чтобы определить анонимный компонент, вам нужно всего лишь поместить шаблон Blade в каталог resources / views / components. Например, предположим, что вы определили компонент в resources / views / components / alert.blade.php:
</p>
<code>
<pre>
    < x-alert/>
</pre>
</code>
<p class="theme__text">
    Вы можете использовать «.» символ, чтобы указать, вложен ли компонент глубже в каталог components. Например, если компонент определен в resources / views / components / inputs / button.blade.php, вы можете отобразить его так:
</p>
<code>
<pre>
    < x-inputs.button/>
</pre>
</code>
<h3 class="theme__subtitle">Свойства / атрибуты данных</h3>
<p class="theme__text">
    Поскольку анонимные компоненты не имеют ассоциированного класса, вы можете задаться вопросом, как можно различить, какие данные должны быть переданы компоненту как переменные, а какие атрибуты должны быть помещены в пакет атрибутов компонента.

Вы можете указать, какие атрибуты следует рассматривать как переменные данных, используя директиву @props в верхней части шаблона Blade вашего компонента. Все остальные атрибуты компонента будут доступны через мешок атрибутов компонента. Если вы хотите присвоить переменной данных значение по умолчанию, вы можете указать имя переменной в качестве ключа массива и значение по умолчанию в качестве значения массива:
</p>
<code>
<pre>
    <!-- /resources/views/components/alert.blade.php -->

@ props(['type' => 'info', 'message'])

< div {{ $attributes->merge(['class' => 'alert alert-'.$type]) }}>
    {{ $message }}
</>
</pre>
</code>
<h3 class="theme__subtitle">
    Динамические компоненты
</h3>
<p class="theme__text">
    Иногда вам может потребоваться визуализировать компонент, но вы не знаете, какой компонент следует визуализировать, до времени выполнения. В этой ситуации вы можете использовать встроенный динамический dynamic-component компонент Laravel для рендеринга компонента на основе значения или переменной времени выполнения:
</p>
<code>
<pre>
    < x-dynamic-component :component="$componentName" class="mt-4" />
</pre>
</code>
<h3 class="theme__subtitle">
    Включая подвиды
</h3>
<p class="theme__text">
    Директива Blade @include позволяет вам включать представление Blade из другого представления. Все переменные, доступные для родительского представления, будут доступны для включенного представления:
</p>
<code>
<pre>
    < div>
        @ include('shared.errors')

        < form>
            <!-- Form Contents -->
        </>
    </>
</pre>
</code>
<p class="theme__text">
    Несмотря на то, что включенное представление унаследует все данные, доступные в родительском представлении, вы также можете передать массив дополнительных данных во включенное представление:
</p>
<code>
<pre>
    @ include('view.name', ['some' => 'data'])
</pre>
</code>
<p class="theme__text">
    Если вы попытаетесь @include несуществующего представления, Laravel выдаст ошибку. Если вы хотите включить представление, которое может присутствовать или отсутствовать, вы должны использовать директиву @includeIf:
</p>
<code>
<pre>
    @ includeIf('view.name', ['some' => 'data'])
</pre>
</code>
<p class="theme__text">
    Если вы хотите @include представление, если данное логическое выражение имеет значение true, вы можете использовать директиву @includeWhen:
</p>
<code>
<pre>
    @ includeWhen($boolean, 'view.name', ['some' => 'data'])
</pre>
</code>
<p class="theme__text">
    Если вы хотите @include представления, если данное логическое выражение оценивается как false, вы можете использовать директиву @includeUnless:
</p>
<code>
<pre>
    @ includeUnless($boolean, 'view.name', ['some' => 'data'])
</pre>
</code>
<p class="theme__text">
    Чтобы включить первое представление, которое существует из данного массива представлений, вы можете использовать директиву includeFirst:
</p>
<code>
<pre>
    @ includeFirst(['custom.admin', 'admin'], ['some' => 'data'])
</pre>
</code>
<p class="theme__text">
    Вам следует избегать использования констант __DIR__ и __FILE__ в ваших представлениях Blade, поскольку они будут ссылаться на расположение кэшированного скомпилированного представления.
</p>
<h4 class="theme_subtitlex2">Псевдонимы включают</h4>
<p class="theme__text">
    Если ваши Blade-включения хранятся в подкаталоге, вы можете захотеть присвоить им псевдонимы для облегчения доступа. Например, представьте себе включение Blade, которое хранится в resources / views / includes / input.blade.php со следующим содержимым:
</p>
<code>
<pre>
    < input type="{{ $type ?? 'text' }}">
</pre>
</code>
<p class="theme__text">
    Вы можете использовать метод include для псевдонима include от includes.input к input. Как правило, это следует делать в методе boot вашего AppServiceProvider:
</p>
<code>
<pre>
use Illuminate\Support\Facades\Blade;
Blade::include('includes.input', 'input');
</pre>
</code>
<p class="theme__text">
    После того, как для включения был задан псевдоним, вы можете отобразить его, используя псевдоним в качестве директивы Blade:
</p>
<code>
<pre>
    @ input(['type' => 'email'])
</pre>
</code>
<h3 class="theme__subtitle">
    Визуализация представлений для коллекций
</h3>
<p class="theme__text">
    Вы можете комбинировать циклы и включать в одну строку с помощью директивы Blade @each:
</p>
<code>
<pre>
    @each('view.name', $jobs, 'job')
</pre>
</code>
<p class="theme__text">
    Первый аргумент - это партиал представления для отображения для каждого элемента в массиве или коллекции. Второй аргумент - это массив или коллекция, которые вы хотите перебрать, а третий аргумент - это имя переменной, которая будет присвоена текущей итерации в представлении. Так, например, если вы выполняете итерацию по массиву jobs, обычно вам нужно получить доступ к каждому job как к переменной задания в вашем частичном представлении. Ключ для текущей итерации будет доступен в качестве key переменной в вашем партиале представления.

Вы также можете передать четвертый аргумент директиве @each. Этот аргумент определяет представление, которое будет отображаться, если данный массив пуст.
</p>
<code>
<pre>
    @each('view.name', $jobs, 'job', 'view.empty')
</pre>
</code>
<p class="theme__text">
    Представления, отображаемые через @each, не наследуют переменные родительского представления. Если дочернему представлению требуются эти переменные, вы должны вместо этого использовать @foreach и @include.
</p>
<h3 class="theme__subtitle">
    Стеки
</h3>
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
    <div class="theme"></div>
    <div class="theme"></div>
    <div class="theme"></div>
    <div class="theme"></div>
    <div class="theme"></div>
    <div class="theme"></div>
    <div class="theme"></div>
    <div class="theme"></div>
    <div class="theme"></div>
    <div class="theme"></div>
    <div class="theme"></div>
</div>
@endsection






<h1 class="themes__title"></h1>
<h2 class="theme__title"></h2>
<h3 class="theme__subtitle"></h3>
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
