<?php

/**
 * Список слайдеров
 */

require_once('api/Simpla.php');

class SliderAdmin extends Simpla
{
    function fetch()
	{
        // Создание и редактирование слайдера
        switch($this->request->get('method')) {

            // Страница слайдера
            case 'slider':

                $slider = new StdClass();

                if($this->request->method('POST')) {
                    $slider->id = $this->request->post('id', 'integer');
                    $slider->name = $this->request->post('name', 'string');

                    if(($s = $this->slider->get_slider($slider->id)) && $s->id != $slider->id) {
                        $messages['error'][] = ['key' => 'exists'];
                    } else {
                        if(empty($slider->id))
                        {
                            $slider->id = $this->slider->add_slider($slider);
                            $slider = $this->slider->get_slider($slider->id);
                            $messages['success'][] = ['key' => 'added'];
                        }
                        else
                        {
                            $this->slider->update_slider($slider->id, $slider);
                            $slider = $this->slider->get_slider($slider->id);
                            $messages['success'][] = ['key' => 'updated'];
                        }
                    }
                } elseif($slider_id = $this->request->get('id', 'integer')) {
                    $slider = $this->slider->get_slider($slider_id);
                }

                $this->design->assign('slider', $slider);
                $template = 'slider.tpl';

                break;

            // Список слайдов у слайдера
            case 'slides':

                $slider_id = $this->request->get('id', 'integer');

                if(!empty($slider_id) AND ($slider = $this->slider->get_slider($slider_id))) {

                    $this->design->assign('slider', $slider);

                    $slides = $this->slider->get_slides($slider_id);
                    $this->design->assign('slides', $slides);

                    $template = 'slides.tpl';
                } else {
                    header('Location: index.php?module=SliderAdmin');
                }

                break;

            // Создание и редактирование слайда
            case 'slide':

                $slide = new StdClass;

                $slider_id = $this->request->get('slider_id', 'integer');

                // Слайдер
                if(!empty($slider_id) AND ($slider = $this->slider->get_slider($slider_id))) {

                    if($this->request->method('post'))
                    {
                        $slide->id = $this->request->post('id', 'integer');
                        $slide->slider_id = $slider_id;
                        $slide->name = $this->request->post('name');
                        $slide->description = $this->request->post('description');
                        $slide->url = $this->request->post('url');
                        $slide->visible = $this->request->post('visible', 'boolean');

                        if(empty($slide->name)) {
                            $messages['error'][] = ['key' => 'required_fields'];
                        } else {
                            if (empty($slide->id)) {
                                $slide->id = $this->slider->add_slide($slide);
                                $messages['success'][] = ['key' => 'added'];
                            } else {
                                $this->slider->update_slide($slide->id, $slide);
                                $messages['success'][] = ['key' => 'updated'];
                            }

                            $slide = $this->slider->get_slide($slide->id);

                            $image_file = $this->request->files('image');

                            // Удалить изображение слайда
                            if($this->request->post('delete_image'))
                            {
                                $this->image->delete($slide->image);
                                $slide->image = '';
                                $this->slider->update_slide($slide->id, ['image' => $slide->image]);
                            }

                            if (!empty($image_file['name']) AND empty($slide->image)) {

                                // Загрузка изображения
                                $image = $this->image->upload($this->request->files('image'), $this->config->slider_images_dir);
                                if ($image)
                                    $slide->image = $image;
                                else
                                    $messages['error'][] = ['key' => 'file_upload_error'];

                                // Обновляем слайд
                                $this->slider->update_slide($slide->id, ['image' => $slide->image]);
                            }
                        }
                    }
                    else
                    {
                        // Покажем слайд
                        $slide_id = $this->request->get('id', 'integer');
                        $slide = $this->slider->get_slide($slide_id);
                    }

                    // Путь к дерритории изображения
                    if(!empty($slide->image))
                        $slide->image =  '/' . $this->config->slider_images_dir . $slide->image;



                    $this->design->assign('slider', $slider);
                    $this->design->assign('slide', $slide);
                    $template = 'slide.tpl';
                } else {
                    header('Location: index.php?module=SliderAdmin');
                }

                break;

            // Список слайдеров
            default:

                $sliders = $this->slider->sliders();
                $this->design->assign('sliders', $sliders);

                $template = 'sliders.tpl';

                break;

        }

        if(isset($messages))
            $this->design->assign('messages', $messages);

        return $this->body = $this->design->fetch($template);
	}
}
