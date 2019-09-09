<?php


namespace vendor\core\base;


class View
{
    protected $views = "";

    protected $layout = "";

    protected $route = [];

    public function __construct($route, $view = "default_view", $layout = "default_layout")
    {
        $this->route = $route;
        $this->layout = $layout ;
        $this->views = $view;
    }


    /**
     * Отображения view and layout на экране
     * @param array $views
     * @param string $layout
     */
    public function render($views = ["default_view"], $layout = "default_layout", $data = [])
    {
        $this->views = $views;
        $this->layout = $layout;

        $pathLayout = ROOT . "/templates/" . $this->layout . ".php";

        $views = $this->buffersView($views);


        if (is_file($pathLayout)) {
            require_once $pathLayout;
        } else {
            echo "Layout $this->layout not found";
        }
    }

    /**
     * Буферизация всех view
     * @param $views
     * @return array
     */
    private function buffersView($views)
    {
        $contents = [];

        foreach ($views as $view) {

            $nameKey  = $this->transformViewNameInKeyArray($view);

            $pathView = ROOT . "/templates/views/" . $view . ".php";

            ob_start();

            if (is_file($pathView)) {
                require_once $pathView;
            } else {
                echo "View $pathView not found";
            }

            $contents[$nameKey] = ob_get_clean();
        }

        return $contents;
    }

    /**
     * Оставляем только название файла, для будущего использования его как ключа массива
     * @param $nameView
     * @return mixed
     */
    private function transformViewNameInKeyArray($nameView)
    {
        return array_reverse(explode("/", $nameView))[0];
    }
}