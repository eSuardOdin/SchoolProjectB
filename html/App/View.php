<?php
declare(strict_types=1);
namespace App;
use App\Exceptions\ViewNotFoundException;
class View
{
    protected string $view;
    protected array $params;
    public function __construct(string $view, array $params = [])
    {
        $this->view = $view;
        $this->params = $params;
    }

    public static function make(string $view, array $params = [])
    {
        return new static($view, $params);
    }

    private function render(): string
    {
        $viewPath = VIEW_PATH . $this->view . '.php';
        if(!file_exists($viewPath))
        {
            throw new ViewNotFoundException();
        }
        ob_start();
        include VIEW_PATH . $this->view . '.php';
        return (string)ob_get_clean();
    }

    public function __toString()
    {
        return $this->render();
    }
}