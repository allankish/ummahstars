<?php
if (!function_exists('cipl_image_resize')) {

    function cipl_image_resize($image_path, $image_name, $height, $width) {
        // Get the CodeIgniter super object
        $CI = & get_instance();

        // Path to image thumbnail
        $image_thumb = dirname($image_path) . '/' . $height . '_' . $width . '_' . $image_name;

        if (!file_exists($image_thumb)) {
            // LOAD LIBRARY
            $CI->load->library('image_lib');

            // CONFIGURE IMAGE LIBRARY
            $config['image_library'] = 'gd2';
            $config['source_image'] = $image_path;
            $config['new_image'] = $image_thumb;
            $config['maintain_ratio'] = true;
            $config['height'] = $height;
            $config['width'] = $width;
            $CI->image_lib->initialize($config);
            $CI->image_lib->resize();
            $CI->image_lib->crop();
            $CI->image_lib->clear();
        }

        return '<img src="' . base_url() . $image_thumb . '" width="' . $width . '" height="' . $height . '" />';
    }

}

if (!function_exists('cipl_image_upload')) {
    
    function cipl_image_upload($file, $field_name, $upload_path, $file_name, $width, $height) {
        $CI = & get_instance();
        if (isset($file) && !empty($file['name'])) :
            $config = array(
                'file_name' => $file_name,
                'upload_path' => $upload_path,
                'allowed_types' => "jpeg|jpg|png",
                'overwrite' => false,
                'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            );
        $CI->load->library('upload', $config);
        if ($CI->upload->do_upload($field_name)) :
                $upload_data = $CI->upload->data();
                if ($upload_data['image_width'] > $width || $upload_data['image_height'] > $height):
                    $config['source_image'] = $upload_data['full_path'];
                    $config['width'] = $width;
                    $config['height'] = $height;
                    $config['maintain_ratio'] = true;
                    $CI->load->library('image_lib', $config);
                    $CI->image_lib->resize();
                endif;
                return array("success" => true, "filename" => $upload_data['file_name']);
            else :
                return array("error" => true,
                    "messages" => array("error" => $CI->upload->display_errors())
                );
            endif;
        endif;
    }
    
}