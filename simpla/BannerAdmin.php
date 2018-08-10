<?php

require_once('api/Simpla.php');

class BannerAdmin extends Simpla
{
    function fetch()
	{
        switch($this->request->get('method')) {

            // Страница группы баннеров
            case 'banner':

                $banner = new StdClass();

                if($this->request->method('POST')) {
                    $banner->id = $this->request->post('id', 'integer');
                    $banner->name = $this->request->post('name', 'string');

                    if(($s = $this->banner->get_banner($banner->id)) && $s->id != $banner->id) {
                        $messages['error'][] = ['key' => 'exists'];
                    } else {
                        if(empty($banner->id))
                        {
                            $banner->id = $this->banner->add_banner($banner);
                            $banner = $this->banner->get_banner($banner->id);
                            $messages['success'][] = ['key' => 'added'];
                        }
                        else
                        {
                            $this->banner->update_banner($banner->id, $banner);
                            $banner = $this->banner->get_banner($banner->id);
                            $messages['success'][] = ['key' => 'updated'];
                        }
                    }
                } elseif($banner_id = $this->request->get('id', 'integer')) {
                    $banner = $this->banner->get_banner($banner_id);
                }

                $this->design->assign('banner', $banner);
                $template = 'banner.tpl';

                break;


            // Список баннеров
            case 'banner_images':
            default:

                $banner_images = $this->banner->get_banner_images();
                $this->design->assign('banner_images', $banner_images);

                $template = 'banner_images.tpl';

                break;


            // Создание и редактирование баннера
            case 'banner_image':

                $banner_image = new StdClass;

                if($this->request->method('post'))
                {
                    $banner_image->id = $this->request->post('id', 'integer');
                    $banner_image->banner_id = $this->request->post('banner_id');
                    $banner_image->name = $this->request->post('name');
                    $banner_image->description = $this->request->post('description');
                    $banner_image->url = $this->request->post('url');
                    $banner_image->visible = $this->request->post('visible', 'boolean');

                    if(empty($banner_image->name)) {
                        $messages['error'][] = ['key' => 'required_fields'];
                    } else {
                        if (empty($banner_image->id)) {
                            $banner_image->id = $this->banner->add_banner_image($banner_image);
                            $messages['success'][] = ['key' => 'added'];
                        } else {
                            $this->banner->update_slide($banner_image->id, $banner_image);
                            $messages['success'][] = ['key' => 'updated'];
                        }

                        $banner_image = $this->banner->get_banner_image($banner_image->id);

                        $image_file = $this->request->files('image');

                        // Удалить изображение слайда
                        if($this->request->post('delete_image'))
                        {
                            $this->image->delete($banner_image->image);
                            $banner_image->image = '';
                            $this->banner->update_slide($banner_image->id, ['image' => $banner_image->image]);
                        }

                        if (!empty($image_file['name']) AND empty($banner_image->image)) {

                            // Загрузка изображения
                            $image = $this->image->upload($this->request->files('image'), $this->config->banner_images_dir);
                            if ($image)
                                $banner_image->image = $image;
                            else
                                $messages['error'][] = ['key' => 'file_upload_error'];

                            // Обновляем слайд
                            $this->banner->update_banner_image($banner_image->id, ['image' => $banner_image->image]);
                        }
                    }
                }
                else
                {
                    // Покажем слайд
                    $banner_image_id = $this->request->get('id', 'integer');
                    $banner_image = $this->banner->get_banner_image($banner_image_id);
                }

                // Путь к дерритории изображения
                if(!empty($banner_image->image))
                    $banner_image->image =  '/' . $this->config->banner_images_dir . $banner_image->image;

                // Выводим группы баннеров
                $this->design->assign('banners', $this->banner->get_banners());

                // Показываем сам баннер
                $this->design->assign('banner_image', $banner_image);

                $template = 'banner_image.tpl';

                break;

            // Список групп баннеров
            case 'banners':

                $banners = $this->banner->get_banners();
                $this->design->assign('banners', $banners);

                $template = 'banners.tpl';

                break;
        }

        if(isset($messages))
            $this->design->assign('messages', $messages);

        return $this->body = $this->design->fetch($template);
	}
}