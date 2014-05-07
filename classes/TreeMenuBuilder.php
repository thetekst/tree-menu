<?php
/**
* @buid tree menu
*/
class TreeMenuBuilder {

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