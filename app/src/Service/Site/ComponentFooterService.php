<?php

declare (strict_types=1);

namespace App\Service\Site;

class ComponentFooterService
{
    public function getContactMeny(): array
    {
        $menu1[0] = ['name' => 'О компании', 'link' => 'about-company', 'bold' => true];
        $menu1[1] = ['name' => 'Отзывы о нас', 'link' => 'press-about-us', 'bold' => false];
        $menu1[2] = ['name' => 'Вакансии', 'link' => 'jobs', 'bold' => false];
        $menu1[3] = ['name' => 'Контакты', 'link' => 'contacts', 'bold' => false];

        $menu2[0] = ['name' => 'Сотрудничество', 'link' => 'cooperation', 'bold' => true];
        $menu2[1] = ['name' => 'Производителям', 'link' => 'manufacturer', 'bold' => false];
        $menu2[2] = ['name' => 'Аптечным сетям', 'link' => 'pharmacy-chains', 'bold' => false];
        $menu2[4] = ['name' => 'Медико-фармацевтический дистрибьютор', 'link' => 'distribution', 'bold' => false];

        return [
            'menu1' => $menu1,
            'menu2' => $menu2,
        ];
    }
}
