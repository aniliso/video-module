<?php

namespace Modules\Video\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterVideoSidebar extends AbstractAdminSidebar
{
    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('video::videos.title.videos'), function (Item $item) {
                $item->icon('fa fa-video-camera');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('video::categories.title.categories'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.video.category.create');
                    $item->route('admin.video.category.index');
                    $item->authorize(
                        $this->auth->hasAccess('video.categories.index')
                    );
                });
                $item->item(trans('video::media.title.media'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.video.media.create');
                    $item->route('admin.video.media.index');
                    $item->authorize(
                        $this->auth->hasAccess('video.media.index')
                    );
                });
// append


            });
        });

        return $menu;
    }
}
