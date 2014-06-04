<?php
/**
* @buid tree menu
*/
class TreeMenuBuilder {

	/**
	* Если ключи оригинального массива не совпадают
	* с id элемента, то прогоняем оригинальный
	* массив через этот метод
	*/
	private static function setId($data) {
		$new = array();
		foreach ($data as $key => $value) {
			$new[$value['id']] = $value;
		}
		return $new;
	}

	private static function buildTree($dataset) {
		$tree = array();

		foreach ($dataset as $id=>&$node) {
			if (!$node['parent_id']) {
				$tree[$id] = &$node;
			} else {
				$dataset[$node['parent_id']]['childs'][$id] = &$node;
			}
		}
		return $tree;
	}

	private static function view($dataset) {
		
		foreach ($dataset as $menu) {
			$prefix = !strcasecmp($menu["type"], "folder") ? '[+] ' : null;
			echo '<li>'.$prefix.'<a href="?id='.$menu["id"].'">'.$menu["title"].'</a>';
			
			if($menu['childs']) {
				echo '<ul class="submenu">';
				self::view($menu['childs']);
				echo '</ul>';
			}
			echo '</li>';
		}
		
	}

	public static function get($menu) {
		$data = self::buildTree($menu);
		self::view($data);
	}
}