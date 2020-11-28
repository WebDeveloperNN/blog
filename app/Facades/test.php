<?

namespace app\Facades;
use Illuminate\Support\Facades\Facade;
class test extends Facade {
    // вернуть строковое имя, ключ привязки объекта к сервис-контейнеру.
    // То есть фасад должен вернуть имя свойства, которая мы указали в сервис-провайдере. Имя свойства, которое будет хранить объект кастомного класса. Имя свойства сервис-контейнера, где храниться объект кастомного класса.ы
    protected static function getFacadeAccessor() {
        return 'test';
    }
}
