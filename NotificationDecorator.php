
<!--1. Реализовать на PHP пример Декоратора, позволяющий отправлять уведомления
несколькими различными способами (описан в этой методичке).

Проблема
Предположим, что у нас есть приложение, способное отправлять оповещения тремя способами: SMS,
Email и Chrome Notification (CN). Пользователю предлагается выбрать, какие уведомления будут
приходить. На каждый из вариантов необходим свой подкласс. Например: SMS + Email, Email + CN,
SMS + Email + CN. Как поступить?
<?php




interface INotify
{
 public function sender();
}

class Notification implements INotify
{
    private $to ;
    private $subject;
    private $message;
    private $user;


    public function __construct(string $to, $message, $subject, array $user)
    {
    $this->to = $to;
    $this->subject = $subject;
    $this->message= $message;
    $this->user = $user;
    }

    protected function loginTo($user)
    {
        $this->user -> login();
        $this->user -> sendMessage();
    }

    public function sender()
    {
        return mb_send_mail($this->subject, $this->to, $this->message );

    }
}




/* TODO Создадим декораторы для расылки сообщений
*/





class Decorator implements INotify
{
    protected $notifications = [];
    public function __construct(INotify $notifications)
    {
        $this->notifications = $notifications;
    }

    public function sender()
    {
      $this->notifications-> send_mail();
    }
}
class SMS extends Decorator
{
    public function sender(): array
    {
        $smsPush = new SmsPush();
        foreach ($this->notifications as $notification) {
            $smsPush->queueNotification(
                $notification['subscription'],
                $notification['payload']
            );
        }

    }


}
class CN extends Decorator
{
    public function sender(): array
    {
        $webPush = new WebPush();


        foreach ($this->notifications as $notification) {
            $webPush->queueNotification(
                $notification['subscription'],
                $notification['payload']
            );
        }
    }
}





function testDecorator()
{
    $Sender =
        new SMS(
            new  CN(
                new Notification(,"","", "", "",)
            )
        );
    $Sender->sender();
}
echo 'Decorator';
