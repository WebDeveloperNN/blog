@extends('layouts.mainLayout')

@section('content')
<div class="themes">
    <h1 class="themes__title">Основы</h1>


{{-- ===================== --}}
{{-- Theme: Маршрутизация --}}
{{-- ===================== --}}
<div class="theme">
        <h2 class="theme__title">Маршрутизация</h2>
        <p class="theme__text">
        Маршрутизация - это определение маршрута и то, как он будет обработан. Все маршруты находятся в каталоге routes. <br><br>
        Маршрут можно обработать с помощью (рассмотрена маршрутизация для веб-интерфейса): <br>
        1) Функции-замыкания <br>
<code>
<pre>
Route::get('foo', function () {
    return 'Hello World';
});
</pre>
</code>
</p>
<p class="theme__text">
    2) Контроллера
</p>
<code>
<pre>
use App\Http\Controllers\UserController;
Route::get('/user', [UserController::class, 'index']);
</pre>
</code>
<p class="theme__text">
    3) Функции, которая возвращает шаблон
</p>
<code>
<pre>
Route::view('/welcome', 'welcome', ['name' => 'Taylor']);
</pre>
</code>
<p class="theme__text">
Зарезрвированы слова для этого метода: view, data, status, and headers. <br><br>
</p>
<p class="theme__text">
    Получить к ним доступ можно введя URL-адрес в браузере.<br>
    1) http://your-app.test/foo<br>
    2) http://your-app.test/user<br>
    3) http://your-app.test/welcome<br><br>
    Файл routes/web.php определяет маршруты для вашего веб-интерфейса. Маршрутам в routes/web.php назначается web middleware group по-умолчанию.
</p>




<h3 class="theme__subtitle">Доступные методы маршрутизатора</h3>
<p class="theme__text">Маршрутизатор позволяет регистрировать маршруты, отвечающие на любой HTTP-запроса:</p>
<code>
<pre>
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
</pre>
</code>
<p class="theme__text">
Иногда вам может потребоваться зарегистрировать маршрут, который отвечает на несколько HTTP-запроса. Вы можете сделать это с помощью метода match:
</p>
<code>
<pre>
Route::match(['get', 'post'], '/', function () {
    //
});
</pre>
</code>
<p class="theme__text">
Или вы даже можете зарегистрировать маршрут, который отвечает на все HTTP-команды, используя метод any:
</p>
<code>
<pre>
Route::any('/', function () {
    //
});
</pre>
</code>
<h3 class="theme__subtitle">Перенаправление маршрутов</h3>
<p class="theme__text">
    Чтобы перенаправить запрос с одного маршрута на другой существует две функции:<br>
</p>
<code>
<pre>
Route::redirect('/here', '/there');
</pre>
</code>
<p class="theme__text">
    По умолчанию Route::redirect возвращает код состояния 302, используя необязательный третий параметр вы можете изменить его.<br>
</p>
<code>
<pre>
Route::permanentRedirect('/here', '/there');
</pre>
</code>
<p class="theme__text">
    Возвращает код состояния 301.<br>
</p>
<br>
<p class="theme__text">
    Зарезрвированы слова для этих методов destination and status.
</p>





<h3 class="theme__subtitle">
    Доступ к текущему маршруту
</h3>
<p class="theme__text">
    Вы можете использовать методы current, currentRouteName и currentRouteAction методы с Route для доступа к информации о маршруте, обрабатывающем входящий запрос:
</p>
<code>
<pre>
$route = Route::current();
$name = Route::currentRouteName();
$action = Route::currentRouteAction();
</pre>
</code>
<h3 class="theme__subtitle">Определение текущего маршрута</h3>
<p class="theme__text">
    Если вы хотите определить, был ли текущий запрос направлен на заданный именованный  маршрут, вы можете использовать метод named в экземпляре Route. Например, вы можете проверить имя текущего маршрута из посредника маршрута:
</p>
<code>
<pre>
// Handle an incoming request.
public function handle($request, Closure $next)
{
    if ($request->route()->named('profile')) {
        //
    }

    return $next($request);
}
</pre>
</code>


<h3 class="theme__subtitle">Параметры маршрута </h3>
<p class="theme__text">
    Правила для параметров маршрута: <br>
    - Всегда заключаются в фигурные скобки {}<br>
    - Должны состоять из буквенных символов<br>
    - Не могут содержать символа - (используйте подчеркивание).<br><br>
    Параметры роута внедряются в анонимные функции/контроллеры роута, основываясь на их порядке - названия аргументов анонимных функций/контроллеров не имеют значения.
    </p>
<h4 class="theme_subtitlex2">Обязательные параметры </h4>
<p class="theme__text">
    Иногда вам может потребоваться захватить сегменты URI в вашем маршруте. Например, вам может потребоваться захватить идентификатор пользователя из URL-адреса. Вы можете сделать это, указав параметры маршрута:
</p>
<code>
<pre>
Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
    //
});
</pre>
</code>
<h4 class="theme_subtitlex2">Необязательные параметры</h4>
<p class="theme__text">
    Иногда вам может потребоваться указать параметр маршрута, который будет необязательный. Вы можете сделать это, поместив «?»  после названия параметра. <br>
    Только не забудьте присвоить соответствующей переменной маршрута значение по умолчанию:
</p>
<code>
<pre>
Route::get('user/{name?}', function ($name = 'John') {
    return $name;
});
</pre>
</code>
<h4 class="theme_subtitlex2">Ограничения регулярноми выражениями</h4>
<p class="theme__text">
    Вы можете ограничить формат параметров вашего маршрута, используя метод where в экземпляре маршрута. <br>
    Метод where принимает имя параметра и регулярное выражение, определяющее, как параметр должен быть ограничен:
</p>
<code>
<pre>
Route::get('user/{id}', function ($id) {
    //
})->where('id', '[0-9]+');

Route::get('user/{id}/{name}', function ($id, $name) {
    //
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
</pre>
</code>
<h4 class="theme_subtitlex2">Глобальные ограничения </h4>
<p class="theme__text">
    Если вы хотите, чтобы параметр маршрута всегда ограничивался данным регулярным выражением, вы можете использовать метод pattern. <br>
    Вы должны определить эти шаблоны в методе boot  вашего RouteServiceProvider, который хранится в app/Providers/RouteServiceProvider:
</p>
<code>
<pre>
public function boot()
{
    Route::pattern('id', '[0-9]+');
}
</pre>
</code>
<p class="theme__text">
    Как только шаблон определен, он автоматически применяется ко всем маршрутам, использующим это имя параметра:
</p>
<code>
<pre>
Route::get('user/{id}', function ($id) {
    // Only executed if {id} is numeric...
});
</pre>
</code>
<h3 class="theme__subtitle">Именованные маршруты </h3>
<p class="theme__text">
    Именованные маршруты позволяют удобно создавать URL-адреса или перенаправления для определенных маршрутов. Вы можете указать имя для маршрута, связав метод name с определением маршрута:
</p>
<code>
<pre>
Route::get('user/profile', function () {
    //
})->name('profile');
</pre>
</code>
<code>
<pre>
Route::get('user/profile', [UserProfileController::class, 'show'])->name('profile');
</pre>
</code>
<p class="theme__text">
    Имена маршрутов всегда должны быть уникальными.
</p>
<h4 class="theme_subtitlex2">Создание URL-адресов для именованных маршрутов </h4>
<p class="theme__text">
    После того, как вы присвоили имя данному маршруту, вы можете использовать имя маршрута при создании URL-адресов или перенаправлений с помощью глобальной функции route() (удобно использовать в шаблонах в атрибуте href):
</p>
<code>
<pre>
// Generating URLs...
$url = route('profile');

// Generating Redirects...
return redirect()→route('profile');
</pre>
</code>
<p class="theme__text">
    Если именованный маршрут определяет параметры, вы можете передать параметры в качестве второго аргумента функции route. Указанные параметры будут автоматически вставлены в URL-адрес в правильных местах:
</p>
<code>
<pre>
Route::get('user/{id}/profile', function ($id) {
    //
})->name('profile');

$url = route('profile', ['id' => 1]);
</pre>
</code>
<p class="theme__text">
    Если вы передадите дополнительные параметры в массиве, эти пары ключ / значение будут автоматически добавлены в сгенерированную строку запроса URL:
</p>
<code>
<pre>
Route::get('user/{id}/profile', function ($id) {
    //
})->name('profile');

$url = route('profile', ['id' => 1, 'photos' => 'yes']);

// /user/1/profile?photos=yes
</pre>
</code>
<h3 class="theme__subtitle">Группы маршрутов </h3>
<p class="theme__text">
    Группы маршрутов позволяют использовать общие атрибуты, такие как посредники и пространства имён, для большого числа маршрутов без необходимости определять эти атрибуты для каждого отдельного машрута. <br>
    Общие атрибуты указываются в виде массива первым аргументом метода Route::group().
</p>
<h4 class="theme_subtitlex2">Посредники</h4>
<p class="theme__text">
    Чтобы назначить посредника для всех маршрутов в группе, вы можете использовать метод middleware перед определением группы. Посредники выполняться в том порядке, в котором они перечислены в массиве:
</p>
<code>
<pre>
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second middleware...
    });

    Route::get('user/profile', function () {
        // Uses first & second middleware...
    });
});
</pre>
</code>
<h4 class="theme_subtitlex2">Доменная маршрутизация</h4>
<p class="theme__text">
    Группы маршрутов также могут использоваться для управления маршрутизацией поддоменов. Поддоменам могут быть назначены параметры маршрута, как и URI маршрута, что позволяет вам захватывать часть поддомена для использования в вашем маршруте или контроллере. <br>
    Поддомен можно указать, вызвав метод domain перед определением группы:
</p>
<code>
<pre>
Route :: domain ('{account} .myapp.com') -> group (function () {
    Route :: get ('user / {id}', function ($ account, $ id) {
        //
    });
});
</pre>
</code>
<p class="theme__text">
    Чтобы обеспечить доступность маршрутов поддоменов, вы должны зарегистрировать маршруты поддоменов перед регистрацией маршрутов корневого домена. Это предотвратит перезапись маршрутами корневого домена маршрутов поддоменов, имеющих одинаковый путь URI.
</p>
<h4 class="theme_subtitlex2">Префиксы маршрутов</h4>
<p class="theme__text">
    Метод prefix может использоваться, чтобы задать префикс каждому маршруту в группе. Например, вы можете добавить к префиксу admin для всех маршрутов в группе:
</p>
<code>
<pre>
Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        // Matches The "/admin/users" URL
    });
});
</pre>
</code>
<h4 class="theme_subtitlex2">Префиксы имени маршрута</h4>
<p class="theme__text">
    Метод name может использоваться для добавления к каждому имени маршрута в группе префикса заданной строки.
</p>
<code>
<pre>
Route::name('admin.')->group(function () {
    Route::get('users', function () {
        // Route assigned name "admin.users"...
    })->name('users');
});
</pre>
</code>
<h3 class="theme__subtitle">Привязка модели для маршрута</h3>
<p class="theme__text">
    При внедрении ID модели в действие маршрута или контроллера бывает часто необходимо получить модель, соответствующую этому ID. Привязка моделей — удобный способ автоматического внедрения экземпляров модели напрямую в ваши маршруты. Например, вместо внедрения ID пользователя вы можете внедрить весь экземпляр модели User, который соответствует данному ID.
</p>
<h4 class="theme_subtitlex2">
    Неявная привязка
</h4>
<p class="theme__text">
    При неявной привязки имя параметра должно совпадать с именем модели.
    Laravel автоматически включает модели Eloquent, определенные в маршрутах или действиях контроллера, чьи имена переменных с указанием типа соответствуют имени сегмента маршрута. Например:
</p>
<code>
<pre>
// 1
Route::get('api/users/{user}', function (App\Models\User $user) {
    return $user->email;
});
// 2
use App\Http\Controllers\UserController;
use App\Models\User;

Route::get('users/{user}', [UserController::class, 'show']);

public function show(User $user)
{
    return view('user.profile', ['user' => $user]);
}
</pre>
</code>
<p class="theme__text">
    Так как переменная $user указывается в качестве аргумента Eloquent модели App\User и название переменной совпадает с URI-сегментом {user}, автоматически внедрит экземпляр модели, который имеет ID, совпадающий с соответствующим значением из URI запроса. Если совпадающий экземпляр модели не найден в базе данных, будет автоматически сгенерирован HTTP-отклик 404.
    <br>
    Конечно, неявная привязка также возможна при использовании методов контроллера. Опять же, обратите внимание, что сегмент URI {user} соответствует переменной $ user в контроллере, которая содержит подсказку типа App \ Models \ User
</p>
<h4 class="theme_subtitlex2">
    Настройка ключа
</h4>
<p class="theme__text">
    Иногда вы можете захотеть разрешить модели Eloquent, используя столбец, отличный от id. Для этого вы можете указать столбец в определении параметра маршрута:
</p>
<code>
<pre>
Route :: get ('api / posts / {post: slug}', function (App \ Models \ Post $ post) {
    return $post;
});
</pre>
</code>
<h3 class="theme_subtitlex2">
    Пользовательские ключи и область действия
</h3>
<p class="theme__text">
    Иногда при неявном связывании нескольких моделей Eloquent в одном определении маршрута вы можете захотеть охватить вторую модель Eloquent так, чтобы она была дочерней по отношению к первой модели Eloquent. Например, рассмотрим ситуацию, когда сообщение в блоге извлекается по slug для определенного пользователя:
</p>
<code>
<pre>
use App\Models\Post;
use App\Models\User;

Route::get('api/users/{user}/posts/{post:slug}', function (User $user, Post $post) {
    return $post;
});
</pre>
</code>
<p class="theme__text">
    При использовании настраиваемой неявной привязки с ключом в качестве параметра вложенного маршрута Laravel автоматически задает область запроса для получения вложенной модели своим родителем, используя соглашения, чтобы угадать имя отношения на родительском элементе. В этом случае предполагается, что модель User имеет отношение с именем posts (множественное число от имени параметра маршрута), которое можно использовать для получения модели Post.
</p>
<h4 class="theme__subtitle">Явная привязка</h4>
<p class="theme__text">
    Если вы не хотите использовать параметр с таким же названием как и название модели, то нужно использовать метод маршрута model для явной привязки.
    Данный метод служит для регистрации явной привязки: указания класса для данного параметра. Вам надо определить явные привязки вашей модели в методе boot класса RouteServiceProvider:
</p>
<code>
<pre>
/**
* Define your route model bindings, pattern filters, etc.
*
* @return void
*/
public function boot()
{
    Route::model('user', App\Models\User::class);

    // ...
}
</pre>
</code>
<p class="theme__text">
    Затем определите маршрут, содержащий параметр {user}:
</p>
<code>
<pre>
Route::get('profile/{user}', function (App\Models\User $user) {
    //
});
</pre>
</code>
<p class="theme__text">
    Поскольку мы связали все параметры {user} с моделью App \ Models \ User, экземпляр User будет добавлен в маршрут. Так, например, запрос к profile/ 1 будет вводить экземпляр User из базы данных с идентификатором 1.
    <br>
    Если соответствующий экземпляр модели не найден в базе данных, автоматически будет сгенерирован ответ HTTP 404.
</p>
<h3 class="theme__subtitle">
    Настройка имени ключа по умолчанию
</h3>
<p class="theme__text">
    Если вы хотите, чтобы привязка модели использовала столбец базы данных по умолчанию, отличный от id, при получении данного класса модели, вы можете переопределить метод getRouteKeyName в модели Eloquent:
</p>
<code>
<pre>
/**
* Get the route key for the model.
*
* @return string
*/
public function getRouteKeyName()
{
    return 'slug';
}
</pre>
</code>
<p class="theme__text">
    Опеределяется это в классе модели. Например в App\Models\Post
</p>
<h3 class="theme__subtitle">
    Настройка логики принятия решения
</h3>
<p class="theme__text">
    Если вы хотите использовать свою собственную логику принятия
    решения, вы можете использовать метод Route :: bind. Переданное в метод bind замыкание получит значение сегмента URI, и должно вернуть экземпляр класса, который вы хотите внедрить в роут:
</p>
<code>
<pre>
/**
* Define your route model bindings, pattern filters, etc.
*
* @return void
*/
public function boot()
{
    Route::bind('user', function ($value) {
        return App\Models\User::where('name', $value)->firstOrFail();
    });

    // ...
}
</pre>
</code>
<p class="theme__text">
    В качестве альтернативы вы можете переопределить метод resolveRouteBinding в своей модели Eloquent. Этот метод получит значение сегмента URI и должен вернуть экземпляр класса, который должен быть введен в маршрут:
</p>
<code>
<pre>
/**
* Retrieve the model for a bound value.
*
* @param  mixed  $value
* @param  string|null  $field
* @return \Illuminate\Database\Eloquent\Model|null
*/
public function resolveRouteBinding($value, $field = null)
{
    return $this->where('name', $value)->firstOrFail();
}
</pre>
</code>
<p class="theme__text">
    Если в маршруте используется неявная область действия привязки, для разрешения дочерней привязки родительской модели будет использоваться метод resolveChildRouteBinding:
</p>
<code>
<pre>
/**
* Retrieve the child model for a bound value.
*
* @param  string  $childType
* @param  mixed  $value
* @param  string|null  $field
* @return \Illuminate\Database\Eloquent\Model|null
*/
public function resolveChildRouteBinding($childType, $value, $field)
{
    return parent::resolveChildRouteBinding($childType, $value, $field);
}
</pre>
</code>
<h3 class="theme__subtitle">
    Резервные маршруты
</h3>
<p class="theme__text">
    Используя метод Route::fallback(), вы можете определить маршрут, который будет выполняться, когда ни один другой маршрут не соответствует входящему запросу.
    <br> <br>
    Как правило, необработанные запросы автоматически отображают страницу «404» через обработчик исключений вашего приложения.
    <br>
    Однако, вы можете определить fallback маршрут в файле routes/web.php.
</p>
<code>
<pre>
Route :: fallback (function () {
    //
});
</pre>
</code>
<p class="theme__text">
    Резервный маршрут всегда должен быть последним маршрутом, зарегистрированным вашим приложением.
</p>
<h3 class="theme__subtitle">
    Ограничение скорости запросов
</h3>
<h4 class="theme_subtitlex2">
    Определение ограничителей скорости запросов
</h4>
<p class="theme__text">
    Laravel включает мощные и настраиваемые службы ограничения скорости, которые вы можете использовать для ограничения объема трафика для данного маршрута или группы маршрутов. Для начала вы должны определить конфигурации ограничителя скорости, которые соответствуют потребностям вашего приложения. Как правило, это можно сделать в RouteServiceProvider вашего приложения.

    Ограничители скорости определяются с помощью метода for фасада RateLimiter. Метод for принимает имя ограничителя скорости и Closure, которое возвращает конфигурацию ограничения, которая должна применяться к маршрутам, которым назначен этот ограничитель скорости:
</p>
<code>
<pre>
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

RateLimiter::for('global', function (Request $request) {
    return Limit::perMinute(1000);
});
</pre>
</code>
<p class="theme__text">
    Если входящий запрос превышает указанный предел скорости, Laravel автоматически вернет ответ с кодом состояния HTTP 429. Если вы хотите определить свой собственный ответ, который должен возвращать ограничение скорости, вы можете использовать метод response:
</p>
<code>
<pre>
RateLimiter::for('global', function (Request $request) {
    return Limit::perMinute(1000)->response(function () {
        return response('Custom response...', 429);
    });
});
</pre>
</code>
<p class="theme__text">
    Поскольку обратные вызовы ограничителя скорости получают экземпляр входящего HTTP-запроса, вы можете динамически создать соответствующее ограничение скорости на основе входящего запроса или аутентифицированного пользователя:
</p>
<code>
<pre>
RateLimiter::for('uploads', function (Request $request) {
    return $request->user()->vipCustomer()
                ? Limit::none()
                : Limit::perMinute(100);
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Пределы скорости сегментации
</h4>
<p class="theme__text">
    Иногда вы можете захотеть сегментировать ограничения скорости на какое-то произвольное значение. Например, вы можете разрешить пользователям получать доступ к заданному маршруту 100 раз в минуту на каждый IP-адрес. Для этого вы можете использовать метод by при создании ограничения скорости:
</p>
<code>
<pre>
RateLimiter::for('uploads', function (Request $request) {
    return $request->user()->vipCustomer()
                ? Limit::none()
                : Limit::perMinute(100)->by($request->ip());
});
</pre>
</code>
<h3 class="theme_subtitlex2">
    Множественные ограничения количества запросов
</h3>
<p class="theme__text">
    При необходимости вы можете вернуть массив ограничений скорости для данной конфигурации ограничителя скорости. Каждое ограничение скорости будет оцениваться для маршрута в зависимости от порядка, в котором они размещены в массиве:
</p>
<code>
<pre>
RateLimiter::for('login', function (Request $request) {
    return [
        Limit::perMinute(500),
        Limit::perMinute(3)->by($request->input('email')),
    ];
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Добавление ограничителей количества запросов для маршрутов
</h4>
<p class="theme__text">
    Ограничители скорости могут быть присоединены к маршрутам или группам маршрутов с помощью посредник throttle (дросселирования). посредник throttle дроссельной заслонки принимает имя ограничителя скорости, которое вы хотите назначить маршруту:
</p>
<code>
<pre>
Route::middleware(['throttle:uploads'])->group(function () {
    Route::post('/audio', function () {
        //
    });

    Route::post('/video', function () {
        //
    });
});
</pre>
</code>
<h3 class="theme_subtitlex2">
    Регулирование с помощью Redis
</h3>
<p class="theme__text">
    Обычно посредник throttle дроссельной заслонки сопоставляется с классом Illuminate \ Routing \ Middleware \ ThrottleRequests. Это отображение определяется в HTTP-ядре вашего приложения. Однако, если вы используете Redis в качестве драйвера кеша вашего приложения, вы можете изменить это сопоставление, чтобы использовать класс Illuminate \ Routing \ Middleware \ ThrottleRequestsWithRedis. Этот класс более эффективен при управлении ограничением скорости с помощью Redis:
</p>
<code>
<pre>
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequestsWithRedis::class,
</pre>
</code>
<h3 class="theme__subtitle">
    Подмена метода формы
</h3>
<p class="theme__text">
    HTML-формы не поддерживают действия PUT, PATCH или DELETE. Итак, при определении маршрутов PUT, PATCH или DELETE, которые вызываются из HTML-формы, вам нужно будет добавить в форму скрытое поле _method. Значение, отправленное с полем _method, будет использоваться в качестве метода HTTP-запроса:
</p>
<code>
<pre>
< form action="/foo/bar" method="POST">
    < input type="hidden" name="_method" value="PUT">
    < input type="hidden" name="_token" value="{ { csrf_token() }}">
< form >

Вы можете использовать директиву @ method Blade для генерации ввода _method:

< form action="/foo/bar" method="POST">
    @ method('PUT')
    @ csrf
< form>
</pre>
</code>
<h3 class="theme__subtitle">
    Совместное использование ресурсов между источниками (CORS)
</h3>
<p class="theme__text">
    Laravel может автоматически отвечать на запросы CORS OPTIONS со значениями, которые вы настраиваете. Все параметры CORS могут быть настроены в вашем файле конфигурации cors, а запросы OPTIONS будут автоматически обрабатываться промежуточным программным обеспечением HandleCors, которое по умолчанию включено в ваш глобальный стек посредник.

    Для получения дополнительной информации о заголовках CORS и CORS обратитесь к веб-документации MDN по CORS (MDN web documentation on CORS.).
</p>
</div>
<div class="theme">














{{-- ===================== --}}
{{-- Theme: Посредники --}}
{{-- ===================== --}}
<h2 class="theme__title">
    Посредники
</h2>
<p class="theme__text">
    Лучше всего представить себе посредников как «слои» для HTTP-запросов, которые запрос должнен пройти, прежде чем он попадет в ваше приложение. Каждый слой делает с запросом то, что вы ему скажете.
    <br><br>
    То есть посредники обеспечивают удобный механизм фильтрации HTTP-запросов, поступающих в ваше приложение. Например, Laravel включает посредник, которое проверяет, аутентифицирован ли пользователь вашего приложения. Если пользователь не аутентифицирован, посредник перенаправит пользователя на экран входа в систему. Однако, если пользователь аутентифицирован, посредник позволит запросу продолжить работу в приложении.
    <br><br>
    В структуру Laravel включено несколько посредников, которые хранятся в каталоге app/Http/Middleware.
</p>
<h3 class="theme__subtitle">
    Создание посредника
</h3>
<p class="theme__text">
    Чтобы создать посредника, используйте Artisan-команду make: middleware:
</p>
<code>
<pre>
php artisan make:middleware CheckAge
</pre>
</code>
<p class="theme__text">
    Эта команда поместит новый класс CheckAge в каталог app / Http / Middleware. <br><br>
    Напишим такую логику: разрешим доступ к маршруту только в том случае, если предоставленный возраст превышает 200. В противном случае мы перенаправим пользователей обратно на домашний URI:
</p>
<code>
<pre>
namespace App\Http\Middleware;
use Closure;
class CheckAge
{
    public function handle($request, Closure $next)
    {
        if ($request->age <= 200) {
            return redirect('home');
        }
        // чтобы передать запрос глубже в приложение
        return $next($request);
    }
}
</pre>
</code>
<h3 class="theme__subtitle">
    Выполнение посредника "до" или "после" запроса
</h3>
<p class="theme__text">
    Пример посредника, который выполнит некоторую задачу прежде, чем запрос будет обработан приложением:
</p>
<code>
<pre>
namespace App\Http\Middleware;

use Closure;

class BeforeMiddleware
{
    public function handle($request, Closure $next)
    {
        // Perform action

        return $next($request);
    }
}
</pre>
</code>
<p class="theme__text">
    Однако, этот посредник выполнит задачу после того, как запрос будет обработан приложением:
</p>
<code>
<pre>
namespace App\Http\Middleware;

use Closure;

class AfterMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Perform action

        return $response;
    }
}
</pre>
</code>
<h3 class="theme__subtitle">
    Регистрация посредника
</h3>
<h4 class="theme_subtitlex2">
    Глобальный посредник
</h4>
<p class="theme__text">
    Если вы хотите, чтобы посредник запускался для каждого HTTP-запроса в вашем приложении, добавьте этот посредник в свойство $middleware вашего класса app/Http/Kernel.php.
</p>
<code>
<pre>

</pre>
</code>
<h4 class="theme_subtitlex2">
    Назначение посредника роутам
</h4>
<p class="theme__text">
    Если вы хотите назначить посредника для конкретных маршрутов, то сначала вам надо добавить ключ посредника в файл app/Http/Kernel.php. По умолчанию свойство $routeMiddleware этого класса содержит записи посредников Laravel. Чтобы добавить ваш собственный посредник, просто добавьте его к этому списку и присвойте ему ключ на свой выбор. Например:
</p>
<code>
<pre>
// Within App\Http\Kernel Class...

protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
];
</pre>
</code>
<p class="theme__text">
    Когда посредник определён в HTTP-ядре, вы можете использовать метод middleware для назначения посредника роуту:
</p>
<code>
<pre>
Route :: get ('admin / profile', function () {
    //
}) -> middleware('auth');
</pre>
</code>
<p class="theme__text">
    Также можно назначить несколько посредников роуту:
</p>
<code>
<pre>
Route :: get ('/', function () {
    //
}) -> middleware('первое', 'второе');
</pre>
</code>
<p class="theme__text">
    При назначении посредник вы также можете передать полное имя класса:
</p>
<code>
<pre>
use App \ Http \ Middleware \ CheckAge;

Route :: get ('admin / profile', function () {
//
}) -> middleware(CheckAge :: class);
</pre>
</code>
<p class="theme__text">
    При назначении посредник группе маршрутов иногда может потребоваться запретить применение посредник к отдельному маршруту в группе. Вы можете сделать это с помощью метода withoutMiddleware:
</p>
<code>
<pre>
используйте App \ Http \ Middleware \ CheckAge;

Route :: middleware ([CheckAge :: class]) -> group (function () {
    Route :: get ('/', function () {
        //
    });

    Route :: get ('admin / profile', function () {
        //
    }) -> withoutMiddleware ([CheckAge :: class]);
});
</pre>
</code>
<p class="theme__text">
    Метод withoutMiddleware может удалить только посредник маршрутизации и не применяется к global middleware.
</p>
<h3 class="theme__subtitle">
    Группы посредников
</h3>
<p class="theme__text">
    Иногда вам может потребоваться сгруппировать несколько посредников под одним ключом, чтобы упростить их назначение маршрутам. Вы можете сделать это, используя свойство $ middlewareGroups вашего ядра HTTP.
    <br>
    Изначально в Laravel есть группы посредников web и api, которые содержат те посредники, которые часто применяются к вашим роутам веб-UI и API:
</p>
<code>
<pre>
/**
* The application's route middleware groups.
*
* @var array
*/
protected $middlewareGroups = [
    'web' => [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    'api' => [
        'throttle:60,1',
        'auth:api',
    ],
];
</pre>
</code>
<p class="theme__text">
    Группы посредников могут быть назначены роутам и действия контроллера с помощью того же синтаксиса, что и для одного посредника. Группы посредников просто делают проще единое назначение нескольких посредников на роут:
</p>
<code>
<pre>
Route::get('/', function () {
    //
})->middleware('web');

Route::group(['middleware' => ['web']], function () {
    //
});

Route::middleware(['web', 'subscribed'])->group(function () {
    //
});
</pre>
</code>
<p class="theme__text">
    Изначально группа посредников web автоматически применяется к вашему файлу routes/web.php сервис-провайдером RouteServiceProvider.
</p>
<h3 class="theme__subtitle">
    Сортировка посредников
</h3>
<p class="theme__text">
    В редких случаях вам может понадобиться ваше посредник для выполнения в определенном порядке, но вы не сможете контролировать их порядок, когда они назначены для маршрута. В этом случае вы можете указать свой приоритет посредник, используя свойство $ middlewarePriority вашего файла app / Http / Kernel.php:
</p>
<code>
<pre>
/**
* The priority-sorted list of middleware.
*
* This forces non-global middleware to always be in the given order.
*
* @var array
*/
protected $middlewarePriority = [
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests::class,
    \Illuminate\Routing\Middleware\ThrottleRequests::class,
    \Illuminate\Session\Middleware\AuthenticateSession::class,
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
    \Illuminate\Auth\Middleware\Authorize::class,
];
</pre>
</code>
<h3 class="theme__subtitle">
    Параметры посредника
</h3>
<p class="theme__text">
    В посредник можно передавать дополнительные параметры. Например, если в вашем приложении необходима проверка того, есть ли у аутентифицированного пользователя определённая "роль" для выполнения данного действия, вы можете создать посредника CheckRole, который принимает название роли в качестве дополнительного аргумента.
    Дополнительные параметры посредника будут передаваться в посредник после аргумента $next:
</p>
<code>
<pre>
namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
        * Handle the incoming request.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \Closure  $next
        * @param  string  $role
        * @return mixed
        */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasRole($role)) {
            // Redirect...
        }

        return $next($request);
    }

}
</pre>
</code>
<p class="theme__text">
    Параметры посредника можно указать при определении маршрута, отделив название посредника от параметров двоеточием :. Несколько параметров разделяются запятыми:
</p>
<code>
<pre>
Route::put('post/{id}', function ($id) {
    //
})->middleware('role:editor');
</pre>
</code>
<h3 class="theme__subtitle">
    Посредник terminable
</h3>
<p class="theme__text">
    Иногда промежуточному программному обеспечению может потребоваться выполнить некоторую работу после того, как HTTP-ответ был отправлен браузеру. Если вы определяете метод terminate в промежуточном программном обеспечении и ваш веб-сервер использует FastCGI, то он будет автоматически вызываться после отправки ответа в браузер.
</p>
<code>
<pre>
namespace Illuminate\Session\Middleware;

use Closure;

class StartSession
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Store the session data...
    }
}
</pre>
</code>
<p class="theme__text">
    The terminate должен получать и запрос, и ответ. Определив terminable-посредника, вы должны добавить его в список посредников роута или глобальных посредников в файл app/Http/Kernel.php.

    При вызове метода terminate в посреднике, Laravel получит свежий экземпляр посредника из сервис-контейнера.
    Если вы хотите использовать тот же самый экземпляр посредника при вызовах методов handle и terminate, зарегистрируйте посредника в контейнере при помощи метода singleton. Обычно это должно быть сделано в методе register вашего AppServiceProvider.php:
</p>
<code>
<pre>
use App\Http\Middleware\TerminableMiddleware;

/**
    * Register any application services.
    *
    * @return void
    */
public function register()
{
    $this->app->singleton(TerminableMiddleware::class);
}
</pre>
</code>
</div>








{{-- ===================== --}}
{{-- Theme: CSRF защита --}}
{{-- ===================== --}}
<div class="theme">
<h2 class="theme__title">
    CSRF защита
</h2>
<p class="theme__text">
    Laravel упрощает защиту вашего приложения от атак с подделкой межсайтовых запросов (CSRF).
    <br><br>
    Подделка межсайтовых запросов — тип атаки на сайты, при котором несанкционированные команды выполняются от имени аутентифицированного пользователя.
    <br>
    Laravel автоматически генерирует «токен» CSRF для каждой активной пользовательской сессии в приложении. Этот токен используется для проверки того, что именно авторизованный пользователь делает запрос в приложение.
    <br><br>
    При определении каждой HTML-формы вы должны включать в неё скрытое поле CSRF-токена, чтобы посредник CSRF-защиты мог проверить запрос. Вы можете использовать директиву @ csrf Blade для генерирования поля токена:
</p>
<code>
<pre>
< form method = "POST" action = "/ profile">
    @ csrf
    ...
< form >

// Или Вы можете использовать хелпер csrf_field для генерирования поля токена:
< form method="POST" action="/profile">
    { { csrf_field() }}
    ...
< form >
</pre>
</code>
<p class="theme__text">
    Посредник VerifyCsrfToken, входящий в группу посредников web, автоматически проверяет совпадение токена в данных запроса с токеном, хранящимся в сессии.
</p>
<h3 class="theme__subtitle">
    Токены CSRF и JavaScript
</h3>
<p class="theme__text">
    При создании приложений на основе JavaScript удобно, чтобы ваша HTTP-библиотека JavaScript автоматически прикрепляла токен CSRF к каждому исходящему запросу. По умолчанию HTTP-библиотека Axios, предоставленная в файле resources / js / bootstrap.js, автоматически отправляет заголовок X-XSRF-TOKEN, используя значение зашифрованного файла cookie XSRF-TOKEN. Если вы не используете эту библиотеку, вам нужно будет вручную настроить это поведение для вашего приложения.
</p>
<h3 class="theme__subtitle">
    Исключение URI из CSRF-защиты
</h3>
<p class="theme__text">
    используете Stripe для обработки платежей и применяете их систему веб-хуков, то вам надо исключить роут вашего обработчика веб-хуков Stripe из-под CSRF-защиты, так как Stripe не будет знать, какой CSRF-токен надо послать в ваш роут.
    Обычно такие роуты помещаются вне группы посредников web, которую RouteServiceProvider применяет ко всем роутам в файле routes/web.php. Но вы также можете исключить роуты, добавив их URI в свойство $except посредника VerifyCsrfToken:
</p>
<code>
<pre>
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
        * The URIs that should be excluded from CSRF verification.
        *
        * @var array
        */
    protected $except = [
        'stripe/*',
        'http://example.com/foo/bar',
        'http://example.com/foo/*',
    ];
}
</pre>
</code>
<p class="theme__text">
    The CSRF middleware is automatically disabled when running tests.
</p>
<h3 class="theme__subtitle">
    X-CSRF-TOKEN
</h3>
<p class="theme__text">
    Помимо проверки CSRF-токена как POST-параметра, посредник VerifyCsrfToken будет также проверять заголовок запроса X-CSRF-TOKEN. Например, вы можете хранить токен в HTML-теге meta:
</p>
<code>
<pre>
< meta name = "csrf-token" content = "{{csrf_token ()}}">
</pre>
</code>
<p class="theme__text">
    После создания тега meta вы можете указать библиотеке, такой как jQuery, автоматически добавлять токен в заголовки всех запросов. Это обеспечивает простую, удобную CSRF-защиту для ваших приложений на базе AJAX:
</p>
<code>
<pre>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</pre>
</code>
<h3 class="theme__subtitle">
    X-XSRF-TOKEN
</h3>
<p class="theme__text">
    Laravel хранит текущий CSRF-токен в cookie XSRF-TOKEN, которую включается в каждый отклик, генерируемый фреймворком. Вы можете использовать значение cookie, чтобы задать заголовок запроса X-XSRF-TOKEN.
    Этот cookie в основном посылается для удобства, потому что некоторые JavaScript-фреймворки, такие как Angular, автоматически помещают его значение в заголовок X-XSRF-TOKEN.
    По умолчанию файл resources / js / bootstrap.js включает HTTP-библиотеку Axios, которая автоматически отправит это вам.
</p>
</div>














{{-- ===================== --}}
{{-- Theme: Контроллеры --}}
{{-- ===================== --}}
<div class="theme">
    <h2 class="theme__title">
        Контроллеры
    </h2>
    <p class="theme__text">
        Контроллеры позволяют группировать связанную с обработкой HTTP-запросов логику в отдельный класс. <br><br>
        Контроллеры хранятся в директории app/Http/Controllers.
    </p>
    <h3 class="theme__subtitle">
        Определение контроллеров
    </h3>
    <p class="theme__text">
        Ниже приведен пример простейшего класса контроллера. Обратите внимание, что контроллер наследует базовый класс контроллера, включенный в Laravel. Базовый класс предоставляет несколько удобных методов, таких как метод middleware,используемый для назначения посредников на действия контроллера:
    </p>
<code>
<pre>
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
}
</pre>
</code>
<p class="theme__text">
    Вы можете определить маршрут к этому действию контроллера следующим образом:
</p>
<code>
<pre>
use App\Http\Controllers\UserController;
Route::get('user/{id}', [UserController::class, 'show']);
</pre>
</code>
<p class="theme__text">
    Теперь при соответствии запроса указанному URI роута будет выполняться метод show класса UserController. Конечно, параметры роута также будут переданы в метод.
    <br><br>
    Контроллеры не обязаны расширять базовый класс. Однако у вас не будет доступа к таким удобным функциям, как middleware, методы validate и dispatch.
</p>
<h3 class="theme__subtitle">
    Контроллеры одного действия
</h3>
<p class="theme__text">
    Если вы хотите определить контроллер, который обрабатывает только одно действие, поместите в контроллер единственный метод __invoke:
</p>
<code>
<pre>
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class ShowProfile extends Controller
{
    public function __invoke($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
}
</pre>
</code>
<p class="theme__text">
    При регистрации маршрутов для контроллеров одиночного действия вам не нужно указывать метод:
</p>
<code>
<pre>
use App\Http\Controllers\ShowProfile;
Route::get('user/{id}', ShowProfile::class);
</pre>
</code>
<p class="theme__text">
    Вы можете сгенерировать вызываемый контроллер, используя параметр --invokable Artisan-команды make: controller:
</p>
<code>
<pre>
php artisan make: controller ShowProfile --invokable
</pre>
</code>
<h3 class="theme__subtitle">
    Посредник контроллера
</h3>
<p class="theme__text">
    Посредники может быть назначено маршрутам контроллера в ваших файлах маршрутов:
</p>
<code>
<pre>
Route::get('profile', [UserController::class, 'show'])->middleware('auth');
</pre>
</code>
<p class="theme__text">
    Но удобнее указать посредника в конструкторе вашего контроллера. Используя метод middleware в конструкторе контроллера, вы легко можете назначить посредника для действия контроллера. Вы можете даже ограничить использование посредника, назначив его только для определённых методов класса контроллера:
</p>
<code>
<pre>
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('log')->only('index');
        $this->middleware('subscribed')->except('store');
    }
}
</pre>
</code>
<h3 class="theme__subtitle">
    Контроллеры ресурсов
</h3>
<p class="theme__text">
    Маршрутизация ресурсов Laravel назначает обычные CRUD-роуты на контроллеры одной строчкой кода.
    <br><br>
    Например, вы можете создать контроллер, обрабатывающий все HTTP-запросы к фотографиям, хранимым вашим приложением. Вы можете быстро создать такой контроллер с помощью Artisan-команды make:controller:
</p>
<code>
<pre>
php artisan make:controller PhotoController --resource
</pre>
</code>
</h4>
<p class="theme__text">
    Эта команда сгенерирует контроллер app/Http/Controllers/PhotoController.php. Данный контроллер будет содержать метод для каждой доступной операции с ресурсами. <br>
    Теперь мы можем зарегистрировать роут контроллера ресурса:
</p>
<code>
<pre>
Route::resource('photos', 'PhotoController');
</pre>
</code>
<p class="theme__text">
    Один этот вызов создаёт множество роутов для обработки различных действий для ресурса.
    <br><br>
    Вы можете зарегистрировать сразу несколько контроллеров ресурсов, передав массив методу resources:
</p>
<code>
<pre>
Route::resources([
    'photos' => PhotoController::class,
    'posts' => PostController::class,
]);
</pre>
</code>
<p class="theme__text">
    При объявлении маршрута ресурса вы можете указать подмножество действий, которые должен обрабатывать контроллер, вместо полного набора действий по умолчанию:
</p>
<code>
<pre>
Route::resource('photos', PhotoController::class)->only([
    'index', 'show'
]);
</pre>
</code>
<code>
<pre>
Route::resource('photos', PhotoController::class)->except([
    'create', 'store', 'update', 'destroy'
</pre>
</code>
<h4 class="theme_subtitlex2">
    Действия, обрабатываемые контроллером ресурсов
</h4>
<table>
    <tr>
        <td>Операция</td>
        <td>URI</td>
        <td>Действие</td>
        <td>Название роута</td>
    </tr>
    <tr>
        <td>GET</td>
        <td>/photos</td>
        <td>index</td>
        <td>photos.index</td>
    </tr>
    <tr>
        <td>GET</td>
        <td>/photos/create</td>
        <td>create</td>
        <td>photos.create</td>
    </tr>
    <tr>
        <td>POST</td>
        <td>/photos</td>
        <td>store</td>
        <td>photos.store</td>
    </tr>
    <tr>
        <td>GET</td>
        <td>/photos/{photo}</td>
        <td>show</td>
        <td>photos.show</td>
    </tr>
    <tr>
        <td>GET</td>
        <td>/photos/{photo}/edit</td>
        <td>edit</td>
        <td>photos.edit</td>
    </tr>
    <tr>
        <td>PUT/PATCH</td>
        <td>/photos/{photo}</td>
        <td>update</td>
        <td>photos.update</td>
    </tr>
    <tr>
        <td>DELETE</td>
        <td>/photos/{photo}</td>
        <td>destroy</td>
        <td>photos.destroy</td>
    </tr>
</table>
<h4 class="theme_subtitlex2">
    Указание модели ресурса
</h4>
<p class="theme__text">
    Если вы используете связывание моделей роутов и хотели бы, чтобы методы контроллера ресурсов указывали в качестве аргумента экземпляр модели, можно использовать опцию --model при генерировании контроллера:
</p>
<code>
<pre>
php artisan make:controller PhotoController --resource --model=Photo
</pre>
</code>
<h3 class="theme__subtitle">
    API Resource Routes
</h3>
<p class="theme__text">
    При объявлении маршрутов ресурсов, которые будут использоваться API, вы обычно хотите исключить маршруты, которые представляют шаблоны HTML, такие как create и edit. Для удобства вы можете использовать метод apiResource для автоматического исключения этих двух маршрутов:
</p>
<code>
<pre>
Route::apiResource('photos', PhotoController::class);
</pre>
</code>
<p class="theme__text">
    Вы можете зарегистрировать сразу несколько контроллеров ресурсов API, передав массив методу apiResources:
</p>
<code>
<pre>
Route::apiResources([
    'photos' => PhotoController::class,
    'posts' => PostController::class,
]);
</pre>
</code>
<p class="theme__text">
    Чтобы быстро сгенерировать контроллер ресурсов API, который не включает методы create или edit, используйте переключатель --api при выполнении команды make: controller:
</p>
<code>
<pre>
php artisan make:controller API/PhotoController --api
</pre>
</code>
<h3 class="theme__subtitle">
    Вложенные ресурсы
</h3>
<p class="theme__text">
    Иногда вам может потребоваться определить маршруты к вложенному ресурсу. Например, фоторесурс может иметь несколько комментариев, которые могут быть прикреплены к фотографии. Чтобы вложить контроллеры ресурсов, используйте нотацию с точкой в объявлении маршрута:
</p>
<code>
<pre>
Route::resource('photos.comments', PhotoCommentController::class);
</pre>
</code>
<p class="theme__text">
    Этот маршрут зарегистрирует вложенный ресурс, к которому можно получить доступ с помощью URI, подобных следующим:
</p>
<code>
<pre>
/photos/{photo}/comments/{comment}
</pre>
</code>
<h3 class="theme__subtitle">
    Scoping Nested Resources
</h3>
<p class="theme__text">
    Функция неявной привязки модели Laravel может автоматически определять вложенные привязки, так что разрешенная дочерняя модель подтверждается принадлежностью к родительской модели. Используя метод scoped при определении вложенного ресурса, вы можете включить автоматическое определение области, а также указать Laravel, в каком поле дочерний ресурс должен быть получен:
</p>
<code>
<pre>
Route::resource('photos.comments', PhotoCommentController::class)->scoped([
    'comment' => 'slug',
]);
</pre>
</code>
<p class="theme__text">
    Этот маршрут зарегистрирует вложенный ресурс с ограниченной областью действия, к которому можно получить доступ с помощью таких URI, как следующие:
</p>
<code>
<pre>
/photos/{photo}/comments/{comment:slug}
</pre>
</code>


<h3 class="theme__subtitle">
    Неглубокое гнездование (Shallow Nesting)
</h3>
<p class="theme__text">
    Часто нет необходимости иметь в URI и родительский, и дочерний идентификаторы, поскольку дочерний идентификатор уже является уникальным идентификатором. При использовании уникальных идентификаторов, таких как автоматически увеличивающиеся первичные ключи, для идентификации ваших моделей в сегментах URI, вы можете выбрать «неглубокую вложенность»:
</p>
<code>
<pre>
    Route::resource('photos.comments', CommentController::class)->shallow();
</pre>
</code>
<p class="theme__text">
    Приведенное выше определение маршрута будет определять следующие маршруты:
</p>
<table>
    <tr>
        <td>Verb</td>
        <td>URI</td>
        <td>Action</td>
        <td>Route Name</td>
    </tr>
    <tr>
        <td>GET</td>
        <td>/photos/{photo}/comments
        </td>
        <td>index</td>
        <td>photos.comments.index</td>
    </tr>
    <tr>
        <td>GET</td>
        <td>/photos/{photo}/comments/create</td>
        <td>create</td>
        <td>photos.comments.create</td>
    </tr>
    <tr>
        <td>POST</td>
        <td>/photos/{photo}/comments
        </td>
        <td>store</td>
        <td>photos.comments.store</td>
    </tr>
    <tr>
        <td>GET</td>
        <td>/comments/{comment}</td>
        <td>show</td>
        <td>comments.show</td>
    </tr>
    <tr>
        <td>GET</td>
        <td>/comments/{comment}/edit</td>
        <td>edit</td>
        <td>comments.edit</td>
    </tr>
    <tr>
        <td>PUT/PATCH</td>
        <td>/comments/{comment}
        </td>
        <td>update</td>
        <td>comments.update</td>
    </tr>
    <tr>
        <td>DELETE</td>
        <td>/comments/{comment}
        </td>
        <td>destroy</td>
        <td>comments.destroy</td>
    </tr>
</table>
<h3 class="theme__subtitle">
    Именование роутов ресурса
</h3>
<p class="theme__text">
    По умолчанию все действия контроллера ресурсов имеют имена роутов, но вы можете переопределить эти имена, передав массив names вместе с остальными параметрами:
</p>
<code>
<pre>
    Route::resource('photos', PhotoController::class)->names([
        'create' => 'photos.build'
    ]);
</pre>
</code>
<h3 class="theme__subtitle">
    Именование параметров роута ресурса
</h3>
<p class="theme__text">
    По умолчанию Route::resource создаст параметры для ваших роутов ресурсов на основе имени ресурса в единственном числе. Это легко можно изменить для каждого ресурса, передав parameters в массив опций. Массив parameters должен быть ассоциативным массивом имён ресурсов и имён параметров:
</p>
<code>
<pre>
    Route::resource('users', AdminUserController::class)->parameters([
        'users' => 'admin_user'
    ]);
</pre>
</code>
<p class="theme__text">
    В приведенном выше примере генерируются следующие URI для маршрута show ресурса:
</p>
<code>
<pre>

    /users/{admin_user}
</pre>
</code>
<h3 class="theme__subtitle">
    Scoping Resource Routes
</h3>
<p class="theme__text">
    Иногда при неявной привязке нескольких моделей Eloquent в определениях маршрутов ресурсов вы можете захотеть ограничить вторую модель Eloquent таким образом, чтобы она была дочерней по отношению к первой модели Eloquent. Например, рассмотрим ситуацию, когда сообщение в блоге извлекается по слагу для определенного пользователя:
</p>
<code>
<pre>
    use App\Http\Controllers\PostsController;

    Route::resource('users.posts', PostsController::class)->scoped();
</pre>
</code>
<p class="theme__text">
    Вы можете переопределить ключи маршрута модели по умолчанию, передав массив scoped методу
</p>
<code>
<pre>
    use App\Http\Controllers\PostsController;

    Route::resource('users.posts', PostsController::class)->scoped([
        'post' => 'slug',
    ]);
</pre>
</code>
<p class="theme__text">
    При использовании настраиваемой неявной привязки с ключом в качестве параметра вложенного маршрута Laravel автоматически задает область запроса для получения вложенной модели своим родителем, используя соглашения, чтобы угадать имя отношения на родительском элементе. В этом случае предполагается, что модель User имеет отношение с именем posts (множественное число от имени параметра маршрута), которое можно использовать для получения модели Post.
</p>
<h3 class="theme__subtitle">
    Локализация URI ресурсов
</h3>
<p class="theme__text">
    По умолчанию Route::resource будет создавать URI ресурсов, используя английские глаголы. Если вам нужно локализовать глаголы действий create и edit, вы можете использовать метод Route::resourceVerbs. Данную задачу можно выполнить в методе boot вашего AppServiceProvider:
</p>
<code>
<pre>
    use Illuminate\Support\Facades\Route;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);
    }
</pre>
</code>
<p class="theme__text">
    После настройки глаголов регистрация маршрута ресурса, такая как Route :: resource ('fotos', 'PhotoController'), создаст следующие URI:
</p>
<code>
<pre>
    /fotos/crear

    /fotos/{foto}/editar
</pre>
</code>
<h3 class="theme__subtitle">
    Добавление дополнительных роутов в контроллеры ресурсов
</h3>
<p class="theme__text">
    Если вам надо добавить дополнительные роуты в контроллер ресурсов, не входящие в набор роутов ресурсов по умолчанию, их надо определить до вызова Route::resource; в ином случае, определенные методом resource роуты могут нечаянно превзойти по важности ваши дополнительные роуты:
</p>
<code>
<pre>
    Route::get('photos/popular', 'PhotoController@method');

    Route::resource('photos', 'PhotoController');
</pre>
</code>
<p class="theme__text">
    Старайтесь, чтобы контроллеры были узкоспециализированными. Если вам постоянно требуются методы вне стандартного набора действий с ресурсами, попробуйте разделить контроллер на два небольших контроллера.
</p>
<h3 class="theme__subtitle">
    Внедрение зависимостей и контроллеры
</h3>
<h4 class="theme_subtitlex2">
    Внедрение в конструктор
</h4>
<p class="theme__text">
    Сервис-контейнер Laravel используется для работы всех контроллеров Laravel. В результате вы можете указывать типы любых зависимостей, которые могут потребоваться вашему контроллеру в его конструкторе. Заявленные зависимости будут автоматически получены и внедрены в экземпляр контроллера:
</p>
<code>
<pre>
    namespace App\Http\Controllers;

    use App\Repositories\UserRepository;

    class UserController extends Controller
    {
        /**
         * The user repository instance.
         */
        protected $users;

        /**
         * Create a new controller instance.
         *
         * @param  UserRepository  $users
         * @return void
         */
        public function __construct(UserRepository $users)
        {
            $this->users = $users;
        }
    }
</pre>
</code>
<p class="theme__text">
    Разумеется, вы можете также указать в качестве аргумента тип любого Laravel-контракта. Если контейнер может с ним работать, значит вы можете указывать его тип. В некоторых случаях внедрение зависимостей в контроллер обеспечивает лучшую тестируемость приложения.
</p>
<h4 class="theme_subtitlex2">
    Внедрение в метод
</h4>
<p class="theme__text">
    Кроме внедрения в конструктор, вы также можете указывать типы зависимостей в методах вашего контроллера. Распространённый пример внедрения в метод — внедрение экземпляра Illuminate\Http\Request в один из методов контроллера:
</p>
<code>
<pre>
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class UserController extends Controller
    {
        /**
         * Store a new user.
         *
         * @param  Request  $request
         * @return Response
         */
        public function store(Request $request)
        {
            $name = $request->name;

            //
        }
    }
</pre>
</code>
<p class="theme__text">
    Если ваш метод контроллера также ожидает ввода от параметра маршрута, укажите аргументы маршрута после других зависимостей. Например, если ваш маршрут определен так:
</p>
<code>
<pre>
    Route::put('user/{id}', [UserController::class, 'update']);
</pre>
</code>
<p class="theme__text">
    Вы по-прежнему можете указать Illuminate \ Http \ Request и получить доступ к своему параметру id, определив метод вашего контроллера следующим образом:
</p>
<code>
<pre>
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class UserController extends Controller
    {
        /**
         * Update the given user.
         *
         * @param  Request  $request
         * @param  string  $id
         * @return Response
         */
        public function update(Request $request, $id)
        {
            //
        }
    }
</pre>
</code>
<h3 class="theme__subtitle">
    Кэширование роутов
</h3>
<p class="theme__text">
    Если ваше приложение единолично использует роуты контроллера, то вы можете воспользоваться преимуществом кэширования роутов в Laravel. Использование кэша роутов радикально уменьшит время, требуемое для регистрации всех роутов вашего приложения. В некоторых случаях регистрация ваших роутов может стать быстрее в 100 раз. Для создания кэша роутов просто выполните Artisan-команду route:cache:
</p>
<code>
<pre>
    php artisan route:cache
</pre>
</code>
<p class="theme__text">
    После выполнения этой команды ваши кэшированные роуты будут загружаться при каждом запросе. Помните, после добавления новых роутов, вам необходимо заново сгенерировать свежий кэш роутов. Поэтому нужно выполнить команду route:cache уже при развёртывании вашего проекта.
    Для очистки кэша роутов используйте команду route:clear:
</p>
<code>
<pre>
    php artisan route:clear
</pre>
</code>
</div>








{{-- ===================== --}}
{{-- Theme: HTTP запросы --}}
{{-- ===================== --}}
<div class="theme">
    <h2 class="theme__title">
        HTTP запросы
    </h2>
    <h3 class="theme__subtitle">
        Получение экземпляра запроса
    </h3>
    <p class="theme__text">
        Чтобы получить экземпляр текущего HTTP-запроса через внедрение зависимостей, вы должны ввести класс Illuminate \ Http \ Request в методе вашего контроллера. Экземпляр входящего запроса будет автоматически внедрен сервис-контейнером:
    </p>
<code>
<pre>
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $name = $request->input('name');
    }
}
</pre>
</code>
    <h3 class="theme__subtitle">
        Внедрение зависимостей и параметры маршрута
    </h3>
    <p class="theme__text">
        Если метод вашего контроллера также ожидает ввода из параметра маршрута, вы должны указать параметры маршрута после других зависимостей. Например, если ваш маршрут определен так:
    </p>
<code>
<pre>
use App\Http\Controllers\UserController;
Route::put('user/{id}', [UserController::class, 'update']);
</pre>
</code>
<p class="theme__text">
    Вы по-прежнему можете ввести Illuminate \ Http \ Request и получить доступ к своему id параметра маршрута, определив свой метод контроллера следующим образом:
</p>
<code>
<pre>
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        //
    }
}
</pre>
</code>

<h3 class="theme__subtitle">
    Методы и путь запроса
</h3>
<p class="theme__text">
    Экземпляр Illuminate \ Http \ Request предоставляет множество методов для проверки HTTP-запроса для вашего приложения и расширяет класс Symfony \ Component \ HttpFoundation \ Request. Ниже мы обсудим несколько наиболее важных методов.
</p>
<h3 class="theme_subtitlex2">
    Получение пути запроса
</h3>
<p class="theme__text">
    Метод path возвращает информацию о пути запроса. Итак, если входящий запрос нацелен на http://domain.com/foo/bar, метод path вернет foo / bar:
</p>
<code>
<pre>
$uri = $request->path();
</pre>
</code>
<p class="theme__text">
    Метод is позволяет проверить соответствие пути запроса заданной маске. При использовании этого метода можно использовать символ звёздочки * в качестве маски:
</p>
<code>
<pre>
if ($request->is('admin/*')) {
    //
}
</pre>
</code>
<h3 class="theme_subtitlex2">
    Получение URL-адреса запроса
</h3>
<p class="theme__text">
    Чтобы получить полный URL-адрес входящего запроса, вы можете использовать методы url или fullUrl. Метод url вернет URL без строки запроса, а метод fullUrl включает строку запроса:
</p>
<code>
<pre>
// Without Query String...
$url = $request->url();
// With Query String...
$url = $request->fullUrl();
</pre>
</code>
<h3 class="theme_subtitlex2">
    Получение метода запроса
</h3>
<p class="theme__text">
    Метод method вернёт HTTP-действие запроса. Вы можете использовать метод isMethod для проверки соответствия HTTP-действия заданной строке:
</p>
<code>
<pre>
$method = $request->method();
if ($request->isMethod('post')) {
    //
}
</pre>
</code>
<h3 class="theme__subtitle">
    Запросы PSR-7
</h3>
<p class="theme__text">
    Стандарт PSR-7 описывает интерфейсы для HTTP-сообщений, включая запросы и отклики. Если вы хотите получить экземпляр запроса PSR-7 вместо Laravel-запроса, сначала вам надо установить несколько библиотек. Laravel использует компонент Symfony HTTP Message Bridge для конвертации обычных запросов и откликов Laravel в совместимые с PSR-7:
</p>
<code>
<pre>
composer require symfony/psr-http-message-bridge
composer require nyholm/psr7
</pre>
</code>
<p class="theme__text">
    Когда вы установите эти библиотеки, вы можете получить запрос PSR-7, указав интерфейс запроса в замыкании вашего роута или методе контроллера:
</p>
<code>
<pre>
use Psr\Http\Message\ServerRequestInterface;
Route::get('/', function (ServerRequestInterface $request) {
    //
});
</pre>
</code>
<p class="theme__text">
    Если вы возвращаете экземпляр отклика PSR-7 из роута или контроллера, он будет автоматически конвертирован обратно в экземпляр отклика Laravel и будет отображён фреймворком.
</p>
<h3 class="theme__subtitle">
    Обрезка и нормализация ввода
</h3>
<p class="theme__text">
    По умолчанию Laravel включает посредников TrimStrings и ConvertEmptyStringsToNull в глобальном стеке посредников вашего приложения. Эти посредники перечислены в стеке по классу App\Http\Kernel. Данные посредники будут автоматически обрезать все поля входящих строк по запросу, а также конвертировать любые пустые поля строк в null. Это позволит вам не беспокоиться о проблемах нормализации в ваших роутах и контроллерах.
    Если вы хотите отключить подобное поведение, то можете убрать двух посредников из стека посредников своего приложения, убрав их из свойства $middleware своего класса App\Http\Kernel.
</p>
<h3 class="theme__subtitle">
    Получение ввода
</h3>
<h4 class="theme_subtitlex2">
    Получение всех данных ввода
</h4>
<p class="theme__text">
    Вы также можете получить все входные данные в виде массива, используя метод all:

</p>
<code>
<pre>
    $input = $request→all();
</pre>
</code>
<h4 class="theme_subtitlex2">
    Получения значения из ввода
</h4>
<p class="theme__text">
    Используя несколько простых методов, вы можете получить доступ ко всему пользовательскому вводу из вашего экземпляра Illuminate \ Http \ Request, не беспокоясь о том, какой HTTP-запроса был использован, метод input работает одинаково для любого из них:
</p>
<code>
<pre>
    $name = $request->input('name');
</pre>
</code>
<p class="theme__text">
    Вы можете передать значение по умолчанию в качестве второго аргумента метода input. Это значение будет возвращено, если запрошенное входное значение отсутствует в запросе:
</p>
<code>
<pre>
    $name = $request->input('name', 'Sally');
</pre>
</code>
<p class="theme__text">
    При работе с формами, которые содержат входные данные массива, используйте "точечную" нотацию для доступа к массивам:
</p>
<code>
<pre>
    $name = $request->input('products.0.name');

    $names = $request->input('products.*.name');
</pre>
</code>
<p class="theme__text">
    Вы можете вызвать метод input без каких-либо аргументов, чтобы получить все входные значения в виде ассоциативного массива:
</p>
<code>
<pre>
    $input = $request->input();
</pre>
</code>
<h4 class="theme_subtitlex2">
    Получение ввода из строки запроса
</h4>
<p class="theme__text">
    В то время как метод input извлекает значения из всей полезной нагрузки запроса (включая строку запроса), метод query будет извлекать значения только из строки запроса:
</p>
<code>
<pre>
    $name = $request->query('name');
</pre>
</code>
<p class="theme__text">
    Если данные значения запрошенной строки запроса отсутствуют, будет возвращен второй аргумент этого метода:
</p>
<code>
<pre>
    $name = $request->query('name', 'Helen');
</pre>
</code>
<p class="theme__text">
    Вы можете вызвать метод query без каких-либо аргументов, чтобы получить все значения строки запроса в виде ассоциативного массива:
</p>
<code>
<pre>
    $query = $request->query();
</pre>
</code>
<h4 class="theme_subtitlex2">
    Получение ввода через динамические свойства
</h4>
<p class="theme__text">
    Также вы можете получать пользовательский ввод, используя динамический свойства экземпляра Illuminate\Http\Request. Например, если одна из форм приложения содержит поле name, вы можете получить значение отправленного поля вот так:
</p>
<code>
<pre>
    $name = $request->name;
</pre>
</code>
<p class="theme__text">
    При использовании динамических свойств Laravel сначала ищет значение параметра в данных запроса. Если его там нет, Laravel будет искать поле в параметрах роута.
</p>
<h4 class="theme_subtitlex2">
    Получения значения из ввода JSON
</h4>
<p class="theme__text">
    При отправке запросов JSON в ваше приложение вы можете получить доступ к данным JSON через метод input, если заголовок Content-Type запроса правильно установлен на application / json. Вы даже можете использовать «точечный» синтаксис, чтобы погружаться в массивы JSON:
</p>
<code>
<pre>
    $name = $request→input('user.name');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Получение булевых значений
</h4>
<p class="theme__text">
    При работе с элементами HTML, такими как флажки, ваше приложение может получать «правдивые» значения, которые на самом деле являются строками. Например, «верно» или «включено». Для удобства вы можете использовать логический метод для получения этих значений как логических. Логический метод возвращает true для 1, «1», true, «true», «on» и «yes». Все остальные значения вернут false:
</p>
<code>
<pre>
    $archived = $request->boolean('archived');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Получение части переменных запроса
</h4>
<p class="theme__text">
    Если вам необходимо получить только часть данных ввода, используйте методы only и except. Оба этих метода принимают один массив или динамический список аргументов:
</p>
<code>
<pre>
    $input = $request->only(['username', 'password']);

    $input = $request->only('username', 'password');

    $input = $request->except(['credit_card']);

    $input = $request->except('credit_card');
</pre>
</code>
<p class="theme__text">
    Метод only возвращает все пары ключ / значение, которые вы запрашиваете, даже если ключа нет во входящих запросах. Когда ключ не присутствует в запросе, значение будет null. Если вы хотите получить часть входных данных, которые действительно присутствуют в запросе, можно использовать метод intersect:
</p>
<code>
<pre>
    $input = $request->intersect(['username', 'password']);
</pre>
</code>
<h4 class="theme__subtitle">
    Была ли передана переменная?
</h4>
<p class="theme__text">
    Вы должны использовать метод has, чтобы определить, присутствует ли значение в запросе. Метод has возвращает true, если значение присутствует в запросе:
</p>
<code>
<pre>
    if ($request->has('name')) {
        //
    }
</pre>
</code>
<p class="theme__text">
    При задании массива метод has определит, присутствуют ли все указанные значения:
</p>
<code>
<pre>
    if ($request->has(['name', 'email'])) {
        //
    }
</pre>
</code>
<p class="theme__text">
    Метод whenHas выполнит данный обратный вызов, если в запросе присутствует значение:
</p>
<code>
<pre>
    $request->whenHas('name', function ($input) {
        //
    });
</pre>
</code>
<p class="theme__text">
    Метод hasAny возвращает true, если присутствует любое из указанных значений:
</p>
<code>
<pre>
    if ($request->hasAny(['name', 'email'])) {
        //
    }
</pre>
</code>
<p class="theme__text">
    Если вы хотите определить, присутствует ли значение в запросе и не является ли оно пустым, вы можете использовать метод filled:
</p>
<code>
<pre>
    if ($request->filled('name')) {
        //
    }
</pre>
</code>
<p class="theme__text">
    Метод whenFilled выполнит заданный обратный вызов, если значение присутствует в запросе и не является пустым:
</p>
<code>
<pre>
    $request->whenFilled('name', function ($input) {
        //
    });
</pre>
</code>
<p class="theme__text">
    Чтобы определить, отсутствует ли данный ключ в запросе, вы можете использовать метод missing:
</p>
<code>
<pre>
    if ($request->missing('name')) {
        //
    }
</pre>
</code>
<h3 class="theme__subtitle">
    Старый ввод
</h3>
<p class="theme__text">
    Laravel позволяет сохранить ввод от одного запроса во время следующего запроса. Это может пригодиться во время повторного наполнения форм после обнаружения ошибок валидации. Однако, если вы используете включённые в Laravel возможности проверки ввода, то вряд ли вам понадобиться использовать эти методы вручную, так как встроенные возможности Laravel вызовут их автоматически.
</p>
<h4 class="theme_subtitlex2">
    Передача ввода в сессию
</h4>
<p class="theme__text">
    Метод flash класса Illuminate\Http\Request передаст текущий ввод в сессию, и он будет доступен во время следующего пользовательского запроса к приложению:
</p>
<code>
<pre>
    $request->flash();
</pre>
</code>
<p class="theme__text">
    Вы также можете использовать методы flashOnly и flashExcept для передачи некоторых переменных в сессию. Эти методы полезны для хранения важной информации (например, паролей) вне сессии:
</p>
<code>
<pre>
    $request->flashOnly(['username', 'email']);

    $request->flashExcept('password');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Передача ввода и последующее перенаправление
</h4>
<p class="theme__text">
    Поскольку вам часто требуется выполнить мигание ввода в сеанс, а затем перенаправить на предыдущую страницу, вы можете легко связать мигание ввода с перенаправлением, используя метод withInput:
</p>
<code>
<pre>
    return redirect('form')->withInput();

    return redirect('form')->withInput(
        $request->except('password')
    );

</pre>
</code>
<h4 class="theme_subtitlex2">
    Получение старого ввода
</h4>
<p class="theme__text">
    Для получения переданного ввода из предыдущего запроса используйте метод old на экземпляре Request. Метод old получит переданные ранее данные ввода из сессии:
</p>
<code>
<pre>
    $username = $request->old('username');
</pre>
</code>
<p class="theme__text">
    В Laravel есть также и глобальный хелпер old. Когда вы выводите старый ввод в шалоне Blade, удобнее использовать этот хелпер old. Если для данного поля нет старого ввода, вернётся null:
</p>
<code>
<pre>
    < input type="text" name="username" value="{ { old('username') }}">
</pre>
</code>
<h3 class="theme__subtitle">
    Cookies
</h3>
<h4 class="theme_subtitlex2">
    Получение Cookies из запросов
</h4>
<p class="theme__text">
    Все cookie, создаваемые Laravel, шифруются и подписываются специальным кодом — таким образом, если клиент изменит их значение, то они станут недействительными. Для получения значения cookie из запроса используйте метод cookie на экземпляре Illuminate\Http\Request:
</p>
<code>
<pre>
    $value = $request->cookie('name');
</pre>
</code>
<p class="theme__text">
    В качестве альтернативы вы можете использовать фасад Cookie для доступа к значениям cookie:
</p>
<code>
<pre>
    use Illuminate\Support\Facades\Cookie;

    $value = Cookie::get('name');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Прикрепление файлов cookie к ответам
</h4>
<p class="theme__text">
    Вы можете прикрепить cookie к исходящему экземпляру Illuminate\Http\Response с помощью метода cookie. Вы должны передать в этот метод имя, значение и количество минут, в течение которого cookie должен считаться действующим:
</p>
<code>
<pre>
    return response('Hello World')->cookie(
        'name', 'value', $minutes
    );
</pre>
</code>
<p class="theme__text">
    Метод cookie также принимает еще несколько аргументов, которые используются реже. Как правило, эти аргументы имеют то же назначение и значение, что и аргументы, передаваемые встроенному в PHP методу setcookie:
</p>
<code>
<pre>
    return response('Hello World')->cookie(
        'name', 'value', $minutes, $path, $domain, $secure, $httpOnly
    );
</pre>
</code>
<p class="theme__text">
    В качестве альтернативы вы можете использовать фасад Cookie, чтобы «поставить в очередь» файлы cookie для вложения в исходящий ответ от вашего приложения. Метод queue принимает экземпляр Cookie или аргументы, необходимые для создания экземпляра Cookie. Эти файлы cookie будут прикреплены к исходящему ответу перед его отправкой в браузер:
</p>
<code>
<pre>
    Cookie::queue(Cookie::make('name', 'value', $minutes));

    Cookie::queue('name', 'value', $minutes);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Генерация экземпляров Cookie
</h4>
<p class="theme__text">
    Если вы хотите сгенерировать экземпляр Symfony\Component\HttpFoundation\Cookie, который позднее можно будет передать экземпляру отклика, используйте глобальный хелпер cookie. Этот cookie не будет отправлен обратно клиенту до тех пор, пока не будет прикреплён к экземпляру отклика:
</p>
<code>
<pre>
    $cookie = cookie('name', 'value', $minutes);

    return response('Hello World')->cookie($cookie);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Устаревшие файлы cookie
</h4>
<p class="theme__text">
    Вы можете удалить файл cookie, истек его срок действия с помощью метода forget фасада Cookie:
</p>
<code>
<pre>
    Cookie::queue(Cookie::forget('name'));
</pre>
</code>
<p class="theme__text">
    В качестве альтернативы вы можете прикрепить просроченный файл cookie к экземпляру ответа:
</p>
<code>
<pre>
    $cookie = Cookie::forget('name');

    return response('Hello World')->withCookie($cookie);
</pre>
</code>
<h3 class="theme__subtitle">
    Файлы
</h3>
<h4 class="theme_subtitlex2">
    Получение загруженных файлов
</h4>
<p class="theme__text">
    Вы можете получить доступ к загруженным файлам из экземпляра Illuminate \ Http \ Request, используя file метод или используя динамические свойства. Метод file возвращает экземпляр класса Illuminate \ Http \ UploadedFile, который расширяет класс PHP SplFileInfo и предоставляет различные методы для взаимодействия с файлом:
</p>
<code>
<pre>
    $file = $request->file('photo');

    $file = $request->photo;
</pre>
</code>
<p class="theme__text">
    Вы можете определить, присутствует ли файл в запросе, используя метод hasFile:
</p>
<code>
<pre>
    if ($request->hasFile('photo')) {
        //
    }
</pre>
</code>
<h4 class="theme_subtitlex2">
    Прошёл ли загруженный файл проверку?
</h4>
<p class="theme__text">
    Помимо проверки наличия файла, вы можете убедиться, что не было проблем с загрузкой файла с помощью метода isValid:
</p>
<code>
<pre>
    if ($request->file('photo')->isValid()) {
        //
    }
</pre>
</code>
<h4 class="theme_subtitlex2">
    Пути и расширения файла
</h4>
<p class="theme__text">
    Класс UploadedFile также содержит методы для доступа к полному пути к файлу и его расширению. Метод extension попытается угадать расширение файла на основе его содержимого. Это расширение может отличаться от расширения, предоставленного клиентом:
</p>
<code>
<pre>
    $path = $request->photo->path();

    $extension = $request->photo->extension();
</pre>
</code>
<h3 class="theme__subtitle">
    Другие методы для работы с файлами
</h3>
<p class="theme__text">
    Есть множество других методов для экземпляров UploadedFile. Загляните в API documentation for the class для получения более подробной информации об этих методах.
</p>
<h3 class="theme__subtitle">
    Хранение загруженных файлов
</h3>
<p class="theme__text">
    Для хранения загруженного файла обычно используется одна из настроенных файловых систем. У класса UploadedFile есть метод store, который перемещает загруженный файл на один из ваших дисков, который может быть местом в вашей локальной файловой системе или даже в облачном хранилище, например Amazon S3.

    Метод store принимает путь, по которому файл должен храниться относительно настроенного корневого каталога файловой системы. Этот путь не должен содержать имя файла, так как уникальный идентификатор будет автоматически сгенерирован в качестве имени файла.

    Метод store также принимает необязательный второй аргумент для имени диска, который следует использовать для хранения файла. Метод вернет путь к файлу относительно корня диска:
</p>
<code>
<pre>
    $path = $request->photo->store('images');

    $path = $request->photo->store('images', 's3');
</pre>
</code>
<p class="theme__text">
    Если вы не хотите, чтобы имя файла создавалось автоматически, вы можете использовать метод storeAs, который принимает в качестве аргументов путь, имя файла и имя диска:
</p>
<code>
<pre>
    $path = $request->photo->storeAs('images', 'filename.jpg');

    $path = $request->photo->storeAs('images', 'filename.jpg', 's3');
</pre>
</code>
<h3 class="theme__subtitle">
    Настройка доверенных прокси

</h3>
<p class="theme__text">
    https://laravel.com/docs/8.x/requests
</p>
</div>









{{-- ===================== --}}
{{-- Theme: HTTP ответы --}}
{{-- ===================== --}}
<div class="theme">
    <h2 class="theme__title">
        HTTP ответы
    </h2>
    <h3 class="theme__subtitle">
        Создание ответов
    </h3>
    <h4 class="theme_subtitlex2">
        Строки и массивы
    </h4>
    <p class="theme__text">
        Все маршруты и контроллеры должны возвращать ответ, который будет отправлен обратно в браузер пользователя. Laravel предоставляет несколько разных способов вернуть ответы. Самый простой ответ - это возврат строки от маршрута или контроллера. Фреймворк автоматически преобразует строку в полный HTTP-ответ:
    </p>
<code>
<pre>
Route::get('/', function () {
    return 'Hello World';
});
</pre>
</code>
    <p class="theme__text">
        Помимо возврата строк из ваших маршрутов и контроллеров, вы также можете возвращать массивы. Фреймворк автоматически преобразует массив в ответ JSON-ответ:
    </p>
<code>
<pre>
Route::get('/', function () {
    return [1, 2, 3];
});
</pre>
</code>
    <p class="theme__text">
        Коллекции Eloquent также автоматически конвертируются в JSON.
    </p>
<h4 class="theme_subtitlex2">
    Объекты ответа
</h4>
<p class="theme__text">
    Как правило, вы не будете просто возвращать простые строки или массивы из действий маршрута. Вместо этого вы вернете полные экземпляры Illuminate \ Http \ Response или шаблоны.
    <br>
    Возврат полного экземпляра Response позволяет вам изменять HTTP-код состояния и заголовки  ответа. Экземпляр Response наследуется от класса Symfony \ Component \ HttpFoundation \ Response, который предоставляет множество методов для создания HTTP-ответов:
</p>
<code>
<pre>
Route::get('home', function () {
    return response('Hello World', 200)->header('Content-Type', 'text/plain');
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Добавление заголовков в ответам
</h4>
<p class="theme__text">
    Имейте в виду, что большинство методов ответа объединяются в цепочку, что делает создание откликов более гибким.  Например, вы можете использовать метод header, чтобы добавить серию заголовков к ответу перед отправкой его обратно пользователю:
</p>
<code>
<pre>
return response($content)
    ->header('Content-Type', $type)
    ->header('X-Header-One', 'Header Value')
    ->header('X-Header-Two', 'Header Value');
</pre>
</code>
<p class="theme__text">
    Или вы можете использовать метод withHeaders, чтобы указать массив заголовков, которые нужно добавить в ответ:
</p>
<code>
<pre>
return response($content)->withHeaders([
    'Content-Type' => $type,
    'X-Header-One' => 'Header Value',
    'X-Header-Two' => 'Header Value',
]);
</pre>
</code>
<h3 class="theme__subtitle">
    Посредник для управления кешем
</h3>
<p class="theme__text">
    Laravel включает посредник cache.headers, которое можно использовать для быстрой установки заголовка Cache-Control для группы маршрутов. Если в списке директив указан etag, в качестве идентификатора ETag автоматически будет установлен хеш MD5 содержимого ответа:
</p>
<code>
<pre>
Route::middleware('cache.headers:public;max_age=2628000;etag')->group(function () {
    Route::get('privacy', function () {
        // ...
    });
    Route::get('terms', function () {
        // ...
    });
});
</pre>
</code>
<h3 class="theme__subtitle">
    Прикрепление файлов cookie к ответам
</h3>
<p class="theme__text">
    Метод cookie в экземплярах ответа позволяет легко прикреплять файлы cookie к ответу. Например, вы можете использовать метод cookie, чтобы сгенерировать cookie и легко прикрепить его к экземпляру ответа следующим образом:
</p>
<code>
<pre>
return response($content)
    ->header('Content-Type', $type)
    ->cookie('name', 'value', $minutes);
</pre>
</code>
<p class="theme__text">
    Метод cookie также принимает еще несколько аргументов, которые используются реже. Как правило, эти аргументы имеют то же назначение и значение, что и аргументы, передаваемые встроенному в PHP методу setcookie:
</p>
<code>
<pre>
->cookie($name, $value, $minutes, $path, $domain, $secure, $httpOnly)
</pre>
</code>
<p class="theme__text">
    В качестве альтернативы вы можете использовать фасад Cookie, чтобы «поставить в очередь» файлы cookie для вложения в исходящий ответ от вашего приложения. Метод queue принимает экземпляр Cookie или аргументы, необходимые для создания экземпляра Cookie. Эти файлы cookie будут прикреплены к исходящему ответу перед его отправкой в браузер:
</p>
<code>
<pre>
Cookie::queue(Cookie::make('name', 'value', $minutes));
Cookie::queue('name', 'value', $minutes);
</pre>
</code>
<h3 class="theme__subtitle">
    Cookies и шифрование
</h3>
<p class="theme__text">
    По умолчанию все файлы cookie, генерируемые Laravel, зашифрованы и подписаны, поэтому клиент не может их изменить или прочитать. Если вы хотите отключить шифрование для подмножества файлов cookie, создаваемых вашим приложением, вы можете использовать свойство $ except посредник App \ Http \ Middleware \ EncryptCookies, которое находится в каталоге app / Http / Middleware:
</p>
<code>
<pre>
protected $except = [
    'cookie_name',
];
</pre>
</code>
<h3 class="theme__subtitle">
    Перенаправления
</h3>
<p class="theme__text">
    Ответы на перенаправление являются экземплярами класса Illuminate \ Http \ RedirectResponse и содержат правильные заголовки, необходимые для перенаправления пользователя на другой URL-адрес. Есть несколько способов создать экземпляр RedirectResponse. Самый простой способ - использовать глобальный помощник redirect:
</p>
<code>
<pre>
Route::get('dashboard', function () {
    return redirect('home/dashboard');
});
</pre>
</code>
<p class="theme__text">
    Если вы захотите переадресовать пользователя на предыдущую страницу (например, после отправки формы с некорректными данными), используйте глобальный вспомогательной функции  back. Поскольку для этого используются сессии, роут, вызывающий метод back должен использовать группу посредников web или должен применять всех посредников сессий:
</p>
<code>
<pre>
Route::post('user/profile', function () {
    // Validate the request...
    return back()->withInput();
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Редиректы на именованные роуты
</h4>
<p class="theme__text">
    Когда вы вызываете помощник redirect без параметров, возвращается экземпляр Illuminate \ Routing \ Redirector, позволяющий вызывать любой метод в экземпляре Redirector. Например, чтобы сгенерировать RedirectResponse на именованный маршрут, вы можете использовать метод маршрута:
</p>
<code>
<pre>
return redirect()->route('login');
</pre>
</code>
<p class="theme__text">
    Если ваш маршрут имеет параметры, вы можете передать их в качестве второго аргумента метода route:
</p>
<code>
<pre>
return redirect()->route('profile', ['id' => 1]);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Заполнение параметров через модели Eloquent
</h4>
<p class="theme__text">
    Если вы перенаправляете на маршрут с параметром «ID», который был взят из модели Eloquent, то вы можете просто передать саму модель. ID будет извлечён автоматически:
</p>
<code>
<pre>
return redirect()->route('profile', [$user]);
</pre>
</code>
<p class="theme__text">
    Если вы хотите настроить значение, которое помещается в параметр маршрута, вы можете указать столбец в определении параметра маршрута (profile / {id: slug}) или переопределить метод getRouteKey в своей модели Eloquent:
</p>
<code>
<pre>
public function getRouteKey()
{
    return $this->slug;
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Перенаправление к действиям контроллера
</h4>
<p class="theme__text">
    Вы также можете создавать перенаправления на действия контроллера. Для этого передайте контроллер и имя действия методу action:
</p>
<code>
<pre>
use App\Http\Controllers\HomeController;
return redirect()->action([HomeController::class, 'index']);
Если ваш маршрут контроллера требует параметров, вы можете передать их в качестве второго аргумента методу action:
return redirect()->action(
    [UserController::class, 'profile'], ['id' => 1]
);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Перенаправление на внешние домены
</h4>
<p class="theme__text">
    Иногда может потребоваться перенаправление на домен за пределами вашего приложения. Вы можете сделать это, вызвав метод away, который создает RedirectResponse без какой-либо дополнительной кодировки URL, проверки или проверки:
</p>
<code>
<pre>
return redirect()->away('https://www.google.com');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Редиректы с одноразовыми переменными сессии
</h4>
<p class="theme__text">
    Редирект на новый URL и передача данных в сессию обычно происходят в одно и то же время. Обычно это делается после успешного выполнения действия, когда вы передаёте сообщение об этом в сессию. Для удобства вы можете создать экземпляр RedirectResponse и передать данные в сессию в одной гибкой связке методов:
</p>
<code>
<pre>
Route::post('user/profile', function () {
    // Update the user's profile...

    return redirect('dashboard')->with('status', 'Profile updated!');
});
</pre>
</code>
<p class="theme__text">
    Когда пользователь переадресован, вы можете вывести одноразовое сообщение из сессии. Например, с помощью синтаксиса Blade:
</p>
<code>
<pre>
@ if (session('status'))
< div class="alert alert-success">
    { { session('status') }}
< div >
@ endif
</pre>
</code>
<h3 class="theme__subtitle">
    Другие типы ответов
</h3>
<p class="theme__text">
    Помощник response может использоваться для генерации других типов экземпляров ответа. Когда помощник response вызывается без аргументов, возвращается реализация контракта Illuminate \ Contracts \ Routing \ ResponseFactory. Этот контракт предоставляет несколько полезных методов для генерации ответов.
</p>
<h4 class="theme_subtitlex2">
    Ответы шаблона
</h4>
<p class="theme__text">
    Если вам нужен контроль над статусом и заголовками ответа, но также необходимо вернуть представление в качестве содержимого ответа, вы должны использовать метод view:
</p>
<code>
<pre>
    return response()
    ->view('hello', $data, 200)
    ->header('Content-Type', $type);
</pre>
</code>
<p class="theme__text">
    Конечно, если вам не нужно передавать настраиваемый код состояния HTTP или настраиваемые заголовки, следует использовать вспомогательную функцию глобального view.
</p>
<h4 class="theme_subtitlex2">
    Ответы JSON
</h4>
<p class="theme__text">
    Метод json автоматически установит заголовок Content-Type в application / json, а также преобразует данный массив в JSON с помощью PHP-функции json_encode:
</p>
<code>
<pre>
    return response()->json([
        'name' => 'Abigail',
        'state' => 'CA',
    ]);
</pre>
</code>
<p class="theme__text">
    Если вы хотите создать ответ JSONP, вы можете использовать метод json в сочетании с методом withCallback:
</p>
<code>
<pre>
    return response()
    ->json(['name' => 'Abigail', 'state' => 'CA'])
    ->withCallback($request->input('callback'));
</pre>
</code>
<h4 class="theme_subtitlex2">
    Скачивание файлов
</h4>
<p class="theme__text">
    Метод download используется для создания отклика, получив который, браузер пользователя скачивает файл по указанному пути. Метод download принимает вторым аргументом имя файла, именно это имя увидит пользователь при скачивании файла. И наконец, вы можете передать массив HTTP-заголовков третьим аргументом метода:
</p>
<code>
<pre>
    return response()->download($pathToFile);

    return response()->download($pathToFile, $name, $headers);

    return response()->download($pathToFile)->deleteFileAfterSend();
</pre>
</code>
<p class="theme__text">
    Класс Symfony HttpFoundation, который управляет скачиванием файлов, требует, чтобы загружаемый файл имел ASCII-имя.
</p>
<h4 class="theme_subtitlex2">
    Streamed Downloads
</h4>
<p class="theme__text">
    Иногда вы можете захотеть превратить строковый ответ данной операции в загружаемый ответ без необходимости записывать содержимое операции на диск. В этом сценарии вы можете использовать метод streamDownload. Этот метод принимает в качестве аргументов обратный вызов, имя файла и необязательный массив заголовков:
</p>
<code>
<pre>
    return response()->streamDownload(function () {
        echo GitHub::api('repo')
                    ->contents()
                    ->readme('laravel', 'laravel')['contents'];
    }, 'laravel-readme.md');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Отклик отображения файла
</h4>
<p class="theme__text">
    Метод file служит для вывода файла (такого как изображение или PDF) прямо в браузере пользователя, вместо запуска его скачивания. Этот метод принимает первым аргументом путь к файлу, а вторым аргументом — массив заголовков:
</p>
<code>
<pre>
    return response()->file($pathToFile);

    return response()->file($pathToFile, $headers);
</pre>
</code>
<h4 class="theme__subtitle">
    Макрос отклика
</h4>
<p class="theme__text">
    Если вы хотите определить собственный отклик, который вы смогли бы использовать повторно в различных роутах и контроллерах, то можете использовать метод macro на фасаде Response. Например, из метода boot сервис-провайдера:
</p>
<code>
<pre>
namespace App\Providers;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
class ResponseMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Response::macro('caps', function ($value) {
            return Response::make(strtoupper($value));
        });
    }
}
</pre>
</code>
<p class="theme__text">
    Функция macro() принимает имя в качестве первого аргумента и замыкание в качестве второго. Замыкание макроса будет выполнено при вызове имени макроса из реализации ResponseFactory или из хелпера response:
</p>
<code>
<pre>
return response()->caps('foo');
</pre>
</code>
</div>














{{-- ===================== --}}
{{-- Theme: Шаблоны --}}
{{-- ===================== --}}
<div class="theme">
<h2 class="theme__title">
    Шаблоны
</h2>
<h3 class="theme__subtitle">
    Создание шаблонов
</h3>
<p class="theme__text">
    Шаблоны содержат HTML-разметку вашего приложения и отделяют контроллеры/бизнес-логику от логики отображения данных. <br> Шаблоны расположены в директории resources/views.<br><br>
    Мы можем вернуть шаблон, используя помощник глобального view
</p>
<code>
<pre>
Route::get('/', function () {
    return view('greeting', ['name' => 'James']);
});
</pre>
</code>
<p class="theme__text">
    Как видите, первый аргумент, переданный помощнику представления, соответствует имени файла представления в каталоге resources/views.<br>
    Второй аргумент - это массив данных, которые должны быть доступны для представления. В этом случае мы передаем переменную имени, которая отображается в представлении.<br>
    Представления также могут быть вложены в подкаталоги каталога resources/views. Обозначение «точка» может использоваться для ссылки на вложенные представления. Например, если ваше представление хранится в resources / views / admin / profile.blade.php, вы можете ссылаться на него следующим образом:
</p>
<code>
<pre>
return view('admin.profile', $data);
</pre>
</code>
<p class="theme__text">
    Имена каталогов просмотра не должны содержать «.» знак.
</p>
<h3 class="theme__subtitle">
    Проверка существования шаблона
</h3>
<p class="theme__text">
    Если вам нужно определить, существует ли представление, вы можете использовать фасад View. exists метод вернет истину, если представление существует:
</p>
<code>
<pre>
use Illuminate\Support\Facades\View;
if (View::exists('emails.customer')) {
    //
}
</pre>
</code>

<h3 class="theme__subtitle">
    Создание первого доступного шаблона
</h3>
<p class="theme__text">
Используя first метод, вы можете создать первое представление, которое существует в данном массиве представлений. Это полезно, если ваше приложение или пакет позволяет настраивать или перезаписывать представления:
</p>
<code>
<pre>
return view()->first(['custom.admin', 'admin'], $data);
</pre>
</code>
<p class="theme__text">
    Вы также можете вызвать этот метод через фасад View:
</p>
<code>
<pre>
use Illuminate\Support\Facades\View;
return View::first(['custom.admin', 'admin'], $data);
</pre>
</code>
<h3 class="theme__subtitle">
    Передача данных в шаблоны
</h3>
<p class="theme__text">
    вы можете передать в представления массив данных:
</p>
<code>
<pre>
return view('greetings', ['name' => 'Victoria']);
</pre>
</code>
<p class="theme__text">
    При передаче информации таким образом данные должны быть массивом с парами ключ / значение. Затем внутри вашего представления вы можете получить доступ к каждому значению, используя соответствующий ему ключ, например < ? Php echo $ key; ?>.
    В качестве альтернативы передаче полного массива данных вспомогательной функции view вы можете использовать метод with для добавления отдельных фрагментов данных в представление:
</p>
<code>
<pre>
return view('greeting')->with('name', 'Victoria');
</pre>
</code>
<p class="theme__text">
    Также можно использовать функцию из PHP: compact()
</p>
<code>
<pre>
$name = 'Victoria';
return view('greetings', compact(name));
</pre>
</code>
<h4 class="theme_subtitlex2">
    Передача данных во все шаблоны
</h4>
<p class="theme__text">
    Иногда необходимо передавать часть данных во все шаблоны, которые используются в вашем приложении. Это можно сделать с помощью метода share внутри метода boot сервис-провайдера. Его можно добавить в провайдер AppServiceProvider или создать отдельный провайдер для этого:
</p>
<code>
<pre>
namespace App\Providers;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::share('key', 'value');
    }
}
</pre>
</code>
<h4 class="theme_subtitlex2">
    Вью-композеры
</h4>
<p class="theme__text">
    Вью-композеры — это функции обратного вызова или методы класса, которые вызываются при отображении шаблона. Если у вас есть данные, которые вы хотели бы отправлять в шаблон при каждом его отображении, то композеры могут помочь организовать такую логику в одном месте.
    Давайте для примера зарегистрируем композер внутри сервис провайдера. Мы будем использовать фасад View для доступа к основному контракту Illuminate\Contracts\View\Factory. По умолчанию в Laravel нет папки для хранения вью-композеров. Вы можете создать её там, где посчитаете нужным. Например, можно создать папку app\Http\ViewComposers:
</p>
<code>
<pre>
    namespace App\Providers;

    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;

    class ViewServiceProvider extends ServiceProvider
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
            // Using class based composers...
            View::composer(
                'profile', 'App\Http\View\Composers\ProfileComposer'
            );

            // Using Closure based composers...
            View::composer('dashboard', function ($view) {
                //
            });
        }
    }
</pre>
</code>
<p class="theme__text">
    Помните, если вы создаёте новый сервис-провайдер для хранения ваших композеров, то также следует добавить его в массив providers внутри конфига config/app.php.

    Теперь, когда мы зарегистрировали композитор, метод ProfileComposer @ compose будет выполняться каждый раз при визуализации представления profile. Итак, давайте определим класс композитора:
</p>
<code>
<pre>
    namespace App\Http\View\Composers;

    use App\Repositories\UserRepository;
    use Illuminate\View\View;

    class ProfileComposer
    {
        /**
         * The user repository implementation.
         *
         * @var UserRepository
         */
        protected $users;

        /**
         * Create a new profile composer.
         *
         * @param  UserRepository  $users
         * @return void
         */
        public function __construct(UserRepository $users)
        {
            // Dependencies automatically resolved by service container...
            $this->users = $users;
        }

        /**
         * Bind data to the view.
         *
         * @param  View  $view
         * @return void
         */
        public function compose(View $view)
        {
            $view->with('count', $this->users->count());
        }
    }
</pre>
</code>
<p class="theme__text">
    Непосредственно перед визуализацией представления вызывается метод compose композитора с экземпляром Illuminate \ View \ View. Вы можете использовать метод with для привязки данных к представлению.
    Все композеры подключаются через сервис контейнер, поэтому можно применить любое внедрение зависимостей внутри конструктора композера.
</p>
<h4 class="theme_subtitlex2">
    Подключение композера к нескольким шаблонам
</h4>
<p class="theme__text">
    Вы можете подключить к композеру несколько шаблонов одновременно, передав их в качестве первого аргумента метода composer:
</p>
<code>
<pre>
    View::composer(
        ['profile', 'dashboard'],
        'App\Http\View\Composers\MyViewComposer'
    );
</pre>
</code>
<p class="theme__text">
    Метод composer также принимает специальный символ *, что позволяет подключить его ко всем шаблонам:
</p>
<code>
<pre>
    View::composer('*', function ($view) {
        //
    });

</pre>
</code>
<p>
    public function boot()
    {
        // чтобы передать данные в тот или иной шаблон
        view()->composer('components.menu', function ($view) {
            $view->with('technologies', Technology::all());
        });

    }
</p>
<h3 class="theme__subtitle">
    Создатели шаблонов
</h3>
<p class="theme__text">
    Создатели шаблонов очень похожи на композеры, однако они выполняются сразу после инициализации шаблонов, не дожидаясь их отображения. Для регистрации создателя используется метод creator:
</p>
<code>
<pre>
    View::creator('profile', 'App\Http\View\Creators\ProfileCreator');
</pre>
</code>
<h3 class="theme__subtitle">
    Оптимизация шаблонов
</h3>
<p class="theme__text">
    По умолчанию представления компилируются по запросу. Когда выполняется запрос, который отображает представление, Laravel определяет, существует ли скомпилированная версия представления. Если файл существует, Laravel затем определит, было ли некомпилированное представление изменено позже, чем скомпилированное представление. Если скомпилированное представление либо не существует, либо некомпилированное представление было изменено, Laravel перекомпилирует представление.

    Компиляция представлений во время запроса отрицательно влияет на производительность, поэтому Laravel предоставляет Artisan-команду view: cache для предварительной компиляции всех представлений, используемых вашим приложением. Для повышения производительности вы можете выполнить эту команду как часть процесса развертывания:
</p>
<code>
<pre>
    php artisan view:cache
</pre>
</code>
<p class="theme__text">
    Вы можете использовать команду view: clear для очистки кеша просмотра:
</p>
<code>
<pre>
    php artisan view:clear
</pre>
</code>
</div>
<div class="theme">













{{-- ===================== --}}
{{-- Theme: Генерация ссылок --}}
{{-- ===================== --}}
<h2 class="theme__title">
    Генерация ссылок
</h2>
<p class="theme__text">
    Laravel предоставляет несколько помощников, которые помогут вам в создании URL-адресов для вашего приложения. В основном они полезны при построении ссылок в ваших шаблонах и ответах API или при создании ответов перенаправления в другую часть вашего приложения.
</p>
<h3 class="theme__subtitle">
    Основы
</h3>
<h4 class="theme_subtitlex2">
    Создание базовых  URL-адресов
</h4>
<p class="theme__text">
    Помощник url может использоваться для генерации произвольных URL-адресов для вашего приложения. Сгенерированный URL-адрес будет автоматически использовать схему (HTTP или HTTPS) и хост из текущего запроса:
</p>
<code>
<pre>
$post = App\Models\Post::find(1);
echo url("/posts/{$post->id}");
// http://example.com/posts/1
</pre>
</code>
<h4 class="theme_subtitlex2">
    Доступ к текущему URL
</h4>
<p class="theme__text">
    Если путь к url помошнику не указан, возвращается экземпляр Illuminate \ Routing \ UrlGenerator, позволяющий получить доступ к информации о текущем URL-адресе:
</p>
<code>
<pre>
// Get the current URL without the query string...
echo url()->current();

// Get the current URL including the query string...
echo url()->full();

// Get the full URL for the previous request...
echo url()->previous();
Each of these methods may also be accessed via the URL facade:
use Illuminate\Support\Facades\URL;

echo URL::current();
</pre>
</code>
<h4 class="theme_subtitlex2">
    URL для именованных маргрутов
</h4>
<p class="theme__text">
    Помощник route может использоваться для генерации URL-адресов именованных маршрутов. Именованные маршруты позволяют создавать URL-адреса без привязки к фактическому URL-адресу, определенному в маршруте. Следовательно, если URL-адрес маршрута изменяется, никаких изменений в вызовах функций маршрута вносить не требуется. Например, представьте, что ваше приложение содержит маршрут, определенный следующим образом:
</p>
<code>
<pre>
Route::get('/post/{post}', function () {
    //
})->name('post.show');
</pre>
</code>
<p class="theme__text">
    Чтобы сгенерировать URL-адрес этого маршрута, вы можете использовать route помощник:
</p>
<code>
<pre>
echo route('post.show', ['post' => 1]);
// http://example.com/post/1
</pre>
</code>
<p class="theme__text">
    Любые дополнительные параметры массива, не соответствующие параметрам определения маршрута, будут добавлены в строку запроса URL:
</p>
<code>
<pre>
echo route('post.show', ['post' => 1, 'search' => 'rocket']);
// http://example.com/post/1?search=rocket
</pre>
</code>
<p class="theme__text">
    Вы часто будете генерировать URL-адреса, используя первичный ключ моделей Eloquent. По этой причине вы можете передавать модели Eloquent в качестве значений параметров. Помощник route автоматически извлечет первичный ключ модели:
</p>
<code>
<pre>
echo route('post.show', ['post' => $post]);
</pre>
</code>
<p class="theme__text">
    Помощник route также может использоваться для генерации URL-адресов для маршрутов с несколькими параметрами:
</p>
<code>
<pre>
Route::get('/post/{post}/comment/{comment}', function () {
    //
})->name('comment.show');
echo route('comment.show', ['post' => 1, 'comment' => 3]);
// http://example.com/post/1/comment/3
</pre>
</code>
<h3 class="theme__subtitle">
    Подписанные URL
</h3>
<p class="theme__text">
    Laravel позволяет вам легко создавать «подписанные» URL-адреса для именованных маршрутов. Эти URL-адреса имеют хэш «подписи», добавленный к строке запроса, который позволяет Laravel проверять, что URL-адрес не был изменен с момента его создания. Подписанные URL-адреса особенно полезны для маршрутов, которые являются общедоступными, но нуждаются в защите от манипуляций с URL-адресами.

    Например, вы можете использовать подписанные URL-адреса для реализации общедоступной ссылки «отказаться от подписки», которая отправляется вашим клиентам по электронной почте. Чтобы создать подписанный URL-адрес для именованного маршрута, используйте метод signedRoute фасада URL-адреса:
</p>
<code>
<pre>
use Illuminate\Support\Facades\URL;
return URL::signedRoute('unsubscribe', ['user' => 1]);
</pre>
</code>
<p class="theme__text">
    Если вы хотите сгенерировать временный подписанный URL-адрес маршрута, срок действия которого истекает, вы можете использовать метод temporarySignedRoute:
</p>
<code>
<pre>
use Illuminate\Support\Facades\URL;
return URL::temporarySignedRoute(
    'unsubscribe', now()->addMinutes(30), ['user' => 1]
);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Проверка подписанных запросов маршрута
</h4>
<p class="theme__text">
    Чтобы убедиться, что входящий запрос имеет действительную подпись, вы должны вызвать метод hasValidSignature для входящего запроса:
</p>
<code>
<pre>
use Illuminate\Http\Request;
Route::get('/unsubscribe/{user}', function (Request $request) {
    if (! $request->hasValidSignature()) {
        abort(401);
    }

    // ...
})->name('unsubscribe');
</pre>
</code>
<p class="theme__text">
    В качестве альтернативы вы можете назначить для маршрута посредник Illuminate \ Routing \ Middleware \ ValidateSignature. Если его еще нет, вы должны назначить этому промежуточному программному обеспечению ключ в массиве routeMiddleware вашего ядра HTTP:
</p>
<code>
<pre>
protected $routeMiddleware = [
    'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
];
</pre>
</code>
<p class="theme__text">
    После того, как вы зарегистрировали посредник в своем ядре, вы можете присоединить его к маршруту. Если входящий запрос не имеет действительной подписи, посредник автоматически вернет ответ об ошибке 403:
</p>
<code>
<pre>
Route::post('/unsubscribe/{user}', function (Request $request) {
    // ...
})->name('unsubscribe')->middleware('signed');
</pre>
</code>
<h3 class="theme__subtitle">
    URL-адреса для действий контроллера
</h3>
<p class="theme__text">
    Функция action генерирует URL-адрес для данного действия контроллера:
</p>
<code>
<pre>
use App\Http\Controllers\HomeController;
$url = action([HomeController::class, 'index']);
</pre>
</code>
<p class="theme__text">
    Если метод контроллера принимает параметры маршрута, вы можете передать их в качестве второго аргумента функции:
</p>
<code>
<pre>
$url = action([UserController::class, 'profile'], ['id' => 1]);
</pre>
</code>
<h3 class="theme__subtitle">
    Значения по-умолчанию
</h3>
<p class="theme__text">
    Для некоторых приложений вы можете указать значения по умолчанию для определенных параметров URL-адреса. Например, представьте, что многие из ваших маршрутов определяют параметр {locale}:
</p>
<code>
<pre>
Route::get('/{locale}/posts', function () {
    //
})->name('post.index');
</pre>
</code>
<p class="theme__text">
    Обременительно всегда передавать locale каждый раз при вызове помощника route. Таким образом, вы можете использовать метод URL :: defaults, чтобы определить значение по умолчанию для этого параметра, которое всегда будет применяться во время текущего запроса. Вы можете вызвать этот метод из посредник маршрута, чтобы иметь доступ к текущему запросу:
</p>
<code>
<pre>
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\URL;
class SetDefaultLocaleForUrls
{
    public function handle($request, Closure $next)
    {
        URL::defaults(['locale' => $request->user()->locale]);

        return $next($request);
    }
}
</pre>
</code>
<p class="theme__text">
    После установки значения по умолчанию для параметра locale вам больше не требуется передавать его значение при генерации URL-адресов с помощью помощника route.
</p>
<h4 class="theme_subtitlex2">
    Параметры URL по умолчанию и приоритет посредников
</h4>
<p class="theme__text">
    Установка значений URL по умолчанию может мешать Laravel обрабатывать неявные привязки модели. Следовательно, вы должны отдавать приоритет своему промежуточному программному обеспечению, которое устанавливает значения URL по умолчанию для выполнения, перед собственным промежуточным программным обеспечением Laravel SubstituteBindings. Вы можете добиться этого, убедившись, что ваше посредник находится перед промежуточным ПО SubstituteBindings в свойстве $ middlewarePriority HTTP-ядра вашего приложения.

    Свойство $ middlewarePriority определено в базовом классе Illuminate \ Foundation \ Http \ Kernel. Вы можете скопировать его определение из этого класса и перезаписать его в ядре HTTP вашего приложения, чтобы изменить его:
</p>
<code>
<pre>
protected $middlewarePriority = [
    // ...
    \App\Http\Middleware\SetDefaultLocaleForUrls::class,
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
    // ...
];
</pre>
</code>

</div>












{{-- ===================== --}}
{{-- Theme: HTTP сессии --}}
{{-- ===================== --}}
<div class="theme">
    <h2 class="theme__title">
        HTTP сессии
    </h2>
    <p class="theme__text">
        HTTP-приложения не имеют своего внутреннего состояния. Сессии — способ сохранения информации о пользователе между отдельными запросами. Laravel поставляется со множеством различных механизмов сессий, доступных через единый выразительный API. Из коробки поддерживаются такие популярные системы, как Memcached, Redis и СУБД.
    </p>
<h3 class="theme__subtitle">
    Настройка
</h3>
<p class="theme__text">
    Настройки сессии содержатся в файле config/session.php. Обязательно просмотрите параметры, доступные вам в этом файле. По умолчанию Laravel использует драйвер сессий file , который подходит для большинства приложений. Для увеличения производительности сессий в продакшне вы можете использовать драйверы memcached или redis.
    <br><br>
    Настройки драйвера driver сессии определяют где будут храниться данные сессии для каждого запроса. Laravel поставляется с целым набором замечательных драйверов:<br>
    - file - сессии хранятся в storage/framework/sessions.<br>
    - cookie - сессии хранятся в виде зашифрованных cookie.<br>
    - database - хранение сессий в реляционной БД.<br>
    - memcached / redis - для хранения используются эти быстрые кэширующие хранилища. <br>
    - array - сессии хранятся в виде PHP-массивов и не будут сохраняться между запросами.
    <br><br>
    Драйвер массива используется во время тестирования и предотвращает сохранение данных, хранящихся в сеансе.
</p>
<h3 class="theme__subtitle">
    Требования к драйверам
</h3>
<h4 class="theme_subtitlex2">
    Database
</h4>
<p class="theme__text">
    При использовании драйвера сессий database вам необходимо создать таблицу для хранения данных сессии. Ниже — пример такого объявления с помощью Schema:
</p>
<code>
<pre>
Schema::create('sessions', function ($table) {
    $table->string('id')->unique();
    $table->foreignId('user_id')->nullable();
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->text('payload');
    $table->integer('last_activity');
});
</pre>
</code>
<p class="theme__text">
    Вы можете использовать Artisan-команду session: table для генерации этой миграции:
</p>
<code>
<pre>
php artisan session:table
php artisan migrate
</pre>
</code>
<h4 class="theme_subtitlex2">
    Redis
</h4>
<p class="theme__text">
    Перед использованием сеансов Redis с Laravel вам нужно будет либо установить расширение PHP PhpRedis через PECL, либо установить пакет predis / predis (~ 1.0) через Composer.
    А в конфиге session в параметре connection можно указать конкретное подключение Redis для сессии.
</p>
<h3 class="theme__subtitle">
    Использование сессий
</h3>
<h4 class="theme_subtitlex2">
    Получение данных
</h4>
<p class="theme__text">
    В Laravel есть два основных способа работы с данными сессии: с помощью глобального хелпера session и через экземпляр Request. Сначала давайте обратимся сессии через экземпляр Request, который может быть указан в качестве зависимости в методе контроллера. Учтите, зависимости метода контроллера автоматически внедряются при помощи сервис-контейнера Laravel:
</p>
<code>
<pre>
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function show(Request $request, $id)
    {
        $value = $request->session()->get('key');

        //
    }
}
</pre>
</code>
<p class="theme__text">
    При получении значения из сессии, вы можете передать значение по умолчанию вторым аргументом метода get. Это значение будет возвращено, если указанного ключа нет в сессии. Если вы передадите в метод функцию Closure в качестве значения по умолчанию, и запрашиваемого ключа не существует, то будет выполняться это замыкание и возвращаться его результат:
</p>
<code>
<pre>
$value = $request->session()->get('key', 'default');
$value = $request->session()->get('key', function () {
    return 'default';
});
</pre>
</code>
<h4 class="theme_subtitlex2">
    Глобальный хелпер Session
</h4>
<p class="theme__text">
    Вы также можете использовать глобальную  функцию PHP session для извлечения и хранения данных в сеансе. Когда помощник session вызывается с одним строковым аргументом, он возвращает значение этого сеансового ключа. Когда помощник вызывается с массивом пар ключ / значение, эти значения будут сохранены в сеансе:
</p>
<code>
<pre>
Route::get('home', function () {
    // Retrieve a piece of data from the session...
    $value = session('key');

    // Specifying a default value...
    $value = session('key', 'default');

    // Store a piece of data in the session...
    session(['key' => 'value']);
});
</pre>
</code>
<p class="theme__text">
    Есть небольшое практическое отличие между использованием сессий через экземпляр HTTP-запроса и использованием глобального хелпера session. Оба способа тестируются методом assertSessionHas, доступным во всех ваших тест-кейсах.
</p>
<h4 class="theme_subtitlex2">
    Получение всех данных сессии
</h4>
<p class="theme__text">
    Если вы хотите получить все данные в сеансе, вы можете использовать метод all:
</p>
<code>
<pre>
$data = $request->session()->all();
</pre>
</code>
<h4 class="theme_subtitlex2">
    Определение наличия элемента в сессии
</h4>
<p class="theme__text">
    Для проверки существования значения в сессии можно использовать метод has. Этот метод вернёт true, если значение существует и не равно null:
</p>
<code>
<pre>
if ($request->session()->has('users')) {
    //
}
</pre>
</code>
<p class="theme__text">
    Для проверки существования значения в сессии, даже если оно равно null, можно использовать метод exists. Этот метод вернёт true, если значение существует:
</p>
<code>
<pre>
if ($request->session()->exists('users')) {
    //
}
</pre>
</code>
<h3 class="theme__subtitle">
    Хранение данных
</h3>
<p class="theme__text">
    Чтобы сохранить данные в сеансе, вы обычно будете использовать метод put или помощник session:
</p>
<code>
<pre>
// Via a request instance...
$request->session()->put('key', 'value');

// Via the global helper...
session(['key' => 'value']);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Запись данных в массивы сессии
</h4>
<p class="theme__text">
    Метод push служит для записи нового значения в элемент сессии, который является массивом. Например, если ключ user.teams содержит массив с именами команд, вы можете записать новое значение в массив вот так:
</p>
<code>
<pre>
$request->session()->push('user.teams', 'developers');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Чтение и удаление элемента
</h4>
<p class="theme__text">
    Метод pull прочитает и удалит элемент из сессии за одно действие:
</p>
<code>
<pre>
$value = $request->session()->pull('key', 'default');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Флеш-данные
</h4>
<p class="theme__text">
    Иногда вам нужно сохранить переменную в сессии только для следующего запроса. Вы можете сделать это методом flash. Сохранённые этим методом данные будут доступны только во время следующего HTTP-запроса, а затем будут удалены. В основном такие данные полезны для кратковременных сообщений о состоянии:
</p>
<code>
<pre>
$request->session()->flash('status', 'Task was successful!');
</pre>
</code>
<p class="theme__text">
    Для сохранения одноразовых данных в течение большего числа запросов используйте метод reflash, который оставит все эти данные для следующего запроса. А если вам надо хранить только определённые данные, то используйте метод keep:
</p>
<code>
<pre>
$request->session()->reflash();
$request->session()->keep(['username', 'email']);
</pre>
</code>
<h3 class="theme__subtitle">
    Удаление данных
</h3>
<p class="theme__text">
    Метод forget удалит куски данных из сессии. Для удаления из сессии всех данных используйте метод flush:
</p>
<code>
<pre>
// Forget a single key...
$request->session()->forget('key');

// Forget multiple keys...
$request->session()->forget(['key1', 'key2']);

$request->session()->flush();
</pre>
</code>
<h3 class="theme__subtitle">
    Обновление ID сессии
</h3>
<p class="theme__text">
    Обновление ID сессии часто используется для защиты приложения от злоумышленников, применяющих атаку фиксации сессии на ваше приложение. (https://owasp.org/www-community/attacks/Session_fixation)
    Laravel автоматически обновляет ID сессии во время аутентификации, если вы используете Laravel Jetstream; но если вы хотите обновлять ID сессии вручную, используйте метод regenerate.
</p>
<code>
<pre>
$request->session()->regenerate();
</pre>
</code>
<h4 class="theme_subtitlex2">
    Блокировка сеанса
</h4>
<p class="theme__text">
    Чтобы использовать блокировку сеанса, ваше приложение должно использовать драйвер кеша, поддерживающий атомарные блокировки. В настоящее время эти драйверы кеширования включают в себя драйверы memcached, Dynamodb, redis и database драйвера. Кроме того, вы не можете использовать драйвер сеанса cookie.

    По умолчанию Laravel позволяет запросам, использующим один и тот же сеанс, выполняться одновременно. Так, например, если вы используете HTTP-библиотеку JavaScript для выполнения двух HTTP-запросов к вашему приложению, они оба будут выполняться одновременно. Для многих приложений это не проблема; однако потеря данных сеанса может произойти в небольшом подмножестве приложений, которые выполняют одновременные запросы к двум разным конечным точкам приложений, которые записывают данные в сеанс.
    Чтобы смягчить это, Laravel предоставляет функциональность, которая позволяет ограничивать количество одновременных запросов для данного сеанса. Для начала вы можете просто привязать метод block к определению маршрута. В этом примере входящий запрос к конечной точке / profile получит блокировку сеанса. Пока эта блокировка удерживается, любые входящие запросы к конечным точкам / profile или / order с одним и тем же идентификатором сеанса будут ждать завершения выполнения первого запроса, прежде чем продолжить свое выполнение:
</p>
<code>
<pre>
Route::post('/profile', function () {
    //
})->block($lockSeconds = 10, $waitSeconds = 10)

Route::post('/order', function () {
    //
})->block($lockSeconds = 10, $waitSeconds = 10)
</pre>
</code>
<p class="theme__text">
    Метод block принимает два необязательных аргумента. Первый аргумент, принимаемый блочным методом, - это максимальное количество секунд, в течение которых блокировка сеанса должна удерживаться, прежде чем она будет снята. Конечно, если выполнение запроса завершится до этого времени, блокировка будет снята раньше.

    Второй аргумент, принимаемый block методом, - это количество секунд, в течение которых запрос должен ждать при попытке получить блокировку сеанса. Будет выброшено исключение Illuminate \ Contracts \ Cache \ LockTimeoutException, если запрос не сможет получить блокировку сеанса в течение заданного количества секунд.
    Если ни один из этих аргументов не передан, блокировка будет получена максимум на 10 секунд, а запросы будут ждать максимум 10 секунд при попытке получить блокировку:
</p>
<code>
<pre>
Route::post('/profile', function () {
    //
})->block()
</pre>
</code>
<h3 class="theme__subtitle">
    Добавление своих драйверов сессий
</h3>
<h4 class="theme_subtitlex2">
    Реализация драйвера
</h4>
<p class="theme__text">
    Ваш драйвер сессий должен реализовывать SessionHandlerInterface. Этот интерфейс содержит всего несколько простых методов, которые надо реализовать. Заглушка реализации MongoDB выглядит приблизительно так:
</p>
<code>
<pre>
namespace App\Extensions;
class MongoSessionHandler implements \SessionHandlerInterface
{
    public function open($savePath, $sessionName) {}
    public function close() {}
    public function read($sessionId) {}
    public function write($sessionId, $data) {}
    public function destroy($sessionId) {}
    public function gc($lifetime) {}
}
</pre>
</code>
<p class="theme__text">
    В Laravel нет стандартной директории для ваших расширений. Вы можете разместить их где угодно. В этом примере мы создали директорию Extensions для хранения в нём MongoHandler. <br><br>
    Поскольку задачи этих методов не так очевидны, давайте коротко рассмотрим каждый из них:<br>
    - Метод open обычно используется в системе хранения файл-сессий. Поскольку Laravel поставляется с драйвером сессий file, вам почти никогда не потребуется делать что-либо в этом методе. Вы можете оставить его пустым как заглушку. То, что PHP требует реализовать данный метод, — это пример плохого проектирования интерфейса (обсудим это позже). <br>
    - Методом close зачастую можно пренебречь, как и методом open. Для большинства драйверов он не нужен.<br>
    - Метод read должен вернуть данные сессии по $sessionId в виде строки. Не нужно выполнять сериализацию или другое преобразование при получении или сохранении данных сессии в ваш драйвер, поскольку Laravel выполнит сериализацию за вас.<br>
    - Метод write должен записать указанную строку $data в соответствии с $sessionId в какое-либо постоянное хранилище, такое как MongoDB, Dynamo и т.п. И снова, не нужно выполнять сериализацию — Laravel выполнит её за вас.<br>
    - Метод destroy должен удалить из постоянного хранилища данные, соответствующие $sessionId.<br>
    - Метод gc должен удалить все данные сессий, которые старше заданного $lifetime, который в свою очередь является отметкой времени UNIX. Для самоочищающихся систем, таких как Memcached и Redis, этот метод можно оставить пустым.
</p>
<h3 class="theme__subtitle">
    Регистрация драйвера
</h3>
<p class="theme__text">
    После реализации драйвера его можно зарегистрировать в фреймворке. Для добавления дополнительных драйверов для работы с сессиями в Laravel используйте метод extend фасада Session. Вам надо вызвать метод extend из метода boot сервис-провайдера. Это можно сделать в имеющемся AppServiceProvider или создать абсолютно новый провайдер:
</p>
<code>
<pre>
namespace App\Providers;
use App\Extensions\MongoSessionHandler;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
class SessionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Session::extend('mongo', function ($app) {
            // Return implementation of SessionHandlerInterface...
            return new MongoSessionHandler;
        });
    }
}
</pre>
</code>
<p class="theme__text">
    Когда драйвер сессий зарегистрирован, вы можете использовать драйвер mongo в своём конфиге config/session.php.
</p>

</div>














{{-- ===================== --}}
{{-- Theme: Валидация --}}
{{-- ===================== --}}
<div class="theme">
<h2 class="theme__title">
    Валидация
</h2>
<p class="theme__text">
    Laravel предоставляет несколько способов для валидации входящих данных. По умолчанию базовый контроллер использует трейт ValidatesRequests, который обеспечивает удобный способ валидации HTTP запросов c большим количеством правил валидации.
</p>
<h3 class="theme__subtitle">
    Быстрый старт
</h3>
<p class="theme__text">
    Чтобы узнать о мощных функциях проверки Laravel, давайте рассмотрим полный пример проверки формы и отображения сообщений об ошибках обратно пользователю.
</p>
<code>
<pre>
// routes/web.php file:
use App\Http\Controllers\PostController;
Route::get('post/create', [PostController::class, 'create']);
Route::post('post', [PostController::class, 'store']);
</pre>
</code>
<code>
<pre>
// controller file:
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }
    public function store(Request $request)
    {
        // Validate and store the blog post...
    }
}
</pre>
</code>
<h3 class="theme__subtitle">
    Написание логики валидации
</h3>
<p class="theme__text">
    Теперь мы готовы заполнить наш метод store логикой для проверки нового сообщения в блоге. Для этого мы будем использовать метод validate, предоставляемый объектом Illuminate \ Http \ Request. Если правила проверки пройдут, ваш код продолжит нормально выполняться; однако, если проверка завершится неудачно, будет сгенерировано исключение, и правильный ответ об ошибке будет автоматически отправлен обратно пользователю. В случае традиционного HTTP-запроса будет сгенерирован ответ перенаправления, а для запросов AJAX будет отправлен ответ JSON.

    Чтобы лучше понять метод validate, вернемся к методу store:
</p>
<code>
<pre>
public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ]);

    // The blog post is valid...
}
</pre>
</code>
<p class="theme__text">
    Как видите, мы передаем желаемые правила проверки в метод validate. Опять же, если проверка не удалась, правильный ответ будет автоматически сгенерирован. Если проверка пройдет успешно, наш контроллер продолжит нормальную работу.

    В качестве альтернативы правила проверки могут быть указаны в виде массивов правил вместо одного | строка с разделителями:
</p>
<code>
<pre>
$validatedData = $request->validate([
    'title' => ['required', 'unique:posts', 'max:255'],
    'body' => ['required'],
]);
</pre>
</code>
<p class="theme__text">
    Вы можете использовать метод validateWithBag для проверки запроса и сохранения любых сообщений об ошибках в именованном пакете ошибок:
</p>
<code>
<pre>
$validatedData = $request->validateWithBag('post', [
    'title' => ['required', 'unique:posts', 'max:255'],
    'body' => ['required'],
]);
</pre>
</code>
<p class="theme__text">
    https://laravel.su/docs/5.4/validation — тут немного по другому, на практике нужно проверить. Он там использует методы через $this а не через класс requist
</p>
<h3 class="theme__subtitle">
    Остановка после первой неудачной проверки
</h3>
<p class="theme__text">
    Иногда нужно остановить выполнение остальных правил после первой неудачной проверки. Для этого используется атрибут bail:
</p>
<code>
<pre>
    $request->validate([
        'title' => 'bail|required|unique:posts|max:255',
        'body' => 'required',
    ]);
</pre>
</code>
<p class="theme__text">
    В этом примере, если уникальное правило атрибута title не работает, правило max не будет проверяться. Правила будут проверяться в порядке их назначения.
</p>
<h3 class="theme__subtitle">
    Заметка о вложенных атрибутах
</h3>
<p class="theme__text">
    Если ваш HTTP-запрос содержит «вложенные» параметры, вы можете указать их в своих правилах проверки, используя синтаксис «точка»:
</p>
<code>
<pre>
    $request->validate([
        'title' => 'required|unique:posts|max:255',
        'author.name' => 'required',
        'author.description' => 'required',
    ]);
</pre>
</code>
<p class="theme__text">
    С другой стороны, если ваше имя поля содержит буквальную точку, вы можете явно запретить ее интерпретацию как синтаксис «точка», экранировав точку с помощью обратной косой черты:
</p>
<code>
<pre>
    $request->validate([
        'title' => 'required|unique:posts|max:255',
        'v1\.0' => 'required',
    ]);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Отображение ошибок валидации
</h4>
<p class="theme__text">
    Что, если входящие данные не проходят проверку с учетом правил? Как упоминалось ранее, Laravel автоматически перенаправляет пользователя на предыдущую страницу. Кроме того, все ошибки валидации будут автоматически записаны во flash-переменные.
    Опять же, обратите внимание, что мы не должны явно передавать сообщения об ошибках в шаблоне роута GET. Это потому, что Laravel будет проверять наличие ошибок в текущем сеансе и автоматически привязывать их к шаблону, если они доступны. Переменная $errors является экземпляром Illuminate\Support\MessageBag. Для получения дополнительных сведений о работе с этим объектом, смотрите в документации.
    Переменная $errorsпривязана к посреднику Illuminate\View\Middleware\ShareErrorsFromSession, который входит в группу посредников web . При использовании этого посредника, $errors всегда будет доступна в ваших шаблонах, что позволяет удобно и безопасно ее использовать.
    В нашем примере пользователь будет перенаправлен в метод create вашего контроллера и можно отобразить сообщения об ошибках в шаблоне:
</p>
<code>
<pre>
<!-- /resources/views/post/create.blade.php -->

< h 1>Create Post</>

@ if ($errors->any())
    < div class="alert alert-danger">
        < ul>
            @ foreach ($errors->all() as $error)
                < li> { { $error }}</>
            @ endforeach
        </>
    </>
@ endif

<!-- Create Post Form -->
</pre>
</code>
<h4 class="theme_subtitlex2">
    The @ error Directive
</h4>
<p class="theme__text">
    Вы также можете использовать директиву @ error Blade, чтобы быстро проверить, существуют ли сообщения об ошибках проверки для данного атрибута. В директиве @ error вы можете повторить переменную $ message, чтобы отобразить сообщение об ошибке:
</p>
<code>
<pre>
<!-- /resources/views/post/create.blade.php -->

< label for="title">Post Title</>

< input id="title" type="text" class="@ error('title') is-invalid @ enderror">

@ error('title')
    < div class="alert alert-danger">{ { $message }}</>
@ enderror
</pre>
</code>
<h3 class="theme__subtitle">
    Заметка о дополнительных полях
</h3>
<p class="theme__text">
    По умолчанию в Laravel включены глобальные посредники TrimStrings и ConvertEmptyStringsToNull. Они перечислены в свойстве $middleware класса App\Http\Kernel. Из-за этого нужно часто помечать дополнительные поля как nullable, если не нужно, чтобы валидатор считал не действительным значение null. Например:
</p>
<code>
<pre>
    $request->validate([
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
        'publish_at' => 'nullable|date',
    ]);
</pre>
</code>
<p class="theme__text">
    В этом примере мы указываем что поле publish_at может быть null или должно содержать дату. Если модификатор nullable не добавляется в правило, проверяющий элемент будет рассматривать null как недопустимую дату.
</p>
<h3 class="theme__subtitle">
    AJAX запросы и валидация
</h3>
<p class="theme__text">
    В последнем примере мы использовали традиционные формы для отправки данных в наше приложение. Однако многие приложения используют AJAX-запросы. При использовании метода validate во время запроса AJAX, Laravel не будет генерировать ответ с перенаправлением. Вместо этого Laravel генерирует ответ с JSON данными, содержащий в себе все ошибки проверки. Этот ответ будет отправлен с кодом состояния HTTP 422.
</p>
<h3 class="theme__subtitle">
    Валидация Form Request
</h3>
<h4 class="theme_subtitlex2">
    Создание Form Request
</h4>
<p class="theme__text">
    Для более сложных сценариев валидаций, будут более удобны Form Requests. Form Requests это специальные классы, которые содержат в себе логику проверки. Для создания класса, используйте artisan-команду make:request:
</p>
<code>
<pre>
    php artisan make:request StoreBlogPost
</pre>
</code>
<p class="theme__text">
    Сгенерированный класс будет помещен в каталог app / Http / Requests. Если этот каталог не существует, он будет создан при запуске команды make: request. Давайте добавим несколько правил проверки в метод rules:
</p>
<code>
<pre>
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function rules()
   {
       return [
           'title' => 'required|unique:posts|max:255',
           'body' => 'required',
       ];
   }
</pre>
</code>
<p class="theme__text">
    Вы можете указать любые зависимости, которые вам нужны, в сигнатуре метода rules. Они будут автоматически разрешены через сервисный контейнер Laravel.

    Так как же здесь работают правила валидации? Все, что нужно сделать — это указать класс Form Request в аргументах метода вашего контроллера. Входящий запрос перед вызовом метода контроллера будет валидироваться автоматически, что позволит загромождать контроллер логикой валидации:
</p>
<code>
<pre>
    /**
    * Store the incoming blog post.
    *
    * @param  StoreBlogPost  $request
    * @return Response
    */
   public function store(StoreBlogPost $request)
   {
       // The incoming request is valid...

       // Retrieve the validated input data...
       $validated = $request->validated();
   }
</pre>
</code>
<p class="theme__text">
    Если проверка не пройдена, то при традиционном запросе ошибки будут записываться в сессию и будут доступны в шаблонах, иначе, если запрос был AJAX, HTTP-ответ с кодом 422 будет возвращен пользователю, включая JSON с ошибками валидации.
</p>
<h4 class="theme_subtitlex2">
    Добавление хуков в Form Request
</h4>
<p class="theme__text">
    Если вы хотите добавить хук "after" в Form Requests, можно использовать метод withValidator. Этот метод получает полностью сформированный валидатор, позволяя вызвать любой из его методов, прежде чем фактически применяются правила:
</p>
<code>
<pre>
    /**
    * Configure the validator instance.
    *
    * @param  \Illuminate\Validation\Validator  $validator
    * @return void
    */
   public function withValidator($validator)
   {
       $validator->after(function ($validator) {
           if ($this->somethingElseIsInvalid()) {
               $validator->errors()->add('field', 'Something is wrong with this field!');
           }
       });
   }
</pre>
</code>
<h4 class="theme_subtitlex2">
    Авторизация Form Request
</h4>
<p class="theme__text">
    Класс Form Request содержит в себе метод authorize. В этом методе можно проверить, имеет ли аутентифицированный пользователь права на выполнение данного запроса. Например, можно проверить, есть ли у пользователя право для добавления комментариев в блог:
</p>
<code>
<pre>
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
       $comment = Comment::find($this->route('comment'));

       return $comment && $this->user()->can('update', $comment);
   }
</pre>
</code>
<p class="theme__text">
    Так как все Form Request расширяют базовый класс Request, мы можем использовать метод user, чтобы получить доступ к текущему пользователю.Так же обратите внимание на вызов метода route. Этот метод предоставляет доступ к параметрам URI, определенным в роуте (в приведенном ниже примере это {comment}):
    Route::post('comment/{comment}');
    Если метод authorize возвращает false, автоматически генерируется ответ с кодом 403 и метод контроллера не выполняется.
    Если же логика авторизации организована в другом месте вашего приложения, просто верните true из метода authorize:
</p>
<code>
<pre>
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
       return true;
   }
</pre>
</code>
<p class="theme__text">
    Вы можете указать любые необходимые зависимости в подписи метода authorize. Они будут автоматически разрешены через сервисный контейнер Laravel.
</p>
<h3 class="theme__subtitle">
    Настройка сообщений об ошибках
</h3>
<p class="theme__text">
    Вы можете кастомизировать сообщения об ошибках, используя в form request метод messages. Этот метод должен возвращать массив атрибутов/правил и их соответствующие сообщения об ошибках:
</p>
<code>
<pre>
    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
   public function messages()
   {
       return [
           'title.required' => 'A title is required',
           'body.required' => 'A message is required',
       ];
   }
</pre>
</code>
<h3 class="theme__subtitle">
    Настройка атрибутов проверки
</h3>
<p class="theme__text">
    Если вы хотите, чтобы часть: attribute вашего сообщения проверки была заменена именем настраиваемого атрибута, вы можете указать настраиваемые имена, переопределив метод attributes. Этот метод должен возвращать массив пар атрибут / имя:
</p>
<code>
<pre>
    /**
    * Get custom attributes for validator errors.
    *
    * @return array
    */
   public function attributes()
   {
       return [
           'email' => 'email address',
       ];
   }
</pre>
</code>
<h3 class="theme__subtitle">
    Подготовка input для проверки
</h3>
<p class="theme__text">
    Если вам нужно очистить какие-либо данные из запроса перед применением правил проверки, вы можете использовать метод prepareForValidation:
</p>
<code>
<pre>
    use Illuminate\Support\Str;

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug),
        ]);
    }

</pre>
</code>
<h3 class="theme__subtitle">
    Создание валидаторов вручную
</h3>
<p class="theme__text">
    Если вы не хотите использовать метод validate в запросе, вы можете создать экземпляр валидатора вручную с помощью фасада Validator, используя метод make. Метод make на фасаде генерирует новый экземпляр валидатора:
</p>
<code>
<pre>
    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class PostController extends Controller
    {
        /**
         * Store a new blog post.
         *
         * @param  Request  $request
         * @return Response
         */
        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:posts|max:255',
                'body' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('post/create')
                            ->withErrors($validator)
                            ->withInput();
            }

            // Store the blog post...
        }
    }
</pre>
</code>
<p class="theme__text">
    Первый аргумент, переданный методу make, - это проверяемые данные. Второй аргумент - это массив правил проверки, которые должны применяться к данным.

    После проверки, если валидация не будет пройдена, вы можете использовать метод withErrors для загрузки ошибок во flash-переменные. При использовании этого метода переменная $errors будет автоматически передаваться в ваши макеты, после перенаправления, что позволяет легко отображать данные пользователю. Метод withErrors принимает экземпляр валидатора и MessageBag или простой массив.
</p>
<h4 class="theme_subtitlex2">
    Автоматическое перенаправление
</h4>
<p class="theme__text">
    Если вы хотите создать экземпляр валидатора вручную, но при этом использовать автоматическое перенаправление, предлагаемое методом validate запроса, вы можете вызвать метод validate на существующем экземпляре валидатора. Если проверка не удалась, пользователь будет автоматически перенаправлен или, в случае запроса AJAX, будет возвращен ответ JSON:
</p>
<code>
<pre>
    Validator::make($request->all(), [
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ])->validate();
</pre>
</code>
<p class="theme__text">
    Вы можете использовать метод validateWithBag для сохранения сообщений об ошибках в именованном пакете ошибок, если проверка не удалась:
</p>
<code>
<pre>
    Validator::make($request->all(), [
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ])->validateWithBag('post');
</pre>
</code>
<h3 class="theme__subtitle">
    MessageBag
</h3>
<p class="theme__text">
    Если у вас есть несколько форм на одной странице, которые необходимо провалидировать, вам понадобится MessageBag — он позволяет получать сообщения об ошибках для определенной формы. Просто передайте имя в качестве второго аргумента withErrors:
</p>
<code>
<pre>
    return redirect('register')
    ->withErrors($validator, 'login');
</pre>
</code>
<p class="theme__text">
    Затем вы можете получить доступ к названному экземпляру MessageBag из переменной $ errors:
</p>
<code>
<pre>
    { { $errors->login->first('email') }}
</pre>
</code>
<h3 class="theme__subtitle">
    Хук после валидации
</h3>
<p class="theme__text">
    Валидатор также позволяет вам использовать функции обратного вызова после завершения всех проверок. Это позволяет легко выполнять дальнейшие проверки и даже добавить больше сообщений об ошибках в коллекции сообщений. Чтобы начать работу, используйте метод after на экземпляре валидатора:
</p>
<code>
<pre>
    $validator = Validator::make(...);

    $validator->after(function ($validator) {
        if ($this->somethingElseIsInvalid()) {
            $validator->errors()->add('field', 'Something is wrong with this field!');
        }
    });

    if ($validator->fails()) {
        //
    }
</pre>
</code>
<h3 class="theme__subtitle">
    Работа с сообщениями об ошибках
</h3>
<p class="theme__text">
    После вызова метода errors в экземпляре Validator вы получите экземпляр Illuminate \ Support \ MessageBag, который имеет множество удобных методов для работы с сообщениями об ошибках. Переменная $ errors, которая автоматически становится доступной для всех представлений, также является экземпляром класса MessageBag.
</p>
<h4 class="theme_subtitlex2">
    Извлечение первого для поля сообщения об ошибке
</h4>
<p class="theme__text">
    Чтобы получить первое сообщение об ошибке для данного поля, используйте first метод:
</p>
<code>
<pre>
    $errors = $validator->errors();

    echo $errors->first('email');
</pre>
</code>
<h4 class="theme_subtitlex2">
    Извлечение всех сообщений об ошибках для одного поля
</h4>
<p class="theme__text">
    Если вам нужно получить массив всех сообщений для данного поля, используйте метод get:
</p>
<code>
<pre>
    foreach ($errors->get('email') as $message) {
        //
    }
</pre>
</code>
<p class="theme__text">
    Если вы проверяете поле формы массива, вы можете получить все сообщения для каждого из элементов массива, используя символ *:
</p>
<code>
<pre>
    foreach ($errors->get('attachments.*') as $message) {
        //
    }
</pre>
</code>
<h4 class="theme_subtitlex2">
    Получение всех сообщений об ошибках для всех полей
</h4>
<p class="theme__text">
    Чтобы получить массив всех сообщений для всех полей, используйте метод all:
</p>
<code>
<pre>
    foreach ($errors->all() as $message) {
        //
    }
</pre>
</code>
<h4 class="theme_subtitlex2">
    Определить наличие сообщения для определенного поля
</h4>
<p class="theme__text">
    Метод has может использоваться для определения наличия сообщений об ошибках для данного поля:
</p>
<code>
<pre>
    if ($errors->has('email')) {
        //
    }

</pre>
</code>
<h3 class="theme__subtitle">
    Пользовательские сообщения об ошибках
</h3>
<p class="theme__text">
    При необходимости, вы можете использовать свои сообщения об ошибках вместо значений по умолчанию. Существует несколько способов для указания кастомных сообщений. Во-первых, можно передать сообщения в качестве третьего аргумента в метод Validator::make:
</p>
<code>
<pre>
    $messages = [
        'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($input, $rules, $messages);
</pre>
</code>
<p class="theme__text">
    В этом примере :attributeбудет заменен на имя проверяемого поля. Вы также можете использовать и другие строки-переменные. Пример:
</p>
<code>
<pre>
    $messages = [
        'same' => 'The :attribute and :other must match.',
        'size' => 'The :attribute must be exactly :size.',
        'between' => 'The :attribute value :input is not between :min - :max.',
        'in' => 'The :attribute must be one of the following types: :values',
    ];
</pre>
</code>
<h4 class="theme_subtitlex2">
    Указание пользовательского сообщения для заданного атрибута
</h4>
<p class="theme__text">
    Иногда есть необходимость указать собственное сообщение для конкретного поля, это можно сделать с помощью синтаксиса с точкой. Просто укажите имя атрибута и текст сообщения:
</p>
<code>
<pre>
    $messages = [
        'email.required' => 'We need to know your e-mail address!',
    ];

</pre>
</code>
<h4 class="theme_subtitlex2">
    Указание собственных сообщений в файлах языков
</h4>
<p class="theme__text">
    Также можно определять сообщения в файле локализации вместо того, чтобы передавать их в валидатор напрямую. Для этого добавьте сообщения в массив custom файла локализации resources/lang/xx/validation.php.
</p>
<code>
<pre>
    'custom' => [
        'email' => [
            'required' => 'We need to know your e-mail address!',
        ],
    ],
</pre>
</code>
<h4 class="theme_subtitlex2">
    Указание пользовательских атрибутов в файлах локализации
</h4>
<p class="theme__text">
    Если вы хотите, чтобы :attribute был заменен на кастомное имя, можно указать в массиве attributes файле локализации resources/lang/xx/validation.php:
</p>
<code>
<pre>
    'attributes' => [
        'email' => 'email address',
    ],
</pre>
</code>
<p class="theme__text">
    Вы также можете передать настраиваемые атрибуты в качестве четвертого аргумента методу Validator :: make:
</p>
<code>
<pre>
    $customAttributes = [
        'email' => 'email address',
    ];
    $validator = Validator::make($input, $rules, $messages, $customAttributes);
</pre>
</code>
<h4 class="theme_subtitlex2">
    Указание пользовательских знчения в файлах локализации
</h4>
<p class="theme__text">
    Иногда вам может потребоваться заменить часть: value вашего сообщения проверки пользовательским представлением значения. Например, рассмотрим следующее правило, которое определяет, что номер кредитной карты требуется, если payment_type имеет значение cc:
</p>
<code>
<pre>
    $request->validate([
        'credit_card_number' => 'required_if:payment_type,cc'
    ]);
</pre>
</code>
<p class="theme__text">
    Если это правило проверки не срабатывает, будет выдано следующее сообщение об ошибке:
    The credit card number field is required when payment type is cc.
    Вместо того, чтобы отображать cc в качестве значения типа платежа, вы можете указать пользовательское представление значения в вашем языковом файле validation, определив массив values:
</p>
<code>
<pre>
    'values' => [
        'payment_type' => [
            'cc' => 'credit card'
        ],
    ],
</pre>
</code>
<p class="theme__text">
    Now if the validation rule fails it will produce the following message:
    The credit card number field is required when payment type is credit card.
</p>
<h3 class="theme__subtitle">
    Доступные правила валидации
</h3>
<p class="theme__text">
    92 -
</p>


-----------------------------
<div class="themes">
    <div class="theme">
    </div>
</div>
-----------------------------
<h1 class="themes__title">

</h1>
<h2 class="theme__title">

</h2>
<h3 class="theme__subtitle">

</h3>
<h4 class="theme_subtitlex2">

</h4>
<p class="theme__text">

</p>
<code>
<pre>

</pre>
</code>



















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
@endsection




