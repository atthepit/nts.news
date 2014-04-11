<?php

if (!function_exists('extension'))
{
	function extension($fichero)
	{
		$vector_aux = explode(".", $fichero); // Split

		return strtolower($vector_aux[count($vector_aux) - 1]); // último elemento
	}
}

if (!function_exists('get_image_nts'))
{
	function get_image_nts($name, $type = 'profile')
	{
		switch ($type)
		{
			case 'profile':
				return getImage($name, 80, 80, "_crop");
			case 'cart':
				return getImage($name, 40, 40, "_crop");
			default:
				$text_type = "";
				break;
		}
	}
}

if (!function_exists('resizeWidth'))
{
	function resizeWidth($source, $destination, $width, $height = '')
	{

		$CI = &get_instance();

		$config['image_library'] = 'gd2';
		$config['source_image'] = $source;
		$config['new_image'] = $destination;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = TRUE;
		$config['master_dim'] = "width";
		$config['quality'] = "100%";
		$config['width'] = $width;
		$config['height'] = $height;
        $config['overwrite'] = FALSE;


		$CI->load->library('image_lib', $config);
		$CI->image_lib->clear();
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		$error = $CI->image_lib->display_errors();
		$CI->image_lib->clear();

		return $error;
	}
}

if (!function_exists('get_image'))
{
	function get_image($name, $width = "", $height = "", $type = 'default')
	{

		$retorno = $name;

		switch ($type)
		{
			case 'crop':
				$text_type = "_crop";
				break;
			case 'fill':
				$text_type = "_fill";
				break;
			default:
				$text_type = "";
				break;
		}

		$ext = extension($name);

		if ($width != "" && $height != "")
			$retorno = str_replace("." . $ext, $text_type . "_" . $width . "_" . $height . '.' . $ext, $name);

		return $retorno;

	}
}

/* End of file nts_image_helper.php */
/* Location: ./application/helpers/nts_image_helper.php */
