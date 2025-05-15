<?php

declare (strict_types=1);

namespace App\Service\Cabinet;

class BreadCrumbsService
{
    public function __construct(
    ) {}

    public function getBreadCrumbs(string $path): array
    {
        $breadcrumbs = [];

        $pageName = 'Главная';
        preg_match('/\/cabinet\/(.*)\.php/', $path, $arg);
        $curPage = $arg[1] ?? null;
        $breadcrumbs[0] = [
            'name' => 'Главная',
            'link' => 'index.php',
        ];
        if($curPage != '' && $curPage !="index" ){
            if($curPage == "webinar_material"){
                $breadcrumbs[1] = array("name"=>"Вебинары","link"=>"listwebinars.php");
                $breadcrumbs[2] = array("name"=>"Материал: ".$_GET['name'],"link"=>"#");
            } elseif($curPage == "webinar_test"){
                $breadcrumbs[1] = array("name"=>"Вебинары","link"=>"listwebinars.php");
                $breadcrumbs[2] = array("name"=>"Тест: ".$_GET['name'],"link"=>"#");
            }elseif($curPage == "webinar_result"){
                $breadcrumbs[1] = array("name"=>"Вебинары","link"=>"listwebinars.php");
                $breadcrumbs[2] = array("name"=>"Результаты: ".$_GET['name'],"link"=>"#");
            }elseif($curPage == "school_result"){
                $breadcrumbs[1] = array("name"=>"Вебинары","link"=>"listwebinars.php");
                $breadcrumbs[2] = array("name"=>"Результаты: ".$_GET['name'],"link"=>"#");
            }elseif($curPage == "material"){
                $breadcrumbs[1] = array("name"=>"Информация от производителей","link"=>"materials.php");
                $breadcrumbs[2] = array("name"=>$_GET['name'],"link"=>"#");
            }elseif($curPage =='promo'){
                $breadcrumbs[1] = array("name"=>"Акции","link"=>"promotions.php");
                $breadcrumbs[2] = array("name"=>$_GET['name'],"link"=>"#");
            }else{
                $breadcrumbs[1] = array("name"=>$pageName,"link"=>$curPage.".php");
            }
        }

        return $breadcrumbs;
    }
}
