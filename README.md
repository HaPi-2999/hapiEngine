Создания нового маршрута сайта:
       
        1)Переходите в папку public
        
        2)Открываем файл route.php
        
        3)Пишем маршрут
               
               Шаблон - Router::add("uri","Folder\Controller@method");
               
               Пример  написания маршрута - Router::add("articles/add", "Articles\ArtController@add");
                
        Все контроллеры должны находиться в папке app/controllers
      
Render view and layout компонентов:

        1) Унаследовать ваш Контроллер от базового под названием Controller
        
        2) Вызвать метод $this->getView()->render(["App/body_view", "header_view"], "main_layout");
        
            Первый параметр это массив view компонентов
            
            Второй параметр это название шаблона(не обязателен), если его нет то будет иcпользоваться шаблон по умолчанию(default)
        
        4) Для подключения view в layout нужно обратиться к массиву views, а потом обратиться по ключу(ключ - это нaзвания View)
            
            Пример:
                
                У нас есть view  под названием main_view.В layout подключяем так $views['main_view']
                
         5)Все layouts лежат в папке templates
         
         6)Все　views лежат в папке templates/views   