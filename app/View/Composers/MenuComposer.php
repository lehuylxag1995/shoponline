<?php

namespace App\View\Composers;

use App\Repositories\Interfaces\MenuRepositoryInterface;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * The user repository implementation.
     *
     * @var App\Repositories\Interfaces\MenuRepositoryInterface
     */
    protected $menuRepository;

    /**
     * Create a new profile composer.
     *
     * @param  App\Repositories\Interfaces\MenuRepositoryInterface  $m
     * @return void
     */
    public function __construct(MenuRepositoryInterface $m)
    {
        $this->menuRepository = $m;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('ListMenu', $this->menuRepository->getListActive());
    }
}
