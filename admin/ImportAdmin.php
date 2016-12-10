<?php
require_once('api/Simpla.php');

class ImportAdmin extends Simpla
{
    public $import_files_dir = 'admin/files/import/';
    public $allowed_extensions = ['csv', 'txt', 'xsl', 'xlsx'];
    private $locale = 'ru_RU.UTF-8';

    public function fetch()
    {
        switch($this->request->get('method')) {

            // Прайс
            case 'item':

                $item = new stdClass();
                $item_id = !empty($this->request->get('id', 'integer')) ? $this->request->get('id', 'integer') : $this->request->post('id', 'integer');

                if ($this->request->method('post') && $this->request->post('upload_file')
                    && $this->request->files("file")
                    && $item = $this->import->get_price(intval($item_id))) {

                    // Имя оригинального файла
                    $file_import = $this->image->correct_filename($this->request->files("file", "name"));
                    $uploaded_file = pathinfo($file_import, PATHINFO_BASENAME);
                    $base = pathinfo($uploaded_file, PATHINFO_FILENAME);
                    $ext = pathinfo($uploaded_file, PATHINFO_EXTENSION);

                    if(in_array(strtolower($ext), $this->allowed_extensions)) {

                        $temp = tempnam($this->import_files_dir, 'temp_');
                        if (!move_uploaded_file($this->request->files("file", "tmp_name"), $temp))
                            $messages['error'][] = ['key' => 'upload_error'];

                        if (!$this->import->convert_file($temp, $this->import_files_dir . $file_import)) {
                            $messages['error'][] = ['key' => 'convert_error'];
                        } else {
                            $this->design->assign('allow_import', $file_import);

                            if(isset($item->settings)) {
                                $item->settings = (array) json_decode($item->settings);
                                $item->settings['file_import'] = $file_import;
                                $item->settings = json_encode($item->settings);
                            }
                            $this->import->update_price($item->id, $item);
                            $messages['success'][] = ['key' => 'updated'];
                        }

                        //$this->design->assign('filename',  $this->request->files("file", "name"));
                        unlink($temp);
                    }
                } elseif ($this->request->method('post') AND $this->request->post('save')) {

                    $item->id = $this->request->post('id', 'integer');
                    $item->auto_import = $this->request->post('auto_import', 'boolean');
                    $item->available_import = $this->request->post('available_import', 'boolean');
                    $item->name = $this->request->post('name');

                    $settings = $this->request->post('settings');

                    if(isset($settings['field'])) {
                        $settings['field'] = array_diff($settings['field'], ['']);
                        $item->settings = json_encode($settings, TRUE);
                    }

                    if(empty($item->name)) {
                        $messages['error'][] = ['key' => 'required_fields'];
                    } else {
                        if (empty($item->id)) {
                            $item->id = $this->import->add_price($item);
                            $messages['success'][] = ['key' => 'added'];
                        } else {
                            $this->import->update_price($item->id, $item);
                            $messages['success'][] = ['key' => 'updated'];
                        }
                        $item = $this->import->get_price($item->id);
                    }
                } else {
                    $item = $this->import->get_price($item_id);
                }

                if(isset($item->settings))
                    $item->settings = json_decode($item->settings, TRUE);

                // Прочитаем первые 50 строк, и покажем их.
                $columns = array();
                $row = 1;
                if(isset($item->settings['file_import']) AND ($f = fopen($this->import_files_dir . $item->settings['file_import'], 'r')) !== FALSE) {
                    while (($data = fgetcsv($f, 1000000, ';')) !== FALSE AND $row <= 50) {
                        $columns[] = $data;
                        $row++;
                    }
                    $this->design->assign('columns', $columns);

                    // Покажем все свойства товаров
                    $this->design->assign('features', $this->features->get_features());
                }

                $this->design->assign('item', $item);
                $template = 'import_item.tpl';
                break;

            // Список прайсов
            default:

                if($this->request->method('post'))
                {
                    // Действия с выбранными
                    $ids = $this->request->post('check');
                    if(is_array($ids))
                        switch($this->request->post('action'))
                        {
                            case 'delete':
                            {
                                foreach($ids as $id)
                                {
                                    $this->import->delete_price($id);
                                }
                                $messages['success'][] = ['key' => 'removed'];
                                break;
                            }
                        }
                }

                $prices = $this->import->get_prices();
                $this->design->assign('prices', $prices);
                $this->design->assign('count_prices', $this->import->count_prices());
                $template = 'import.tpl';

                break;
        }

        if(isset($messages))
            $this->design->assign('messages', $messages);

        return $this->body = $this->design->fetch($template);



        /*

        $this->design->assign('import_files_dir', $this->import_files_dir);
        if(!is_writable($this->import_files_dir)) {
            $messages['error'][] = ['key' => 'no_permission', 'data' => $this->import_files_dir];
        } else {

            // Проверяем локаль
            $old_locale = setlocale(LC_ALL, 0);
            setlocale(LC_ALL, $this->locale);
            if(setlocale(LC_ALL, 0) != $this->locale)
            {
                $messages['error'][] = ['key' => 'locale_error', 'data' => $this->locale];
            }
            setlocale(LC_ALL, $old_locale);

            if($this->request->method('post') && $this->request->post('upload_file') && ($this->request->files("file")))
            {
                $uploaded_name = $this->request->files("file", "tmp_name");
                $temp = tempnam($this->import_files_dir, 'temp_');
                if(!move_uploaded_file($uploaded_name, $temp))
                    $messages['error'][] = ['key' => 'upload_error'];

                if(!$this->convert_file($temp, $this->import_files_dir.$this->import_file))
                    $messages['error'][] = ['key' => 'convert_error'];
                else
                    $this->design->assign('allow_import', $this->request->files("file", "name"));
                //$this->design->assign('filename',  $this->request->files("file", "name"));
                unlink($temp);
            }
            elseif($this->request->method('post') AND $this->request->post('save'))
            {
                $import_csv_settings = $this->request->post('import_settings');
                $import_csv_settings['field'] = array_diff($import_csv_settings['field'], ['']);
                $this->settings->import_csv_settings = json_encode($import_csv_settings);
            }

            // Прочитаем первые 10 строк, и покажем их.
            $f = fopen($this->import_files_dir.$this->import_file, 'r');
            $columns = fgetcsv($f, null, ';');
            $this->design->assign('columns', $columns);
        }

        $import_csv_settings = json_decode($this->settings->import_csv_settings);
        $this->design->assign('import_csv_settings', $import_csv_settings);

        if(isset($messages))
            $this->design->assign('messages', $messages);

        */
    }
}